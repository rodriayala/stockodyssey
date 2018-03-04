<?php
require_once("funciones.php");
error_reporting(0);
if (falta_logueo())
{ 
	header('location:index.php');
	exit();
}

$acc 		= trim($_GET['acc']);
$id_stock  	= trim($_GET['id']);
$mensaje 	= "";

//Muestro lo que voy a modificar o eliminar
if($acc == "M" || $acc == "E")
{ 
	$sqla = "SELECT * FROM `stock_actual` LEFT JOIN cards_scg ON cards_scg.id = stock_actual.id_card where id_stock = '$id_stock' ";
	#echo $sqla; // exit();
	$dba  = conectar();			 
	$ra   = mysqli_query($dba, $sqla);
			
	if($ra == false)
	{
		mysqli_close($dba);
		$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	}
		mysqli_close($dba);	

 	while ($arr = mysqli_fetch_array($ra))		
	{	
		$card_name		= trim($arr['card_name']);
		$card_edition  	= trim($arr['card_edition']);
		$id_card	  	= trim($arr['id_card']);
		$preciocompra 	= trim($arr['precio_compra']);
		$estadocarta  	= trim($arr['estado_carta']);
		$estadoventa  	= trim($arr['estado_venta']);
	}

	$sqlb = " SELECT `card_edition`,id FROM `cards_scg` WHERE card_name like '%$card_name%' ";
	#echo $sqlb; // exit();
	$dbb  = conectar();			 
	$rb   = mysqli_query($dbb, $sqlb);
			
	if($rb == false)
	{
		mysqli_close($dbb);
		$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	}
		mysqli_close($dbb);		
}

