 /**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {
	
	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);
	
	$('.of-color').wpColorPicker();
	
	// Switches option sections
	$('.group').hide();
	var active_tab = '';
	if (typeof(localStorage) != 'undefined' ) {
		active_tab = localStorage.getItem("active_tab");
	}
	if (active_tab != '' && $(active_tab).length ) {
		$(active_tab).fadeIn();
	} else {
		$('.group:first').fadeIn();
	}
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
						return false;
					}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});
	if (active_tab != '' && $(active_tab + '-tab').length ) {
		$(active_tab + '-tab').addClass('nav-tab-active');
	}
	else {
		$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
	}
	
	$('.nav-tab-wrapper a').click(function(evt) {
		$('.nav-tab-wrapper a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("active_tab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
		
		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function() {
			var editor_iframe = $(this).find('iframe');
			if ( editor_iframe.height() < 30 ) {
				editor_iframe.css({'height':'auto'});
			}
		});
	
	});
           					
	$('.group .collapsed input:checkbox').click(unhideHidden);
				
	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;		
					}
				$(this).addClass('hidden');
			});
           					
		}
	}
	
	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parents('.controls').find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');		
	});

	// Clear selection if image removed
	$('.section-background_img').on('click', 'a.remove-image, input.button', function(e) {
		e.preventDefault();
		$(this).parents('.controls').find('.of-radio-img-img').removeClass('of-radio-img-selected');
	});

	// radio image label onclick event handler
	$('.of-radio-img-label').on('click', function(e) {
		e.preventDefault();
		$(this).siblings('.of-radio-img-img').trigger('click');
	});

	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	/* Web fonts ( BETA )
	 * Php source located in options-interface.php 'web_fonts'
	 */

	function dt_is_font_web_safe( font ) {
		var safeFonts = [
				'Andale Mono',
				'Arial',
				'Arial:600',
				'Arial:400italic',
				'Arial:600italic',
				'Arial Black',
				'Comic Sans MS',
				'Comic Sans MS:600',
				'Courier New',
				'Courier New:600',
				'Courier New:400italic',
				'Courier New:600italic',
				'Georgia',
				'Georgia:600',
				'Georgia:400italic',
				'Georgia:600italic',
				'Impact Lucida Console',
				'Lucida Sans Unicode',
				'Marlett',
				'Minion Web',
				'Symbol',
				'Times New Roman',
				'Times New Roman:600',
				'Times New Roman:400italic',
				'Times New Roman:600italic',
				'Tahoma',
				'Trebuchet MS',
				'Trebuchet MS:600',
				'Trebuchet MS:400italic',
				'Trebuchet MS:600italic',
				'Verdana',
				'Verdana:600',
				'Verdana:400italic',
				'Verdana:600italic',
				'Webdings'
			];

		if ( -1 == safeFonts.indexOf( font ) ) {
			return false;
		}

		return true;
	}
	
	// Preview
	if ( $( ".of-input.dt-web-fonts" ).length > 0 ) {
		$( ".of-input.dt-web-fonts" ).on( "change", function() {
			var _this = $( this ),
				id = _this.attr( "id" ),
				value = _this.val(),
				font_header = value.replace( / /g, "+" ),
				font_style = value.split( "&" )[0],
				_preview = _this.siblings('.dt-web-fonts-preview').first().find('span').first(),
				italic = bold = '';

			font_style = font_style.split( ":" );
			
			if ( font_style[1] ) {
				var vars = font_style[1].split( 'italic' );
				
				if ( 2 == vars.length ) { italic = "font-style: italic;"; }
				
				if ( '700' == vars[0] || 'bold' == vars[0] ) {
					bold = "font-weight: bold;";
				} else if ( '400' == vars[0] || 'normal' == vars[0] ) {
					bold = "font-weight: normal;";
				} else if ( vars[0] ) {
					bold = "font-weight: " + parseInt( vars[0] ) + "};";
				} else {
					bold = "font-weight: normal;";
				}

			}else {
				bold = "font-weight: normal;";
			}
			
			var linkHref = 'http://fonts.googleapis.com/css?family=' + font_header,
				linkStyle = 'font-family: "' + font_style[0] + '";' + italic + bold;

			var style = '<link id="' + id + '-font-preview" href="' + linkHref + '" rel="stylesheet" type="text/css">';
			
			_preview.hide();

			$('#' + id + '-font-preview').remove();
			
			if ( !dt_is_font_web_safe( value ) ) {
				$('head').append( style );
			}

			_preview.attr('style', linkStyle).show();
		} );
		$( ".of-input.dt-web-fonts" ).trigger( 'change' );
	}
	/* End Web fonts */
	
    // of_fields_generator script
	
	if ( jQuery('#optionsframework .of_fields_gen_list').length > 0 ) {
		jQuery('#optionsframework .of_fields_gen_list').sortable();
	}

	// add button
    jQuery('button.of_fields_gen_add').click(function(e) {
    	e.preventDefault();

        var container = jQuery(this).parent().prev('.of_fields_gen_list'),
        	layout = jQuery(this).parents('div.of_fields_gen_controls'),
        	del_link = '<div class="submitbox"><a href="#" class="of_fields_gen_del submitdelete">Delete</a></div>';

        if ( !layout.find('.of_fields_gen_title').val() ) return false;
        
		var size = 0;
		container.find('div.of_fields_gen_title').each( function(){
			var index = parseInt(jQuery(this).attr('data-index'));
			if( index >= size )
				size = index;
		});
		size += 1;

        var new_block = layout.clone();
        new_block.find('button.of_fields_gen_add').detach();
        new_block
            .attr('class', '')
            .addClass('of_fields_gen_data menu-item-settings description')
			.append(del_link);
        
		var title = jQuery('<span class="dt-menu-item-title">').text( jQuery('.of_fields_gen_title', new_block).val() );
		var div_title = jQuery('<div class="of_fields_gen_title menu-item-handle" data-index="' + size + '"><span class="item-controls"><a class="item-edit" title="Edit Widgetized Area"></a></span></div>');
		
        new_block.find('input, textarea').each(function(){
            var name = jQuery(this).attr('name').toString();
            
            // this line must be awful, simple horror
            jQuery(this).val(layout.find('input[name="'+name+'"], textarea[name="'+name+'"]').val());
            
            name = name.replace("][", "]["+ size +"][");
            jQuery(this).attr('name', name);
			
			var hidden_desc = jQuery(this).next('.dt-hidden-desc');

			if( 'checkbox' == jQuery(this).attr('type') && jQuery(this).attr('checked') && hidden_desc ) {
				div_title.prepend( hidden_desc.clone().removeClass('dt-hidden-desc') );
			}
        });
        container.append(new_block);
		
		div_title.prepend(title);
		
        new_block
            .wrap('<li class="nav-menus-php"></li>')
            .before(div_title);
        
		new_block.hide();
        del_button();
        checkbox_check();
		
		jQuery('.item-edit', div_title).click(function(event) {
			if( jQuery(event.target).parents('.of_fields_gen_title').is('div.of_fields_gen_title') ) {
				jQuery(event.target).parents('.of_fields_gen_title').next('div.of_fields_gen_data').toggle();
			}
		});
		
    });
    
	function del_button() {
		jQuery('.of_fields_gen_del').click(function() {
			var title_container = jQuery(this).parents('li').find('div.of_fields_gen_title');
			title_container.next('div.of_fields_gen_data').hide().detach();
			title_container.hide('slow').detach();
			return false;
		});
	}
	del_button();
		
	function toggle_button() { 
		jQuery('.item-edit').click(function(event) {
			if( jQuery(event.target).parents('.of_fields_gen_title').is('div.of_fields_gen_title') ) {
				jQuery(event.target).parents('.of_fields_gen_title').next('div.of_fields_gen_data').toggle();
			}
		});
	}
	toggle_button();
    
	function checkbox_check() {
		jQuery('.of_fields_gen_data input[type="checkbox"]').on('change', function() {
			var this_ob = jQuery(this);
			var hidden_desc = this_ob.next('.dt-hidden-desc');
			if( !hidden_desc.length ) return true;
			hidden_desc = hidden_desc.clone().removeClass('dt-hidden-desc');
			
			var div_title = jQuery(event.target)
                .parents('div.of_fields_gen_data')
                .prev('div.of_fields_gen_title')
				.children('.dt-menu-item-title');
			
			if( this_ob.attr('checked') ) {
				div_title.after( hidden_desc );
			}else {
				div_title.parent().find('.' + hidden_desc.attr('class')).remove();
			}
			
		});
	}
	checkbox_check();

	// on load indication
	jQuery('.section-fields_generator .nav-menus-php').each( function() {
		var title = jQuery('.dt-menu-item-title', jQuery(this));
		
		jQuery('input[type="checkbox"]:checked', jQuery(this)).each( function() {
			var hidden_desc = jQuery(this).next('.dt-hidden-desc');
			if( hidden_desc.length ) {
				var new_desc = hidden_desc.clone();
				title.after( new_desc.removeClass('dt-hidden-desc') );
			}
		});
	});

    jQuery('div.controls').change(function(event) {
        if( jQuery(event.target).not('div').is('.of_fields_gen_title') ) {
            var title = jQuery(event.target)
                .parents('div.of_fields_gen_data')
                .prev('div.of_fields_gen_title')
				.children('.dt-menu-item-title');
				
			if( title ) {
				title.text( jQuery(event.target).val() );
			}
        }
    });
    // of_fields_generator end

    /**
     * New Fields Generator.
     */
