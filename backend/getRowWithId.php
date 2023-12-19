<?php
    session_regenerate_id();
    
    include("DatabaseAccessProps.php");
    include("connectDb.php");

    $stmt = $con->prepare('SELECT id, driverId, url, givenName, familyName, dateOfBirth, nationality  FROM driver WHERE BINARY id = ?');
    $stmt->bind_param('s', $_GET['id']);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0) {
        $stmt->bind_result($id, $driverId, $url, $givenName, $familyName, $dateOfBirth, $nationality);
        $stmt->fetch();
        $dateOfBirth = str_replace('-','.',date("d-m-Y", strtotime($row['dateOfBirth'])));
        header('Location:../edit_field.php');
        $_SESSION['id_'] = $id;
        $_SESSION['driverId_'] = $driverId;
        $_SESSION['url_'] = $url;
        $_SESSION['givenName_'] = $givenName;
        $_SESSION['familyName_'] = $familyName;
        $_SESSION['dateOfBirth_'] = $dateOfBirth;
        $_SESSION['nationality_'] = $nationality;
    }
?>