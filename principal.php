<?php
require_once("funciones.php");
error_reporting(0);
if (falta_logueo())
{ 
	header('location:index.php');
	exit();
}


	/* CANTIDAD DE PRODUCTOS VENDIDOS */	
	$sql_cantiProdVen = "select count(*) as cantiProdVen from stock_actual WHERE estado_venta LIKE 'vendido'";
	#echo $sql_cantiProdVen; // exit();
	$db_cantiProdVen  = conectar();
	 
	$r_cantiProdVen   = mysqli_query($db_cantiProdVen, $sql_cantiProdVen);
	
	if($r_cantiProdVen == false)
	{
		mysqli_close($db_cantiProdVen);
		$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	}
		mysqli_close($db_cantiProdVen);
	
	$arrx_cantiProdVen = mysqli_fetch_array($r_cantiProdVen);
	$cantiProdVen = $arrx_cantiProdVen['cantiProdVen'];
	#echo 'canti:'.$cantiProdVen;
	/*FIN CANTIDAD DE PRODUCTOS VENDIDOS */	

	/* CANTIDAD DE PRODUCTOS CARGADOS */	
	$sql_totalProdCargados = "select count(*) as totalProdCargados from stock_actual";
	#echo $sql_cantiProdVen; // exit();
	$db_totalProdCargados  = conectar();
	 
	$r_totalProdCargados   = mysqli_query($db_totalProdCargados, $sql_totalProdCargados);
	
	if($r_totalProdCargados == false)
	{
		mysqli_close($db_totalProdCargados);
		$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	}
		mysqli_close($db_totalProdCargados);
	
	$arrx_totalProdCargados = mysqli_fetch_array($r_totalProdCargados);
	$totalProdCargados = $arrx_totalProdCargados['totalProdCargados'];
	#echo 'canti:'.$totalProdCargados;
	/*FIN CANTIDAD DE PRODUCTOS CARGADOS */	
		

	/* CANTIDAD DE DINERO INVERTIDO */	
	$sql_totalDinInv = " SELECT SUM(precio_compra) as total FROM stock_actual ";
	#echo $sql_cantiProdVen; // exit();
	$db_totalDinInv  = conectar();
	 
	$r_totalDinInv   = mysqli_query($db_totalDinInv, $sql_totalDinInv);
	
	if($r_totalDinInv == false)
	{
		mysqli_close($db_totalDinInv);
		$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	}
		mysqli_close($db_totalDinInv);
	
	$arrx_totalDinInv = mysqli_fetch_array($r_totalDinInv);
	$totalDinInv = $arrx_totalDinInv['total'];
	#echo 'canti:'.$totalDinInv;
	/*FIN CANTIDAD DE DINERO INVERTIDO */	
		
	$totalDinRec = 0;
	

	/* CANTIDAD DE DINERO GANADO */	
	$sql_totalDinRec = " SELECT total FROM ( SELECT SUM(CASE WHEN precio_venta >0 THEN (precio_venta-precio_compra) ELSE 0 END) total from `stock_actual` ) as a ";
	#echo $sql_cantiProdVen; // exit();
	$db_totalDinRec  = conectar();
	 
	$r_totalDinRec   = mysqli_query($db_totalDinRec, $sql_totalDinRec);
	
	if($r_totalDinRec == false)
	{
		mysqli_close($db_totalDinRec);
		$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	}
		mysqli_close($db_totalDinRec);
	
	$arrx_totalDinRec = mysqli_fetch_array($r_totalDinRec);
	$totalDinRec = $arrx_totalDinRec['total'];
	#echo 'canti:'.$totalDinInv;
	/*FIN CANTIDAD DE DINERO GANADO */
		
	$cantiUsers = 0;


	/* CANTIDAD DE CLIENTES 	
	$sql_cantiUsers = " select count(*) as canti from clientes";
	#echo $sql_cantiProdVen; // exit();
	$db_cantiUsers  = conectar();
	 
	$r_cantiUsers   = mysqli_query($db_cantiUsers, $sql_cantiUsers);
	
	if($r_cantiUsers == false)
	{
		mysqli_close($db_cantiUsers);
		$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	}
		mysqli_close($db_cantiUsers);
	
	$arrx_cantiUsers = mysqli_fetch_array($r_cantiUsers);
	$cantiUsers = $arrx_cantiUsers['canti'];
	#echo 'canti:'.$cantiUsers;
	/*FIN CANTIDAD DE CLIENTES */	
	
	
	/*----------------------------------------------*/
	/*-----------------LISTADOS---------------------*/
	

	/* LISTADO DE PEDIDOS */
	$sql_listaPedidos = " SELECT * FROM `stock_actual` LEFT JOIN usuarios ON usuarios.id_usuario = stock_actual.id_usuario_venta LEFT JOIN cards_scg ON cards_scg.id = stock_actual.id_card WHERE `estado_venta` != 'DISPONIBLE' order by `fecha_venta` DESC ";
	#echo $sql_cantiProdVen; // exit();
	$db_listaPedidos  = conectar();
	 
	$r_listaPedidos   = mysqli_query($db_listaPedidos, $sql_listaPedidos);
	
	if($r_listaPedidos == false)
	{
		mysqli_close($db_listaPedidos);
		$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	}
		mysqli_close($db_listaPedidos);
	
	#echo 'canti:'.$cantiUsers;
	/*FIN LISTADO DE PEDIDOS */		
