jQuery('#content-tabs-ultimate-drag-id').on('click', function () {
    jQuery("#content-tabs-ultimate-drag-and-drop-data").modal("show");
    jQuery("#content-tabs-ultimate-drag-saving").slideUp();
    jQuery("#content-tabs-ultimate-drag-drop").slideDown();
    jQuery("#content-tabs-ultimate-drag-and-drop-data-close").slideDown();
    jQuery('#content-tabs-ultimate-drag-and-drop-data-submit').val('Submit');

});

setTimeout(function () {
    jQuery('#content-tabs-ultimate-drag-drop').sortable({
        axis: 'y',
        opacity: 0.7
    });
}, 500);




