<div class="ltLanguages form">
<?php echo $form->create('LtLanguage');?>
	<fieldset>
 		<legend><?php __('Add LtLanguage');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('dirname');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List LtLanguages', true), array('action'=>'index'));?></li>
	</ul>
</div>