?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
		<title>Odyssey Sistema Total de Administracion</title>

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
                <!-- Sidebar -->
                <?php include('sidebar.php'); ?>
                <!-- END Sidebar -->

                <!-- Page Content -->
                <div id="page-content">
                    <!-- Navigation info -->
                    <ul id="nav-info" class="clearfix">
                        <li><a href="principal.php"><i class="fa fa-home"></i></a></li>
                        <li class="active"><a href="principal.php">Menu Principal</a></li>
                    </ul>
                    <!-- END Navigation info -->
					
                    <div id="mensajeventa" ></div>
                    
					<!-- formulario venta-->  
					<form id="basic-wizard" action="" method="post" class="form-horizontal form-box">
                    
                        <!-- Form Header -->
                        <h4 class="form-box-header"><i class="fa fa-magic"></i> Venta</h4>

                        <!-- Form Content -->
                        <div class="form-box-content">

                            <!-- First Step -->
                            <div id="first" class="step">
                                <!-- Step Info -->
                                <div class="wizard-steps row">
                                    <div class="col-md-4 text-center active">1. Producto</div>
                                    <div class="col-md-4 text-center">2. Cliente</div>
                                </div>
                                <!-- END Step Info -->                               
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-username">Nombre Carta</label>
                                    <div class="col-md-7">
                                        <input type="text" id="nombrecarta" name="nombrecarta" class="form-control" autocomplete="off">
                                        <ol id="displayCarta"></ol>
                                    </div>
                                    
                            	</div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-username">Edición Carta</label>
                                    <div class="col-md-7">
                                        <select id="nombreedicion" name="nombreedicion" class="form-control" onChange="elegiredicion()">
                                        	<option value="default">Seleccione</option>
                                    	</select>
                                    </div>
                            	</div>
 
                               <div class="form-group">
                                    <label class="control-label col-md-2" for="example-input-grid1">Precio Venta ($AR)</label>
                                    <div class="col-md-1">
                                        <input type="text" id="preciocarta" name="preciocarta" class="form-control">
                                    </div>
                               </div>
                                                           
                            </div>
                            <!-- END First Step -->

                            <!-- Second Step -->
                            <div id="second" class="step">
                                <!-- Step Info -->
                                <div class="wizard-steps row">
                                    <div class="col-md-4 text-center">1. Producto</div>
                                    <div class="col-md-4 text-center active">2. Cliente</div>
                                </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Producto</label>
                                <div class="col-md-3">
                                    <p class="form-control-static"><code id="prodNombre"></code></p>
                                </div>
                                <div class="col-md-7">
                                    <p class="form-control-static"><code id="prodDesc"></code></p>
                                </div>
                            </div>
                            
						
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">Nuevo Cliente</label>
                                    <div class="col-md-10">
                                        <label class="switch switch-danger"><input type="checkbox" id="chknuevocli"><span></span></label>
                                    </div>
                                </div>
                                
                                <div id="buscocli">
                                    <div class="form-group">
                                        <div id="datoscli">
                                            <label class="control-label col-md-2" for="example-lastname">Apellido,Nombre Cliente</label>
                                            <div class="col-md-4">
                                                <input type="text" id="apeynom" name="apeynom" class="form-control" autocomplete="off">
                                                
                                                <ol id="displayApellido"></ol>
                                                <input type="text" id="idapellido" name="idapellido" style="display:none">
                                                <input type="text" id="idcliente" name="idcliente" style="display:none" value="0">
                                                <br><br>

                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                                          
                                <!-- nuevo cli -->
                                <div id="nuevocli" style="display:none">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-firstname">Apellidos Cliente</label>
                                    <div class="col-md-3">
                                        <input type="text" id="apellidos" name="apellidos" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-lastname">Nombre Cliente</label>
                                    <div class="col-md-3">
                                        <input type="text" id="nombres" name="nombres" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-address">Lugar Compra</label>
                                    <div class="col-md-3">
                                        <select id="lugarcompra" name="lugarcompra" class="form-control">
                                          <option value="Facebook">Facebook</option>
                                          <option value="Mercado Libre">Mercado Libre</option>
                                          <option value="Carpeta">Carpeta</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-city">Estado</label>
                                    <div class="col-md-3">
                                        <select id="estadocompra" name="estadocompra" class="form-control">
                                          <option value="Reservado">Reservado</option>
                                          <option value="Comprado">Comprado</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-city">Cobro</label>
                                    <div class="col-md-3">
                                        <select id="cobro" name="cobro" class="form-control">
                                          <option value="De Palabra">De Palabra</option>
                                          <option value="Reservado">Reservado</option>
                                          <option value="Pagado">Págado</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-city">Entrega</label>
                                    <div class="col-md-3">
                                        <select id="entrega" name="entrega" class="form-control">
                                          <option value="No">No</option>
                                          <option value="Si">Si</option>
                                          <option value="Correo">En el Correo</option>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="example-textarea-large">Comentarios</label>
                                    <div class="col-md-10">
                                        <textarea id="comentarios" name="comentarios" class="form-control" rows="10"></textarea>
                                    </div>
                            	</div>
                                                                                            
                            	</div>
                                <!-- nuevo cli -->
                            </div>
                            

                            <!-- Form Buttons -->
                            <div class="form-group form-actions">
                                <div class="col-md-10 col-md-offset-2">
                                    <input type="reset" class="btn btn-danger" id="Volver" value="Volver">
                                    <input type="submit" class="btn btn-success" id="Guardar" value="Guardar">
                                </div>
                            </div>
                            <!-- END Form Buttons -->
                        </div>
                        <!-- END Form Content -->
                    </form>            
					<!-- fin formulario venta -->
                    <!-- Tiles -->
                    <!-- Row 1 -->
                    <div class="dash-tiles row">
                        <!-- Column 1 of Row 1 -->
                        <div class="col-sm-3">
                            
                            <!-- Total Productos Vendidos Tile -->
                            <div class="dash-tile dash-tile-balloon clearfix animation-pullDown">
                                <div class="dash-tile-header">
                                    <div class="dash-tile-options">
                                        <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Manage subscribers"><i class="fa fa-cog"></i></a>
                                    </div>
                                    Total Productos Vendidos
                                </div>
                                <div class="dash-tile-icon"><i class="fa fa-shopping-cart"></i></div>
                                <div class="dash-tile-text"><?php echo $cantiProdVen ; ?></div>
                            </div>
                            <!-- END Total Productos Vendidos Tile -->
                            

                            <!-- Total Profit Tile -->
                            <div class="dash-tile dash-tile-leaf clearfix animation-pullDown">
                                <div class="dash-tile-header">
                                    <span class="dash-tile-options">
                                        <a href="javascript:void(0)" class="btn btn-default" data-toggle="popover" data-placement="top" data-content="$500 (230 Sales)" title="Today's profit"><i class="fa fa-credit-card"></i></a>
                                    </span>
                                    Total Clientes
                                </div>
                                <div class="dash-tile-icon"><i class="fa fa-users"></i></div>
                                <div class="dash-tile-text"><?php echo $cantiUsers; ?></div>
                            </div>
                            <!-- END Total Profit Tile -->
                        </div>
                        <!-- END Column 1 of Row 1 -->

                        <!-- Column 2 of Row 1 -->
                        <div class="col-sm-3">
                            
                            <!-- Total Users Tile -->
                            <div class="dash-tile dash-tile-ocean clearfix animation-pullDown">
                                <div class="dash-tile-header">
                                    <div class="dash-tile-options">
                                        <div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Manage Users"><i class="fa fa-cog"></i></a>
                                        </div>
                                    </div>
                                    Total Productos Cargados
                                </div>
                                <div class="dash-tile-icon"><i class="fa fa-hdd-o"></i></div>
                                <div class="dash-tile-text"><?php echo $totalProdCargados; ?></div>
                            </div>
                            <!-- END Total Users Tile -->

                           
                        </div>
                        <!-- END Column 2 of Row 1 -->

                        <!-- Column 3 of Row 1 -->
                        <div class="col-sm-3">
                         <!-- Total Downloads Tile -->
                            <div class="dash-tile dash-tile-fruit clearfix animation-pullDown">
                                <div class="dash-tile-header">
                                    <div class="dash-tile-options">
                                        <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="View popular downloads"><i class="fa fa-asterisk"></i></a>
                                    </div>
                                    Total Dinero Invertido
                                </div>
                                <div class="dash-tile-icon"><i class="fa fa-money"></i></div>
                                <div class="dash-tile-text"><?php echo $totalDinInv ;?></div>
                            </div>
                            <!-- END Total Downloads Tile -->
                        
                        </div>
                        <!-- END Column 3 of Row 1 -->

                        <!-- Column 4 of Row 1 -->
                        <div class="col-sm-3">
                        
                        <!-- Popularity Tile -->
                            <div class="dash-tile dash-tile-oil clearfix animation-pullDown">
                                <div class="dash-tile-header">
                                    <div class="dash-tile-options">
                                        <div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Share"><i class="fa fa-share-square-o"></i></a>
                                        </div>
                                    </div>
                                    Total Dinero Recaudado
                                </div>
                                <div class="dash-tile-icon"><i class="fa fa-money"></i></div>
                                <div class="dash-tile-text"><?php echo $totalDinRec; ?></div>
                            </div>
                            <!-- END Popularity Tile -->
                            
                        </div>
                        <!-- END Column 4 of Row 1 -->
                    </div>
                    <!-- END Row 1 -->


                    <!-- Row 3 -->
                    <div class="row">
                        <!-- Column 1 of Row 3 -->
                        <div class="col-sm-6">
                            <!-- Datatables Tile -->
                            <div class="dash-tile dash-tile-2x">
                                <div class="dash-tile-header">
                                    <div class="dash-tile-options">
                                        <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Manage Orders"><i class="fa fa-cogs"></i></a>
                                    </div>
                                    <i class="fa fa-shopping-cart"></i> Nuevos Pedidos
                                </div>
                                <div class="dash-tile-content">
                                    <div class="dash-tile-content-inner-fluid">
                                        <table id="dash-example-orders" class="table table-striped table-bordered table-condensed">
                                            <thead>
                                                <tr>
                                                    <th class="hidden-xs hidden-sm hidden-md">#</th>
                                                     <th><i class="fa fa-shopping-cart"></i> Número</th>
                                                    <th><i class="fa fa-shopping-cart"></i> Producto</th>                                                   
                                                    <th class="hidden-xs hidden-sm hidden-md"><i class="fa fa-user"></i> Usuario Venta</th>
                                                    <th><i class="fa fa-bolt"></i> Status</th>
                                                    <th class="cell-small"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
												$i=0;
                                            	while ($arr_listaPedidos = mysqli_fetch_array($r_listaPedidos))		
                                                {	 
                                            ?>       
                                                <tr>
                                                    <td class="hidden-xs hidden-sm hidden-md"><?php echo $i; ?></td>
                                                    <td><a href="javascript:void(0)"><?php echo trim($arr_listaPedidos['id_stock']); ?></a></td>
                                                    <td><a href="javascript:void(0)"><?php echo trim($arr_listaPedidos['card_name']); ?></a></td>
                                                    <td class="hidden-xs hidden-sm hidden-md"><a href="javascript:void(0)"><?php echo trim($arr_listaPedidos['nombre_usuario']); ?></a></td>
                                                    <td><?php
                                                    		if(trim($arr_listaPedidos['estado_venta'])=="RESERVADO") 
															{
														?>
															<span class="label label-warning">RESERVADO</span>
                                                        <?php
															}
														 ?> 
                                                    	<?php
                                                    		if(trim($arr_listaPedidos['estado_venta'])=="VENDIDO") 
															{
														?>
															<span class="label label-danger">VENDIDO</span></td>
                                                        <?php
															}
														 ?>    
                                                    </td>              
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="javascript:void(0)" data-toggle="tooltip" title="Process" class="btn btn-xs btn-primary"><i class="fa fa-book"></i></a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip" title="Cancel" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                             <?php
											 	$i++;
												}
											 ?>   
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END Datatables Tile -->
                        </div>
                    </div>
                    <!-- END Row 3 -->
                    <!-- END Tiles -->
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

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) 
        <script src="js/vendor/jquery-1.11.1.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>-->
		<script src="js/vendor/jquery-2.1.1.min.js"></script>
       
        <script src="js/sweetalert2.all.js"></script>
        <!-- Bootstrap.js -->
        <script src="js/vendor/bootstrap.min.js"></script>

        <!-- Jquery plugins and custom javascript code -->
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Javascript code only for this page -->
        <script>

		function fillCarta(Value)
		{
			$('#nombrecarta').val(Value);
			$('#displayCarta').hide();
			
			var nombrecarta = $('#nombrecarta').val();
			
			var toLoad= 'consultoedicion.php?nombrecarta=' + nombrecarta;
			//alert(toLoad);
			$.post(toLoad,function (responseText){
		 
				$('#nombreedicion').html(responseText);
				$('#nombreedicion').change();
			});
			
			$("#prodNombre").text(nombrecarta);
		}


		function elegiredicion()
		{
			//var edicion = document.getElementById("nombreedicion").value;
			//alert(edicion);
			//alert('You like ' + event.target.value + ' ice cream.');
			//$("#prodDesc").text(edicion);
		}

	
		function fillApellido(Value,Value2)
		{
			$('#apeynom').val(Value);
			$('#idapellido').val(Value2);
			$('#displayApellido').hide();
			
			var ape = $('#apeynom').val();
			
			var toLoad= 'consultoapellido.php?ape=' + ape;
			//alert(toLoad);
			$.post(toLoad,function (responseText)
			{
				$('#apeynom').html(responseText);
				$('#apeynom').change();
				
				var idapellido = $('#idapellido').val();
				recargoCliente(idapellido);
			});
				
		}
		
		function recargoCliente(idapellido)
		{
			var buscocli = document.getElementById("buscocli");
			//alert (buscocli);
			var nuevocli = document.getElementById("nuevocli");
			nuevocli.style.display = "block";
			buscocli.style.display = "none";
			
			var idapellido = $('#idapellido').val();
			
			var toLoad= 'consultonuevocliente.php?idapellido=' + idapellido;
		
			$.post(toLoad,function (responseText)
			{
				$('#nuevocli').html(responseText);
				$('#nuevocli').change();
				
			});			
		}
		
            $(function () {

				 $("#chknuevocli").click(function() {  
						if($("#chknuevocli").is(':checked')) {  
							//Si se apaga, buscocli on 
							var buscocli = document.getElementById("buscocli");
							var nuevocli = document.getElementById("nuevocli");
							
							if (buscocli.style.display === "none") {
								buscocli.style.display = "block";
								nuevocli.style.display = "none";
							} else {
								buscocli.style.display = "none";
								nuevocli.style.display = "block";
							}							 
						}
						
						if(!$("#chknuevocli").is(':checked')) {  
							//Si se apaga, nuevocli on 
							var buscocli = document.getElementById("buscocli");
							var nuevocli = document.getElementById("nuevocli");
							
							if (nuevocli.style.display === "none") {
								buscocli.style.display = "none";
								nuevocli.style.display = "block";
							} else {
								buscocli.style.display = "block";
								nuevocli.style.display = "none";
							}												 
						}  
					}); 

   
		
 				$('input#nombrecarta').keyup( function() {
					   if( this.value.length > 2 ) 
					   {
						   var nombrecarta = $('#nombrecarta').val();
							$.ajax({
								type: "POST",
								url: "consultocarta.php",
								data: "nombrecarta="+ nombrecarta ,
								success: function(html){
									$("#displayCarta").html(html).show();
								}
							});
					   }
				});		


 				$('input#apeynom').keyup( function() {
					   if( this.value.length > 2 ) 
					   {
						   var ape = $('#apeynom').val();
						   $.ajax({
								type: "POST",
								url: "consultoapellido.php?ape="+ ape,
								success: function(html){
									$("#displayApellido").html(html).show();
								}
							});
							
					   }
				});	

				 $.validator.addMethod("valueNotEquals", function(value, element, arg){
				  return arg !== value;
				 }, "Seleccione un valor.");
 
                /* Initialize Basic Wizard */
                $('#basic-wizard').formwizard({
					disableUIStyles: true,
                    formPluginEnabled: true,
                    validationEnabled: true,
                    validationOptions: {
                        errorClass: 'help-block',
                        errorElement: 'span',
                        errorPlacement: function (error, e) {
                            e.parents('.form-group > div').append(error);
                        },
                        highlight: function (e) {
                            $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                            $(e).closest('.help-block').remove();
                        },
                        success: function (e) {
                            // You can use the following if you would like to highlight with green color the input after successful validation!
                            e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
                            e.closest('.help-block').remove();
                            e.closest('.help-inline').remove();
                        },
                        rules: {
                            nombrecarta : {
                                required: true,
                                minlength: 2
                            },
							
                            nombreedicion: {
                                 valueNotEquals: "default" 
                            },
							
							preciocarta : {
                                required: true,
                                minlength: 1
                            }
                        },
                        messages: {
                            nombrecarta: 'Seleccione el nombre de la carta',
                            valueNotEquals: "Seleccione un valor",
							preciocarta : "Ingrese un valor a la carta"
                        }
                    },
                    formOptions: {
                        success: function (data) {
                            // On success status returned
							
                        },
                        beforeSubmit: function (data) { 
							//Envio la info
                            //alert('Form Submitted!');
							
							var apellidos 	= $('#apellidos').val();
							var nombres 	= $('#nombres').val();
							var comentarios = $('#comentarios').val();
							
							
							var lugarcompra = document.getElementById("lugarcompra");
							var valorlugarcompra = lugarcompra.options[lugarcompra .selectedIndex].value; 	

							var estadocompra = document.getElementById("estadocompra");
							var valorestadocompra = estadocompra.options[estadocompra .selectedIndex].value; 
							
							var entrega = document.getElementById("entrega");
							var valorentrega = entrega.options[entrega .selectedIndex].value; 
							
							var cobro = document.getElementById("cobro");
							var valorcobro = cobro.options[cobro .selectedIndex].value; 
							
							var nombreedicion = document.getElementById("nombreedicion");
							var id_stock = nombreedicion.options[nombreedicion .selectedIndex].value;
							
							var preciocarta = $('#preciocarta').val();
							var idcliente = $('#idcliente').val();
							
							
							var toLoad = 'insertocompra.php?apellidos=' + apellidos	+'&nombres=' + nombres
							+'&comentarios=' + comentarios +'&lugarcompra=' + valorlugarcompra
							+'&estadocompra=' + valorestadocompra +'&cobro=' + valorcobro
							+'&entrega=' + valorentrega +'&preciocarta=' + preciocarta
							+'&id_stock=' + id_stock +'&idcliente=' + idcliente;
							
							//alert(toLoad);
							$.post(toLoad,function (responseText)
							{
								//alert(responseText);
								//$('#mensajeventa').html(responseText);
								//$('#mensajeventa').change();
								swal('WOW!!',responseText,'success');
								
							});
							
							
							//Recargo la pagina
							location.reload();
														
							//Fin Envio la info
							
                        },
                        dataType: 'json',
                        resetForm: true
                    },
                    inAnimation: {height: 'show'},
                    outAnimation: {height: 'hide'}
                					
					
                });
										
                // Initialize dash Datatables
                $('#dash-example-orders').dataTable({
                    columnDefs: [{orderable: false, targets: [0]}],
                    pageLength: 6,
                    lengthMenu: [[6, 10, 30, -1], [6, 10, 30, "All"]]
                });
                $('.dataTables_filter input').attr('placeholder', 'Search');

                // Dash example stats
                var dashChart = $('#dash-example-stats');

                var dashChartData1 = [
                    [0, 200],
                    [1, 250],
                    [2, 360],
                    [3, 584],
                    [4, 1250],
                    [5, 1100],
                    [6, 1500],
                    [7, 1521],
                    [8, 1600],
                    [9, 1658],
                    [10, 1623],
                    [11, 1900],
                    [12, 2100],
                    [13, 1700],
                    [14, 1620],
                    [15, 1820],
                    [16, 1950],
                    [17, 2220],
                    [18, 1951],
                    [19, 2152],
                    [20, 2300],
                    [21, 2325],
                    [22, 2200],
                    [23, 2156],
                    [24, 2350],
                    [25, 2420],
                    [26, 2480],
                    [27, 2320],
                    [28, 2380],
                    [29, 2520],
                    [30, 2590]
                ];
                var dashChartData2 = [
                    [0, 50],
                    [1, 180],
                    [2, 200],
                    [3, 350],
                    [4, 700],
                    [5, 650],
                    [6, 700],
                    [7, 780],
                    [8, 820],
                    [9, 880],
                    [10, 1200],
                    [11, 1250],
                    [12, 1500],
                    [13, 1195],
                    [14, 1300],
                    [15, 1350],
                    [16, 1460],
                    [17, 1680],
                    [18, 1368],
                    [19, 1589],
                    [20, 1780],
                    [21, 2100],
                    [22, 1962],
                    [23, 1952],
                    [24, 2110],
                    [25, 2260],
                    [26, 2298],
                    [27, 1985],
                    [28, 2252],
                    [29, 2300],
                    [30, 2450]
                ];

                // Initialize Chart
                $.plot(dashChart, [
                    {data: dashChartData1, lines: {show: true, fill: true, fillColor: {colors: [{opacity: 0.05}, {opacity: 0.05}]}}, points: {show: true}, label: 'All Visits'},
                    {data: dashChartData2, lines: {show: true, fill: true, fillColor: {colors: [{opacity: 0.05}, {opacity: 0.05}]}}, points: {show: true}, label: 'Unique Visits'}],
                    {
                        legend: {
                            position: 'nw',
                            backgroundColor: '#f6f6f6',
                            backgroundOpacity: 0.8
                        },
                        colors: ['#555555', '#db4a39'],
                        grid: {
                            borderColor: '#cccccc',
                            color: '#999999',
                            labelMargin: 5,
                            hoverable: true,
                            clickable: true
                        },
                        yaxis: {
                            ticks: 5
                        },
                        xaxis: {
                            tickSize: 2
                        }
                    }
                );

                // Create and bind tooltip
                var previousPoint = null;
                dashChart.bind("plothover", function (event, pos, item) {

                    if (item) {
                        if (previousPoint !== item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0],
                                y = item.datapoint[1];

                            $('<div id="tooltip" class="chart-tooltip"><strong>' + y + '</strong> visits</div>')
                                .css({top: item.pageY - 30, left: item.pageX + 5})
                                .appendTo("body")
                                .show();
                        }
                    }
                    else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            });
        </script>
    </body>
</html>