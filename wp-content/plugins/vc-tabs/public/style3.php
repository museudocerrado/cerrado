<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style3($styleid, $userdata, $styledata, $listdata) {
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
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            float: left;
            list-style: none;
            text-align: center;
            -webkit-box-pack: <?php echo $styledata[19]; ?>;
            -ms-flex-pack: <?php echo $styledata[19]; ?>;
            -o-flex-pack: <?php echo $styledata[19]; ?>;
            -moz-flex-pack: <?php echo $styledata[19]; ?>;
            justify-content: <?php echo $styledata[19]; ?>;
            overflow: hidden;
            margin-bottom: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            cursor: pointer;
            float: left;
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
            margin-bottom: 0;
            -webkit-box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[27]; ?>;
            -o-box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[27]; ?>; 
            -ms-box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[27]; ?>; 
            -moz-box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[27]; ?>; 
            box-shadow: <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[25]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[27]; ?>; 
            text-align: center;
            position: relative;
            margin: 0 <?php echo $styledata[55]; ?>px 0 0;
            padding: <?php echo $styledata[23]; ?>px 10px;
            bottom: -5px;
            font-size: <?php echo $styledata[1]; ?>px;
            line-height: 120%;
            border-top: 5px solid <?php echo $styledata[7]; ?>;
            font-style:  <?php echo $styledata[69]; ?>;
            color: <?php echo $styledata[3]; ?>;
            background-color: <?php echo $styledata[5]; ?>;
            width: <?php echo $styledata[21]; ?>px;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[15]); ?>;
            font-weight: <?php echo $styledata[17]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li:last-child{
            margin-right: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            position: relative;
            -webkit-transition:  all 0.5s linear;
            -o-transition:  all 0.5s linear;
            -ms-transition:  all 0.5s linear;
            -moz-transition:  all 0.5s linear;
            transition:  all 0.5s linear;
            color: <?php echo $styledata[9]; ?>;
            background-color: <?php echo $styledata[11]; ?>;
            border-color: <?php echo $styledata[13]; ?>;
            bottom: 0;
            z-index: 1;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: 100%;
            float: left;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            cursor: pointer;
            display: none;
            width: 100%;
            font-weight: <?php echo $styledata[17]; ?>;
            line-height: 120%;
            padding: <?php echo $styledata[23]; ?>px 10px;
            text-align: center;
            font-size: <?php echo $styledata[1]; ?>px;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[15]); ?>;
            background-color:  <?php echo $styledata[5]; ?>;
            color: <?php echo $styledata[3]; ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            -webkit-transition:  all 0.5s linear;
            -o-transition:  all 0.5s linear;
            -ms-transition:  all 0.5s linear;
            -moz-transition:  all 0.5s linear;
            transition:  all 0.5s linear;
            color: <?php echo $styledata[9]; ?>;
            background-color:  <?php echo $styledata[11]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            width: 100%;
            display: none;
            padding: <?php echo $styledata[35]; ?>px <?php echo $styledata[37]; ?>px <?php echo $styledata[39]; ?>px <?php echo $styledata[41]; ?>px;
            font-size: <?php echo $styledata[29]; ?>px;
            color: <?php echo $styledata[31]; ?>;
            line-height: <?php echo $styledata[43]; ?>;
            text-align: <?php echo $styledata[49]; ?>;
            background-color: <?php echo $styledata[33]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[45]); ?>;
            -webkit-box-shadow: <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[51]; ?>;
            -o-box-shadow: <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[51]; ?>; 
            -ms-box-shadow: <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[51]; ?>; 
            -moz-box-shadow: <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[51]; ?>; 
            box-shadow: <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[51]; ?>; 
            font-weight: <?php echo $styledata[47]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            font-size: <?php echo $styledata[29]; ?>px;
            color: <?php echo $styledata[31]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[45]); ?>;
            font-weight: <?php echo $styledata[47]; ?>;
            text-align: <?php echo $styledata[49]; ?>;
            margin-bottom: 0;
            margin-top: 0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
            }
            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
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
                echo '  <div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="">
                                            ' . ctu_html_special_charecter($value['title']) . '
                                        </div>';
            }
            echo ' </div>';
            foreach ($listdata as $value) {
                echo '       <div class="ctu-ultimate-style-' . $styleid . '-content">
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
    