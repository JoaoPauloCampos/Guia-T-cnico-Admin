<?php
	
	Router::parseExtensions();

	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

	Router::connect('/api/:object/:command', array(
	         'controller' => 'api',
	         'action' => 'delegate'
	       ), array(
	         'pass' => array(
	'object',
	'command' )
	));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