/*
    jQuery('#section-widgetareas .controls').each(function(){
    	var $this = jQuery(this),
    		$list = jQuery('.of_fields_gen_list', $this),
    		$fields = jQuery('.of_fields_gen_controls', $this);

    	// Add button
    	$list.find('li.fgens-add-new').on('click', function(e){
    		var _this = jQuery(this);

    		$list.find('li.act').removeClass('act');

    		// Add empty field
    		_this.before('<li class="act"><div class="of_fields_gen_title menu-item-handle"><span class="dt-menu-item-title">New Sidebar</span></div></li>');

    		// Clear fields
    		$fields.find('#widgetareas-name').val('New Sidebar');
    		$fields.find('#widgetareas-description').val('');

    		// Change button description here
    	});

    	// Update
    	$fields.find('#widgetareas-add').on('click', function(e){
    		e.preventDefault();

    		var $list = jQuery('.of_fields_gen_list', $this),
    			$current = $list.find('li.act'),
    			id = $current.find('div.of_fields_gen_title').attr('data-id'),
    			title = $fields.find('#widgetareas-name').val(),
    			desc = $fields.find('#widgetareas-description').val();

    		jQuery.post(
    			optionsframework.ajaxurl,
    			{
    				action: 'process_widgetarea',
    				type: 'update',
    				waNonce: optionsframework.optionsNonce,
    				waId: id,
    				waTitle: title,
    				waDesc: desc
    			},
    			function(responce) {
    				console.log(responce);
    				if ( responce.success ) {

    					if ( responce.id ) {
    						$current.find('div.of_fields_gen_title').attr('data-id', responce.id);
    					}

    				}
    			}
    		);
    	});

    	// Select
    	$list.on('click', 'li:not(.fgens-add-new)', function(e){
    		var _this = jQuery(this),
    			title = _this.find('span.dt-menu-item-title').text(),
    			id = _this.find('div.of_fields_gen_title').attr('data-id');

    		// Make item corrent
    		if ( !_this.hasClass('act') ) {
    			$list.find('li.act').removeClass('act');
    			_this.addClass('act');
    		}

    		// Current title
    		$fields.find('#widgetareas-name').val(title);

    		jQuery.post(
    			optionsframework.ajaxurl,
    			{
    				action: 'process_widgetarea',
    				type: 'get',
    				waNonce: optionsframework.optionsNonce,
    				waId: id
    			},
    			function(responce) {
    				console.log(responce);
    				if ( responce.success ) {

    					if ( responce.desc ) {
    						$fields.find('#widgetareas-description').val(responce.desc);
    					}

    				} else {
    					$fields.find('#widgetareas-description').val('');

    					// Change button description here
    				}
    			}
    		);

    	});

    });
*/
    /*
     * slider
     */
    jQuery( ".of-slider" ).each(function() {
        var data = jQuery(this).next('input.of-slider-value');
        var value = data.attr('data-value');
        var min = data.attr('data-min');
        var max = data.attr('data-max');
        var step = data.attr('data-step');

        if( data.length ) {
            jQuery(this).slider({
		        value: parseInt(value),
		        min: parseInt(min),
		        max: parseInt(max),
		        step: parseInt(step),
                range: 'min',
		        slide: function( event, ui ) {
			        data.val( ui.value );
		        }
	        });
            data.val(jQuery(this).slider('option', 'value'));
        }
    });

    // js_hide
    jQuery('#optionsframework .of-js-hider').each(function() {
        var element = jQuery(this),
        	target = element.closest('.section').next('.of-js-hide');

        /* If checkbox */
        if ( element.is('input[type="checkbox"]') ) {
        	element.on('click', function(){
        		target.fadeToggle(400);
        	});

        	if(element.prop('checked')) {
        		target.show();
        	}
        /* If slider */
        } else if ( element.hasClass('of-slider') ) {
        	if(element.hasClass('js-hide-if-not-max')){
        		element.on('slidechange', function(e, ui){
        			var $this = jQuery(this);

        			if(ui.value != $this.slider('option', 'max')) {
        				target.show();
        			} else {
        				target.hide(400);
        			}
        		});
        		if(element.slider('option', 'value') != element.slider('option', 'max')) {
        			target.show();
        		}
        	}
        /* If radio */
        } else if ( element.is('input[type="radio"]') ) {
        	element.on('click', function(){
        		if ( $(this).hasClass('js-hider-show') ) {
        			target.show();
        		} else {
        			target.hide();
        		}
        	});

        	if(element.prop('checked')) {
        		element.click();
        	}
        }
        
    });
	
	// js_hide_global
    jQuery('#optionsframework input[type="checkbox"].of-js-hider-global').click(function() {
        var element = jQuery(this);
        element.parents('.section-block_begin').next('.of-js-hide').fadeToggle(400);
    });
    
    jQuery('#optionsframework input[type="checkbox"]:checked.of-js-hider-global').each(function(){
        var element = jQuery(this);
        element.parents('.section-block_begin').next('.of-js-hide').show();
    });

    // Share buttons
    jQuery( "#optionsframework .section-social_buttons .connectedSortable" ).sortable({
      connectWith: ".connectedSortable",
      placeholder: "of-socbuttons-highlight",
      cancel: "li.ui-dt-sb-hidden"
    }).disableSelection();

    jQuery('#optionsframework .section-social_buttons .content-holder.connectedSortable').on('sortupdate', function(e, ui) {
    	var $input = ui.item.find('input[type="hidden"]'),
    		$this = jQuery(this);

    	$input.attr('name', $input.attr('data-name'));
    });

    jQuery('#optionsframework .section-social_buttons .tools-palette.connectedSortable').on('sortupdate', function( e, ui) {
    	var $input = ui.item.find('input[type="hidden"]');
    	$input.removeAttr('name');
    });

    /* Theme scripts */

    // headers layout
    jQuery('#optionsframework #section-header-layout .controls input.of-radio-img-radio').on('click', function(e) {
    	var $this = jQuery(this),
    		$target = $this.parents('.section-block_begin');
		
		// hide
		$target.find('.of-js-hide.header-layout').hide();
    	
		// show
    	if ( $this.prop('checked') ) {
    		$target.find('.of-js-hide.header-layout-'+$this.val()).show();
    	}
    });
    jQuery('#optionsframework #section-header-layout .controls input:checked.of-radio-img-radio').trigger('click');

});

