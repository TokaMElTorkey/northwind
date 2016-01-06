<?php 	
	/* Ensure that the folder was installed correctly */
	
	$installationError = false;
	if ( !@include("../../defaultLang.php") ){ 
	   $installationError = true;
	}
	@include("../../language.php");
	@include("../../lib.php");
	@include("../plugins-resources/plugins-common.php");

	
	#########################################################

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

	<head>
		<meta charset="iso-8859-1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Search Page Maker for AppGini</title>
		
		<?php
			if ($installationError){ ?>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">				
				</head>
				<body>
					<br>
					<div class="container">
						<div class="panel panel-danger"><div class="panel-heading"><h3 class="panel-title">Error:</h3></div><div class="panel-body"><p class="text-danger">The SPM folder was not installed correctly, you must put it inside the plugins folder under you root project folder.</p></div></div></div>
					</div>
				</body>
				</html>
			<?php 
			exit;
			}
		?>

		<link id="browser_favicon" rel="shortcut icon" href="../../resources/images/appgini-icon.png">

		<link rel="stylesheet" href="../../resources/initializr/css/bootstrap.css">
		<!--[if gt IE 8]><!-->
			<link rel="stylesheet" href="../../resources/initializr/css/bootstrap-theme.css">
		<!--<![endif]-->
		<link rel="stylesheet" href="../../dynamic.css.php">
		<link rel="stylesheet" href="../plugins-resources/dropzone/dropzone.min.css">
		


		<!-- jquery ui -->
		<link rel="stylesheet" href="../plugins-resources/jquery-ui/jquery-ui.min.css">

		<!--[if lt IE 9]>
			<script src="resources/initializr/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<![endif]-->
		<script src="../../resources/jquery/js/jquery-1.11.2.min.js"></script>

		<!-- jquery ui -->
		<script src="../plugins-resources/jquery-ui/jquery-ui.min.js"></script>

		<script>var $j = jQuery.noConflict();</script>
		<script src="../../resources/initializr/js/vendor/bootstrap.min.js"></script>	
		<script src="../plugins-resources/plugins-common.js"></script>
		<script src="../plugins-resources/dropzone/dropzone.min.js"></script>


	</head>
	<body>
		<div class="container">
		
			<!-- process notifications -->
			<div style="height: 60px; margin: -15px 0 -45px;">
				<?php if(function_exists('showNotifications')) echo showNotifications(); ?>
			</div>

			<?php
			
				/* grant access to the groups 'Admins' only */
				if (!is_admin() ){
					echo "<br>".plugin_error_message('Access denied.<br>Please, <a href=\'../../index.php?signIn=1\' >Log in</a> as administrator to access this page.' , false);
					exit;
				}
				

				/* Ensure that the projects folder has write permission */
				if ( !file_exists ("../projects" )){
					 if (!mkdir ( "../projects" , 0775)){
						echo "<br>".plugin_error_message('Could not create projects directory.<br>Please,create \'projects\' directory inside the SPM root directory',false);		
						exit;
					}
				}
				
				if ( ! is_writable( "../projects" )){
					echo "<br>".plugin_error_message('Please, change the permission of the \'projects\' folder to be writeable.',false);		
					exit;
				}

			?>