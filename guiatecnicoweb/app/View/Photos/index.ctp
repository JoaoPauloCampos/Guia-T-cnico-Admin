<div class="photos index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Fotos'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Nova Foto'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Listar Álbuns'), array('controller' => 'galleries', 'action' => 'index'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->


		<div class="col-md-9">
			<?php foreach ($photos as $photo): ?>
				<div class="col-sm-4">
					<div class="list-group">
						<ul class="list-group-item active">
				            <h3 class="panel-title"><?php echo __('Foto'); ?></h3>
				        </ul>
				        <ul class="list-group-item">
							<td>
								<b>Álbum</b></br>
								<?php echo $this->Html->link($photo['Gallery']['name'], array('controller' => 'galleries', 'action' => 'view', $photo['Gallery']['id'])); ?>
							</td>
				        </ul>
				        <ul class="list-group-item">
				            <img class="img-thumbnail" src="<?php echo $photo['Photo']['photo']; ?>" width=400 style="height:150px;"/>

							<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'photos', 'action' => 'view', $photo['Photo']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'photos', 'action' => 'edit', $photo['Photo']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'photos', 'action' => 'delete', $photo['Photo']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $photo['Photo']['id'])); ?>
				        </ul>
				    </div>
				</div>
			<?php endforeach; ?>
		</div> <!-- end col md 9 -->
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

	</div><!-- end row -->
</div><!-- end containing of content -->