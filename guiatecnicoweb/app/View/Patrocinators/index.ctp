<div class="patrocinators index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Patrocinadores'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Novo Patrocinador'), array('action' => 'add'), array('escape' => false)); ?></li>
								
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->



		<?php foreach ($patrocinators as $patrocinator): ?>
			<div class="col-sm-9" style="width:25%;">
				<div class="list-group">
					<ul class="list-group-item active">
							<h2 style="float: left; font-size:20px; margin:0 0 5px 0;"><?php echo h($patrocinator['Patrocinator']['name']); ?></h2>
							<div class="btn-group" role="group" style="float: right;" aria-label="...">
							<button type="button" class="btn btn-default">
								<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $patrocinator['Patrocinator']['id']), array('escape' => false)); ?>
							</button>
							<button type="button" class="btn btn-default">
								<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $patrocinator['Patrocinator']['id']), array('escape' => false)); ?>
							</button>
							<button type="button" class="btn btn-default">
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove icon-white"></span>', array('action' => 'delete', $patrocinator['Patrocinator']['id']), array('escape' => false), __('Tem certeza que quer deletar # %s?', $patrocinator['Patrocinator']['id'])); ?>
							</button>
							</div>
							<div style="clear: both	;"></div>
					</ul>
					<ul class="list-group-item">
						<img class="img-thumbnail" src="<?php echo $patrocinator['Patrocinator']['photo']; ?>" width=400 />
						&nbsp;
					</ul>
					<ul class="list-group-item">
						<b><?php echo __('Descrição'); ?></b>
						<br/>
							<?php echo h($patrocinator['Patrocinator']['text']); ?>
							&nbsp;
					</ul>
					<tr>
					<ul class="list-group-item">
						<b><?php echo __('Ativa'); ?></b>
						<br/>
							<?php
								if($patrocinator['Patrocinator']['active']=="1")
									echo '<span class="label label-success">Sim <span class="glyphicon glyphicon-ok-circle"></span></span>';
								else
									echo '<span class="label label-danger">Não <span class="glyphicon glyphicon-ban-circle"></span></span>'; ?>
							&nbsp;
					</ul>
					<ul class="list-group-item">
						<b><?php echo __('Criada'); ?></b>
						<br/>
						<?php echo h($patrocinator['Patrocinator']['created']); ?>
						&nbsp;
					</ul>
					<ul class="list-group-item">
						<b><?php echo __('Modificada'); ?></b>
						<br/>
							<?php echo h($patrocinator['Patrocinator']['modified']); ?>
							&nbsp;
					</ul>
				</div>
			</div><!-- end col md 9 -->
		<?php endforeach; ?>	

	</div><!-- end row -->


</div><!-- end containing of content -->