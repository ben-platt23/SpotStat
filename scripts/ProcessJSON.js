// This script is here to process the massive clump of JSON data that is returned by Spotify's API
// Find our data
var data = document.getElementById("json-data").innerHTML;
var a_or_t = document.getElementById("a-or-t").innerHTML;
var time_frame = document.getElementById("time-frame").innerHTML;

// write it to an object
const newObj = JSON.parse(data);

// clear the raw data off the screen
document.getElementById("json-data").remove();
document.getElementById("a-or-t").remove();
document.getElementById("time-frame").remove();

// useful for debugging
console.log(newObj.items[0]);
console.log(newObj.items[1]);
console.log(newObj.items[2]);
console.log(newObj.items[3]);
console.log(newObj.items[4]);

// if we have data on artists: do this
if(a_or_t == "artists"){
    /* 
    Need a 2 dimensional array that contains our relevant data. Then we can just 
    pass it over to the php to a). add it to the database (FIRST CHECK IF THERE IS DATA FOR THE DEFAULT DATE)
    then b). display the data neatly on the page.

    Format of array: 
    [
    0: [rank, name, genre, popularity]
    1: [rank, name, genre, popularity]
    2: [rank, name, genre, popularity]
    3: [rank, name, genre, popularity]
    4: [rank, name, genre, popularity]
    ]
    */
    // create the empty array
    var dataArr = new Array(5);
    for (var i = 0; i < 5; i++){
        dataArr[i] = new Array(4);
    }

    // get our data and put it in the array
    for(var i = 0; i < 5; i++){
        var rank = i + 1;
        var artistName = newObj.items[i].name;
        var genre = newObj.items[i].genres[0];
        var popularity = newObj.items[i].popularity;
        dataArr[i][0] = rank;
        dataArr[i][1] = artistName;
        dataArr[i][2] = genre;
        dataArr[i][3] = popularity;
    }
    // check if it inserted correctly.
    console.log(dataArr);

    // Insert it into the page so that we can pass it to the backend, and display it.
    document.getElementById("aort1").value = a_or_t;
    document.getElementById("time1").value = time_frame;
    
    document.getElementById("rank1").value = dataArr[0][0];
    document.getElementById("name1").value = dataArr[0][1];
    document.getElementById("genre1").value = dataArr[0][2];
    document.getElementById("popularity1").value = dataArr[0][3];

    document.getElementById("rank2").value = dataArr[1][0];
    document.getElementById("name2").value = dataArr[1][1];
    document.getElementById("genre2").value = dataArr[1][2];
    document.getElementById("popularity2").value = dataArr[1][3];

    document.getElementById("rank3").value = dataArr[2][0];
    document.getElementById("name3").value = dataArr[2][1];
    document.getElementById("genre3").value = dataArr[2][2];
    document.getElementById("popularity3").value = dataArr[2][3];

    document.getElementById("rank4").value = dataArr[3][0];
    document.getElementById("name4").value = dataArr[3][1];
    document.getElementById("genre4").value = dataArr[3][2];
    document.getElementById("popularity4").value = dataArr[3][3];

    document.getElementById("rank5").value = dataArr[4][0];
    document.getElementById("name5").value = dataArr[4][1];
    document.getElementById("genre5").value = dataArr[4][2];
    document.getElementById("popularity5").value = dataArr[4][3];

    // remove the other form
    document.getElementById("tracks-form").remove();

}
// But if we have data on tracks: do this
else if(a_or_t == "tracks"){
    /* 
    Format of array: 
    [
    0: [rank, name, artist, release_date, popularity]
    1: [rank, name, artist, release_date, popularity]
    2: [rank, name, artist, release_date, popularity]
    3: [rank, name, artist, release_date, popularity]
    4: [rank, name, artist, release_date, popularity]
    ]
    */
    // create the empty array
    var dataArr = new Array(5);
    for (var i = 0; i < 5; i++){
        dataArr[i] = new Array(5);
    }

    // get our data and put it in the array
    for(var i = 0; i < 5; i++){
        var rank = i + 1;
        var trackName = newObj.items[i].name;
        var artistName = newObj.items[i].artists[0].name;
        var releaseDate = newObj.items[i].album.release_date;
        var popularity = newObj.items[i].popularity;

        dataArr[i][0] = rank;
        dataArr[i][1] = trackName;
        dataArr[i][2] = artistName;
        dataArr[i][3] = releaseDate;
        dataArr[i][4] = popularity;
    }
    // check if it inserted correctly.
    console.log(dataArr);

    // Insert it into the page so that we can pass it to the backend, and display it.
    document.getElementById("aort2").value = a_or_t;
    document.getElementById("time2").value = time_frame;

    document.getElementById("t-rank1").value = dataArr[0][0];
    document.getElementById("t-name1").value = dataArr[0][1];
    document.getElementById("artist1").value = dataArr[0][2];
    document.getElementById("release1").value = dataArr[0][3];
    document.getElementById("t-popularity1").value = dataArr[0][4];

    document.getElementById("t-rank2").value = dataArr[1][0];
    document.getElementById("t-name2").value = dataArr[1][1];
    document.getElementById("artist2").value = dataArr[1][2];
    document.getElementById("release2").value = dataArr[1][3];
    document.getElementById("t-popularity2").value = dataArr[1][4];

    document.getElementById("t-rank3").value = dataArr[2][0];
    document.getElementById("t-name3").value = dataArr[2][1];
    document.getElementById("artist3").value = dataArr[2][2];
    document.getElementById("release3").value = dataArr[2][3];
    document.getElementById("t-popularity3").value = dataArr[2][4];

    document.getElementById("t-rank4").value = dataArr[3][0];
    document.getElementById("t-name4").value = dataArr[3][1];
    document.getElementById("artist4").value = dataArr[3][2];
    document.getElementById("release4").value = dataArr[3][3];
    document.getElementById("t-popularity4").value = dataArr[3][4];

    document.getElementById("t-rank5").value = dataArr[4][0];
    document.getElementById("t-name5").value = dataArr[4][1];
    document.getElementById("artist5").value = dataArr[4][2];
    document.getElementById("release5").value = dataArr[4][3];
    document.getElementById("t-popularity5").value = dataArr[4][4];

    // remove the other form
    document.getElementById("artists-form").remove();
}