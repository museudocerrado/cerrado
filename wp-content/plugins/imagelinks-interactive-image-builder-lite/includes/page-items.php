<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

$list_table = new ImageLinks_List_Table_Items();
$list_table->prepare_items();

?>
<div class="wrap imagelinks">
	<?php require 'page-info.php'; ?>
	<div class="imagelinks-page-header">
		<div class="imagelinks-title"><?php _e('ImageLinks Items', IMAGELINKS_PLUGIN_NAME); ?></div>
		<div class="imagelinks-actions">
			<a href="?page=<?php echo IMAGELINKS_PLUGIN_NAME . '_item'; ?>"><?php _e('Add Item', IMAGELINKS_PLUGIN_NAME); ?></a>
		</div>
	</div>
	<!-- imagelinks app -->
	<div id="imagelinks-app-items" class="imagelinks-app">
		<form method="get">
			<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>">
			<?php $list_table->display() ?>
		</form>
	</div>
	<!-- /end imagelinks app -->
</div>