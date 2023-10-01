<div class="churches form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Editar localização'); ?></h1>
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
								<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Deletar'), array('action' => 'delete', $this->Form->value('Church.id')), array('escape' => false), __('Tem certeza que quer deletar # %s?', $this->Form->value('Church.id'))); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Listar localizações'), array('action' => 'index'), array('escape' => false)); ?></li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Church', array('type'=>'file','role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('label'=>'Nome','class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('text', array('label'=>'Texto','class' => 'form-control', 'placeholder' => 'Text'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('telefone', array('label'=>'Telefone','class' => 'form-control', 'placeholder' => '(xx) xxxxx xxxx'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('categoria', array('label'=>'Categoria','class' => 'form-control'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('subcategoria', array('label'=>'Subcategoria','class' => 'form-control'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('address', array('label'=>'Endereço','class' => 'form-control', 'placeholder' => 'Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('foto', array('type'=>'file','class' => 'form-control', 'placeholder' => 'Foto', 'label' => 'Foto'));?>
					<img src="<?php
						    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						    $charactersLength = strlen($characters);
						    $randomString = '';
						    for ($i = 0; $i < 10; $i++) {
						        $randomString .= $characters[rand(0, $charactersLength - 1)];
						    }

					echo $this->data['Church']['photo']."?".$randomString; ?>" width="100" />
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('lat', array('label'=>'Latitude','class' => 'form-control', 'placeholder' => 'Lat'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('lng', array('label'=>'Longitude','class' => 'form-control', 'placeholder' => 'Lng'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Enviar'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
