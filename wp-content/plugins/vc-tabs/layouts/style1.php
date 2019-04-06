<?php

if (!defined('ABSPATH'))
    exit;
responsive_tabs_with_accordions_user_capabilities();
$styledata = Array(
    'id' => 1,
    'style_name' => 'style1',
    'css' => 'heading-font-size |20| heading-font-color |#b5b5b5| heading-background-color |rgba(255, 255, 255, 1)| heading-font-active-color |#ffffff| heading-background-active-color |rgba(50, 222, 212, 1)| heading-font-familly |Open+Sans| heading-font-weight |500| heading-text-align |flex-start| heading-width |170| heading-padding |15| heading-Border-radius |5| heading-box-shadow-Blur |20| heading-box-shadow-color |rgba(225, 225, 225, 0.57)| content-font-size |16| content-font-color |#585a61| content-background-color |rgba(255, 255, 255, 1)| content-padding-top |30| content-padding-right |20| content-padding-bottom |20| content-padding-left |20| content-line-height |1.5| content-font-familly |Open+Sans| content-font-weight |200| content-font-align |left| content-box-shadow-Blur |17| content-box-shadow-color |rgba(225, 225, 225, 0.57)| heading-border-top |3| heading-margin-bottom |17| heading-box-shadow-Horizontal |0| heading-box-shadow-Vertical |0| heading-box-shadow-Spread |0| content-box-shadow-Horizontal |0| content-box-shadow-Vertical |0| content-box-shadow-Spread |0| custom-css ||'
);
$listdata = Array(
    0 => Array('id' => 1, 'styleid' => 1, 'title' => 'Default Title', 'files' => '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> <p>&nbsp;</p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p><p>&nbsp;</p><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste</p>', 'css' => 'fas fa-address-book'),
    1 => Array('id' => 2, 'styleid' => 1, 'title' => 'Default Title', 'files' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>  <p>&nbsp;</p> <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste</p>', 'css' => 'fab fa-algolia'),
    2 => Array('id' => 3, 'styleid' => 1, 'title' => 'Default Title', 'files' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>   <p>&nbsp;</p>   <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>   <p>&nbsp;</p>   <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste</p>', 'css' => 'fab fa-adn'),
    3 => Array('id' => 4, 'styleid' => 1, 'title' => 'Default Title', 'files' => ' <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent congue lorem vel molestie rutrum.</p>   <p>&nbsp;</p>   <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam arcu nunc, hendrerit sed vestibulum ut, semper eu lectus.</p>   <p>&nbsp;</p>   <p>Curabitur non ex fringilla, cursus quam eu, hendrerit lectus. Mauris tempor nibh erat, eget lacinia justo porta ut.</p>', 'css' => 'fas fa-ambulance')
);
echo '<input type="hidden" name="oxi-tabs-data-' . $styledata['id'] . '" id="oxi-tabs-data-' . $styledata['id'] . '" value="' . $styledata['css'] . '">';
echo ctu_admin_style_layouts($styledata, $listdata);

/*
$styledata = Array('id' => 1, 'style_name' => 'style1', 'css' => '');
$listdata = Array(
    0 => Array('id' => 1, 'styleid' => 1, 'title' => 'Default Title', 'files' => '', 'css' => 'fas fa-address-book'),
    1 => Array('id' => 2, 'styleid' => 1, 'title' => 'Default Title', 'files' => '', 'css' => 'fab fa-algolia'),
    2 => Array('id' => 3, 'styleid' => 1, 'title' => 'Default Title', 'files' => '', 'css' => 'fab fa-adn'),
    3 => Array('id' => 4, 'styleid' => 1, 'title' => 'Default Title', 'files' => '', 'css' => 'fas fa-ambulance')
);
echo '<input type="hidden" name="oxi-tabs-data-' . $styledata['id'] . '" id="oxi-tabs-data-' . $styledata['id'] . '" value="' . $styledata['css'] . '">';
echo ctu_admin_style_layouts($styledata, $listdata);
 * 
 */


