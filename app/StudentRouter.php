<?php


    if(isset($_GET['url'])) {

        $url = htmlentities($_GET['url']);
        $url = rtrim($url);

        switch ($url) {
            case 'logout':
                destroyCurrentSession();
                header("Location: http://localhost/clearancems/");
                break;
            
            default:
                # code...
                break;
        }
    }


    function destroyCurrentSession() {
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['fullname']);
        unset($_SESSION['cleared']);
    }