<?php
// Fonction pour afficher les réservations sous forme de shortcode
function mon_plugin_affichage_reservations() {
    ob_start();

    // Récupérez les réservations depuis la base de données
    $reservations = mon_plugin_recuperer_reservations();

    if (!empty($reservations)) {
        echo '<ul>';
        foreach ($reservations as $reservation) {
            echo '<li>Nom : ' . esc_html($reservation->nom) . ', E-mail : ' . esc_html($reservation->email) . ', Date : ' . esc_html($reservation->date) . ', Créneau : ' . esc_html($reservation->creneau) . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Aucune réservation trouvée.';
    }

    return ob_get_clean();
}

// Enregistrez le shortcode pour afficher les réservations
add_shortcode('mon_plugin_affichage_reservations', 'mon_plugin_affichage_reservations');
