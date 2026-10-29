/**
 * Editor UI for the Appointment Form block (no build step required).
 * The preview is rendered by PHP; settings live in the block sidebar.
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var C = wp.components;
	var ServerSideRender = wp.serverSideRender;
	var DAYS = [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ];

	wp.blocks.registerBlockType( 'brightsmile/appointment-form', {
		edit: function ( props ) {
			var a = props.attributes;
			var set = props.setAttributes;
			var closed = a.closedDays || [];

			function toggleDay( day, isClosed ) {
				var next = closed.filter( function ( d ) { return d !== day; } );
				if ( isClosed ) { next.push( day ); }
				set( { closedDays: next.sort() } );
			}

			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						C.PanelBody,
						{ title: __( 'Treatments & times', 'brightsmile-appointments' ), initialOpen: true },
						el( C.TextareaControl, {
							label: __( 'Treatments (one per line)', 'brightsmile-appointments' ),
							value: a.services,
							rows: 8,
							onChange: function ( v ) { set( { services: v } ); },
						} ),
						el( C.TextareaControl, {
							label: __( 'Time slots (one per line)', 'brightsmile-appointments' ),
							value: a.timeSlots,
							rows: 6,
							onChange: function ( v ) { set( { timeSlots: v } ); },
						} ),
						el( 'p', { className: 'components-base-control__label' }, __( 'Closed on', 'brightsmile-appointments' ) ),
						DAYS.map( function ( name, i ) {
							return el( C.CheckboxControl, {
								key: name,
								label: name,
								checked: closed.indexOf( i ) !== -1,
								onChange: function ( v ) { toggleDay( i, v ); },
							} );
						} )
					),
					el(
						C.PanelBody,
						{ title: __( 'Form text', 'brightsmile-appointments' ), initialOpen: false },
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
						el( C.ToggleControl, {
							label: __( 'Show “Anything we should know?” field', 'brightsmile-appointments' ),
							checked: a.showNotes,
							onChange: function ( v ) { set( { showNotes: v } ); },
						} )
					),
					el(
						C.PanelBody,
						{ title: __( 'Notifications', 'brightsmile-appointments' ), initialOpen: false },
						el( C.TextControl, {
							label: __( 'Send requests to', 'brightsmile-appointments' ),
							help: __( 'Leave empty to use the site admin email.', 'brightsmile-appointments' ),
							type: 'email',
							value: a.notificationEmail,
							onChange: function ( v ) { set( { notificationEmail: v } ); },
						} ),
						el( C.ToggleControl, {
							label: __( 'Email the patient a confirmation', 'brightsmile-appointments' ),
							checked: a.sendConfirmation,
							onChange: function ( v ) { set( { sendConfirmation: v } ); },
						} )
					)
				),
				el( C.Disabled, null, el( ServerSideRender, { block: 'brightsmile/appointment-form', attributes: a } ) )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
