const pass = document.getElementById("pass");
const eye = document.getElementById("eye");

function showEyePassword() {
    const passValue = pass.value;

    if (passValue.length > 0) {
        eye.classList.remove("hidden");
        eye.classList.add("text-black");
    } else {
        eye.classList.remove("text-black");
        eye.classList.add("text-[#ccc]");
    }
}


function toggle() {
    if( pass.type == "password" ) {
        pass.type = "text" ;
        eye.classList.remove("fas") ;
        eye.classList.remove("fa-eye") ;
        eye.classList.add("fa-solid") ;
        eye.classList.add("fa-eye-slash") ;
    }
    else {
        pass.type = "password" ;
        eye.classList.remove("fa-solid") ;
        eye.classList.remove("fa-eye-slash") ;
        eye.classList.add("fas") ;
        eye.classList.add("fa-eye") ;
    }
}



function theme () {
    // console.log("Theme function called");
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
}

function themeToggle () {
    // console.log("Theme toggle function called");
    // theme() ;
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            var themeToggleBtn = document.getElementById('theme-toggle');

            themeToggleBtn.addEventListener('click', function() {

                // toggle icons inside button
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');

                // if set via local storage previously
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }

                // if NOT set via local storage previously
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
                
            });
}






