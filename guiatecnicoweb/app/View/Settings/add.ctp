<div class="settings form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Adicionar configuração'); ?></h1>
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

								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Listar Settings'), array('action' => 'index'), array('escape' => false)); ?></li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			
			<?php echo $this->Form->create('Setting', array('role' => 'form')); ?>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('photo', array('class' => 'form-control', 'placeholder' => 'Photo'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('photo_dir', array('class' => 'form-control', 'placeholder' => 'Photo Dir'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('geral_color', array('class' => 'form-control', 'placeholder' => 'Geral Color'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('email_contato', array('class' => 'form-control', 'placeholder' => 'Email Contato'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('facebook_url', array('class' => 'form-control', 'placeholder' => 'Facebook Url'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('twitter_url', array('class' => 'form-control', 'placeholder' => 'Twitter Url'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Enviar'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
