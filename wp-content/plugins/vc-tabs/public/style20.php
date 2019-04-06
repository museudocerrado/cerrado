<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style20($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    ?>
    <style>
        .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?>{
            margin: 0 0 0 0;
            width: 100%;
            float: left;
            position: relative;
            list-style: none;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            overflow: hidden;
            text-align: center;
            -webkit-box-pack: start <?php echo $styledata[7]; ?>;
            -ms-flex-pack:  <?php echo $styledata[7]; ?>;
            -o-flex-pack:  <?php echo $styledata[7]; ?>;
            -moz-flex-pack:  <?php echo $styledata[7]; ?>;
            justify-content: <?php echo $styledata[7]; ?>;
            margin-bottom: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            width: 100%;
            float: left;
            position: relative;
            list-style: none;
            cursor: pointer;
            max-width: <?php echo $styledata[9]; ?>px;
            margin-bottom: 0;
            margin-right: <?php echo $styledata[13]; ?>px;
            padding: <?php echo $styledata[11]; ?>px 10px;
            text-align: center;
            font-size: <?php echo $styledata[1]; ?>px;
            font-style: <?php echo $styledata[35]; ?>;
            font-family:   <?php echo ctu_font_familly_special_charecter($styledata[3]); ?>;
            font-weight: <?php echo $styledata[5]; ?>;
            line-height: 100%;
            bottom: -5px;
            border-radius: <?php echo $styledata[15]; ?>px <?php echo $styledata[15]; ?>px 0 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li:last-child{
            margin-right: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            bottom: 0;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: 100%;
            float: left;
            overflow: hidden;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            width: 100%;
            float:left;
            cursor: pointer;
            display: none;
            line-height: 100%;
            font-size: <?php echo $styledata[1]; ?>px;
            padding: <?php echo $styledata[11]; ?>px 10px;
            font-weight: <?php echo $styledata[5]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[3]); ?>;
            border-radius: 5px;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            border-radius: 5px 5px 0 0;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            display: none;
            float:left;
            width: 100%;
            text-align: <?php echo $styledata[33]; ?>;
            padding: <?php echo $styledata[19]; ?>px <?php echo $styledata[21]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[25]; ?>px ;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            font-size: <?php echo $styledata[17]; ?>px;
            font-weight: <?php echo $styledata[31]; ?>;
            line-height: <?php echo $styledata[27]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[29]); ?>;
            margin-top:0;
            margin-bottom:0;
        }
        @media only screen and (max-width: 900px) {

            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                width: 100%;
                overflow:   visible;
            }
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
                margin-bottom: 10px;
            }
            .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
                margin-bottom: 10px;
            }
        }
        <?php echo $styledata[37]; ?>
    </style>
    <div class="ctu-ultimate-wrapper-<?php echo $styleid; ?>">
        <div class="ctu-ulimate-style-<?php echo $styleid; ?>">
            <?php
            if ($userdata == 'admin') {
                $adminclass = 'oxilab-ab-id';
            } else {
                $adminclass = '';
            }
            foreach ($listdata as $value) {
                $cssdata = explode('|', $value['css']);
                echo '<div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="" style="color: ' . $cssdata[1] . '; background-color:  ' . $cssdata[3] . '">
                                 ' . ctu_html_special_charecter($value['title']) . '
                            </div>';
            }
            echo '</div>';
            echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
            foreach ($listdata as $value) {
                $cssdata = explode('|', $value['css']);
                echo '<div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" style="color: ' . $cssdata[1] . '; background-color:  ' . $cssdata[3] . '"> 
                                    ' . ctu_html_special_charecter($value['title']) . '
                                </div>
                        <div class="ctu-ulitate-style-' . $styleid . '-tabs ' . $adminclass . '" id="ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"  style="color: ' . $cssdata[1] . '; background-color:  ' . $cssdata[3] . '">
                            ' . ctu_html_special_charecter($value['files']) . '';
                if ($userdata == 'admin') {
                    ?>
                    <div class="oxilab-admin-absulote">
                        <div class="oxilab-style-absulate-edit">
                            <form method="post"> 
                                <input type="hidden" name="item-id" value="<?php echo $value['id']; ?>">
                                <button class="btn btn-primary" type="submit" value="edit" name="edit" title="Edit">Edit</button>
                                <?php echo wp_nonce_field("oxitabseditdata"); ?>
                            </form>
                        </div>
                        <div class="oxilab-style-absulate-delete">
                            <form method="post">
                                <input type="hidden" name="item-id" value="<?php echo $value['id']; ?>">
                                <button class="btn btn-danger" type="submit" value="delete" name="delete" title="Delete">Delete</button>
                                <?php echo wp_nonce_field("oxitabsdeletedata"); ?>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                echo '</div> ';
            }
            echo '</div>';
            if (empty($styledata[39])) {
                $initialopen = ':first';
            } else if ($styledata[39] == 'none') {
                $initialopen = '';
            } else {
                $initialopen = $styledata[39];
            }
            ?>
        </div> 
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li<?php echo $initialopen; ?>").addClass("active");
                jQuery(".ctu-ultimate-style-heading-<?php echo $styleid; ?><?php echo $initialopen; ?>").addClass("active");
                jQuery(".ctu-ulitate-style-<?php echo $styleid; ?>-tabs<?php echo $initialopen; ?>").show();
                jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li").click(function () {
                    if (jQuery(this).hasClass('active')) {
                        return false;
                    } else {
                        jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li").removeClass("active");
                        jQuery(this).toggleClass("active");
                        jQuery(".ctu-ulitate-style-<?php echo $styleid; ?>-tabs").slideUp("slow");
                        var activeTab = jQuery(this).attr("ref");
                        jQuery(activeTab).slideDown("slow");
                    }
                });
                jQuery(".ctu-ultimate-style-heading-<?php echo $styleid; ?>").click(function () {
                    if (jQuery(this).hasClass('active')) {
                        return false;
                    } else {
                        jQuery(".ctu-ultimate-style-heading-<?php echo $styleid; ?>").removeClass("active");
                        jQuery(this).toggleClass("active");
                        jQuery(".ctu-ulitate-style-<?php echo $styleid; ?>-tabs").slideUp("slow");
                        var activeTab = jQuery(this).attr("ref");
                        jQuery(activeTab).slideDown("slow");
                        var headerheight = <?php echo $oxi_fixed_header; ?>;
                        jQuery('html, body').animate({
                            scrollTop: jQuery(".ctu-ultimate-wrapper-<?php echo $styleid; ?>").offset().top - headerheight
                        }, 2000);
                    }
                });

            });
        </script>
        <?php
    }
    