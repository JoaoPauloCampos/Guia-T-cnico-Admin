<?php 
	echo $this->Html->script('jscolor/jscolor.js'); 
?>
<div class="settings form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Configuração'); ?></h1>
			</div>
		</div>
	</div>

	<?php
		$SIZE_LIMIT = CONSUMO_MAXIMO; 
	    $disk_used = foldersize("../../");

	    $disk_remaining = $SIZE_LIMIT - $disk_used;

	    if ($disk_remaining < 0) {
	    	$disk_remaining = 0;
	    }
	?>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Espaço', 'Em MB'],
          ['Usado',  <?php echo $disk_used; ?>],
          ['Disponível',  <?php echo $disk_remaining; ?>]
        ]);

        var options = {
          title: 'Uso de espaço em disco',
  		  colors: [ '#BB0000','#008400']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>



	<div class="row">
		
		<div class="col-md-9">

			<?php

			    echo('Espaço contratado: ' . format_size($SIZE_LIMIT) . '<br>');
			    echo('Espaço usado: ' . format_size($disk_used) . '<br>');
			    echo( 'Espaço restante: ' . format_size($disk_remaining) . '<br>');
			    echo ('<div id="piechart" style="width: 400px; height: 200px;"></div><hr>');
			    	
			?>

          	<a href="<?php echo $this->Html->url('/patrocinators'); ?>">Ver patrocinadores</a>
			<?php echo $this->Form->create('Setting', array('type' => 'file','role' => 'form')); ?>
				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('geral_color', array('label'=>'Cor principal','class' => 'form-control color', 'placeholder' => 'Cor principal'));?>
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
					<?php echo $this->Form->input('googleplus_url', array('class' => 'form-control', 'placeholder' => 'Instagram Url'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('instagram_url', array('class' => 'form-control', 'placeholder' => 'Google Plus Url'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('youtube_url', array('class' => 'form-control', 'placeholder' => 'Youtube Url'));?>

				</div>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Nome da empresa', 'label' => 'Nome da empresa'));?>

				</div>
				<div class="form-group">
					<?php echo $this->Form->input('tipo_patrocinador', array('class' => 'form-control','label' => 'Tipo Patrocinador','options' => array(0 => 'Imagem', 1 => 'Lista'),'default' => '1'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('foto', array('label'=>'Foto logo empresa','type'=>'file','class' => 'form-control', 'placeholder' => 'Foto'));?>
					<img src="<?php
						    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						    $charactersLength = strlen($characters);
						    $randomString = '';
						    for ($i = 0; $i < 10; $i++) {
						        $randomString .= $characters[rand(0, $charactersLength - 1)];
						    }

					echo $this->data['Setting']['photo']."?".$randomString; ?>" width="100" />
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Salvar'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
