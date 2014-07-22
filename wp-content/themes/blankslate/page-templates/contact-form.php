<?php
/**
 * Template Name: Forma de contacto
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['frmName']) === '') {
		$nameError = 'Por favor escribe tu nombre.';
		$hasError = true;
	} else {
		$name = trim($_POST['frmName']);
	}

	if(trim($_POST['frmEmail']) === '')  {
		$emailError = 'Por favor escribe un Correo Electrónico.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['frmEmail']))) {
		$emailError = 'Tu correo electrónico es inválido.';
		$hasError = true;
	} else {
		$email = trim($_POST['frmEmail']);
	}

	if(trim($_POST['frmSubject']) === '') {
		$subjectError = 'Por favor escribe un asunto.';
		$hasError = true;
	} else {
		$name = trim($_POST['frmSubject']);
	}

	if(trim($_POST['frmMessage']) === '') {
		$commentError = 'Por favor escribe un mensaje.';
		$hasError = true;
	} else {
		$comments = trim($_POST['frmMessage']);
	}

	if(!isset($hasError)) {
$nombre = $_POST['frmName']; // required
$email_from = $_POST['frmEmail']; // required
$asunto = $_POST['frmSubject']; // not required
$comments = $_POST['frmMessage']; // required
$error_message = "";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
$email_message = "Form details below.\n\n";
function clean_string($string) {
	$bad = array("content-type","bcc:","to:","cc:","href");
	return str_replace($bad,"",$string);
}
$email_message .= "Nombre: ".clean_string($nombre)."\n";
$email_message .= "Email: ".clean_string($email_from)."\n";
$email_message .= "Asunto: ".clean_string($asunto)."\n";
$email_message .= "Mensaje: ".clean_string($comments)."\n";
// create email headers
$email_subject = clean_string($asunto);
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'Subject: '.$asunto."\r\n" .
'X-Mailer: PHP/' . phpversion();
$email_subject2 = 'Gracias por contactarnos!';
$email_message2 = 'Gracias por contactarnos! Pronto escucharás de nosotros!';
$headers2 = 'From: '.$email_to."\r\n".
'Reply-To: '.$email_to."\r\n" .
'Subject: '.$email_subject2."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
@mail($email_from, $email_subject2, $email_message2, $headers2);
$emailSent = true;

?>
<?php
}
}
?>
<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/contact-form/contact-form.css"/>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js
"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js
"></script>
<script src="<?php echo get_template_directory_uri() ?>/contact-form/contact-form.js"></script>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="contact-form">
				<?php
						// Include the page content template.
				get_template_part( 'content', 'page' );
				?>
				<?php if(isset($emailSent) && $emailSent == true) { ?>
				<div class="thanks">
					<p>Gracias por contactarnos!!! <br> En breve sabrás de nosotros.</p>
				</div>
				<?php } else { ?>
				<?php the_content(); ?>
				<?php if(isset($hasError) || isset($captchaError)) { ?>
				<p class="error">Un error acaba de ocurrir.<p>
					<?php } ?>
					<?php } ?>


					<form action="<?php the_permalink(); ?>" method="post"  autocomplete="on" id="frmContact">
						<div class="input-prepend">
							<label for="frmName"><span class="add-on validLabel fontawesome-user" name="name"></span></label>
							<input id="frmName" type="text" name="frmName" placeholder="Nombre"  title="Escribe tu nombre." value="<?php if(isset($_POST['frmName'])) echo $_POST['frmName'];?>" />
							<?php if($nameError != '') { ?>
							<span class="error"><?=$nameError;?></span>
							<?php } ?>
						</div>

						<div class="input-prepend">
							<label for="frmEmail"><span class="add-on validLabel fontawesome-envelope"></span></label>
							<input type="text" id="frmEmail" name="frmEmail" placeholder="Email" title="Escribe un mail válido." value="<?php if(isset($_POST['frmEmail'])) echo $_POST['frmEmail'];?>" />
							<?php if($emailError != '') { ?>
							<span class="error"><?=$emailError;?></span>
							<?php } ?>

						</div>
						<div class="input-prepend">
							<label for="frmSubject"><span class="add-on validLabel fontawesome-tag"></span></label>
							<input type="text" id="frmSubject" name="frmSubject" placeholder="Asunto" title="Escribe tu asunto" value="<?php if(isset($_POST['frmSubject'])) echo $_POST['frmSubject'];?>" />
							<?php if($subjectError != '') { ?>
							<span class="error"><?=$subjectError;?></span>
							<?php } ?>
						</div>
						<div class="input-prepend">
							<label for="frmMessage"><span class="add-on validLabel fontawesome-comment"></span></label>
							<textarea placeholder="Preguntas, dudas y aclaraciones que desees que resolvamos." id="frmMessage" name="frmMessage" title="Escribe tu mensaje."><?php if(isset($_POST['frmMessage'])) { echo $_POST['frmMessage'];}?></textarea>
							<?php if($commentError != '') { ?>
							<span class="error"><?=$commentError;?></span>
							<?php } ?>

						</div>
						<input type="submit" id="contactSubmit"></input>
						<input type="hidden" name="submitted" id="submitted" value="true" />

					</form>
				</div>
			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- #main-content -->
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>