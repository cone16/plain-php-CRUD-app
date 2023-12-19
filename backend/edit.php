<?php
    session_start();
    session_regenerate_id();
    include("DatabaseAccessProps.php");
    include("connectDb.php");

    
    if($_POST['driverId'] !== $_SESSION['driverId_']){
        $current_id = $_SESSION['id_'];
        $new_driverId = $_POST['driverId'];
        $stmt = $con->prepare("UPDATE driver SET driverId = '$new_driverId' WHERE id = '$current_id'");
        $stmt->execute();
        session_regenerate_id();
        $_SESSION['_driverId'] = $_POST['driverId'];
        include('update.php');
        header('Location:../index.php');
    }

    if($_POST['url'] !== $_SESSION['url_']){
        $current_id = $_SESSION['id_'];
        $new_url = $_POST['url'];
        $stmt = $con->prepare("UPDATE driver SET url = '$new_url' WHERE id = '$current_id'");
        $stmt->execute();
        session_regenerate_id();
        $_SESSION['_url'] = $_POST['url'];
        include('update.php');
        header('Location:../index.php');
    }

    if($_POST['givenName'] !== $_SESSION['givenName:']){
        $current_id = $_SESSION['id_'];
        $new_givenName = $_POST['givenName'];
        $stmt = $con->prepare("UPDATE driver SET givenName = '$new_givenName' WHERE id = '$current_id'");
        $stmt->execute();
        session_regenerate_id();
        $_SESSION['_givenName'] = $_POST['givenName'];
        include('update.php');
        header('Location:../index.php');
    }

    if($_POST['familyName'] !== $_SESSION['familyName_']){
        $current_id = $_SESSION['id_'];
        $new_familyName = $_POST['familyName'];
        $stmt = $con->prepare("UPDATE driver SET familyName = '$new_familyName' WHERE id = '$current_id'");
        $stmt->execute();
        session_regenerate_id();
        $_SESSION['_familyName'] = $_POST['familyName'];
        include('update.php');
        header('Location:../index.php');
    }

    if($_POST['dateOfBirth'] !== $_SESSION['dateOfBirth_']){
        $current_id = $_SESSION['id_'];
        if(preg_match( "/[0-9][0-9](.|-)[0-9][0-9](.|-)[0-9][0-9][0-9][0-9]/", $_POST['dateOfBirth']) === 1){
            $date = new DateTime($_POST['dateOfBirth']);
            $string = $date->format('Y-m-d');
        }
        $new_dateOfBirth =  $con->real_escape_string($string);
        $stmt = $con->prepare("UPDATE driver SET dateOfBirth = '$new_dateOfBirth' WHERE id = '$current_id'");
        $stmt->execute();
        session_regenerate_id();
        $_SESSION['_dateOfBirth'] = $_POST['dateOfBirth'];
        include('update.php');
        header('Location:../index.php');
    }

    if($_POST['nationality'] !== $_SESSION['nationality_']){
        $current_id = $_SESSION['id_'];
        $new_nationality = $_POST['nationality'];
        $stmt = $con->prepare("UPDATE driver SET nationality = '$new_nationality' WHERE id = '$current_id'");
        $stmt->execute();
        session_regenerate_id();
        $_SESSION['_nationality'] = $_POST['nationality'];
        include('update.php');
        header('Location:../index.php');
    }

    

    header('Location:../index.php');
    
?>