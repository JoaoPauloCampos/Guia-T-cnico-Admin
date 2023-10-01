<div class="photos view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Foto'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Editar Foto'), array('action' => 'edit', $photo['Photo']['id']), array('escape' => false)); ?> </li>
									<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Deletar Foto'), array('action' => 'delete', $photo['Photo']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $photo['Photo']['id'])); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Nova Foto'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->


	<div class="col-sm-9">
		<div class="list-group">
			<ul class="list-group-item">
				<img class="img-thumbnail" src="<?php echo h($photo['Photo']['photo']); ?>" width=400 />
				&nbsp;
			</ul>
			<ul class="list-group-item">
				<b><?php echo __('Álbum'); ?></b>
				<br/>
				<?php echo $this->Html->link($photo['Gallery']['name'], array('controller' => 'galleries', 'action' => 'view', $photo['Gallery']['id'])); ?>
			</ul>
			<ul class="list-group-item">
				<b><?php echo __('Criada'); ?></b>
				<br/>
				<?php echo h($photo['Photo']['created']); ?>
				&nbsp;
			</ul>
			<ul class="list-group-item">
				<b><?php echo __('Modificada'); ?></b>
				<br/>
					<?php echo h($photo['Photo']['modified']); ?>
					&nbsp;
			</ul>
		</div>
	</div><!-- end col md 9 -->

	</div>
</div>

