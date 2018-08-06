
<!DOCTYPE html>
<html lang="en">
<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Login Form Template</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>CAS</strong> </h1>
                            <h1>Sistema de Control de Aretes Siniiga</h1>
                          </div>
                          </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Contáctanos</h3>
                            		<p>Por favor, rellene los siguientes campos y nosotros nos comunicaremos con usted lo mas pronto posible.</p>
                        		</div>
                        		<div class="contact">
                        			<i class="contact-main"></i>
                              <form method ="post">
                        		</div>
                            </div>
                            <div class="form-bottom">

			                    <form role="form" action="auth.php" method="post" class="clearfix">

                            <div class="form-group">
			                    		<label class="sr-only" for="form-username">Nombre</label>
			                        	<input type="name" name="customer_name" placeholder="Nombre" class="form-username form-control" required/>
			                        </div>
                              <div class="form-group">
                                <label class="sr-only" for="form-username">Correo electrónico</label>
                                  <input type="email" name="customer_email" placeholder="Correo electrónico" class="form-username form-control"  required/>
                                </div>

                                <div class="form-group">
                                  <label class="sr-only" for="tell">Teléfono</label>
                                    <input type="phone" name="telephone" placeholder="Teléfono" class="form-username form-control"  required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="sr-only" for="form-username">Asunto</label>
                                      <input type="text" name="subject" placeholder="Asunto" class="form-username form-control"  required/>
                                    </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Mensaje</label>
			                        	<textarea name="message" placeholder="Deje su mensaje..." class="form-password form-control" required /></textarea>
			                        </div>

                              <?php
  if (isset($_POST['send'])){
    include("sendemail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico

    /*Configuracion de variables para enviar el correo*/
    $mail_username="sistema.cas.control@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
    $mail_userpassword="jdlokos05";//Tu contraseña de gmail
    $mail_addAddress="sistema.cas.control@gmail.com";//correo electronico que recibira el mensaje
    $template="email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje

    /*Inicio captura de datos enviados por $_POST para enviar el correo */
    $mail_setFromEmail=$_POST['customer_email'];
    $mail_setFromTelephone=$_POST['telephone'];
    $mail_setFromName=$_POST['customer_name'];
    $txt_message=$_POST['message'];
    $mail_subject=$_POST['subject'];

    sendemail($mail_setFromTelephone,$mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template);//Enviar el mensaje
  }
?>
<div class="enviar">
  <div class="contact-check">

  </div>
  <hr />
      <div class="contact-enviar">
    <button type="submit" class="btn btn-default" name="send" id="btn-send">
    <span class="glyphicon glyphicon-send"></span> &nbsp; Enviar Mensaje
  </div>
  <div class="clear"> </div>
  </form>
</div>
                          </form>
		                    </div>
                        </div>
                    </div>

            </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
