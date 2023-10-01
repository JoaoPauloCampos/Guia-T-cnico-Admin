<div class="row well">
    <div class="col-xs-8">
        <?php
        echo $this->Form->create(
                null, array('inputDefaults' => array(
                'div' => 'form-group',
                'wrapInput' => false,
                'class' => 'form-control'
            ),
            'type' => 'file',
            'url' => array('action' => 'upload') + $this->request->params['pass'])
        );
       
        echo $this->Form->file('Upload.upload', array('id' => 'file'));
        echo $this->Form->button('<i class="icon-upload"></i> ' . __('Upload'), array('class' => 'btn btn-s btn-primary', 'style' => 'margin-top: 15px;'));
        echo $this->Form->end();
        ?>
    </div>
</div>