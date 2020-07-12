<div class="ltLanguages form">
<?php echo $form->create('LtLanguage');?>
	<fieldset>
 		<legend><?php __('Edit LtLanguage');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('dirname');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('LtLanguage.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('LtLanguage.id'))); ?></li>
		<li><?php echo $html->link(__('List LtLanguages', true), array('action'=>'index'));?></li>
	</ul>
</div>
