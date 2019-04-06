<?php

// If this file is called directly, abort.
if(!defined('WPINC')) {
	die;
}

$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );

?>
<div class="wrap imagelinks">
	<?php require 'page-info.php'; ?>
	<div class="imagelinks-page-header">
		<div class="imagelinks-title"><?php _e('ImageLinks Settings', IMAGELINKS_PLUGIN_NAME); ?></div>
	</div>
	<div class="imagelinks-messages" id="imagelinks-messages">
	</div>
	<!-- imagelinks app -->
	<div id="imagelinks-app-settings" class="imagelinks-app" style="display:none;">
		<div class="imagelinks-loader-wrap">
			<div class="imagelinks-loader">
				<div class="imagelinks-loader-bar"></div>
				<div class="imagelinks-loader-bar"></div>
				<div class="imagelinks-loader-bar"></div>
				<div class="imagelinks-loader-bar"></div>
			</div>
		</div>
		<div class="imagelinks-wrap">
			<div class="imagelinks-workplace">
				<div class="imagelinks-main-tabs imagelinks-clear-fix">
					<div class="imagelinks-tab" al-attr.class.imagelinks-active="appData.ui.tabs.general" al-on.click="appData.fn.onTab(appData, 'general')"><?php _e('General', IMAGELINKS_PLUGIN_NAME); ?></div>
					<div class="imagelinks-tab" al-attr.class.imagelinks-active="appData.ui.tabs.actions" al-on.click="appData.fn.onTab(appData, 'actions')"><?php _e('Actions', IMAGELINKS_PLUGIN_NAME); ?></div>
					<div class="imagelinks-tab">
						<div class="imagelinks-button imagelinks-blue" al-on.click="appData.fn.saveConfig(appData);"><?php _e('Save', IMAGELINKS_PLUGIN_NAME); ?></div>
					</div>
				</div>
				<div class="imagelinks-main-data">
					<div al-if="appData.ui.tabs.general">
						<div class="imagelinks-stage">
							<div class="imagelinks-main-panel">
								<div class="imagelinks-data imagelinks-active">
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Choose a default theme for your custom javascript editor', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('JavaScript editor theme', IMAGELINKS_PLUGIN_NAME); ?></div>
										<select class="imagelinks-select" al-select="appData.config.themeJavaScript">
											<option al-option="null"><?php _e('default', IMAGELINKS_PLUGIN_NAME); ?></option>
											<option al-repeat="theme in appData.themes" al-option="theme.id">{{theme.title}}</option>
										</select>
									</div>
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Choose a default theme for your custom css editor', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('CSS editor theme', IMAGELINKS_PLUGIN_NAME); ?></div>
										<select class="imagelinks-select" al-select="appData.config.themeCSS">
											<option al-option="null"><?php _e('default', IMAGELINKS_PLUGIN_NAME); ?></option>
											<option al-repeat="theme in appData.themes" al-option="theme.id">{{theme.title}}</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div al-if="appData.ui.tabs.actions">
						<div class="imagelinks-stage">
							<div class="imagelinks-main-panel">
								<div class="imagelinks-data imagelinks-active">
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Delete all items from database', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-button imagelinks-red imagelinks-long" al-on.click="appData.fn.deleteAllData(appData, '. <?php _e('Do you really want to delete all data?', IMAGELINKS_PLUGIN_NAME); ?> . ');"><?php _e('Delete all data', IMAGELINKS_PLUGIN_NAME); ?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /end imagelinks app -->
</div>