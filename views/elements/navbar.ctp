<?php
function showitem($str, $key, $step){
    if(!$step || ($step == $key && $key == 1))
    return '<font color="red">'.$str.'</font>';
    else if($step == $key)
    return ' => <font color="red">'.$str.'</font>';
    else if($key == 1)
    return '<a href="' . Router::url(array('action' => 'step1')) . '">' . $str . '</a>';
    else if($key == 2 && isset($_SESSION['lang_tool']['module']))
    return ' => <a href="' . Router::url(array('action' => 'step2')) . '">' . $str . '</a>';
    else if($key == 3 && isset($_SESSION['lang_tool']['from']))
    return ' => <a href="' . Router::url(array('action' => 'step3')) . '">' . $str . '</a>';
    else
    return ' => '.$str;
}

echo _MD_LANG_TOOL_STEPS;
echo showitem(_MD_LANG_TOOL_STEPS_MODULE, 1, $step);
echo showitem(_MD_LANG_TOOL_STEPS_LANGUAGE, 2, $step);
echo showitem(_MD_LANG_TOOL_STEPS_FILE, 3, $step);
echo showitem(_MD_LANG_TOOL_STEPS_TRANSLATE, 4, $step);
echo showitem(_MD_LANG_TOOL_STEPS_FINISH, 5, $step);
echo '<hr />';