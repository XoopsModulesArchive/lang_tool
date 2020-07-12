<?php
$modversion['name'] = _MI_LANG_TOOL_NAME;
$modversion['version'] = 0.08;
$modversion['description'] = _MI_LANG_TOOL_DESC;
$modversion['credits'] = '';
$modversion['author'] = 'Finjon Kiang | http://twpug.net/';
$modversion['license'] = 'GPL V3';
$modversion['official'] = 0;
$modversion['image'] = 'img/lang_tool_slogo.png';
$modversion['dirname'] = 'lang_tool';

$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][0] = "lt_languages";

$modversion['hasMain'] = 1;

$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/pages";
$modversion['adminmenu'] = "menu.php";
