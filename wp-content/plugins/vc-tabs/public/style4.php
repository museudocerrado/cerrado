<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style4($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    ?>
    <style>
        .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            -webkit-box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>;
            -o-box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>;
            -ms-box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>;
            -moz-box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>;
            box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[53]; ?>;
            border-radius: <?php echo $styledata[55]; ?>px;
            overflow: hidden;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?>{
            margin: 0 0 0 0;
            width: calc(100% - <?php echo $styledata[65]; ?>%); 
            min-width: <?php echo $styledata[15] + $styledata[19] + $styledata[25]; ?>px;
            float: left;
            list-style: none;
            text-align: center;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            -o-flex-pack: start;
            -moz-flex-pack: start;
            justify-content: flex-start;
            overflow: hidden;
            margin-bottom: 0;
            background-color: <?php echo $styledata[5]; ?>;
            padding: <?php echo $styledata[21]; ?>px <?php echo $styledata[25]; ?>px;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            width: 100%;
            float:left;
            position: relative;
            list-style: none;
            cursor: pointer;
            max-width: <?php echo $styledata[15]; ?>px;
            position: relative;
            display: block;
            margin-bottom: 0;
            margin-top: 0;
            font-style: <?php echo $styledata[63]; ?>;
            border-left: 1px solid <?php echo $styledata[7]; ?>;
            padding: <?php echo $styledata[17]; ?>px <?php echo $styledata[19]; ?>px;
            text-align: left;
            color: <?php echo $styledata[3]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            font-family:    <?php echo ctu_font_familly_special_charecter($styledata[11]); ?>;
            font-weight: <?php echo $styledata[13]; ?>;
            line-height: 120%;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            color: <?php echo $styledata[9]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active .ctu-absolute{
            position: absolute;
            top: 15%;
            bottom: 15%;
            width:  3px;
            background-color: <?php echo $styledata[9]; ?>;
            left: -2px;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: <?php echo $styledata[65]; ?>%; 
            max-width: calc(100% - <?php echo $styledata[15] + $styledata[19] + $styledata[25]; ?>px);
            float: left;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            overflow: hidden;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            width: 100%;
            cursor: pointer;
            float:left;
            display: none;
            line-height: 100%;
            background-color: <?php echo $styledata[5]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            padding: <?php echo $styledata[17]; ?>px 10px;
            font-weight: <?php echo $styledata[13]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[11]); ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            color: <?php echo $styledata[9]; ?>
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            width:100%;
            float:left;
            display: none;
            background-color: <?php echo $styledata[29]; ?>;            
            padding: <?php echo $styledata[35]; ?>px <?php echo $styledata[37]; ?>px <?php echo $styledata[39]; ?>px <?php echo $styledata[41]; ?>px;
            border-left: 1px solid <?php echo $styledata[31]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs.active{
            display:block;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            font-size: <?php echo $styledata[23]; ?>px;
            color:<?php echo $styledata[27]; ?>;
            font-weight: <?php echo $styledata[47]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[45]); ?>;
            font-weight: <?php echo $styledata[47]; ?>;
            line-height: <?php echo $styledata[43]; ?>;
            margin-bottom: 0;
            margin-top: 0;
            text-align: <?php echo $styledata[49]; ?>;
        }
        .ctu-content-span{
            max-width: 50px;
            height: 3px;
            background-color: <?php echo $styledata[9]; ?>;
            margin: <?php
            if ($styledata[49] == 'left') {
                echo '0 auto 0 0';
            } elseif ($styledata[49] == 'center') {
                echo '0 auto';
            } elseif ($styledata[49] == 'right') {
                echo '0 0 0 auto';
            }
            ?>;
            margin-bottom: <?php echo $styledata[33]; ?>px;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
                display: block;
                -webkit-box-shadow: none;
                -o-box-shadow: none;
                -ms-box-shadow: none;
                -moz-box-shadow: none;
                box-shadow: none;
                overflow: visible;
                -webkit-border-radius: 0;
                -o-border-radius: 0;
                -ms-border-radius: 0;
                -moz-border-radius: 0;
                border-radius: 0;


            }
            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                width: 100%;
                max-width:100%;
                display: block;
                overflow: visible;
            }
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
                -webkit-box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                -o-box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                -ms-box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                -moz-box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                margin-bottom: 10px;
            }
            .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
                margin-bottom: 10px;
                -webkit-box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                -o-box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                -ms-box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                -moz-box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                box-shadow: 0 0 5px <?php echo $styledata[53]; ?>;
                border-left: none;
            }
        }
        <?php echo $styledata[67]; ?> 
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
                echo ' <div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                                ' . ctu_html_special_charecter($value['title']) . ' 
                                 <div class="ctu-absolute"></div>
                             </div>';
            }
            echo '</div>
                    <div class="ctu-ultimate-style-' . $styleid . '-content ">';
            foreach ($listdata as $value) {
                echo ' <div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                             ' . ctu_html_special_charecter($value['title']) . '
                        </div>
                        <div class="ctu-ulitate-style-' . $styleid . '-tabs ' . $adminclass . '" id="ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                            <div class="ctu-content-span"></div>
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
                echo '</div>';
            }
            echo '</div>';
            if (empty($styledata[69])) {
                $initialopen = ':first';
            } else if ($styledata[69] == 'none') {
                $initialopen = '';
            } else {
                $initialopen = $styledata[69];
            }
            ?>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li<?php echo $initialopen; ?>").addClass("active");
                jQuery(".ctu-ultimate-style-heading-<?php echo $styleid; ?><?php echo $initialopen; ?>").addClass("active");
                jQuery(".ctu-ulitate-style-<?php echo $styleid; ?>-tabs<?php echo $initialopen; ?>").addClass("active");
                jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li").click(function () {
                    if (jQuery(this).hasClass('active')) {
                        return false;
                    } else {
                        jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li").removeClass("active");
                        jQuery(this).toggleClass("active");
                        jQuery(".ctu-ulitate-style-<?php echo $styleid; ?>-tabs").removeClass("active");
                        var activeTab = jQuery(this).attr("ref");
                        jQuery(activeTab).toggleClass("active");
                    }
                });
                jQuery(".ctu-ultimate-style-heading-<?php echo $styleid; ?>").click(function () {
                    if (jQuery(this).hasClass('active')) {
                        return false;
                    } else {
                        jQuery(".ctu-ultimate-style-heading-<?php echo $styleid; ?>").removeClass("active");
                        jQuery(this).toggleClass("active");
                        jQuery(".ctu-ulitate-style-<?php echo $styleid; ?>-tabs").removeClass("active");
                        var activeTab = jQuery(this).attr("ref");
                        jQuery(activeTab).addClass("active");
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
    