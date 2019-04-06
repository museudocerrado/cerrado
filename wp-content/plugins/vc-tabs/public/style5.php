<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style5($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    ?>
    <style>
        .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
            -webkit-box-shadow: <?php echo $styledata[53]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[51]; ?>; 
            -o-box-shadow: <?php echo $styledata[53]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[51]; ?>; 
            -ms-box-shadow: <?php echo $styledata[53]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[51]; ?>; 
            -moz-box-shadow: <?php echo $styledata[53]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[51]; ?>; 
            box-shadow: <?php echo $styledata[53]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[51]; ?>; 
            border-radius: <?php echo $styledata[25]; ?>px <?php echo $styledata[25]; ?>px 0 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?>{
            margin: 0 0 0 0;
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            list-style:none;
            float: left;
            text-align: center;
            margin: 0;
            border-radius: <?php echo $styledata[25]; ?>px <?php echo $styledata[25]; ?>px 0 0;
            -webkit-box-pack: <?php echo $styledata[17]; ?>;
            -ms-flex-pack: <?php echo $styledata[17]; ?>;
            -o-flex-pack: <?php echo $styledata[17]; ?>;
            -moz-flex-pack: <?php echo $styledata[17]; ?>;
            justify-content:  <?php echo $styledata[17]; ?>;
            border-bottom: 1px solid <?php echo $styledata[19]; ?>;
            background-color: <?php echo $styledata[5]; ?>;
            z-index: 1;
            position: relative;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            cursor: pointer;
            float: left;
            list-style:none;
            margin-bottom: 0;
            position: relative;
            padding: <?php echo $styledata[23]; ?>px 10px;        
            font-size: <?php echo $styledata[1]; ?>px;
            line-height: 120%;
            color: <?php echo $styledata[3]; ?>;
            width: <?php echo $styledata[21]; ?>px;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[13]); ?>;
            font-weight: <?php echo $styledata[15]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li span{
            width: 100%;
            display: block;
            text-align: center;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li span .oxi-icons{
            margin-bottom: <?php echo $styledata[11]; ?>px !important;
            font-size: <?php echo $styledata[9]; ?>px !important;

        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li span .oxi-icons{
            color: <?php echo $styledata[3]; ?> !important;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active span .oxi-icons{
            color: <?php echo $styledata[7]; ?> !important;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            position: relative;
            -webkit-transition:  all 0.5s linear;
            -o-transition:  all 0.5s linear;
            -ms-transition:  all 0.5s linear;
            -moz-transition:  all 0.5s linear;
            transition:  all 0.5s linear;
            color: <?php echo $styledata[7]; ?>;
        }
        .ctu-absulote{
            position: absolute;
            width: 11px;
            height: 11px;
            margin: auto;
            left: 0;
            right: 0;
            border-color: <?php echo $styledata[19]; ?>;
            border: 1px solid;
            border-radius: 10px;
            bottom: -6px;
            background-color: transparent;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active .ctu-absulote{
            background-color: <?php echo $styledata[7]; ?>;
            border-color: <?php echo $styledata[7]; ?>;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: 100%;
            float: left;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            cursor: pointer;
            display: none;
            width: 100%;
            font-weight: <?php echo $styledata[19]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[13]); ?> ;
            line-height: 120%;
            padding: <?php echo $styledata[23]; ?>px 10px;
            text-align: center;
            font-size: <?php echo $styledata[1]; ?>px;
            color: <?php echo $styledata[3]; ?>;
            background-color: <?php echo $styledata[5]; ?>;
            border-radius: <?php echo $styledata[25]; ?>px;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            -webkit-transition:  all 0.5s linear;
            -o-transition:  all 0.5s linear;
            -ms-transition:  all 0.5s linear;
            -moz-transition:  all 0.5s linear;
            transition:  all 0.5s linear;
            color: <?php echo $styledata[7]; ?>;
            border-bottom: 1px solid <?php echo $styledata[19]; ?>;
            border-radius: <?php echo $styledata[25]; ?>px <?php echo $styledata[25]; ?>px 0 0;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            width: 100%;
            display: none;
            padding: <?php echo $styledata[33]; ?>px <?php echo $styledata[35]; ?>px <?php echo $styledata[37]; ?>px <?php echo $styledata[39]; ?>px;
            background-color: <?php echo $styledata[31]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            margin-bottom: 0;
            margin-top: 0;
            font-size: <?php echo $styledata[27]; ?>px;
            color: <?php echo $styledata[29]; ?>;
            line-height: <?php echo $styledata[41]; ?>;
            text-align: <?php echo $styledata[47]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[43]); ?>;
            font-weight: <?php echo $styledata[45]; ?>;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
                -webkit-box-shadow: none;
                -o-box-shadow: none;
                -moz-box-shadow: none;
                -ms-box-shadow: none;
                box-shadow: none;
                border-radius: 0;
            }
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
            }
            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                margin-bottom: 10px;
                -webkit-box-shadow: 0 0 5px <?php echo $styledata[31]; ?>;
                -o-box-shadow: 0 0 5px <?php echo $styledata[31]; ?>;
                -ms-box-shadow: 0 0 5px <?php echo $styledata[31]; ?>;
                -moz-box-shadow: 0 0 5px <?php echo $styledata[31]; ?>;
                box-shadow: 0 0 5px <?php echo $styledata[31]; ?>;
                border-radius: <?php echo $styledata[25]; ?>px;
                overflow: hidden;
            }
        }
        <?php echo $styledata[61]; ?> 
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
                                <span>' . ctu_icon_font_selector($value['css']) . '</span>
                                ' . ctu_html_special_charecter($value['title']) . '
                                <div class="ctu-absulote"></div>
                            </div> ';
            }
            echo '  </div>';
            foreach ($listdata as $value) {
                echo ' <div class="ctu-ultimate-style-' . $styleid . '-content">
                                <div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                                    ' . ctu_icon_font_selector($value['css']) . '   ' . ctu_html_special_charecter($value['title']) . '
                                    
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
                echo '</div></div>';
            }
            if (empty($styledata[63])) {
                $initialopen = ':first';
            } else if ($styledata[63] == 'none') {
                $initialopen = '';
            } else {
                $initialopen = $styledata[63];
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
    