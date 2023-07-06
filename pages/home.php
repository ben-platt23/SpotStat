<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../stylesheets/styles.css">
</head>
<body>
    <div id="top-margin">
        <h1>SpotStat: Personal <br>
            Spotify Statistics
        </h1>
    </div>
    <?php
        include 'nav.html';
    ?>
    <div id="panel-top">
        <img src="../images/problem_solving.png" alt="An outline of a man with a question mark in his head" id="problem-solving">
        <div id="welcome-text"> 
            <h3>Welcome!</h3> Have you ever wanted to have on-demand insights into your listening habits
            on Spotify? With SpotStat, you can use the power of Spotify's free API to
            create custom playlists of your most recently played music. You even
            use it to view current and historical data on your listening habits.
            <br> <br>
            Give it a try!
        </div>
    </div>
    <div id="panel-middle">
        <img src="../images/SoundWaves.png" alt="Image of a graph of sound waves" id="soundwaves">
        <div id="playlist-text"> 
            <h3>Playlist</h3> With this innovative feature, you can create a custom playlist
            of your most recently played songs (up to 50!). You can even choose whether
            the songs will be  picked from a timeframe of short term, medium term, or long term.
        </div>
    </div>
    <div id="panel-bottom">
        <img src="../images/lightbulb.png" alt="Image of a lit lightbulb" id="lightbulb">
        <div id="insights-text"> 
            <h3>Insights</h3> On this page you can request short/medium/long term data on your 
            top 5 artists and songs. On request, this data is added to an internal database so that you 
            can view trends in your own listening habits. These listening habits can be viewed
            in the "Historical Insights" subsection.
        </div>
    </div>
</body>
</html>