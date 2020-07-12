<?php
$baseDir = $module = '';
if(!empty($_SESSION['lang_tool']['module'])) {
    $module = $_SESSION['lang_tool']['module'];
}
if(!empty($_SESSION['lang_tool']['base_dir'])) {
    $baseDir = $_SESSION['lang_tool']['base_dir'];
}
echo $this->renderElement('navbar', array('step' => 1));
if(isset($error)) {
    echo $error;
} else {
    echo $form->create('Do', array('url' => array('controller' => 'do', 'action' => 'step2')));
    echo $form->input('module', array('type' => 'select', 'options' => $modules,
    'label' => _MD_LANG_TOOL_SESELECTMOD, 'selected' => $module, 'onChange' => 'xoops$(\'DoManualPath\').value=\'\';'));
    echo $form->input('manual_path', array('type' => 'text', 'label' => _MD_LANG_TOOL_MANUALPATH,
    'value' => $baseDir, 'size' => 80));
    echo $form->end('Submit');
}