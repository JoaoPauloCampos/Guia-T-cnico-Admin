<div class="settings index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Configurações'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
						<th><?php echo $this->Paginator->sort('geral_color', 'Cor Principal'); ?></th>
						<th><?php echo $this->Paginator->sort('email_contato'); ?></th>
						<th><?php echo $this->Paginator->sort('facebook_url'); ?></th>
						<th><?php echo $this->Paginator->sort('twitter_url'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($settings as $setting): ?>
					<tr>
						<td><?php echo h($setting['Setting']['name']); ?>&nbsp;</td>
						<td><?php echo h($setting['Setting']['geral_color']); ?>&nbsp;</td>
						<td><?php echo h($setting['Setting']['email_contato']); ?>&nbsp;</td>
						<td><?php echo h($setting['Setting']['facebook_url']); ?>&nbsp;</td>
						<td><?php echo h($setting['Setting']['twitter_url']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $setting['Setting']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $setting['Setting']['id']), array('escape' => false)); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>


			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination pagination-sm">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->