<?php
/**
 * Form helpers and the submission handler shared by both blocks.
 *
 * @package BrightSmileAppointments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Split a textarea attribute into a clean list of lines.
 */
function bsa_lines( $text ) {
	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $text ) ) ) );
}

/**
 * Attributes of a form block, merged with block.json defaults.
 *
 * Settings are read from the saved page (never from the submitted form), so
 * visitors cannot change e.g. the notification email.
 */
function bsa_block_settings( $block_name, $post_id ) {
	$type     = WP_Block_Type_Registry::get_instance()->get_registered( $block_name );
	$settings = array();
	if ( $type ) {
		foreach ( $type->attributes as $key => $schema ) {
			if ( isset( $schema['default'] ) ) {
				$settings[ $key ] = $schema['default'];
			}
		}
	}
	$post = $post_id ? get_post( $post_id ) : null;
	if ( $post ) {
		$found = bsa_find_block( parse_blocks( $post->post_content ), $block_name );
		if ( $found ) {
			$settings = array_merge( $settings, $found );
		}
	}
	return $settings;
}

/**
 * Recursively look for a block and return its attributes.
 */
function bsa_find_block( $blocks, $block_name ) {
	foreach ( $blocks as $block ) {
		if ( $block['blockName'] === $block_name ) {
			return (array) $block['attrs'];
		}
		if ( ! empty( $block['innerBlocks'] ) ) {
			$found = bsa_find_block( $block['innerBlocks'], $block_name );
			if ( null !== $found ) {
				return $found;
			}
		}
	}
	return null;
}

/**
 * Names of the weekdays the clinic is closed, e.g. "Sunday".
 */
function bsa_closed_day_names( $closed_days ) {
	global $wp_locale;
	$names = array();
	foreach ( (array) $closed_days as $day ) {
		$names[] = $wp_locale->get_weekday( (int) $day );
	}
	return $names;
}

/**
 * State of the last submission (success flag, errors, previous values) for this visitor.
 */
function bsa_form_state( $form ) {
	static $cache = array();
	if ( isset( $cache[ $form ] ) ) {
		return $cache[ $form ];
	}
	$state = array(
		'success' => false,
		'errors'  => array(),
		'values'  => array(),
	);
	// phpcs:disable WordPress.Security.NonceVerification.Recommended -- read-only display state.
	if ( isset( $_GET['bs_form'] ) && sanitize_key( $_GET['bs_form'] ) === $form ) {
		if ( isset( $_GET['bs_sent'] ) ) {
			$state['success'] = true;
		} elseif ( isset( $_GET['bs_token'] ) ) {
			$saved = get_transient( 'bsa_' . sanitize_key( $_GET['bs_token'] ) );
			if ( is_array( $saved ) ) {
				$state = array_merge( $state, $saved );
			}
		}
	}
	// phpcs:enable
	$cache[ $form ] = $state;
	return $state;
}

/**
 * Value to pre-fill a field with after a failed submission.
 */
function bsa_old( $state, $key, $fallback = '' ) {
	return isset( $state['values'][ $key ] ) ? $state['values'][ $key ] : $fallback;
}

/**
 * Hidden fields common to both forms.
 */
function bsa_hidden_fields( $form ) {
	$out  = '<input type="hidden" name="action" value="brightsmile_form" />';
	$out .= '<input type="hidden" name="bs_form" value="' . esc_attr( $form ) . '" />';
	$out .= '<input type="hidden" name="bs_page" value="' . esc_attr( (int) get_the_ID() ) . '" />';
	$out .= wp_nonce_field( 'bsa_submit_' . $form, 'bs_nonce', true, false );
	// Honeypot: real visitors never see or fill this field.
	$out .= '<div class="bs-hp" aria-hidden="true"><label>Website <input type="text" name="bs_website" tabindex="-1" autocomplete="off" /></label></div>';
	return $out;
}

/**
 * Success / error notice markup.
 */
function bsa_notice( $state, $success_message ) {
	if ( $state['success'] ) {
		return '<div class="bs-notice bs-notice--success" role="status"><strong>' . esc_html__( 'Thank you!', 'brightsmile-appointments' ) . '</strong> ' . esc_html( $success_message ) . '</div>';
	}
	if ( $state['errors'] ) {
		$out = '<div class="bs-notice bs-notice--error" role="alert"><strong>' . esc_html__( 'Please check the form:', 'brightsmile-appointments' ) . '</strong><ul>';
		foreach ( $state['errors'] as $error ) {
			$out .= '<li>' . esc_html( $error ) . '</li>';
		}
		return $out . '</ul></div>';
	}
	return '';
}

