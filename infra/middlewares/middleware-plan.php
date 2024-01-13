<?php
require_once __DIR__ . '/../../infra/repositories/planRepository.php';

    if (isset($_SESSION['id'])) {
        if(!isset($_SESSION['plan'])){
            $userPlan = getPlanByUserId($_SESSION['id']);
            if($userPlan){
                $_SESSION['plan'] = $userPlan;
            } else {
                //TODO - Rederecionar para a pagina do escolher plano
                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/sir/pages/secure/plan.php';
                header('Location: ' . $home_url);
            }
        }
    } else{
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/sir/';
        header('Location: ' . $home_url);
    }
 
?>