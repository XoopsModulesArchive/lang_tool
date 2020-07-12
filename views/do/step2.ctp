<?php
$from = $to = '';
if(!empty($_SESSION['lang_tool']['from'])) {
    $from = $_SESSION['lang_tool']['from'];
}
if(!empty($_SESSION['lang_tool']['to'])) {
    $to = $_SESSION['lang_tool']['to'];
}
echo $this->renderElement('navbar', array('step' => 2));
echo _MD_LANG_TOOL_SESELECTLANG;
echo $form->create('Do', array('url' => array('controller' => 'do', 'action' => 'step3')));
echo $form->input('from', array('type' => 'select', 'options' => $languages, 'label' => _MD_LANG_TOOL_FROM,
'selected' => $from));
echo $form->input('to', array('type' => 'select', 'options' => $languages, 'label' => _MD_LANG_TOOL_TO,
'selected' => $to));
echo $form->end('Submit');