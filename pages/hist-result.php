<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist</title>
    <link rel="stylesheet" href="../stylesheets/styles.css">
</head>
<body>
    <div id="top-margin">
        <h1>Playlist <br> Generator</h1>
    </div>
    <?php
        include 'nav.html';
        include "../PRIVATE/DBInfo.php";
    ?>
    <div id="playlist-content">
        <img src="../images/knowledge.png" alt="Picture of a man with a lightbulb" id="knowledge">
        <div id="iheading-container">
            <h1 id="playlist-header">Your Historical Listening Habits!</h1>
        </div>
        <div id="table-container">
            <?php
            // function to return 2d array as a single string, helpful for debugging.
            function implode_all( $glue, $arr ){
                if( is_array( $arr ) ){
              
                  foreach( $arr as $key => &$value ){
              
                    if( @is_array( $value ) ){
                      $arr[ $key ] = implode_all( $glue, $value );
                    }
                  }
              
                  return implode( $glue, $arr );
                }
              
                // Not array
                return $arr;
            }
            // NEW
            // make a DB connection
            $DBConnect = mysqli_connect($IP, $username, $password, $SchemaName);
                
            // If there isn't a connection, let the admin know
            if($DBConnect == false){
                print("Unable to connect to the database" + mysqli_errno($mysqli));
            } else{
                // get the posted information
                $a_or_t = stripcslashes($_POST['a-or-t']);
                $time_frame = stripcslashes($_POST['time-frame']);

                // setup the table name
                $TableName = "$a_or_t"."_"."$time_frame";

                // order by name
                $orderParam = "intake_date";
                
                // ORDER BY DOESN'T WORK IN PHP
                // BUT IT DOES IN THE MYSQL WORKBENCH
                // I'M GONNA CRY AHHHHHHH HELPPPPPPPPPP
                $SQLSelect = "SELECT * FROM $TableName
                ORDER BY intake_date DESC";

                $QueryResult = mysqli_query($DBConnect, $SQLSelect);

                if($QueryResult == false){
                    print("Sorry, something went wrong. Try again. <br>");
                    print($DBConnect->error);
                }

                // ***********************************
                
                // wild card selection for *
                //$SQLstring = "select * from $TableName";
                //$QueryResult = mysqli_query($DBConnect, $SQLstring);

                // check to see if there are records in the table
                if(mysqli_num_rows($QueryResult) > 0){
                    // output results in dynamic table
                    // For artists
                    if($a_or_t == "artists"){
                        print("<h2 id='table-h2'>Favorite artists in $time_frame term </h2> <br>");
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
                    // for tracks
                    else if($a_or_t == "tracks"){
                        print("<h2 id='table-h2'>Favorite Tracks in $time_frame term </h2> <br>");
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
                    
                } else{
                    print("There are no results to display");
                }
                mysqli_free_result($QueryResult);
            }
            // close connection
            mysqli_close($DBConnect);
            /*
            //ORIGINAL
            // make a DB connection
            $DBConnect = mysqli_connect($IP, $username, $password, $SchemaName);
                
            // If there isn't a connection, let the admin know
            if($DBConnect == false){
                print("Unable to connect to the database" + mysqli_errno($mysqli));
            } else{
                // get the posted information
                $a_or_t = stripcslashes($_POST['a-or-t']);
                $time_frame = stripcslashes($_POST['time-frame']);

                // setup the table name
                $TableName = "$a_or_t"."_"."$time_frame";
                

                $SQLSelect = "SELECT * FROM $TableName
                ORDER BY `id` DESC LIMIT 150";

                $QueryResult = mysqli_query($DBConnect, $SQLSelect);
                $AffectedRows = mysqli_affected_rows($DBConnect);

                if($QueryResult == false){
                    print("Sorry, something went wrong. Try again. <br>");
                    print($DBConnect->error);
                }

                // ***********************************
                
                // wild card selection for *
                $SQLstring = "select * from $TableName";
                $QueryResult = mysqli_query($DBConnect, $SQLstring);

                // check to see if there are records in the table
                if(mysqli_num_rows($QueryResult) > 0){
                    // output results in dynamic table
                    // For artists
                    if($a_or_t == "artists"){
                        print("<h2 id='table-h2'>Favorite artists in $time_frame term </h2> <br>");
                        print("<table id='myTable'>");
                        print("<tr><th>ID</th> <th>Intake Date</th> <th>Rank</th> <th>Name</th> <th>Genre</th> 
                        <th>Popularity</th><tr>");
                        while($Row = mysqli_fetch_assoc($QueryResult)){
                        // printing the results into the table
                        print("<tr> <td>{$Row['id']}</td> <td>{$Row['intake_date']}</td> <td>{$Row['rank']}</td> 
                        <td>{$Row['name']}</td> <td>{$Row['genre']}</td> <td>{$Row['popularity']}</td> </tr>");
                        }
                        print("</table>");
                    }
                    else if($a_or_t == "tracks"){
                        print("Favorite tracks in $time_frame term");
                        print("<table id= myTable'>");
                        print("<tr><th>ID</th> <th>Intake Date</th> <th>Rank</th> <th>Name</th> <th>Artist</th> 
                        <th>Release Date</th> <th>Popularity</th><tr>");
                        while($Row = mysqli_fetch_assoc($QueryResult)){
                        // printing the results into the table
                        print("<tr> <td>{$Row['id']}</td> <td>{$Row['intake_date']}</td> <td>{$Row['rank']}</td> 
                        <td>{$Row['name']}</td> <td>{$Row['artist']}</td> <td>{$Row['release_date']}</td> <td>{$Row['popularity']}</td></tr>");
                        }
                        print("</table>");
                    }
                    
                } else{
                    print("There are no results to display");
                }
                mysqli_free_result($QueryResult);
            }
            // close connection
            mysqli_close($DBConnect);
            */
            ?>
        </div>
    </div>
</body>
</html>