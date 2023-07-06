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
        // secret tokens
        include '../PRIVATE/tokens.php'
    ?>
    <div id="sub-insights-content">
        <img src="../images/knowledge.png" alt="Picture of a man with a lightbulb" id="knowledge">
        <div id="iheading-container">
            <h1 id="insights-header">Great! Let's Gather Some Information.</h1>
        </div>
        <div id="form-container">
                <div id="authorize-container">
                    <h2 id="user-head">First, click this button to authorize the app:</h2>
                    <?php
                    // REFERENCE: https://stackoverflow.com/questions/65866625/spotify-oauth2-with-php-curl-how-to-get-authorization-code
                    // AUTH WORKFLOW STEP 1: REDIRECT TO SPOTIFY SITE    
                        $data = array(
                            'client_id'     => $client_id,
                            'redirect_uri'  => $redir_cloud_insightsURI,
                            'scope'         => 'user-top-read',
                            'response_type' => 'code',
                        );
                        
                        $oauth_url = 'https://accounts.spotify.com/authorize?' . http_build_query( $data );
			?>

                    <a href="<?php echo $oauth_url; ?>" id="auth-button">AUTHORIZE</a>

                    <?php
                    // AUTH WORKFLOW STEP 2: EXCHANGE CODE IN THE URL FOR A TOKEN.
                    // USING A POST REQUEST TO THE API TOKEN ENDPOINT
                    // This only executes if there is a code set.
                    if ( isset( $_GET['code'] ) && ! isset( $_SESSION['spotify_access'] ) ) {
                        $data = array(
                            'redirect_uri' => $redir_cloud_insightsURI,
                            'grant_type'   => 'authorization_code',
                            'code'         => $_GET['code'],
                        );
                        $ch = curl_init();
                        curl_setopt( $ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
                        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
                        curl_setopt( $ch, CURLOPT_POST, 1 );
                        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $data ) );
                        curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Authorization: Basic ' . base64_encode( $client_id . ':' . $client_secret ) ) );
                        
                        // Exchanging our code for an access token! This will be used to get our lovely data.
                        $result = curl_exec( $ch );
                        if(curl_errno($ch)){
                            echo 'Curl error: '.curl_error($ch);
                        }
                        $result = json_decode($result);
                    	
                        curl_close( $ch );
                        // Starting a session in order to save our token for future use
                        session_start();
                        $_SESSION["token"] = $result->access_token;
                    }
                    ?>

                    <h2 id="validate"> This is required for this feature to function!</h2>
                    <h2 id="validate"> Spotify needs to know that you trust the app.</h2>
                    <h2 id="validate"> After you authorize, please complete the rest of this form.</h2>
                </div>
            <form name="myForm" action="tod-result.php" id="playlist-form" method="POST">
                <div id="user-select-container">
                    <h2 id="user-head">Select a User:</h2>
                    <select name="user" id="user" required> 
                        <option value="Ben">Ben Platt</option>
                    </select>
                    <h2 id="validate"> The User that the Data is Gathered for</h2>
                    <h2 id="validate"> Only Available User = Developer </h2>
                </div>
                <div id="track-len-container">
                    <h2 id="track-head">Artists or tracks?</h2>
                    <select name="a-or-t" id="time-frame">
                        <option value="artists">Artists</option>
                        <option value="tracks">Tracks</option>
                    </select>
                    <h2 id="validate"> This will gather data on favorite artists or tracks. </h2>
                </div>
                <div id="time-frame-container">
                    <h2 id="time-head">What Time Frame?</h2>
                    <select name="time-frame" id="time-frame">
                        <option value="short_term">Short Term</option>
                        <option value="medium_term">Medium Term</option>
                        <option value="long_term">Long Term</option>
                    </select>
                    <h2 id="validate"> This is the time frame that data is gathered from </h2>
                    <h2 id="validate"> Short Term = Last 4 Weeks </h2>
                    <h2 id="validate"> Medium Term = Last 6 Months </h2>
                    <h2 id="validate"> Short Term = Last Several Years </h2>
                </div>
                <button type="submit" id="submit-button">GET DATA!</button>    
            </form>
        </div>
    </div>
</body>
</html>