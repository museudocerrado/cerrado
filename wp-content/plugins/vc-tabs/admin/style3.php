<?php
if (!defined('ABSPATH'))
    exit;
responsive_tabs_with_accordions_user_capabilities();
$styleid = $_GET['styleid'];
global $wpdb;
$table_list = $wpdb->prefix . 'content_tabs_ultimate_list';
$table_name = $wpdb->prefix . 'content_tabs_ultimate_style';
$title = '';
$files = '';
$itemid = '';
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}
if (!empty($_POST['submit']) && $_POST['submit'] == 'submit') {
    if (!wp_verify_nonce($nonce, 'oxitabsnewdata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $title = sanitize_text_field(htmlentities($_POST['ctu-title']));
        $details = sanitize_text_field(htmlentities($_POST['ctu-details']));
        if ($_POST['item-id'] == '') {
            $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (title, files, styleid) VALUES ( %s, %s, %d)", array($title, $details, $styleid)));
        }
        if ($_POST['item-id'] != '' && is_numeric($_POST['item-id'])) {
            $item_id = (int) $_POST['item-id'];
            $data = $wpdb->update("$table_list", array("title" => $title, "files" => $details), array('id' => $item_id), array('%s', '%s'), array('%d'));
        }
    }
}
if (!empty($_POST['edit']) && is_numeric($_POST['item-id'])) {
    if (!wp_verify_nonce($nonce, 'oxitabseditdata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $item_id = (int) $_POST['item-id'];
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_list WHERE id = %d ", $item_id), ARRAY_A);
        $title = $data['title'];
        $files = $data['files'];
        $itemid = $data['id'];
        echo '<script type="text/javascript"> jQuery(document).ready(function () {setTimeout(function() { jQuery("#oxilab-add-new-data").modal("show")  }, 500); });</script>';
    }
}

if (!empty($_POST['delete']) && is_numeric($_POST['item-id'])) {
    if (!wp_verify_nonce($nonce, 'oxitabsdeletedata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $item_id = (int) $_POST['item-id'];
        $wpdb->query($wpdb->prepare("DELETE FROM {$table_list} WHERE id = %d ", $item_id));
    }
}
if (!empty($_POST['data-submit']) && $_POST['data-submit'] == 'Save') {
    if (!wp_verify_nonce($nonce, 'oxitabsstylecss')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $data = 'heading-font-size |' . sanitize_text_field($_POST['heading-font-size']) . '|'
                . ' heading-font-color |' . sanitize_text_field($_POST['heading-font-color']) . '| '
                . 'heading-background-color |' . sanitize_text_field($_POST['heading-background-color']) . '| '
                . 'heading-border-color |' . sanitize_text_field($_POST['heading-border-color']) . '| '
                . 'heading-font-active-color |' . sanitize_text_field($_POST['heading-font-active-color']) . '|'
                . ' heading-background-active-color |' . sanitize_text_field($_POST['heading-background-active-color']) . '| '
                . 'heading-border-active-color |' . sanitize_text_field($_POST['heading-border-active-color']) . '| '
                . 'heading-font-familly |' . sanitize_text_field($_POST['heading-font-familly']) . '| '
                . 'heading-font-weight |' . sanitize_text_field($_POST['heading-font-weight']) . '| '
                . 'heading-text-align |' . sanitize_text_field($_POST['heading-text-align']) . '| '
                . 'heading-width |' . sanitize_text_field($_POST['heading-width']) . '| '
                . 'heading-padding |' . sanitize_text_field($_POST['heading-padding']) . '|'
                . 'heading-box-shadow-Blur |' . sanitize_text_field($_POST['heading-box-shadow-Blur']) . '|'
                . ' heading-box-shadow-color |' . sanitize_text_field($_POST['heading-box-shadow-color']) . '| '
                . 'content-font-size |' . sanitize_text_field($_POST['content-font-size']) . '| '
                . 'content-font-color |' . sanitize_text_field($_POST['content-font-color']) . '| '
                . 'content-background-color |' . sanitize_text_field($_POST['content-background-color']) . '| '
                . 'content-padding-top |' . sanitize_text_field($_POST['content-padding-top']) . '| '
                . 'content-padding-right |' . sanitize_text_field($_POST['content-padding-right']) . '| '
                . 'content-padding-bottom |' . sanitize_text_field($_POST['content-padding-bottom']) . '| '
                . 'content-padding-left |' . sanitize_text_field($_POST['content-padding-left']) . '| '
                . 'content-line-height |' . sanitize_text_field($_POST['content-line-height']) . '| '
                . 'content-font-familly |' . sanitize_text_field($_POST['content-font-familly']) . '| '
                . 'content-font-weight |' . sanitize_text_field($_POST['content-font-weight']) . '| '
                . 'content-font-align |' . sanitize_text_field($_POST['content-font-align']) . '| '
                . 'content-box-shadow-color |' . sanitize_text_field($_POST['content-box-shadow-color']) . '| '
                . 'content-box-shadow-Blur |' . sanitize_text_field($_POST['content-box-shadow-Blur']) . '| '
                . 'heading-margin-right |' . sanitize_text_field($_POST['heading-margin-right']) . '| '
                . 'heading-box-shadow-Horizontal |' . sanitize_text_field($_POST['heading-box-shadow-Horizontal']) . '| '
                . 'heading-box-shadow-Vertical |' . sanitize_text_field($_POST['heading-box-shadow-Vertical']) . '| '
                . 'heading-box-shadow-Spread |' . sanitize_text_field($_POST['heading-box-shadow-Spread']) . '| '
                . 'content-box-shadow-Horizontal |' . sanitize_text_field($_POST['content-box-shadow-Horizontal']) . '| '
                . 'content-box-shadow-Vertical |' . sanitize_text_field($_POST['content-box-shadow-Vertical']) . '| '
                . 'content-box-shadow-Spread |' . sanitize_text_field($_POST['content-box-shadow-Spread']) . '| '
                . 'heading-font-style |' . $_POST['heading-font-style'] . '|'
                . ' custom-css |' . $_POST['custom-css'] . '|'
                . ' oxi-tabs-opening |' . sanitize_text_field($_POST['oxi-tabs-opening']) . '|';
        $data = sanitize_text_field($data);
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET css = %s WHERE id = %d", $data, $styleid));
    }
}
$listdata = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_list WHERE styleid = %d ORDER by id ASC ", $styleid), ARRAY_A);
$style = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
$styledata = $style['css'];
$styledata = explode('|', $styledata);
?>
<div class="wrap">
    <?php echo responsive_tabs_with_accordions_promote_free(); ?>
    <div class="oxilab-admin-wrapper">
        <div class="oxilab-admin-row">
            <div class="oxilab-admin-style-panel-left">
                <div class="oxilab-admin-style-panel-left-settings">
                    <div class="oxilab-admin-style-panel-left-settings-row">
                        <form method="post" id="oxi-style-submit">
                            <div class="oxilab-tabs-wrapper">
                                <ul class="oxilab-tabs-ul">
                                    <li ref="#oxilab-tabs-id-4" class="">
                                        Heading
                                    </li>
                                    <li ref="#oxilab-tabs-id-3" class="">
                                        Description
                                    </li>
                                    <li ref="#oxilab-tabs-id-2" class="">
                                        Custom CSS
                                    </li>
                                    <li ref="#oxilab-tabs-id-1">
                                        Support
                                    </li>
                                </ul>
                                <div class="oxilab-tabs-content">
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-4">
                                        <div class="oxilab-tabs-content-div-50">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Initial Opening
                                                </div>
                                                <?php
                                                if (empty($styledata[73])) {
                                                    echo VcTabsAdminTabsInitialOpen(':first');
                                                } else {
                                                    echo VcTabsAdminTabsInitialOpen($styledata[73]);
                                                }
                                                ?>
                                            </div>
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Font Settings
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-font-size" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Title Font Size, Based on Pixel">Font Size </label>
                                                    <div class="col-sm-6 ">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[1]; ?>" id="heading-font-size" name="heading-font-size">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-font-color" class="col-sm-6 control-label heading-font-color" data-toggle="tooltip" data-placement="top" title="Set Your Title Font Color, Based on Color">Color</label>
                                                    <div class="col-sm-6 ">
                                                        <input type="text" class="form-control oxilab-vendor-color" id="heading-font-color" name="heading-font-color" value="<?php echo$styledata[3]; ?>" oxivalue="<?php echo$styledata[3]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-background-color" class="col-sm-6 control-label heading-background-color" data-toggle="tooltip" class="tooltipLink" data-original-title="Set Your Title background Color, Based on Color">Background </label>
                                                    <div class="col-sm-6 ">
                                                        <input type="text" data-format="rgb" data-opacity="true" class="form-control oxilab-vendor-color" id="heading-background-color" name="heading-background-color" value="<?php echo $styledata[5]; ?>" oxivalue="<?php echo $styledata[5]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-border-color" class="col-sm-6 control-label heading-border-color"  data-toggle="tooltip" data-placement="top" title="Customize your Heading Border Color">Border</label>
                                                    <div class="col-sm-6 ">
                                                        <input type="text" class="form-control oxilab-vendor-color" id="heading-border-color" name="heading-border-color" value="<?php echo$styledata[7]; ?>" oxivalue="<?php echo$styledata[7]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-font-active-color" class="col-sm-6 control-label heading-font-active-color"  data-toggle="tooltip" data-placement="top" title="Customize Your Active Title Font Color, Based on Color">Color Active</label>
                                                    <div class="col-sm-6 ">
                                                        <input type="text" class="form-control oxilab-vendor-color" id="heading-font-active-color" name="heading-font-active-color" value="<?php echo $styledata[9]; ?>" oxivalue="<?php echo $styledata[9]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-background-active-color" class="col-sm-6 control-label heading-background-active-color"  data-toggle="tooltip" data-placement="top" title="Set Your Active Title Background Color, Based on Color">Background Active </label>
                                                    <div class="col-sm-6 ">
                                                        <input type="text" data-format="rgb" data-opacity="true" class="form-control oxilab-vendor-color" id="heading-background-active-color" name="heading-background-active-color" value="<?php echo $styledata[11]; ?>" oxivalue="<?php echo $styledata[11]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-font-border-color" class="col-sm-6 control-label heading-border-active-color"  data-toggle="tooltip" data-placement="top" title="Customize your Active Border Color">Active Border</label>
                                                    <div class="col-sm-6 ">
                                                        <input type="text" class="form-control oxilab-vendor-color" id="heading-border-active-color" name="heading-border-active-color" value="<?php echo $styledata[13]; ?>" oxivalue="<?php echo $styledata[13]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-font-familly" class="col-sm-6 col-form-label heading-font-familly"  data-toggle="tooltip" data-placement="top" title="Choose Your Title Preferred font, Based on Google Font"> Font Family </label>
                                                    <div class="col-sm-6 ">
                                                        <input class="oxi-admin-font" type="text" name="heading-font-familly" id="heading-font-familly" value="<?php echo $styledata[15]; ?>" oxivalue="<?php echo $styledata[15]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-font-weight" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title=" Customize Your Title Font Weight, Based on CSS Weight" >Font Weight  </label>
                                                    <div class="col-sm-6 ">
                                                        <select class="form-control" id="heading-font-weight" name="heading-font-weight">
                                                            <option value="100"     <?php
                                                            if ($styledata[17] == '100') {
                                                                echo 'selected';
                                                            };
                                                            ?>>100</option>
                                                            <option value="200"     <?php
                                                            if ($styledata[17] == '200') {
                                                                echo 'selected';
                                                            };
                                                            ?>>200</option>
                                                            <option value="300"     <?php
                                                            if ($styledata[17] == '300') {
                                                                echo 'selected';
                                                            };
                                                            ?>>300</option>
                                                            <option value="400"     <?php
                                                            if ($styledata[17] == '400') {
                                                                echo 'selected';
                                                            };
                                                            ?>>400</option>
                                                            <option value="500"     <?php
                                                            if ($styledata[17] == '500') {
                                                                echo 'selected';
                                                            };
                                                            ?>>500</option>
                                                            <option value="600"     <?php
                                                            if ($styledata[17] == '600') {
                                                                echo 'selected';
                                                            };
                                                            ?>>600</option>
                                                            <option value="700"     <?php
                                                            if ($styledata[17] == '700') {
                                                                echo 'selected';
                                                            };
                                                            ?>>700</option>
                                                            <option value="800"     <?php
                                                            if ($styledata[17] == '800') {
                                                                echo 'selected';
                                                            };
                                                            ?>>800</option>
                                                            <option value="900"     <?php
                                                            if ($styledata[17] == '900') {
                                                                echo 'selected';
                                                            };
                                                            ?>>900</option>
                                                            <option value="normal" <?php
                                                            if ($styledata[17] == 'normal') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Normal</option>
                                                            <option value="bold"    <?php
                                                            if ($styledata[17] == 'bold') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Bold</option>
                                                            <option value="lighter" <?php
                                                            if ($styledata[17] == 'lighter') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Lighter</option>
                                                            <option value="initial"   <?php
                                                            if ($styledata[17] == 'initial') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Initial</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-font-style" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Your Heading Font Style"> Font Style</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" id="heading-font-style" name="heading-font-style">
                                                            <option <?php
                                                            if ($styledata[69] == 'normal') {
                                                                echo 'selected';
                                                            }
                                                            ?> value="normal">Normal</option>
                                                            <option <?php
                                                            if ($styledata[69] == 'italic') {
                                                                echo 'selected';
                                                            }
                                                            ?> value="italic">Italic</option>
                                                            <option <?php
                                                            if ($styledata[69] == 'oblique') {
                                                                echo 'selected';
                                                            }
                                                            ?> value="oblique">Oblique</option>
                                                            <option <?php
                                                            if ($styledata[69] == 'initial') {
                                                                echo 'selected';
                                                            }
                                                            ?> value="initial">Initial</option>
                                                            <option <?php
                                                            if ($styledata[69] == 'inherit') {
                                                                echo 'selected';
                                                            }
                                                            ?> value="inherit">Inherit</option>
                                                        </select>
                                                    </div>
                                                </div> 

                                            </div>

                                        </div>
                                        <div class="oxilab-tabs-content-div-50">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Body Settings
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-text-align" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Set Your Title Position">Heading Align  </label>
                                                    <div class="col-sm-6 ">
                                                        <select class="form-control" id="heading-text-align" name="heading-text-align">
                                                            <option value="flex-start"     <?php
                                                            if ($styledata[19] == 'flex-start') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Left</option>
                                                            <option value="center"     <?php
                                                            if ($styledata[19] == 'center') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Center</option>
                                                            <option value="flex-end"     <?php
                                                            if ($styledata[19] == 'flex-end') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Right</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-width" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Customize Your Title Font Weight, Based on CSS Weight">Width </label>
                                                    <div class="col-sm-6 ">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[21]; ?>" id="heading-width" name="heading-width">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-padding" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Use Padding to generate space around Title, Based on Pixel">Padding </label>
                                                    <div class="col-sm-6 ">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[23]; ?>" id="heading-padding" name="heading-padding">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-margin-right" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Generate Custom Space Between Title to Title, Based on Pixel">Margin Right </label>
                                                    <div class="col-sm-6 ">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[55]; ?>" id="heading-margin-right" name="heading-margin-right">
                                                    </div>
                                                </div>                                               
                                            </div>
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Box Shadow
                                                </div>                                                  
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-box-shadow-Horizontal" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Attach Shadow Horizontal Vertical on Title box, Based on Pixel ">Box Shadow Length</label>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[57]; ?>" id="heading-box-shadow-Horizontal" name="heading-box-shadow-Horizontal">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[59]; ?>" id="heading-box-shadow-Vertical" name="heading-box-shadow-Vertical">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-box-shadow-Blur" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Attach Shadow Blur and Spread on Title box, Based on Pixel ">Blur and Spread Radius</label>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[25]; ?>" id="heading-box-shadow-Blur" name="heading-box-shadow-Blur">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[61]; ?>" id="heading-box-shadow-Spread" name="heading-box-shadow-Spread">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="heading-box-shadow-color" class="col-sm-6 control-label heading-box-shadow-color"  data-toggle="tooltip" data-placement="top" title="Add Shadow Color to Title Box, Based on Color">Box Shadow Color </label>
                                                    <div class="col-sm-6 ">
                                                        <input type="text" data-format="rgb" data-opacity="true" class="form-control oxilab-vendor-color" id="heading-box-shadow-color" name="heading-box-shadow-color" value="<?php echo $styledata[27]; ?>" oxivalue="<?php echo $styledata[27]; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-3">
                                        <div class="oxilab-tabs-content-div-50">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Font Settings
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-font-size" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Customize Your Content Font Size, Based on Pixel">Font Size </label>
                                                    <div class="col-sm-6 ">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[29]; ?>" id="content-font-size" name="content-font-size">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-font-color" class="col-sm-6 control-label content-font-color"  data-toggle="tooltip" data-placement="top" title="Set Custom Content Font Color, Based on Color">Color </label>
                                                    <div class="col-sm-6 ">
                                                        <input type="text" class="form-control oxilab-vendor-color" id="content-font-color" name="content-font-color" value="<?php echo $styledata[31]; ?>" oxivalue="<?php echo $styledata[31]; ?>">
                                                    </div>
                                                </div>                                                
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-line-height" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Customize Your Content Font Line Height, Based on Point">Line Height </label>
                                                    <div class="col-sm-6 ">
                                                        <input class="form-control" type="number" step="0.1" value="<?php echo $styledata[43]; ?>" id="content-line-height" name="content-line-height">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-font-familly" class="col-sm-6 col-form-label content-font-familly"  data-toggle="tooltip" data-placement="top" title="Choose Your Content Font, Based on Google Font"> Font Family </label>
                                                    <div class="col-sm-6 ">
                                                        <input class="oxi-admin-font" value="<?php echo $styledata[45]; ?>" oxivalue="<?php echo $styledata[45]; ?>" type="text" name="content-font-familly" id="content-font-familly">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-font-weight" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Content Font Weight, Based on CSS Weight">Font Weight  </label>
                                                    <div class="col-sm-6 ">
                                                        <select class="form-control" id="content-font-weight" name="content-font-weight">
                                                            <option value="100" <?php
                                                            if ($styledata[47] == '100') {
                                                                echo 'selected';
                                                            };
                                                            ?>>100</option>
                                                            <option value="200" <?php
                                                            if ($styledata[47] == '200') {
                                                                echo 'selected';
                                                            };
                                                            ?>>200</option>
                                                            <option value="300" <?php
                                                            if ($styledata[47] == '300') {
                                                                echo 'selected';
                                                            };
                                                            ?>>300</option>
                                                            <option value="400" <?php
                                                            if ($styledata[47] == '400') {
                                                                echo 'selected';
                                                            };
                                                            ?>>400</option>
                                                            <option value="500" <?php
                                                            if ($styledata[47] == '500') {
                                                                echo 'selected';
                                                            };
                                                            ?>>500</option>
                                                            <option value="600" <?php
                                                            if ($styledata[47] == '600') {
                                                                echo 'selected';
                                                            };
                                                            ?>>600</option>
                                                            <option value="700" <?php
                                                            if ($styledata[47] == '700') {
                                                                echo 'selected';
                                                            };
                                                            ?>>700</option>
                                                            <option value="800" <?php
                                                            if ($styledata[47] == '800') {
                                                                echo 'selected';
                                                            };
                                                            ?>>800</option>
                                                            <option value="900" <?php
                                                            if ($styledata[47] == '900') {
                                                                echo 'selected';
                                                            };
                                                            ?>>900</option>
                                                            <option value="normal" <?php
                                                            if ($styledata[47] == 'normal') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Normal</option>
                                                            <option value="bold" <?php
                                                            if ($styledata[47] == 'bold') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Bold</option>
                                                            <option value="lighter" <?php
                                                            if ($styledata[47] == 'lighter') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Lighter</option>
                                                            <option value="initial" <?php
                                                            if ($styledata[47] == 'initial') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Initial</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-font-align" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Set Content Text Position, Based on left or center or Right">Text Align  </label>
                                                    <div class="col-sm-6 ">
                                                        <select class="form-control" id="content-font-align" name="content-font-align">
                                                            <option value="left" <?php
                                                            if ($styledata[49] == '100') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Left</option>
                                                            <option value="center" <?php
                                                            if ($styledata[49] == '100') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Center</option>
                                                            <option value="right" <?php
                                                            if ($styledata[49] == '100') {
                                                                echo 'selected';
                                                            };
                                                            ?>>Right</option>
                                                        </select>
                                                    </div>
                                                </div>                                               
                                            </div>
                                        </div>
                                        <div class="oxilab-tabs-content-div-50">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Body Settings
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-background-color" class="col-sm-6 control-label content-background-color"  data-toggle="tooltip" data-placement="top" title="Set Custom Background Color of Content Box">Background Color </label>
                                                    <div class="col-sm-6 ">
                                                        <input type="text" data-format="rgb" data-opacity="true" class="form-control oxilab-vendor-color" id="content-background-color" name="content-background-color" value="<?php echo $styledata[33]; ?>" oxivalue="<?php echo $styledata[33]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-padding-top" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Use Padding to Generate Space Around Content as top, right, bottom, left. Based on Pixel">Padding top bottom </label>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[35]; ?>" id="content-padding-top" name="content-padding-top">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[39]; ?>" id="content-padding-bottom" name="content-padding-bottom">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-padding-top" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Use Padding to Generate Space Around Content as top, right, bottom, left. Based on Pixel">Padding right left </label>

                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[37]; ?>" id="content-padding-right" name="content-padding-right">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[41]; ?>" id="content-padding-left" name="content-padding-left">
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Body Settings
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-box-shadow-color" class="col-sm-6 control-label content-box-shadow-color"  data-toggle="tooltip" data-placement="top" title="Add custom Shadow Color to Content Box">Box Shadow Color </label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control oxilab-vendor-color" id="content-box-shadow-color" name="content-box-shadow-color" value="<?php echo $styledata[51]; ?>" oxivalue="<?php echo $styledata[51]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-box-shadow" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Attach Shadow Length to Content Box, Based on Pixel ">Box Shadow Length</label>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[63]; ?>" id="content-box-shadow-Horizontal" name="content-box-shadow-Horizontal">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[65]; ?>" id="content-box-shadow-Vertical" name="content-box-shadow-Vertical">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-group-sm">
                                                    <label for="content-box-shadow" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Attach Shadow Spread to Content Box, Based on Pixel ">Blur and Spread Radius </label>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[53]; ?>" id="content-box-shadow-Blur" name="content-box-shadow-Blur">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-control" type="number" value="<?php echo $styledata[67]; ?>" id="content-box-shadow-Spread" name="content-box-shadow-Spread">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-2">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="custom-css" class="custom-css">Custom CSS:</label>
                                                <textarea class="form-control" rows="4" id="custom-css" name="custom-css"><?php echo $styledata[71]; ?></textarea>
                                                <small class="form-text text-muted">Add Your Custom CSS.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-1">
                                        <?php echo responsive_tabs_with_accordions_video_toturial(); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="oxilab-setting-save">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="data-submit" value="Save">
                                <?php wp_nonce_field("oxitabsstylecss") ?>
                            </div>
                        </form>
                        <script type="text/javascript">
                            jQuery(document).ready(function () {
                                jQuery(".oxilab-tabs-ul li:first").addClass("active");
                                jQuery(".oxilab-tabs-content-tabs:first").addClass("active");
                                jQuery(".oxilab-tabs-ul li").click(function () {
                                    jQuery(".oxilab-tabs-ul li").removeClass("active");
                                    jQuery(this).toggleClass("active");
                                    jQuery(".oxilab-tabs-content-tabs").removeClass("active");
                                    var activeTab = jQuery(this).attr("ref");
                                    jQuery(activeTab).addClass("active");
                                });
                                jQuery("#heading-font-size").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{font-size: " + jQuery("#heading-font-size").val() + "px;} </style>").appendTo("#oxilab-preview-data");
                                    jQuery("<style type='text/css'> .ctu-ultimate-style-heading-<?php echo $styleid; ?>{font-size: " + jQuery("#heading-font-size").val() + "px;} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-font-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{color: " + jQuery("#heading-font-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                    jQuery("<style type='text/css'> .ctu-ultimate-style-heading-<?php echo $styleid; ?>{color: " + jQuery("#heading-font-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-background-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?>{background-color: " + jQuery("#heading-background-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                    jQuery("<style type='text/css'> .ctu-ultimate-style-heading-<?php echo $styleid; ?>{background-color: " + jQuery("#heading-background-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-border-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{border-color: " + jQuery("#heading-border-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-font-active-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{color: " + jQuery("#heading-font-active-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                    jQuery("<style type='text/css'> .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{color: " + jQuery("#heading-font-active-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-background-active-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{background-color: " + jQuery("#heading-background-active-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                    jQuery("<style type='text/css'> .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{background-color: " + jQuery("#heading-background-active-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-border-active-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{border-color: " + jQuery("#heading-border-active-color").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery('#heading-font-familly').fontselect().change(function () {
                                    var font = jQuery(this).val().replace(/\+/g, ' ');
                                    font = font.split(':');
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{ font-family:" + font[0] + ";} </style>").appendTo(".oxilab-preview-data");
                                    jQuery("<style type='text/css'> .ctu-ultimate-style-heading-<?php echo $styleid; ?>{ font-family:" + font[0] + ";} </style>").appendTo(".oxilab-preview-data");
                                });
                                jQuery("#heading-font-weight").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{font-weight: " + jQuery("#heading-font-weight").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                    jQuery("<style type='text/css'> .ctu-ultimate-style-heading-<?php echo $styleid; ?>{font-weight: " + jQuery("#heading-font-weight").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-font-style").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{ font-style: " + jQuery(this).val() + ";} </style>").appendTo(".ctu-ultimate-wrapper-<?php echo $styleid; ?>");
                                });
                                jQuery("#heading-text-align").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?>{justify-content: " + jQuery("#heading-text-align").val() + "; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-width").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{width: " + jQuery("#heading-width").val() + "px; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-padding").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{padding: " + jQuery("#heading-padding").val() + "px 10px; } </style>").appendTo("#oxilab-preview-data");
                                    jQuery("<style type='text/css'> .ctu-ultimate-style-heading-<?php echo $styleid; ?>{padding: " + jQuery("#heading-padding").val() + "px 10px; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-margin-right").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{margin: 0 " + jQuery("#heading-margin-right").val() + "px 0 0; } </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-box-shadow-Horizontal").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ultimate-wrapper-<?php echo $styleid; ?>{box-shadow: " + jQuery("#heading-box-shadow-Horizontal").val() + "px " + jQuery("#heading-box-shadow-Vertical").val() + "px " + jQuery("#heading-box-shadow-Blur").val() + "px " + jQuery("#heading-box-shadow-Spread").val() + "px " + jQuery("#heading-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-box-shadow-Vertical").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ultimate-wrapper-<?php echo $styleid; ?>{box-shadow: " + jQuery("#heading-box-shadow-Horizontal").val() + "px " + jQuery("#heading-box-shadow-Vertical").val() + "px " + jQuery("#heading-box-shadow-Blur").val() + "px " + jQuery("#heading-box-shadow-Spread").val() + "px " + jQuery("#heading-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-box-shadow-Blur").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ultimate-wrapper-<?php echo $styleid; ?>{box-shadow: " + jQuery("#heading-box-shadow-Horizontal").val() + "px " + jQuery("#heading-box-shadow-Vertical").val() + "px " + jQuery("#heading-box-shadow-Blur").val() + "px " + jQuery("#heading-box-shadow-Spread").val() + "px " + jQuery("#heading-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-box-shadow-Spread").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ultimate-wrapper-<?php echo $styleid; ?>{box-shadow: " + jQuery("#heading-box-shadow-Horizontal").val() + "px " + jQuery("#heading-box-shadow-Vertical").val() + "px " + jQuery("#heading-box-shadow-Blur").val() + "px " + jQuery("#heading-box-shadow-Spread").val() + "px " + jQuery("#heading-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#heading-box-shadow-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ultimate-wrapper-<?php echo $styleid; ?>{box-shadow: " + jQuery("#heading-box-shadow-Horizontal").val() + "px " + jQuery("#heading-box-shadow-Vertical").val() + "px " + jQuery("#heading-box-shadow-Blur").val() + "px " + jQuery("#heading-box-shadow-Spread").val() + "px " + jQuery("#heading-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-font-size").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{font-size: " + jQuery("#content-font-size").val() + "px;} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-font-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{color: " + jQuery("#content-font-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-line-height").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{line-height: " + jQuery("#content-line-height").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery('#content-font-familly').fontselect().change(function () {
                                    var font = jQuery(this).val().replace(/\+/g, ' ');
                                    font = font.split(':');
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{ font-family:" + font[0] + ";} </style>").appendTo(".oxilab-preview-data");
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{ font-family:" + font[0] + ";} </style>").appendTo(".oxilab-preview-data");
                                });
                                jQuery("#content-font-weight").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{font-weight: " + jQuery("#content-font-weight").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-font-align").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{text-align: " + jQuery("#content-font-align").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-background-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{background-color: " + jQuery("#content-background-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-padding-top").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-padding-bottom").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-padding-right").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-padding-left").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{padding: " + jQuery("#content-padding-top").val() + "px " + jQuery("#content-padding-right").val() + "px " + jQuery("#content-padding-bottom").val() + "px " + jQuery("#content-padding-left").val() + "px;} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-box-shadow-Horizontal").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-box-shadow-Vertical").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-box-shadow-Blur").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-box-shadow-Spread").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });
                                jQuery("#content-box-shadow-color").on("change", function () {
                                    jQuery("<style type='text/css'> .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{box-shadow: " + jQuery("#content-box-shadow-Horizontal").val() + "px " + jQuery("#content-box-shadow-Vertical").val() + "px " + jQuery("#content-box-shadow-Blur").val() + "px " + jQuery("#content-box-shadow-Spread").val() + "px " + jQuery("#content-box-shadow-color").val() + ";} </style>").appendTo("#oxilab-preview-data");
                                });

                            });
                        </script>
                    </div>
                </div>
                <div class="oxilab-admin-style-panel-left-preview">
                    <div class="oxilab-admin-style-panel-left-preview-heading">
                        <div class="oxilab-admin-style-panel-left-preview-heading-left">
                            Preview
                        </div>
                        <div class="oxilab-admin-style-panel-left-preview-heading-right">
                            <input type="text" class="form-control oxilab-vendor-color"  data-format="rgb" data-opacity="true"  id="oxilab-preview-data-background" value="rgba(255, 255, 255, 1)">
                        </div>
                    </div>
                    <div class="oxilab-preview-data" id="oxilab-preview-data">
                        <?php oxi_responsive_tabs_shortcode_function($styleid, 'admin') ?>
                    </div>
                </div>
            </div>
            <div class="oxilab-admin-style-panel-right">
                <?php echo VcTabsAdminRightSideData($styleid, $style); ?>
                <div id="content-tabs-ultimate-drag-and-drop-data" class="modal fade bd-example-modal-sm" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <form id="content-tabs-ultimate-drag-submit">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Rearrange Tabs</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert text-center" id="content-tabs-ultimate-drag-saving">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </div>
                                    <?php
                                    echo ' <ul class="list-group" id="content-tabs-ultimate-drag-drop">';
                                    foreach ($listdata as $value) {
                                        echo '<li class="list-group-item" id ="' . $value['id'] . '">' . $value['title'] . '</li>';
                                    }
                                    echo '</ul>';
                                    ?>
                                </div>
                                <div class="modal-footer">    
                                    <input type="hidden" name="vc-tabs-ajax-nonce" id="vc-tabs-ajax-nonce" value="<?php echo wp_create_nonce("vc_tabs_ajax_data"); ?>"/>
                                    <button type="button" id="content-tabs-ultimate-drag-and-drop-data-close" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <input type="submit" id="content-tabs-ultimate-drag-and-drop-data-submit" class="btn btn-primary" value="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>          
            <div id="oxilab-add-new-data" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <form method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Items Add or Edit</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="ctu-title"  data-toggle="tooltip" data-placement="top">Title</label>
                                    <input type="text "class="form-control" id="cau-title" name="ctu-title" value="<?php echo $title; ?>">
                                    <small class="form-text text-muted">Add or Modify Your Tabs Title.</small>
                                </div>
                                <div class="form-group">
                                    <label for="ctu-details">Details:</label>
                                    <?php
                                    wp_editor(ctu_admin_special_charecter($files), 'ctu-details', $settings = array(
                                        'textarea_name' => 'ctu-details',
                                        'wpautop' => false,
                                        'force_br_newlines' => true,
                                        'force_p_newlines' => false)
                                    );
                                    ?>
                                    <small class="form-text text-muted">Add or Modify Your Content.</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="item-id" name="item-id" value="<?php echo $itemid ?>">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" id="item-submit" name="submit" value="submit">
                            </div>
                        </div>
                        <?php wp_nonce_field("oxitabsnewdata") ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var str = '<script type="text/javascript">';
    str += 'setTimeout(function () {';
    str += ' jQuery(".media-button-insert").on("click", function () {';
    str += ' jQuery("#oxilab-add-new-data").css({"overflow-x": "hidden", "overflow-y": "auto"});jQuery("body").css({ "overflow" : "hidden" });';
    str += ' });';
    str += ' jQuery(".media-modal-close").on("click", function () {';
    str += ' jQuery("#oxilab-add-new-data").css({"overflow-x": "hidden", "overflow-y": "auto"});jQuery("body").css({ "overflow" : "hidden" });';
    str += '});';
    str += '}, 1000);';
    str += '<';
    str += '/script>';
    jQuery('#oxilab-admin-add-new-item').on('click', function () {
        jQuery("#oxilab-add-new-data").modal("show");
        jQuery("#ctu-title").val('');
        jQuery("ctu-details").val('');
        jQuery("#item-id").val('');
    });
    jQuery('#insert-media-button').on('click', function () {
        jQuery(str).appendTo("#oxilab-add-new-data");
    });



</script>