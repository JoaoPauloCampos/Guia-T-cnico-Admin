<div class="events view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Evento'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Editar Evento'), array('action' => 'edit', $event['Event']['id']), array('escape' => false)); ?> </li>
									<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Deletar Evento'), array('action' => 'delete', $event['Event']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $event['Event']['id'])); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;Listar Eventos'), array('action' => 'index'), array('escape' => false)); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Novo Evento'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('ID'); ?></th>
		<td>
			<?php echo h($event['Event']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Nome'); ?></th>
		<td>
			<?php echo h($event['Event']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Data'); ?></th>
		<td>
			<?php echo h($event['Event']['data']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Hora'); ?></th>
		<td>
			<?php echo h($event['Event']['hora']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Descrição'); ?></th>
		<td>
			<?php echo h($event['Event']['text']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Foto'); ?></th>
		<td>
			<?php echo h($event['Event']['photo']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Criado'); ?></th>
		<td>
			<?php echo h($event['Event']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modificado'); ?></th>
		<td>
			<?php echo h($event['Event']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

