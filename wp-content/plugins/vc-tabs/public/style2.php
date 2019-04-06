<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style2($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    ?>
    <style>
        .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
            background: transparent;
            overflow: hidden;
            border-radius: <?php echo $styledata[19]; ?>px <?php echo $styledata[19]; ?>px 0 0;
            -webkit-box-shadow: <?php echo $styledata[49]; ?>px  <?php echo $styledata[51]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[45]; ?>;
            -o-box-shadow: <?php echo $styledata[49]; ?>px  <?php echo $styledata[51]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[45]; ?>;
            -ms-box-shadow: <?php echo $styledata[49]; ?>px  <?php echo $styledata[51]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[45]; ?>;
            -moz-box-shadow: <?php echo $styledata[49]; ?>px  <?php echo $styledata[51]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[45]; ?>;
            box-shadow: <?php echo $styledata[49]; ?>px  <?php echo $styledata[51]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[45]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?>{
            margin: 0 0 0 0;
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            float: left;
            list-style: none;
            text-align: center;
            -webkit-box-pack: <?php echo $styledata[13]; ?>;
            -ms-flex-pack: <?php echo $styledata[13]; ?>;
            -o-flex-pack: <?php echo $styledata[13]; ?>;
            -moz-flex-pack: <?php echo $styledata[13]; ?>;
            justify-content: <?php echo $styledata[13]; ?>;
            background-color: <?php echo $styledata[5]; ?>;
            margin-bottom: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            cursor: pointer;
            float: left;
            text-align: center;
            list-style: none;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -o-flex-pack: center;
            -moz-flex-pack: center;
            justify-content: center ;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -o-flex-align: center;
            -moz-flex-align: center;
            align-items: center;
            position: relative;
            font-style: <?php echo $styledata[47]; ?>;
            margin: <?php echo $styledata[17]; ?>px 0;
            padding: 0 10px;
            font-size: <?php echo $styledata[1]; ?>px;
            line-height: 130%;
            border-right: 1px solid #ccc;
            color: <?php echo $styledata[3]; ?>;
            width: <?php echo $styledata[15]; ?>px;
            font-family: <?php echo ctu_font_familly_special_charecter($styledata[9]); ?>;
            font-weight: <?php echo $styledata[11]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li:last-child{
            border-right: none;
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
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li .ctu-absolute{
            position: absolute;
            margin: auto;
            bottom: -<?php echo $styledata[17]; ?>px;
            left: 0;
            right: 0;
            width: 30px;
            height: 30px;
            display: none;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid <?php echo $styledata[7]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active .ctu-absolute{
            display: block;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: 100%;
            float: left;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            cursor: pointer;
            display: none;
            width: 100%;
            font-size: <?php echo $styledata[1]; ?>px;
            font-weight: <?php echo $styledata[11]; ?>;
            font-family: <?php echo ctu_font_familly_special_charecter($styledata[9]); ?>;
            line-height: 120%;
            font-style: <?php echo $styledata[47]; ?>;
            padding: <?php echo $styledata[17]; ?>px 10px;
            text-align: center;            
            border-radius: <?php echo $styledata[19]; ?>px;            
            background-color:  <?php echo $styledata[5]; ?>;
            color: <?php echo $styledata[3]; ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            -webkit-transition:  all 0.5s linear;
            -o-transition:  all 0.5s linear;
            -ms-transition:  all 0.5s linear;
            -moz-transition:  all 0.5s linear;
            transition:  all 0.5s linear;
            border-radius: <?php echo $styledata[19]; ?>px <?php echo $styledata[19]; ?>px 0 0;
            color: <?php echo $styledata[7]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            width: 100%;
            display: none;
            padding: <?php echo $styledata[27]; ?>px <?php echo $styledata[29]; ?>px <?php echo $styledata[31]; ?>px <?php echo $styledata[33]; ?>px;            
            background-color: <?php echo $styledata[25]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            line-height: <?php echo $styledata[35]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[37]); ?>;
            font-weight: <?php echo $styledata[39]; ?>;
            color: <?php echo $styledata[23]; ?>;
            font-size: <?php echo $styledata[21]; ?>px;
            text-align: <?php echo $styledata[41]; ?>;
            margin-top: 0;
            margin-bottom: 0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
                -webkit-box-shadow: none !important;
                -o-box-shadow: none !important;
                -ms-box-shadow: none !important;
                -moz-box-shadow: none !important;
                box-shadow: none !important;
            }
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
            }
            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                margin-bottom: 10px;
            } 
            .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
                -webkit-box-shadow: none !important;
                -o-box-shadow: none !important;
                -ms-box-shadow: none !important;
                -moz-box-shadow: none !important;
                box-shadow: none !important;
            }
        }
        <?php echo $styledata[55]; ?>

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
                echo '<div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                                       ' . ctu_html_special_charecter($value['title']) . '
                                        <div class="ctu-absolute"></div>
                                    </div>';
            }
            echo ' </div>';
            foreach ($listdata as $value) {
                echo '<div class="ctu-ultimate-style-' . $styleid . '-content">
                                        <div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
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
                echo ' </div></div>';
            }
            if (empty($styledata[57])) {
                $initialopen = ':first';
            } else if ($styledata[57] == 'none') {
                $initialopen = '';
            } else {
                $initialopen = $styledata[57];
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
                var contentliwidth = jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li").outerWidth();
                var count = jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li").length;
                var fullwidth = jQuery(".ctu-ulimate-style-<?php echo $styleid; ?>").width();
                var widthresult = contentliwidth * count;
                if (fullwidth <= widthresult) {
                    var eachwidth = parseInt(fullwidth / count) + 'px';
                    jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li").css("width", eachwidth);
                }
            });
        </script>
        <?php
    }
    