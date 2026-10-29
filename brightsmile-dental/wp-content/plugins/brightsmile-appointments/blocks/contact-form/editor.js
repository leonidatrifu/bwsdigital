/**
 * Editor UI for the Clinic Contact Form block (no build step required).
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var C = wp.components;
	var ServerSideRender = wp.serverSideRender;

	wp.blocks.registerBlockType( 'brightsmile/contact-form', {
		edit: function ( props ) {
			var a = props.attributes;
			var set = props.setAttributes;
			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						C.PanelBody,
						{ title: __( 'Form settings', 'brightsmile-appointments' ), initialOpen: true },
						el( C.TextareaControl, {
							label: __( 'Topics (one per line)', 'brightsmile-appointments' ),
							value: a.subjects,
							rows: 5,
							onChange: function ( v ) { set( { subjects: v } ); },
						} ),
						el( C.TextControl, {
							label: __( 'Button label', 'brightsmile-appointments' ),
							value: a.buttonLabel,
							onChange: function ( v ) { set( { buttonLabel: v } ); },
						} ),
						el( C.TextareaControl, {
							label: __( 'Success message', 'brightsmile-appointments' ),
							value: a.successMessage,
							onChange: function ( v ) { set( { successMessage: v } ); },
						} ),
						el( C.TextControl, {
							label: __( 'Send messages to', 'brightsmile-appointments' ),
							help: __( 'Leave empty to use the site admin email.', 'brightsmile-appointments' ),
							type: 'email',
							value: a.notificationEmail,
							onChange: function ( v ) { set( { notificationEmail: v } ); },
						} )
					)
				),
				el( C.Disabled, null, el( ServerSideRender, { block: 'brightsmile/contact-form', attributes: a } ) )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
