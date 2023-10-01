<div class="galleries view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Patrocinador'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Editar Álbum'), array('action' => 'edit', $gallery['Patrocinator']['id']), array('escape' => false)); ?> </li>
									<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Deletar Álbum'), array('action' => 'delete', $gallery['Patrocinator']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $gallery['Gallery']['id'])); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;Listar Patrocinadores'), array('action' => 'index'), array('escape' => false)); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Novo Patrocinador'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

	<div class="col-sm-9">
		<div class="list-group">
			<ul class="list-group-item active">
					<?php echo h($patrocinator['Patrocinator']['name']); ?>
			</ul>
			<ul class="list-group-item">
				<img class="img-thumbnail" src="<?php echo $patrocinator['Patrocinator']['photo']; ?>" width=400 />
				&nbsp;
			</ul>
			<ul class="list-group-item">
				<b><?php echo __('Descrição'); ?></b>
				<br/>
					<?php echo h($patrocintor['Patrocinator']['text']); ?>
					&nbsp;
			</ul>
			<tr>
			<ul class="list-group-item">
				<b><?php echo __('Ativa'); ?></b>
				<br/>
					<?php
						if($gallery['Patrocinator']['active']=="1")
							echo '<span class="label label-success">Sim <span class="glyphicon glyphicon-ok-circle"></span></span>';
						else
							echo '<span class="label label-danger">Não <span class="glyphicon glyphicon-ban-circle"></span></span>'; ?>
					&nbsp;
			</ul>
			<ul class="list-group-item">
				<b><?php echo __('Criada'); ?></b>
				<br/>
				<?php echo h($gallery['Patrocinator']['created']); ?>
				&nbsp;
			</ul>
			<ul class="list-group-item">
				<b><?php echo __('Modificada'); ?></b>
				<br/>
					<?php echo h($gallery['Patrocinator']['modified']); ?>
					&nbsp;
			</ul>
		</div>
	</div><!-- end col md 9 -->

	</div>
</div>
