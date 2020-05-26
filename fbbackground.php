<?php
session_start();
include_once __DIR__ . '/php/facebook_api.php';
define('FB_GRAPH_VERSION', 'v6.0');
define('FB_GRAPH_DOMAIN', 'https://graph.facebook.com/');
define('FB_APP_STATE', 'eciphp');