/**
 * Handle both forms (admin-post.php?action=brightsmile_form).
 */
function bsa_handle_submission() {
	$form = isset( $_POST['bs_form'] ) ? sanitize_key( $_POST['bs_form'] ) : '';
	if ( ! in_array( $form, array( 'appointment', 'contact' ), true ) ) {
		wp_die( esc_html__( 'Unknown form.', 'brightsmile-appointments' ), 400 );
	}
	if ( ! isset( $_POST['bs_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bs_nonce'] ) ), 'bsa_submit_' . $form ) ) {
		wp_die( esc_html__( 'Your session has expired. Please go back, refresh the page and try again.', 'brightsmile-appointments' ), 403 );
	}

	$back = wp_get_referer();
	$back = $back ? remove_query_arg( array( 'bs_form', 'bs_sent', 'bs_token' ), $back ) : home_url( '/' );
	$back = strtok( $back, '#' );

	// Bots fill the hidden field: pretend everything went fine.
	if ( ! empty( $_POST['bs_website'] ) ) {
		wp_safe_redirect( add_query_arg( array( 'bs_form' => $form, 'bs_sent' => 1 ), $back ) . '#bs-' . $form . '-form' );
		exit;
	}

	$page_id = isset( $_POST['bs_page'] ) ? absint( $_POST['bs_page'] ) : 0;
	$field   = function ( $key, $sanitizer = 'sanitize_text_field' ) {
		return isset( $_POST[ $key ] ) ? call_user_func( $sanitizer, wp_unslash( $_POST[ $key ] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing -- verified above.
	};

	$errors = array();
	$values = array(
		'name'  => $field( 'bs_name' ),
		'email' => $field( 'bs_email', 'sanitize_email' ),
		'phone' => $field( 'bs_phone' ),
	);

	if ( '' === $values['name'] ) {
		$errors[] = __( 'Please enter your name.', 'brightsmile-appointments' );
	}
	if ( ! is_email( $values['email'] ) ) {
		$errors[] = __( 'Please enter a valid email address.', 'brightsmile-appointments' );
	}

	if ( 'appointment' === $form ) {
		$settings = bsa_block_settings( 'brightsmile/appointment-form', $page_id );
		$values  += array(
			'service' => $field( 'bs_service' ),
			'date'    => $field( 'bs_date' ),
			'time'    => $field( 'bs_time' ),
			'patient' => 'returning' === $field( 'bs_patient' ) ? 'returning' : 'new',
			'notes'   => $field( 'bs_notes', 'sanitize_textarea_field' ),
		);

		if ( '' === $values['phone'] ) {
			$errors[] = __( 'Please enter a phone number so we can confirm your visit.', 'brightsmile-appointments' );
		}
		if ( ! in_array( $values['service'], bsa_lines( $settings['services'] ), true ) ) {
			$errors[] = __( 'Please choose a treatment.', 'brightsmile-appointments' );
		}
		$date = DateTime::createFromFormat( '!Y-m-d', $values['date'], wp_timezone() );
		if ( ! $date || $date->format( 'Y-m-d' ) !== $values['date'] ) {
			$errors[] = __( 'Please choose a preferred date.', 'brightsmile-appointments' );
		} elseif ( $values['date'] < wp_date( 'Y-m-d' ) ) {
			$errors[] = __( 'The preferred date cannot be in the past.', 'brightsmile-appointments' );
		} elseif ( in_array( (int) $date->format( 'w' ), array_map( 'intval', (array) $settings['closedDays'] ), true ) ) {
			/* translators: %s: weekday name */
			$errors[] = sprintf( __( 'Sorry, we are closed on %s. Please choose another day.', 'brightsmile-appointments' ), wp_date( 'l', $date->getTimestamp() ) );
		}
		if ( ! in_array( $values['time'], bsa_lines( $settings['timeSlots'] ), true ) ) {
			$errors[] = __( 'Please choose a preferred time.', 'brightsmile-appointments' );
		}
		if ( empty( $_POST['bs_consent'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$errors[] = __( 'Please agree to be contacted about your request.', 'brightsmile-appointments' );
		}
	} else {
		$settings = bsa_block_settings( 'brightsmile/contact-form', $page_id );
		$values  += array(
			'subject' => $field( 'bs_subject' ),
			'message' => $field( 'bs_message', 'sanitize_textarea_field' ),
		);
		if ( ! in_array( $values['subject'], bsa_lines( $settings['subjects'] ), true ) ) {
			$values['subject'] = __( 'General question', 'brightsmile-appointments' );
		}
		if ( strlen( $values['message'] ) < 5 ) {
			$errors[] = __( 'Please write a short message.', 'brightsmile-appointments' );
		}
	}

	if ( $errors ) {
		$token = wp_generate_password( 20, false );
		set_transient( 'bsa_' . strtolower( $token ), array( 'errors' => $errors, 'values' => $values ), 15 * MINUTE_IN_SECONDS );
		wp_safe_redirect( add_query_arg( array( 'bs_form' => $form, 'bs_token' => strtolower( $token ) ), $back ) . '#bs-' . $form . '-form' );
		exit;
	}

	if ( 'appointment' === $form ) {
		bsa_save_appointment( $values, $settings );
	} else {
		bsa_save_message( $values, $settings );
	}

	wp_safe_redirect( add_query_arg( array( 'bs_form' => $form, 'bs_sent' => 1 ), $back ) . '#bs-' . $form . '-form' );
	exit;
}
add_action( 'admin_post_brightsmile_form', 'bsa_handle_submission' );
add_action( 'admin_post_nopriv_brightsmile_form', 'bsa_handle_submission' );

/**
 * Human-friendly date for a Y-m-d value.
 */
function bsa_format_date( $ymd ) {
	$date = DateTime::createFromFormat( '!Y-m-d', (string) $ymd, wp_timezone() );
	return $date ? wp_date( 'D, j M Y', $date->getTimestamp() ) : $ymd;
}

/**
 * Store an appointment request and notify the clinic.
 */
function bsa_save_appointment( $values, $settings ) {
	$id = wp_insert_post(
		array(
			'post_type'   => 'bs_appointment',
			'post_status' => 'publish',
			'post_title'  => sprintf( '%s — %s', $values['name'], $values['service'] ),
		)
	);
	if ( ! $id || is_wp_error( $id ) ) {
		return;
	}
	foreach ( $values as $key => $value ) {
		update_post_meta( $id, '_bs_' . $key, $value );
	}
	update_post_meta( $id, '_bs_status', 'pending' );

	$to   = is_email( $settings['notificationEmail'] ) ? $settings['notificationEmail'] : get_option( 'admin_email' );
	$body = sprintf(
		"New appointment request\n\nName: %s\nEmail: %s\nPhone: %s\nTreatment: %s\nPreferred: %s at %s\nPatient: %s\n\nNotes:\n%s\n\nManage it here: %s",
		$values['name'],
		$values['email'],
		$values['phone'],
		$values['service'],
		bsa_format_date( $values['date'] ),
		$values['time'],
		'new' === $values['patient'] ? 'New patient' : 'Returning patient',
		$values['notes'] ? $values['notes'] : '—',
		admin_url( 'post.php?post=' . $id . '&action=edit' )
	);
	wp_mail( $to, '[' . get_bloginfo( 'name' ) . '] New appointment request: ' . $values['name'], $body, array( 'Reply-To: ' . $values['name'] . ' <' . $values['email'] . '>' ) );

	if ( ! empty( $settings['sendConfirmation'] ) ) {
		wp_mail(
			$values['email'],
			sprintf( 'We received your appointment request — %s', get_bloginfo( 'name' ) ),
			sprintf(
				"Hi %s,\n\nThank you for choosing %s. We received your request for %s on %s at %s.\nOur team will contact you shortly to confirm the exact time.\n\nSee you soon!\n%s",
				$values['name'],
				get_bloginfo( 'name' ),
				$values['service'],
				bsa_format_date( $values['date'] ),
				$values['time'],
				get_bloginfo( 'name' )
			)
		);
	}
}

/**
 * Store a contact message and notify the clinic.
 */
function bsa_save_message( $values, $settings ) {
	$id = wp_insert_post(
		array(
			'post_type'   => 'bs_message',
			'post_status' => 'publish',
			'post_title'  => sprintf( '%s — %s', $values['name'], $values['subject'] ),
		)
	);
	if ( ! $id || is_wp_error( $id ) ) {
		return;
	}
	foreach ( $values as $key => $value ) {
		update_post_meta( $id, '_bs_' . $key, $value );
	}
	update_post_meta( $id, '_bs_read', 0 );

	$to = is_email( $settings['notificationEmail'] ) ? $settings['notificationEmail'] : get_option( 'admin_email' );
	wp_mail(
		$to,
		'[' . get_bloginfo( 'name' ) . '] ' . $values['subject'] . ' — ' . $values['name'],
		sprintf( "Name: %s\nEmail: %s\nPhone: %s\nTopic: %s\n\n%s", $values['name'], $values['email'], $values['phone'] ? $values['phone'] : '—', $values['subject'], $values['message'] ),
		array( 'Reply-To: ' . $values['name'] . ' <' . $values['email'] . '>' )
	);
}
