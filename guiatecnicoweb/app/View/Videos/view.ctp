<div class="videos view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Vídeo'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Editar Vídeo'), array('action' => 'edit', $video['Video']['id']), array('escape' => false)); ?> </li>
									<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Deletar Vídeo'), array('action' => 'delete', $video['Video']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $video['Video']['id'])); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;Listar Vídeos'), array('action' => 'index'), array('escape' => false)); ?> </li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Novo Vídeo'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->
		<div class="col-sm-9">
			<div class="list-group">
				<ul class="list-group-item active">
		            <h3 style="float: left;"><?php echo h($video['Video']['name']); ?></h3>
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
				<ul class="list-group-item">
					<b><?php echo __('Criado'); ?></b>
					<br/>
						<?php echo h($video['Video']['created']); ?>
						&nbsp;
				</ul>
				<ul class="list-group-item">
					<b><?php echo __('Modificado'); ?></b>
					<br/>
						<?php echo h($video['Video']['modified']); ?>
						&nbsp;
				</ul>
		    </div>
		</div>

	</div>
</div>

