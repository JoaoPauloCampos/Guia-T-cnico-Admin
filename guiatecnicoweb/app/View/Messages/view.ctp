<div class="messages view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Mensagem'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Editar Mensagem'), array('action' => 'edit', $message['Message']['id']), array('escape' => false)); ?> </li>
									<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Deletar Mensagem'), array('action' => 'delete', $message['Message']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $message['Message']['id'])); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;Listar Mensagens'), array('action' => 'index'), array('escape' => false)); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Nova Mensagem'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
<tr>
		<th><?php echo __('Mensagem'); ?></th>
		<td>
			<?php echo h($message['Message']['text']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Criado'); ?></th>
		<td>
			<?php echo h($message['Message']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modificado'); ?></th>
		<td>
			<?php echo h($message['Message']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

