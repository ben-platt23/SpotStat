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
    <div id="insights-content">
        <img src="../images/knowledge.png" alt="Picture of a man with a lightbulb" id="knowledge-main">
        <div id="iheading-container-main">
            <h1 id="insights-header">Would you like to know your recent listening habits? <br> Look no further!</h1>
        </div>
        <div id="insights-buttons">
            <button id="todays-button" onclick="window.location.href='./tod-insights.php';">Get Today's Insights!</button>
            <span></span>
            <button id="historical-button" onclick="window.location.href='./hist-insights.php';">See Historical Trends</button>
        </div>   
    </div>
</body>
</html>