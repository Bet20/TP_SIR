<?php

require_once __DIR__ . '/../../helpers/session.php';

if (!isAuthenticated()) {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/sir/';
    header('Location: ' . $home_url);
}
