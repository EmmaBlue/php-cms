<?php 

    require_once('config.php');

    if(isset($_GET['caller_id'])){

        $action = $_GET['caller_id'];
        switch ($action){
        //logout = caller id linked in logout link in index.php 

            case 'logout':
                logged_out();
                break;
        }
    }