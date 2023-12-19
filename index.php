<?php
	session_start();
	session_regenerate_id();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>App</title>
        <meta charset="UTF-8">
   		<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Bootstrap demo</title>
   		<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Bootstrap demo</title>
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
		<style>
			body{
    			background-color: rgb(61, 59, 57);
			}

			.mb-2{
				border-radius: 10px;
				border: 1px solid black;
				box-shadow: 3px 3px 3px rgb(22, 22, 22);
			}
		</style>
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
				session_regenerate_id();
				echo('<h2 style="padding: 30px;">') . $_SESSION['title'] . ('</h2><br><br>'); 
			?>
			<form class="search-form" method="POST" action="backend/searchData.php" style="margin-top: 0.5em; text-align:center;">
				<label value="Suche" style="font-weight: bold;">Suche: </label>
				<input for="search-form" name='search-form' type="text" id="search-form" style="width: 500px; border-radius: 10px;" size="70">
				<input for="search-form" name='searchbutton' type="submit" value="Find"class="btn btn-primary btn-sm" style="background-color: #383838;color: white; padding: 0.25em; border: solid white; margin-bottom: 0.25em; width: 100px; border-radius: 10px; border-color: whitesmoke;">
		</form><br><br>
			<table class="table table-striped">
				<?php
					session_regenerate_id();

					if(isset($_SESSION['id'], $_SESSION['tableHeader'], $_SESSION['result'])){
						$id = $_SESSION['id'];
						$tableHeader = $_SESSION['tableHeader'];
						$result = $_SESSION['result'];

						echo($tableHeader);
						
						foreach($result as $item){
							echo($item);
						}
					} else {
						echo 'Results have not been successfully send to main Page. Please Click "Show All" to load Results!';
					}
					if(isset($_SESSION['alertNoSearchInput'])){
						echo("Please input searchable text in the Textbar above!");
					}
				?>
			</table>
			<br><br>
			<form class="form-control" method="GET" action="backend/fetchDriverData.php">
				<input for="form-control" name='submit' type="submit" value="Download from ergast" class="btn btn-primary btn-sm" style="background-color: #383838;color: white; padding: 0.75em; border: solid white; float: right; margin-top: 1.2em;" required></input>
			</form>
			<button type='button' class='btn btn-primary btn-sm' style='background-color: #383838;color: white; padding: 0.45em; border: solid white; float: left; margin-top: 0em;' required><a style='color: white; text-decoration: none; margin-bottom: 2.2em; padding: 0.75em;' href='backend/update.php'>Refresh</a></button>
			<br><br>
		</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

</html>