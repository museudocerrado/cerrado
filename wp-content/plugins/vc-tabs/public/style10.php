<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style10($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    ?>
    <style>
        .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
            width: 100%;
            float: left;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?>{
            margin: 0 0 0 0;
            width: calc(<?php echo 100 - $styledata[35]; ?>% + <?php echo $styledata[25]; ?>px);
            float: left;
            list-style: none;
            text-align: center;
            margin-bottom: 0;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li{
            width:  calc(100% - <?php echo $styledata[25]; ?>px);
            position: relative;
            list-style: none;
            cursor: pointer;
            max-width: <?php echo $styledata[13]; ?>px;
            display: block;
            padding-left: 10px;
            margin-bottom: 0;
            padding-top: <?php echo $styledata[17]; ?>px;
            padding-bottom:<?php echo $styledata[17]; ?>px;
            text-align: left;
            color: <?php echo $styledata[3]; ?>;
            border-left: 5px solid;
            border-left-color: transparent; 
            font-size: <?php echo $styledata[1]; ?>px;
            font-family:    <?php echo ctu_font_familly_special_charecter($styledata[9]); ?>;
            font-weight: <?php echo $styledata[11]; ?>;
            line-height: 100%;

        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            color: <?php echo $styledata[5]; ?>;
            border-left-color: <?php echo $styledata[5]; ?>;
            background-color: <?php echo $styledata[7]; ?>;
            border-radius:  5px 0 0 5px;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li em{
            display: inline-block;
            float: left;
            margin-right: 10px;
            background: <?php echo $styledata[23]; ?>;
            text-align: center;
            height: <?php echo $styledata[1]; ?>px;
            width: <?php echo $styledata[1]; ?>px;
            border-radius: 50%;
            font-style: normal;
            font-size: <?php echo $styledata[19]; ?>px;
            color: <?php echo $styledata[21]; ?>;
            line-height: <?php echo $styledata[1]; ?>px;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active{
            border-color:  <?php echo $styledata[5]; ?>;
            -webkit-box-shadow:    <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[67]; ?>;
            -o-box-shadow:    <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[67]; ?>;
            -ms-box-shadow:    <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[67]; ?>;
            -moz-box-shadow:    <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[67]; ?>;
            box-shadow:   <?php echo $styledata[69]; ?>px <?php echo $styledata[71]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[67]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active em{
            background-color: <?php echo $styledata[5]; ?>;
            color: <?php echo $styledata[15]; ?>;
        }
        .ctu-ulimate-style-<?php echo $styleid; ?> .vc-tabs-li.active span{
            width: <?php echo $styledata[25]; ?>px;
            position: absolute;
            right: -<?php echo $styledata[25] / 2; ?>px;
            top: <?php echo $styledata[27]; ?>px;
            height: <?php echo $styledata[25]; ?>px;
            border-radius: 14px;
            -webkit-border-radius: 14px;
            -moz-border-radius: 14px;
            -ms-border-radius: 14px;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            display: block;
            background-color: <?php echo $styledata[7]; ?>;
        }
        .ctu-ultimate-style-<?php echo $styleid; ?>-content{
            width: calc(<?php echo $styledata[35]; ?>% - <?php echo $styledata[25]; ?>px);
            float: left;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
            width: 100%;
            cursor: pointer;
            display: none;
            float: left;
            line-height: 100%;
            color: <?php echo $styledata[3]; ?>;
            background-color: <?php echo $styledata[7]; ?>;
            font-size: <?php echo $styledata[1]; ?>px;
            padding: <?php echo $styledata[17]; ?>px 10px;
            font-weight: <?php echo $styledata[11]; ?>;
            border-radius: 5px;
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[9]); ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?> em{
            display: inline-block;
            float: left;
            margin-right: 10px;
            background: <?php echo $styledata[23]; ?>;
            text-align: center;
            height: <?php echo $styledata[1]; ?>px;
            width: <?php echo $styledata[1]; ?>px;
            border-radius: 50%;
            font-weight: normal;
            font-size: <?php echo $styledata[19]; ?>px;
            color: <?php echo $styledata[21]; ?>;
            line-height: <?php echo $styledata[1]; ?>px;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active em{
            background-color: <?php echo $styledata[5]; ?>;
            color: <?php echo $styledata[15]; ?>;
        }
        .ctu-ultimate-style-heading-<?php echo $styleid; ?>.active{
            color: <?php echo $styledata[5]; ?>;
            border-radius: 5px 5px 0 0;                         
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
            float: left;
            width: 100%;
            display: none;
            float: left;
            text-align: <?php echo $styledata[51]; ?>;
            border-radius: <?php echo $styledata[63]; ?>px;
            color: <?php echo $styledata[31]; ?>;
            background-color: <?php echo $styledata[33]; ?>;
            -webkit-box-shadow:    <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
            -o-box-shadow:    <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
            -ms-box-shadow:   <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
            -moz-box-shadow:    <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
            box-shadow:   <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
            padding: <?php echo $styledata[37]; ?>px <?php echo $styledata[39]; ?>px  <?php echo $styledata[41]; ?>px  <?php echo $styledata[43]; ?>px ;
        }
        .ctu-ulitate-style-<?php echo $styleid; ?>-tabs p{
            font-family:  <?php echo ctu_font_familly_special_charecter($styledata[47]); ?>;
            font-size: <?php echo $styledata[29]; ?>px;
            font-weight: <?php echo $styledata[49]; ?>;
            line-height: <?php echo $styledata[45]; ?>;
            margin-bottom: 0;
            margin-top: 0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-<?php echo $styleid; ?>{
                display: block;
            }
            .ctu-ultimate-style-<?php echo $styleid; ?>-content{
                width: 100%;
                float: left;
            }
            .ctu-ulimate-style-<?php echo $styleid; ?> {
                display: none;
            }
            .ctu-ultimate-style-heading-<?php echo $styleid; ?>{
                display: block;
                -webkit-box-shadow:   0 0 5px <?php echo $styledata[55]; ?>;
                -o-box-shadow:   0 0 5px <?php echo $styledata[55]; ?>;
                -ms-box-shadow:   0 0 5px <?php echo $styledata[55]; ?>;
                -moz-box-shadow:   0 0 5px<?php echo $styledata[55]; ?>;
                box-shadow:   0 0 5px <?php echo $styledata[55]; ?>;
                margin-bottom: 10px;
            }
            .ctu-ulitate-style-<?php echo $styleid; ?>-tabs{
                margin-bottom: 10px;
                -webkit-box-shadow:   <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
                -o-box-shadow:   <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
                -ms-box-shadow:   <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
                -moz-box-shadow:   <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
                box-shadow:   <?php echo $styledata[57]; ?>px <?php echo $styledata[59]; ?>px <?php echo $styledata[53]; ?>px <?php echo $styledata[61]; ?>px <?php echo $styledata[55]; ?>;
                border-radius: 0 0 5px 5px;
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
            $index = 1;
            foreach ($listdata as $value) {
                echo '<div class="vc-tabs-li" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                                <em>' . $index++ . '</em>
                                ' . ctu_html_special_charecter($value['title']) . '
                                    <span></span>
                            </div>';
            }
            echo '</div>';
            $index = 1;
            echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
            foreach ($listdata as $value) {
                echo ' 
                        <div class="ctu-ultimate-style-heading-' . $styleid . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                             <em>' . $index++ . '</em> ' . ctu_html_special_charecter($value['title']) . '
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
                jQuery(".ctu-ulitate-style-<?php echo $styleid; ?>-tabs<?php echo $initialopen; ?>").slideDown("slow");
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
    