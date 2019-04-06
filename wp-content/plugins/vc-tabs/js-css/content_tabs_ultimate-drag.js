jQuery(function () {
    jQuery("#content-tabs-ultimate-drag-submit").submit(function (e) {
        var list_sortable = jQuery('#content-tabs-ultimate-drag-drop').sortable('toArray').toString();
        var security = jQuery('#vc-tabs-ajax-nonce').val();
        jQuery.post({
            url: content_tabs_ultimate_drag_drop_ajax.ajaxurl,
            beforeSend: function () {
                jQuery("#content-tabs-ultimate-drag-saving").slideDown();
                jQuery("#content-tabs-ultimate-drag-drop").slideUp();
                jQuery("#content-tabs-ultimate-drag-and-drop-data-close").slideUp();
                jQuery('#content-tabs-ultimate-drag-and-drop-data-submit').val('Saving...');
            },
            data: {
                action: 'content_tabs_ultimate_admin_ajax_data',
                list_order: list_sortable,
                security: security
            },
            success: function () {
                setTimeout(function () {
                     location.reload();
                }, 500);
            }
        });
        e.preventDefault();
        return false;
    });
});
  