<?php
/**
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
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
//set variables here
if (!isset($username)) {
	$username = 'You are not logged in.';
} 

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Restaurantaide</title>	

		<?php 
		echo $this->fetch('meta');
		//echo $this->fetch('css');
		echo $this->Html->css(array(
			// 'bootstrap/bootstrap', 
			// 'bootstrap/bootstrap-responsive', 
			// 'admin/black', 
			// 'admin/style', 
			// 'js/admin/plugins/jBreadcrumbs/css/BreadCrumb', //breadcrumbs
			// 'js/admin/plugins/qtip2/jquery.qtip.min', //tooltips
			// 'js/admin/plugins/colorbox/colorbox', //lightbox
			// 'js/admin/plugins/google-code-prettify/prettify', //code prettifier
			// 'js/admin/plugins/sticky/sticky', //notifications
			// 'js/admin/plugins/splashy/splashy', //splashy icons **NO SUCH FILE**
			// 'js/admin/plugins/fullcalendar/fullcalendar_gebo', //calendar
			// 'js/admin/plugins/datepicker/datepicker', //datepicker
			// 'js/admin/plugins/jquery.treeview/jquery.treeview.css'
			
		));
		
		//compressed all of the files above to reduce http requests for development.
		echo $this->Html->css(array(
			'compressed_development', 
		));
		echo $this->fetch('css');
		?>
		
		<!-- John's CSS for test Admin functions -->
		
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />

		<!--[if lte IE 8]>
		<link rel="stylesheet" href="css/ie.css" />
		<script src="js/ie/html5.js"></script>
		<script src="js/ie/respond.min.js"></script>
		<script src="lib/flot/excanvas.min.js"></script>
		<![endif]-->

		<script>
			// hide all elements & show preloader
			document.documentElement.className += 'js';
		</script>
	</head>
	<body>
		<div id="loading_layer" style="display:none"><img src="/img/admin/ajax_loader.gif" alt="" />
		</div>

		<div id="maincontainer" class="clearfix">
			<!-- header -->
			<header>
				<div class="navbar navbar-fixed-top">
					<div class="navbar-inner">
						<div class="container-fluid">
							<a class="brand" href="/admins"><i class="icon-home icon-white"></i>Poja</a>
							<ul class="nav user_menu pull-right">
								<li class="hidden-phone hidden-tablet">
									<div class="nb_boxes clearfix"></div>
								</li>
								<li class="divider-vertical hidden-phone hidden-tablet"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle nav_condensed" data-toggle="dropdown"><i class="flag-gb"></i> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li>
											<a href="javascript:void(0)"><i class="flag-de"></i> Deutsch</a>
										</li>
										<li>
											<a href="javascript:void(0)"><i class="flag-fr"></i> Français</a>
										</li>
										<li>
											<a href="javascript:void(0)"><i class="flag-es"></i> Español</a>
										</li>
										<li>
											<a href="javascript:void(0)"><i class="flag-ru"></i> Pусский</a>
										</li>
									</ul>
								</li>
								<li class="divider-vertical hidden-phone hidden-tablet"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/img/admin/user-avatar.png" alt="" class="user_avatar" /> <?php echo $username;?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li>
											<a href="user_profile.html">My Profile</a>
										</li>
										<li>
											<a href="javascrip:void(0)">Another action</a>
										</li>
										<li class="divider"></li>
										<li>
											<a href="/admins/logout">Log Out</a>
										</li>
									</ul>
								</li>
							</ul>
							<a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu"> <span class="icon-align-justify icon-white"></span> </a>

						</div>
					</div>
				</div>

			</header>

			<!-- main content -->
			<div id="contentwrapper">
				<div class="main_content">
					<?php echo $this -> fetch('content'); ?>

				</div>
			</div>

			<!-- sidebar -->
			<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
			<div class="sidebar">
				<div class="antiScroll">
					<div class="antiscroll-inner">
						<div class="antiscroll-content">
							<div class="sidebar_inner">
								<form action="search_page.html" class="input-append" method="post" >
									<input autocomplete="off" name="query" class="search_query input-medium" size="16" type="text" placeholder="Search..." />
									<button type="submit" class="btn">
										<i class="icon-search"></i>
									</button>
								</form>
								<div id="side_accordion" class="accordion">
								<?php
								//creates the admin navigation and selects the page
								if(isset($admin_nav)){
									//set the collapsing id for the view
									$collapse_id = 0;
									//loop the values and create the necessary variables
									foreach ($admin_nav as $key => $value) {
										$mainHeader = $key;
										$name = $admin_nav[$mainHeader]['name'];
										$url = str_replace('/index','',$admin_nav[$mainHeader]['url']);
										$icon = $admin_nav[$mainHeader]['icon'];
										$collapse_id = $collapse_id+1;
										if($admin_check == $name){
											$firstClass = 'accordion-toggle';
											$secondClass = 'accordion-body in collapse';
											//debug($admin_nav[$mainHeader]['next']);
										} else {
											$firstClass = 'accordion-toggle collapsed';
											$secondClass = 'accordion-body collapse';
											//debug($admin_nav[$mainHeader]['next']);
										}
										?>
										<div class="accordion-group">
											<div class="accordion-heading">
												<a href="#collapse-<?php echo $collapse_id;?>" data-parent="#side_accordion" data-toggle="collapse" class="<?php echo $firstClass;?>"> <i class="<?php echo $icon;?>"></i> <?php echo $name;?></a>
											</div>
											<div class="<?php echo $secondClass;?>" id="collapse-<?php echo $collapse_id;?>">
												<div class="accordion-inner">
													<ul class="nav nav-list">
													<?php
													if($admin_nav[$mainHeader]['next'] != 'empty'){
														foreach ($admin_nav[$mainHeader]['next'] as $key=>$value) {
															$name = $admin_nav[$mainHeader]['next'][$key]['name'];
															$url = $admin_nav[$mainHeader]['next'][$key]['url'];
															$icon = $admin_nav[$mainHeader]['next'][$key]['icon'];
															if(isset($admin_pages)){
																if($url == $admin_pages){
																	$selected = 'active';	
																} else {
																	$selected = 'notactive';
																}
															} else {
																$selected = 'notactive';
															}
															switch ($url) {
																case 'Sub Header':
																?>
																<li class="nav-header"><i class="<?php $icon;?>"></i><?php echo $name;?></li>
																<?php								
																break;
																case 'Line Break';
																?>
																<li class="divider"></li>
																<?php
																break;
																default:
																//enter in the $url variable for production
																?>
																<li class="<?php echo $selected;?>"><a href="<?php echo str_replace('/index','',$url);?>"><i class="<?php $icon;?>"></i><?php echo $name;?></a></li>
																<?php
																break;
															}
														}
													}
													?>
													</ul>
												</div>
											</div>
										</div>		
										<?php
									}
								}
								?>
							</div>
							<div class="push"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
 echo $this -> Html -> script(array(//a lot of this is more than we need, but I will optimize later JFD 10/9
	'admin/jquery.min.js', //jQuery
	'bootstrap/bootstrap.js', //main Bootstrap JS
	'bootstrap/bootstrap.plugins.js', //Bootstrap Plugins
	'admin/jquery.debouncedresize.min.js', //smart resize event
	'admin/jquery.actual.min.js', //hidden elements
	'admin/jquery.cookie.min.js', //js cookie plugin
	'admin/plugins/qtip2/jquery.qtip.min.js', //tooltips
	'admin/plugins/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js', //breadcrumbs
	'admin/plugins/colorbox/jquery.colorbox.min.js', //lightbox
	'admin/ios-orientationchange-fix.js', //fix for iOS orientation, needed for responsiveness
	'admin/plugins/antiscroll/antiscroll.js', 
	'admin/plugins/antiscroll/jquery-mousewheel.js', //JS scrollbar. ideally I would not like to use this but it is here in case.
	'admin/plugins/UItoTop/jquery.ui.totop.min.js', //"to top of screen" function
	'admin/plugins/jquery-ui/jquery-ui-1.8.23.custom.min.js', //Custom jQuery UI
	'admin/plugins/forms/jquery.ui.touch-punch.min.js', //touch events for jQ UI
	'admin/jquery.imagesloaded.min.js', 'admin/jquery.wookmark.js', //multi-column layout
	'admin/jquery.mediaTable.min.js', //responsive table
	'admin/jquery.peity.min.js', //small charts
	'admin/plugins/flot/jquery.flot.min.js', 'admin/plugins/flot/jquery.flot.resize.min.js', 'admin/plugins/flot/jquery.flot.pie.min.js', //charts
	'admin/plugins/fullcalendar/fullcalendar.min.js', //calendar
	'admin/plugins/list_js/list.min.js', 'admin/plugins/list_js/plugins/paging/list.paging.js', //sortable/filterable list
	'admin/plugins/tiny_mce/jquery.tinymce.js', //tinymce and the file uploader
	'admin/plugins/datepicker/bootstrap-datepicker.min.js',
	'admin/plugins/stepy/js/jquery.stepy.min.js', 
	'admin/dashboard.js', //global JS functions	
	'admin/forms.js', //global JS functions
	'admin/common.js' //global JS functions
	));	
	
	echo $this->fetch('script');
 ?>

		<script>
			$(document).ready(function() {
				//* show all elements & remove preloader
				setTimeout('$("html").removeClass("js")', 250);
			});
		</script>

		</div>
		<?php //echo $this->element('sql_dump'); ?>
	</body>
</html>