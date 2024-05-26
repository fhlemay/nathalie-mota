<?php


define('TEXT_DOMAIN', 'nathalie-mota'); // translation domain


// Activer le mode debug
if (!defined('WP_DEBUG')) {
  define('WP_DEBUG', true); // on active les erreurs
  define('WP_DEBUG_LOG', true); // enregistre les erreurs dans un fichier
  define('WP_DEBUG_DISPLAY', true); // affiche les erreur à l'écran
}

// Désactiver l'accès à l'éditeur de fichier
define('DISALLOW_FILE_EDIT', true);

// Limiter le nombre de révisions
// define('WP_POST_REVISIONS', 5);

// Espacer les enregistrements automatiques
// define('AUTOSAVE_INTERVAL', 300); // 5 minutes
