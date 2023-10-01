<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/guiatecnicoweb">Guia Técnico</a>
    </div>

    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        
        <!--li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Localização
            <b class="caret"></b>
          </a>
            <ul class="dropdown-menu">
              <li>
                <a href="<?php echo $this->Html->url('/churches'); ?>">I</a>
              </li>
              <li>
                <a href="<?php echo $this->Html->url('/categories'); ?>">Categorias</a>
              </li>
            </ul>
        </li-->
        <li >
          <a href="<?php echo $this->Html->url('/categorias'); ?>">Categoria</a>
        </li>       
        <li>
          <a href="<?php echo $this->Html->url('/manuals'); ?>">Manual</a>
        </li>
        <li>
          <a href="<?php echo $this->Html->url('/marcas'); ?>">Marca</a>
        </li>
        <li >
          <a href="<?php echo $this->Html->url('/tipoManuals'); ?>">Tipo Manual</a>
        </li>
        
        
        <!--li>
          <a href="<?php echo $this->Html->url('/photos'); ?>">Fotos</a>
        </li>
        <li>
          <a href="<?php echo $this->Html->url('/videos'); ?>">Vídeos</a>
        </li>
        <li>
          <a href="<?php echo $this->Html->url('/phones'); ?>">Telefones</a>
        </li>
        <li>
          <a href="<?php echo $this->Html->url('/users'); ?>">Usuários</a>
        </li>
        <li>
          <a href="<?php echo $this->Html->url('/settings/edit/1'); ?>">Configuração</a>
        </li>
        < <li>
          <a href="<?php echo $this->Html->url('/devices'); ?>">Devices</a>
        </li> -->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php echo AuthComponent::user('username'); ?> 
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li><?php echo $this->Html->link('Sair', array('controller' => 'users', 'action' => 'logout')) ?></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>

