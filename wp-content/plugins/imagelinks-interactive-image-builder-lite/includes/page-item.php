<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );
$author = get_the_author_meta('display_name', $item->author);
$modified = mysql2date(get_option('date_format'), $item->modified) . ' at ' . mysql2date(get_option('time_format'), $item->modified);

?>
<div class="wrap imagelinks">
	<?php require 'page-info.php'; ?>
	<div class="imagelinks-page-header">
		<div class="imagelinks-title"><?php _e('ImageLinks Item', IMAGELINKS_PLUGIN_NAME); ?></div>
		<div class="imagelinks-actions">
			<a href="?page=<?php echo IMAGELINKS_PLUGIN_NAME . '_item'; ?>"><?php _e('Add Item', IMAGELINKS_PLUGIN_NAME); ?></a>
		</div>
	</div>
	<div class="imagelinks-messages" id="imagelinks-messages">
	</div>
	<!-- vision app -->
	<div id="imagelinks-app-item" class="imagelinks-app" style="display:none;">
		<input id="imagelinks-load-config-from-file" type="file" style="display:none;" />
		<div class="imagelinks-loader-wrap">
			<div class="imagelinks-loader">
				<div class="imagelinks-loader-bar"></div>
				<div class="imagelinks-loader-bar"></div>
				<div class="imagelinks-loader-bar"></div>
				<div class="imagelinks-loader-bar"></div>
			</div>
		</div>
		<div class="imagelinks-wrap">
			<div class="imagelinks-main-header">
				<input class="imagelinks-title" type="text" al-text="appData.config.title" placeholder="<?php _e('Title', IMAGELINKS_PLUGIN_NAME); ?>">
			</div>
			<div class="imagelinks-workplace">
				<div class="imagelinks-markers-frame">
					<div class="imagelinks-markers-toolbar-creation">
						<i class="imagelinks-icon imagelinks-icon-plus" al-on.click="appData.fn.addMarker(appData)" title="<?php _e('Add marker', IMAGELINKS_PLUGIN_NAME); ?>"></i>
					</div>
					<div class="imagelinks-markers-toolbar-navigation" al-if="appData.config.markers.length > 0">
						<i class="imagelinks-icon imagelinks-icon-prev" al-on.click="appData.fn.prevMarker(appData)" title="<?php _e('Prev marker', IMAGELINKS_PLUGIN_NAME); ?>"></i>
						<i class="imagelinks-icon imagelinks-icon-next" al-on.click="appData.fn.nextMarker(appData)" title="<?php _e('Next marker', IMAGELINKS_PLUGIN_NAME); ?>"></i>
					</div>
					<div class="imagelinks-markers-toolbar-operations" al-if="appData.ui.activeMarker != null">
						<i class="imagelinks-icon imagelinks-icon-copy" al-on.click="appData.fn.copyMarker(appData)" title="<?php _e('Copy marker', IMAGELINKS_PLUGIN_NAME); ?>"></i>
						<i class="imagelinks-icon imagelinks-icon-style" al-on.click="appData.fn.editMarker(appData, appData.ui.activeMarker)" title="<?php _e('Edit marker', IMAGELINKS_PLUGIN_NAME); ?>"></i>
						<i class="imagelinks-icon imagelinks-icon-tooltip" al-attr.class.imagelinks-inactive="!appData.ui.activeMarker.tooltip.active" al-on.click="appData.fn.toggleMarkerTooltip(appData, appData.ui.activeMarker)" title="<?php _e('Enable/disable tooltip', IMAGELINKS_PLUGIN_NAME); ?>"></i>
						<i class="imagelinks-icon" al-attr.class.imagelinks-icon-eye="appData.ui.activeMarker.visible" al-attr.class.imagelinks-icon-eye-off="!appData.ui.activeMarker.visible" al-on.click="appData.fn.toggleMarkerVisible(appData, appData.ui.activeMarker)" title="<?php _e('Show/hide marker', IMAGELINKS_PLUGIN_NAME); ?>"></i>
						<i class="imagelinks-icon" al-attr.class.imagelinks-icon-lock-open="!appData.ui.activeMarker.lock" al-attr.class.imagelinks-icon-lock="appData.ui.activeMarker.lock" al-on.click="appData.fn.toggleMarkerLock(appData, appData.ui.activeMarker)" title="<?php _e('Lock/unlock marker', IMAGELINKS_PLUGIN_NAME); ?>"></i>
					</div>
					<div class="imagelinks-markers-toolbar-view">
						<i class="imagelinks-icon imagelinks-icon-zoom-in" al-on.click="appData.fn.canvasZoomIn(appData)" title="<?php _e('Zoom in', IMAGELINKS_PLUGIN_NAME); ?>"></i>
						<span class="imagelinks-zoom-value">{{appData.fn.getCanvasZoom(appData)}}%</span>
						<i class="imagelinks-icon imagelinks-icon-zoom-out" al-on.click="appData.fn.canvasZoomOut(appData)" title="<?php _e('Zoom out', IMAGELINKS_PLUGIN_NAME); ?>"></i>
						<i class="imagelinks-icon imagelinks-icon-zoom-default" al-on.click="appData.fn.canvasZoomDefault(appData)" title="<?php _e('Zoom default', IMAGELINKS_PLUGIN_NAME); ?>"></i>
						<i class="imagelinks-icon imagelinks-icon-zoom-fit" al-on.click="appData.fn.canvasZoomFit(appData)" title="<?php _e('Zoom fit', IMAGELINKS_PLUGIN_NAME); ?>"></i>
						<i class="imagelinks-icon imagelinks-icon-center" al-on.click="appData.fn.canvasMoveDefault(appData)" title="<?php _e('Move default', IMAGELINKS_PLUGIN_NAME); ?>"></i>
					</div>
					<div id="imagelinks-markers-canvas-wrap" class="imagelinks-markers-canvas-wrap" al-on.mousedown="appData.fn.onMoveCanvasStart(appData, $event)">
						<div id="imagelinks-markers-canvas" class="imagelinks-markers-canvas">
							<div id="imagelinks-markers-image" class="imagelinks-markers-image"></div>
							<div class="imagelinks-markers-stage">
								<div class="imagelinks-marker-pos"
									 al-attr.class.imagelinks-active="appData.fn.isMarkerActive(appData, marker)"
									 al-attr.class.imagelinks-hidden="!marker.visible"
									 al-attr.class.imagelinks-lock="marker.lock"
									 al-on.click="appData.fn.onMarkerClick(appData, marker)"
									 al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'drag', $event)"
									 al-style.top="appData.fn.getMarkerStyle(appData, marker, 'y')"
									 al-style.left="appData.fn.getMarkerStyle(appData, marker, 'x')"
									 al-style.transform="appData.fn.getMarkerStyle(appData, marker, 'angle')"
									 al-repeat="marker in appData.config.markers"
								>
									<div class="imagelinks-marker-wrap">
										<div class="imagelinks-marker-pulse" al-attr.class.imagelinks-active="marker.view.pulse.active">
										</div>
										<div class="imagelinks-marker"
											 tabindex="1"
											 al-on.keydown="appData.fn.onEditMarkerKeyDown(appData, marker, $event)"
											 al-style.width="appData.fn.getMarkerStyle(appData, marker, 'width')"
											 al-style.height="appData.fn.getMarkerStyle(appData, marker, 'height')"
											 al-init="appData.fn.initMarker(appData, marker, $element)"
										>
											<div class="imagelinks-marker-icon-wrap"
												 al-style.color="appData.fn.getIconStyle(appData, marker.view.icon, 'color')"
												 al-style.font-size="appData.fn.getIconStyle(appData, marker.view.icon, 'font-size')"
											>
												<div class="imagelinks-marker-icon" al-if="marker.view.icon.name"><i class="fa {{marker.view.icon.name}}"></i></div>
												<div class="imagelinks-marker-icon-label" al-if="marker.view.icon.label">{{marker.view.icon.label}}</div>
											</div>
										</div>
										<div class="imagelinks-marker-outline">
										</div>
										<div class="imagelinks-marker-resizer">
											<div class="imagelinks-marker-coord">X: {{appData.fn.getMarkerCoord(appData, marker, 'x')}} <br>Y: {{appData.fn.getMarkerCoord(appData, marker, 'y')}} <br>L: {{appData.fn.getMarkerCoord(appData, marker, 'angle')}}°</div>
											<div class="imagelinks-marker-rotator" al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'rotate', $event)">
												<div class="imagelinks-marker-line"></div>
											</div>
											<div class="imagelinks-marker-dragger-tl" al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'tl', $event)" al-if="!marker.autoWidth && !marker.autoHeight"></div>
											<div class="imagelinks-marker-dragger-tm" al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'tm', $event)" al-if="!marker.autoHeight"></div>
											<div class="imagelinks-marker-dragger-tr" al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'tr', $event)" al-if="!marker.autoWidth && !marker.autoHeight"></div>
											<div class="imagelinks-marker-dragger-rm" al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'rm', $event)" al-if="!marker.autoWidth"></div>
											<div class="imagelinks-marker-dragger-br" al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'br', $event)" al-if="!marker.autoWidth && !marker.autoHeight"></div>
											<div class="imagelinks-marker-dragger-bm" al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'bm', $event)" al-if="!marker.autoHeight"></div>
											<div class="imagelinks-marker-dragger-bl" al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'bl', $event)" al-if="!marker.autoWidth && !marker.autoHeight"></div>
											<div class="imagelinks-marker-dragger-lm" al-on.mousedown="appData.fn.onEditMarkerStart(appData, marker, 'lm', $event)" al-if="!marker.autoWidth"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="imagelinks-main-menu">
					<div class="imagelinks-left-panel">
						<a class="imagelinks-version-lite" href="https://1.envato.market/MAWdq" al-if="appData.plan=='lite'"><?php _e('Buy Pro version', IMAGELINKS_PLUGIN_NAME); ?></a>
						<a class="imagelinks-version-pro" href="#" al-if="appData.plan=='pro'"><?php _e('Pro Version', IMAGELINKS_PLUGIN_NAME); ?></a>
					</div>
					<div class="imagelinks-right-panel">
						<div class="imagelinks-item">
							<i class="imagelinks-icon imagelinks-icon-menu"></i>
							<div class="imagelinks-menu-list">
								<a href="#" al-on.click="appData.fn.loadConfigFromFile(appData)"><i class="imagelinks-icon imagelinks-icon-from-file"></i><?php _e('Load Config From File', IMAGELINKS_PLUGIN_NAME); ?></a>
								<a href="#" al-on.click="appData.fn.saveConfigToFile(appData)"><i class="imagelinks-icon imagelinks-icon-to-file"></i><?php _e('Save Config To File', IMAGELINKS_PLUGIN_NAME); ?></a>
								<a href="#" al-on.click="appData.fn.selectImportItem(appData)" al-if="appData.import_items"><i class="imagelinks-icon imagelinks-icon-download"></i><?php _e('Import Config', IMAGELINKS_PLUGIN_NAME); ?></a>
							</div>
						</div>
						<div class="imagelinks-item" al-on.click="appData.fn.toggleFullscreen(appData)">
							<i class="imagelinks-icon imagelinks-icon-size-fullscreen" al-if="!appData.ui.fullscreen"></i>
							<i class="imagelinks-icon imagelinks-icon-size-actual" al-if="appData.ui.fullscreen"></i>
						</div>
					</div>
				</div>
				<div class="imagelinks-main-tabs imagelinks-clear-fix">
					<div class="imagelinks-tab" al-attr.class.imagelinks-active="appData.ui.tabs.general" al-on.click="appData.fn.onTab(appData, 'general')"><?php _e('General', IMAGELINKS_PLUGIN_NAME); ?><div class="imagelinks-status" al-if="appData.config.active"></div></div>
					<div class="imagelinks-tab" al-attr.class.imagelinks-active="appData.ui.tabs.markers" al-on.click="appData.fn.onTab(appData, 'markers')"><?php _e('Markers', IMAGELINKS_PLUGIN_NAME); ?></div>
					<div class="imagelinks-tab" al-attr.class.imagelinks-active="appData.ui.tabs.customCSS" al-on.click="appData.fn.onTab(appData, 'customCSS')"><?php _e('Custom CSS', IMAGELINKS_PLUGIN_NAME); ?><div class="imagelinks-status" al-if="appData.config.customCSS.active"></div></div>
					<div class="imagelinks-tab" al-attr.class.imagelinks-active="appData.ui.tabs.customJS" al-on.click="appData.fn.onTab(appData, 'customJS')"><?php _e('Custom JS', IMAGELINKS_PLUGIN_NAME); ?><div class="imagelinks-status" al-if="appData.config.customJS.active"></div></div>
					<div class="imagelinks-tab" al-attr.class.imagelinks-active="appData.ui.tabs.shortcode" al-on.click="appData.fn.onTab(appData, 'shortcode')" al-if="appData.wp_item_id"><?php _e('Shortcode', IMAGELINKS_PLUGIN_NAME); ?></div>
					<div class="imagelinks-tab">
						<div class="imagelinks-button imagelinks-green" al-on.click="appData.fn.preview(appData);" al-if="appData.wp_item_id" title="<?php _e('The item should be saved before preview', IMAGELINKS_PLUGIN_NAME); ?>"><?php _e('Preview', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-button imagelinks-blue" al-on.click="appData.fn.saveConfig(appData);"><?php _e('Save', IMAGELINKS_PLUGIN_NAME); ?></div>
					</div>
				</div>
				<div class="imagelinks-main-data">
					<div class="imagelinks-section" al-attr.class.imagelinks-active="appData.ui.tabs.general">
						<div class="imagelinks-stage">
							<div class="imagelinks-main-panel">
								<div class="imagelinks-data imagelinks-active">
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Enable/disable item', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Enable item', IMAGELINKS_PLUGIN_NAME); ?></div>
										<div al-toggle="appData.config.active"></div>
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Sets a main image (jpeg or png format)', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Main image', IMAGELINKS_PLUGIN_NAME); ?></div>
										<div class="imagelinks-input-group">
											<div class="imagelinks-input-group-cell">
												<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.config.image.url" placeholder="<?php _e('Select an image', IMAGELINKS_PLUGIN_NAME); ?>">
											</div>
											<div class="imagelinks-input-group-cell imagelinks-pinch">
												<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="appData.fn.selectImage(appData, appData.rootScope, appData.config.image)" title="<?php _e('Select an image', IMAGELINKS_PLUGIN_NAME); ?>"><span><i class="imagelinks-icon imagelinks-icon-select"></i></span></div>
											</div>
										</div>
										<div class="imagelinks-input-group">
											<div class="imagelinks-input-group-cell imagelinks-pinch">
												<div al-checkbox="appData.config.image.relative"></div>
											</div>
											<div class="imagelinks-input-group-cell">
												<?php _e('Use relative path', IMAGELINKS_PLUGIN_NAME); ?>
											</div>
										</div>
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-info"><?php _e('Container settings', IMAGELINKS_PLUGIN_NAME); ?></div>
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('The container width will be auto calculated', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Auto width', IMAGELINKS_PLUGIN_NAME); ?></div>
										<div al-toggle="appData.config.autoWidth"></div>
									</div>
									
									<div class="imagelinks-control" al-if="!appData.config.autoWidth">
										<div class="imagelinks-helper" title="<?php _e('Sets the container width, can be any valid CSS units, not just pixels', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Custom width', IMAGELINKS_PLUGIN_NAME); ?></div>
										<input class="imagelinks-text" type="text" al-text="appData.config.containerWidth" placeholder="<?php _e('Default: auto', IMAGELINKS_PLUGIN_NAME); ?>">
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('The container height will be auto calculated', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Auto height', IMAGELINKS_PLUGIN_NAME); ?></div>
										<div al-toggle="appData.config.autoHeight"></div>
									</div>
									
									<div class="imagelinks-control" al-if="!appData.config.autoHeight">
										<div class="imagelinks-helper" title="<?php _e('Sets the container width, can be any valid CSS units, not just pixels', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Custom height', IMAGELINKS_PLUGIN_NAME); ?></div>
										<input class="imagelinks-text" type="text" al-text="appData.config.containerHeight" placeholder="<?php _e('Default: auto', IMAGELINKS_PLUGIN_NAME); ?>">
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Specifies a theme of elements', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Main theme', IMAGELINKS_PLUGIN_NAME); ?></div>
										<select class="imagelinks-select imagelinks-capitalize" al-select="appData.config.theme">
											<option al-option="null"><?php _e('none', IMAGELINKS_PLUGIN_NAME); ?></option>
											<option al-repeat="theme in appData.themes" al-option="theme.id">{{theme.title}}</option>
										</select>
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Background color in hexadecimal format (#fff or #555555)', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Background color', IMAGELINKS_PLUGIN_NAME); ?></div>
										<div class="imagelinks-color" al-color="appData.config.background.color"></div>
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Sets a background image (jpeg or png format)', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Background image', IMAGELINKS_PLUGIN_NAME); ?></div>
										<div class="imagelinks-input-group">
											<div class="imagelinks-input-group-cell">
												<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.config.background.image.url" placeholder="<?php _e('Select an image', IMAGELINKS_PLUGIN_NAME); ?>">
											</div>
											<div class="imagelinks-input-group-cell imagelinks-pinch">
												<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="appData.fn.selectImage(appData, appData.rootScope, appData.config.background.image)" title="<?php _e('Select a background image', IMAGELINKS_PLUGIN_NAME); ?>"><span><i class="imagelinks-icon imagelinks-icon-select"></i></span></div>
											</div>
										</div>
										<div class="imagelinks-input-group">
											<div class="imagelinks-input-group-cell imagelinks-pinch">
												<div al-checkbox="appData.config.background.image.relative"></div>
											</div>
											<div class="imagelinks-input-group-cell">
												<?php _e('Use relative path', IMAGELINKS_PLUGIN_NAME); ?>
											</div>
										</div>
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Specifies a size of the background image', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Background size', IMAGELINKS_PLUGIN_NAME); ?></div>
										<div class="imagelinks-select" al-backgroundsize="appData.config.background.size"></div>
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('How the background image will be repeated', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Background repeat', IMAGELINKS_PLUGIN_NAME); ?></div>
										<div class="imagelinks-select" al-backgroundrepeat="appData.config.background.repeat"></div>
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Sets a starting position of the background image', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Background position', IMAGELINKS_PLUGIN_NAME); ?></div>
										<input class="imagelinks-text" type="text" al-text="appData.config.background.position" placeholder="<?php _e('Example: 50% 50%', IMAGELINKS_PLUGIN_NAME); ?>">
									</div>
									
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Sets additional css classes to the container', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-label"><?php _e('Additional CSS classes', IMAGELINKS_PLUGIN_NAME); ?></div>
										<input class="imagelinks-text" type="text" al-text="appData.config.class">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="imagelinks-section" al-attr.class.imagelinks-active="appData.ui.tabs.markers">
						<div class="imagelinks-stage">
							<div class="imagelinks-sidebar-panel" al-attr.class.imagelinks-hidden="!appData.ui.sidebar" al-style.width="appData.ui.sidebarWidth">
								<div class="imagelinks-data">
									<div class="imagelinks-markers-wrap">
										<div class="imagelinks-markers-toolbar">
											<div class="imagelinks-left-panel">
												<i class="imagelinks-icon imagelinks-icon-plus" al-on.click="appData.fn.addMarker(appData)" title="<?php _e('add marker', IMAGELINKS_PLUGIN_NAME); ?>"></i>
												<span al-if="appData.ui.activeMarker != null">
												<i class="imagelinks-separator"></i>
												<i class="imagelinks-icon imagelinks-icon-copy" al-on.click="appData.fn.copyMarker(appData)" title="<?php _e('copy', IMAGELINKS_PLUGIN_NAME); ?>"></i>
												<i class="imagelinks-icon imagelinks-icon-arrow-up" al-on.click="appData.fn.updownMarker(appData, 'up')" title="<?php _e('move up', IMAGELINKS_PLUGIN_NAME); ?>"></i>
												<i class="imagelinks-icon imagelinks-icon-arrow-down" al-on.click="appData.fn.updownMarker(appData, 'down')" title="<?php _e('move down', IMAGELINKS_PLUGIN_NAME); ?>"></i>
												</span>
											</div>
											<div class="imagelinks-right-panel">
												<i class="imagelinks-icon imagelinks-icon-trash imagelinks-icon-red" al-if="appData.ui.activeMarker != null" al-on.click="appData.fn.deleteMarker(appData)" title="<?php _e('delete', IMAGELINKS_PLUGIN_NAME); ?>"></i>
												<i class="imagelinks-icon imagelinks-icon-save" al-if="appData.ui.activeMarker != null" al-on.click="appData.fn.saveMarkerTemplate(appData, appData.ui.activeMarker)" title="<?php _e('save the marker as a template', IMAGELINKS_PLUGIN_NAME); ?>"></i>
											</div>
										</div>
										<div class="imagelinks-marker"
										 al-attr.class.imagelinks-active="appData.fn.isMarkerActive(appData, marker)"
										 al-on.click="appData.fn.onMarkerItemClick(appData, marker)"
										 al-repeat="marker in appData.config.markers"
										 >
											<i class="imagelinks-icon imagelinks-icon-pin"></i>
											<div class="imagelinks-label">{{marker.title ? marker.title : '...'}}</div>
											<div class="imagelinks-actions">
												<i class="imagelinks-icon imagelinks-icon-style" al-on.click="appData.fn.editMarker(appData, marker)" title="<?php _e('edit', IMAGELINKS_PLUGIN_NAME); ?>"></i>
												<i class="imagelinks-icon imagelinks-icon-tooltip" al-attr.class.imagelinks-inactive="!marker.tooltip.active" al-on.click="appData.fn.toggleMarkerTooltip(appData, marker)" title="<?php _e('enable/disable tooltip', IMAGELINKS_PLUGIN_NAME); ?>"></i>
												<i class="imagelinks-icon" al-attr.class.imagelinks-icon-eye="marker.visible" al-attr.class.imagelinks-icon-eye-off="!marker.visible" al-on.click="appData.fn.toggleMarkerVisible(appData, marker)" title="<?php _e('show/hide', IMAGELINKS_PLUGIN_NAME); ?>"></i>
												<i class="imagelinks-icon" al-attr.class.imagelinks-icon-lock-open="!marker.lock" al-attr.class.imagelinks-icon-lock="marker.lock" al-on.click="appData.fn.toggleMarkerLock(appData, marker)" title="<?php _e('lock/unlock', IMAGELINKS_PLUGIN_NAME); ?>"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="imagelinks-sidebar-resizer" al-on.mousedown="appData.fn.onSidebarResizeStart(appData, $event)">
									<div class="imagelinks-sidebar-hide" al-on.click="appData.fn.toggleSidebarPanel(appData)">
										<i class="imagelinks-icon imagelinks-icon-next" al-if="!appData.ui.sidebar"></i>
										<i class="imagelinks-icon imagelinks-icon-prev" al-if="appData.ui.sidebar"></i>
									</div>
								</div>
							</div>
							<div class="imagelinks-main-panel">
								<div class="imagelinks-tabs imagelinks-clear-fix">
									<div class="imagelinks-tab" al-attr.class.imagelinks-active="appData.ui.markerTabs.marker" al-on.click="appData.fn.onMarkerTab(appData, 'marker')"><?php _e('Marker', IMAGELINKS_PLUGIN_NAME); ?></div>
									<div class="imagelinks-tab" al-attr.class.imagelinks-active="appData.ui.markerTabs.tooltip" al-on.click="appData.fn.onMarkerTab(appData, 'tooltip')"><?php _e('Tooltip', IMAGELINKS_PLUGIN_NAME); ?><div class="imagelinks-status" al-if="appData.ui.activeMarker != null && appData.ui.activeMarker.tooltip.active"></div></div>
								</div>
								<div class="imagelinks-data" al-attr.class.imagelinks-active="appData.ui.markerTabs.marker">
									<div al-if="appData.ui.activeMarker == null">
										<div class="imagelinks-control">
											<div class="imagelinks-info"><?php _e('Please, select a marker to view settings', IMAGELINKS_PLUGIN_NAME); ?></div>
										</div>
									</div>
									<div al-if="appData.ui.activeMarker != null">
										<div class="imagelinks-block imagelinks-block-flat" al-attr.class.imagelinks-block-folded="appData.ui.markerSections.general">
											<div class="imagelinks-block-header" al-on.click="appData.fn.onMarkerSection(appData,'general')">
												<div class="imagelinks-block-title"><?php _e('General', IMAGELINKS_PLUGIN_NAME); ?></div>
												<div class="imagelinks-block-state"></div>
											</div>
											<div class="imagelinks-block-data">
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Sets a marker title', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-label"><?php _e('Title', IMAGELINKS_PLUGIN_NAME); ?></div>
													<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.ui.activeMarker.title">
												</div>
												
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Sets a marker position', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-label"><?php _e('X [px]', IMAGELINKS_PLUGIN_NAME); ?></div>
															<input class="imagelinks-number imagelinks-long" al-integer="appData.ui.activeMarker.x">
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-label"><?php _e('Y [px]', IMAGELINKS_PLUGIN_NAME); ?></div>
															<input class="imagelinks-number imagelinks-long" al-integer="appData.ui.activeMarker.y">
														</div>
													</div>
												</div>
												
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap" al-attr.class.imagelinks-nogap="appData.ui.activeMarker.autoWidth">
															<div class="imagelinks-helper" title="<?php _e('Enable/disable auto marker width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Auto width', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div al-toggle="appData.ui.activeMarker.autoWidth"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap" al-if="!appData.ui.activeMarker.autoWidth">
															<div class="imagelinks-helper" title="<?php _e('Sets a marker width in px', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Width [px]', IMAGELINKS_PLUGIN_NAME); ?></div>
															<input class="imagelinks-number imagelinks-long" al-integer="appData.ui.activeMarker.width">
														</div>
													</div>
												</div>
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap" al-attr.class.imagelinks-nogap="appData.ui.activeMarker.autoHeight">
															<div class="imagelinks-helper" title="<?php _e('Enable/disable auto marker heihgt', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Auto height', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div al-toggle="appData.ui.activeMarker.autoHeight"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap" al-if="!appData.ui.activeMarker.autoHeight">
															<div class="imagelinks-helper" title="<?php _e('Sets a marker height in px', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Height [px]', IMAGELINKS_PLUGIN_NAME); ?></div>
															<input class="imagelinks-number imagelinks-long" al-integer="appData.ui.activeMarker.height">
														</div>
													</div>
												</div>
												
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Set a marker angle', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-label"><?php _e('Angle [deg]', IMAGELINKS_PLUGIN_NAME); ?></div>
													<input class="imagelinks-number imagelinks-long" al-float="appData.ui.activeMarker.angle">
												</div>
											</div>
										</div>
										
										<div class="imagelinks-block imagelinks-block-flat" al-attr.class.imagelinks-block-folded="appData.ui.markerSections.data">
											<div class="imagelinks-block-header" al-on.click="appData.fn.onMarkerSection(appData,'data')">
												<div class="imagelinks-block-title"><?php _e('Data', IMAGELINKS_PLUGIN_NAME); ?></div>
												<div class="imagelinks-block-state"></div>
											</div>
											<div class="imagelinks-block-data">
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Adds a specific url to the marker', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-label"><?php _e('URL', IMAGELINKS_PLUGIN_NAME); ?></div>
													<div class="imagelinks-input-group imagelinks-long">
														<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.ui.activeMarker.link" placeholder="<?php _e('URL', IMAGELINKS_PLUGIN_NAME); ?>">
													</div>
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-pinch">
															<div al-checkbox="appData.ui.activeMarker.linkNewWindow"></div>
														</div>
														<div class="imagelinks-input-group-cell">
															<?php _e('Open url in a new window', IMAGELINKS_PLUGIN_NAME); ?>
														</div>
													</div>
												</div>
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Adds a specific string data to the marker, if we want to use it in custom code later', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-label"><?php _e('User data', IMAGELINKS_PLUGIN_NAME); ?></div>
													<textarea class="imagelinks-long" al-textarea="appData.ui.activeMarker.userData"></textarea>
												</div>
											</div>
										</div>
										
										<div class="imagelinks-block imagelinks-block-flat" al-attr.class.imagelinks-block-folded="appData.ui.markerSections.appearance">
											<div class="imagelinks-block-header" al-on.click="appData.fn.onMarkerSection(appData,'appearance')">
												<div class="imagelinks-block-title"><?php _e('Appearance', IMAGELINKS_PLUGIN_NAME); ?></div>
												<div class="imagelinks-block-state"></div>
											</div>
											<div class="imagelinks-block-data">
												<!-- responsive & noevents -->
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('The marker size depends on the image size', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Responsive', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div al-toggle="appData.ui.activeMarker.responsive"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('The marker is never the target of mouse events', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('No events', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div al-toggle="appData.ui.activeMarker.noevents"></div>
														</div>
													</div>
												</div>
												
												<!-- icon & label -->
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a marker icon', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Icon name', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-input-group imagelinks-long">
																<div class="imagelinks-input-group-cell">
																	<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.ui.activeMarker.view.icon.name" placeholder="<?php _e('Select an icon', IMAGELINKS_PLUGIN_NAME); ?>">
																</div>
																<div class="imagelinks-input-group-cell imagelinks-pinch">
																	<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="appData.fn.selectIcon(appData, appData.rootScope, appData.ui.activeMarker.view.icon)"><span><i class="imagelinks-icon imagelinks-icon-select"></i></span></div>
																</div>
															</div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets an icon label', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Icon label', IMAGELINKS_PLUGIN_NAME); ?></div>
															<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.ui.activeMarker.view.icon.label">
														</div>
													</div>
												</div>
												
												<!-- icon color & size -->
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets an icon color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Icon color', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-color imagelinks-long" al-color="appData.ui.activeMarker.view.icon.color"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets an icon size', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Icon size', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.icon.size"></div>
														</div>
													</div>
												</div>
												
												<!-- icon margin -->
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Sets an icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-label"><?php _e('Icon margin', IMAGELINKS_PLUGIN_NAME); ?></div>
													<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.icon.margin.all"></div>
												</div>
												
												<!-- icon margins -->
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a top icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('top', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.icon.margin.top"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a right icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('right', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.icon.margin.right"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a bottom icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('bottom', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.icon.margin.bottom"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a left icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('left', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.icon.margin.left"></div>
														</div>
													</div>
												</div>
												
												<!-- marker background image -->
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Sets a background image (jpeg or png format)', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-label"><?php _e('Background image', IMAGELINKS_PLUGIN_NAME); ?></div>
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell">
															<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.ui.activeMarker.view.background.image.url" placeholder="<?php _e('Select an image', IMAGELINKS_PLUGIN_NAME); ?>">
														</div>
														<div class="imagelinks-input-group-cell imagelinks-pinch">
															<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="appData.fn.selectImage(appData, appData.rootScope, appData.ui.activeMarker.view.background.image)"><span><i class="imagelinks-icon imagelinks-icon-select"></i></span></div>
														</div>
													</div>
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-pinch">
															<div al-checkbox="appData.ui.activeMarker.view.background.image.relative"></div>
														</div>
														<div class="imagelinks-input-group-cell">
															<?php _e('Use relative path', IMAGELINKS_PLUGIN_NAME); ?>
														</div>
													</div>
												</div>
												
												<!-- marker background color & repeat -->
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a background color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Background color', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-color imagelinks-long" al-color="appData.ui.activeMarker.view.background.color"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('How the background image will be repeated', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Background repeat', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-select imagelinks-long" al-backgroundrepeat="appData.ui.activeMarker.view.background.repeat"></div>
														</div>
													</div>
												</div>
												
												<!-- marker background size & position -->
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Specifies a size of the background image', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Background size', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-select imagelinks-long" al-backgroundsize="appData.ui.activeMarker.view.background.size"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a starting position of the background image', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Background position', IMAGELINKS_PLUGIN_NAME); ?></div>
															<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.ui.activeMarker.view.background.position" placeholder="<?php _e('Example: 50% 50%', IMAGELINKS_PLUGIN_NAME); ?>">
														</div>
													</div>
												</div>
												
												<!-- border tabs -->
												<div class="imagelinks-control">
													<div class="imagelinks-border-tabs">
														<div class="imagelinks-tab-all" al-attr.class.imagelinks-active="appData.ui.borderTabs.all" al-on.click="appData.fn.onBorderTab(appData,'all')" al-attr.class.imagelinks-enable="appData.ui.activeMarker.view.border.all.active"><?php _e('All', IMAGELINKS_PLUGIN_NAME); ?></div>
														<div class="imagelinks-tab-top" al-attr.class.imagelinks-active="appData.ui.borderTabs.top" al-on.click="appData.fn.onBorderTab(appData,'top')" al-attr.class.imagelinks-enable="appData.ui.activeMarker.view.border.top.active"><?php _e('Top', IMAGELINKS_PLUGIN_NAME); ?></div>
														<div class="imagelinks-tab-right" al-attr.class.imagelinks-active="appData.ui.borderTabs.right" al-on.click="appData.fn.onBorderTab(appData,'right')" al-attr.class.imagelinks-enable="appData.ui.activeMarker.view.border.right.active"><?php _e('Right', IMAGELINKS_PLUGIN_NAME); ?></div>
														<div class="imagelinks-tab-bottom" al-attr.class.imagelinks-active="appData.ui.borderTabs.bottom" al-on.click="appData.fn.onBorderTab(appData,'bottom')" al-attr.class.imagelinks-enable="appData.ui.activeMarker.view.border.bottom.active"><?php _e('Bottom', IMAGELINKS_PLUGIN_NAME); ?></div>
														<div class="imagelinks-tab-left" al-attr.class.imagelinks-active="appData.ui.borderTabs.left" al-on.click="appData.fn.onBorderTab(appData,'left')" al-attr.class.imagelinks-enable="appData.ui.activeMarker.view.border.left.active"><?php _e('Left', IMAGELINKS_PLUGIN_NAME); ?></div>
													</div>
												</div>
												
												<!-- border all -->
												<div class="imagelinks-control" al-if="appData.ui.borderTabs.all">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-pinch">
															<div al-checkbox="appData.ui.activeMarker.view.border.all.active"></div>
														</div>
														<div class="imagelinks-input-group-cell">
															<?php _e('Enable border', IMAGELINKS_PLUGIN_NAME); ?>
														</div>
													</div>
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-color imagelinks-long" al-color="appData.ui.activeMarker.view.border.all.color"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-select imagelinks-long" al-borderstyle="appData.ui.activeMarker.view.border.all.style"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.all.width"></div>
														</div>
													</div>
												</div>
												
												<!-- border top -->
												<div class="imagelinks-control" al-if="appData.ui.borderTabs.top">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-pinch">
															<div al-checkbox="appData.ui.activeMarker.view.border.top.active"></div>
														</div>
														<div class="imagelinks-input-group-cell">
															<?php _e('Enable top border', IMAGELINKS_PLUGIN_NAME); ?>
														</div>
													</div>
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-color imagelinks-long" al-color="appData.ui.activeMarker.view.border.top.color"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-select imagelinks-long" al-borderstyle="appData.ui.activeMarker.view.border.top.style"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.top.width"></div>
														</div>
													</div>
												</div>
												
												<!-- border right -->
												<div class="imagelinks-control" al-if="appData.ui.borderTabs.right">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-pinch">
															<div al-checkbox="appData.ui.activeMarker.view.border.right.active"></div>
														</div>
														<div class="imagelinks-input-group-cell">
															<?php _e('Enable right border', IMAGELINKS_PLUGIN_NAME); ?>
														</div>
													</div>
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-color imagelinks-long" al-color="appData.ui.activeMarker.view.border.right.color"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-select imagelinks-long" al-borderstyle="appData.ui.activeMarker.view.border.right.style"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.right.width"></div>
														</div>
													</div>
												</div>
												
												<!-- border bottom -->
												<div class="imagelinks-control" al-if="appData.ui.borderTabs.bottom">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-pinch">
															<div al-checkbox="appData.ui.activeMarker.view.border.bottom.active"></div>
														</div>
														<div class="imagelinks-input-group-cell">
															<?php _e('Enable bottom border', IMAGELINKS_PLUGIN_NAME); ?>
														</div>
													</div>
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-color imagelinks-long" al-color="appData.ui.activeMarker.view.border.bottom.color"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-select imagelinks-long" al-borderstyle="appData.ui.activeMarker.view.border.bottom.style"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.bottom.width"></div>
														</div>
													</div>
												</div>
												
												<!-- border left -->
												<div class="imagelinks-control" al-if="appData.ui.borderTabs.left">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-pinch">
															<div al-checkbox="appData.ui.activeMarker.view.border.left.active"></div>
														</div>
														<div class="imagelinks-input-group-cell">
															<?php _e('Enable left border', IMAGELINKS_PLUGIN_NAME); ?>
														</div>
													</div>
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-color imagelinks-long" al-color="appData.ui.activeMarker.view.border.left.color"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-select imagelinks-long" al-borderstyle="appData.ui.activeMarker.view.border.left.style"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.left.width"></div>
														</div>
													</div>
												</div>
												
												<!-- border radius -->
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Sets a border radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-label"><?php _e('Border radius', IMAGELINKS_PLUGIN_NAME); ?></div>
													<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.radius.all"></div>
												</div>
												
												<!-- border radiuses -->
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border top-left radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('top-left', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.radius.topLeft"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border top-right radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('top-right', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.radius.topRight"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border bottom-right radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('bottom-right', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.radius.bottomRight"></div>
															
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a border bottom-left radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('bottom-left', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-unit imagelinks-long" al-unit="appData.ui.activeMarker.view.border.radius.bottomLeft"></div>
														</div>
													</div>
												</div>
												
												<!-- custom css class -->
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Sets additional css classes to the marker', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-label"><?php _e('Additional CSS classes', IMAGELINKS_PLUGIN_NAME); ?></div>
													<input class="imagelinks-number imagelinks-long" type="text" al-text="appData.ui.activeMarker.className">
												</div>
											</div>
										</div>
										
										<div class="imagelinks-block imagelinks-block-flat" al-attr.class.imagelinks-block-folded="appData.ui.markerSections.animation">
											<div class="imagelinks-block-header" al-on.click="appData.fn.onMarkerSection(appData,'animation')">
												<div class="imagelinks-block-title"><?php _e('Animation', IMAGELINKS_PLUGIN_NAME); ?></div>
												<div class="imagelinks-block-state"></div>
											</div>
											<div class="imagelinks-block-data">
												<div class="imagelinks-control">
													<div class="imagelinks-helper" title="<?php _e('Enable/disable pulse animation', IMAGELINKS_PLUGIN_NAME); ?>"></div>
													<div class="imagelinks-label"><?php _e('Enable pulse', IMAGELINKS_PLUGIN_NAME); ?></div>
													<div al-toggle="appData.ui.activeMarker.view.pulse.active"></div>
												</div>
												
												<div class="imagelinks-control">
													<div class="imagelinks-input-group imagelinks-long">
														<div class="imagelinks-input-group-cell imagelinks-rgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a pulse animation color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Pulse color', IMAGELINKS_PLUGIN_NAME); ?></div>
															<div class="imagelinks-color imagelinks-long" al-color="appData.ui.activeMarker.view.pulse.color"></div>
														</div>
														<div class="imagelinks-input-group-cell imagelinks-lgap">
															<div class="imagelinks-helper" title="<?php _e('Sets a pulse animation duration', IMAGELINKS_PLUGIN_NAME); ?>"></div>
															<div class="imagelinks-label"><?php _e('Pulse duration [ms]', IMAGELINKS_PLUGIN_NAME); ?></div>
															<input class="imagelinks-number imagelinks-long" al-integer="appData.ui.activeMarker.view.pulse.duration">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="imagelinks-data" al-attr.class.imagelinks-active="appData.ui.markerTabs.tooltip">
									<div class="imagelinks-data-block" al-attr.class.imagelinks-active="appData.ui.activeMarker == null">
										<div class="imagelinks-control">
											<div class="imagelinks-info"><?php _e('Please, select a marker to view tooltip settings', IMAGELINKS_PLUGIN_NAME); ?></div>
										</div>
									</div>
									<div class="imagelinks-data-block" al-attr.class.imagelinks-active="appData.ui.activeMarker != null">
										<div class="imagelinks-block imagelinks-block-flat" al-attr.class.imagelinks-block-folded="appData.ui.tooltipSections.data">
											<div class="imagelinks-block-header" al-on.click="appData.fn.onTooltipSection(appData,'data')">
												<div class="imagelinks-block-title"><?php _e('Data', IMAGELINKS_PLUGIN_NAME); ?></div>
												<div class="imagelinks-block-state"></div>
											</div>
											<div class="imagelinks-block-data">
												<div al-if="appData.ui.activeMarker != null">
													<div class="imagelinks-control">
														<div class="imagelinks-helper" title="<?php _e('Enable/disable tooltip for the selected marker', IMAGELINKS_PLUGIN_NAME); ?>"></div>
														<div class="imagelinks-label"><?php _e('Enable tooltip', IMAGELINKS_PLUGIN_NAME); ?></div>
														<div al-toggle="appData.ui.activeMarker.tooltip.active"></div>
													</div>
												</div>
												
												<div class="imagelinks-control">
													<?php
														$settings = array(
															'tinymce' => true,
															'textarea_name' => 'imagelinks-tooltip-text',
															'wpautop' => false,
															'editor_height' => 200, // In pixels, takes precedence and has no default value
															'drag_drop_upload' => true,
															'media_buttons' => true,
															'teeny' => true,
															'quicktags' => true
														);
														wp_editor('','imagelinks-tooltip-editor', $settings);
													?>
												</div>
											</div>
										</div>
										
										<div class="imagelinks-block imagelinks-block-flat" al-attr.class.imagelinks-block-folded="appData.ui.tooltipSections.appearance">
											<div class="imagelinks-block-header" al-on.click="appData.fn.onTooltipSection(appData,'appearance')">
											
											<div class="imagelinks-block-title"><?php _e('Appearance', IMAGELINKS_PLUGIN_NAME); ?></div>
												<div class="imagelinks-block-state"></div>
											</div>
											<div class="imagelinks-block-data">
												<div al-if="appData.ui.activeMarker != null">
													<div class="imagelinks-control">
														<div class="imagelinks-input-group imagelinks-long">
															<div class="imagelinks-input-group-cell imagelinks-rgap">
																<div class="imagelinks-helper" title="<?php _e('Specifies a tooltip event trigger', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Trigger', IMAGELINKS_PLUGIN_NAME); ?></div>
																<div class="imagelinks-select imagelinks-long" al-tooltiptrigger="appData.ui.activeMarker.tooltip.trigger"></div>
															</div>
															<div class="imagelinks-input-group-cell imagelinks-lgap">
																<div class="imagelinks-helper" title="<?php _e('Specifies a tooltip placement', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Placement', IMAGELINKS_PLUGIN_NAME); ?></div>
																<div class="imagelinks-select imagelinks-long" al-tooltipplacement="appData.ui.activeMarker.tooltip.placement"></div>
															</div>
														</div>
													</div>
													
													<div class="imagelinks-control">
														<div class="imagelinks-helper" title="<?php _e('Sets tooltip offset', IMAGELINKS_PLUGIN_NAME); ?>"></div>
														<div class="imagelinks-input-group imagelinks-long">
															<div class="imagelinks-input-group-cell imagelinks-rgap">
																<div class="imagelinks-label"><?php _e('Offset X [px]', IMAGELINKS_PLUGIN_NAME); ?></div>
																<input class="imagelinks-number imagelinks-long" al-integer="appData.ui.activeMarker.tooltip.offset.x">
															</div>
															<div class="imagelinks-input-group-cell imagelinks-lgap">
																<div class="imagelinks-label"><?php _e('Offset Y [px]', IMAGELINKS_PLUGIN_NAME); ?></div>
																<input class="imagelinks-number imagelinks-long" al-integer="appData.ui.activeMarker.tooltip.offset.y">
															</div>
														</div>
													</div>
													
													<div class="imagelinks-control" al-if="appData.ui.activeMarker.tooltip.trigger == 'hover' || appData.ui.activeMarker.tooltip.trigger == 'clickbody'">
														<div class="imagelinks-input-group imagelinks-long">
															<div class="imagelinks-input-group-cell imagelinks-rgap" al-if="appData.ui.activeMarker.tooltip.trigger != 'clickbody'">
																<div class="imagelinks-helper" title="<?php _e('Enable/disable tooltip follow the cursor as you hover over the marker', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Follow the cursor', IMAGELINKS_PLUGIN_NAME); ?></div>
																<div al-toggle="appData.ui.activeMarker.tooltip.followCursor"></div>
															</div>
															<div class="imagelinks-input-group-cell">
																<div class="imagelinks-helper" title="<?php _e('The tooltip won\'t hide when you hover over or click on them', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Interactive', IMAGELINKS_PLUGIN_NAME); ?></div>
																<div al-toggle="appData.ui.activeMarker.tooltip.interactive"></div>
															</div>
														</div>
													</div>
													
													<div class="imagelinks-control">
														<div class="imagelinks-input-group imagelinks-long">
															<div class="imagelinks-input-group-cell imagelinks-rgap">
																<div class="imagelinks-helper" title="<?php _e('The tooltip size depends on the image size', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Responsive', IMAGELINKS_PLUGIN_NAME); ?></div>
																<div al-toggle="appData.ui.activeMarker.tooltip.responsive"></div>
															</div>
															<div class="imagelinks-input-group-cell imagelinks-lgap">
																<div class="imagelinks-helper" title="<?php _e('Determines if the tooltip is placed within the viewport as best it can be if there is not enough space', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Smart', IMAGELINKS_PLUGIN_NAME); ?></div>
																<div al-toggle="appData.ui.activeMarker.tooltip.smart"></div>
															</div>
														</div>
													</div>
													
													<div class="imagelinks-control">
														<div class="imagelinks-input-group imagelinks-long">
															<div class="imagelinks-input-group-cell imagelinks-rgap" al-attr.class.imagelinks-nogap="appData.ui.activeMarker.tooltip.widthFromCSS">
																<div class="imagelinks-helper" title="<?php _e('If true, the tooltip width will be taken from CSS rules, dont forget to define them', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Width from CSS', IMAGELINKS_PLUGIN_NAME); ?></div>
																<div al-toggle="appData.ui.activeMarker.tooltip.widthFromCSS"></div>
															</div>
															<div class="imagelinks-input-group-cell imagelinks-lgap" al-if="!appData.ui.activeMarker.tooltip.widthFromCSS">
																<div class="imagelinks-helper" title="<?php _e('Specifies a tooltip width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Width [px]', IMAGELINKS_PLUGIN_NAME); ?></div>
																<input class="imagelinks-number imagelinks-long" al-integer="appData.ui.activeMarker.tooltip.width" placeholder="<?php _e('auto', IMAGELINKS_PLUGIN_NAME); ?>">
															</div>
														</div>
													</div>
													
													<div class="imagelinks-control">
														<div class="imagelinks-helper" title="<?php _e('The tooltip will be shown immediately once the instance is created', IMAGELINKS_PLUGIN_NAME); ?>"></div>
														<div class="imagelinks-label"><?php _e('Show on init', IMAGELINKS_PLUGIN_NAME); ?></div>
														<div al-toggle="appData.ui.activeMarker.tooltip.showOnInit"></div>
													</div>
													
													<div class="imagelinks-control">
														<div class="imagelinks-helper" title="<?php _e('Sets additional css classes to the tooltip', IMAGELINKS_PLUGIN_NAME); ?>"></div>
														<div class="imagelinks-label"><?php _e('Additional CSS classes', IMAGELINKS_PLUGIN_NAME); ?></div>
														<input class="imagelinks-number imagelinks-long" type="text" al-text="appData.ui.activeMarker.tooltip.className">
													</div>
												</div>
											</div>
										</div>
										
										<div class="imagelinks-block imagelinks-block-flat" al-attr.class.imagelinks-block-folded="appData.ui.tooltipSections.animation">
											<div class="imagelinks-block-header" al-on.click="appData.fn.onTooltipSection(appData,'animation')">
												<div class="imagelinks-block-title"><?php _e('Animation', IMAGELINKS_PLUGIN_NAME); ?></div>
												<div class="imagelinks-block-state"></div>
											</div>
											<div class="imagelinks-block-data">
												<div al-if="appData.ui.activeMarker != null">
													<div class="imagelinks-control">
														<div class="imagelinks-input-group imagelinks-long">
															<div class="imagelinks-input-group-cell imagelinks-rgap">
																<div class="imagelinks-helper" title="<?php _e('Select a show animation effect for the tooltip from the list or write your own', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Show animation', IMAGELINKS_PLUGIN_NAME); ?></div>
																<div class="imagelinks-input-group imagelinks-long">
																	<div class="imagelinks-input-group-cell">
																		<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.ui.activeMarker.tooltip.showAnimation">
																	</div>
																	<div class="imagelinks-input-group-cell imagelinks-pinch">
																		<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="appData.fn.selectShowAnimation(appData, appData.ui.activeMarker.tooltip)" title="<?php _e('Select an effect', IMAGELINKS_PLUGIN_NAME); ?>"><span><i class="imagelinks-icon imagelinks-icon-select"></i></span></div>
																	</div>
																</div>
															</div>
															<div class="imagelinks-input-group-cell imagelinks-lgap">
																<div class="imagelinks-helper" title="<?php _e('Select a hide animation effect for the tooltip from the list or write your own', IMAGELINKS_PLUGIN_NAME); ?>"></div>
																<div class="imagelinks-label"><?php _e('Hide animation', IMAGELINKS_PLUGIN_NAME); ?></div>
																<div class="imagelinks-input-group imagelinks-long">
																	<div class="imagelinks-input-group-cell">
																		<input class="imagelinks-text imagelinks-long" type="text" al-text="appData.ui.activeMarker.tooltip.hideAnimation">
																	</div>
																	<div class="imagelinks-input-group-cell imagelinks-pinch">
																		<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="appData.fn.selectHideAnimation(appData, appData.ui.activeMarker.tooltip)" title="<?php _e('Select an effect', IMAGELINKS_PLUGIN_NAME); ?>"><span><i class="imagelinks-icon imagelinks-icon-select"></i></span></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
													<div class="imagelinks-control">
														<div class="imagelinks-helper" title="<?php _e('Sets animation duration for show and hide effects', IMAGELINKS_PLUGIN_NAME); ?>"></div>
														<div class="imagelinks-label"><?php _e('Duration [ms]', IMAGELINKS_PLUGIN_NAME); ?></div>
														<input class="imagelinks-number imagelinks-long" al-integer="appData.ui.activeMarker.tooltip.duration">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="imagelinks-section" al-attr.class.imagelinks-active="appData.ui.tabs.customCSS" al-if="appData.ui.tabs.customCSS">
						<div class="imagelinks-stage">
							<div class="imagelinks-main-panel">
								<div class="imagelinks-data imagelinks-active">
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Enable/disable custom styles', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-input-group">
											<div class="imagelinks-input-group-cell imagelinks-pinch">
												<div al-toggle="appData.config.customCSS.active"></div>
											</div>
											<div class="imagelinks-input-group-cell">
												<div class="imagelinks-label"><?php _e('Enable styles', IMAGELINKS_PLUGIN_NAME); ?></div>
											</div>
										</div>
									</div>
									<div class="imagelinks-control">
										<pre id="imagelinks-notepad-css" class="imagelinks-notepad"></pre>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="imagelinks-section" al-attr.class.imagelinks-active="appData.ui.tabs.customJS" al-if="appData.ui.tabs.customJS">
						<div class="imagelinks-stage">
							<div class="imagelinks-main-panel">
								<div class="imagelinks-data imagelinks-active">
									<div class="imagelinks-control">
										<div class="imagelinks-helper" title="<?php _e('Enable/disable custom javascript code', IMAGELINKS_PLUGIN_NAME); ?>"></div>
										<div class="imagelinks-input-group">
											<div class="imagelinks-input-group-cell imagelinks-pinch">
												<div al-toggle="appData.config.customJS.active"></div>
											</div>
											<div class="imagelinks-input-group-cell">
												<div class="imagelinks-label"><?php _e('Enable javascript code', IMAGELINKS_PLUGIN_NAME); ?></div>
											</div>
										</div>
									</div>
									<div class="imagelinks-control">
										<pre id="imagelinks-notepad-js" class="imagelinks-notepad"></pre>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="imagelinks-section" al-attr.class.imagelinks-active="appData.ui.tabs.shortcode" al-if="appData.wp_item_id">
						<div class="imagelinks-main-panel">
							<div class="imagelinks-data imagelinks-active">
								<h3><?php _e('Use a shortcode like the one below, simply copy and paste it into a post or page.', IMAGELINKS_PLUGIN_NAME); ?></h3>
								
								<div class="imagelinks-control">
									<div class="imagelinks-label"><?php _e('Standard shortcode', IMAGELINKS_PLUGIN_NAME); ?></div>
									<div class="imagelinks-input-group">
										<div class="imagelinks-input-group-cell">
											<input id="imagelinks-shortcode-1" class="imagelinks-text imagelinks-long" type="text" value='[imagelinks id="{{appData.wp_item_id}}"]' readonly="readonly">
										</div>
										<div class="imagelinks-input-group-cell imagelinks-pinch">
											<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="appData.fn.copyToClipboard(appData, '#imagelinks-shortcode-1')" title="<?php _e('Copy to clipboard', IMAGELINKS_PLUGIN_NAME); ?>"><span><i class="imagelinks-icon imagelinks-icon-copy"></i></span></div>
										</div>
									</div>
								</div>
								
								<div class="imagelinks-control ">
									<div class="imagelinks-label"><?php _e('Shortcode with custom CSS classes', IMAGELINKS_PLUGIN_NAME); ?></div>
									<div class="imagelinks-input-group">
										<div class="imagelinks-input-group-cell">
											<input id="imagelinks-shortcode-2" class="imagelinks-text imagelinks-long" type="text" value='[imagelinks id="{{appData.wp_item_id}}" class="your-css-custom-class"]' readonly="readonly">
										</div>
										<div class="imagelinks-input-group-cell imagelinks-pinch">
											<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="appData.fn.copyToClipboard(appData, '#imagelinks-shortcode-2')" title="<?php _e('Copy to clipboard', IMAGELINKS_PLUGIN_NAME); ?>"><span><i class="imagelinks-icon imagelinks-icon-copy"></i></span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="imagelinks-modals" class="imagelinks-modals">
		</div>
	</div>
	<!-- /end vision app -->
</div>