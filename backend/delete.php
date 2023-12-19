<?php
        session_start();
	session_regenerate_id();

        include('DatabaseAccessProps.php');
        include_once('connectDb.php');

        if(isset($_GET['id'])){
                $id = $_GET['id'];
                $msqlQuery = $con->prepare("DELETE FROM driver WHERE id = $id ");
                $msqlQuery->execute();
                $_SESSION['alertDelete'] = ("successfully deleted user " . $id);
                require('update.php');
        } else {
                echo 'delete failed, no id!'; 
        }

?>