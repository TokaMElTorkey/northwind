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

		<title><?php echo ucwords('SPM'); ?> </title>
		
		<?php 	
			/* Ensure that the folder was installed correctly */
			try{
				if ( !@include("../defaultLang.php") ){ 
					throw new Exception ('The SPM folder was not installed correctly, you must put the folder inside your root project folder.');
				}
			}catch(Exception $e) {   ?>
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">				
				</head>
				<body>
					<br>
					<div class="container">
						<div class="panel panel-danger"><div class="panel-heading"><h3 class="panel-title">Error:</h3></div><div class="panel-body"><p class="text-danger"><?php echo $e->getMessage();?></p></div></div></div>
					</div>
				</body>
				</html>
				<?php 
				exit;

			}
			include("../language.php");
			include("../lib.php");
		
		?>

		<link id="browser_favicon" rel="shortcut icon" href="../resources/images/appgini-icon.png">

		<link rel="stylesheet" href="../resources/initializr/css/bootstrap.css">
		<!--[if gt IE 8]><!-->
			<link rel="stylesheet" href="../resources/initializr/css/bootstrap-theme.css">
		<!--<![endif]-->
		<link rel="stylesheet" href="../dynamic.css.php">
		
		<!--[if lt IE 9]>
			<script src="resources/initializr/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<![endif]-->
		<script src="../resources/jquery/js/jquery-1.11.2.min.js"></script>
		<script>var $j = jQuery.noConflict();</script>
		<script src="../resources/initializr/js/vendor/bootstrap.min.js"></script>	
		<link rel="stylesheet" href="../resources/dropzone/dropzone.min.css">
		<script src="../resources/dropzone/dropzone.min.js"></script>
		<script>
		
			function random_string(string_length){
				var text = "";
				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

				for(var i = 0; i < string_length; i++)
					text += possible.charAt(Math.floor(Math.random() * possible.length));

				return text;
			}
			/**
			 * options object. The following members can be provided:
			 *    url: iframe url to load
			 *    message: instead of a url to open, you could pass a message. HTML tags allowed.
			 *    id: id attribute of modal window
			 *    title: optional modal window title
			 *    size: 'default', 'full'
			 *    close: optional function to execute on closing the modal
			 *    footer: optional array of objects describing the buttons to display in the footer.
			 *       Each button object can have the following members:
			 *          label: string, label of button
			 *          bs_class: string, button bootstrap class. Can be 'primary', 'default', 'success', 'warning' or 'danger'
			 *          click: function to execute on clicking the button. If the button closes the modal, this
			 *                 function is executed before the close handler
			 *          causes_closing: boolean, default is true.
			 */
			function modal_window(options){
				var id = options.id;
				var url = options.url;
				var title = options.title;
				var footer = options.footer;
				var message = options.message;

				if(typeof(id) == 'undefined') id = random_string(20);
				if(typeof(footer) == 'undefined') footer = [];

				if(jQuery('#' + id).length){
					/* modal exists -- remove it first */
					jQuery('#' + id).remove();
				}

				/* prepare footer buttons, if any */
				var footer_buttons = '';
				for(i = 0; i < footer.length; i++){
					if(typeof(footer[i].causes_closing) == 'undefined'){ footer[i].causes_closing = true; }
					if(typeof(footer[i].bs_class) == 'undefined'){ footer[i].bs_class = 'default'; }
					footer[i].id = id + '_footer_button_' + random_string(10);

					footer_buttons += '<button type="button" class="btn btn-' + footer[i].bs_class + '" ' +
							(footer[i].causes_closing ? 'data-dismiss="modal" ' : '') +
							'id="' + footer[i].id + '" ' +
							'>' + footer[i].label + '</button>';
				}

				jQuery('body').append(
					'<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
						'<div class="modal-dialog">' +
							'<div class="modal-content">' +
								( title != undefined ?
									'<div class="modal-header">' +
										'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
										'<h3 class="modal-title" id="myModalLabel">' + title + '</h3>' +
									'</div>'
									: ''
								) +
								'<div class="modal-body" style="-webkit-overflow-scrolling:touch !important; overflow-y: auto;">' +
									( url != undefined ?
										'<iframe width="100%" height="100%" sandbox="allow-forms allow-scripts allow-same-origin allow-popups" src="' + url + '"></iframe>'
										: message
									) +
								'</div>' +
								( footer != undefined ?
									'<div class="modal-footer">' + footer_buttons + '</div>'
									: ''
								) +
							'</div>' +
						'</div>' +
					'</div>'
				);

				for(i = 0; i < footer.length; i++){
					if(typeof(footer[i].click) == 'function'){
						jQuery('#' + footer[i].id).click(footer[i].click);
					}
				}

				jQuery('#' + id).modal();

				if(typeof(options.close) == 'function'){
					jQuery('#' + id).on('hidden.bs.modal', options.close);
				}

				if(typeof(options.size) == 'undefined') options.size = 'default';

				if(options.size == 'full'){
					jQuery(window).resize(function(){
						jQuery('#' + id + ' .modal-dialog').width(jQuery(window).width() * 0.95);
						jQuery('#' + id + ' .modal-body').height(jQuery(window).height() * 0.7);
					}).trigger('resize');
				}

				return id;
			}
		</script>
		
		
		<script>
			// VALIDATION FUNCTIONS FOR VARIOUS PAGES
			
		</script>


	</head>
	<body>
		<div class="container">
		
			<?php if(!$_REQUEST['Embedded']){ ?>
				<?php echo htmlUserBar(); ?>
				<div style="height: 70px;" class="hidden-print"></div>
			<?php } ?>

			<!-- process notifications -->
			<div style="height: 60px; margin: -15px 0 -45px;">
				<?php if(function_exists('showNotifications')) echo showNotifications(); ?>
			</div>

	<?php

		/* grant access to the groups 'Admins' only */
		$mi = getMemberInfo();
		if( ! ($mi['admin'] && ((is_string($mi['group']) && $mi['group'] =='Admins') || ( is_array($mi['group']) && array_search("Admins" , $mi['group']))))){
			echo error_message('Access denied.<br>Please, <a href=\'http://localhost/new_task/northwind/index.php?signIn=1\' >Log in</a> as administrator to access this page.');;
			exit;
		}
		

		/* Ensure that the projects folder has write permission */
		if ( ! is_writable( "./projects" )){
			echo error_message('Please, change the permission of the \'projects\' folder to be writeable.');		
			exit;
		}

	?>