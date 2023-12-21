<?php
/**
 * Plugin Name: Calendar
 * Description: Tp Calendrier
 * Version: 1.0
 * Author: DC5
 */

// Inclure le gestionnaire de base de données
require_once(plugin_dir_path(__FILE__) . 'database.php');

// Inclure le fichier d'affichage des données
require_once(plugin_dir_path(__FILE__) . 'display-data.php');

// Sécurité pour empêcher l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit;
}

// Fonction pour afficher le formulaire de réservation
function mon_plugin_affichage_formulaire() {
    ob_start(); 
?>
    <!-- Formulaire de réservation -->
    <form id="reservation-form" method="post">
    
        <div class="form-group">
            <label for="text">Utilisateur :</label>
            <input type="text" id="text" name="text" required>
        </div>
        
        <div class="form-group">
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="date">Sélectionnez une date :</label>
            <input type="date" id="date" name="date" required>
        </div>
        <label for="horaire">Sélectionnez un horaire :</label>
            <select id="horaire" name="horaire" required>
                <option value="">Choisissez un horaire</option>
                <option value="08:00-09:00">08:00 - 09:00</option>
                <option value="09:00-10:00">09:00 - 10:00</option>
                <option value="10:00-11:00">10:00 - 11:00</option>
            </select>
        <!-- Bouton de soumission -->
        <input type="submit" id="submit-reservation" value="Réserver">
    </form>

    <!-- Script JavaScript pour gérer la soumission du formulaire -->
    <script type="text/javascript">
        document.getElementById('submit-reservation').addEventListener('click', function(event) {
            event.preventDefault();

            // Afficher un message de remerciement
            alert('Merci pour votre réservation. Nous vous contacterons bientôt pour confirmer.');
        });
    </script>
<?php
    return ob_get_clean(); 
}

// Shortcode
function mon_plugin_register_shortcode() {
    add_shortcode('mon_plugin_reservation', 'mon_plugin_affichage_formulaire');
}
add_action('init', 'mon_plugin_register_shortcode');

// Fonction pour gérer la soumission du formulaire
function mon_plugin_traitement_formulaire() {
    if (isset($_POST['text']) && isset($_POST['email'])) {
        // Récupérez les données du formulaire
        $text = sanitize_text_field($_POST['text']);
        $email = sanitize_email($_POST['email']);

        // Affichez un message de confirmation
        echo 'Réservation effectuée avec succès pour ' . esc_html($text) . ' à l\'adresse ' . esc_html($email);
    }
}

// Fonction pour ajouter le style CSS à WordPress
function mon_plugin_enqueue_styles() {
    wp_enqueue_style('mon-plugin-style', plugin_dir_url(__FILE__) . 'style.css');
}

// Action WordPress pour ajouter le style CSS
add_action('wp_enqueue_scripts', 'mon_plugin_enqueue_styles');

// Action WordPress pour gérer la soumission du formulaire
add_action('init', 'mon_plugin_traitement_formulaire');
?>
