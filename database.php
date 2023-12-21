<?php
// Créez la table de base de données lors de l'activation du plugin
function mon_plugin_creer_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'reservations';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nom VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        date DATE NOT NULL,
        creneau VARCHAR(20) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'mon_plugin_creer_table');

// Fonction pour insérer une réservation dans la base de données
function mon_plugin_inserer_reservation($nom, $email, $date, $creneau) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'reservations';

    $wpdb->insert(
        $table_name,
        array(
            'nom' => $nom,
            'email' => $email,
            'date' => $date,
            'creneau' => $creneau
        ),
        array(
            '%s',
            '%s',
            '%s',
            '%s'
        )
    );
}

// Fonction pour récupérer toutes les réservations depuis la base de données
function mon_plugin_recuperer_reservations() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'reservations';

    $results = $wpdb->get_results("SELECT * FROM $table_name");

    return $results;
}
