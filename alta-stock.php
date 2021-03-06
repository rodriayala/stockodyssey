<?php
require_once("funciones.php");
require_once("clases/ventas.class.php");
error_reporting(0);
if (falta_logueo())
{ 
	header('location:index.php');
	exit();
}

$mensaje = " ";

$sqla = "SELECT * FROM `stock_actual` LEFT JOIN cards_scg ON cards_scg.id = stock_actual.id_card order by id_stock DESC LIMIT 30 ";
#echo $sqla; // exit();
$dba  = conectar();
 
$ra   = mysqli_query($dba, $sqla);

if($ra == false)
{
	mysqli_close($dba);
    echo $error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
}
    mysqli_close($dba);
	
if($_POST)
{//SEGUNDOS POST

	if($_POST['BTNALTA'])
	{//si creo un nuevo 	
		$idUsuario 		= trim($_SESSION['id_usuario']);
		$id_card		= trim($_POST['nombreedicion']);
		$preciocompra 	= trim($_POST['preciocompra']);
		$estadocarta	= trim($_POST['estadocarta']);
		$estadoventa	= trim($_POST['estadoventa']);
		$fecha_alta     = date('Y-m-d');
		
		$todo_ok = true;
		
		if(strlen($preciocompra)==0)
		{
			$mal_preciocompra = true;
			$todo_ok = false;
		}
		
		if($todo_ok == true)
		{#Si esta todo bien	
	
			$sqla =  "INSERT INTO `stock_actual`(id_usuario_carga, `id_card`, `precio_compra`, `estado_carta`, `estado_venta`, fecha_alta) VALUES 
			('$idUsuario','$id_card','$preciocompra','$estadocarta','$estadoventa', '$fecha_alta')";
			#echo $sqla;  exit();
			$dba  = conectar();			 
			$ra   = mysqli_query($dba, $sqla);
			
			$ultimoID = mysqli_insert_id($dba);

			if($ra == false)
			{
				mysqli_close($dba);
				$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
			}else{#Si guardo bien
				mysqli_close($dba);		
			
				$mensaje = "ALTA";
				 
				if(($estadoventa=="RESERVADO")||($estadoventa=="VENDIDO"))
				{
					$venta = new ventas;
					$ventas->ventasCartas($ultimoID, $estadoventa, $estadoventa, $id_cliente);	
				}
			}//Fin si guardo bien
		}
	}//fin creo un nuevo
}
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
        
        <!-- select -->
        <link href="css/bootstrap-select.css" rel="stylesheet" >
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
                    <form action="" method="post" class="form-horizontal form-box" id="formu">
                    <h4 class="form-box-header">STOCK</h4>
 					
                    <div class="form-box-content">	
 						<div class="form-group">
                        	<label class="control-label col-md-2" for="example-username">Nombre Carta</label>
                            <div class="col-md-7">
                            	<input type="text" id="nombrecarta" name="nombrecarta" class="form-control" autocomplete="off">
                            	<ol id="displayCarta"></ol>
                        	</div>
                             <div class="col-md-1" id="loadingName" style="display:none;">
                             	<i class="fa fa-spinner fa-spin fa-2x"></i>
                             </div>       
                        </div>
                                
                        <div class="form-group">
                        	<label class="control-label col-md-2" for="example-username">Edición Carta</label>
                            <div class="col-md-7">
								<input id="nombreedicion" name="nombreedicion" value=" " style="display:none" type="text">
                                
								<div class="desplegableSeleccion form-control" id="desplegableEdicion">
                                    <span class="dtitulo" id="seleccionEdicion" ><span class="ddlabel" >SELECCIONE</span></span>
                                    <div id="flechaDesplegable" onClick="muestroEdicionFlecha()"></div>
                                </div>                                
                                
                                <div id="desplegableChild" class="desplegableChild" style="display:none;"></div>
                           </div>
                           <div class="col-md-1" id="loadingEdicion" style="display:none;">
                             	<i class="fa fa-spinner fa-spin fa-2x"></i>
                             </div>
                        </div>
                                                       
                        <div class="form-group">
                            <label class="control-label col-md-2" for="val_username">Precio Compra</label>
                        	<div class="col-md-3">
                             	<div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="text" id="preciocompra" name="preciocompra" class="form-control">
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
                            	  <option value="nmm">NM/M</option>
                            	  <option value="ex">EX</option>
                            	  <option value="gd">GD</option>
                            	  <option value="lp">LP</option>
                            	  <option value="pl">PL</option>
                            	  <option value="poor">POOR</option>
                                </select>
                           </div>
                        </div>
                        
                      	<div class="form-group">
                        	<label class="control-label col-md-2" for="example-username">Estado Venta</label>
                            <div class="col-md-7">
                            	<select id="estadoventa" name="estadoventa" class="form-control" onChange="elegiredicion()">
                            	  <option value="DISPONIBLE">DISPONIBLE</option>
                            	  <!--<option value="RESERVADO">RESERVADO</option>
                            	  <option value="VENDIDO">VENDIDO</option>-->
                                </select>
                           </div>
                        </div> 
                      
						<div class="form-group form-actions">
                        	<div class="col-md-10 col-md-offset-2">
                                    <input type="submit" id="BTNALTA" name="BTNALTA" class="btn btn-success" value="GUARDAR">
                            </div>
                        </div> 
                        </div>                        
                    </form>
                    <!-- END FORMULARIO -->
                    
                    
                    

					<table id="example-datatables" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Edición</th>
                                <th><i class="fa fa-bolt"></i> Precio compra</th>
                                <th>Estado Carta</th>
                                <th>Estado Venta</th>
                              <th class="cell-small">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
							while ($arr = mysqli_fetch_array($ra))		
							{	 
							
						?>
                            <tr>
                                <td ><a href="javascript:void(0)"><?php $nombre = $arr['card_name']; 
										if (mb_detect_encoding($nombre, 'utf-8', true) === false)
										{
											echo $nombre = mb_convert_encoding($nombre, 'utf-8', 'iso-8859-1');
										}else{
											echo $nombre = $arr['card_name'];
										}
										?></a></td>
                                <td><a href="javascript:void(0)"><?php $edicion = $arr['card_edition']; 
										if (mb_detect_encoding($edicion, 'utf-8', true) === false)
										{
											echo $edicion = mb_convert_encoding($edicion, 'utf-8', 'iso-8859-1');
										}else{
											echo $edicion = $arr['card_edition'];
										}
										?></a></td>
                                <td><?php echo $precio_compra = trim($arr['precio_compra']); ?></td>
                                <td><?php echo $estado_carta = trim($arr['estado_carta']); ?></td>
                                <td><?php echo $estado_venta = trim($arr['estado_venta']); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                    	<a href="mod-stock.php?acc=M&id=<?php echo $arr['id_stock']; ?>" data-toggle="tooltip" title="Modificar" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <a href="mod-stock.php?acc=E&id=<?php echo $arr['id_stock']; ?>" data-toggle="tooltip" title="Borrar" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                			}
              			?>   
                      </tbody>
                    </table>
                    					
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
        <script src="js/vendor/jquery-2.1.3.min.js"></script>
        
        <!-- Bootstrap.js -->
        <script src="js/vendor/bootstrap.min.js"></script>

        <!-- Jquery plugins and custom javascript code -->
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- ckeditor.js, load it only in the page you would like to use CKEditor (it's a heavy plugin to include it with the others!) -->
        <script src="js/ckeditor/ckeditor.js"></script>
        
        <script src="js/sweetalert2.all.js"></script>
        <!-- Javascript code only for this page -->
        
        <script src="js/bootstrap-select.js"></script>
        <script>




		function muestroEdicionFlecha()
		{
			var desplegableChild = document.getElementById('desplegableChild');
			
			if (desplegableChild.style.display === 'none')
			{
				desplegableChild.style.display = 'block';
			} else {
				desplegableChild.style.display = 'none';
			}
				
		}
		
		function opcionEdicion(idEdicion)
		{
			var desple = document.getElementById('desplegableChild');

			if (desplegableChild.style.display === 'none')
			{
				desplegableChild.style.display = 'block';
			} else {
				desplegableChild.style.display = 'none';
			}
			
			var veoImagenEdicion = "desp" + idEdicion;
			var ruta = $('#'+veoImagenEdicion+' img').attr('src');
			var texto = $('#'+veoImagenEdicion).html();
			//<img src="'+ruta+'" width="42px">
			document.getElementById("desplegableEdicion").innerHTML = '<span class="resulEdicion">'+texto+'</span><div id="flechaDesplegable" onClick="muestroEdicionFlecha()"></div>';
			
			$('#nombreedicion').val(idEdicion);
		}

		var mensaje = "<?php echo $mensaje; ?>";
		
		if(mensaje=="ALTA")
		{
			swal('FELICITACIONES!!','Registro dado de alta','success');	
			document.location.href = 'alta-stock.php';
			
		/*swal({ 
		  title: "FELICITACIONES",
		   text: "Registro dado de alta",
			type: "success" 
		  },
		  function(){
		   document.location.href = 'alta-stock.php';
		});*/
		}

		function fillCarta(Value)
		{ 
			var loadingEdicion = document.getElementById("loadingEdicion");			
			loadingEdicion.style.display = "block";
					
			$('#nombrecarta').val(Value);
			$('#displayCarta').hide();
			
					
			var nombrecarta = $('#nombrecarta').val();
			
			var toLoad= 'consultoedicionparastock.php?nombrecarta=' + nombrecarta;

			$.post(toLoad,function (responseText)
			{
		 		loadingEdicion.style.display = "none";
				$('#desplegableChild').html(responseText);
				$('#desplegableChild').change();	
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
				
					var loadingName = document.getElementById("loadingName");		
					loadingName.style.display = "block";
								
					var nombrecarta = $('#nombrecarta').val();
					$.ajax({
						type: "POST",
						url: "consultocartaaltastock.php",
						data: "nombrecarta="+ nombrecarta ,
						success: function(html){
							$("#displayCarta").html(html).show();
							loadingName.style.display = "none";
						}
					});
					
				 }	 			  
			}
				
			$("#seleccionEdicion").click(function()
			{
				var desple = document.getElementById('desplegableChild');
				
				if(desple.style.display = 'none')
				{
					desple.style.display = 'block';	
				}
				/*else{
					desple.style.display = 'none';	
				}*/
						
			});
						
		});				
		</script>
    </body>
</html>