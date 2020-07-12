<?php
echo $this->renderElement('navbar', array('step' => 5));
echo _MD_LANG_TOOL_YOUCANFIND. $targetFile;
echo '<p>'.$html->link(_MD_LANG_TOOL_DOWNLOAD, array('action' => 'download')).'</p>' . _MD_LANG_TOOL_SHARE;