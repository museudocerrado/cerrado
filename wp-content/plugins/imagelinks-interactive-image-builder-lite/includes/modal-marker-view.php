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
			<div class="imagelinks-modal-title"><?php _e('Edit the marker view', IMAGELINKS_PLUGIN_NAME); ?></div>
		</div>
		<div class="imagelinks-modal-data">
			<div class="imagelinks-control">
				<div class="imagelinks-marker-canvas-wrap">
					<div class="imagelinks-marker-canvas">
						<div class="imagelinks-marker-wrap">
							<div class="imagelinks-marker-pulse" al-attr.class.imagelinks-active="modalData.marker.view.pulse.active">
							</div>
							<div class="imagelinks-marker"
								 al-style.width="modalData.appData.fn.getMarkerStyle(modalData.appData, modalData.marker, 'width')"
								 al-style.height="modalData.appData.fn.getMarkerStyle(modalData.appData, modalData.marker, 'height')"
								 al-init="modalData.fn.initMarker(modalData, $element)"
							>
								<div class="imagelinks-marker-icon-wrap"
									 al-style.color="modalData.appData.fn.getIconStyle(modalData.appData, modalData.marker.view.icon, 'color')"
									 al-style.font-size="modalData.appData.fn.getIconStyle(modalData.appData, modalData.marker.view.icon, 'font-size')"
								>
									<div class="imagelinks-marker-icon" al-if="modalData.marker.view.icon.name"><i class="fa {{modalData.marker.view.icon.name}}"></i></div>
									<div class="imagelinks-marker-icon-label" al-if="modalData.marker.view.icon.label">{{modalData.marker.view.icon.label}}</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-helper" title="<?php _e('Sets a marker title', IMAGELINKS_PLUGIN_NAME); ?>"></div>
				<div class="imagelinks-label"><?php _e('Title', IMAGELINKS_PLUGIN_NAME); ?></div>
				<input class="imagelinks-text imagelinks-long" type="text" al-text="modalData.marker.title">
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap" al-attr.class.imagelinks-nogap="modalData.marker.autoWidth">
						<div class="imagelinks-helper" title="<?php _e('Enable/disable auto marker width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Auto width', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div al-toggle="modalData.marker.autoWidth"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap" al-if="!modalData.marker.autoWidth">
						<div class="imagelinks-helper" title="<?php _e('Sets a marker width in px', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Width [px]', IMAGELINKS_PLUGIN_NAME); ?></div>
						<input class="imagelinks-number imagelinks-long" al-integer="modalData.marker.width">
					</div>
				</div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap" al-attr.class.imagelinks-nogap="modalData.marker.autoHeight">
						<div class="imagelinks-helper" title="<?php _e('Enable/disable auto marker heihgt', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Auto height', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div al-toggle="modalData.marker.autoHeight"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap" al-if="!modalData.marker.autoHeight">
						<div class="imagelinks-helper" title="<?php _e('Sets a marker height in px', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Height [px]', IMAGELINKS_PLUGIN_NAME); ?></div>
						<input class="imagelinks-number imagelinks-long" al-integer="modalData.marker.height">
					</div>
				</div>
			</div>
			
			<!-- responsive & noevents -->
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('The marker size depends on the image size', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Responsive', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div al-toggle="modalData.marker.responsive"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('The marker is never the target of mouse events', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('No events', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div al-toggle="modalData.marker.noevents"></div>
					</div>
				</div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a marker icon', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Icon name', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-input-group imagelinks-long">
							<div class="imagelinks-input-group-cell">
								<input class="imagelinks-text imagelinks-long" type="text" al-text="modalData.marker.view.icon.name" placeholder="<?php _e('Select an icon', IMAGELINKS_PLUGIN_NAME); ?>">
							</div>
							<div class="imagelinks-input-group-cell imagelinks-pinch">
								<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="modalData.appData.fn.selectIcon(modalData.appData, modalData.rootScope, modalData.marker.view.icon)"><span><i class="imagelinks-icon imagelinks-icon-select"></i></span></div>
							</div>
						</div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets an icon label', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Icon label', IMAGELINKS_PLUGIN_NAME); ?></div>
						<input class="imagelinks-text imagelinks-long" type="text" al-text="modalData.marker.view.icon.label">
					</div>
				</div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets an icon color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Icon color', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-color imagelinks-long" al-color="modalData.marker.view.icon.color"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets an icon size', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Icon size', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.icon.size"></div>
					</div>
				</div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-helper" title="<?php _e('Sets an icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
				<div class="imagelinks-label"><?php _e('Icon margin', IMAGELINKS_PLUGIN_NAME); ?></div>
				<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.icon.margin.all"></div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a top icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('top', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.icon.margin.top"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a right icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('right', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.icon.margin.right"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a bottom icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('bottom', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.icon.margin.bottom"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a left icon margin', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('left', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.icon.margin.left"></div>
					</div>
				</div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-helper" title="<?php _e('Sets a background image (jpeg or png format)', IMAGELINKS_PLUGIN_NAME); ?>"></div>
				<div class="imagelinks-label"><?php _e('Background image', IMAGELINKS_PLUGIN_NAME); ?></div>
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell">
						<input class="imagelinks-text imagelinks-long" type="text" al-text="modalData.marker.view.background.image.url" placeholder="<?php _e('Select an image', IMAGELINKS_PLUGIN_NAME); ?>">
					</div>
					<div class="imagelinks-input-group-cell imagelinks-pinch">
						<div class="imagelinks-btn imagelinks-default imagelinks-no-bl" al-on.click="modalData.appData.fn.selectImage(modalData.appData, modalData.rootScope, modalData.marker.view.background.image)"><span><i class="imagelinks-icon imagelinks-icon-select"></i></span></div>
					</div>
				</div>
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-pinch">
						<div al-checkbox="modalData.marker.view.background.image.relative"></div>
					</div>
					<div class="imagelinks-input-group-cell">
						<?php _e('Use relative path', IMAGELINKS_PLUGIN_NAME); ?>
					</div>
				</div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a background color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Background color', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-color imagelinks-long" al-color="modalData.marker.view.background.color"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('How a background image will be repeated', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Background repeat', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-select imagelinks-long" al-backgroundrepeat="modalData.marker.view.background.repeat"></div>
					</div>
				</div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Specifies a size of the background image', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Background size', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-select imagelinks-long" al-backgroundsize="modalData.marker.view.background.size"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a starting position of the background image', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Background position', IMAGELINKS_PLUGIN_NAME); ?></div>
						<input class="imagelinks-text imagelinks-long" type="text" al-text="modalData.marker.view.background.position" placeholder="<?php _e('Example: 50% 50%', IMAGELINKS_PLUGIN_NAME); ?>">
					</div>
				</div>
			</div>
			
			<!-- border begin -->
			<div class="imagelinks-control">
				<div class="imagelinks-border-tabs">
					<div class="imagelinks-tab-all" al-attr.class.imagelinks-active="modalData.appData.ui.borderTabs.all" al-on.click="modalData.appData.fn.onBorderTab(modalData.appData,'all')" al-attr.class.imagelinks-enable="modalData.marker.view.border.all.active"><?php _e('All', IMAGELINKS_PLUGIN_NAME); ?></div>
					<div class="imagelinks-tab-top" al-attr.class.imagelinks-active="modalData.appData.ui.borderTabs.top" al-on.click="modalData.appData.fn.onBorderTab(modalData.appData,'top')" al-attr.class.imagelinks-enable="modalData.marker.view.border.top.active"><?php _e('Top', IMAGELINKS_PLUGIN_NAME); ?></div>
					<div class="imagelinks-tab-right" al-attr.class.imagelinks-active="modalData.appData.ui.borderTabs.right" al-on.click="modalData.appData.fn.onBorderTab(modalData.appData,'right')" al-attr.class.imagelinks-enable="modalData.marker.view.border.right.active"><?php _e('Right', IMAGELINKS_PLUGIN_NAME); ?></div>
					<div class="imagelinks-tab-bottom" al-attr.class.imagelinks-active="modalData.appData.ui.borderTabs.bottom" al-on.click="modalData.appData.fn.onBorderTab(modalData.appData,'bottom')" al-attr.class.imagelinks-enable="modalData.marker.view.border.bottom.active"><?php _e('Bottom', IMAGELINKS_PLUGIN_NAME); ?></div>
					<div class="imagelinks-tab-left" al-attr.class.imagelinks-active="modalData.appData.ui.borderTabs.left" al-on.click="modalData.appData.fn.onBorderTab(modalData.appData,'left')" al-attr.class.imagelinks-enable="modalData.marker.view.border.left.active"><?php _e('Left', IMAGELINKS_PLUGIN_NAME); ?></div>
				</div>
			</div>
			
			<!-- border all -->
			<div class="imagelinks-control" al-if="modalData.appData.ui.borderTabs.all">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-pinch">
						<div al-checkbox="modalData.marker.view.border.all.active"></div>
					</div>
					<div class="imagelinks-input-group-cell">
						<?php _e('Enable border', IMAGELINKS_PLUGIN_NAME); ?>
					</div>
				</div>
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-color imagelinks-long" al-color="modalData.marker.view.border.all.color"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-select imagelinks-long" al-borderstyle="modalData.marker.view.border.all.style"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.all.width"></div>
					</div>
				</div>
			</div>
			
			<!-- border top -->
			<div class="imagelinks-control" al-if="modalData.appData.ui.borderTabs.top">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-pinch">
						<div al-checkbox="modalData.marker.view.border.top.active"></div>
					</div>
					<div class="imagelinks-input-group-cell">
						<?php _e('Enable top border', IMAGELINKS_PLUGIN_NAME); ?>
					</div>
				</div>
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-color imagelinks-long" al-color="modalData.marker.view.border.top.color"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-select imagelinks-long" al-borderstyle="modalData.marker.view.border.top.style"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.top.width"></div>
					</div>
				</div>
			</div>
			
			<!-- border right -->
			<div class="imagelinks-control" al-if="modalData.appData.ui.borderTabs.right">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-pinch">
						<div al-checkbox="modalData.marker.view.border.right.active"></div>
					</div>
					<div class="imagelinks-input-group-cell">
						<?php _e('Enable right border', IMAGELINKS_PLUGIN_NAME); ?>
					</div>
				</div>
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-color imagelinks-long" al-color="modalData.marker.view.border.right.color"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-select imagelinks-long" al-borderstyle="modalData.marker.view.border.right.style"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.right.width"></div>
					</div>
				</div>
			</div>
			
			<!-- border bottom -->
			<div class="imagelinks-control" al-if="modalData.appData.ui.borderTabs.bottom">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-pinch">
						<div al-checkbox="modalData.marker.view.border.bottom.active"></div>
					</div>
					<div class="imagelinks-input-group-cell">
						<?php _e('Enable bottom border', IMAGELINKS_PLUGIN_NAME); ?>
					</div>
				</div>
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-color imagelinks-long" al-color="modalData.marker.view.border.bottom.color"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-select imagelinks-long" al-borderstyle="modalData.marker.view.border.bottom.style"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.bottom.width"></div>
					</div>
				</div>
			</div>
			
			<!-- border left -->
			<div class="imagelinks-control" al-if="modalData.appData.ui.borderTabs.left">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-pinch">
						<div al-checkbox="modalData.marker.view.border.left.active"></div>
					</div>
					<div class="imagelinks-input-group-cell">
						<?php _e('Enable left border', IMAGELINKS_PLUGIN_NAME); ?>
					</div>
				</div>
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border color', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-color imagelinks-long" al-color="modalData.marker.view.border.left.color"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border style', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border style', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-select imagelinks-long" al-borderstyle="modalData.marker.view.border.left.style"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border width', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Border width', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.left.width"></div>
					</div>
				</div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-helper" title="<?php _e('Sets a border radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
				<div class="imagelinks-label"><?php _e('Border radius', IMAGELINKS_PLUGIN_NAME); ?></div>
				<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.radius.all"></div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border top-left radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('top-left', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.radius.topLeft"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border top-right radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('top-right', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.radius.topRight"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border bottom-right radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('bottom-right', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.radius.bottomRight"></div>
						
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a border bottom-left radius', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('bottom-left', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-unit imagelinks-long" al-unit="modalData.marker.view.border.radius.bottomLeft"></div>
					</div>
				</div>
			</div>
			<!-- border end -->
			
			<div class="imagelinks-control">
				<div class="imagelinks-helper" title="<?php _e('Sets additional css classes to the marker', IMAGELINKS_PLUGIN_NAME); ?>"></div>
				<div class="imagelinks-label"><?php _e('Additional CSS class', IMAGELINKS_PLUGIN_NAME); ?></div>
				<input class="imagelinks-number imagelinks-long" type="text" al-text="modalData.marker.className">
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-helper" title="<?php _e('Enable/disable pulse animation', IMAGELINKS_PLUGIN_NAME); ?>"></div>
				<div class="imagelinks-label"><?php _e('Enable pulse', IMAGELINKS_PLUGIN_NAME); ?></div>
				<div al-toggle="modalData.marker.view.pulse.active"></div>
			</div>
			
			<div class="imagelinks-control">
				<div class="imagelinks-input-group imagelinks-long">
					<div class="imagelinks-input-group-cell imagelinks-rgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a pulse animation color', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Pulse color', IMAGELINKS_PLUGIN_NAME); ?></div>
						<div class="imagelinks-color imagelinks-long" al-color="modalData.marker.view.pulse.color"></div>
					</div>
					<div class="imagelinks-input-group-cell imagelinks-lgap">
						<div class="imagelinks-helper" title="<?php _e('Sets a pulse animation duration', IMAGELINKS_PLUGIN_NAME); ?>"></div>
						<div class="imagelinks-label"><?php _e('Pulse duration [ms]', IMAGELINKS_PLUGIN_NAME); ?></div>
						<input class="imagelinks-number imagelinks-long" al-integer="modalData.marker.view.pulse.duration">
					</div>
				</div>
			</div>
		</div>
		<div class="imagelinks-modal-footer">
			<div class="imagelinks-modal-btn imagelinks-modal-btn-close" al-on.click="modalData.deferred.resolve('close');"><?php _e('Close', IMAGELINKS_PLUGIN_NAME); ?></div>
			<div class="imagelinks-modal-btn imagelinks-modal-btn-create" al-on.click="modalData.deferred.resolve(true);"><?php _e('Save', IMAGELINKS_PLUGIN_NAME); ?></div>
		</div>
	</div>
</div>