if($_POST)
{//SEGUNDOS POST


	if($_POST['BTNMOD'])
	{//si es una modificacion
		$idUsuario 		= trim($_SESSION['id_usuario']);
		$id_card		= trim($_POST['nombreedicion']);//OJO ACA VA EL ID NUEVO DE LA CARTA..
		$preciocompra 	= trim($_POST['preciocompra']);
		$estadocarta	= trim($_POST['estadocarta']);
		$estadoventa	= trim($_POST['estadoventa']);

		$id			 = trim($_GET['id']); //id del stock! oko
		
		$todo_ok = true;
		
		if(strlen($preciocompra)==0)
		{
			$mal_preciocompra 	 = true;
			$todo_ok = false;
		}
		
		if($todo_ok==true)
		{#Si esta todo bien	
	
			$sqla = "UPDATE stock_actual SET id_card = '".$id_card."', precio_compra = '".$preciocompra."', estado_carta = '".$estadocarta."', estado_venta = '".$estadoventa."'	 where id_stock = '$id' ";
			#echo $sqla;  exit();
			$dba  = conecto();
			 
			$ra   = mysqli_query($dba, $sqla);
			
			if($ra == false)
			{
				mysqli_close($dba);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			}
				mysqli_close($dba);		
			
			
			$mensaje = "MODIFICADO";		
		}
	}//Fin si es una modificacion

	if($_POST['BTNELI']){//si ELIMINO
		
		$id = trim($_GET['id']);
		
		$Xtodo_ok = true;
		
		if($Xtodo_ok==true){#Si esta todo bien	
			$db  = conecto();
			$sql = " DELETE FROM stock_actual where id_stock = '".$id."' ";	
				//echo $sql; exit();									
			$r   = mysqli_query($db, $sql);

				if ($r == false){
                        mysqli_close($db);
                        $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
                        //gestion_errores();
                 }
                        mysqli_close($db);
		
				$mensaje = "ELIMINADO";				
								
		}#Fin Si esta todo bien			
	}
		
}#Fin segundos post
?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Odyssey Sistema Total de Administracion</title>

        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="css/bootstrap.css">

        <!-- Related styles of various javascript plugins -->
        <link rel="stylesheet" href="css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="css/main.css">

        <!-- Load a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="js/vendor/modernizr-respond.min.js"></script>
    </head>

    <!-- Add the class .fixed to <body> for a fixed layout on large resolutions (min: 1200px) -->
    <!-- <body class="fixed"> -->
    <body>
        <!-- Page Container -->
        <div id="page-container">
            <!-- Header -->
            <!-- Add the class .navbar-fixed-top or .navbar-fixed-bottom for a fixed header on top or bottom respectively -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-top"> -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-bottom"> -->
            <header class="navbar navbar-inverse">
                <!-- Mobile Navigation, Shows up  on smaller screens -->
                <ul class="navbar-nav-custom pull-right hidden-md hidden-lg">
                    <li class="divider-vertical"></li>
                    <li>
                        <!-- It is set to open and close the main navigation on smaller screens. The class .navbar-main-collapse was added to aside#page-sidebar -->
                        <a href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-main-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
                <!-- END Mobile Navigation -->

                <!-- Logo -->
                <a href="index.html" class="navbar-brand"><img src="img/template/logo.png" alt="logo"></a>

                <!-- Loading Indicator, Used for demostrating how loading of widgets could happen, check main.js - uiDemo() -->
                <div id="loading" class="pull-left"><i class="fa fa-certificate fa-spin"></i></div>

                <!-- Header Widgets -->
                <!-- You can create the widgets you want by replicating the following. Each one exists in a <li> element -->
                <ul id="widgets" class="navbar-nav-custom pull-right">
                    <!-- Just a divider -->
                    <li class="divider-vertical"></li>

                    <!-- RSS Widget -->
                    <!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
                    <li id="rss-widget" class="dropdown dropdown-left-responsive">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-rss"></i>
                            <span class="badge badge-warning display-none"></span>
                        </a>
                        <!-- By adding the class .widget-fluid, dropdown width will be set to auto with min value 180px and max value 250px -->
                        <ul class="dropdown-menu dropdown-menu-right widget widget-fluid">
                            <li class="widget-heading text-center">Web Design</li>
                            <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="fa fa-umbrella"></i>This is a headline</a></li>
                            <li class="divider"></li>
                            <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="fa fa-trophy"></i>Another headline</a></li>
                            <li class="divider"></li>
                            <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="fa fa-suitcase"></i>Headlines keep coming!</a></li>
                            <li class="widget-heading text-center">Web Developent</li>
                            <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="fa fa-phone"></i>New headline</a></li>
                            <li class="divider"></li>
                            <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="fa fa-pencil"></i>Another one</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0)" class="text-center">All News</a></li>
                        </ul>
                    </li>
                    <!-- END RSS Widget -->

                    <li class="divider-vertical"></li>

                    <!-- Twitter Widget -->
                    <!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
                    <li id="twitter-widget" class="dropdown dropdown-left-responsive">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-twitter"></i>
                            <span class="badge badge-info display-none"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right widget">
                            <li class="widget-heading"><i class="fa fa-comments-o pull-right"></i>Latest Tweets</li>
                            <li class="li-hover">
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)">
                                        <img src="img/placeholders/image_dark_64x64.png" alt="fakeimg">
                                    </a>
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="javascript:void(0)">Michael</a><span class="label label-info">just now</span></h6>
                                        <div class="media">Web design all the way!</div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li class="li-hover">
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)">
                                        <img src="img/placeholders/image_dark_64x64.png" alt="fakeimg">
                                    </a>
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="javascript:void(0)">Monica</a><span class="label label-info">3 min ago</span></h6>
                                        <div class="media">Download free PSDs at <a href="http://bit.ly/YUs4SQ" target="_blank">http://bit.ly/YUs4SQ</a></div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li class="li-hover">
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)">
                                        <img src="img/placeholders/image_dark_64x64.png" alt="fakeimg">
                                    </a>
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="javascript:void(0)">Steven</a><span class="label label-info">45 min ago</span></h6>
                                        <div class="media">Be sure to check out my portfolio!</div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li class="li-hover">
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)">
                                        <img src="img/placeholders/image_dark_64x64.png" alt="fakeimg">
                                    </a>
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="javascript:void(0)">Tim</a><span class="label label-info">1 hour ago</span></h6>
                                        <div class="media">Get all our themes for free for the next 2 hours! <a href="javascript:void(0)">#freebies</a></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- END Twitter Widget -->

                    <li class="divider-vertical"></li>

                    <!-- Messages Widget -->
                    <!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
                    <li id="messages-widget" class="dropdown dropdown-left-responsive">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            <!-- If the <span> element with .badge class has no content it will disappear (not in IE8 and below because of using :empty in CSS) -->
                            <span class="badge badge-success">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right widget">
                            <li class="widget-heading"><i class="fa fa-comment pull-right"></i>Latest Messages</li>
                            <li class="new-on">
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)">
                                        <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                    </a>
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="javascript:void(0)">George</a><span class="label label-success">2 min ago</span></h6>
                                        <div class="media">Thanks for your help! The tutorial really helped me a lot!</div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)">
                                        <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                    </a>
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="javascript:void(0)">Mike</a><span class="label label-default">6 hours ago</span></h6>
                                        <div class="media">The logo is ready, have a look and let me know what you think!</div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)">
                                        <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                    </a>
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="javascript:void(0)">Julia</a><span class="label label-default">1 day ago</span></h6>
                                        <div class="media">We should better consider our social media marketing strategy!</div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li class="text-center"><a href="page_inbox.html">View All Messages</a></li>
                        </ul>
                    </li>
                    <!-- END Messages Widget -->

                    <li class="divider-vertical"></li>

                    <!-- Notifications Widget -->
                    <!-- Add .dropdown-center-responsive class to align the dropdown menu center (so its visible on mobile) -->
                    <li id="notifications-widget" class="dropdown dropdown-center-responsive">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag"></i>
                            <span class="badge badge-danger">1</span>
                            <span class="badge badge-warning">2</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right widget">
                            <li class="widget-heading"><a href="javascript:void(0)" class="pull-right widget-link"><i class="fa fa-cog"></i></a><a href="javascript:void(0)" class="widget-link">System</a></li>
                            <li>
                                <ul>
                                    <li class="label label-danger">20 min ago</li>
                                    <li class="text-danger">Support system is down for maintenance!</li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li class="label label-warning">3 hours ago</li>
                                    <li class="text-warning">PHP upgrade started!</li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li class="label label-warning">5 hours ago</li>
                                    <li class="text-warning"><a href="javascript:void(0)" class="widget-link">1 support ticket</a> just opened!</li>
                                </ul>
                            </li>
                            <li class="widget-heading"><a href="javascript:void(0)" class="pull-right widget-link"><i class="fa fa-bookmark"></i></a><a href="javascript:void(0)" class="widget-link">Project #3</a></li>
                            <li>
                                <ul>
                                    <li class="label label-success">3 weeks ago</li>
                                    <li class="text-success">Project #3 <a href="javascript:void(0)" class="widget-link">published</a> successfully!</li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li class="label label-info">1 month ago</li>
                                    <li class="text-info">Milestone #3 achieved!</li>
                                    <li class="text-info"><a href="javascript:void(0)" class="widget-link">John Doe</a> joined the project!</li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li class="label label-default">1 year ago</li>
                                    <li class="text-muted">This is an old notification</li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li class="text-center"><a href="javascript:void(0)">View All Notifications</a></li>
                        </ul>
                    </li>
                    <!-- END Notifications Widget -->

                    <li class="divider-vertical"></li>

                    <!-- User Menu -->
                    <li class="dropdown pull-right dropdown-user">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><img src="img/template/avatar.png" alt="avatar"> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!-- Just a button demostrating how loading of widgets could happen, check main.js- - uiDemo() -->
                            <li>
                                <a href="javascript:void(0)" class="loading-on"><i class="fa fa-refresh"></i> Refresh</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <!-- Modal div is at the bottom of the page before including javascript code -->
                                <a href="#modal-user-settings" role="button" data-toggle="modal"><i class="fa fa-user"></i> User Profile</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fa fa-wrench"></i> App Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="page_login.html"><i class="fa fa-lock"></i> Log out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- END User Menu -->
                </ul>
                <!-- END Header Widgets -->
            </header>
            <!-- END Header -->

            <!-- Inner Container -->
            <div id="inner-container">
				<?php include('sidebar.php'); ?>

                <!-- Page Content -->
                <div id="page-content">
                    <!-- Navigation info -->
    				<ul id="nav-info" class="clearfix">
                        <li><a href="principal.php"><i class="fa fa-home"></i></a></li>
                        <li class="active"><a href="principal.php">Menu Principal</a></li>
                    </ul>
                    <!-- END Navigation info -->

                    <!-- FORMULARIO -->
                    <form action="" method="post" class="form-horizontal form-box">
                        <h4 class="form-box-header"><?php if($acc == "M"){ echo "MODIFICACION"; } if($acc == "E"){ echo "ELIMINACION"; }?>  STOCK CARTAS</h4>

						<input type="text" id="id" name="id" class="form-control"  style="display:none;" value="<?php echo $id; ?>">
 						<div class="form-group">
                        	<label class="control-label col-md-2" for="example-username">Nombre Carta</label>
                            <div class="col-md-7">
                            	<input type="text" id="nombrecarta" name="nombrecarta" class="form-control" autocomplete="off" value="<?php echo $card_name;?>">
                            	<ol id="displayCarta"></ol>
                        	</div>
                                    
                        </div>
                                
                        <div class="form-group">
                        	<label class="control-label col-md-2" for="example-username">Edición Carta</label>
                            <div class="col-md-7">
                            	<select id="nombreedicion" name="nombreedicion" class="form-control" onChange="elegiredicion()">
                                <?php 
								 	while ($arrb = mysqli_fetch_array($rb))		
									{
								?>
                                  	<option value="<?php echo trim($arrb['id']);?>"><?php echo trim($arrb['card_edition']); ?></option>
                                 <?php 
									}
								?>    
                                </select>
                           </div>
                        </div>
                                                       
                        <div class="form-group">
                            <label class="control-label col-md-2" for="val_username">Precio Compra</label>
                        	<div class="col-md-3">
                             	<div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="text" id="preciocompra" name="preciocompra" class="form-control" value="<?php echo $preciocompra; ?>">
                                    </div>
                                </div>
                       </div>
                       
                       <?php
					   	if($mal_preciocompra == true)
						{
						?>
                        <div class="form-group">
                        	<div class="col-md-3">
                             	<div class="alert alert-danger">
                                  <strong>CUIDADO!</strong> Falta el precio AMEO.
                                </div>
                            </div>
                        </div>
						<?php
						}
					   ?>
                       <div class="form-group">
                        	<label class="control-label col-md-2" for="example-username">Estado Carta</label>
                            <div class="col-md-7">
                            	<select id="estadocarta" name="estadocarta" class="form-control" onChange="elegiredicion()">
                            	  <option value="nmm" <?php if($estadocarta=="nmm"){ echo "selected";}?> >NM/M</option>
                            	  <option value="ex" <?php if($estadocarta=="ex"){ echo "selected";}?> >EX</option>
                            	  <option value="gd" <?php if($estadocarta=="gd"){ echo "selected";}?> >GD</option>
                            	  <option value="lp" <?php if($estadocarta=="lp"){ echo "selected";}?> >LP</option>
                            	  <option value="pl" <?php if($estadocarta=="pl"){ echo "selected";}?> >PL</option>
                            	  <option value="poor" <?php if($estadocarta=="poor"){ echo "selected";}?> >POOR</option>
                                </select>
                           </div>
                        </div>
                        
                      	<div class="form-group">
                        	<label class="control-label col-md-2" for="example-username">Estado Venta</label>
                            <div class="col-md-7">
                            	<select id="estadoventa" name="estadoventa" class="form-control" onChange="elegiredicion()">
                            	  <option value="DISPONIBLE" <?php if($estadoventa=="DISPONIBLE"){ echo "selected";}?>>DISPONIBLE</option>
                            	  <option value="RESERVADO" <?php if($estadoventa=="RESERVADO"){ echo "selected";}?>>RESERVADO</option>
                            	  <option value="VENDIDO" <?php if($estadoventa=="VENDIDO"){ echo "selected";}?>>VENDIDO</option>
                                </select>
                           </div>
                        </div> 
                        
                        
 	 					<div class="form-group ">
                        	<div class="col-md-10 col-md-offset-2">
                            	<a href="alta-stock.php"><button formnovalidate type="button" class="btn btn-default">VOLVER AL MENU</button></a>
                                   
								<?php
                                	if($acc == "M")
                                	{ 
                                ?>
                                    <input  name="BTNMOD" type="submit" id="BTNMOD" value=" MODIFICAR " class="btn btn-warning">
                                <?php			
                                    } 
                                    
                                    if($acc == "E")
                                    {
                                ?>	
                                    <input  name="BTNELI" type="submit" id="BTNELI" value=" ELIMINAR " class="btn btn-danger">
                                <?php
                                    }
                                ?>
                        	</div>
                        </div>
                                                                           
                    </form>
                    <!-- END FORMULARIO -->

                </div>
                <!-- END Page Content -->

                <!-- Footer -->
                <footer>
                   2017 &copy; <strong>Odyssey</strong>
                </footer>
                <!-- END Footer -->
            </div>
            <!-- END Inner Container -->
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, check main.js - scrollToTop() -->
        <a href="javascript:void(0)" id="to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- User Modal Settings, appears when clicking on 'User Settings' link found on user dropdown menu (header, top right) -->
        <div id="modal-user-settings" class="modal">
            <!-- Modal Dialog -->
            <div class="modal-dialog">
                <!-- Modal Content -->
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4>Profile Settings</h4>
                    </div>
                    <!-- END Modal Header -->

                    <!-- Modal Content -->
                    <div class="modal-body">
                        <!-- Tab links -->
                        <ul id="example-user-tabs" class="nav nav-tabs" data-toggle="tabs">
                            <li class="active"><a href="#example-user-tabs-account"><i class="fa fa-cogs"></i> Account</a></li>
                            <li><a href="#example-user-tabs-profile"><i class="fa fa-user"></i> Profile</a></li>
                        </ul>
                        <!-- END Tab links -->

                        <!-- END Tab Content -->
                        <div class="tab-content">
                            <!-- First Tab -->
                            <div class="tab-pane active" id="example-user-tabs-account">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Success!</strong> Password changed!
                                </div>
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Username</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">administrator</p>
                                            <span class="help-block">You can't change your username!</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-pass">Password</label>
                                        <div class="col-md-9">
                                            <input type="password" id="example-user-pass" name="example-user-pass" class="form-control">
                                            <span class="help-block">if you want to change your password enter your current for confirmation!</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-newpass">New Password</label>
                                        <div class="col-md-9">
                                            <input type="password" id="example-user-newpass" name="example-user-newpass" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- END First Tab -->

                            <!-- Second Tab -->
                            <div class="tab-pane" id="example-user-tabs-profile">
                                <h4 class="page-header-sub">Image</h4>
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <img src="img/placeholders/image_dark_120x120.png" alt="image" class="img-responsive push">
                                        </div>
                                        <div class="col-md-9">
                                            <form action="index.html" class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form class="form-horizontal">
                                    <h4 class="page-header-sub">Details</h4>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-firstname">Firstname</label>
                                        <div class="col-md-9">
                                            <input type="text" id="example-user-firstname" name="example-user-firstname" class="form-control" value="John">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-lastname">Lastname</label>
                                        <div class="col-md-9">
                                            <input type="text" id="example-user-lastname" name="example-user-lastname" class="form-control" value="Doe">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-gender">Gender</label>
                                        <div class="col-md-9">
                                            <select id="example-user-gender" name="example-user-gender" class="form-control">
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-bio">Bio</label>
                                        <div class="col-md-9">
                                            <textarea id="example-user-bio" name="example-user-bio" class="form-control textarea-elastic" rows="3">Bio Information..</textarea>
                                        </div>
                                    </div>
                                    <h5 class="page-header-sub">Social</h5>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-fb">Facebook</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" id="example-user-fb" name="example-user-fb" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-facebook fa-fw"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-twitter">Twitter</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" id="example-user-twitter" name="example-user-twitter" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-twitter fa-fw"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-pinterest">Pinterest</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" id="example-user-pinterest" name="example-user-pinterest" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-pinterest fa-fw"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-github">Github</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" id="example-user-github" name="example-user-github" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-github fa-fw"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- END Second Tab -->
                        </div>
                        <!-- END Tab Content -->
                    </div>
                    <!-- END Modal Content -->

                    <!-- Modal footer -->
                    <div class="modal-footer remove-margin">
                        <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button class="btn btn-success"><i class="fa fa-spinner fa-spin"></i> Save changes</button>
                    </div>
                    <!-- END Modal footer -->
                </div>
                <!-- END Modal Content -->
            </div>
            <!-- END Modal Dialog -->
        </div>
        <!-- END User Modal Settings -->

        <!-- Excanvas for canvas support on IE8 -->
        <!--[if lte IE 8]><script src="js/helpers/excanvas.min.js"></script><![endif]-->

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="js/vendor/jquery-1.11.1.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js -->
        <script src="js/vendor/bootstrap.min.js"></script>

        <!-- Jquery plugins and custom javascript code -->
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- ckeditor.js, load it only in the page you would like to use CKEditor (it's a heavy plugin to include it with the others!) -->
        <script src="js/ckeditor/ckeditor.js"></script>
        <script src="js/sweetalert2.all.js"></script>
        <script>

		var mensaje = "<?php echo $mensaje; ?>";
		
		if(mensaje=="MODIFICADO")
		{
			swal('FELICITACIONES!!','Registro Modificado','success');	
		}

		if(mensaje=="ELIMINADO")
		{
			swal('FELICITACIONES!!','Registro Eliminado','success');	
		}		


		function fillCarta(Value)
		{ 
			$('#nombrecarta').val(Value);
			$('#displayCarta').hide();
			
			var nombrecarta = $('#nombrecarta').val();
			
			var toLoad= 'consultoedicionparastock.php?nombrecarta=' + nombrecarta;
			//alert(toLoad);
			$.post(toLoad,function (responseText){
		 
				$('#nombreedicion').html(responseText);
				$('#nombreedicion').change();
			});
			
			$("#prodNombre").text(nombrecarta);
		}
		
		
		$(function () {//Ready

			var typingTimer; 
			var doneTypingInterval = 500;  //time in ms, 5 second for example
			var $input = $('#nombrecarta');
			
			$input.on('keyup', function () {
			  clearTimeout(typingTimer);
			  typingTimer = setTimeout(doneTyping, doneTypingInterval);
			});
			
			$input.on('keydown', function () {
			  clearTimeout(typingTimer);
			});
			
			function doneTyping () {

				var nombrecarta = $('#nombrecarta').val();
				
				if( nombrecarta.length > 2 )  
				{ 
					var nombrecarta = $('#nombrecarta').val();
					$.ajax({
						type: "POST",
						url: "consultocartaaltastock.php",
						data: "nombrecarta="+ nombrecarta ,
						success: function(html){
							$("#displayCarta").html(html).show();
						}
					});
				 }	 			  
			}
								
		});				
		</script>        
    </body>
</html>