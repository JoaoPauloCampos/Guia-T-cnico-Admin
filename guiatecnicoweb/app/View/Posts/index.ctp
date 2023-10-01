<div class="posts index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Mural'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Menu</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Novo Post'), array('action' => 'add'), array('escape' => false)); ?></li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id','ID'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id','Usuário'); ?></th>
						<th><?php echo $this->Paginator->sort('text','Texto'); ?></th>
						<th><?php echo $this->Paginator->sort('active','Ativo'); ?></th>
						<th><?php echo $this->Paginator->sort('created','Data Criação'); ?></th>
						<!--<th><?php echo $this->Paginator->sort('modified','Data Moficação'); ?></th>-->
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($posts as $post): ?>
					<tr>
						<td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($post['User']['name'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
							&nbsp;
						</td>
						<td><?php echo h($post['Post']['text']); ?>&nbsp;</td>
						<td><?php
							if($post['Post']['active']=="1")
								echo '<span class="label label-success">Sim <span class="glyphicon glyphicon-ok-circle"></span></span>';
							else
								echo '<span class="label label-danger">Não <span class="glyphicon glyphicon-ban-circle"></span></span>'; ?>&nbsp;
						</td>
						<td><?php echo h($post['Post']['created']); ?>&nbsp;</td>
						<!--<td><?php echo h($post['Post']['modified']); ?>&nbsp;</td>-->
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $post['Post']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $post['Post']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $post['Post']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $post['Post']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Pagina {:page} de {:pages}, mostrando {:current} registros de {:count} total, começando em {:start}, terminando em {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination pagination-sm">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->