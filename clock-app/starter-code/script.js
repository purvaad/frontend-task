"use strict";

const quoteTextElement = document.querySelector(".quote");
const quoteAuthorElement = document.querySelector(".author");
const refreshQuoteButton = document.querySelector(".refresh-quote img");
const greetingMessageElement = document.querySelector(".clock_timer--timmer p");
const timeElement = document.querySelector(".time");
const timeZoneElement = document.querySelector(".time-zone");
const locationElement = document.querySelector(".country");
const moreInfoButton = document.querySelector(".btn");
const moreInfoContainer = document.querySelector(".more_info");
const headerElement = document.querySelector("header");
const dayOfYearElement = document.querySelector(".year-day");
const dayOfWeekElement = document.querySelector(".week_day");
const weekNumberElement = document.querySelector(".week");

//API
const quoteURL =  "https://api.quotable.io/random";  //"https://github.com/lukePeavey/";
const timeURL = "https://worldtimeapi.org/api/ip";
const locationURL = "http://ip-api.com/json/"; //https://freegeoip.app/  https://ipinfo.io/json

//function to fetch a random quote
const fetchQuote = async () => {
    try {
        const response = await fetch(quoteURL);
        if (!response.ok) {
            throw new Error("Failed to fetch quote.");
        }
        const quoteData = await response.json();
        updateQuote(quoteData);
    } catch (error) {
        console.error(error);
    }
};

//update quote text and author
const updateQuote = (quoteData) => {
    quoteTextElement.textContent = `"${quoteData.content}"`;
    quoteAuthorElement.textContent = quoteData.author || 'Unknown author';
};

//event listener for the refresh button
refreshQuoteButton.addEventListener("click", fetchQuote);

//function to fetch current time and related data
const fetchTimeAndLocation = async () => {
    try {
        //fetch current time data
        const timeResponse = await fetch(timeURL);
        if (!timeResponse.ok) {
            throw new Error("Failed to fetch time data.");
        }
        const timeData = await timeResponse.json();
        updateTime(timeData);
        updateMoreInfo(timeData);

        //fetch location data
        const locationResponse = await fetch(locationURL);
        if (!locationResponse.ok) {
            throw new Error("Failed to fetch location data.");
        }
        const locationData = await locationResponse.json();
        updateLocation(locationData);
    } catch (error) {
        console.error(error);
    }
};

//update more info section with fetched time data
const updateMoreInfo = (timeData) => {
    timeZoneElement.textContent = timeData.abbreviation;
    dayOfYearElement.textContent = timeData.day_of_year;
    dayOfWeekElement.textContent = timeData.day_of_week;
    weekNumberElement.textContent = timeData.week_number;
};


//update clock with fetched time data
const updateTime = (timeData) => {
    const currentTime = new Date(timeData.datetime);
    const hour = currentTime.getHours();
    const minute = currentTime.getMinutes().toString().padStart(2, '0');
    const currentTimeString = `${hour}:${minute}`;
    const currentTimeZone = timeData.abbreviation;
    timeElement.textContent = currentTimeString;
    timeZoneElement.textContent = currentTimeZone;
    updateGreeting(hour);
};

//update greeting message based on the current hour
const updateGreeting = (hour) => {
    if (hour >= 5 && hour < 12) {
        greetingMessageElement.textContent = "GOOD MORNING, IT'S CURRENTLY";
        document.body.classList.remove('night');
        document.body.classList.add('day');
        moreInfoContainer.style.backgroundColor = '#979797'; 
        moreInfoContainer.style.color = 'black'; 
    } else {
        greetingMessageElement.textContent = "GOOD EVENING, IT'S CURRENTLY";
        document.body.classList.remove('day');
        document.body.classList.add('night');
        moreInfoContainer.style.backgroundColor = '#000000'; 
        moreInfoContainer.style.color = 'white';
    }
};

//update location information
const updateLocation = (locationData) => {
    const city = locationData.city.toUpperCase();
    const country = locationData.country.toUpperCase();
    locationElement.textContent = `IN ${city}, ${country}`;
};

//toggle more info section visibility
const toggleMoreInfo = () => {
    moreInfoContainer.classList.toggle("hidden");
    const buttonImg = moreInfoButton.querySelector("img");
    buttonImg.classList.toggle("rotate");
};

//event listener for the "More Info" button
moreInfoButton.addEventListener("click", () => {
    toggleMoreInfo();
    //toggle the 'add' class on the header element
    headerElement.classList.toggle("add");
});


//event listener for the button to toggle header class and show/hide more info
headerElement.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn")) {
        headerElement.classList.toggle("add");
        if (mainElement.classList.contains("add")) {
            moreInfoContainer.classList.remove("hidden");
        } else {
            moreInfoContainer.classList.add("hidden");
        }
    }
});

//initial data fetching
fetchQuote();
fetchTimeAndLocation();
setInterval(fetchTimeAndLocation, 1000); //updates time



// button.addEventListener("click", (e) =>{
//     headerEl.classList.toggle("add");
//     // moreInfo.classList.remove("hidden");

//     if(e.target){
//         if(headerEl.classList.contains("add")){
//             moreInfo.classList.remove("hidden");
//         } else{
//             moreInfo.classList.add("hidden");
//         }
//     }
// });