( function( api ) {

	// Extends our custom "clean-biz" section.
	api.sectionConstructor['clean-biz'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );
	jQuery( "#accordion-panel-clean-biz-theme-options" ).addClass( "custom-class" );

} )( wp.customize );