/* Web fonts (beta) */
// Refresh
function dtWebfontsRefresh ( id, nonce ) {
	var $fontsList = jQuery( '#' + id ),
		$ajaxLoader = $fontsList.siblings( '#' + id + '-ajax-loading' );
	
	// lunch ajax loader
	$ajaxLoader.show();
	
	if( ajaxurl ) {
		jQuery.ajax({
			type: "POST",
			url: ajaxurl,
			data: { action: "dt_refresh_web_fonts", nonce: nonce }
		}).done(function( msg ) {
			
			if ( msg ) {
				
				// get fonts list and selected option
				var $errorsContainer = $fontsList.siblings( '.dt-web-fonts-error-block' ),
					$selectedOption = jQuery( 'option[value="' + $fontsList.val() + '"]', $fontsList ),
					$msg = jQuery( msg.toString() );
				
				if ( $msg.length > 0 ) {
					// replace old options with new one
					$fontsList.html( jQuery( $msg[0] ).find( 'select' ).html() );
				}
				
				if ( $msg.length > 1 ) {
					var errors = jQuery( $msg[1] ).find( '.dt-web-fonts-error-block' ).html();
					if ( errors ) {
						// add errors
						$errorsContainer.html( errors );
					} else {
						// clear errors
						$errorsContainer.html( '' );
					}
				}

				// if there was selected font - make it so again
				jQuery( 'option[value="' + $selectedOption.val() + '"]', $fontsList ).attr( 'selected', 'selected' );
				
				// trigger change to renew prewiev
				$fontsList.trigger( 'change' );
				
				// stop ajax loader
				$ajaxLoader.hide();
			}
		});
	}
	
	return false;
}

function dtRadioImagesSetCheckbox( target ) {
	document.getElementById(target).checked=true;
	jQuery('#'+target).trigger('click');
}

/**
 * Background image preset images.
 */
jQuery(function($){
	$('.section-background_img .of-radio-img-img').on('click', function() {
		var selector = $(this).parents('.section-background_img'),
			attachment = $(this).attr('data-full-src'),
			preview = $(this).attr('src');

		selector.find('.upload').val(attachment);
		selector.find('.upload-id').val(0);
		
		selector.find('.screenshot').empty().hide().append('<img src="' + attachment + '"><a class="remove-image">Remove</a>').slideDown('fast');
		
		selector.find('.upload-button').unbind().addClass('remove-file').removeClass('upload-button').val(optionsframework_l10n.remove);
		selector.find('.of-background-properties').slideDown();
		
		optionsframework_file_bindings(selector);
	});
});