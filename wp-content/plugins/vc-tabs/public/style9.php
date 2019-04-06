<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style9($styleid, $userdata, $styledata, $listdata) {
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
            -webkit-box-pack:  <?php echo $styledata[17]; ?>;
            -ms-flex-pack:  <?php echo $styledata[17]; ?>;
            -o-flex-pack:  <?php echo $styledata[17]; ?>;
            -moz-flex-pack:  <?php echo $styledata[17]; ?>;
            justify-content: <?php echo $styledata[17]; ?>;
            margin-bottom: <?php echo $styledata[21]; ?>px;
            -webkit-box-shadow:   <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[25]; ?>;
            -o-box-shadow:    <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[25]; ?>;
            -ms-box-shadow:    <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[25]; ?>;
            -moz-box-shadow:    <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[25]; ?>;
            box-shadow:   <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[25]; ?>;
            background-color: <?php echo $styledata[5]; ?>;
            border-radius: <?php echo $styledata[27]; ?>px <?php echo $styledata[27]; ?>px 0 0 ;
            margin-bottom: <?php echo $styledata[21]; ?>px
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            position: relative;
            list-style: none;
            cursor: pointer;
            width: <?php echo $styledata[15]; ?>px;
            float: left;
            padding: 5px 10px ;
            text-align: center;
            color: <?php echo $styledata[3]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            font-family:    <?php echo ctu_font_familly_special_charecter($styledata[11]); ?>;
            font-weight: <?php echo $styledata[13]; ?>;
            line-height: 130%;
            font-style: <?php echo $styledata[67]; ?>;
            margin: <?php echo $styledata[19]; ?>px 0;
            border-right: 1px solid;
            border-color: <?php echo $styledata[9]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li:last-child{
            border-right: none
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            color: <?php echo $styledata[7]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active .ctu-absolute{
            position: absolute;
            left: 0;
            right: 0;
            bottom: calc(-10px - <?php echo $styledata[19]; ?>px );
            margin: 0 auto;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid <?php echo $styledata[5]; ?>;
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
            color: <?php echo $styledata[3]; ?>;
            background-color: <?php echo $styledata[5]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            padding: <?php echo $styledata[19]; ?>px 10px;
            font-weight: <?php echo $styledata[13]; ?>;
            box-shadow:   <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[25]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[11]); ?>;
            font-style: <?php echo $styledata[67]; ?>;
            border-radius: <?php echo $styledata[27]; ?>px;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            color: <?php echo $styledata[7]; ?>;
            margin-bottom: 10px;
            border-radius:  <?php echo $styledata[27]; ?>px <?php echo $styledata[27]; ?>px 0 0;
        }

        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            width: 100%;
            float: left;
            display: none;
            background-color: <?php echo $styledata[33]; ?>;
            font-weight:<?php echo $styledata[47]; ?>;
            text-align: <?php echo $styledata[49]; ?>;
            -webkit-box-shadow:  <?php echo $styledata[55]; ?>px <?php echo $styledata[57]; ?>px   <?php echo $styledata[51]; ?>px <?php echo $styledata[59]; ?>px  <?php echo $styledata[53]; ?>;
            -o-box-shadow:  <?php echo $styledata[55]; ?>px <?php echo $styledata[57]; ?>px   <?php echo $styledata[51]; ?>px <?php echo $styledata[59]; ?>px  <?php echo $styledata[53]; ?>;
            -ms-box-shadow:   <?php echo $styledata[55]; ?>px <?php echo $styledata[57]; ?>px   <?php echo $styledata[51]; ?>px <?php echo $styledata[59]; ?>px  <?php echo $styledata[53]; ?>;
            -moz-box-shadow:   <?php echo $styledata[55]; ?>px <?php echo $styledata[57]; ?>px   <?php echo $styledata[51]; ?>px <?php echo $styledata[59]; ?>px  <?php echo $styledata[53]; ?>;
            box-shadow:   <?php echo $styledata[55]; ?>px <?php echo $styledata[57]; ?>px   <?php echo $styledata[51]; ?>px <?php echo $styledata[59]; ?>px  <?php echo $styledata[53]; ?>;
            padding: <?php echo $styledata[35]; ?>px <?php echo $styledata[37]; ?>px <?php echo $styledata[39]; ?>px <?php echo $styledata[41]; ?>px ;
            border-radius: 0 0 <?php echo $styledata[27]; ?>px <?php echo $styledata[27]; ?>px;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            font-size: <?php echo $styledata[29]; ?>px;
            color: <?php echo $styledata[31]; ?>;
            line-height: <?php echo $styledata[43]; ?>;
            font-family:    <?php echo ctu_font_familly_special_charecter($styledata[45]); ?>;
            margin-top: 0;
            margin-bottom: 0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
                display: block;
            }
            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                width: 100%;
                margin-bottom: 10px;
            }
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
            }
        }
        <?php echo $styledata[69]; ?>
    </style>
    <div class="ctu-ultimate-wrapper-<?php echo $styleid; ?>">
        <?php
        if ($userdata == 'admin') {
            $adminclass = 'oxilab-ab-id';
        } else {
            $adminclass = '';
        }
        echo '<div class="ctu-ulimate-style-' . $styleid . '">';
        foreach ($listdata as $value) {
            echo '<div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                                ' . ctu_icon_font_selector($value['css']) . '
                                ' . ctu_html_special_charecter($value['title']) . '
                                    <div class="ctu-absolute"></div>
                            </div>';
        }
        echo '</div>';
        foreach ($listdata as $value) {
            echo ' <div class="ctu-ultimate-style-' . $styleid . '-content">
                        <div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                            ' . ctu_icon_font_selector($value['css']) . ' ' . ctu_html_special_charecter($value['title']) . '
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
        if (empty($styledata[71])) {
            $initialopen = ':first';
        } else if ($styledata[71] == 'none') {
            $initialopen = '';
        } else {
            $initialopen = $styledata[71];
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
