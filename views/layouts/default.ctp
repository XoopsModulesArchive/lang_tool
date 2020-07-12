<?php
global $xoopsTpl;
$xoopsTpl->assign('xoops_module_header', $html->css('cake.generic') . $scripts_for_layout);
if ($session->check('Message.flash')):
    $session->flash();
endif;
echo $content_for_layout;
echo $cakeDebug;