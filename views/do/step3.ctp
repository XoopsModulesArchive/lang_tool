<?php
echo $this->renderElement('navbar', array('step' => 3));
echo _MD_LANG_TOOL_SESELECTFILE;
if(isset($showFocus)) {
    echo '<a href="#focus">[>>>]</a>';
}
echo $form->create('Do', array('url' => array('controller' => 'do', 'action' => 'step4')));
echo '<hr><table cellpadding="0" cellspacing="0">';
$i = 0;
foreach($lang_file AS $file) {
    if(++$i % 2 == 0) {
        echo '<tr class="odd">';
    } else {
        echo '<tr class="even">';
    }
    $fileString = $file;
    if(isset($_SESSION['lang_tool']['file']) && $_SESSION['lang_tool']['file'] == $file) {
        $fileString = '<a name="focus"></a><b>' . $fileString . '</b>';
    }
    echo '<td><input type="radio" name="data[Do][file]" value="' . $file . '" onClick="this.form.submit();">' . $fileString . '</td><td>';
    $the_file1 = $_SESSION['lang_tool']['base_dir'] . $_SESSION['lang_tool']['from'] .
    $_SESSION['lang_tool']['path'] . DS . $file;
    $the_file2 = $_SESSION['lang_tool']['base_dir'] . $_SESSION['lang_tool']['to'] .
    $_SESSION['lang_tool']['path'] . DS . $file;
    if(is_dir($the_file1) && $file != '..') {
        echo _MD_LANG_TOOL_ISFOLDER;
    }
    if(file_exists($the_file2)){
        echo _MD_LANG_TOOL_FILEEXIST;
    }
    echo '</td></tr>';
}
echo '</table>';
echo $form->end('Submit');