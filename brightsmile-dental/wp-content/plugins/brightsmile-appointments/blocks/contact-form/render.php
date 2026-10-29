<?php
/**
 * Front-end markup of the Clinic Contact Form block.
 *
 * @var array $attributes Block attributes.
 * @package BrightSmileAppointments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$state    = bsa_form_state( 'contact' );
$subjects = bsa_lines( $attributes['subjects'] );
$uid      = 'bs-contact-' . wp_unique_id();
$old      = function ( $key, $fallback = '' ) use ( $state ) {
	return bsa_old( $state, $key, $fallback );
};
?>
<div <?php echo get_block_wrapper_attributes( array( 'id' => 'bs-contact-form' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php echo bsa_notice( $state, $attributes['successMessage'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<form class="bs-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<?php echo bsa_hidden_fields( 'contact' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<div class="bs-form__grid">
			<p class="bs-field">
				<label for="<?php echo esc_attr( $uid ); ?>-name"><?php esc_html_e( 'Your name', 'brightsmile-appointments' ); ?> <span class="bs-req">*</span></label>
				<input type="text" id="<?php echo esc_attr( $uid ); ?>-name" name="bs_name" required autocomplete="name" value="<?php echo esc_attr( $old( 'name' ) ); ?>" />
			</p>
			<p class="bs-field">
				<label for="<?php echo esc_attr( $uid ); ?>-email"><?php esc_html_e( 'Email', 'brightsmile-appointments' ); ?> <span class="bs-req">*</span></label>
				<input type="email" id="<?php echo esc_attr( $uid ); ?>-email" name="bs_email" required autocomplete="email" value="<?php echo esc_attr( $old( 'email' ) ); ?>" />
			</p>
			<p class="bs-field">
				<label for="<?php echo esc_attr( $uid ); ?>-phone"><?php esc_html_e( 'Phone (optional)', 'brightsmile-appointments' ); ?></label>
				<input type="tel" id="<?php echo esc_attr( $uid ); ?>-phone" name="bs_phone" autocomplete="tel" value="<?php echo esc_attr( $old( 'phone' ) ); ?>" />
			</p>
			<p class="bs-field">
				<label for="<?php echo esc_attr( $uid ); ?>-subject"><?php esc_html_e( 'Topic', 'brightsmile-appointments' ); ?></label>
				<select id="<?php echo esc_attr( $uid ); ?>-subject" name="bs_subject">
					<?php foreach ( $subjects as $subject ) : ?>
						<option value="<?php echo esc_attr( $subject ); ?>" <?php selected( $old( 'subject' ), $subject ); ?>><?php echo esc_html( $subject ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p class="bs-field bs-field--full">
				<label for="<?php echo esc_attr( $uid ); ?>-message"><?php esc_html_e( 'Message', 'brightsmile-appointments' ); ?> <span class="bs-req">*</span></label>
				<textarea id="<?php echo esc_attr( $uid ); ?>-message" name="bs_message" rows="5" required><?php echo esc_textarea( $old( 'message' ) ); ?></textarea>
			</p>
		</div>
		<div class="bs-form__footer">
			<div class="wp-block-button"><button type="submit" class="wp-block-button__link wp-element-button"><?php echo esc_html( $attributes['buttonLabel'] ); ?></button></div>
		</div>
	</form>
</div>
