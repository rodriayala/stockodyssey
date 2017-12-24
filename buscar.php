<?php
require_once('DisplayUtils.inc.php');  // functions to aid with display of information
require_once('funciones.inc.php');

error_reporting(0);  // E_ALLturn on all errors, warnings and notices for easier debugging
  $Xusuario = '1';
  $results = '';

  $endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
  $responseEncoding = 'XML';   // Format of the response

 
  $priceRangeMin = 0.0;
  $itemsPerRange = '1000';
  //$debug = (boolean) $_POST['Debug'];
   
  	$sql 	= "select * from seteosdebusqueda where usuario = '$Xusuario' ";
	//echo $sql; exit();
	//$dba  = conecto();
	 
	$ra   = mysqli_query(conecto(),$sql);
				
	if (!$ra)
	{
		mysqli_close($ra);
		$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	}
		mysqli_close($ra);	
	 
   while ($arr = mysqli_fetch_array($ra))		
   {	
   		$site 		= $arr['lugarbusqueda'];
		$apinumber 	= $arr['apinumber'];
		//echo "$site".$site;
   }

////
  	$sqlb 	= "select * from cartasabuscar ORDER BY `feha_alta` DESC";
	//echo $sql; exit();
	//$dbb  = conecto();
	 
	$rb   = mysqli_query(conecto(),$sqlb);
				
	if (!$rb)
	{
		mysqli_close($rb);
		$error = "Error: (" . mysql_errno() . ") " . mysql_error().")";
	}
		mysqli_close($rb);	
	 
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
                <aside id="page-sidebar" class="collapse navbar-collapse navbar-main-collapse">
                    <?php include('sidebar.php'); ?>
                </aside>
                <!-- END Sidebar -->

                <!-- Page Content -->
                <div id="page-content">
                    <!-- Navigation info -->
                    <ul id="nav-info" class="clearfix">
                        <li><a href="principal.php"><i class="fa fa-home"></i></a></li>
                        <li class="active"><a href="principal.php">Menu Principal</a></li>
                    </ul>
                    <!-- END Navigation info -->

                    <!-- Editable Datatables -->
                    <h3 class="page-header page-header-top">Busqueda en Ebay</h3>

					<?php
						$results = "";
						$nombreviejo = "";
   
						while ($arrb = mysqli_fetch_array($rb))	//todas las cartas	a buscar..
						{
							$results = "";
								
							$nombretitulo = $arrb['nombre_carta'];
							$nivelcarta	  = $arrb['nivelcarta'];
								
							$bodytag = str_replace(" ", "+", "$nombretitulo");
					?>
                    <div class="push">
                        <h4 class="sub-header"><a href="http://sales.starcitygames.com/search.php?substring='<?php echo trim($bodytag); ?>'"><?php echo trim($nombretitulo); ?></a></h4>
                    </div>
                    <?php
							$findCard = $arrb['nombre_carta'].' magic the gathering';
						
							$safeQuery = urlencode (utf8_encode($findCard));
							$priceRangeMax = '500';

							$apicall = "$endpoint?OPERATION-NAME=findItemsAdvanced"
								 . "&SERVICE-VERSION=1.0.0"
								 . "&GLOBAL-ID=$site"
								 . "&SECURITY-APPNAME=$apinumber" //replace with your app id
								 . "&keywords=$safeQuery"
								 . "&paginationInput.entriesPerPage=$itemsPerRange"
								 . "&sortOrder=EndTimeSoonest"
								 . "&itemFilter(0).name=ListingType"
								 . "&itemFilter(0).value(0)=Auction"
								 . "&itemFilter(1).name=MinPrice"
								 . "&itemFilter(1).value=$priceRangeMin"
								 . "&itemFilter(2).name=MaxPrice"
								 . "&itemFilter(2).value=$priceRangeMax"		 		 
								 . "&RESPONSE-DATA-FORMAT=$responseEncoding";
	

 							   	$resp = simplexml_load_file($apicall);

								if ($resp && $resp->paginationOutput->totalEntries > 0) 
								{
								?>
                                	<h5>Total items : <?php echo $resp->paginationOutput->totalEntries; ?></h5><br />
                                    <table id="example-editable-datatables" class="table table-bordered table-hover">
                                    <thead>                       
                                        <tr>
                                        	<th class="cell-small"></th>
                                            <th>Foto</th>
                                            <th>Titulo</th>
                                            <th class="cell-small"><i class="fa fa-money" aria-hidden="true"></i> Precio</th>
                                            <th class="cell-small"><i class="fa fa-truck"></i> Shipping</th>
                                            <th class="cell-small"><i class="fa fa-percent"></i> Total</th>
                                            <th class="cell-small">Moneda</th>
                                            <th class="cell-small"><i class="fa fa-clock-o"></i> Tiempo Faltante</th>
                                            <th class="cell-small">Otros</th>
                                        </tr>
                                    
                                    </thead> 
                                    <tbody>   
                                <?php
								 
								  // If the response was loaded, parse it and build links
								  foreach($resp->searchResult->item as $item)
								  {
									if ($item->galleryURL) {
									  $picURL = $item->galleryURL;
									} else {
									  $picURL = "http://pics.ebaystatic.com/aw/pics/express/icons/iconPlaceholder_96x96.gif";
									}
									$link  = $item->viewItemURL;
									$title = $item->title;
							
									$price = sprintf("%01.2f", $item->sellingStatus->convertedCurrentPrice);
									$ship  = sprintf("%01.2f", $item->shippingInfo->shippingServiceCost);
									$total = sprintf("%01.2f", ((float)$item->sellingStatus->convertedCurrentPrice
												  + (float)$item->shippingInfo->shippingServiceCost));
							
									// Determine currency to display - so far only seen cases where priceCurr = shipCurr, but may be others
									$priceCurr = (string) $item->sellingStatus->convertedCurrentPrice['currencyId'];
									$shipCurr  = (string) $item->shippingInfo->shippingServiceCost['currencyId'];
									if ($priceCurr == $shipCurr) {
									  $curr = $priceCurr;
									} else {
									  $curr = "$priceCurr / $shipCurr";  // potential case where price/ship currencies differ
									}
							
									$timeLeft = getPrettyTimeFromEbayTime($item->sellingStatus->timeLeft);
									$endTime = strtotime($item->listingInfo->endTime);   // returns Epoch seconds
									$endTime = $item->listingInfo->endTime;
							
									$diasAmostrar = getSoloDias($item->sellingStatus->timeLeft);
							
									$formatedTitle = findEditionForAName($nombretitulo,$title);
									
									if($diasAmostrar<3)
									{
										
									?>
                                        <tr id="1">
                                        	<td id="id1" class="text-center">1</td>
                                            <td class="text-center"><a href="<?php echo $link; ?>" target="_blank"><img src="<?php echo $picURL; ?>"></a></td>
                                            <td id="username1" class="editable-td"><a href="<?php echo $link; ?>" target="_blank"><?php echo $title; ?></a></td>
                                            <td><?php echo $price; ?></td>
                                            <td><?php echo $ship; ?></td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo $curr; ?></td>
                                            <td><?php echo $timeLeft; ?></td>
                                            <td><?php echo $endTime; ?><br><?php echo $formatedTitle; ?></td>
                                        </tr>
                    				<?php
									}
								  }

								 ?>    
                                    </tbody>
                                </table>
                                <?php
								}
							
							   } 
							  
							?> 

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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js -->
        <script src="js/vendor/bootstrap.min.js"></script>

        <!-- Jquery plugins and custom javascript code -->
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Javascript code only for this page -->
        <script>
            $(function () {

                // Hold our table to a variable
                var exampleDatatable = $('#example-editable-datatables');

                /*
                 * Function for handing the data after a cell has been edited
                 *
                 * From here you can send the data with ajax (for example) to handle in your backend
                 *
                 */
                var reqHandle = function (value, settings) {

                    // this, the edited td element
                    console.log(this);

                    // $(this).attr('id'), get the id of the edited td
                    console.log($(this).attr('id'));

                    // $(this).parent('tr').attr('id'), get the id of the row
                    console.log($(this).parent('tr').attr('id'));

                    // value, the new value the user submitted
                    console.log(value);

                    // settings, the settings of jEditable
                    console.log(settings);

                    // Here you can send and handle the data in your backend
                    // ...

                    // For this example, just return the data the user submitted
                    return(value);
                };

                /*
                 * Function for initializing jEditable handlers to the table
                 *
                 * For advance usage you can check http://www.appelsiini.net/projects/jeditable
                 *
                 */
                var initEditable = function (rowID) {

                    // Hold the elements that the jEditable will be initialized
                    var elements;

                    // If we don't have a rowID apply to all td elements with .editable-td class
                    if (!rowID)
                        elements = $('td.editable-td', editableTable.fnGetNodes());
                    else
                        elements = $('td.editable-td', editableTable.fnGetNodes(rowID));

                    elements.editable(reqHandle, {
                        "callback": function (sValue, y) {
                            // Little fix for responsive table after edit
                            exampleDatatable.css('width', '100%');
                        },
                        "submitdata": function (value, settings) {
                            // Sent some extra data
                            return {
                                "row_id": this.parentNode.getAttribute('id'),
                                "column": editableTable.fnGetPosition(this)[2]
                            };
                        },
                        indicator: '<i class="fa fa-spinner fa-spin"></i>',
                        cssclass: 'remove-margin',
                        submit: 'Ok',
                        cancel: 'Cancel'
                    });
                };

                /*
                 * Function for deleting table row
                 *
                 */
                var delHandle = function () {

                    // When the user clicks on a delete button
                    $('body').on('click', 'a.delRow', function () {
                        var aPos = editableTable.fnGetPosition(this.parentNode);
                        var aData = editableTable.fnGetData(aPos[0]);
                        var rowID = $(this).parents('tr').attr('id');

                        // Here you can handle the deletion of the row in your backend
                        // ...

                        // Delete row if success with the backend
                        editableTable.fnDeleteRow(aPos[0]);
                    });
                };

                /*
                 * Function for adding table row
                 *
                 */
                var addHandle = function () {

                    // When the user clicks on the 'Add New User' button
                    $("#addRow").click(function () {

                        // Here you can handle your backend data (eg: adding a row to database and return the id of the row)

                        // ..

                        // Create a new row and set it up
                        var rowID = editableTable.fnAddData(['', '', '', '', '']);

                        // Example id, here you should add the one you created in your backend
                        var id = rowID[0] + 1;

                        // Update the id cell, so that our table redraw and resort (new row goes first in datatable)
                        editableTable.fnUpdate(id, rowID[0], 1);

                        // Get the new row
                        var nRow = editableTable.fnGetNodes(rowID[0]);

                        /*
                         * In the following section you should set up your cells
                         */
                        // Add id to tr element
                        $(nRow).attr('id', id);

                        // Setup first cell with the delete button
                        $(nRow)
                            .children('td:nth-child(1)')
                            .addClass('text-center')
                            .html('<a href="javascript:void(0)" id="delRow' + id + '" class="btn btn-xs btn-danger delRow"><i class="fa fa-times"></i></a>');

                        // Setup second cell (id)
                        $(nRow)
                            .children('td:nth-child(2)')
                            .attr('id', 'id' + id)
                            .addClass('text-center');

                        // Setup third cell (username)
                        $(nRow)
                            .children('td:nth-child(3)')
                            .addClass('editable-td')
                            .attr('id', 'username' + id);

                        // Setup fourth cell (email)
                        $(nRow)
                            .children('td:nth-child(4)')
                            .addClass('editable-td')
                            .addClass('hidden-xs hidden-sm')
                            .attr('id', 'email' + id);

                        // Setup fifth cell (notes)
                        $(nRow)
                            .children('td:nth-child(5)')
                            .addClass('editable-td')
                            .addClass('hidden-xs hidden-sm')
                            .attr('id', 'notes' + id);

                        // Setup your other cells the same way (if you have more)
                        // ...

                        // Initialize jEditable to the new row
                        initEditable(rowID[0]);

                        // Little fix for responsive table after adding a new row
                        exampleDatatable.css('width', '100%');
                    });
                };

                // Initialize Datatables
                var editableTable = exampleDatatable.dataTable({
                    order: [[1, 'desc']],
                    columnDefs: [{orderable: false, targets: [0]}]
                });
                $('.dataTables_filter input').attr('placeholder', 'Search');

                // Initialize jEditable
                initEditable();

                // Handle rows deletion
                delHandle();

                // Handle new rows
                addHandle();
            });
        </script>
    </body>
</html>