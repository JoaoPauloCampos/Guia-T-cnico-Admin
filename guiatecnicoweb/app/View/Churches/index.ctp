<div class="churches index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Localização'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Nova localização'), array('action' => 'add'), array('escape' => false)); ?></li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
						<th><?php echo $this->Paginator->sort('text', 'Texto'); ?></th>
						<th><?php echo $this->Paginator->sort('address', 'Endereço'); ?></th>
						<th><?php echo $this->Paginator->sort('lat', 'Latitude'); ?></th>
						<th><?php echo $this->Paginator->sort('lng', 'Longitude'); ?></th>
						<th><?php echo $this->Paginator->sort('created', 'Criado'); ?></th>
						<th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($churches as $church): ?>
					<tr>
						<td><?php echo h($church['Church']['id']); ?>&nbsp;</td>
						<td><?php echo h($church['Church']['name']); ?>&nbsp;</td>
						<td><?php echo h($church['Church']['text']); ?>&nbsp;</td>
						<td><?php echo h($church['Church']['address']); ?>&nbsp;</td>
						<td><?php echo h($church['Church']['lat']); ?>&nbsp;</td>
						<td><?php echo h($church['Church']['lng']); ?>&nbsp;</td>
						<td><?php echo h($church['Church']['created']); ?>&nbsp;</td>
						<td><?php echo h($church['Church']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $church['Church']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $church['Church']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $church['Church']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $church['Church']['id'])); ?>
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