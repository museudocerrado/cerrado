<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style6($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    ?>
    <style>
        .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
            display: flex;
            background-color: <?php echo $styledata[23]; ?>;
            -webkit-box-shadow:<?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[45]; ?>; 
            -o-box-shadow: <?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[45]; ?>; 
            -ms-box-shadow: <?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[45]; ?>; 
            -moz-box-shadow: <?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[45]; ?>; 
            box-shadow: <?php echo $styledata[47]; ?>px <?php echo $styledata[49]; ?>px <?php echo $styledata[43]; ?>px <?php echo $styledata[51]; ?>px <?php echo $styledata[45]; ?>; 
        }
        .ctu-ulimate-style-<?php echo $styleid; ?>{
            margin: 0 0 0 0;
            float: left;
            list-style: none;
            width: <?php echo $styledata[33]; ?>px;
            margin-bottom: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            width: 95%;
            margin-bottom: 0;
            -webkit-transition: all 0.3s linear;
            -o-transition: all 0.3s linear;
            -ms-transition: all 0.3s linear;
            -moz-transition: all 0.3s linear;
            transition: all 0.3s linear;
            cursor: pointer;
            position: relative;
            font-style: <?php echo $styledata[53]; ?>;
            padding: <?php echo $styledata[15]; ?>px <?php echo $styledata[17]; ?>px;
            margin-right: 5%;
            font-size: <?php echo $styledata[1]; ?>px;
            color: <?php echo $styledata[3]; ?>;
            background-color: <?php echo $styledata[5]; ?>;
            font-weight: <?php echo $styledata[13]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[11]); ?>;
            -webkit-box-shadow: inset 3px -36px 52px -24px rgba(255, 255, 255, 0.28);
            -moz-box-shadow: inset 3px -36px 52px -24px rgba(255, 255, 255, 0.28);
            -o-box-shadow: inset 3px -36px 52px -24px rgba(255, 255, 255, 0.28);
            -ms-box-shadow: inset 3px -36px 52px -24px rgba(255, 255, 255, 0.28);
            box-shadow: inset 3px -36px 52px -24px rgba(255, 255, 255, 0.28);
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            color: <?php echo $styledata[7]; ?>;
            width: 100%;
            margin-right: 0;
            background-color:  <?php echo $styledata[9]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active .ctu-absolute{
            position: absolute;
            left: 0;
            top: 15%;
            bottom: 15%;
            width: 3px;
            background-color:  <?php echo $styledata[7]; ?>;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: calc(100% - <?php echo $styledata[33]; ?>px);
            float: left;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            width: 100%;
            cursor: pointer;
            display: none;
            line-height: 100%;
            background-color: <?php echo $styledata[5]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            padding: <?php echo $styledata[15]; ?>px <?php echo $styledata[17]; ?>px;
            font-weight: <?php echo $styledata[13]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[11]); ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            color: <?php echo $styledata[7]; ?>;
            background-color: <?php echo $styledata[9]; ?>;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            display: -webkit-box;
            display: -ms-flexbox;
            display: -moz-flexbox;
            display: -o-flexbox;
            display: flex;
            display: none;
            text-align: <?php echo $styledata[41]; ?>;            
            padding: <?php echo $styledata[25]; ?>px <?php echo $styledata[27]; ?>px <?php echo $styledata[29]; ?>px <?php echo $styledata[31]; ?>px;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            font-size: <?php echo $styledata[19]; ?>px;
            color: <?php echo $styledata[21]; ?>;
            line-height: <?php echo $styledata[35]; ?>;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[37]); ?>;
            font-weight: <?php echo $styledata[39]; ?>;
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
                background-color: transparent;
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
                -webkit-box-shadow:   0 0 5px <?php echo $styledata[45]; ?>;
                -o-box-shadow:   0 0 5px <?php echo $styledata[45]; ?>;
                -ms-box-shadow:   0 0 <?php echo $styledata[45]; ?>;
                -moz-box-shadow:   0 0 <?php echo $styledata[45]; ?>;
                box-shadow:   0 0 5px <?php echo $styledata[45]; ?>;
                margin-bottom: 10px;
            }
            .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
                margin-bottom: 10px;
                background-color: <?php echo $styledata[23]; ?>;
                -webkit-box-shadow:   0 0 5px <?php echo $styledata[45]; ?>;
                -o-box-shadow:   0 0 5px <?php echo $styledata[45]; ?>;
                -ms-box-shadow:   0 0 5px <?php echo $styledata[45]; ?>;
                -moz-box-shadow:   0 0 5px <?php echo $styledata[45]; ?>;
                box-shadow:   0 0 5px <?php echo $styledata[45]; ?>;
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
                echo '<div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="">
                                ' . ctu_html_special_charecter($value['title']) . '
                                <div class="ctu-absolute"></div>
                            </div>';
            }
            echo ' </div><div class="ctu-ultimate-style-' . $styleid . '-content">';
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
            echo '</div> ';
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
                    var headerheight = <?php echo $oxi_fixed_header;?>;
                    jQuery('html, body').animate({
                        scrollTop: jQuery(".ctu-ultimate-wrapper-<?php echo $styleid; ?>").offset().top - headerheight
                    }, 2000);
                }
            });

        });
    </script>
    <?php
}
