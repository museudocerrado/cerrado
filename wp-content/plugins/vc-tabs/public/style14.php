<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style14($styleid, $userdata, $styledata, $listdata) {
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
            list-style: none;
            text-align: center;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            -webkit-box-pack: <?php echo $styledata[13]; ?>;
            -ms-flex-pack: <?php echo $styledata[13]; ?>;
            -o-flex-pack: <?php echo $styledata[13]; ?>;
            -moz-flex-pack: <?php echo $styledata[13]; ?>;
            justify-content: <?php echo $styledata[13]; ?>;
            margin-bottom: <?php echo $styledata[21]; ?>px;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            width: 100%;
            float: left;
            position: relative;
            display: flex;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -o-flex-pack: center;
            -moz-flex-pack: center;
            justify-content: center;
            -webkit-box-align:   center;
            -ms-flex-align:   center;
            -o-flex-align:   center;
            -moz-flex-align:   center;
            align-items:   center;
            list-style: none;
            cursor: pointer;
            max-width: <?php echo $styledata[15]; ?>px;
            margin-bottom: 0;
            padding: <?php echo $styledata[17]; ?>px 12px;
            text-align: center;
            color: <?php echo $styledata[3]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            font-family:    <?php echo ctu_font_familly_special_charecter($styledata[9]); ?>;
            font-weight: <?php echo $styledata[11]; ?>;
            font-style: <?php echo $styledata[57]; ?>;
            line-height: 100%;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            color: <?php echo $styledata[5]; ?>;
            background-color:  <?php echo $styledata[7]; ?>;
            border-radius: <?php echo $styledata[23]; ?>px;
            -webkit-box-shadow: <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
            -o-box-shadow: <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
            -ms-box-shadow: <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
            -moz-box-shadow: <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
            box-shadow: <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li .oxi-icons{
            padding-right: 8px !important;
            font-size: <?php echo $styledata[19]; ?>px !important;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active .ctu-absolute{
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            margin: 0 auto;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid <?php echo $styledata[7]; ?>;

        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: 100%;
            float: left;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -o-flex-pack: center;
            -moz-flex-pack: center;
            justify-content: center;
            -webkit-box-align:   center;
            -ms-flex-align:   center;
            -o-flex-align:   center;
            -moz-flex-align:   center;
            -webkit-box-align:   center;
            -ms-flex-align:   center;
            -o-flex-align:   center;
            -moz-flex-align:   center;
            align-items:   center;
            cursor: pointer;
            display: none;
            line-height: 100%;            
            font-size: <?php echo $styledata[1]; ?>px;
            padding:<?php echo $styledata[17]; ?>px 10px;
            font-weight: <?php echo $styledata[11]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[9]); ?>;
            border-radius: 5px;
            -webkit-box-shadow: <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
            -o-box-shadow: <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
            -moz-box-shadow:<?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
            -ms-box-shadow:<?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
            box-shadow: <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            color: <?php echo $styledata[5]; ?>;
            background-color: <?php echo $styledata[7]; ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?> i{
            font-size: <?php echo $styledata[19]; ?>px !important;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            width: 100%;
            float: left;
            display: none;  
            background-color: <?php echo $styledata[33]; ?>;
            font-weight: <?php echo $styledata[47]; ?>;            
            padding: <?php echo $styledata[35]; ?>px <?php echo $styledata[37]; ?>px <?php echo $styledata[39]; ?>px <?php echo $styledata[41]; ?>px;
            border-radius: <?php echo $styledata[51]; ?>px;    
            -webkit-box-shadow:  <?php echo $styledata[59]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[55]; ?>;   
            -o-box-shadow:  <?php echo $styledata[59]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[55]; ?>;
            -ms-box-shadow:  <?php echo $styledata[59]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[55]; ?>;
            -moz-box-shadow:  <?php echo $styledata[59]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[55]; ?>; 
            box-shadow: <?php echo $styledata[59]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[55]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            font-size: <?php echo $styledata[29]; ?>px;
            color: <?php echo $styledata[31]; ?>;
            line-height: <?php echo $styledata[43]; ?>;
            font-family:<?php echo ctu_font_familly_special_charecter($styledata[45]); ?>;
            text-align:<?php echo $styledata[49]; ?>;
            margin-bottom:0;
            margin-top:0;
        }
        @media only screen and (max-width: 900px) {

            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                width: 100%;
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
        <?php echo $styledata[71]; ?>
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
                echo '<div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="">
                               ' . ctu_icon_font_selector($value['css']) . '
                               ' . ctu_html_special_charecter($value['title']) . '
                               <div class="ctu-absolute"></div>
                            </div>';
            }
            echo '</div>';
            echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
            foreach ($listdata as $value) {
                echo ' <div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                              ' . ctu_icon_font_selector($value['css']) . '
                                    ' . ctu_html_special_charecter($value['title']) . '
                            </div>
                        <div class="ctu-ulitate-style-' . $styleid . '-tabs ' . $adminclass . '" id="ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
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
            if (empty($styledata[73])) {
                $initialopen = ':first';
            } else if ($styledata[73] == 'none') {
                $initialopen = '';
            } else {
                $initialopen = $styledata[73];
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
    