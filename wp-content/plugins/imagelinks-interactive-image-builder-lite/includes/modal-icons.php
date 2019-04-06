<?php
// If this file is called directly, abort.
if(!defined('WPINC')) {
	die;
}
?>
<div id="imagelinks-modal-{{ modalData.id }}" class="imagelinks-modal imagelinks-no-max-width" tabindex="-1">
	<div class="imagelinks-modal-dialog">
		<div class="imagelinks-modal-header">
			<div class="imagelinks-modal-close" al-on.click="modalData.deferred.resolve('close');">&times;</div>
			<div class="imagelinks-modal-title"><?php _e('Select an icon', IMAGELINKS_PLUGIN_NAME); ?></div>
		</div>
		<div class="imagelinks-modal-data imagelinks-modal-loading">
			<div class="imagelinks-modal-group">
				<div class="imagelinks-modal-icons">
					<div class="imagelinks-modal-icon" al-repeat="icon in modalData.icons" al-value="icon" al-on.click="modalData.fn.onClickIcon(modalData, $event, $element, $value)" al-on.dblclick="modalData.fn.onDblClickIcon(modalData)">
						<i class="fa {{modalData.fn.getIcon(modalData, icon)}}"></i><span>{{modalData.fn.getIconName(modalData, icon)}}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="imagelinks-modal-footer">
			<div class="imagelinks-modal-text"><?php _e('Selected icon:', IMAGELINKS_PLUGIN_NAME); ?> <b>{{modalData.selectedIcon}}</b></div>
			<div class="imagelinks-modal-btn imagelinks-modal-btn-close" al-on.click="modalData.deferred.resolve('close');"><?php _e('Close', IMAGELINKS_PLUGIN_NAME); ?></div>
			<div class="imagelinks-modal-btn imagelinks-modal-btn-create" al-on.click="modalData.deferred.resolve(true);"><?php _e('OK', IMAGELINKS_PLUGIN_NAME); ?></div>
		</div>
	</div>
</div>