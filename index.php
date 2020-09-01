<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug =2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'auth.smtp.1and1.fr';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     // SMTP username
    $mail->Password   = 'secret';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('hackerspoulette@gmail.com', 'Mailer');
    $mail->addAddress('maxendremartin@gmail.com');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Hello';
    $mail->Body    = 'Nous avons bien reçu votre demande!';
   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



//variable
$errorFirstname = $errorLastname = $errorGender = $errorEmail = $errorCountry = $errorSubject = $errorMessage = "";
$firstname = $lastname = $gender = $email = $country = $subject = $message = "";

//secu code
function secu($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
  }

  @$valider = secu($_POST['valider']);
  @$firstname = secu($_POST["firstname"]);
  @$lastname = secu($_POST["lastname"]);
  @$gender = secu($_POST["gender"]);
  @$email = secu($_POST["email"]);
  @$country = secu($_POST["country"]);
  @$subject = secu($_POST["subject"]);
  @$message = secu($_POST["message"]);
  
  //Champs obligatoire
  if (isset($_POST["valider"])) {

    if (empty($_POST["firstname"])) {
      $errorFirstname = "First name is required";
    } else {
      $firstname = secu($_POST["firstname"]);
    }

    if (empty($_POST["lastname"])) {
      $errorLastname = "Last name is required";
    } else {
      $lastname = secu($_POST["lastname"]);
    }

    if (empty($_POST["gender"])) {
      $errorGender = "Gender is required";
    } else {
      $gender = secu($_POST["gender"]);
    }

    if (empty($_POST["email"])) {
      $errorEmail = "E-mail is required";
    } else {
      $email = secu($_POST["email"]);
    }

    if (empty($_POST["country"])) {
        $errorCountry = "Country is required";
      } else {
        $country = secu($_POST["country"]);
      }

      if (empty($_POST["message"])) {
        $errorMessage = "Message  is required";
      } else {
        $message = secu($_POST["message"]);
      }
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learning project/form contact/php">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap" rel="stylesheet">
    <title>Contact</title>
</head>

<body>
<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
 
    <a class="navbar-brand" href="#">
          <img src="../assets/images/hackers-poulette-logo.png" alt="logo hacker poulette" width="20%">
        </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        
          <a class="nav-link" href="#">Home</a>
       
          <a class="nav-link" href="#">About</a>
        
          <a class="nav-link" href="#">Store</a>
        
          <a class="nav-link" href="#">Contact</a>
        
      </ul>
    </div>
  
</nav>

<!--Formulaire-->
<h1>CONTACT <span style="color:white">US</span></h1>
<div class="container">      
 <div class="row">
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="col-sm-12 col-md-12 col-lg-6">
    <label for="firstname">First name<span class="error"> * <?php echo $errorFirstname;?></span> </label>
      <input type="text" class="form-control" placeholder="Maxendre" alt="first name">
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
    <label for="lastname">Last name<span class="error"> * <?php echo $errorLastname;?></span> </label>
      <input type="text" class="form-control" placeholder="Martin"  alt="last name">
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
      <label for="gender">Gender<span class="error"> * <?php echo $errorGender;?></span> </label>
      <select id="gender" class="form-control" alt="gender">
        <option selected>Choose...</option>
        <option>Mr</option>
        <option>Mme</option>
      </select>
      </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
    <label for="email">E-mail<span class="error"> * <?php echo $errorEmail;?></span> </label>
      <input type="text" class="form-control" placeholder="email@gmail.com"  alt="email">
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
    <label for="country">Country<span class="error"> * <?php echo $errorCountry;?></span> </label>
      <input type="text" class="form-control" placeholder="country"  alt="country">
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
      <label for="subject">Subject</label>
      <select id="subject" class="form-control" alt="subject">
        <option selected>Other</option>
        <option>Refund</option>
        <option>Advice</option>
        <option>Customer service</option>
      </select>
      </div>

    <div class="col-sm-12 col-md-12 col-lg-12">
      <label>Message<span class="error"> * <?php echo $errorMessage;?></span> </label>
      <textarea class="form-control" rows="5" placeholder="Your message" alt="message"></textarea>
    </div>

    <input type="submit" value="Send" name="valider" class="btn btn-success validate formulaire" alt="boutton envoyer">

 </div>
</div>
</form>

<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>