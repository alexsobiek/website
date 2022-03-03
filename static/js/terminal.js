
// Variables
let consoleElement = document.getElementById("terminal")
let motd = document.getElementById("motd");


// Last login time
let time = new Date(new Date().getTime() - Math.floor(Math.random() * 100000000)); // Pick a random, recent time to show for last login
let days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
let timeStr = document.getElementById("motd-lastlogin");
timeStr.innerText += `${days[time.getUTCDay()]} ${months[time.getUTCMonth()]} ${time.getUTCDate()} ${time.getUTCHours()}:${time.getUTCMinutes()}:${time.getUTCSeconds()} on ttys000`;

/**
 * Gets a prompt element
 * @param directory Directory string
 * @returns {HTMLSpanElement}
 */
function getPrompt(directory) {
    let prompt = document.createElement("span");
    prompt.classList.add("prompt");
    prompt.innerText = `[asobiek@web01 ${directory}]$`;
    return prompt;
}

// Timing
setTimeout(function() {
    motd.classList.remove("hidden");

}, 600);

setTimeout(function() {
    consoleElement.insertAdjacentElement("beforeend", getPrompt("~"));
}, 900);

