<?php
/**
 * Front-end markup of the Appointment Form block.
 *
 * @var array $attributes Block attributes.
 * @package BrightSmileAppointments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$state    = bsa_form_state( 'appointment' );
$services = bsa_lines( $attributes['services'] );
$slots    = bsa_lines( $attributes['timeSlots'] );
$closed   = bsa_closed_day_names( $attributes['closedDays'] );
$uid      = 'bs-appt-' . wp_unique_id();
$old      = function ( $key, $fallback = '' ) use ( $state ) {
	return bsa_old( $state, $key, $fallback );
};
?>
<div <?php echo get_block_wrapper_attributes( array( 'id' => 'bs-appointment-form' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php echo bsa_notice( $state, $attributes['successMessage'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<form class="bs-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<?php echo bsa_hidden_fields( 'appointment' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<div class="bs-form__grid">
			<p class="bs-field">
				<label for="<?php echo esc_attr( $uid ); ?>-name"><?php esc_html_e( 'Full name', 'brightsmile-appointments' ); ?> <span class="bs-req">*</span></label>
				<input type="text" id="<?php echo esc_attr( $uid ); ?>-name" name="bs_name" required autocomplete="name" value="<?php echo esc_attr( $old( 'name' ) ); ?>" />
			</p>
			<p class="bs-field">
				<label for="<?php echo esc_attr( $uid ); ?>-phone"><?php esc_html_e( 'Phone', 'brightsmile-appointments' ); ?> <span class="bs-req">*</span></label>
				<input type="tel" id="<?php echo esc_attr( $uid ); ?>-phone" name="bs_phone" required autocomplete="tel" value="<?php echo esc_attr( $old( 'phone' ) ); ?>" />
			</p>
			<p class="bs-field bs-field--full">
				<label for="<?php echo esc_attr( $uid ); ?>-email"><?php esc_html_e( 'Email', 'brightsmile-appointments' ); ?> <span class="bs-req">*</span></label>
				<input type="email" id="<?php echo esc_attr( $uid ); ?>-email" name="bs_email" required autocomplete="email" value="<?php echo esc_attr( $old( 'email' ) ); ?>" />
			</p>
			<p class="bs-field bs-field--full">
				<label for="<?php echo esc_attr( $uid ); ?>-service"><?php esc_html_e( 'Treatment', 'brightsmile-appointments' ); ?> <span class="bs-req">*</span></label>
				<select id="<?php echo esc_attr( $uid ); ?>-service" name="bs_service" required>
					<option value=""><?php esc_html_e( 'Choose a treatment…', 'brightsmile-appointments' ); ?></option>
					<?php foreach ( $services as $service ) : ?>
						<option value="<?php echo esc_attr( $service ); ?>" <?php selected( $old( 'service' ), $service ); ?>><?php echo esc_html( $service ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p class="bs-field">
				<label for="<?php echo esc_attr( $uid ); ?>-date"><?php esc_html_e( 'Preferred date', 'brightsmile-appointments' ); ?> <span class="bs-req">*</span></label>
				<input type="date" id="<?php echo esc_attr( $uid ); ?>-date" name="bs_date" required min="<?php echo esc_attr( wp_date( 'Y-m-d' ) ); ?>" value="<?php echo esc_attr( $old( 'date' ) ); ?>" />
			</p>
			<p class="bs-field">
				<label for="<?php echo esc_attr( $uid ); ?>-time"><?php esc_html_e( 'Preferred time', 'brightsmile-appointments' ); ?> <span class="bs-req">*</span></label>
				<select id="<?php echo esc_attr( $uid ); ?>-time" name="bs_time" required>
					<option value=""><?php esc_html_e( 'Choose a time…', 'brightsmile-appointments' ); ?></option>
					<?php foreach ( $slots as $slot ) : ?>
						<option value="<?php echo esc_attr( $slot ); ?>" <?php selected( $old( 'time' ), $slot ); ?>><?php echo esc_html( $slot ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<fieldset class="bs-field bs-field--full bs-choice">
				<legend><?php esc_html_e( 'Have you visited us before?', 'brightsmile-appointments' ); ?></legend>
				<label><input type="radio" name="bs_patient" value="new" <?php checked( 'returning' !== $old( 'patient' ) ); ?> /> <?php esc_html_e( 'I’m a new patient', 'brightsmile-appointments' ); ?></label>
				<label><input type="radio" name="bs_patient" value="returning" <?php checked( 'returning', $old( 'patient' ) ); ?> /> <?php esc_html_e( 'I’m a returning patient', 'brightsmile-appointments' ); ?></label>
			</fieldset>
			<?php if ( $attributes['showNotes'] ) : ?>
				<p class="bs-field bs-field--full">
					<label for="<?php echo esc_attr( $uid ); ?>-notes"><?php esc_html_e( 'Anything we should know? (optional)', 'brightsmile-appointments' ); ?></label>
					<textarea id="<?php echo esc_attr( $uid ); ?>-notes" name="bs_notes" rows="4" placeholder="<?php esc_attr_e( 'e.g. tooth sensitivity, anxiety, preferred dentist…', 'brightsmile-appointments' ); ?>"><?php echo esc_textarea( $old( 'notes' ) ); ?></textarea>
				</p>
			<?php endif; ?>
			<p class="bs-field bs-field--full bs-choice">
				<label><input type="checkbox" name="bs_consent" value="1" required /> <?php esc_html_e( 'I agree to be contacted by phone or email about this request.', 'brightsmile-appointments' ); ?></label>
			</p>
		</div>
		<div class="bs-form__footer">
			<div class="wp-block-button"><button type="submit" class="wp-block-button__link wp-element-button"><?php echo esc_html( $attributes['buttonLabel'] ); ?></button></div>
			<?php if ( $closed ) : ?>
				<p class="bs-form__note">
					<?php
					/* translators: %s: list of weekdays */
					echo esc_html( sprintf( __( 'Closed on %s. Your time is a preference — we confirm every request personally.', 'brightsmile-appointments' ), implode( ', ', $closed ) ) );
					?>
				</p>
			<?php endif; ?>
		</div>
	</form>
</div>
