<div class="videos index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Vídeos'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Novo Vídeo'), array('action' => 'add'), array('escape' => false)); ?></li>
													</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->


			<?php foreach ($videos as $video): ?>
				<div class="col-sm-4">
					<div class="list-group">
						<ul class="list-group-item active">
				            <h3 style="float: left;"><?php echo h($video['Video']['name']); ?></h3>
				            <div class="btn-group" role="group" style="float: right;" aria-label="...">
							<button type="button" class="btn btn-default">
								<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'videos', 'action' => 'view', $video['Video']['id']), array('escape' => false)); ?>
							</button>
							<button type="button" class="btn btn-default">
								<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'videos', 'action' => 'edit', $video['Video']['id']), array('escape' => false)); ?>
							</button>
							<button type="button" class="btn btn-default">
								<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'videos', 'action' => 'delete', $video['Video']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $video['Video']['id'])); ?>
							</button>
							</div>
							<div style="clear: both	;"></div>
				        </ul>
				        <ul class="list-group-item">
				            <img class="img-thumbnail" src="<?php echo $video['Video']['photo']; ?>" width=400 />
				        </ul>
				        <ul class="list-group-item">
							<?php echo $video['Video']['url'] ?>
				        </ul>
						<ul class="list-group-item">
							<b><?php echo __('Ativo'); ?></b>
							<br/>
								<?php
									if($video['Video']['active']=="1")
										echo '<span class="label label-success">Sim <span class="glyphicon glyphicon-ok-circle"></span></span>';
									else
										echo '<span class="label label-danger">Não <span class="glyphicon glyphicon-ban-circle"></span></span>'; ?>
								&nbsp;
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