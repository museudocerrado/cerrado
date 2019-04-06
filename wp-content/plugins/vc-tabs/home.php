<?php
if (!defined('ABSPATH'))
    exit;
responsive_tabs_with_accordions_user_capabilities();
wp_enqueue_script('oxilab-bootstrap', plugins_url('js-css/bootstrap.min.js', __FILE__));
wp_enqueue_style('oxilab-bootstrap', plugins_url('js-css/bootstrap.min.css', __FILE__));
wp_enqueue_style('oxilab-style', plugins_url('js-css/admin.css', __FILE__));
$faversion = get_option('oxi_addons_font_awesome_version');
$faversion = explode('||', $faversion);
wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
global $wpdb;
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}

if (!empty($_POST['delete']) && is_numeric($_POST['id'])) {
    if (!wp_verify_nonce($nonce, 'oxitabsstyledelete')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        global $wpdb;
        $id = (int) $_POST['id'];
        $table_name = $wpdb->prefix . 'content_tabs_ultimate_style';
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id));
    }
}

if (!empty($_POST['export']) && is_numeric($_POST['id'])) {
    if (!wp_verify_nonce($nonce, 'oxitabsstyleexport')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        global $wpdb;
        $id = (int) $_POST['id'];
        $table_name = $wpdb->prefix . 'content_tabs_ultimate_style';
        $table_list = $wpdb->prefix . 'content_tabs_ultimate_list';
        $style = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $id), ARRAY_A);
        $files = $wpdb->get_results("SELECT * FROM $table_list WHERE styleid = '$id' ORDER BY id ASC", ARRAY_A);
        $importdata = 'content-tabs-ultimate-newOxiAddonsImportAddons';
        $importdata .= $style['name'] . '|||OxiAddonsImport|||';
        $importdata .= $style['style_name'] . '|||OxiAddonsImport|||';
        $importdata .= $style['css'];
        $importdata .= 'OxiAddonsImportAddons';
        foreach ($files as $value) {
            $importdata .= $value['title'] . '|||OxiAddonsImport|||';
            $importdata .= $value['files'] . '|||OxiAddonsImport|||';
            $importdata .= $value['css'];
            $importdata .= '|||OxiAddonsImportFiles|||';
        }

        $jQuery = ' jQuery("#oxi-addons-style-export-data").modal("show"); 
                    jQuery(".OxiAddImportDatacontent").on("click", function () {
                        jQuery("#OxiAddImportDatacontent").select();
                        document.execCommand("copy"); 
                        alert("Your Style Data Copied")
                        jQuery("#oxi-addons-style-export-data").modal("hide"); 
                    })';
        wp_add_inline_script('oxilab-bootstrap', $jQuery);
        echo '<div class="modal fade" id="oxi-addons-style-export-data" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">                    
                                <h4 class="modal-title">Export Data</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                             <textarea style="width:100%; min-height:250px" id="OxiAddImportDatacontent" class="oxi-addons-export-data-code">' . $importdata . '</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-info OxiAddImportDatacontent")">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
$data = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'content_tabs_ultimate_style ORDER BY id DESC', ARRAY_A);
?>
<div class="wrap">
    <?php echo responsive_tabs_with_accordions_promote_free(); ?>
    <div class="oxilab-admin-wrapper">
        <div class="oxilab-admin-row">


            <h1>Responsive Tabs with Accordions</h1>
            <div class="oxilab-admin-wrapper table-responsive" style="margin-top: 20px; margin-bottom: 20px;">
                <?php
                if (count($data) == 0) {
                    ?>
                    <div class="oxilab-admin-style-preview">
                        <div class="oxilab-admin-style-preview-top">
                            <a href="<?php echo admin_url("admin.php?page=content-tabs-ultimate-new"); ?>">
                                <div class="oxilab-admin-add-new-item">
                                    <span>
                                        <?php echo VcTabsAdminFontAwesome('plus'); ?>
                                        Create Your First Tabs
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php
                } else {
                    ?>
                    <table class="table table-hover widefat " style="background-color: #fff; border: 1px solid #ccc">
                        <thead>
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th style="width: 10%">Name</th>
                                <th style="width: 15%">Template</th>
                                <th style="width: 35%">Shortcode</th>
                                <th style="width: 35%">Edit Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $value) {
                                $id = $value['id'];
                                echo ' <tr>';
                                echo ' <td>' . $id . '</td>';
                                echo '  <td >' . $value['name'] . '</td>';
                                echo ' <td >' . ucfirst(chunk_split($value['style_name'], 5, " ")) . '</td>';
                                echo '<td ><span style=" display: block; padding: 0 0 5px;">Shortcode <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[ctu_ultimate_oxi id=&quot;' . $id . '&quot;]"></span>'
                                . '<span>Php Code <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[ctu_ultimate_oxi  id=&quot;' . $id . '&quot;]&#039;); ?&gt;"></span></td>';
                                echo '<td >
                                        <form method="post">
                                           ' . wp_nonce_field("oxitabsstyleexport") . '
                                           <input type="hidden" name="id" value="' . $id . '">
                                           <button class="btn btn-success" title="Export Style" style="float:left; margin-right: 5px; margin-left: 5px;"  type="submit" value="export" name="export">Export</button>
                                       </form>
                                       <a href="' . admin_url("admin.php?page=content-tabs-ultimate-new&styleid=$id") . '"  title="Edit"  class="btn btn-info" style="float:left; margin-right: 5px; margin-left: 5px;">Edit</a>
                                       <form method="post" class="oxi-tabs-delete">
                                               ' . wp_nonce_field("oxitabsstyledelete") . '
                                               <input type="hidden" name="id" value="' . $id . '">
                                               <button class="btn btn-danger" style="float:left"  title="Delete"  type="submit" value="delete" name="delete">Delete</button>  
                                       </form
                                    </td>';
                                echo ' </tr>';
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <script type="text/javascript">
                jQuery(document).ready(function () {
                    jQuery('.oxi-tabs-delete').submit(function () {
                        var status = confirm("Do you Want to Delete?");
                        if (status == false) {
                            return false;
                        } else {
                            return true;
                        }
                    });
                });

            </script> 
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
                                <input type="hidden" name="oxi-tabs-id" id="oxi-tabs-id" value="">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="submit" value="Clone">
                                <?php wp_nonce_field("oxitabsstyleclone") ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>