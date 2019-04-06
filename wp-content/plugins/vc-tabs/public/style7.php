<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style7($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    ?>
    <style>
        .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
            -webkit-box-shadow: <?php echo $styledata[51]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[47]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>; 
            -o-box-shadow: <?php echo $styledata[51]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[47]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>; 
            -ms-box-shadow: <?php echo $styledata[51]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[47]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>; 
            -moz-box-shadow:<?php echo $styledata[51]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[47]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>; 
            box-shadow: <?php echo $styledata[51]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[47]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>; 
            border: 1px solid <?php echo $styledata[45]; ?>;
            border-radius: <?php echo $styledata[59]; ?>px <?php echo $styledata[59]; ?>px 0 0;
            overflow: hidden;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?>{
            margin: 0 0 0 0;
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            margin-bottom: 0;
            list-style: none;
            background-color:  <?php echo $styledata[5]; ?>;
            -webkit-box-pack: <?php echo $styledata[19]; ?>;;
            -ms-flex-pack: <?php echo $styledata[19]; ?>;;
            -o-flex-pack: <?php echo $styledata[19]; ?>;;
            -moz-flex-pack: <?php echo $styledata[19]; ?>;;
            justify-content:  <?php echo $styledata[19]; ?>;
            border-bottom: 1px solid <?php echo $styledata[11]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            width: <?php echo $styledata[17]; ?>px;
            float: left;
            list-style: none;
            text-align: center;
            cursor: pointer;
            margin-bottom: 0;
            font-size: <?php echo $styledata[1]; ?>px;
            color: <?php echo $styledata[3]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[13]); ?>;
            font-weight: <?php echo $styledata[15]; ?>;
            padding: <?php echo $styledata[21]; ?>px 10px;
            border-right: 1px solid <?php echo $styledata[11]; ?>;

        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li:last-child{
            border-right: none;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            color: <?php echo $styledata[7]; ?>;
            background-color: <?php echo $styledata[9]; ?>;
        }

        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: 100%;
            float: left;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            width: 100%;
            cursor: pointer;
            float: left;
            display: none;
            line-height: 100%;
            background-color: <?php echo $styledata[5]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            color: <?php echo $styledata[3]; ?>;
            padding: <?php echo $styledata[21]; ?>px 10px;
            font-weight: <?php echo $styledata[15]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[13]); ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            color: #003eff;
            background-color: <?php echo $styledata[9]; ?>;
            border-bottom: 1px solid <?php echo $styledata[11]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            width: 100%;
            float: left;
            display: none;            
            background-color: <?php echo $styledata[27]; ?>;           
            padding: <?php echo $styledata[29]; ?>px <?php echo $styledata[31]; ?>px <?php echo $styledata[33]; ?>px <?php echo $styledata[35]; ?>px;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            margin-bottom: 0;
            margin-top: 0;
            font-size: <?php echo $styledata[23]; ?>px;
            color: <?php echo $styledata[25]; ?>;
            font-weight: <?php echo $styledata[41]; ?>;
            line-height: <?php echo $styledata[37]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[39]); ?>;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
                display: block;
                -webkit-box-shadow: none;
                -o-box-shadow: none;
                -ms-box-shadow: none;
                -moz-box-shadow: none;
                box-shadow: none;
                border: none;
                overflow: visible;
            }
            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                -webkit-box-shadow:  0 0 <?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>;
                -o-box-shadow:  0 0 <?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>;
                -ms-box-shadow:   0 0 <?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>;
                -moz-box-shadow:  0 0 <?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>;
                box-shadow:   0 0 <?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>;
                border: 1px solid  <?php echo $styledata[45]; ?>;
                border-radius: <?php echo $styledata[59]; ?>px;
                overflow: hidden;
                margin-bottom: 10px;
            }
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
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
                echo '<div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                                ' . ctu_html_special_charecter($value['title']) . ' 
                            </div>';
            }
            echo '</div>';
            foreach ($listdata as $value) {
                echo ' <div class="ctu-ultimate-style-' . $styleid . '-content">
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
                echo '</div></div> ';
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
    