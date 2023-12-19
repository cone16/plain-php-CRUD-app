<?php
    session_start();
    session_regenerate_id();
?>
<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
    <div style="display: block; position:absolute; height: 4em; margin: 0 auto; width: 100%;background: linear-gradient(45deg, rgb(177, 70, 16), black); color: white;">
				<h2 style="margin-top: 0.75em; margin-left: 1em;">Formular 1 DataVerse</h2><br><br><br><br>
			</div>
			<br>
			<br>
			<br>
			<br>
		<div class="container"><br><br><br>
		<div class="mb-2" style="padding: 25px; background-color: whitesmoke;">
        <?php
            include('backend/getRowWithId.php');
            session_regenerate_id();
        ?>
            <form class="form-control" method="POST" action='/backend/edit.php' name="form_login">
                <label>id</label>
                <input class="form-control" value="<?= $_SESSION['id_'] ?>" type="textfield" name="id" style="width: 100px;"></input><br>
                <label>driverId</label>
                <input class="form-control" value='<?= $_SESSION['driverId_'] ?>' type="textfield" name="driverId"></input><br>
                <label>url</label>
                <input class="form-control" value='<?= $_SESSION['url_'] ?>' type="textfield" name="url" ></input><br>
                <label>Given Name</label>
                <input class="form-control" value='<?= $_SESSION['givenName_'] ?>' type="textfield" name="givenName" ></input><br><br>
                <label>family Name</label>
                <input class="form-control" value='<?= $_SESSION['familyName_'] ?>' type="textfield" name="familyName" ></input><br>
                <label>dateOfBirth</label>
                <input class="form-control" value='<?= $_SESSION['dateOfBirth_'] ?>' type="textfield" name="dateOfBirth" ></input><br>
                <label>nationality</label>
                <input class="form-control" value='<?= $_SESSION['nationality_'] ?>' type="textfield" name="nationality" ></input><br>	
                <a href="index.php" style="text-decoration: none;"><input value="cancel" name="cancel" class="btn btn-primary btn-sm" style="background-color: #383838; color: white; padding: 1em; border: none;" required></input></a>
                <a href="backend/edit.php" style="text-decoration: none;"><input type="submit" name="save" value="Save changes" class="btn btn-primary btn-sm" style="background-color: #383838;color: white; padding: 1em; border: none; float: right; bottom: 4em;" required></input></a>
            </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>


    