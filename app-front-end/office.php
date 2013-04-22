<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
<link type="text/css" rel="stylesheet" href="http://mioficina.co/app-front-end/resources/pluggins/colorbox/example4/colorbox.css" />
<link type="text/css" rel="stylesheet" href="http://mioficina.co/app-front-end/resources/pluggins/jquery-iu-1.8.18/css/custom-theme/jquery-ui-1.8.18.custom.css" />
<link type="text/css" rel="stylesheet" href="http://mioficina.co/app-front-end/style.css" />
<style type="text/css">
<!-- 

	fieldset { border:0px; margin-bottom:20px;}
	label{ margin-left:15px;  }
	input{ padding:2px; margin:6px;}
	.text { color:#333; }
	.clearFieldBlurred { color:#666; font-style: italic; }
	.clearFieldActive { color: #333; }
	#preNickUnit{  display:inline; font-style:italic; font-weight:700; margin-left:0px; margin-right:10px;}
	input#userUserLogin { text-transform: lowercase; margin-right:0px; }
	.error-message, label.error {
		color: #ff0000;
		margin:0;
		display: inline;
		font-size: 1em !important;
		font-weight:lighter;
 	}
	#msgForm { margin-left:10px;}
	
-->
</style>
<title>Mi Unidad .Com</title>
</head>
<body>
	
    <!-- div loading page-->      
     <div id="loading" style="cursor:pointer;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;box-shadow:inset orange 0px 0px 2px;background:url(http://mioficina.co/app-front-end/resources/multimedia/gifs/ajax-loader-orange.gif) no-repeat center;  background-color:#fff;width:100%;color:#333;text-align:center;height:100%; top:0%;left:0%;padding:52px 12px 12px 12px;position:fixed;z-index:36;"><!--  Loading --></div>
	<!-- /div loading page --> 
    
    <div id="bar"><div id="info-bar"><a href="../index.html"><img src="http://mioficina.co/app-front-end/resources/multimedia/images/property-mini.png"></a></div></div>
    
	<div id="page">
        <div id="container">
            <header>
            	<section id="logo">
                	<img src="http://mioficina.co/app-front-end/resources/multimedia/images/unit/default.png" />
                </section>
            </header>
            <!-- content -->
            <article id="content">
            	<section id="header-content">
                	<h1></h1>
                </section>
                <section id="login">
                	<section class="title-bar">
	                	<h1><img src="http://mioficina.co/images/orange-yellow/multi-agents.png" /><span id="my-account">Acceder A Mi Cuenta</span></h1>
                    </section>
                    <section id="form-login">
                    	<section class="error-message" id="msgForm"></section>
                    	<form id="frm_login" name="frm_login">
                        	<fieldset>
                                <label for="userUserLogin">Usuario</label>
                                <input type="text" name="userUserLogin" value="usuario" id="userUserLogin" class="text ui-widget-content ui-corner-all" maxlength="15" />
                                <section id="preNickUnit"></section>
                                <br />
                                <label for="passwordUser">Contrase&ntilde;a</label>
                                <input type="password" name="passwordUserLogin" id="passwordUserLogin" value="" class="text ui-widget-content ui-corner-all" maxlength="255" />
                        	</fieldset>
                            <fieldset>
                                <a href="#" id="link-login">Login</a>
                            </fieldset>
                        </form>
                    </section>
                </section>
            	<section id="body-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie fermentum ligula, nec accumsan elit euismod ut. Nullam ut eros nec risus feugiat vulputate porta sed libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac massa dui, at pulvinar orci. Etiam vitae ante et libero convallis facilisis. Cras vitae ante non sem dapibus pellentesque. Suspendisse ullamcorper, ipsum nec varius tempor, nulla diam bibendum sapien, sed congue urna elit vel mauris. Cras sapien dui, commodo bibendum condimentum ut, porttitor non erat. Proin at magna dolor. Morbi mi erat, rutrum posuere scelerisque eu, malesuada ut eros. Quisque condimentum lorem vitae eros faucibus vel hendrerit nisi viverra. Nullam ac nisl vel tortor cursus imperdiet. Nunc sed ante eu nisl egestas dignissim. Aliquam a neque risus, non tincidunt massa. Fusce eget mi sit amet ante pharetra convallis sit amet eget urna. Ut venenatis, erat ac convallis blandit, diam risus tempus purus, iaculis gravida quam leo quis nulla.<br /><br />

Phasellus turpis augue, ullamcorper eu dignissim at, posuere ut mauris. Fusce ac ante dolor. Sed egestas eleifend lectus, a pellentesque erat pharetra vel. Curabitur volutpat pulvinar justo eget ultricies. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed eleifend lacinia commodo. Nunc eget tortor massa, ut pellentesque arcu. Nulla egestas consectetur tempus.<br /><br />

Aliquam at purus sem. Integer tortor massa, imperdiet sed lacinia id, ultrices ac nunc. Nulla vel mauris et elit euismod volutpat. Vivamus ac arcu eu elit lacinia malesuada sit amet at dui. In interdum dapibus neque id ultricies. Mauris lacinia semper massa, ac blandit magna mattis eu. Proin elementum, magna nec volutpat commodo, ipsum augue accumsan turpis, ac sollicitudin ante lacus vel urna.<br /><br />

Morbi ornare libero a mauris luctus eget feugiat nisi ultricies. In tincidunt urna placerat quam lobortis vehicula. Aliquam consectetur, eros vitae placerat rhoncus, nisi justo tincidunt nulla, in tristique leo ligula at nunc. Proin sollicitudin mauris eget velit accumsan viverra. Proin massa eros, rhoncus vel sodales et, posuere sit amet lacus. Proin augue tortor, rhoncus pulvinar lobortis at, imperdiet a quam. Proin dictum eros sed tellus molestie id dapibus est blandit.<br /><br />
                </section>

            </article>
            <!-- /content -->
            <footer>
                <p><img src="http://mioficina.co/app-front-end/resources/multimedia/images/cc.png"> 2012 Mi Unidad .Com (Sistema de Informaci&oacute;n Para Unidades Residenciales)</p>
                <address></address>
            </footer>
        </div>
     </div>
     <div id="paramNickUnit" style="visibility:hidden;"><?php echo $_REQUEST['nickOffice']; ?></div>
     
</body>
<script src="http://mioficina.co/app-front-end/resources/pluggins/jquery-iu-1.8.18/js/jquery-1.7.1.min.js"></script>
<script src="http://mioficina.co/app-front-end/resources/global/global_functions.js" type="text/javascript"></script>
<script src="http://mioficina.co/app-front-end/controller/functions_unidad.js" type="text/javascript"></script>
<script src="http://mioficina.co/app-front-end/resources/pluggins/colorbox/colorbox/jquery.colorbox.js"></script>
<script src="http://mioficina.co/app-front-end/resources/pluggins/alphanumeric/jquery.alphanumeric.pack.js" type="text/javascript"></script>
<script src="http://mioficina.co/app-front-end/resources/pluggins/clearField/jquery.clearfield.packed.js" type="text/javascript"></script>
<script src="http://mioficina.co/app-front-end/resources/pluggins/validate/jquery.validate.pack.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		$(function(){
			$('#userUserLogin').alphanumeric({allow:".-_#@"});
			$('#frm_login input[name=userUserLogin]').clearField({
				blurClass: 'clearFieldBlurred',
				activeClass: 'clearFieldActive'	
			});
			$('#link-login').bind('click', function(){
				$('#frm_login').submit();
			});
		});
		
		$(function(){
			$("#frm_login").validate({
				event: 'blur',
				  rules: {
					'userUserLogin': 'required',
					'passwordUserLogin': 'required'
				  },
				  messages: {
					'userUserLogin': "Por favor ingrese su nombre de usuario",
					'passwordUserLogin': "Por favor ingrese su contrase&ntilde;a"
				  },
				  debug: true,
				  errorElement: 'label',
				  submitHandler: function(form){
					  login( $('#frm_login #userUserLogin').val(), $('#frm_login #passwordUserLogin').val() );
				  }			
			});
		});
		
	});
</script>
</html>