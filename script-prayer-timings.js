document.addEventListener('DOMContentLoaded', () => {
    function formatDateTime(date) {
        let day = date.getDate();
        let monthNames = ["January", "February", "March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December"];
        let monthIndex = date.getMonth();
        let year = date.getFullYear();
        let dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        let dayName = dayNames[date.getDay()];
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let seconds = date.getSeconds();
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // Handle midnight (0 hours)
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        return day + ' ' + monthNames[monthIndex] + ' ' + year + ', ' +
            dayName + ' - ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    }

    function updateDate() {
        let currentDate = new Date();
        let formattedDateTime = formatDateTime(currentDate);
        document.getElementById("current-date-time").innerText = formattedDateTime;
    }
    setInterval(updateDate, 1000);

    const apiKey = "53724dbe584c4214a528dc861754a0ff";
    const settingsSidebar = document.querySelector('.settings-sidebar');
    const prayerCalculationButton = document.getElementById('prayer-calculation-button');
    const prayerCalculationCloseButton = document.getElementById('prayer-calculation-close-button');
    const autoLocateButton = document.getElementById('auto-locate-button');
    const locationDiv = document.getElementById('current-location');
    const clientTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    const sunriseDiv = document.getElementById('sunrise');
    const sunsetDiv = document.getElementById('sunset');
    const fajrDiv = document.getElementById('fajr');
    const dhuhrDiv = document.getElementById('dhuhr');
    const asrDiv = document.getElementById('asr');
    const maghribDiv = document.getElementById('maghrib');
    const ishaDiv = document.getElementById('isha');
    const midnightDiv = document.getElementById('midnight');
    const lastthirdDiv = document.getElementById('lastthird');
    const showMidnightCheckbox = document.getElementById('show_midnight');
    const showLastthirdCheckbox = document.getElementById('show_lastthird');
    const midnightBox = document.querySelector('.prayer-time-div.midnight');
    const lastthirdBox = document.querySelector('.prayer-time-div.lastthird');
    const prayerTimeTableOutput = document.getElementById('prayer-timetable-output');
    const tableMonth = document.getElementById('prayer-timetable-month');
    const tableYear = document.getElementById('prayer-timetable-year');
    const calculationMethod = document.getElementById('calc-method');
    const fajrAngle = document.getElementById('fajr-angle');
    const ishaAngle = document.getElementById('isha-angle');
    const asrMethod = document.getElementById('asr-method');
    const highLatitudeRule = document.getElementById('high-latitude-rule');
    const calcMethodOutput = document.getElementById('calcMethodOutput');
    const fajrAngleOutput = document.getElementById('fajrAngleOutput');
    const ishaAngleOutput = document.getElementById('ishaAngleOutput');
    const asrMethodOutput = document.getElementById('asrMethodOutput');
    const fajrIshaDiv = document.querySelector('.prayer-calculation-form__angles');

    let tableMonthValue = tableMonth.value;
    let tableYearValue = tableYear.value;
    let calculationMethodValue = localStorage.getItem('calculationMethod');
    let fajrAngleValue = localStorage.getItem('fajrAngle');
    let ishaAngleValue = localStorage.getItem('ishaAngle');
    let asrMethodValue = localStorage.getItem('asrMethod');
    let highLatitudeValue = localStorage.getItem('highLatitudeRule');

    if (!calculationMethodValue) {
        try {
            localStorage.setItem("calculationMethod", 'UmmAlQura');
            calculationMethodValue = 'UmmAlQura';
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    }
    for (let i = 0; i < calculationMethod.options.length; i++) {
        if (calculationMethod.options[i].value === calculationMethodValue) {
            calculationMethod.options[i].selected = true;
            calcMethodOutput.innerText = calculationMethod.options[i].getAttribute('name');
            break;
        }
    }

    if (!fajrAngleValue) {
        try {
            localStorage.setItem("fajrAngle", '0');
            fajrAngleValue = '0';
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    }
    for (let i = 0; i < fajrAngle.options.length; i++) {
        if (fajrAngle.options[i].value === fajrAngleValue) {
            fajrAngle.options[i].selected = true;
            fajrAngleOutput.innerText = fajrAngleValue;
            break;
        }
    }

    if (!ishaAngleValue) {
        try {
            localStorage.setItem("ishaAngle", '0');
            ishaAngleValue = '0';
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    }
    for (let i = 0; i < ishaAngle.options.length; i++) {
        if (ishaAngle.options[i].value === ishaAngleValue) {
            ishaAngle.options[i].selected = true;
            ishaAngleOutput.innerText = ishaAngleValue;
            break;
        }
    }

    if (!asrMethodValue) {
        try {
            localStorage.setItem("asrMethod", 'Shafi');
            asrMethodValue = 'Shafi';
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    }
    for (let i = 0; i < asrMethod.options.length; i++) {
        if (asrMethod.options[i].value === asrMethodValue) {
            asrMethod.options[i].selected = true;
            asrMethodOutput.innerText = asrMethodValue;
            break;
        }
    }

    if (!highLatitudeValue) {
        try {
            localStorage.setItem("highLatitudeRule", 'MiddleOfTheNight');
            highLatitudeValue = 'MiddleOfTheNight';
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    }
    for (let i = 0; i < highLatitudeRule.options.length; i++) {
        if (highLatitudeRule.options[i].value === highLatitudeValue) {
            highLatitudeRule.options[i].selected = true;
            break;
        }
    }

    calculationMethod.addEventListener('change', () => {
        calculationMethodValue = calculationMethod.value;
        calcMethodOutput.innerText = calculationMethod.selectedOptions[0].getAttribute('name');
        setFajrIshaValues(calculationMethodValue);
        getPrayerTime();
        getPrayerTimeTable(tableYearValue, tableMonthValue);
        try {
            localStorage.setItem("calculationMethod", calculationMethodValue);
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    });

    fajrAngle.addEventListener('change', () => {
        fajrAngleValue = fajrAngle.value;
        fajrAngleOutput.innerText = fajrAngleValue;
        getPrayerTime();
        getPrayerTimeTable(tableYearValue, tableMonthValue);
        try {
            localStorage.setItem("fajrAngle", fajrAngleValue);
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    });

    ishaAngle.addEventListener('change', () => {
        ishaAngleValue = ishaAngle.value;
        ishaAngleOutput.innerText = ishaAngleValue;
        getPrayerTime();
        getPrayerTimeTable(tableYearValue, tableMonthValue);
        try {
            localStorage.setItem("ishaAngle", ishaAngleValue);
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    });

    asrMethod.addEventListener('change', () => {
        asrMethodValue = asrMethod.value;
        asrMethodOutput.innerText = asrMethodValue;
        getPrayerTime();
        getPrayerTimeTable(tableYearValue, tableMonthValue);
        try {
            localStorage.setItem("asrMethod", asrMethodValue);
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    });

    highLatitudeRule.addEventListener('change', () => {
        highLatitudeValue = highLatitudeRule.value;
        getPrayerTime();
        getPrayerTimeTable(tableYearValue, tableMonthValue);
        try {
            localStorage.setItem("highLatitudeRule", highLatitudeValue);
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    });

    function setFajrIshaValues(calcMethod) {
        if (calcMethod == 'UmmAlQura') {
            fajrAngleOutput.innerText = '18.5';
            ishaAngleOutput.innerText = '90 minutes';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'Karachi') {
            fajrAngleOutput.innerText = '18.0';
            ishaAngleOutput.innerText = '18.0';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'MuslimWorldLeague') {
            fajrAngleOutput.innerText = '18.0';
            ishaAngleOutput.innerText = '17.0';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'Egyptian') {
            fajrAngleOutput.innerText = '19.5';
            ishaAngleOutput.innerText = '17.5';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'MoonsightingCommittee') {
            fajrAngleOutput.innerText = '18.0';
            ishaAngleOutput.innerText = '18.0';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'NorthAmerica') {
            fajrAngleOutput.innerText = '15.0';
            ishaAngleOutput.innerText = '15.0';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'Tehran') {
            fajrAngleOutput.innerText = '17.7';
            ishaAngleOutput.innerText = '14.0';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'Singapore') {
            fajrAngleOutput.innerText = '20.0';
            ishaAngleOutput.innerText = '18.0';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'Turkey') {
            fajrAngleOutput.innerText = '18.0';
            ishaAngleOutput.innerText = '17.0';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'Dubai') {
            fajrAngleOutput.innerText = '18.2';
            ishaAngleOutput.innerText = '18.2';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'Qatar') {
            fajrAngleOutput.innerText = '18.0';
            ishaAngleOutput.innerText = '90 minutes';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'Kuwait') {
            fajrAngleOutput.innerText = '18.0';
            ishaAngleOutput.innerText = '17.5';
            fajrIshaDiv.classList.remove('active');
        } else if (calcMethod == 'Other') {
            fajrAngleOutput.innerText = fajrAngleValue;
            ishaAngleOutput.innerText = ishaAngleValue;
            fajrIshaDiv.classList.add('active');
        }
    }
    setFajrIshaValues(calculationMethodValue);

    /* PRAYER TIMINGS CALCULATION SETTINGS TOGGLE */
    let prayerSettingsClicked = false;
    prayerCalculationButton.addEventListener('click', (e) => {
        e.stopPropagation();
        settingsSidebar.classList.remove('no-opacity');
        settingsSidebar.classList.add('active');
        prayerCalculationButton.setAttribute('aria-expanded', 'true');
        if (!prayerSettingsClicked) {
            document.addEventListener('click', (event) => {
                if (!settingsSidebar.contains(event.target)) {
                    settingsSidebar.classList.add('no-opacity');
                    settingsSidebar.classList.remove('active');
                    prayerCalculationButton.setAttribute('aria-expanded', 'false');
                }
            });
        }
        prayerSettingsClicked = true;
    });
    prayerCalculationCloseButton.addEventListener('click', () => {
        settingsSidebar.classList.add('no-opacity');
        settingsSidebar.classList.remove('active');
        prayerCalculationButton.setAttribute('aria-expanded', 'false');
    });

    function errHand(err) {
        switch (err.code) {
            case err.PERMISSION_DENIED:
                console.log("The application doesn't have the permission to make use of location services");
                break;
            case err.POSITION_UNAVAILABLE:
                console.log("The location of the device is uncertain");
                break;
            case err.TIMEOUT:
                console.log("The request to get user location timed out");
                break;
            case err.UNKNOWN_ERROR:
                console.log("Time to fetch location information exceeded the maximum timeout interval");
                break;
        }
    }

    function getHoursMinutes(time) {
        let hours = time.getHours();
        let minutes = time.getMinutes();
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        return hours + ':' + minutes + ' ' + ampm;
    }

    function getPrayerTime() {
        let coordinates = new adhan.Coordinates(latitudeValue, longitudeValue);
        let x = new Date().toLocaleString('en-US', { timeZone: clientTimeZone });
        let date = new Date(x);
        let params = adhan.CalculationMethod[calculationMethodValue]();
        if (calculationMethodValue == 'Other') {
            params.fajrAngle = fajrAngleValue;
            params.ishaAngle = ishaAngleValue;
            if (ishaAngleValue == '90 Minutes') {
                params.ishaInterval = 90;
            }
        }
        params.madhab = adhan.Madhab[asrMethodValue];
        params.highLatitudeRule = adhan.HighLatitudeRule[highLatitudeValue];
        let prayerTimes = new adhan.PrayerTimes(coordinates, date, params);
        let sunnahTimes = new adhan.SunnahTimes(prayerTimes);
        sunriseDiv.innerText = getHoursMinutes(prayerTimes.sunrise);
        sunsetDiv.innerText = getHoursMinutes(prayerTimes.sunset);
        fajrDiv.innerText = getHoursMinutes(prayerTimes.fajr);
        dhuhrDiv.innerText = getHoursMinutes(prayerTimes.dhuhr);
        asrDiv.innerText = getHoursMinutes(prayerTimes.asr);
        maghribDiv.innerText = getHoursMinutes(prayerTimes.maghrib);
        ishaDiv.innerText = getHoursMinutes(prayerTimes.isha);
        if (midnightDiv)
            midnightDiv.innerText = getHoursMinutes(sunnahTimes.middleOfTheNight);
        if (lastthirdDiv)
            lastthirdDiv.innerText = getHoursMinutes(sunnahTimes.lastThirdOfTheNight);
    }

    let latitudeValue = localStorage.getItem('userLatitude');
    let longitudeValue = localStorage.getItem('userLongitude');
    if (latitudeValue != null && longitudeValue != null) {
        reverseGeocoding();
        getPrayerTime();
    } else {
        latitudeValue = document.getElementById('latitudeIP').value;
        longitudeValue = document.getElementById('longitudeIP').value;
        reverseGeocoding();
        getPrayerTime();
        try {
            localStorage.setItem("userLatitude", latitudeValue);
            localStorage.setItem("userLongitude", longitudeValue);
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    }

    let isMidnightShown = localStorage.getItem('showMidnight');
    let isLastthirdShown = localStorage.getItem('showLastthird')

    if (!isMidnightShown) {
        try {
            localStorage.setItem("showMidnight", 'Y');
            isMidnightShown = 'Y';
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    } else if (isMidnightShown == 'N') {
        showMidnightCheckbox.checked = false;
        midnightBox.classList.add('hide-imp');
    }

    if (!isLastthirdShown) {
        try {
            localStorage.setItem("showLastthird", 'Y');
            isLastthirdShown = 'Y';
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    } else if (isLastthirdShown == 'N') {
        showLastthirdCheckbox.checked = false;
        lastthirdBox.classList.add('hide-imp');
    }

    function showLoc(pos) {
        latitudeValue = pos.coords.latitude;
        longitudeValue = pos.coords.longitude;
        try {
            localStorage.setItem('userLatitude', latitudeValue);
            localStorage.setItem('userLongitude', longitudeValue);
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
        reverseGeocoding();
        getPrayerTime();
        getPrayerTimeTable(tableYearValue, tableMonthValue);
    }

    autoLocateButton.addEventListener('click', () => {
        navigator.geolocation.getCurrentPosition(showLoc, errHand);
    });

    showMidnightCheckbox.addEventListener('change', () => {
        if (showMidnightCheckbox.checked == false) {
            midnightBox.classList.add('hide-imp');
            try {
                localStorage.setItem("showMidnight", 'N');
                isMidnightShown = 'N';
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        } else {
            midnightBox.classList.remove('hide-imp');
            try {
                localStorage.setItem("showMidnight", 'Y');
                isMidnightShown = 'Y';
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        }
    });

    showLastthirdCheckbox.addEventListener('change', () => {
        if (showLastthirdCheckbox.checked == false) {
            lastthirdBox.classList.add('hide-imp');
            try {
                localStorage.setItem("showLastthird", 'N');
                isLastthirdShown = 'N';
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        } else {
            lastthirdBox.classList.remove('hide-imp');
            try {
                localStorage.setItem("showLastthird", 'Y');
                isLastthirdShown = 'Y';
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        }
    });

    /* AJAX GENERATE PRAYER TIMES CALENDAR */
    function generateCalendar(month, year) {
        let xhr;
        if (xhr && xhr.readyState !== 4) {
            return;
        }
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                prayerTimeTableOutput.innerHTML = xhr.responseText;
                getPrayerTimeTable(tableYearValue, tableMonthValue);
            }
        };
        xhr.open('GET', 'get-prayer-timetable.php?ajax=true&timezone=' + clientTimeZone +
            '&month=' + month + '&year=' + year, true);
        xhr.send();
    }
    generateCalendar(tableMonthValue, tableYearValue);

    tableMonth.addEventListener('change', () => {
        tableMonthValue = tableMonth.value;
        generateCalendar(tableMonthValue, tableYearValue);
    })

    tableYear.addEventListener('change', () => {
        tableYearValue = tableYear.value;
        generateCalendar(tableMonthValue, tableYearValue);
    })

    function getPrayerTimeTable(year, month) {
        let coordinates = new adhan.Coordinates(latitudeValue, longitudeValue);
        let params = adhan.CalculationMethod[calculationMethodValue]();
        if (calculationMethodValue == 'Other') {
            params.fajrAngle = fajrAngleValue;
            params.ishaAngle = ishaAngleValue;
            if (ishaAngleValue == '90 Minutes') {
                params.ishaInterval = 90;
            }
        }
        params.madhab = adhan.Madhab[asrMethodValue];
        params.highLatitudeRule = adhan.HighLatitudeRule[highLatitudeValue];
        let numberOfDays = new Date(year, month, 0).getDate();

        for (x = 1; x <= numberOfDays; x++) {
            let i = new Date(year, month - 1, x).toLocaleString('en-US', { timeZone: clientTimeZone });
            let date = new Date(i);
            let prayerTimes = new adhan.PrayerTimes(coordinates, date, params);
            const element = document.getElementById(x);

            let fajr = element.nextElementSibling;
            fajr.innerText = getHoursMinutes(prayerTimes.fajr);
            let sunrise = fajr.nextElementSibling;
            sunrise.innerText = getHoursMinutes(prayerTimes.sunrise);
            let dhuhr = sunrise.nextElementSibling;
            dhuhr.innerText = getHoursMinutes(prayerTimes.dhuhr);
            let asr = dhuhr.nextElementSibling;
            asr.innerText = getHoursMinutes(prayerTimes.asr);
            let maghrib = asr.nextElementSibling;
            maghrib.innerText = getHoursMinutes(prayerTimes.maghrib);
            let isha = maghrib.nextElementSibling;
            isha.innerText = getHoursMinutes(prayerTimes.isha);
        }
    }

    /* ADDRESS AUTOCOMPLETE & GEOCODING */

    function addressAutocomplete(containerElement, callback, options) {

        const MIN_ADDRESS_LENGTH = 3;
        const DEBOUNCE_DELAY = 300;

        // create container for input element
        const inputContainerElement = document.createElement("div");
        inputContainerElement.setAttribute("class", "input-container");
        containerElement.appendChild(inputContainerElement);

        // create input element
        const inputElement = document.createElement("input");
        inputElement.setAttribute("type", "text");
        inputElement.setAttribute("id", "location-address-input");
        inputElement.setAttribute("placeholder", options.placeholder);
        inputContainerElement.appendChild(inputElement);

        // add input field clear button
        const clearButton = document.createElement("div");
        clearButton.classList.add("clear-button");
        addIcon(clearButton);
        clearButton.addEventListener("click", (e) => {
            e.stopPropagation();
            inputElement.value = '';
            callback(null);
            clearButton.classList.remove("visible");
            closeDropDownList();
        });
        inputContainerElement.appendChild(clearButton);

        /* We will call the API with a timeout to prevent unneccessary API activity.*/
        let currentTimeout;

        /* Save the current request promise reject function. To be able to cancel the promise when a new request comes */
        let currentPromiseReject;

        /* Focused item in the autocomplete list. This variable is used to navigate with buttons */
        let focusedItemIndex;

        /* Process a user input: */
        inputElement.addEventListener("input", function (e) {
            const currentValue = this.value;

            /* Close any already open dropdown list */
            closeDropDownList();


            // Cancel previous timeout
            if (currentTimeout) {
                clearTimeout(currentTimeout);
            }

            // Cancel previous request promise
            if (currentPromiseReject) {
                currentPromiseReject({
                    canceled: true
                });
            }

            if (!currentValue) {
                clearButton.classList.remove("visible");
            }

            // Show clearButton when there is a text
            clearButton.classList.add("visible");

            // Skip empty or short address strings
            if (!currentValue || currentValue.length < MIN_ADDRESS_LENGTH) {
                return false;
            }

            /* Call the Address Autocomplete API with a delay */
            currentTimeout = setTimeout(() => {
                currentTimeout = null;

                /* Create a new promise and send geocoding request */
                const promise = new Promise((resolve, reject) => {
                    currentPromiseReject = reject;
                    var url = `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(currentValue)}&format=json&limit=5&apiKey=${apiKey}`;

                    fetch(url)
                        .then(response => {
                            currentPromiseReject = null;

                            // check if the call was successful
                            if (response.ok) {
                                response.json().then(data => resolve(data));
                            } else {
                                response.json().then(data => reject(data));
                            }
                        });
                });

                promise.then((data) => {
                    // here we get address suggestions
                    currentItems = data.results;

                    /*create a DIV element that will contain the items (values):*/
                    const autocompleteItemsElement = document.createElement("div");
                    autocompleteItemsElement.setAttribute("class", "autocomplete-items");
                    inputContainerElement.appendChild(autocompleteItemsElement);

                    /* For each item in the results */
                    data.results.forEach((result, index) => {
                        /* Create a DIV element for each element: */
                        const itemElement = document.createElement("div");
                        /* Set formatted address as item value */
                        itemElement.innerHTML = result.formatted;
                        autocompleteItemsElement.appendChild(itemElement);

                        /* Set the value for the autocomplete text field and notify: */
                        itemElement.addEventListener("click", function (e) {
                            inputElement.value = currentItems[index].formatted;
                            callback(currentItems[index]);
                            /* Close the list of autocompleted values: */
                            closeDropDownList();
                        });
                    });

                }, (err) => {
                    if (!err.canceled) {
                        console.log(err);
                    }
                });
            }, DEBOUNCE_DELAY);
        });

        /* Add support for keyboard navigation */
        inputElement.addEventListener("keydown", function (e) {
            var autocompleteItemsElement = containerElement.querySelector(".autocomplete-items");
            if (autocompleteItemsElement) {
                var itemElements = autocompleteItemsElement.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    e.preventDefault();
                    /*If the arrow DOWN key is pressed, increase the focusedItemIndex variable:*/
                    focusedItemIndex = focusedItemIndex !== itemElements.length - 1 ? focusedItemIndex + 1 : 0;
                    /*and and make the current item more visible:*/
                    setActive(itemElements, focusedItemIndex);
                } else if (e.keyCode == 38) {
                    e.preventDefault();

                    /*If the arrow UP key is pressed, decrease the focusedItemIndex variable:*/
                    focusedItemIndex = focusedItemIndex !== 0 ? focusedItemIndex - 1 : focusedItemIndex = (itemElements.length - 1);
                    /*and and make the current item more visible:*/
                    setActive(itemElements, focusedItemIndex);
                } else if (e.keyCode == 13) {
                    /* If the ENTER key is pressed and value as selected, close the list*/
                    e.preventDefault();
                    if (focusedItemIndex > -1) {
                        closeDropDownList();
                    }
                }
            } else {
                if (e.keyCode == 40) {
                    /* Open dropdown list again */
                    var event = document.createEvent('Event');
                    event.initEvent('input', true, true);
                    inputElement.dispatchEvent(event);
                }
            }
        });

        function setActive(items, index) {
            if (!items || !items.length) return false;

            for (var i = 0; i < items.length; i++) {
                items[i].classList.remove("autocomplete-active");
            }

            /* Add class "autocomplete-active" to the active element*/
            items[index].classList.add("autocomplete-active");

            // Change input value and notify
            inputElement.value = currentItems[index].formatted;
            callback(currentItems[index]);
        }

        function closeDropDownList() {
            const autocompleteItemsElement = inputContainerElement.querySelector(".autocomplete-items");
            if (autocompleteItemsElement) {
                inputContainerElement.removeChild(autocompleteItemsElement);
            }
            focusedItemIndex = -1;
        }

        function addIcon(buttonElement) {
            const svgElement = document.createElementNS("http://www.w3.org/2000/svg", 'svg');
            svgElement.setAttribute('viewBox', "0 0 24 24");
            svgElement.setAttribute('height', "24");

            const iconElement = document.createElementNS("http://www.w3.org/2000/svg", 'path');
            iconElement.setAttribute("d", "M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z");
            iconElement.setAttribute('fill', 'currentColor');
            svgElement.appendChild(iconElement);
            buttonElement.appendChild(svgElement);
        }

        /* Close the autocomplete dropdown when the document is clicked. 
          Skip, when a user clicks on the input field */
        document.addEventListener("click", function (e) {
            if (e.target !== inputElement) {
                closeDropDownList();
            } else if (!containerElement.querySelector(".autocomplete-items")) {
                // open dropdown list again
                var event = document.createEvent('Event');
                event.initEvent('input', true, true);
                inputElement.dispatchEvent(event);
            }
        });
    }

    addressAutocomplete(document.getElementById("autocomplete-container"), (data) => {
        latitudeValue = data.lat;
        longitudeValue = data.lon;
        reverseGeocoding();
        getPrayerTime();
        getPrayerTimeTable(tableYearValue, tableMonthValue);
        try {
            localStorage.setItem("userLatitude", latitudeValue);
            localStorage.setItem("userLongitude", longitudeValue);
        } catch (e) {
            if (e.name === 'QuotaExceededError') {
                console.error('LocalStorage quota exceeded. Cannot store more data.');
            } else {
                console.error('An error occurred while accessing localStorage:', e);
            }
        }
    }, {
        placeholder: "Enter location / address ..."
    });

    /* REVERSE GEOCODING */

    function reverseGeocoding() {
        const reverseGeocodingUrl = `https://api.geoapify.com/v1/geocode/reverse?lat=${latitudeValue}&lon=${longitudeValue}&apiKey=${apiKey}`;
        fetch(reverseGeocodingUrl).then(result => result.json())
            .then(featureCollection => {
                if (featureCollection.features.length === 0) {
                    document.getElementById("status").textContent = "The address is not found";
                    return;
                }
                const foundAddress = featureCollection.features[0];
                let locationCity = foundAddress.properties.city || '';
                let locationState = foundAddress.properties.state || '';
                let locationCountry = foundAddress.properties.country || '';
                locationDiv.innerText = locationCity + ", " + locationState + ", " + locationCountry;
            });
    }
});