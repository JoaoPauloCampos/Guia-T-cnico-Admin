<div class="settings view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Setting'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Menu</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Setting'), array('action' => 'edit', $setting['Setting']['id']), array('escape' => false)); ?> </li>
									<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Setting'), array('action' => 'delete', $setting['Setting']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $setting['Setting']['id'])); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;Listar Settings'), array('action' => 'index'), array('escape' => false)); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Setting'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($setting['Setting']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($setting['Setting']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Photo'); ?></th>
		<td>
			<?php echo h($setting['Setting']['photo']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Photo Dir'); ?></th>
		<td>
			<?php echo h($setting['Setting']['photo_dir']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Geral Color'); ?></th>
		<td>
			<?php echo h($setting['Setting']['geral_color']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Email Contato'); ?></th>
		<td>
			<?php echo h($setting['Setting']['email_contato']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Facebook Url'); ?></th>
		<td>
			<?php echo h($setting['Setting']['facebook_url']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Twitter Url'); ?></th>
		<td>
			<?php echo h($setting['Setting']['twitter_url']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

