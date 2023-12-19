<?php
    session_start();
    session_regenerate_id();


            // GET the data from f1 drivers JSON file
            $curl = curl_init();

            // Set multible Options for cURL transfer API
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://ergast.com/api/f1/drivers.json?=123?limit=100',
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
        
            //print_r($driver);
                    
            // Insert in the Database.
            if ($stmt = $con->prepare("REPLACE INTO driver (driverId, 
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

/*
        if ($stmt = $con->prepare("INSERT INTO driverstandings (position, 
                                                                positionText, 
                                                                points, 
                                                                wins, 
                                                                dept) 
                                                                VALUES (?,?,?,?,?)")){
            $stmt->bind_param("iiiii", $position, $positionText, $points, $wins, $dept);
            foreach($driverStandingsValues["DriverStandings"] as $row){
                $position = $row;
                $positionText = $row;
                $points = $row;
                $wins = $row;
                $dept = $row;
                $stmt->execute();
            }
                                                                
            $DATA1 = $stmt->get_result();
        }
        
        if ($stmt__ = $con->prepare("INSERT INTO driver (driverId, 
                                                       url, 
                                                       givenName, 
                                                       familyName, 
                                                       dateOfBirth,
                                                       nationality
                                                       dept) 
                                                       VALUES (?,?,?,?,?,?,?)")){
            $stmt__->bind_param("ssssssi", $driverId, $url, $givenName, $familyName, $dateOfBirth, $nationality, $dept);
            foreach($driverStandingsValues['DriverStandings']['Driver'] as $row){
                $driverId = $row['driverId'];
                $url = $row['url'];
                $givenName = $row['givenName'];
                $familyName = $row['familyName'];
                $dateOfBirth = $row['dateOfBirth'];
                $nationality = $row['nationality'];
                $dept = $row['dept'];
                $stmt__->execute();
            }    

            $DATA3 = $stmt__->get_result();
        }

        if ($stmt___ = $con->prepare("INSERT INTO constructors (constructorId, 
                                                             url, 
                                                             name, 
                                                             dept) 
                                                             VALUES (?,?,?,?)")){
            $stmt___->bind_param("sssi", $constructorId, $url, $name, $dept);
            foreach($driverStandingsValues['DriverStandings']['Constructors'] as $row){
                $constructorId = $row['constructorId'];
                $url = $row['url'];
                $name = $row['name'];
                $dept = $row['dept'];
                $stmt___->execute();
            }
            
            $DATA4 = $stmt___->get_result();
        }

		array_push($DataArray, $stmt);
        array_push($DataArray, $stmt_);
        array_push($DataArray, $stmt__);
        array_push($DataArray, $stmt___);
        $drivers_array = [];
        $stmt = $stmt_ = $stmt__ = $stmt___;
        var_dump($stmt, $stmt_, $stmt__, $stmt___);

    }
*/

        $drArray = [];
        if ($stmt = $con->prepare("SELECT driverId, url, givenName, familyName, dateOfBirth, nationality FROM driver")){
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                array_push($drArray, "<tr>" .
                        '<th style="font-weight: normal;">' . $row['driverId'] . "</th>" . 
						'<th style="font-weight: normal;">' . $row['givenName'] . " " . $row['familyName'] . "</th>" .
						'<th style="font-weight: normal;">'.  str_replace('-','.',date("d-m-Y", strtotime($row['dateOfBirth']))) . "</th>" .
						'<th style="font-weight: normal;">' . $row['nationality'] . "</th>" .
						'<th style="font-weight: normal;"><a href="' . $row['url'] . '">Info</a></th>
                        <th><input for="form-control" name="edit" type="submit" value="Edit" class="btn btn-primary btn-sm" style="background-color: #383838;color: white; padding: 0.75em; border: solid white; float: right; margin-top: 1.2em;" required></input></th>
                        <th><input for="form-control" name="delete" type="submit" value="Delete" class="btn btn-primary btn-sm" style="background-color: #383838;color: white; padding: 0.75em; border: solid white; float: left; margin-top: 1.2em;" required></input></th>' .
						"</tr>");
            }
            } else {
                echo("No data found!");
            }

			$title = ("<tr>" . 
                    '<th scope="col" style="width: 50px; padding-bottom: 20px;">ID</th>' . 
                    '<th scope="col" style="width: 250px; padding-bottom: 20px;">Driver Name</th>' .
					'<th scope="col" style="width: 250px; padding-bottom: 20px;">Birthday</th>' .
					'<th scope="col" style="width: 250px; padding-bottom: 20px;">Nationality</th>' .
					'<th scope="col" style="width: 250px; padding-bottom: 20px;">More Info</th>' .
                    '<th scope="col" style="width: 100px; padding-bottom: 20px;"></th>' .
                    '<th scope="col" style="width: 100px; padding-bottom: 20px;"></th>' .
					"</tr>");

            $_SESSION['tableHeader'] = $title;
            $_SESSION['result'] = $drArray;

        header('Location:../index.php');

            
    
?>