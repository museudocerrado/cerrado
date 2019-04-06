<?php

if (!defined('ABSPATH'))
    exit;
responsive_tabs_with_accordions_user_capabilities();
$styledata = Array('id' => 11, 'style_name' => 'style11', 'css' => 'heading-font-size |20| heading-font-color |#a6a6a6| heading-background-color |#ffffff| heading-font-familly |Open+Sans| heading-font-weight |500| heading-width |200| heading-text-align |flex-start| heading-padding |15| heading-margin-right |10| heading-margin-bottom |5| heading-icon-size |20| heading-box-shadow-Blur |5| heading-box-shadow-color |rgba(191, 191, 191, 1)| content-font-size |16| content-font-color |#999999| content-background-color |#ffffff| content-padding-top |30| content-padding-right |30| content-padding-bottom |30| content-padding-left |30| content-line-height |1.5| content-font-familly |Open+Sans| content-font-weight |300| content-font-align |left|content-box-shadow-Blur |10| content-box-shadow-color |rgba(230, 230, 230, 1)| content-box-shadow-Horizontal |0| content-box-shadow-Vertical |0| content-box-shadow-Spread |0| heading-box-shadow-Horizontal |0| heading-box-shadow-Vertical |0| heading-box-shadow-Spread |0| heading-font-style |normal| custom-css |||');
$listdata = Array(
    0 => Array('id' => 1, 'styleid' => 11, 'title' => 'Default Title', 'files' => '<p>Suspendisse feugiat, lorem at accumsan luctus, ante justo commodo dui, vitae dictum elit massa et elit. Nullam maximus sem sed risus tempus, sed tempor sem dignissim. Morbi dapibus pellentesque erat, non facilisis felis rhoncus in. Vivamus venenatis volutpat auctor. Nam congue neque congue diam pellentesque, vitae lobortis felis semper. Suspendisse ornare tincidunt urna at aliquet. Etiam ac leo non ipsum molestie tempus. Vestibulum lectus felis, mollis scelerisque tincidunt id, tristique sit amet urna.</p>            <p>&nbsp;</p>            <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut pellentesque finibus ante vehicula posuere. Etiam aliquet auctor euismod. Phasellus mollis nibh sed mollis porttitor. Sed imperdiet, ipsum quis dapibus egestas, est mauris viverra nibh, ac tincidunt velit diam eget urna. Quisque nec ex lacus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut volutpat massa ac nulla rutrum, vitae ultrices tortor feugiat. Ut luctus sed augue posuere mollis.</p>', 'css' => 'color |#a13737|font-awesome-icon|' . VcTabsAdminFontAwesomeData('book')),
    1 => Array('id' => 2, 'styleid' => 11, 'title' => 'Default Title', 'files' => '<p>Nam tincidunt consectetur viverra. Nam euismod dui ut ex tempus, et posuere nisl molestie. Vivamus ut commodo mi. Etiam molestie posuere lorem, ut scelerisque sapien dictum vel. Nulla egestas nisl commodo, eleifend sapien quis, lobortis odio. Vestibulum euismod ultrices mi, sit amet ullamcorper ligula ultrices a. Phasellus consequat malesuada tortor id ornare. Cras sed scelerisque ex, vitae facilisis diam. Donec ultricies elementum mauris sed interdum. Mauris tristique, diam ut pellentesque mollis, augue arcu pulvinar est, nec vulputate est enim placerat urna. Aliquam bibendum tempus orci id lacinia. Pellentesque urna velit, hendrerit sed ante eu, pellentesque egestas metus. Cras vestibulum dignissim elementum. Suspendisse dignissim bibendum lorem, et condimentum lorem posuere non.</p><p>&nbsp;</p>            <p>Suspendisse feugiat, lorem at accumsan luctus, ante justo commodo dui, vitae dictum elit massa et elit. Nullam maximus sem sed risus tempus, sed tempor sem dignissim. Morbi dapibus pellentesque erat, non facilisis felis rhoncus in. Vivamus venenatis volutpat auctor. Nam congue neque congue diam pellentesque, vitae lobortis felis semper. Suspendisse ornare tincidunt urna at aliquet. Etiam ac leo non ipsum molestie tempus. Vestibulum lectus felis, mollis scelerisque tincidunt id, tristique sit amet urna.</p>', 'css' => 'color |#d10062|font-awesome-icon|' . VcTabsAdminFontAwesomeData('github')),
    2 => Array('id' => 3, 'styleid' => 11, 'title' => 'Default Title', 'files' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis leo diam, sed blandit eros fringilla sed. Nulla accumsan risus metus, venenatis tincidunt ligula sagittis a. Mauris at egestas elit. Nunc vel erat blandit, accumsan eros a, ullamcorper libero. Aenean ante tellus, posuere in purus et, aliquet fermentum est. Fusce id blandit lacus, at dictum nunc. In quis volutpat nisi. Morbi aliquet tortor id odio finibus pellentesque. Donec sit amet ligula felis. Sed blandit suscipit est, non faucibus nisi. Nam nec diam lorem.</p><p>&nbsp;</p> <p>Nam tincidunt consectetur viverra. Nam euismod dui ut ex tempus, et posuere nisl molestie. Vivamus ut commodo mi. Etiam molestie posuere lorem, ut scelerisque sapien dictum vel. Nulla egestas nisl commodo, eleifend sapien quis, lobortis odio. Vestibulum euismod ultrices mi, sit amet ullamcorper ligula ultrices a. Phasellus consequat malesuada tortor id ornare. Cras sed scelerisque ex, vitae facilisis diam. Donec ultricies elementum mauris sed interdum. Mauris tristique, diam ut pellentesque mollis, augue arcu pulvinar est, nec vulputate est enim placerat urna. Aliquam bibendum tempus orci id lacinia. Pellentesque urna velit, hendrerit sed ante eu, pellentesque egestas metus. Cras vestibulum dignissim elementum. Suspendisse dignissim bibendum lorem, et condimentum lorem posuere non.</p>', 'css' => 'color |#1100d1|font-awesome-icon|' . VcTabsAdminFontAwesomeData('adn')),
    3 => Array('id' => 4, 'styleid' => 11, 'title' => 'Default Title', 'files' => '<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut pellentesque finibus ante vehicula posuere. Etiam aliquet auctor euismod. Phasellus mollis nibh sed mollis porttitor. Sed imperdiet, ipsum quis dapibus egestas, est mauris viverra nibh, ac tincidunt velit diam eget urna. Quisque nec ex lacus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut volutpat massa ac nulla rutrum, vitae ultrices tortor feugiat. Ut luctus sed augue posuere mollis.</p>       <p>&nbsp;</p>   <p>In ornare tincidunt enim. Sed nec quam quis neque rutrum tincidunt. Suspendisse potenti. Cras nec cursus lectus, in rhoncus velit. Etiam at accumsan dolor. Cras bibendum porttitor ante eu elementum. Quisque eu scelerisque justo. Pellentesque bibendum lorem sit amet bibendum aliquam. Vestibulum eu quam id dui ultrices cursus. Curabitur porttitor lectus ac mauris vehicula imperdiet. Vivamus eget leo nec nunc blandit ultrices ut ac dolor. Aenean accumsan dolor nunc. Fusce rutrum lacus a elit vestibulum, quis auctor metus sodales. Aenean non suscipit nisi, in hendrerit velit.</p>', 'css' => 'color |#00d16f|font-awesome-icon|' . VcTabsAdminFontAwesomeData('ambulance'))
);
echo '<input type="hidden" name="oxi-tabs-data-' . $styledata['id'] . '" id="oxi-tabs-data-' . $styledata['id'] . '" value="' . $styledata['css'] . '">';
echo ctu_admin_style_layouts($styledata, $listdata);