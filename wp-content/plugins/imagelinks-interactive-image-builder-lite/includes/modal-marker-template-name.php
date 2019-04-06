<?php
// If this file is called directly, abort.
if(!defined('WPINC')) {
	die;
}
?>
<div id="imagelinks-modal-{{ modalData.id }}" class="imagelinks-modal" tabindex="-1">
	<div class="imagelinks-modal-dialog">
		<div class="imagelinks-modal-header">
			<div class="imagelinks-modal-close" al-on.click="modalData.deferred.resolve('close');">&times;</div>
			<div class="imagelinks-modal-title"><?php _e('Save the marker as a template', IMAGELINKS_PLUGIN_NAME); ?></div>
		</div>
		<div class="imagelinks-modal-data">
			<div class="imagelinks-control">
				<div class="imagelinks-helper" title="<?php _e('Sets a marker template name', IMAGELINKS_PLUGIN_NAME); ?>"></div>
				<div class="imagelinks-label"><?php _e('Template name', IMAGELINKS_PLUGIN_NAME); ?></div>
				<input class="imagelinks-text imagelinks-long" type="text" al-text="modalData.templateName">
			</div>
		</div>
		<div class="imagelinks-modal-footer">
			<div class="imagelinks-modal-btn imagelinks-modal-btn-close" al-on.click="modalData.deferred.resolve('close');"><?php _e('Close', IMAGELINKS_PLUGIN_NAME); ?></div>
			<div class="imagelinks-modal-btn imagelinks-modal-btn-create" al-on.click="modalData.deferred.resolve(true);"><?php _e('Save', IMAGELINKS_PLUGIN_NAME); ?></div>
		</div>
	</div>
</div>