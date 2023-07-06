<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insights</title>
    <link rel="stylesheet" href="../stylesheets/styles.css">
</head>
<body>
    <div id="top-margin">
        <h1>Get Fast Free <br> Listening Insights</h1>
    </div>
    <?php
        include 'nav.html';
        include "../PRIVATE/DBInfo.php";
    ?>
    <div id="sub-insights-content">
        <img src="../images/knowledge.png" alt="Picture of a man with a lightbulb" id="knowledge">
        <div id="iheading-container">
            <?php
            // get the posted information
            $a_or_t = stripcslashes($_POST['aort']);
            $time_frame = stripcslashes($_POST['time-frame']);
            
            // get rid of the underscore stuff in the time frame
            if($time_frame == "short_term"){
                $time_frame = "short";
            } 
            else if($time_frame == "medium_term"){
                $time_frame = "medium";
            }
            else if($time_frame == "long_term"){
                $time_frame = "long";
            }
            print("<h1 id='insights-header'>Todays data for $a_or_t in the $time_frame term.</h1>");
            ?>
        </div>
        <div id="table-container">
        <?php
             // make a DB connection
             $DBConnect = mysqli_connect($IP, $username, $password, $SchemaName);
                    
             // If there isn't a connection, let the admin know
             if($DBConnect == false){
                 print("Unable to connect to the database" + mysqli_errno($mysqli));
             } else{
                 // setup the table name
                 $TableName = "$a_or_t"."_"."$time_frame";

                 // Need to run a query to see if data already exists for today's date
                 $todays_date = stripcslashes(date("Y-m-d"));

                 $CheckQuery = "SELECT * FROM $TableName WHERE intake_date = '$todays_date'";
                 $QueryResult = mysqli_query($DBConnect, $CheckQuery);

                 if($QueryResult == false){
                     print("Sorry, something went wrong. Try again. <br>");
                     print($DBConnect->error);
                 }

                 if(mysqli_num_rows($QueryResult) > 0){
                    print("<h2 id='table-h2'> Sorry, there's already data for $a_or_t in the $time_frame term for today</h2> <br>");
                    print("<h2 id='table-h2'> Here's todays data:</h2> <br>");
                    // print today's data
                    // for tracks
                    if($a_or_t == "tracks"){
                        // Getting all the data sorted by intake date.
                        $prevDate = "";
                        $tableNum = -1;
                        $cell = 0;
                        $data = array();
                        $data[0] = array();
                        while($Row = mysqli_fetch_assoc($QueryResult)){
                            $currDate = $Row['intake_date'];
                            if($prevDate == $currDate){
                                $data[$tableNum][$cell] = "<tr><td>{$Row['rank']}</td> 
                                <td>{$Row['name']}</td> <td>{$Row['artist']}</td> <td>{$Row['release_date']}</td> 
                                <td>{$Row['popularity']}</td></tr>";
                                $cell += 1;
                            } else{
                                $tableNum += 1;
                                $cell = 0;
                                
                                $data[$tableNum] = array();
                                $data[$tableNum][$cell] = $currDate;
                                $cell += 1;

                                $data[$tableNum][$cell] = "<tr><td>{$Row['rank']}</td> 
                                <td>{$Row['name']}</td> <td>{$Row['artist']}</td> <td>{$Row['release_date']}</td> 
                                <td>{$Row['popularity']}</td></tr>";
                                $cell += 1;
                            }
                            $prevDate = $currDate;
                        }
                        //$str = implode_all("<br>", $data);
                        //print("$str");

                        // Now we need to take this data, iterate through it, and output many nice tables (ideally)
                        // Will use nested for loops to hit each node
                        for($i = 0; $i < count($data); $i++){
                            $currDate = $data[$i][0];
                            print("<h3 id='table-h2'> Insights from date $currDate</h3>");
                            print("<table id= 'myTable'>");
                            print("<th>Rank</th> <th>Name</th> <th>Artist</th> <th>Release Date</th> 
                            <th>Popularity (1-100)</th><tr>");
                            for($j = 1; $j < count($data[$i]); $j++){
                                print($data[$i][$j]);
                            }
                            print("</table> <br> <br>");
                        }
                    }
                    // for artists
                    else if($a_or_t == "artists"){
                        // Getting all the data sorted by intake date.
                        $prevDate = "";
                        $tableNum = -1;
                        $cell = 0;
                        $data = array();
                        $data[0] = array();
                        while($Row = mysqli_fetch_assoc($QueryResult)){
                            $currDate = $Row['intake_date'];
                            if($prevDate == $currDate){
                                $data[$tableNum][$cell] = "<tr><td>{$Row['rank']}</td> 
                                <td>{$Row['name']}</td> <td>{$Row['genre']}</td> <td>{$Row['popularity']}</td></tr>";
                                $cell += 1;
                            } else{
                                $tableNum += 1;
                                $cell = 0;
                                
                                $data[$tableNum] = array();
                                $data[$tableNum][$cell] = $currDate;
                                $cell += 1;

                                $data[$tableNum][$cell] = "<tr><td>{$Row['rank']}</td> 
                                <td>{$Row['name']}</td> <td>{$Row['genre']}</td> <td>{$Row['popularity']}</td></tr>";
                                $cell += 1;
                            }
                            $prevDate = $currDate;
                        }
                        //$str = implode_all("<br>", $data);
                        //print("$str");

                        // Now we need to take this data, iterate through it, and output many nice tables (ideally)
                        // Will use nested for loops to hit each node
                        for($i = 0; $i < count($data); $i++){
                            $currDate = $data[$i][0];
                            print("<h3 id='table-h2'> Insights from date $currDate</h3>");
                            print("<table id= 'myTable'>");
                            print("<th>Rank</th> <th>Name</th> <th>Genre</th> <th>Popularity (1-100)</th><tr>");
                            for($j = 1; $j < count($data[$i]); $j++){
                                print($data[$i][$j]);
                            }
                            print("</table> <br> <br>");
                        }
                    }
                 } else{
                    // ADD THE DATA TO THE DATABASE USING SQL INSERT
                    // FOR ARTISTS
                    if($a_or_t == "artists"){
                        // Step 1: retrieve the posted data from the previous page
                        $rank1 = stripcslashes($_POST['rank1']);
                        $name1 = stripcslashes($_POST['name1']);
                        $genre1 = stripcslashes($_POST['genre1']);
                        $popularity1 = stripcslashes($_POST['popularity1']);

                        $rank2 = stripcslashes($_POST['rank2']);
                        $name2 = stripcslashes($_POST['name2']);
                        $genre2 = stripcslashes($_POST['genre2']);
                        $popularity2 = stripcslashes($_POST['popularity2']);

                        $rank3 = stripcslashes($_POST['rank3']);
                        $name3 = stripcslashes($_POST['name3']);
                        $genre3 = stripcslashes($_POST['genre3']);
                        $popularity3 = stripcslashes($_POST['popularity3']);

                        $rank4 = stripcslashes($_POST['rank4']);
                        $name4 = stripcslashes($_POST['name4']);
                        $genre4 = stripcslashes($_POST['genre4']);
                        $popularity4 = stripcslashes($_POST['popularity4']);

                        $rank5 = stripcslashes($_POST['rank5']);
                        $name5 = stripcslashes($_POST['name5']);
                        $genre5 = stripcslashes($_POST['genre5']);
                        $popularity5 = stripcslashes($_POST['popularity5']);

                        // Step 2: perform 5 insert queries for each row of data
                        $InsertQuery = "INSERT INTO $TableName
                        (`id`, `intake_date`, `rank`, `name`, `genre`, `popularity`)
                        VALUES
                        (NULL, DEFAULT, $rank1, '$name1', '$genre1', $popularity1),
                        (NULL, DEFAULT, $rank2, '$name2', '$genre2', $popularity2),
                        (NULL, DEFAULT, $rank3, '$name3', '$genre3', $popularity3),
                        (NULL, DEFAULT, $rank4, '$name4', '$genre4', $popularity4),
                        (NULL, DEFAULT, $rank5, '$name5', '$genre5', $popularity5);";
                        $QueryResult = mysqli_query($DBConnect, $InsertQuery);

                        if($QueryResult == false){
                            print("Sorry, something went wrong. Try again. <br>");
                            print($DBConnect->error);
                        }
                        else{
                            // Notify the user of successful insert and print out the inserted data
                            print("<h2 id='table-h2'> Success! Here's todays data: </h2> <br>");

                            $SQLSelect = "SELECT * FROM $TableName WHERE 
                            `intake_date` = '$todays_date'";
                            $QueryResult = mysqli_query($DBConnect, $SQLSelect);
                            
                            if($QueryResult == false){
                                print("Sorry, something went wrong with SELECT. Try again. <br>");
                                print($DBConnect->error);
                            }
                            // check to see if there are records in the table
                            if(mysqli_num_rows($QueryResult) > 0){
                                // output results in dynamic table
                                // For artists
                                if($a_or_t == "artists"){
                                    // Getting all the data sorted by intake date.
                                    $prevDate = "";
                                    $tableNum = -1;
                                    $cell = 0;
                                    $data = array();
                                    $data[0] = array();
                                    while($Row = mysqli_fetch_assoc($QueryResult)){
                                        $currDate = $Row['intake_date'];
                                        if($prevDate == $currDate){
                                            $data[$tableNum][$cell] = "<tr><td>{$Row['rank']}</td> 
                                            <td>{$Row['name']}</td> <td>{$Row['genre']}</td> <td>{$Row['popularity']}</td></tr>";
                                            $cell += 1;
                                        } else{
                                            $tableNum += 1;
                                            $cell = 0;
                                            
                                            $data[$tableNum] = array();
                                            $data[$tableNum][$cell] = $currDate;
                                            $cell += 1;

                                            $data[$tableNum][$cell] = "<tr><td>{$Row['rank']}</td> 
                                            <td>{$Row['name']}</td> <td>{$Row['genre']}</td> <td>{$Row['popularity']}</td></tr>";
                                            $cell += 1;
                                        }
                                        $prevDate = $currDate;
                                    }
                                    //$str = implode_all("<br>", $data);
                                    //print("$str");

                                    // Now we need to take this data, iterate through it, and output many nice tables (ideally)
                                    // Will use nested for loops to hit each node
                                    for($i = 0; $i < count($data); $i++){
                                        $currDate = $data[$i][0];
                                        print("<h3 id='table-h2'> Insights from date $currDate</h3>");
                                        print("<table id= 'myTable'>");
                                        print("<th>Rank</th> <th>Name</th> <th>Genre</th> <th>Popularity (1-100)</th><tr>");
                                        for($j = 1; $j < count($data[$i]); $j++){
                                            print($data[$i][$j]);
                                        }
                                        print("</table> <br> <br>");
                                    }
                                }
                            }
                        }
                    }
                    // FOR TRACKS
                    else if($a_or_t == "tracks"){
                        // Step 1: retrieve the posted data from the previous page
                        $rank1 = stripcslashes($_POST['rank1']);
                        $name1 = stripcslashes($_POST['name1']);
                        $artist1 = stripcslashes($_POST['artist1']);
                        $release1 = stripcslashes($_POST['release1']);
                        $popularity1 = stripcslashes($_POST['popularity1']);
                        
                        $rank2 = stripcslashes($_POST['rank2']);
                        $name2 = stripcslashes($_POST['name2']);
                        $artist2 = stripcslashes($_POST['artist2']);
                        $release2 = stripcslashes($_POST['release2']);
                        $popularity2 = stripcslashes($_POST['popularity2']);
                       
                        $rank3 = stripcslashes($_POST['rank3']);
                        $name3 = stripcslashes($_POST['name3']);
                        $artist3 = stripcslashes($_POST['artist3']);
                        $release3 = stripcslashes($_POST['release3']);
                        $popularity3 = stripcslashes($_POST['popularity3']);

                        $rank4 = stripcslashes($_POST['rank4']);
                        $name4 = stripcslashes($_POST['name4']);
                        $artist4 = stripcslashes($_POST['artist4']);
                        $release4 = stripcslashes($_POST['release4']);
                        $popularity4 = stripcslashes($_POST['popularity4']);

                        $rank5 = stripcslashes($_POST['rank5']);
                        $name5 = stripcslashes($_POST['name5']);
                        $artist5 = stripcslashes($_POST['artist5']);
                        $release5 = stripcslashes($_POST['release5']);
                        $popularity5 = stripcslashes($_POST['popularity5']);

                        // Step 2: perform 5 insert queries for each row of data
                        $InsertQuery = "INSERT INTO $TableName
                        (`id`, `intake_date`, `rank`, `name`, `artist`, `release_date`, `popularity`)
                        VALUES
                        (NULL, DEFAULT, $rank1, '$name1', '$artist1', '$release1', $popularity1),
                        (NULL, DEFAULT, $rank2, '$name2', '$artist2', '$release2', $popularity2),
                        (NULL, DEFAULT, $rank3, '$name3', '$artist3', '$release3', $popularity3),
                        (NULL, DEFAULT, $rank4, '$name4', '$artist4', '$release4', $popularity4),
                        (NULL, DEFAULT, $rank5, '$name5', '$artist5', '$release5', $popularity5);";
                        $QueryResult = mysqli_query($DBConnect, $InsertQuery);

                        if($QueryResult == false){
                            print("Sorry, something went wrong. Try again. <br>");
                            print($DBConnect->error);
                        }
                        else{
                            // Notify the user of successful insert and print out the inserted data
                            print("<h2 id='table-h2'> Success! Here's todays data: </h2> <br>");
                            
                            $SQLSelect = "SELECT * FROM $TableName WHERE 
                            `intake_date` = '$todays_date'";
                            $QueryResult = mysqli_query($DBConnect, $SQLSelect);
                            
                            if($QueryResult == false){
                                print("Sorry, something went wrong with SELECT. Try again. <br>");
                                print($DBConnect->error);
                            }
                            // check to see if there are records in the table
                            if(mysqli_num_rows($QueryResult) > 0){
                                // Getting all the data sorted by intake date.
                                $prevDate = "";
                                $tableNum = -1;
                                $cell = 0;
                                $data = array();
                                $data[0] = array();
                                while($Row = mysqli_fetch_assoc($QueryResult)){
                                    $currDate = $Row['intake_date'];
                                    if($prevDate == $currDate){
                                        $data[$tableNum][$cell] = "<tr><td>{$Row['rank']}</td> 
                                        <td>{$Row['name']}</td> <td>{$Row['artist']}</td> <td>{$Row['release_date']}</td> 
                                        <td>{$Row['popularity']}</td></tr>";
                                        $cell += 1;
                                    } else{
                                        $tableNum += 1;
                                        $cell = 0;
                                        
                                        $data[$tableNum] = array();
                                        $data[$tableNum][$cell] = $currDate;
                                        $cell += 1;

                                        $data[$tableNum][$cell] = "<tr><td>{$Row['rank']}</td> 
                                        <td>{$Row['name']}</td> <td>{$Row['artist']}</td> <td>{$Row['release_date']}</td> 
                                        <td>{$Row['popularity']}</td></tr>";
                                        $cell += 1;
                                    }
                                    $prevDate = $currDate;
                                }
                                //$str = implode_all("<br>", $data);
                                //print("$str");

                                // Now we need to take this data, iterate through it, and output many nice tables (ideally)
                                // Will use nested for loops to hit each node
                                for($i = 0; $i < count($data); $i++){
                                    $currDate = $data[$i][0];
                                    print("<h3 id='table-h2'> Insights from date $currDate</h3>");
                                    print("<table id= 'myTable'>");
                                    print("<th>Rank</th> <th>Name</th> <th>Artist</th> <th>Release Date</th> 
                                    <th>Popularity (1-100)</th><tr>");
                                    for($j = 1; $j < count($data[$i]); $j++){
                                        print($data[$i][$j]);
                                    }
                                    print("</table> <br> <br>");
                                }
                            }
                        }
                    }
                 }
                 mysqli_free_result($QueryResult);
             }
             mysqli_close($DBConnect);
         ?>
         </div>
</body>
</html>