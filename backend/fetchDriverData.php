<?php
    session_start();
    session_regenerate_id();


    // GET the data from f1 drivers JSON file
    $curl = curl_init();

    // Set multible Options for cURL transfer API
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://ergast.com/api/f1/drivers.json?=123?limit=100&offset=400',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
                
    // cURL session
    $fetchAPIData = curl_exec($curl);

            //if curl can't connect/download
    if($fetchAPIData === false){
        echo '<p>couldnt connect curlserver file!</p>';
        $_SESSION['errorFetchAPI'] = '<p>couldnt connect curlserver file!</p>';
        header('Location:../index.php');
    }
                        
    // to check the transmitted raw data uncomment! 
    //echo $fetchAPIData;

    // After decode JSON-String to php Object the Data is prepared for transfer
    $response = json_decode($fetchAPIData, true);
    $driverId = $url = $givenName = $familyName = $dateOfBirth = $nationality = [];

            

    // Load Database scripts
    include ('DatabaseAccessProps.php');
            
    // connect the Database
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if(mysqli_connect_errno()){
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
                    
    // Insert in the Database.
    if ($stmt = $con->prepare("REPLACE INTO driver (
                                                    driverId, 
                                                    url,
                                                    givenName,
                                                    familyName,
                                                    dateOfBirth,
                                                    nationality) 
                                                    VALUES (?,?,?,?,?,?)")){
        $stmt->bind_param("ssssss", $driverId, $url, $givenName, $familyName, $dateOfBirth, $nationality);
        foreach($response['MRData']['DriverTable']['Drivers'] as $row){
            $driverId = $row['driverId'];
            $url = $row['url'];
            $givenName = $row['givenName'];
            $familyName = $row['familyName'];
            $dateOfBirth = $row['dateOfBirth'];
            $nationality = $row['nationality'];
            $stmt->execute();
        }
    }

    $drArray = [];
    if ($stmt = $con->prepare("SELECT id, driverId, url, givenName, familyName, dateOfBirth, nationality FROM driver")){
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $_SESSION['id'] = $row['id'];
            array_push($drArray, "<tr><th style='font-weight: normal;'>" . $row['driverId'] . "</th> 
				<th style='font-weight: normal;'>" . $row['givenName'] . " " . $row['familyName'] . "</th>
				<th style='font-weight: normal;'>" .  str_replace('-','.',date("d-m-Y", strtotime($row['dateOfBirth']))) . "</th>
				<th style='font-weight: normal;'>" . $row['nationality'] . "</th>
				<th style='font-weight: normal;'><a href=" . $row['url'] . ">Info</a></th>
                <th>

                <button style='border: none; cursor: pointer; background-color: #383838'>
                <a href='edit_field.php?id=" . $row['id'] . "'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                </svg>
                </a>
                </button>
                
                </th>
                <th><button type='button' class='btn btn-primary btn-sm' style='background-color: #383838;color: white; padding: 0.45em; border: solid white; float: left; margin-top: 0em;' required><a style='color: white; text-decoration: none;' href='backend/delete.php?id=" . $row['id'] . "'>Delete</a></button></th>
				</tr>");
        }
    } else {
        echo("No data found!");
    }

	$tableHeader = ("<tr>" . 
            '<th scope="col" style="width: 50px; padding-bottom: 20px;">ID</th>' . 
            '<th scope="col" style="width: 250px; padding-bottom: 20px;">Driver Name</th>' .
			'<th scope="col" style="width: 250px; padding-bottom: 20px;">Birthday</th>' .
			'<th scope="col" style="width: 250px; padding-bottom: 20px;">Nationality</th>' .
			'<th scope="col" style="width: 250px; padding-bottom: 20px;">More Info</th>' .
            '<th scope="col" style="width: 100px; padding-bottom: 20px;"></th>' .
            '<th scope="col" style="width: 100px; padding-bottom: 20px;"></th>' .
			"</tr>");

    // Parameter that goes to index.php
    $_SESSION['tableHeader'] = $tableHeader;
    $_SESSION['result'] = $drArray;
    $_SESSION['title'] = 'Drivers';
    

    header('Location:../index.php');

            
    
?>