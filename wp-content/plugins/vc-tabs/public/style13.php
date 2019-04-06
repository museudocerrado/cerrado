<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style13($styleid, $userdata, $styledata, $listdata) {
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
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            list-style: none;
            text-align: center;
            -webkit-box-pack: <?php echo $styledata[15]; ?>;
            -ms-flex-pack:<?php echo $styledata[15]; ?>;
            -o-flex-pack: <?php echo $styledata[15]; ?>;
            -moz-flex-pack:<?php echo $styledata[15]; ?>;
            justify-content: <?php echo $styledata[15]; ?>;
            margin-bottom: <?php echo $styledata[23]; ?>px;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            width: 100%;
            list-style: none;
            cursor: pointer;
            float: left;
            max-width: <?php echo $styledata[17]; ?>px;
            margin-bottom: 0;
            padding: <?php echo $styledata[19]; ?>px 10px;
            text-align: center;
            color: <?php echo $styledata[3]; ?>;
            background-color:  <?php echo $styledata[5]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            font-family:    <?php echo ctu_font_familly_special_charecter($styledata[11]); ?>;
            font-weight: <?php echo $styledata[13]; ?>;
            line-height: 100%;
            font-style: <?php echo $styledata[59]; ?>;
            border-radius: <?php echo $styledata[25]; ?>px;
            -webkit-box-shadow: <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
            -o-box-shadow: <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
            -ms-box-shadow: <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
            -moz-box-shadow: <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
            box-shadow: <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
            margin-right: <?php echo $styledata[21]; ?>px;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li:last-child{
            margin-right: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            color: <?php echo $styledata[7]; ?>;
            background-color:  <?php echo $styledata[9]; ?>;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: 100%;
            float: left;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
            cursor: pointer;
            display: none;
            line-height: 100%;
            color: <?php echo $styledata[3]; ?>;
            background-color: <?php echo $styledata[5]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            padding: <?php echo $styledata[19]; ?>px 10px;
            font-weight: <?php echo $styledata[13]; ?>;
            font-style: <?php echo $styledata[59]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[11]); ?>;
            border-radius:5px;
            -webkit-box-shadow:  <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
            -o-box-shadow:  <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
            -ms-box-shadow:  <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
            -moz-box-shadow:  <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
            box-shadow: <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;

        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            color: <?php echo $styledata[7]; ?>;
            background-color: <?php echo $styledata[9]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            display: none;
            width: 100%;
            float: left;            
            background-color: <?php echo $styledata[35]; ?>;           
            padding: <?php echo $styledata[37]; ?>px <?php echo $styledata[39]; ?>px <?php echo $styledata[41]; ?>px <?php echo $styledata[43]; ?>px;
            text-align: <?php echo $styledata[51]; ?>;
            border-radius: <?php echo $styledata[53]; ?>px;
            -webkit-box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px  <?php echo $styledata[55]; ?>px <?php echo $styledata[65]; ?>px  <?php echo $styledata[57]; ?>;
            -o-box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px  <?php echo $styledata[55]; ?>px <?php echo $styledata[65]; ?>px  <?php echo $styledata[57]; ?>;
            -ms-box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px  <?php echo $styledata[55]; ?>px <?php echo $styledata[65]; ?>px  <?php echo $styledata[57]; ?>;
            -moz-box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px  <?php echo $styledata[55]; ?>px <?php echo $styledata[65]; ?>px  <?php echo $styledata[57]; ?>;
            box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px  <?php echo $styledata[55]; ?>px <?php echo $styledata[65]; ?>px  <?php echo $styledata[57]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            font-size: <?php echo $styledata[31]; ?>px;
            color: <?php echo $styledata[33]; ?>;
            font-weight: <?php echo $styledata[49]; ?>;
            font-family: <?php echo ctu_font_familly_special_charecter($styledata[47]); ?>;
            line-height: <?php echo $styledata[45]; ?>;
            margin-bottom: 0;
            margin-top: 0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
                -webkit-box-shadow:  <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
                -o-box-shadow: <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
                -ms-box-shadow: <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
                -moz-box-shadow:  <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
                box-shadow: <?php echo $styledata[67]; ?>px <?php echo $styledata[69]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[29]; ?>;
                margin-bottom: 10px;
            }
            .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
                margin-bottom: 10px;
            }
        }
        <?php echo $styledata[73]; ?>
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
                echo ' <div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="">
                                 ' . ctu_html_special_charecter($value['title']) . '
                            </div>';
            }
            echo '</div>';
            echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
            foreach ($listdata as $value) {
                echo '<div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
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
            if (empty($styledata[75])) {
                $initialopen = ':first';
            } else if ($styledata[75] == 'none') {
                $initialopen = '';
            } else {
                $initialopen = $styledata[75];
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
    