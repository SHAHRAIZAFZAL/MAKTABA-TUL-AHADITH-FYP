document.addEventListener('DOMContentLoaded', () => {

    const body = document.body;
    const hamburgerButton = document.getElementById('button-hamburger');
    const sidebar = document.querySelector('aside');
    const settingsButton = document.getElementById('button-settings');
    const settingsCloseButton = document.getElementById('settings-menu-close-button');
    const settingsMenu = document.querySelector('.settings-menu');
    const accountButton = document.getElementById('button-user-account');
    const accountCloseButton = document.getElementById('user-account-close-button');
    const accountMenu = document.querySelector('.user-account');
    const forgotPassButton = document.getElementById('forgot-btn');
    const forgotPassBackButton = document.getElementById('forgot-back-btn');
    const loginTabFirst = document.getElementById('login-tab-first');
    const loginTabSecond = document.getElementById('login-tab-second');
    const chatbotTextArea = document.getElementById('chatbot-input');
    const languageSelect = document.getElementById('search-language');
    const inputField = document.getElementById('search-text-field');
    let langDivs = document.querySelectorAll('.langDiv');
    let fontDivs = document.querySelectorAll('.fontDiv');

    /* CHANGE WEBSITE LANGUAGE */

    let langPreference = localStorage.getItem('langPreference');
    if (!langPreference) {
        try {
            localStorage.setItem('langPreference', 'btn-lang-en');
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
        langPreference = 'btn-lang-en';
    } else {
        let language = 'langDiv-' + langPreference.slice(9);
        langDivs.forEach(function (div) {
            if (div.classList.contains(language)) {
                div.classList.remove('hide-imp');
            } else {
                div.classList.add('hide-imp');
            }
        });
    }
    let langButtons = document.querySelectorAll('.settings-menu__language button');
    langButtons.forEach(function (button) {
        if (button.id == langPreference) {
            button.classList.remove('button-links');
        } else {
            button.classList.add('button-links');
        }
        button.addEventListener('click', () => {
            button.classList.remove('button-links');
            langPreference = button.id;
            langButtons.forEach(function (langButton) {
                if (langButton.id != langPreference) {
                    langButton.classList.add('button-links');
                }
            });
            let language = 'langDiv-' + langPreference.slice(9);
            langDivs.forEach(function (div) {
                if (div.classList.contains(language)) {
                    div.classList.remove('hide-imp');
                } else {
                    div.classList.add('hide-imp');
                }
            });
            try {
                localStorage.setItem('langPreference', langPreference);
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        });
    });

    /* CHANGE FONT SIZE */

    let fontPreference = localStorage.getItem('fontPreference');
    if (!fontPreference) {
        try {
            localStorage.setItem('fontPreference', 'btn-font-m');
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
        fontPreference = 'btn-font-m';
    } else {
        let fontSize = fontPreference.slice(9);
        fontDivs.forEach(function (div) {
            const prefix = "font-size-";
            const classes = div.className.split(" ").filter(c => !c.startsWith(prefix));
            div.className = classes.join(" ").trim();
            if (fontSize == 's') {
                if (div.classList.contains('fontDiv-s'))
                    div.classList.add('font-size-xs');
                else if (div.classList.contains('fontDiv-m'))
                    div.classList.add('font-size-s');
                else if (div.classList.contains('fontDiv-ml'))
                    div.classList.add('font-size-m');
                else if (div.classList.contains('fontDiv-l'))
                    div.classList.add('font-size-ml');
                else if (div.classList.contains('fontDiv-xl'))
                    div.classList.add('font-size-l');
                else if (div.classList.contains('fontDiv-xxl'))
                    div.classList.add('font-size-xl');
            } else if (fontSize == 'l') {
                if (div.classList.contains('fontDiv-s'))
                    div.classList.add('font-size-m');
                else if (div.classList.contains('fontDiv-m'))
                    div.classList.add('font-size-ml');
                else if (div.classList.contains('fontDiv-ml'))
                    div.classList.add('font-size-l');
                else if (div.classList.contains('fontDiv-l'))
                    div.classList.add('font-size-xl');
                else if (div.classList.contains('fontDiv-xl'))
                    div.classList.add('font-size-xxl');
                else if (div.classList.contains('fontDiv-xxl'))
                    div.classList.add('font-size-xxxl');
            }
        });
    }
    let fontButtons = document.querySelectorAll('.settings-menu__fontsize button');
    fontButtons.forEach(function (button) {
        if (button.id == fontPreference) {
            button.classList.remove('button-links');
        } else {
            button.classList.add('button-links');
        }
        button.addEventListener('click', () => {
            button.classList.remove('button-links');
            fontPreference = button.id;
            fontButtons.forEach(function (langButton) {
                if (langButton.id != fontPreference) {
                    langButton.classList.add('button-links');
                }
            });
            let fontSize = fontPreference.slice(9);
            fontDivs.forEach(function (div) {
                const prefix = "font-size-";
                const classes = div.className.split(" ").filter(c => !c.startsWith(prefix));
                div.className = classes.join(" ").trim();
                if (fontSize == 's') {
                    if (div.classList.contains('fontDiv-s'))
                        div.classList.add('font-size-xs');
                    else if (div.classList.contains('fontDiv-m'))
                        div.classList.add('font-size-s');
                    else if (div.classList.contains('fontDiv-ml'))
                        div.classList.add('font-size-m');
                    else if (div.classList.contains('fontDiv-l'))
                        div.classList.add('font-size-ml');
                    else if (div.classList.contains('fontDiv-xl'))
                        div.classList.add('font-size-l');
                    else if (div.classList.contains('fontDiv-xxl'))
                        div.classList.add('font-size-xl');
                } else if (fontSize == 'l') {
                    if (div.classList.contains('fontDiv-s'))
                        div.classList.add('font-size-m');
                    else if (div.classList.contains('fontDiv-m'))
                        div.classList.add('font-size-ml');
                    else if (div.classList.contains('fontDiv-ml'))
                        div.classList.add('font-size-l');
                    else if (div.classList.contains('fontDiv-l'))
                        div.classList.add('font-size-xl');
                    else if (div.classList.contains('fontDiv-xl'))
                        div.classList.add('font-size-xxl');
                    else if (div.classList.contains('fontDiv-xxl'))
                        div.classList.add('font-size-xxxl');
                }
            });
            try {
                localStorage.setItem('fontPreference', fontPreference);
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        });
    });

    /* CHANGE COLOR THEME */

    let themePreference = localStorage.getItem('themePreference');
    if (!themePreference) {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            console.log("Dark mode preferred");
            try {
                localStorage.setItem('themePreference', 'btn-theme-black');
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
            themePreference = 'btn-theme-black';
            body.classList.add('black');
        } else {
            console.log("Light mode preferred or not supported");
            try {
                localStorage.setItem('themePreference', 'btn-theme-white');
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
            themePreference = 'btn-theme-white';
            body.classList.add('white');
        }
    } else {
        let theme = themePreference.slice(10);
        body.className = '';
        body.classList.add(theme);
    }
    let themeButtons = document.querySelectorAll('.settings-menu__theme button');
    themeButtons.forEach(function (button) {
        if (button.id == themePreference) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
        button.addEventListener('click', () => {
            button.classList.add('active');
            themePreference = button.id;
            let theme = themePreference.slice(10);
            body.className = '';
            body.classList.add(theme, 'disable-clicks');
            themeButtons.forEach(function (langButton) {
                if (langButton.id != themePreference) {
                    langButton.classList.remove('active');
                }
            });
            try {
                localStorage.setItem('themePreference', themePreference);
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        });
    });

    /* HAMBURGER SIDEBAR TOGGLE */
    let hamburgerClicked = false;
    hamburgerButton.addEventListener('click', (e) => {
        e.stopPropagation();
        sidebar.classList.toggle('active');
        body.classList.toggle('disable-clicks');
        hamburgerButton.classList.toggle('enable-clicks');
        sidebar.classList.toggle('enable-clicks');
        var isOpened = hamburgerButton.getAttribute('aria-expanded');
        if (isOpened === 'false') {
            hamburgerButton.setAttribute('aria-expanded', 'true');
        }
        else {
            hamburgerButton.setAttribute('aria-expanded', 'false');
        }
        if (!hamburgerClicked) {
            document.addEventListener('click', (event) => {
                if (!sidebar.contains(event.target)) {
                    sidebar.classList.remove('active', 'enable-clicks');
                    body.classList.remove('disable-clicks');
                    hamburgerButton.classList.remove('enable-clicks');
                    hamburgerButton.setAttribute('aria-expanded', 'false');
                }
            });
        }
        hamburgerClicked = true;
    });

    /* SETTINGS MENU TOGGLE */
    let settingsMenuClicked = false;
    settingsButton.addEventListener('click', (e) => {
        e.stopPropagation();
        settingsMenu.classList.remove('no-opacity');
        settingsMenu.classList.add('active', 'enable-clicks');
        body.classList.add('disable-clicks');
        settingsButton.setAttribute('aria-expanded', 'true');
        if (!settingsMenuClicked) {
            document.addEventListener('click', (event) => {
                if (!settingsMenu.contains(event.target)) {
                    settingsMenu.classList.add('no-opacity');
                    settingsMenu.classList.remove('active', 'enable-clicks');
                    body.classList.remove('disable-clicks');
                    settingsButton.setAttribute('aria-expanded', 'false');
                }
            });
        }
        settingsMenuClicked = true;
    });
    settingsCloseButton.addEventListener('click', () => {
        settingsMenu.classList.add('no-opacity');
        settingsMenu.classList.remove('active', 'enable-clicks');
        body.classList.remove('disable-clicks');
        settingsButton.setAttribute('aria-expanded', 'false');
    });

    /* USER ACCOUNT MENU TOGGLE */
    let accountClicked = false;
    accountButton.addEventListener('click', (e) => {
        e.stopPropagation();
        accountMenu.classList.remove('no-opacity');
        accountMenu.classList.add('active', 'enable-clicks');
        body.classList.add('disable-clicks');
        accountButton.setAttribute('aria-expanded', 'true');
        if (!accountClicked) {
            document.addEventListener('click', (event) => {
                if (!accountMenu.contains(event.target)) {
                    accountMenu.classList.add('no-opacity');
                    accountMenu.classList.remove('active', 'enable-clicks');
                    body.classList.remove('disable-clicks');
                    accountButton.setAttribute('aria-expanded', 'false');
                }
            });
        }
        accountClicked = true;
    });
    accountCloseButton.addEventListener('click', () => {
        accountMenu.classList.add('no-opacity');
        accountMenu.classList.remove('active', 'enable-clicks');
        body.classList.remove('disable-clicks');
        accountButton.setAttribute('aria-expanded', 'false');
    });

    /* FORGOT PASSWORD DIV TOGGLE */
    if (forgotPassButton) {
        forgotPassButton.addEventListener('click', () => {
            loginTabFirst.classList.add("hide-imp");
            loginTabSecond.classList.remove("hide-imp");
        });
        forgotPassBackButton.addEventListener('click', () => {
            loginTabFirst.classList.remove("hide-imp");
            loginTabSecond.classList.add("hide-imp");
        });
    }

    /* CHATBOT MESSAGE HEIGHT */
    if (chatbotTextArea) {
        chatbotTextArea.addEventListener('input', () => {
            chatbotTextArea.style.height = "";
            chatbotTextArea.style.height = chatbotTextArea.scrollHeight + "px";
        });
    }

    /* CHANGE FONT FAMILY OF SEARCH TEXT FIELD */
    if (languageSelect) {
        languageSelect.addEventListener('change', () => {
            updateFontFamily();
        });
        function updateFontFamily() {
            let languageValue = languageSelect.value;
            let font = '';
            if (languageValue === 'arabic') {
                font = 'Uthman Taha Naskh';
            } else if (languageValue === 'english') {
                font = 'Roboto, sans-serif';
            } else if (languageValue === 'urdu') {
                font = 'Jameel Noori Nastaleeq';
            }
            inputField.style.fontFamily = font;
        }
        updateFontFamily();
    }

    /* USER REGISTRATION */
    const accountResponse = document.querySelector('.account-response');
    const loaderUsernameReg = document.getElementById('loader-username-reg');
    const loaderEmailReg = document.getElementById('loader-email-reg');
    const loaderUsernameLogin = document.getElementById('loader-username-login');
    const loaderPasswordLogin = document.getElementById('loader-password-login');
    const loaderEmailReset = document.getElementById('loader-email-reset');
    const regForm = document.getElementById('registration-form');
    const regUsername = document.getElementById('username-reg');
    const regEmail = document.getElementById('email-reg');
    const regPassword = document.getElementById('password-reg');
    const regPasswordRepeat = document.getElementById('password-repeat-reg');
    const loginForm = document.getElementById('login-form');
    const loginUsername = document.getElementById('username-login');
    const loginPassword = document.getElementById('password-login');
    const logoutForm = document.getElementById('logout-form');
    const resetForm = document.getElementById('reset-form');
    const resetEmail = document.getElementById('email-reset');
    let usernameIsAvailable = true;
    let emailIsAvailable = true;
    let userExists = true;
    let resetEmailIsAvailable = true;

    function removeResponse() {
        accountResponse.classList.remove('active');
    }
    setTimeout(removeResponse, 5000);

    function checkAvailability(type, value) {
        if (type === 'reg-username')
            loaderUsernameReg.classList.remove('hide-imp');
        else if (type === 'reg-email')
            loaderEmailReg.classList.remove('hide-imp');
        else if (type === 'login-username')
            loaderUsernameLogin.classList.remove('hide-imp');
        else if (type === 'reset-email')
            loaderEmailReset.classList.remove('hide-imp');

        let xhr;
        if (xhr && xhr.readyState !== 4) {
            return;
        }
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (type === 'reg-username') {
                    loaderUsernameReg.classList.add('hide-imp');
                    if (xhr.responseText !== '') {
                        usernameIsAvailable = false;
                        regUsername.nextElementSibling.innerText = xhr.responseText;
                    } else {
                        usernameIsAvailable = true;
                    }
                }
                else if (type === 'reg-email') {
                    loaderEmailReg.classList.add('hide-imp');
                    if (xhr.responseText !== '') {
                        emailIsAvailable = false;
                        regEmail.nextElementSibling.innerText = xhr.responseText;
                    } else {
                        emailIsAvailable = true;
                    }
                }
                else if (type === 'login-username') {
                    loaderUsernameLogin.classList.add('hide-imp');
                    if (xhr.responseText !== '') {
                        userExists = false;
                        loginUsername.nextElementSibling.innerText = xhr.responseText;
                    } else {
                        userExists = true;
                    }
                }
                else if (type === 'reset-email') {
                    loaderEmailReset.classList.add('hide-imp');
                    if (xhr.responseText !== '') {
                        resetEmailIsAvailable = false;
                        resetEmail.nextElementSibling.innerText = xhr.responseText;
                    } else {
                        resetEmailIsAvailable = true;
                    }
                }
            }
        };
        xhr.open("POST", "ajax-check-credentials.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        if (type === 'reg-username')
            xhr.send("ajax=true&type=reg&username=" + encodeURIComponent(value));
        else if (type === 'reg-email')
            xhr.send("ajax=true&type=reg&email=" + encodeURIComponent(value));
        else if (type === 'login-username')
            xhr.send("ajax=true&type=login&username=" + encodeURIComponent(value));
        else if (type === 'reset-email')
            xhr.send("ajax=true&type=reset&email=" + encodeURIComponent(value));
    }

    if (regForm) {
        regForm.addEventListener('submit', function (event) {
            event.preventDefault();
            let errors = false;
            regUsername.nextElementSibling.innerText = '';
            regEmail.nextElementSibling.innerText = '';
            regPassword.nextElementSibling.innerText = '';
            regPasswordRepeat.nextElementSibling.innerText = '';

            if (regUsername.value === '') {
                errors = true;
                regUsername.nextElementSibling.innerText = 'Username is required!';
            } else if (regUsername.value.length < 4) {
                errors = true;
                regUsername.nextElementSibling.innerText = 'Username must be at least 4 characters long!';
            } else if (regUsername.value.length > 24) {
                errors = true;
                regUsername.nextElementSibling.innerText = 'Username cannot be more than 24 characters long!';
            } else if (!regex.test(regUsername.value)) {
                errors = true;
                regUsername.nextElementSibling.innerText = 'Username can only contain alphabets, numbers, underscores, or hyphens!';
            }
            checkAvailability('reg-username', regUsername.value);

            if (regEmail.value === '') {
                errors = true;
                regEmail.nextElementSibling.innerText = 'Email is required!';
            }
            checkAvailability('reg-email', regEmail.value);

            if (regPassword.value === '') {
                errors = true;
                regPassword.nextElementSibling.innerText = 'Password is required!';
            } else if (regPassword.value.length < 8) {
                errors = true;
                regPassword.nextElementSibling.innerText = 'Password must be at least 8 characters long!';
            }

            if (regPasswordRepeat.value === '') {
                errors = true;
                regPasswordRepeat.nextElementSibling.innerText = 'Please confirm your password!';
            } else if (regPassword.value !== regPasswordRepeat.value) {
                errors = true;
                regPasswordRepeat.nextElementSibling.innerText = 'Passwords do not match!';
            }

            if (!errors && usernameIsAvailable && emailIsAvailable) {
                let formData = new FormData(this);
                formData.append('ajax', 'true');
                let xhr;
                if (xhr && xhr.readyState !== 4) {
                    return;
                }
                xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        location.reload();
                    }
                };
                xhr.open("POST", "ajax-register.php", true);
                xhr.send(formData);
            }
        });

        let regex = /^[a-zA-Z0-9_-]+$/;
        regUsername.addEventListener('input', () => {
            if (regUsername.value === '') {
                regUsername.nextElementSibling.innerText = 'Username is required!';
            } else if (regUsername.value.length > 24) {
                regUsername.nextElementSibling.innerText = 'Username cannot be more than 24 characters long!';
            } else if (!regex.test(regUsername.value)) {
                regUsername.nextElementSibling.innerText = 'Can only contain alphabets, numbers, underscores, or hyphens!';
            } else
                regUsername.nextElementSibling.innerText = '';
            checkAvailability('reg-username', regUsername.value);
        });

        regEmail.addEventListener('input', () => {
            if (regEmail.value === '') {
                regEmail.nextElementSibling.innerText = 'Email is required!';
            } else
                regEmail.nextElementSibling.innerText = '';
            checkAvailability('reg-email', regEmail.value);
        });

        regPassword.addEventListener('input', () => {
            if (regPassword.value === '') {
                regPassword.nextElementSibling.innerText = 'Password is required!';
            } else if (regPassword.value.length < 8) {
                regPassword.nextElementSibling.innerText = 'Password must be at least 8 characters long!';
            } else
                regPassword.nextElementSibling.innerText = '';
        });

        regPasswordRepeat.addEventListener('input', () => {
            if (regPasswordRepeat.value === '') {
                regPasswordRepeat.nextElementSibling.innerText = 'Please confirm your password!';
            } else if (regPassword.value !== regPasswordRepeat.value) {
                regPasswordRepeat.nextElementSibling.innerText = 'Passwords do not match!';
            } else
                regPasswordRepeat.nextElementSibling.innerText = '';
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', function (event) {
            event.preventDefault();
            let errors = false;
            loginUsername.nextElementSibling.innerText = '';
            loginPassword.nextElementSibling.innerText = '';

            if (loginUsername.value === '') {
                errors = true;
                loginUsername.nextElementSibling.innerText = 'Username/Email is required!';
            }
            if (loginPassword.value === '') {
                errors = true;
                loginPassword.nextElementSibling.innerText = 'Password is required!';
            }

            if (!errors) {
                checkAvailability('login-username', loginUsername.value);
                if (userExists) {
                    loaderPasswordLogin.classList.remove('hide-imp');
                    let formData = new FormData(this);
                    formData.append('ajax', 'true');
                    let xhr;
                    if (xhr && xhr.readyState !== 4) {
                        return;
                    }
                    xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            loaderPasswordLogin.classList.add('hide-imp');
                            if (xhr.responseText == 'Incorrect password!')
                                loginPassword.nextElementSibling.innerText = 'Incorrect password!';
                            else
                                location.reload();
                        }
                    };
                    xhr.open("POST", "ajax-login.php", true);
                    xhr.send(formData);
                }
            }
        });

        loginUsername.addEventListener('input', () => {
            checkAvailability('login-username', loginUsername.value);
            if (loginUsername.value === '') {
                loginUsername.nextElementSibling.innerText = 'Username/Email is required!';
            } else
                loginUsername.nextElementSibling.innerText = '';
        });

        loginPassword.addEventListener('input', () => {
            if (loginPassword.value === '') {
                loginPassword.nextElementSibling.innerText = 'Password is required!';
            } else
                loginPassword.nextElementSibling.innerText = '';
        });
    }

    if (logoutForm) {
        logoutForm.addEventListener('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            formData.append('ajax', 'true');
            let xhr;
            if (xhr && xhr.readyState !== 4) {
                return;
            }
            xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.open("POST", "ajax-logout.php", true);
            xhr.send(formData);
        });
    }

    if (resetForm) {
        resetForm.addEventListener('submit', function (event) {
            event.preventDefault();
            let errors = false;
            resetEmail.nextElementSibling.innerText = '';
            if (resetEmail.value === '') {
                errors = true;
                resetEmail.nextElementSibling.innerText = 'Email is required!';
            }

            if (!errors) {
                checkAvailability('reset-email', resetEmail.value);
                if (resetEmailIsAvailable) {
                    loaderEmailReset.classList.remove('hide-imp');
                    let formData = new FormData(this);
                    formData.append('ajax', 'true');
                    let xhr;
                    if (xhr && xhr.readyState !== 4) {
                        return;
                    }
                    xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            loaderEmailReset.classList.add('hide-imp');
                            accountMenu.classList.add('no-opacity');
                            accountMenu.classList.remove('active', 'enable-clicks');
                            body.classList.remove('disable-clicks');
                            accountButton.setAttribute('aria-expanded', 'false');

                            /* TO BE CONTINUED HERE ... */

                        }
                    };
                    xhr.open("POST", "ajax-reset-password.php", true);
                    xhr.send(formData);
                }
            }
        });

        resetEmail.addEventListener('input', () => {
            checkAvailability('reset-email', resetEmail.value);
            if (resetEmail.value === '') {
                resetEmail.nextElementSibling.innerText = 'Email is required!';
            } else
                resetEmail.nextElementSibling.innerText = '';
        });
    }

    /* CHANGE BACKGROUND OF IFRAMES */
    setTimeout(function () {
        let iframes = document.getElementsByTagName('iframe');
        if (iframes.length > 0) {
            for (let i = 0; i < iframes.length; i++) {
                let iframe = iframes[i];
                iframe.style.background = 'grey';
                if (iframe.contentWindow && iframe.contentWindow.document.body) {
                    iframe.contentWindow.document.body.style.backgroundColor = 'grey';
                }
            }
        }
    }, 100);
});