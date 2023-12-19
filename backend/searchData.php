<?php
    session_start();
    session_regenerate_id();

    include('DatabaseAccessProps.php');
    include_once('connectDb.php');

    if(isset($_POST['search-form'])){

        // check if searched string is a date format.
        // if true, reformat searched string to readable format
        if(preg_match( "/[0-9][0-9](.|-)[0-9][0-9](.|-)[0-9][0-9][0-9][0-9]/", $_POST['search-form']) === 1){
            $date = new DateTime($_POST['search-form']);
            $string = $date->format('Y-m-d');
            $search =  "%" . $con->real_escape_string($string) . "%";
            
        } else {
            $search = "%" . $con->real_escape_string($_POST['search-form']) . "%";
        }

        $table = 'driver';
        $stmt = $con->prepare("SELECT * FROM driver WHERE id LIKE '%$search%'
                                                       OR driverId LIKE '%$search%'
                                                       OR url LIKE '%$search%'
                                                       OR givenName LIKE '%$search%'
                                                       OR familyName LIKE '%$search%'
                                                       OR dateOfBirth LIKE '%$search%'
                                                       OR nationality LIKE '%$search%'");
        $stmt->execute();
        $result = $stmt->get_result();
  

        $searchArray = [];
        while($row = $result->fetch_assoc()){
            array_push($searchArray, "<tr><th style='font-weight: normal;'>" . $row['driverId'] . "</th> 
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
        session_regenerate_id();
        $_SESSION['tableHeader'] = $tableHeader;
        $_SESSION['result'] = $searchArray;
        $_SESSION['title'] = 'Drivers ' . $_POST['search-form'];


        header('Location:../index.php');

    } else {
        $_SESSION['alertNoSearchInput'] = 1;
    }
?>