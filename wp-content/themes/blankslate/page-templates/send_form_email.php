<?php get_header(); ?>
<section id="content" role="main">
	<header class="header">
	</header>

	<?php
 
	if(isset($_POST['frmEmail'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
		    $email_to = "you@yourdomain.com";
 
		    $email_subject = "Your email subject line";
 
     
 
     
 
		    function died($error) {
 
        // your error code can go here
 
			        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
			        echo "These errors appear below.<br /><br />";
 
			        echo $error."<br /><br />";
 
			        echo "Please go back and fix these errors.<br /><br />";
 
			        die();
 
		    }
 
     
 
    // validation expected data exists
 
		    if(!isset($_POST['frmName']) ||
 
			        !isset($_POST['frmEmail']) ||
 
			        !isset($_POST['frmSubject']) ||
 
			        !isset($_POST['frmMessage'])) {
 
			        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
	    }
 
     
 
    $nombre = $_POST['frmName']; // required
 
    $email_from = $_POST['frmEmail']; // required
 
    $asunto = $_POST['frmSubject']; // not required
 
    $comments = $_POST['frmMessage']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
	    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$nombre)) {
 
	    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 
  }
 
  if(strlen($comments) < 2) {
 
	    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
	    died($error_message);
 
  }
 
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
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 
Gracias por contactarnos.  
 <meta http-equiv="refresh" content="5;url=<?php home_url( ); ?>
" />

</section>
 
<?php
 
}
 
?>