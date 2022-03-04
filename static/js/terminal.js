// Variables
let consoleElement = document.getElementById("terminal")
let motd = document.getElementById("motd");

let aboutSelector = document.getElementById("terminal-about-selector");


// Last login time
let time = new Date(new Date().getTime() - Math.floor(Math.random() * 100000000)); // Pick a random, recent time to show for last login
let days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
let timeStr = document.getElementById("motd-lastlogin");
timeStr.innerText += `${days[time.getUTCDay()]} ${months[time.getUTCMonth()]} ${time.getUTCDate()} ${time.getUTCHours()}:${time.getUTCMinutes()}:${time.getUTCSeconds()} on ttys000`;

let currentPrompt;
let currentDirectory = "~"

// Timing
setTimeout(function () {
    motd.classList.remove("hidden");

}, 600);

setTimeout(function () {
    carriageReturn();
}, 900);

setInterval(function() {
    if (currentPrompt != null) {
        if (currentPrompt.classList.contains("prompt-cursor")) currentPrompt.classList.remove("prompt-cursor");
        else currentPrompt.classList.add("prompt-cursor");
    }
}, 500);

// Click listeners
aboutSelector.addEventListener("click", function() {
    type("cd ~/about && cat about.txt").then(() => {
        currentDirectory = "~/about";
        cat("about.txt");
    });
});

/**
 * Gets a prompt element
 * @returns {HTMLSpanElement}
 */
function getPrompt() {
    let prompt = document.createElement("span");
    prompt.classList.add("prompt");
    prompt.innerText = `[asobiek@web01 ${currentDirectory}]$ `;
    if (currentPrompt != null) currentPrompt.classList.remove("prompt-cursor");
    currentPrompt = prompt;
    return prompt;
}

/**
 * Appends text to the current prompt
 * @param text Text to "type"
 * @returns {Promise<unknown>}
 */
function type(text) {
    for (i = 0; i < text.length; i++) {
        (function (i) {
            setTimeout(function () {
                currentPrompt.textContent += text.charAt(i);
            }, i * 20);
        }(i));
    }
    return pause(text.length * 20 + 500);
}

/**
 * Prints the content of the given text file to the terminal
 * @param file File to print
 */
function cat(file) {
    let request = new XMLHttpRequest();
    request.open('GET', `/static/text/${file}`, true);
    request.send(null);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            if (request.getResponseHeader('Content-Type').indexOf("text") !== 1) {
                let content = document.createElement("pre");
                content.innerText = request.responseText;
                consoleElement.insertAdjacentElement("beforeend", content);
                carriageReturn();
            }
        }
    }
}

/**
 * Returns to the next line and creates a new prompt
 */
function carriageReturn() {
    consoleElement.insertAdjacentElement("beforeend", getPrompt());
    window.scrollTo(0, document.body.scrollHeight);
}

/**
 * Creates a promise which pauses execution
 * @param ms Time to pause for
 * @returns {Promise<unknown>}
 */
function pause(ms) {
    return new Promise(r => setTimeout(r, ms))
}