/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'edge-color-scheme' ),
		colorSchemeKeys = [
		'site_page_nav_link_title_color',
		'edge_button_color',
		'edge_woocommerce_color',
		],
		colorSettings = [
		'site_page_nav_link_title_color',
		'edge_button_color',
		'edge_woocommerce_color',
		];

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {

					api( 'site_page_nav_link_title_color' ).set( colorScheme[value].colors[3] );
					api.control( 'site_page_nav_link_title_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'edge_button_color' ).set( colorScheme[value].colors[3] );
					api.control( 'edge_button_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'edge_woocommerce_color' ).set( colorScheme[value].colors[3] );
					api.control( 'edge_woocommerce_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api( 'color_scheme' )(), css,
			colors = _.object( colorSchemeKeys, colorScheme[ scheme ].colors );

		// Merge in color scheme overrides.
		_.each( colorSettings, function( setting ) {
			colors[ setting ] = api( setting )();
		});
		// Add additional colors.
		colors.site_page_nav_link_title_color = Color( colors.site_page_nav_link_title_color ).toCSS();
		colors.edge_button_color = Color( colors.edge_button_color ).toCSS();
		colors.edge_woocommerce_color = Color( colors.edge_woocommerce_color ).toCSS();
		css = cssTemplate( colors );
		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );
