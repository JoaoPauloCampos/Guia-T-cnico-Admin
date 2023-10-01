<div class="manuals index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Manuais'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Novo Manual'), array('action' => 'add'), array('escape' => false)); ?></li>
													</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('cod', 'Id'); ?></th>
						<th><?php echo $this->Paginator->sort('codCategoria', 'Categoria'); ?></th>
						<th><?php echo $this->Paginator->sort('codTipoManual', 'Tipo Manual'); ?></th>
						<th><?php echo $this->Paginator->sort('titulo', 'Título'); ?></th>
						<th><?php echo $this->Paginator->sort('url');?></th>
						<th><?php echo $this->Paginator->sort('marca'); ?></th>
						<th><?php echo $this->Paginator->sort('modelo'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($manuais as $manual): ?>
					<tr>
						<td><?php echo h($manual['Manual']['cod']); ?>&nbsp;</td>
						<td><?php echo h($manual['Categoria']['name']); ?>&nbsp;</td>
						<td><?php echo h($manual['TipoManual']['name']); ?>&nbsp;</td>
						<td><?php echo h($manual['Manual']['titulo']); ?>&nbsp;</td>
						<td><?php echo h($manual['Manual']['url']); ?>&nbsp;</td>
						<td><?php echo h($manual['Manual']['marca']); ?>&nbsp;</td>
						<td><?php echo h($manual['Manual']['modelo']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $manual['Manual']['cod']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $manual['Manual']['cod'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Página {:page} de {:pages}, mostrando {:current} manuais de {:count} no total, começando do manual {:start}, terminando em {:end}')));?></small>
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