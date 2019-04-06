<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style16($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    ?>
    <style>
        .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
            margin: 0 0 0 0;
            width: 100%;
            float: left;
            border-radius: <?php echo $styledata[55]; ?>px;
            -webkit-box-shadow:   <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            -o-box-shadow:   <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            -ms-box-shadow:  <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            -moz-box-shadow:   <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            box-shadow:   <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            background-color: <?php echo $styledata[35]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?>{
            width: calc(100% - <?php echo $styledata[37]; ?>%);
            float: <?php echo $styledata[11]; ?>;
            list-style: none;
            text-align: center;
            overflow: hidden;
            margin-bottom: 0;
            padding: <?php echo $styledata[19]; ?>px;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            width: 100%;
            list-style: none;
            cursor: pointer;
            display: block;
            margin-bottom: <?php echo $styledata[19]; ?>px;
            padding: <?php echo $styledata[17]; ?>px;
            text-align: center;
            color: <?php echo $styledata[3]; ?>;
            background-color:  <?php echo $styledata[5]; ?> ;
            font-style:<?php echo $styledata[61]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            font-family:    <?php echo ctu_font_familly_special_charecter($styledata[13]); ?>;
            font-weight: <?php echo $styledata[15]; ?>;
            line-height: 100%;
            border-radius: <?php echo $styledata[25]; ?>px;
            -webkit-box-shadow:  <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
            -o-box-shadow: <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
            -ms-box-shadow: <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
            -moz-box-shadow: <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
            box-shadow: <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li:last-child{
            margin-bottom: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            color: <?php echo $styledata[7]; ?>;
            background-color: <?php echo $styledata[9]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li .oxi-icons{
            display: block !important;
            padding-bottom: <?php echo $styledata[23]; ?>px !important;
            font-size: <?php echo $styledata[21]; ?>px !important;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: <?php echo $styledata[37]; ?>%;
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
            padding: <?php echo $styledata[17]; ?>px;
            font-weight: <?php echo $styledata[15]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[13]); ?>;
            -webkit-box-shadow: <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
            -o-box-shadow: <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
            -ms-box-shadow: <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
            -moz-box-shadow: <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
            box-shadow: <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[29]; ?>;
            border-radius: <?php echo $styledata[25]; ?>px;
            font-style:<?php echo $styledata[61]; ?>;
            color: <?php echo $styledata[3]; ?>;
            background-color: <?php echo $styledata[5]; ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            color: <?php echo $styledata[7]; ?>; 
            background-color: <?php echo $styledata[9]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            display: none;
            width:100%;
            float:left;           
            padding: <?php echo $styledata[39]; ?>px <?php echo $styledata[41]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[45]; ?>px ;
            text-align: <?php echo $styledata[53]; ?>
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            font-size: <?php echo $styledata[31]; ?>px;
            color:<?php echo $styledata[33]; ?>;
            font-weight: <?php echo $styledata[51]; ?>;
            line-height: <?php echo $styledata[47]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[49]); ?>;
            margin-bottom:0;
            margin-top:0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
                display: block;
                -webkit-box-shadow: none;
                -o-box-shadow: none;
                -ms-box-shadow: none;
                -moz-box-shadow: none;
                box-shadow: none;
                border-radius:0;
                background-color:transparent;
            }
            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                width: 100%;
                float: left;
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
                border-radius: <?php echo $styledata[55]; ?>px;
                margin-bottom: 10px;
                -webkit-box-shadow:   <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
                -o-box-shadow:   <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
                -ms-box-shadow:   <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
                -moz-box-shadow:  <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
                box-shadow:   <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            }
        }
        <?php echo $styledata[75]; ?>
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
                               ' . ctu_icon_font_selector($value['css']) . '
                                ' . ctu_html_special_charecter($value['title']) . '
                            </div>';
            }
            echo '</div>';
            echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
            foreach ($listdata as $value) {
                echo '<div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
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
            if (empty($styledata[77])) {
                $initialopen = ':first';
            } else if ($styledata[77] == 'none') {
                $initialopen = '';
            } else {
                $initialopen = $styledata[77];
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
    