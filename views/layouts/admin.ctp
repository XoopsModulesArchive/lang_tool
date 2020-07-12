<?php
include_once XOOPS_ROOT_PATH . "/include/cp_functions.php";
xoops_load('file/xoopsfile');
xoops_load('cache/xoopscache');
xoops_load('cache/file');
xoops_cp_header();
if ($session->check('Message.flash')){
    echo '<div class="errorMsg">';
    $session->flash();
    echo '</div>';
}
$view_folder = new Folder(VIEWS);
$view_folders = $view_folder->read();
$cnt = 0;
foreach($view_folders[0] AS $folder) {
    if(file_exists(VIEWS . $folder . DS . Configure::read('Routing.admin') . '_index.ctp')) {
        echo $html->link($folder, '/' . Configure::read('Routing.admin') . '/' . $folder) . ' | ';
        if(++$cnt%10==0) {
            echo '<br />';
        }
    }
}
echo '<hr />';
echo $content_for_layout;
echo $cakeDebug;
xoops_cp_footer();
exit();