function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function theme() {
    const themeExepression = document.getElementById("themeExepression") ;
    var themePreference = getCookie("color-theme");
    if (themePreference === "dark" || (!themePreference && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
        document.documentElement.classList.add("dark");
        themeExepression.innerHTML ="Light Mode" ;
    } else {
        document.documentElement.classList.remove("dark");
        themeExepression.innerHTML ="Night Mode" ;
    }
}

function themeToggle() {
    var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
    var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
    const themeExepression = document.getElementById("themeExepression") ;

    // Change the icons inside the button based on previous settings
    var themePreference = getCookie("color-theme");
    if (themePreference === "dark" || (!themePreference && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
        themeToggleLightIcon.classList.remove("hidden");
    } else {
        themeToggleDarkIcon.classList.remove("hidden");
    }

    var themeToggleBtn = document.getElementById("theme-toggle");

    themeToggleBtn.addEventListener("click", function () {
        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle("hidden");
        themeToggleLightIcon.classList.toggle("hidden");

        // Toggle theme preference
        var themePreference = getCookie("color-theme");
        if (themePreference === "dark") {
            document.documentElement.classList.remove("dark");
            setCookie("color-theme", "light", 365); // Set cookie for 1 year
            themeExepression.innerHTML ="Night Mode" ;
        } else {
            document.documentElement.classList.add("dark");
            setCookie("color-theme", "dark", 365); // Set cookie for 1 year
            themeExepression.innerHTML ="Light Mode" ;
        }
    });
}

theme();
themeToggle();