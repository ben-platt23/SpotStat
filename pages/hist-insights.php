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
    ?>
    <div id="sub-insights-content">
        <img src="../images/knowledge.png" alt="Picture of a man with a lightbulb" id="knowledge">
        <div id="iheading-container">
            <h1 id="insights-header">Great! Let's Gather Some Information.</h1>
        </div>
        <div id="form-container">
            <form name="myForm" action="hist-result.php" id="playlist-form" method="POST">
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
                        <option value="short">Short Term</option>
                        <option value="medium">Medium Term</option>
                        <option value="long">Long Term</option>
                    </select>
                    <h2 id="validate"> This is the time frame that data about "favorite tracks" is gathered from </h2>
                    <h2 id="validate"> Short Term = Last 4 Weeks </h2>
                    <h2 id="validate"> Mediun Term = Last 6 Months </h2>
                    <h2 id="validate"> Short Term = Last Several Years </h2>
                </div>
                <button type="submit" id="submit-button">GET DATA!</button>    
            </form>
        </div>
    </div>
</body>
</html>