<div class="ltLanguages view">
<h2><?php  __('LtLanguage');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ltLanguage['LtLanguage']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ltLanguage['LtLanguage']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dirname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ltLanguage['LtLanguage']['dirname']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit LtLanguage', true), array('action'=>'edit', $ltLanguage['LtLanguage']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete LtLanguage', true), array('action'=>'delete', $ltLanguage['LtLanguage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ltLanguage['LtLanguage']['id'])); ?> </li>
		<li><?php echo $html->link(__('List LtLanguages', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New LtLanguage', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
