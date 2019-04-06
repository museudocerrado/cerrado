<?php
if (!defined('ABSPATH'))
    exit;
responsive_tabs_with_accordions_user_capabilities();

global $wpdb;
$table_import = $wpdb->prefix . 'content_tabs_ultimate_import';
if (!empty($_POST['submit']) && $_POST['submit'] == 'Save') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'oxitabsstyleselect')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $oxitabsstyle = sanitize_text_field($_POST['oxi-tabs-style']);
        $oxitabsname = sanitize_text_field($_POST['style-name']);
        $oxitabsdata = sanitize_text_field($_POST['oxi-tabs-data']);
        $table_name = $wpdb->prefix . 'content_tabs_ultimate_style';
        $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, style_name, css) VALUES ( %s, %s, %s )", array($oxitabsname, $oxitabsstyle, $oxitabsdata)));
        $redirect_id = $wpdb->insert_id;
        if ($redirect_id == 0) {
            $url = admin_url("admin.php?page=content-tabs-ultimate-new");
        }
        if ($redirect_id != 0) {
            $url = admin_url("admin.php?page=content-tabs-ultimate-new&styleid=$redirect_id");
        }
        echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
        exit;
    }
}

if (!empty($_POST['oxi-tabs-import']) && $_POST['oxi-tabs-import'] != '') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'oxitabsstyleimportdeactive')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $oxitabsimport = sanitize_text_field($_POST['oxi-tabs-import']);
        $wpdb->query($wpdb->prepare("DELETE FROM {$table_import} WHERE name = %d ", $oxitabsimport));
    }
}

$importdata = $wpdb->get_results("SELECT * FROM $table_import ORDER by name ASC ", ARRAY_A);
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
            foreach ($importdata as $value) {
                $stylesrtid = $value['name'];
                echo '<div class="oxilab-admin-style-preview" id="style' . $value['name'] . '">
                        <div class="oxilab-admin-style-preview-top">';
                include content_tabs_ultimate_plugin_url . 'layouts/style' . $value['name'] . '.php';
                echo '</div>';
                echo '<div class="oxilab-admin-style-preview-bottom">
                        <div class="oxilab-admin-style-preview-bottom-left">
                            Template ' . $stylesrtid . '
                        </div>        
                        <div class="oxilab-admin-style-preview-bottom-right">
                              <button type="button" class="btn btn-warning" id="oxi-tabs-style-deactive-' . $stylesrtid . '">Deactive</button>
                              <button type="button" class="btn btn-success" id="oxi-tabs-style-' . $stylesrtid . '" data-toggle="modal" data-target="#oxi-tabs-style-model">Create New</button>
                        </div>
                     </div>';
                echo ' </div>';
                echo ' 
                     <script type="text/javascript">                                  
                        jQuery(document).ready(function () {
                            jQuery("#oxi-tabs-style-deactive-' . $stylesrtid . '").click(function () {
                                    var status = confirm("Do you Want to Deactive?");
                                    if (status == false) {
                                        return false;
                                    } else {
                                        jQuery("#oxi-tabs-import").val("' . $stylesrtid . '");
                                        jQuery("form#oxi-tabs-import-data").submit();
                                    }                                
                            });
                            jQuery("#oxi-tabs-style-' . $stylesrtid . '").on("click", function () {
                                 jQuery("#oxi-tabs-style").val("");
                                 jQuery("#oxi-tabs-data").val("");
                                 jQuery("#style-name").val("");
                                 jQuery("#oxi-tabs-data").val(jQuery("#oxi-tabs-data-' . $stylesrtid . '").val());
                                 jQuery("#oxi-tabs-style").val("style' . $stylesrtid . '");                 
                             });
                        });        
                    </script>';
            }
            ?>
            <div class="oxilab-admin-style-preview">
                <div class="oxilab-admin-style-preview-top">
                    <a href="<?php echo admin_url("admin.php?page=content-tabs-ultimate-import"); ?>">
                        <div class="oxilab-admin-add-new-item">
                            <span>
                                <?php echo VcTabsAdminFontAwesome('plus'); ?>
                                Add More Templates
                            </span>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <form method="post" id="oxi-tabs-import-data">
        <input type="hidden" name="oxi-tabs-import" id="oxi-tabs-import" value="">
        <?php wp_nonce_field("oxitabsstyleimportdeactive") ?>
    </form>
    <div class="modal fade" id="oxi-tabs-style-model" >
        <form method="post">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Tabs Settings</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row form-group-sm">
                            <label for="style" class="col-sm-6 col-form-label"  data-toggle="tooltip" class="tooltipLink" data-original-title="Give Your Template Name">Name</label>
                            <div class="col-sm-6 nopadding">
                                <input class="form-control" type="text" value="" id='style-name'  name="style-name">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="oxi-tabs-style" id="oxi-tabs-style" value="">
                        <input type="hidden" name="oxi-tabs-data" id="oxi-tabs-data" value="">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Save">
                        <?php wp_nonce_field("oxitabsstyleselect") ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>