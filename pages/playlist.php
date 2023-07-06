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
    ?>
    <div id="playlist-content">
        <img src="../images/playlist.png" alt="Picture of a musical note" id="music-note">
        <div id="heading-container">
            <h1 id="playlist-header">Create a Custom Playlist with your Favorite Tracks!</h1>
        </div>
        <div id="form-container">
            <form name="myForm" action="listresult.php" id="playlist-form" onsubmit="return storeInputs()" method="POST">
                <div id="user-select-container">
                    <h2 id="user-head">Select a User:</h2>
                    <select name="user" id="user" required> 
                        <option value="Ben">Ben Platt</option>
                    </select>
                    <h2 id="validate"> The User that the playlist is created for </h2>
                    <h2 id="validate"> Only Available User = Developer </h2>
                </div>
                <div id="time-frame-container">
                    <h2 id="time-head">What Time Frame?</h2>
                    <select name="time-frame" id="time-frame">
                        <option value="short-term">Short Term</option>
                        <option value="medium-term">Medium Term</option>
                        <option value="long-term">Long Term</option>
                    </select>
                    <h2 id="validate"> This is the time frame that data about "favorite tracks" is gathered from </h2>
                    <h2 id="validate"> Short Term = Last 4 Weeks </h2>
                    <h2 id="validate"> Medium Term = Last 6 Months </h2>
                    <h2 id="validate"> Short Term = Last Several Years </h2>
                </div>
                <div id="track-len-container">
                    <h2 id="track-head">How Many Tracks? Limit 50</h2>
                    <input type="number" name="number" id="num-input">
                    <h2 id="validate"> How many tracks will get put in your playlist </h2>
                </div>
                <button type="submit" id="submit-button">CREATE PLAYLIST!</button>    
            </form>
        </div>
    </div>
</body>
</html>
