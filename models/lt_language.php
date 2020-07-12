<?php
class LtLanguage extends AppModel {

	var $name = 'LtLanguage';
	var $validate = array(
		'title' => array('alphanumeric'),
		'dirname' => array('alphanumeric')
	);

}
?>