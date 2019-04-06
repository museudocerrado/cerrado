<?php
if (!defined('ABSPATH'))
    exit;
responsive_tabs_with_accordions_user_capabilities();
global $wpdb;
$table_import = $wpdb->prefix . 'content_tabs_ultimate_import';
if (!empty($_POST['oxi-tabs-import']) && $_POST['oxi-tabs-import'] != '') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'oxitabsstyleimport')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $oxiteamimport = sanitize_text_field($_POST['oxi-tabs-import']);
        $wpdb->query($wpdb->prepare("INSERT INTO {$table_import} (name) VALUES ( %d)", array($oxiteamimport)));
        $redirect_id = $wpdb->insert_id;
        if ($redirect_id == 0) {
            $url = admin_url("admin.php?page=content-tabs-ultimate-import");
        }
        if ($redirect_id != 0) {
            $url = admin_url("admin.php?page=content-tabs-ultimate-new#style$oxiteamimport");
        }
        echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
        exit;
    }
}
$status = get_option('responsive_tabs_with_accordions_license_status');
$importdata = $wpdb->get_results("SELECT * FROM $table_import ORDER by name DESC", ARRAY_A);
?>
<div class="wrap">
    <?php echo responsive_tabs_with_accordions_promote_free(); ?>
    <div class="oxilab-admin-wrapper">
        <div class="oxilab-admin-row">
            <h1> Select Layouts</h1>
            <p> View our layouts and select from button with name</p>
        </div>
        <div class="oxilab-admin-row">
            <?php
            $directory = content_tabs_ultimate_plugin_url . '/layouts/';
            $filecount = 0;
            $files = glob($directory . "*.{php}", GLOB_BRACE);
            if ($files) {
                $filecount = count($files);
            }
            $filecount = $filecount - 2;
            for ($i = 1; $i <= $filecount; $i++) {
                $importname = $i;
                $importstatus = '';
                foreach ($importdata as $value) {
                    if ($importname == $value['name']) {
                        $importstatus = 'true';
                    }
                }
                if ($importstatus != 'true') {
                    echo '<div class="oxilab-admin-style-preview">
                        <div class="oxilab-admin-style-preview-top">';
                    include content_tabs_ultimate_plugin_url . 'layouts/style' . $i . '.php';
                    echo '</div>';
                    echo '<div class="oxilab-admin-style-preview-bottom">
                        <div class="oxilab-admin-style-preview-bottom-left-import">
                            Template ' . $i . '
                        </div> ';
                    if ($i > 10 && $status != 'valid') {
                        echo ' <div class="oxilab-admin-style-preview-bottom-right-import">
                                        <button type="button" class="btn btn-danger">Pro Only</button>
                               </div>';
                    } else {
                        echo ' <div class="oxilab-admin-style-preview-bottom-right-import">
                                        <input type="hidden" value="" id="oxi-tabs-data-' . $i . '">
                                        <button type="button" class="btn btn-success" id="oxi-tabs-style-active-' . $i . '">Active</button>
                                  </div>';
                    }
                    echo '</div> </div>
                        <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    jQuery("#oxi-tabs-style-active-' . $i . '").click(function () {
                                        jQuery("#oxi-tabs-import").val("' . $i . '");
                                        jQuery("form#oxi-tabs-import-data").submit();
                                    });
                                });
                        </script>';
                }
            }
            ?>
        </div>
    </div>
    <form method="post" id="oxi-tabs-import-data">
        <input type="hidden" name="oxi-tabs-import" id="oxi-tabs-import" value="">
        <?php wp_nonce_field("oxitabsstyleimport") ?>
    </form>
</div>
