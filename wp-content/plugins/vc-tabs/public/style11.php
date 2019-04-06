<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style11($styleid, $userdata, $styledata, $listdata) {
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
            display: flex;
            text-align: center;
            justify-content: <?php echo $styledata[13]; ?>;
            margin-bottom: <?php echo $styledata[19]; ?>px;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            list-style: none;
            width: 100%;
            float: left;
            cursor: pointer;
            max-width: <?php echo $styledata[11]; ?>px;
            position: relative;
            margin-bottom: 0;
            border-top: 5px solid ;
            padding: <?php echo $styledata[15]; ?>px 10px;
            margin-right: <?php echo $styledata[17]; ?>px;
            text-align: center;
            background-color: <?php echo $styledata[5]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            font-family:    <?php echo ctu_font_familly_special_charecter($styledata[7]); ?>;
            font-weight: <?php echo $styledata[11]; ?>;
            line-height: 100%;
            font-style: <?php echo $styledata[65]; ?>;
            box-shadow:  <?php echo $styledata[59]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[25]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li span{
            color: <?php echo $styledata[3]; ?>;
            width: 100%;
            text-align: center;
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active span{
            color: inherit;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li:last-child{
            margin-right: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li span .oxi-icons,  
        .ctu-ultimate-style-heading-<?php echo $styleid; ?> span i{
            padding-right: 8px !important;
            font-size: <?php echo $styledata[21]; ?>px !important;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width:100%;
            float: left;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
            cursor: pointer;
            display: none;
            line-height: 100%;
            background-color:<?php echo $styledata[5]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            padding: <?php echo $styledata[15]; ?>px 10px;
            font-weight: <?php echo $styledata[9]; ?>;
            font-style: <?php echo $styledata[65]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[7]); ?>;
            box-shadow:  <?php echo $styledata[59]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[25]; ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?> span{
            color: <?php echo $styledata[3]; ?>;
            width: 100%;
            text-align: center;
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?> span .oxi-icons{
            font-size:<?php echo $styledata[21]; ?>px !important;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active span{
            color: inherit;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            width: 100%;
            float: left;
            display: none;            
            background-color: <?php echo $styledata[31]; ?>;           
            padding: <?php echo $styledata[33]; ?>px <?php echo $styledata[35]; ?>px <?php echo $styledata[37]; ?>px <?php echo $styledata[39]; ?>px ;
            text-align: <?php echo $styledata[47]; ?>;
            box-shadow: <?php echo $styledata[53]; ?>px <?php echo $styledata[55]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[57]; ?>px <?php echo $styledata[51]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            color: <?php echo $styledata[29]; ?>;
            font-size: <?php echo $styledata[27]; ?>px;
            font-weight: <?php echo $styledata[45]; ?>;
            line-height: <?php echo $styledata[41]; ?>;
            font-family: <?php echo ctu_font_familly_special_charecter($styledata[43]); ?>;
            margin-bottom: 0;
            margin-top:0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
                display: block;
                box-shadow: none;
            }
            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                width: 100%;
                border-left: none;
                display: block;
                overflow:   visible;
            }
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
                box-shadow:  <?php echo $styledata[59]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[23]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[25]; ?>;
                margin-bottom: <?php echo $styledata[19]; ?>px;
            }
            .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
                margin-bottom: 10px;
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
                $cssfile = explode('|', $value['css']);
                echo ' <div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" style="color :' . $cssfile[1] . '; border-color: ' . $cssfile[1] . '">
                                <span> 
                                    ' . ctu_icon_font_selector($cssfile[3]) . '
                                    ' . ctu_html_special_charecter($value['title']) . ' 
                                </span>
                            </div>';
            }
            echo '</div>';

            echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
            foreach ($listdata as $value) {
                $cssfile = explode('|', $value['css']);
                echo '  <div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" style="color :' . $cssfile[1] . '"> 
                            <span> 
                                 ' . ctu_html_special_charecter($value['title']) . ' 
                            </span>
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
                jQuery(".ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li:first").attr("ref");
            });
        </script>
        <?php
    }
    