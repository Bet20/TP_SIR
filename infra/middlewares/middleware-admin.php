<?php

@require_once __DIR__ . '/../../helpers/session.php';

if (!admin()) {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/sir/pages/secure/';
    header('Location: ' . $home_url);
}
