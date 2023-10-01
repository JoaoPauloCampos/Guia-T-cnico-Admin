<?php 
	echo $this->Html->script('hora.js'); 
?>
<div class="manuals form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Adicionar Manual'); ?></h1>
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

								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Listar '), array('action' => 'index'), array('escape' => false)); ?></li>
														</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Manual', array('type'=>'file','role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('titulo', array('label'=>'Título','class' => 'form-control', 'placeholder' => 'Título'));?>
				</div>

				<div class="form-group">
					<?php echo $this->Form->input('marca', array('label'=>'Marca','class' => 'form-control', 'placeholder' => 'Marca'));?>
				</div>

				<div class="form-group">
					<?php echo $this->Form->input('modelo', array('label'=>'Modelo','class' => 'form-control', 'placeholder' => 'Modelo'));?>
				</div>

				<div class="form-group">
					<?php echo $this->Form->input('url', array('label'=>'URL','class' => 'form-control', 'placeholder' => 'URL'));?>
				</div>
				
				<div class="form-group">
					<?php echo $this->Form->input('tipoManual', array('label'=>'Tipo Manual','class' => 'form-control'));?>
				</div>			
				<div class="form-group">
					<?php echo $this->Form->input('categoria', array('label'=>'Categoria','class' => 'form-control'));?>
				</div>				
				
				<div class="form-group">
					<?php echo $this->Form->submit(__('Enviar'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
