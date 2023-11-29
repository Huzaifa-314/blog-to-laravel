//preloader
document.addEventListener("DOMContentLoaded", function () {
    // Reference to the preloader element
    var preloader = document.getElementById("preloader");

    // Hide the preloader after the page has loaded
    setTimeout(function () {
        preloader.classList.add("fade-out");
    }, 2000); // Adjust the delay as needed

    // Create the flipper element dynamically
    var flipper = document.createElement("div");
    flipper.classList.add("flip-container");
    flipper.innerHTML = '<div class="flipper"></div>';
    preloader.appendChild(flipper);
});




