<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "assalyasser001@gmail.com"; // Change this email to your //



// Créer une nouvelle instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres du serveur GMAIL
    $mail->isSMTP();                                    // Utiliser SMTP
    $mail->Host = 'smtp.gmail.com';                     // Serveur SMTP (par exemple Gmail)
    $mail->SMTPAuth = true;                             // Activer l'authentification SMTP
    $mail->Username = 'assalyasser001@gmail.com';          // Adresse e-mail SMTP
    $mail->Password = 'igoiaosknmtljlrr';             // Mot de passe SMTP ou mot de passe d'application
    $mail->SMTPSecure = 'ssl';                          // Activer le chiffrement TLS
    $mail->Port = 465;                                  // Port SMTP pour TLS
    
    // Paramètres de l'e-mail
    $mail->setFrom($email, $name);                      // L'expéditeur du mail (l'adresse saisie dans le formulaire)
    $mail->addAddress($to);                             // Destinataire (votre adresse)
    $mail->addReplyTo($email);                          // Ajouter une adresse de réponse (l'e-mail du formulaire)

    // Contenu de l'e-mail
    $mail->isHTML(false);                               // Envoyer en texte brut
    $mail->Subject = "$m_subject:  $name";              // Objet de l'e-mail
    $mail->Body    = "Vous avez reçu un nouveau message via le formulaire de contact de votre site web.\n\n"."Voici les details:\n\nName: $name\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";

    // Envoyer l'e-mail
    $mail->send();
    echo "mail envoyé !";
} catch (Exception $e) {
    // Gestion des erreurs
    echo "ERROR: " . $e ;
    //http_response_code(500);
    echo " Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo} ";
}

?>
