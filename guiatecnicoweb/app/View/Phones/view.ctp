<div class="phones view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Telefone'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Editar Telefone'), array('action' => 'edit', $phone['Phone']['id']), array('escape' => false)); ?> </li>
									<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Deletar Telefone'), array('action' => 'delete', $phone['Phone']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $phone['Phone']['id'])); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;Listar Telefones'), array('action' => 'index'), array('escape' => false)); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Novo Telefone'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
<tr>
		<th><?php echo __('Usuário'); ?></th>
		<td>
			<?php echo $this->Html->link($phone['User']['name'], array('controller' => 'users', 'action' => 'view', $phone['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Telefone'); ?></th>
		<td>
			<?php echo h($phone['Phone']['phone']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Informação'); ?></th>
		<td>
			<?php echo h($phone['Phone']['info']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Criado'); ?></th>
		<td>
			<?php echo h($phone['Phone']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modificado'); ?></th>
		<td>
			<?php echo h($phone['Phone']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

