/*
This script is running on every page of our website. It makes
the current page in the navbar highlighted with orange. That's helpful for the user
and it looks neat.

Step 1: Trimming the url string to only get "home" or
"playlist" or "about" etc.
*/

// firstly, getting rid of .php
var url = window.location.href;

url = url.substring(0, url.length-4);


// finding the position of the LAST '/'
var end = url.length;
var start = 0;
for(let i = end; i >= 0; i--){
    if(url.charAt(i) == '/'){
        start = i+1;
        break;
    }
}

// trim out everything before the slash to get 
// the name of the page
url = url.substring(start, end);
console.log(url);

// hard coding the edge cases
if(url == "listresult"){
    url = "playlist";
}
else if(url == "tod-insights" || url == "hist-insights"){
    url = "insights";
}
else if(url == "tod-result" || url == "hist-result" || url == "insights-add"){
    url = "insights";
}

// after getting the access code, the url expands to a length of 260, 
if(url.length == 260){
    url = "insights";
}

// add a "HighlightMe" tag to the current a tag on the navbar
var myElement = document.getElementById(url);
myElement.classList.add("HighlightMe");