<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'admins', 'action' => 'login', 'home'));


	//Admins
	Router::connect('/admins',array('controller'=>'admins','action'=>'index'));
	Router::connect('/admins/:action',array('controller'=>'admins'));
	Router::connect('/admins/:action/*',array('controller'=>'admins'));	
	//Orders Controller
	Router::connect('/categories',array('controller'=>'categories','action'=>'index'));
	Router::connect('/categories/:action',array('controller'=>'categories'));
	Router::connect('/categories/:action/*',array('controller'=>'categories'));	
	//Groups Controller
	Router::connect('/groups',array('controller'=>'groups','action'=>'index'));
	Router::connect('/groups/:action',array('controller'=>'groups'));
	Router::connect('/groups/:action/*',array('controller'=>'groups'));
	//Orders Controller
	Router::connect('/orders',array('controller'=>'orders','action'=>'index'));
	Router::connect('/orders/:action',array('controller'=>'orders'));
	Router::connect('/orders/:action/*',array('controller'=>'orders'));	
	//Orders Controller
	Router::connect('/tax_infos',array('controller'=>'tax_infos','action'=>'index'));
	Router::connect('/tax_infos/:action',array('controller'=>'tax_infos'));
	Router::connect('/tax_infos/:action/*',array('controller'=>'tax_infos'));	
	//Users Controller 
	Router::connect('/users',array('controller'=>'users','action'=>'index'));
	Router::connect('/users/:action',array('controller'=>'users'));
	Router::connect('/users/:action/*',array('controller'=>'users'));
	

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
