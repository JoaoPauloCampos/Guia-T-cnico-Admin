<div class="galleries view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Álbum'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Editar Álbum'), array('action' => 'edit', $gallery['Gallery']['id']), array('escape' => false)); ?> </li>
									<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Deletar Álbum'), array('action' => 'delete', $gallery['Gallery']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $gallery['Gallery']['id'])); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;Listar Álbuns'), array('action' => 'index'), array('escape' => false)); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Novo Álbum'), array('action' => 'add'), array('escape' => false)); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Nova Foto'), array('controller' => 'photos', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

	<div class="col-sm-9">
		<div class="list-group">
			<ul class="list-group-item active">
					<?php echo h($gallery['Gallery']['name']); ?>
			</ul>
			<ul class="list-group-item">
				<img class="img-thumbnail" src="<?php echo $gallery['Gallery']['photo']; ?>" width=400 />
				&nbsp;
			</ul>
			<ul class="list-group-item">
				<b><?php echo __('Descrição'); ?></b>
				<br/>
					<?php echo h($gallery['Gallery']['text']); ?>
					&nbsp;
			</ul>
			<tr>
			<ul class="list-group-item">
				<b><?php echo __('Ativa'); ?></b>
				<br/>
					<?php
						if($gallery['Gallery']['active']=="1")
							echo '<span class="label label-success">Sim <span class="glyphicon glyphicon-ok-circle"></span></span>';
						else
							echo '<span class="label label-danger">Não <span class="glyphicon glyphicon-ban-circle"></span></span>'; ?>
					&nbsp;
			</ul>
			<ul class="list-group-item">
				<b><?php echo __('Criada'); ?></b>
				<br/>
				<?php echo h($gallery['Gallery']['created']); ?>
				&nbsp;
			</ul>
			<ul class="list-group-item">
				<b><?php echo __('Modificada'); ?></b>
				<br/>
					<?php echo h($gallery['Gallery']['modified']); ?>
					&nbsp;
			</ul>
		</div>
	</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row">
	<div class="col-md-12">
		
	</div>
</div>
<div class="page-header">
     <h3><?php echo __('Fotos'); ?></h3>
		<div class="actions">
			<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Nova Foto'), array('controller' => 'photos', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
		</div>
 </div>

<div class="row">
	<?php if (!empty($gallery['Photo'])): ?>
		<?php foreach ($gallery['Photo'] as $photo): ?>
			<div class="col-sm-4">
				<div class="panel panel-primary">
			        <div class="panel-heading">
			            <h3 class="panel-title"><?php echo __('Foto'); ?></h3>
			        </div>
			        <div class="panel-body">
			            <img class="img-thumbnail" src="<?php echo $photo['photo']; ?>" width=400 />

						<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'photos', 'action' => 'view', $photo['id']), array('escape' => false)); ?>
						<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'photos', 'action' => 'edit', $photo['id']), array('escape' => false)); ?>
						<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'photos', 'action' => 'delete', $photo['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $photo['id'])); ?>
			        </div>
			    </div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
