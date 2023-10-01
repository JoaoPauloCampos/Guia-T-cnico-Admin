<div class="container">
<div class="container">
	<?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'recover',
													'class' => 'form-signin', 
													 'inputDefaults' => array(
													        'label' => false,
													    ))); ?>
	<?php if(isset($message)){ ?>

		<?php echo $this->Session->flash(); ?>
		<h2 class="form-signin-heading"><?php echo $message; ?></h2>

	<?php }else{?>
		<h2 class="form-signin-heading">Recuperar Senha</h2>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Form->input('id', array ('type'=>'hidden', 'value'=>$user['User']['id'])) ;?>
		<?php echo $this->Form->input('password', array ('class' => 'form-control' , 'placeholder' => 'Senha', 'required autofocus')) ;?>
		<?php echo $this->Form->input('confirm', array ('type'=>'password','class' => 'form-control' , 'placeholder' => 'Confirmar Senha') );	?>
		<br/>
				
	
		<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
	<?php echo $this->Form->end(); ?>
	<?php } ?>
</div> 
