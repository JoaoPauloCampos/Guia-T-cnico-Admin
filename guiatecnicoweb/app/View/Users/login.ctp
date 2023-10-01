<div class="container">
<div class="container">
	
	<?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'login',
													'class' => 'form-signin', 
													 'inputDefaults' => array(
													        'label' => false,
													    ))); ?>
		<h2 class="form-signin-heading">Painel Administrativo</h2>
		<?php echo $this->Session->flash(); ?>

		<?php echo $this->Form->input('username', array ('class' => 'form-control' , 'placeholder' => 'Email', 'required autofocus') );	?>
		<?php echo $this->Form->input('password', array ('class' => 'form-control' , 'placeholder' => 'Password')) ;?>
				
	
		<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
	<?php echo $this->Form->end(); ?>
</div> 
