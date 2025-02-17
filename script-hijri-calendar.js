document.addEventListener('DOMContentLoaded', () => {

    const hijriSettingsMenu = document.querySelector('.settings-sidebar');
    const hijriSettingsButton = document.getElementById('hijri-settings-button');
    const hijriSettingsCloseButton = document.getElementById('hijri-settings-close-button');
    const hijriModifier = document.getElementById('hijri-date-adjustment');
    const hijriDateDiv = document.getElementById('hijri-date');
    const monthlyCalendarTable = document.getElementById('monthly-calendar');
    const month = document.getElementById('hiddenMonth').value;
    const year = document.getElementById('hiddenYear').value;
    const hijriConversionOutput = document.getElementById('hijri-date-output');
    const gregoConversionOutput = document.getElementById('grego-date-output');
    const clientTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    let modifier = localStorage.getItem('hijriAdjustment');
    if (!modifier) {
        try {
            localStorage.setItem('hijriAdjustment', '0 day');
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
        modifier = '0 day';
    }
    for (let i = 0; i < hijriModifier.options.length; i++) {
        if (hijriModifier.options[i].value === modifier) {
            hijriModifier.options[i].selected = true;
            break;
        }
    }

    function updateDate() {
        let adjustedDate = new Date().toLocaleString('en-US', { timeZone: clientTimeZone });
        let formattedDate = new Date(adjustedDate);
        let day = formattedDate.getDate();
        let monthNames = ["January", "February", "March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December"];
        let monthIndex = formattedDate.getMonth();
        let year = formattedDate.getFullYear();
        let dateString = day + ' ' + monthNames[monthIndex] + ', ' + year;
        document.getElementById('gregorian-date').innerText = dateString + ' AD';
    }

    function adjustHijriDate(modifier) {
        let xhr;
        if (xhr && xhr.readyState !== 4) {
            return;
        }
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                hijriDateDiv.innerText = xhr.responseText;
            }
        };
        xhr.open('GET', 'get-hijri-date.php?ajax=true&modifier=' + modifier + '&timezone=' + clientTimeZone, true);
        xhr.send();
    }

    function adjustHijriCalendar(modifier) {
        let xhr;
        if (xhr && xhr.readyState !== 4) {
            return;
        }
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                monthlyCalendarTable.innerHTML = xhr.responseText;
            }
        };
        xhr.open('GET', 'get-hijri-calendar.php?ajax=true&modifier=' + modifier + '&timezone=' + clientTimeZone
            + '&month=' + month + '&year=' + year, true);
        xhr.send();
    }

    function dateConversion(date, month, year, method) {
        let xhr;
        if (xhr && xhr.readyState !== 4) {
            return;
        }
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (method == 'hijri') {
                    hijriConversionOutput.innerText = xhr.responseText;
                } else if (method == 'grego') {
                    gregoConversionOutput.innerText = xhr.responseText;
                }
            }
        };
        console.log(date, month, year, method);
        if (!year) { } else {
            xhr.open('GET', 'get-date-conversion.php?ajax=true&year=' + year + '&month=' + month
                + '&date=' + date + '&method=' + method, true);
            xhr.send();
        }
    }

    let hijriSettingsClicked = false;
    hijriSettingsButton.addEventListener('click', (e) => {
        e.stopPropagation();
        hijriSettingsMenu.classList.remove('no-opacity');
        hijriSettingsMenu.classList.add('active');
        hijriSettingsButton.setAttribute('aria-expanded', 'true');
        if (!hijriSettingsClicked) {
            document.addEventListener('click', (event) => {
                if (!hijriSettingsMenu.contains(event.target)) {
                    hijriSettingsMenu.classList.add('no-opacity');
                    hijriSettingsMenu.classList.remove('active');
                    hijriSettingsButton.setAttribute('aria-expanded', 'false');
                }
            });
        }
        hijriSettingsClicked = true;
    });
    hijriSettingsCloseButton.addEventListener('click', () => {
        hijriSettingsMenu.classList.add('no-opacity');
        hijriSettingsMenu.classList.remove('active');
        hijriSettingsButton.setAttribute('aria-expanded', 'false');
    });

    hijriModifier.addEventListener('change', (e) => {
        modifier = e.target.value;
        localStorage.setItem('hijriAdjustment', modifier);
        adjustHijriDate(modifier);
        adjustHijriCalendar(modifier);
    });
    setInterval(updateDate, 1000);
    adjustHijriDate(modifier);
    adjustHijriCalendar(modifier);

    const hcd = document.getElementById('hijri-converter-date');
    const hcm = document.getElementById('hijri-converter-month');
    const hcy = document.getElementById('hijri-converter-year');
    const gcd = document.getElementById('gregorian-converter-date');
    const gcm = document.getElementById('gregorian-converter-month');
    const gcy = document.getElementById('gregorian-converter-year');

    hcd.addEventListener('change', () => {
        dateConversion(hcd.value, hcm.value, hcy.value, 'hijri');
    });
    hcm.addEventListener('change', () => {
        dateConversion(hcd.value, hcm.value, hcy.value, 'hijri');
    });
    hcy.addEventListener('change', () => {
        dateConversion(hcd.value, hcm.value, hcy.value, 'hijri');
    });
    hcy.addEventListener('keyup', () => {
        dateConversion(hcd.value, hcm.value, hcy.value, 'hijri');
    });
    gcd.addEventListener('change', () => {
        dateConversion(gcd.value, gcm.value, gcy.value, 'grego');
    });
    gcm.addEventListener('change', () => {
        dateConversion(gcd.value, gcm.value, gcy.value, 'grego');
    });
    gcy.addEventListener('change', () => {
        dateConversion(gcd.value, gcm.value, gcy.value, 'grego');
    });
    gcy.addEventListener('keyup', () => {
        dateConversion(gcd.value, gcm.value, gcy.value, 'grego');
    });
});