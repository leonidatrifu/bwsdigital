<?php
/**
 * Dashboard screens for appointments and messages.
 *
 * @package BrightSmileAppointments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Appointment statuses.
 */
function bsa_statuses() {
	return array(
		'pending'   => __( 'Pending', 'brightsmile-appointments' ),
		'confirmed' => __( 'Confirmed', 'brightsmile-appointments' ),
		'completed' => __( 'Completed', 'brightsmile-appointments' ),
		'cancelled' => __( 'Cancelled', 'brightsmile-appointments' ),
	);
}

/**
 * Coloured status badge.
 */
function bsa_status_badge( $status ) {
	$statuses = bsa_statuses();
	$status   = isset( $statuses[ $status ] ) ? $status : 'pending';
	return '<span class="bsa-badge bsa-badge--' . esc_attr( $status ) . '">' . esc_html( $statuses[ $status ] ) . '</span>';
}

/**
 * Admin styles for badges and detail tables.
 */
function bsa_admin_styles() {
	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->post_type, array( 'bs_appointment', 'bs_message' ), true ) ) {
		return;
	}
	echo '<style>
		.bsa-badge{display:inline-block;padding:2px 10px;border-radius:999px;font-size:12px;font-weight:600;background:#f0f0f1;color:#50575e}
		.bsa-badge--pending{background:#fcf0d9;color:#8a5a00}
		.bsa-badge--confirmed{background:#d9f2ef;color:#0a5f63}
		.bsa-badge--completed{background:#e5eefc;color:#1f4f99}
		.bsa-badge--cancelled{background:#fbe3e3;color:#a12a2a}
		.bsa-details th{text-align:left;width:160px;padding:8px 10px 8px 0;vertical-align:top}
		.bsa-details td{padding:6px 0}
		.bsa-details input[type=text],.bsa-details input[type=email],.bsa-details input[type=tel],.bsa-details select,.bsa-details textarea{width:100%;max-width:420px}
		.bsa-message{white-space:pre-wrap;background:#f6f7f7;border-left:4px solid #0e8388;padding:12px 16px;font-size:14px;line-height:1.6;max-width:720px}
		.column-bs_status{width:110px}
	</style>';
}
add_action( 'admin_head', 'bsa_admin_styles' );

/* ---------- Appointments list ---------- */

add_filter(
	'manage_bs_appointment_posts_columns',
	function () {
		return array(
			'cb'         => '<input type="checkbox" />',
			'title'      => __( 'Patient & treatment', 'brightsmile-appointments' ),
			'bs_when'    => __( 'Preferred date & time', 'brightsmile-appointments' ),
			'bs_contact' => __( 'Contact', 'brightsmile-appointments' ),
			'bs_status'  => __( 'Status', 'brightsmile-appointments' ),
			'date'       => __( 'Received', 'brightsmile-appointments' ),
		);
	}
);

add_action(
	'manage_bs_appointment_posts_custom_column',
	function ( $column, $post_id ) {
		switch ( $column ) {
			case 'bs_when':
				$date = get_post_meta( $post_id, '_bs_date', true );
				echo esc_html( $date ? bsa_format_date( $date ) . ' · ' . get_post_meta( $post_id, '_bs_time', true ) : '—' );
				if ( 'new' === get_post_meta( $post_id, '_bs_patient', true ) ) {
					echo '<br><em>' . esc_html__( 'New patient', 'brightsmile-appointments' ) . '</em>';
				}
				break;
			case 'bs_contact':
				$email = get_post_meta( $post_id, '_bs_email', true );
				$phone = get_post_meta( $post_id, '_bs_phone', true );
				echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a><br><a href="tel:' . esc_attr( $phone ) . '">' . esc_html( $phone ) . '</a>';
				break;
			case 'bs_status':
				echo bsa_status_badge( get_post_meta( $post_id, '_bs_status', true ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in function.
				break;
		}
	},
	10,
	2
);

/**
 * Filter links above the list: All | Pending | Confirmed ...
 */
add_filter(
	'views_edit-bs_appointment',
	function ( $views ) {
		$current = isset( $_GET['bs_status'] ) ? sanitize_key( $_GET['bs_status'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		foreach ( bsa_statuses() as $key => $label ) {
			$count = count(
				get_posts(
					array(
						'post_type'      => 'bs_appointment',
						'posts_per_page' => -1,
						'fields'         => 'ids',
						'meta_key'       => '_bs_status', // phpcs:ignore WordPress.DB.SlowDBQuery
						'meta_value'     => $key, // phpcs:ignore WordPress.DB.SlowDBQuery
					)
				)
			);
			$url           = add_query_arg( array( 'post_type' => 'bs_appointment', 'bs_status' => $key ), admin_url( 'edit.php' ) );
			$views[ $key ] = sprintf( '<a href="%s"%s>%s <span class="count">(%d)</span></a>', esc_url( $url ), $current === $key ? ' class="current"' : '', esc_html( $label ), $count );
		}
		return $views;
	}
);

add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() || 'bs_appointment' !== $query->get( 'post_type' ) ) {
			return;
		}
		if ( ! empty( $_GET['bs_status'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$query->set( 'meta_key', '_bs_status' );
			$query->set( 'meta_value', sanitize_key( $_GET['bs_status'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}
	}
);

/**
 * Pending-count bubble next to the "Appointments" menu item.
 */
add_action(
	'admin_menu',
	function () {
		global $menu;
		$pending = count(
			get_posts(
				array(
					'post_type'      => 'bs_appointment',
					'posts_per_page' => -1,
					'fields'         => 'ids',
					'meta_key'       => '_bs_status', // phpcs:ignore WordPress.DB.SlowDBQuery
					'meta_value'     => 'pending', // phpcs:ignore WordPress.DB.SlowDBQuery
				)
			)
		);
		if ( ! $pending ) {
			return;
		}
		foreach ( $menu as $index => $item ) {
			if ( 'edit.php?post_type=bs_appointment' === $item[2] ) {
				$menu[ $index ][0] .= ' <span class="awaiting-mod"><span class="pending-count">' . (int) $pending . '</span></span>'; // phpcs:ignore WordPress.WP.GlobalVariablesOverride
			}
		}
	},
	99
);

/* ---------- Appointment edit screen ---------- */

add_action(
	'add_meta_boxes_bs_appointment',
	function () {
		add_meta_box( 'bsa_details', __( 'Appointment details', 'brightsmile-appointments' ), 'bsa_appointment_box', 'bs_appointment', 'normal', 'high' );
	}
);

/**
 * Editable details for an appointment (also used for phone bookings added by staff).
 */
function bsa_appointment_box( $post ) {
	wp_nonce_field( 'bsa_save_appointment', 'bsa_nonce' );
	$meta = function ( $key ) use ( $post ) {
		return get_post_meta( $post->ID, '_bs_' . $key, true );
	};
	$status = $meta( 'status' ) ? $meta( 'status' ) : 'pending';
	?>
	<table class="bsa-details">
		<tr><th><label for="bsa_status"><?php esc_html_e( 'Status', 'brightsmile-appointments' ); ?></label></th>
			<td><select id="bsa_status" name="bsa[status]">
				<?php foreach ( bsa_statuses() as $key => $label ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $status, $key ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select></td></tr>
		<tr><th><label for="bsa_name"><?php esc_html_e( 'Patient name', 'brightsmile-appointments' ); ?></label></th>
			<td><input type="text" id="bsa_name" name="bsa[name]" value="<?php echo esc_attr( $meta( 'name' ) ); ?>" /></td></tr>
		<tr><th><label for="bsa_email"><?php esc_html_e( 'Email', 'brightsmile-appointments' ); ?></label></th>
			<td><input type="email" id="bsa_email" name="bsa[email]" value="<?php echo esc_attr( $meta( 'email' ) ); ?>" /></td></tr>
		<tr><th><label for="bsa_phone"><?php esc_html_e( 'Phone', 'brightsmile-appointments' ); ?></label></th>
			<td><input type="tel" id="bsa_phone" name="bsa[phone]" value="<?php echo esc_attr( $meta( 'phone' ) ); ?>" /></td></tr>
		<tr><th><label for="bsa_service"><?php esc_html_e( 'Treatment', 'brightsmile-appointments' ); ?></label></th>
			<td><input type="text" id="bsa_service" name="bsa[service]" value="<?php echo esc_attr( $meta( 'service' ) ); ?>" /></td></tr>
		<tr><th><label for="bsa_date"><?php esc_html_e( 'Date', 'brightsmile-appointments' ); ?></label></th>
			<td><input type="date" id="bsa_date" name="bsa[date]" value="<?php echo esc_attr( $meta( 'date' ) ); ?>" /></td></tr>
		<tr><th><label for="bsa_time"><?php esc_html_e( 'Time', 'brightsmile-appointments' ); ?></label></th>
			<td><input type="time" id="bsa_time" name="bsa[time]" value="<?php echo esc_attr( $meta( 'time' ) ); ?>" /></td></tr>
		<tr><th><?php esc_html_e( 'Patient type', 'brightsmile-appointments' ); ?></th>
			<td><label><input type="radio" name="bsa[patient]" value="new" <?php checked( 'returning' !== $meta( 'patient' ) ); ?> /> <?php esc_html_e( 'New patient', 'brightsmile-appointments' ); ?></label> &nbsp;
				<label><input type="radio" name="bsa[patient]" value="returning" <?php checked( 'returning', $meta( 'patient' ) ); ?> /> <?php esc_html_e( 'Returning', 'brightsmile-appointments' ); ?></label></td></tr>
		<tr><th><label for="bsa_notes"><?php esc_html_e( 'Notes', 'brightsmile-appointments' ); ?></label></th>
			<td><textarea id="bsa_notes" name="bsa[notes]" rows="4"><?php echo esc_textarea( $meta( 'notes' ) ); ?></textarea></td></tr>
	</table>
	<?php
}

add_action(
	'save_post_bs_appointment',
	function ( $post_id ) {
		if ( ! isset( $_POST['bsa_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bsa_nonce'] ) ), 'bsa_save_appointment' ) ) {
			return;
		}
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$data = isset( $_POST['bsa'] ) ? (array) wp_unslash( $_POST['bsa'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized per field below.
		foreach ( array( 'name', 'phone', 'service', 'date', 'time', 'patient' ) as $key ) {
			update_post_meta( $post_id, '_bs_' . $key, isset( $data[ $key ] ) ? sanitize_text_field( $data[ $key ] ) : '' );
		}
		update_post_meta( $post_id, '_bs_email', isset( $data['email'] ) ? sanitize_email( $data['email'] ) : '' );
		update_post_meta( $post_id, '_bs_notes', isset( $data['notes'] ) ? sanitize_textarea_field( $data['notes'] ) : '' );
		$status = isset( $data['status'] ) ? sanitize_key( $data['status'] ) : 'pending';
		update_post_meta( $post_id, '_bs_status', array_key_exists( $status, bsa_statuses() ) ? $status : 'pending' );
	}
);

/**
 * Give staff-created appointments a sensible title automatically.
 */
add_filter(
	'wp_insert_post_data',
	function ( $data ) {
		if ( 'bs_appointment' === $data['post_type'] && '' === trim( $data['post_title'] ) && ! empty( $_POST['bsa']['name'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$name    = sanitize_text_field( wp_unslash( $_POST['bsa']['name'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$service = isset( $_POST['bsa']['service'] ) ? sanitize_text_field( wp_unslash( $_POST['bsa']['service'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$data['post_title'] = trim( $name . ( $service ? ' — ' . $service : '' ) );
		}
		return $data;
	}
);

/* ---------- Messages ---------- */

add_filter(
	'manage_bs_message_posts_columns',
	function () {
		return array(
			'cb'         => '<input type="checkbox" />',
			'title'      => __( 'From & topic', 'brightsmile-appointments' ),
			'bs_excerpt' => __( 'Message', 'brightsmile-appointments' ),
			'bs_contact' => __( 'Contact', 'brightsmile-appointments' ),
			'date'       => __( 'Received', 'brightsmile-appointments' ),
		);
	}
);

add_action(
	'manage_bs_message_posts_custom_column',
	function ( $column, $post_id ) {
		if ( 'bs_excerpt' === $column ) {
			echo esc_html( wp_trim_words( get_post_meta( $post_id, '_bs_message', true ), 16 ) );
		} elseif ( 'bs_contact' === $column ) {
			$email = get_post_meta( $post_id, '_bs_email', true );
			echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a><br>' . esc_html( get_post_meta( $post_id, '_bs_phone', true ) );
		}
	},
	10,
	2
);

add_action(
	'add_meta_boxes_bs_message',
	function () {
		add_meta_box(
			'bsa_message',
			__( 'Message', 'brightsmile-appointments' ),
			function ( $post ) {
				$email = get_post_meta( $post->ID, '_bs_email', true );
				echo '<table class="bsa-details">';
				echo '<tr><th>' . esc_html__( 'Name', 'brightsmile-appointments' ) . '</th><td>' . esc_html( get_post_meta( $post->ID, '_bs_name', true ) ) . '</td></tr>';
				echo '<tr><th>' . esc_html__( 'Email', 'brightsmile-appointments' ) . '</th><td><a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a></td></tr>';
				echo '<tr><th>' . esc_html__( 'Phone', 'brightsmile-appointments' ) . '</th><td>' . esc_html( get_post_meta( $post->ID, '_bs_phone', true ) ) . '</td></tr>';
				echo '<tr><th>' . esc_html__( 'Topic', 'brightsmile-appointments' ) . '</th><td>' . esc_html( get_post_meta( $post->ID, '_bs_subject', true ) ) . '</td></tr>';
				echo '</table><div class="bsa-message">' . esc_html( get_post_meta( $post->ID, '_bs_message', true ) ) . '</div>';
				echo '<p><a class="button button-primary" href="mailto:' . esc_attr( $email ) . '">' . esc_html__( 'Reply by email', 'brightsmile-appointments' ) . '</a></p>';
			},
			'bs_message',
			'normal',
			'high'
		);
	}
);
