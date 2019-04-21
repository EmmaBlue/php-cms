<?php
    //form password protected currently, but trigger for delete is not

    require_once('config.php');
    confirm_logged_in();

    if(isset($_GET['caller_id'])){

        $action = $_GET['caller_id'];
        switch ($action){
        //logout = caller id linked in logout link in index.php

            case 'logout':
                logged_out();
                break;

            case 'delete':
                $id = $_GET['id'];
                deleteUser($id);
                break;

            case 'deleteproduct':
                $id = $_GET['id'];
                deleteProduct($id);
                break;
        }
    }