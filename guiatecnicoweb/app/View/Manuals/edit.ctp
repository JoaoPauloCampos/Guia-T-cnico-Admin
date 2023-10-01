<?php 
	echo $this->Html->script('hora.js'); 
?>
<div class="events form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Editar Evento'); ?></h1>
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

								<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Deletar'), array('action' => 'delete', $this->Form->value('Event.id')), array('escape' => false), __('Tem certeza que quer deletar # %s?', $this->Form->value('Event.id'))); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Listar Eventos'), array('action' => 'index'), array('escape' => false)); ?></li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Event', array('type' => 'file','role' => 'form')); ?>
				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('label'=>'Nome do evento','class' => 'form-control', 'placeholder' => 'Nome'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('data', array('class' => 'form-control', 'placeholder' => 'Data', 'type' => 'date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('hora', array('class' => 'form-control', 'placeholder' => 'Hora', 'type' => 'time'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('text', array('label'=>'Descrição','class' => 'form-control', 'placeholder' => 'Text'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('foto', array('label'=>'Foto','type'=>'file','class' => 'form-control', 'placeholder' => 'Foto'));?>
					<img src="<?php
						    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						    $charactersLength = strlen($characters);
						    $randomString = '';
						    for ($i = 0; $i < 10; $i++) {
						        $randomString .= $characters[rand(0, $charactersLength - 1)];
						    }

					echo $this->data['Event']['photo']."?".$randomString; ?>" width="100" />
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Enviar'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
