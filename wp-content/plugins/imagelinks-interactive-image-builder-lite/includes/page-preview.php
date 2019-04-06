<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

$id = filter_input(INPUT_GET, 'imagelinks', FILTER_SANITIZE_NUMBER_INT);
$class = NULL;

global $wpdb;
$table = $wpdb->prefix . IMAGELINKS_PLUGIN_NAME;
$upload_dir = wp_upload_dir();

$query = $wpdb->prepare('SELECT * FROM ' . $table . ' WHERE id=%s', $id);
$item = $wpdb->get_row($query, OBJECT);
if($item) {
	$version = strtotime(mysql2date('d M Y H:i:s', $item->modified));
	$itemData = unserialize($item->data);
	$id = $item->id;
	$id_postfix = strtolower(wp_generate_password(5, false)); // generate unique postfix for $id to avoid clashes with multiple same shortcode use
	$id_element = 'imgl-' . $id . '-' . $id_postfix;
	$plugin_url = plugin_dir_url(dirname(__FILE__));
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="description" content="ImageLinks Preview">
<title>ImageLinks Preview</title>
<script type="text/javascript">
/* <![CDATA[ */
var imagelinks_globals = {
	"plan":"<?php echo IMAGELINKS_PLUGIN_PLAN; ?>",
	"version":"<?php echo $version; ?>",
	"fontawesome_url":"<?php echo $plugin_url . 'assets/css/font-awesome.min.css'; ?>",
	"effects_url":"<?php echo $plugin_url . 'assets/js/lib/imagelinks/imagelinks-effects.min.css'; ?>",
	"theme_base_url":"<?php echo $plugin_url . 'assets/themes/'; ?>",
	"plugin_base_url":"<?php echo $plugin_url . 'assets/js/lib/imagelinks/'; ?>",
	"plugin_upload_base_url":"<?php echo IMAGELINKS_PLUGIN_UPLOAD_URL; ?>"
};
/* ]]> */
</script>
<script type="text/javascript" src="<?php echo $plugin_url . 'assets/js/lib/jquery/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo $plugin_url . 'assets/js/loader.min.js'?>"></script>
<style>
body,
html {
	margin:0;
	padding:0;
}
body {
	background:#fbfbfb;
	background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAC1JREFUeNpiPHPmDAM2YGxsjFWciYFEMKqBGMD4//9/rBJnz54dDSX6aQAIMABCtQiAsDRF+wAAAABJRU5ErkJggg==');
	overflow:hidden;
}
.imgl-map-wrap {
	position:absolute;
	top:30%;
	left:30%;
	right:30%;
	bottom:30%;
	display:flex;
	align-items:center;
	justify-content:center;
	box-sizing:border-box;
}
.imgl-map-wrap .imgl-map {
	width:100%;
}
@media screen and (max-width: 782px) {
	.imgl-map-wrap {
		top:5%;
		left:5%;
		right:5%;
		bottom:5%;
	}
}
</style>
</head>
<body>
<div class="imgl-map-wrap">
<?php
	ob_start(); // turn on buffering
	
	echo '<!-- imagelinks begin -->' . PHP_EOL;
	echo '<div ';
	echo 'id="' . $id_element . '" ';
	echo 'class="imgl-map imgl-map-' . $id . ' ' . ($class ? ' ' . $class : '') . '"'; // $class from shortcode
	echo 'data-json-src="'. IMAGELINKS_PLUGIN_UPLOAD_URL . $item->id . '/config.json?ver=' . $version . '" ';
	echo 'data-item-id="' . $item->id . '" ';
	//echo 'tabindex="1" ';
	echo 'style="display:none;" ';
	echo '>' . PHP_EOL;
		
		//=============================================
		// STORE BEGIN
		echo '<div class="imgl-store">' . PHP_EOL;
		
		$markerId = 0;
		foreach($itemData->markers as $markerKey => $marker) {
			if(!$marker->visible) {
				continue;
			}
			
			$markerId++;
			
			//=============================================
			// MARKER BEGIN
			echo '<div class="imgl-pin imgl-pin-' . $markerId . '" data-id="' . $markerId . '">' . PHP_EOL;
			
			if($marker->view->pulse->active) {
				echo '<div class="imgl-pin-pulse"></div>' . PHP_EOL;
			}
			
			echo '<div class="imgl-pin-data">' . PHP_EOL;
			if(!$this->IsNullOrEmptyString($marker->view->icon->name) || !$this->IsNullOrEmptyString($marker->view->icon->label)) {
				echo '<div class="imgl-ico-wrap">' . PHP_EOL;
				if(!$this->IsNullOrEmptyString($marker->view->icon->name)) {
					echo '<div class="imgl-ico"><i class="fa ' . $marker->view->icon->name . '"></i></div>' . PHP_EOL;
				}
				if(!$this->IsNullOrEmptyString($marker->view->icon->label)) {
					echo '<div class="imgl-ico-lbl">' . $marker->view->icon->label . '</div>' . PHP_EOL;
				}
				echo '</div>' . PHP_EOL;
			}
			echo '</div>' . PHP_EOL;
			
			echo '</div>' . PHP_EOL;
			// MARKER END
			//=============================================
		}
		
		$markerId = 0;
		foreach($itemData->markers as $markerKey => $marker) {
			if(!$marker->visible) {
				continue;
			}
			
			$markerId++;
			
			//=============================================
			// TOOLTIP BEGIN
			echo '<div ';
			echo 'class="imgl-tt imgl-tt-' . $markerId . '" ';
			echo 'data-id="' . $markerId . '" ';
			echo '>' . PHP_EOL;
			echo do_shortcode($marker->tooltip->data);
			echo '</div>' . PHP_EOL;
			// TOOLTIP END
			//=============================================
		}
		
		echo '</div>' . PHP_EOL;
		// STORE END
		//=============================================
		
	echo '</div>' . PHP_EOL;
	echo '<!-- imagelinks end -->' . PHP_EOL;
	
	$output = ob_get_contents(); // get the buffered content into a var
	ob_end_clean(); // clean buffer
	
	echo $output;
?>
</div>
</body>
</html>
<?php
} else {
	echo '<p>' . __('Error: invalid imagelinks database record', IMAGELINKS_PLUGIN_NAME) . '</p>';
	die;
}
?>
