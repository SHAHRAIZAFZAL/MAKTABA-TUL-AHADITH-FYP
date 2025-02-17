document.addEventListener('DOMContentLoaded', () => {
    window.addEventListener('pageshow', () => {

        const body = document.querySelector('body');
        const quranSettingsButton = document.getElementById('quran-settings-button');
        const quranSettingsCloseButton = document.getElementById('quran-settings-close-button');
        const settingsSidebar = document.querySelector('.settings-sidebar');
        const surahInfoButton = document.getElementById('surah-info-button');
        const surahInfoCloseButton = document.getElementById('surah-info-close-button');
        const surahInfoMenu = document.querySelector('.surah-info-menu');
        const parentElement = document.querySelector('.quran-surah-tabs');

        /* QURAN SETTINGS MENU TOGGLE */
        let quranSettingsClicked = false;
        quranSettingsButton.addEventListener('click', (e) => {
            e.stopPropagation();
            settingsSidebar.classList.remove('no-opacity');
            settingsSidebar.classList.add('active');
            quranSettingsButton.setAttribute('aria-expanded', 'true');
            if (!quranSettingsClicked) {
                document.addEventListener('click', (event) => {
                    if (!settingsSidebar.contains(event.target)) {
                        settingsSidebar.classList.add('no-opacity');
                        settingsSidebar.classList.remove('active');
                        quranSettingsButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }
            quranSettingsClicked = true;
        });
        quranSettingsCloseButton.addEventListener('click', () => {
            settingsSidebar.classList.add('no-opacity');
            settingsSidebar.classList.remove('active');
            quranSettingsButton.setAttribute('aria-expanded', 'false');
        });

        /* SURAH INFO MENU TOGGLE */
        let surahInfoClicked = false;
        surahInfoButton.addEventListener('click', (e) => {
            e.stopPropagation();
            surahInfoMenu.classList.remove('no-opacity');
            surahInfoMenu.classList.add('active', 'enable-clicks');
            body.classList.add('disable-clicks');
            surahInfoButton.setAttribute('aria-expanded', 'true');
            if (!surahInfoClicked) {
                document.addEventListener('click', (event) => {
                    if (!surahInfoMenu.contains(event.target)) {
                        surahInfoMenu.classList.add('no-opacity');
                        surahInfoMenu.classList.remove('active', 'enable-clicks');
                        body.classList.remove('disable-clicks');
                        surahInfoButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }
            surahInfoClicked = true;
        });
        surahInfoCloseButton.addEventListener('click', () => {
            surahInfoMenu.classList.add('no-opacity');
            surahInfoMenu.classList.remove('active', 'enable-clicks');
            body.classList.remove('disable-clicks');
            surahInfoButton.setAttribute('aria-expanded', 'false');
        });

        /* SELECT QURAN TRANSLATIONS */
        let savedSelections = localStorage.getItem("quranTranslations");
        if (!savedSelections) {
            let temp = {};
            let x = document.querySelector('.quran-settings-form input[type="checkbox"]:first-of-type').id;
            temp[x] = true;
            try {
                localStorage.setItem("quranTranslations", JSON.stringify(temp));
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
            savedSelections = localStorage.getItem("quranTranslations");
        }
        savedSelections = JSON.parse(savedSelections);
        for (let key in savedSelections) {
            if (savedSelections.hasOwnProperty(key)) {
                document.getElementById(key).checked = savedSelections[key];
                toggleVisibility(key);
            }
        }
        setTimeout(updateTranslatorInfo, 100);

        let checkboxes = document.querySelectorAll('.quran-settings-form input[type="checkbox"]');
        showFirstSelectedTranslation();
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', (e) => {
                let id = e.target.id;
                toggleVisibility(id);
                updateTranslatorInfo();
                showFirstSelectedTranslation();
                let selections = {};
                checkboxes.forEach(function (checkbox) {
                    selections[checkbox.id] = checkbox.checked;
                });
                try {
                    localStorage.setItem("quranTranslations", JSON.stringify(selections));
                } catch (e) {
                    if (e.name === 'QuotaExceededError') {
                        console.error('LocalStorage quota exceeded. Cannot store more data.');
                    } else {
                        console.error('An error occurred while accessing localStorage:', e);
                    }
                }
            });
        });

        function toggleVisibility(id) {
            let divsToShowHide = document.querySelectorAll('.' + id);
            divsToShowHide.forEach(function (div) {
                if (document.getElementById(id).checked) {
                    div.classList.remove('hide');
                } else {
                    div.classList.add('hide');
                }
            });
        }

        function updateTranslatorInfo() {
            let selectedTranslators = [];
            let otherTranslatorsCount = 0;
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    let label = document.querySelector('label[for="' + checkbox.id + '"]').textContent.trim();
                    if (selectedTranslators.length < 1) {
                        selectedTranslators.push(label);
                    } else {
                        otherTranslatorsCount++;
                    }
                }
            });
            let translatorInfoDiv = document.getElementById('translator-info');
            if (selectedTranslators.length > 0) {
                let info = selectedTranslators.join(" & ");
                if (otherTranslatorsCount > 0) {
                    info += " & " + otherTranslatorsCount + " other";
                    if (otherTranslatorsCount > 1) {
                        info += "s";
                    }
                }
                translatorInfoDiv.textContent = info;
            } else {
                translatorInfoDiv.textContent = "";
            }
        }

        function showFirstSelectedTranslation() {
            let firstSelectedCheckbox = document.querySelector('.quran-settings-form input[type="checkbox"]:checked');
            if (firstSelectedCheckbox) {
                let id = firstSelectedCheckbox.id;
                let divsToShowHide = document.querySelectorAll('.tr-' + id);
                divsToShowHide.forEach(function (div) {
                    if (document.getElementById(id).checked) {
                        div.classList.remove('hide');
                    } else {
                        div.classList.add('hide');
                    }
                });
                let allCheckboxes = document.querySelectorAll('.quran-settings-form input[type="checkbox"]');
                allCheckboxes.forEach(function (checkbox) {
                    if (checkbox.id !== id) {
                        let divsToHide = document.querySelectorAll('.tr-' + checkbox.id);
                        divsToHide.forEach(function (div) {
                            div.classList.add('hide');
                        });
                    }
                });
            }
        }

        /* SELECT QURAN TAFSEER */
        let savedTafseer = localStorage.getItem("quranTafseer");
        if (savedTafseer) {
            let selections = document.querySelectorAll('.tafseer-selection__select');
            selections.forEach(function (selection) {
                for (let i = 0; i < selection.options.length; i++) {
                    if (selection.options[i].value === savedTafseer) {
                        selection.options[i].selected = true;
                        break;
                    }
                }
            });
        }
        else {
            let selectElement = document.querySelector('.tafseer-selection__select');
            savedTafseer = selectElement.options[0].value;
        }
        let selections = document.querySelectorAll('.tafseer-selection__select');
        selections.forEach(function (selection) {
            selection.addEventListener('change', (e) => {
                let id = e.target.value;
                try {
                    localStorage.setItem("quranTafseer", id);
                } catch (e) {
                    if (e.name === 'QuotaExceededError') {
                        console.error('LocalStorage quota exceeded. Cannot store more data.');
                    } else {
                        console.error('An error occurred while accessing localStorage:', e);
                    }
                }
                let ayahVariable = selection.name.slice(18);
                let iframeVideo = document.getElementById('tafseer-iframe-' + ayahVariable);
                if (iframeVideo) {
                    let url = iframeVideo.src;
                    iframeVideo.src = url;
                }
                savedTafseer = id;
                toggleVisibilitySelect(id);
                let newSelections = document.querySelectorAll('.tafseer-selection__select');
                newSelections.forEach(function (newSelection) {
                    for (let i = 0; i < newSelection.options.length; i++) {
                        if (newSelection.options[i].value === id) {
                            newSelection.options[i].selected = true;
                            break;
                        }
                    }
                });
            });
        });

        function toggleVisibilitySelect(id) {
            let divsToShowHide = document.querySelectorAll('.tafseer');
            divsToShowHide.forEach(function (div) {
                if (div.classList.contains(id)) {
                    div.classList.remove('hide');
                } else {
                    div.classList.add('hide');
                }
            });
        }

        /* AYAT TAFSEER MENUS TOGGLE */
        let xhr;
        parentElement.addEventListener('click', e => {
            if (e.target.closest('.ayat-tafseer-button')) {
                let ayahTafseerClicked = false;
                let ayahTafseerButton = e.target.closest('.ayat-tafseer-button');
                let ayahTafseerMenu = ayahTafseerButton.nextElementSibling;
                let ayahTafseerCloseButton = ayahTafseerMenu.firstElementChild;
                let ayahVariable = ayahTafseerCloseButton.nextElementSibling.value;
                let surahVariable = ayahTafseerCloseButton.nextElementSibling.nextElementSibling.value;
                let tafseerOutput = document.getElementById("ayah-" + ayahVariable + "-tafseer-output");
                ayahTafseerMenu.classList.remove('no-opacity');
                ayahTafseerMenu.classList.add('active', 'enable-clicks');
                body.classList.add('disable-clicks');
                ayahTafseerButton.setAttribute('aria-expanded', 'true');

                /* AJAX REQUEST TO GET TAFSEER DATA OF CLICKED MENU */
                if (xhr && xhr.readyState !== 4) {
                    return;
                }
                xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        tafseerOutput.innerHTML = xhr.responseText;
                        toggleVisibilitySelect(savedTafseer);
                    }
                };
                xhr.open("GET", "get-tafseer-data.php?ajax=true&ayahID=" + ayahVariable
                    + "&surahID=" + surahVariable, true);
                xhr.send();

                e.stopPropagation();
                if (!ayahTafseerClicked) {
                    document.addEventListener('click', (event) => {
                        if (!ayahTafseerMenu.contains(event.target)) {
                            ayahTafseerMenu.classList.add('no-opacity');
                            ayahTafseerMenu.classList.remove('active', 'enable-clicks');
                            body.classList.remove('disable-clicks');
                            ayahTafseerButton.setAttribute('aria-expanded', 'false');
                            let iframeVideo = document.getElementById('tafseer-iframe-' + ayahVariable);
                            if (iframeVideo) {
                                let url = iframeVideo.src;
                                iframeVideo.src = url;
                            }
                        }
                    });
                }
                ayahTafseerClicked = true;
                ayahTafseerCloseButton.addEventListener('click', () => {
                    ayahTafseerMenu.classList.add('no-opacity');
                    ayahTafseerMenu.classList.remove('active', 'enable-clicks');
                    body.classList.remove('disable-clicks');
                    ayahTafseerButton.setAttribute('aria-expanded', 'false');
                    let iframeVideo = document.getElementById('tafseer-iframe-' + ayahVariable);
                    iframeVideo.src = '';
                });
            }
        });

        /* SURAH AUDIO PLAY */

        const audio = document.querySelector('audio');
        const audioPlayerBtn = document.getElementById('play-audio-button');
        const audioPlayerDiv = document.getElementById('surah-audio-player');
        const audioCloseBtn = document.getElementById('audio-close');
        const audioSlider = document.getElementById('audio-slider');
        const audioCurrentTime = document.getElementById('audio-current-time');
        const audioDuration = document.getElementById('audio-total-time');
        const audioPrevAyah = document.getElementById('audio-prev-ayah');
        const audioNextAyah = document.getElementById('audio-next-ayah');
        const audioPlayPause = document.getElementById('audio-play-pause');
        const audioPlayPath = document.getElementById('audio-play-path');
        const audioPausePath = document.getElementById('audio-pause-path');
        const audioMore = document.getElementById('audio-more');
        const audioMoreMenu = document.getElementById('audio-more-menu');
        const volumeSlider = document.getElementById('volume-slider');
        const volumeValue = document.getElementById('volume-value');
        const volumeMuteBtn = document.getElementById('volume-mute');
        const volumeSoundPath = document.getElementById('volume-sound-path');
        const volumeMutePath = document.getElementById('volume-mute-path');

        const audioAutoRepeat = document.getElementById('audio-auto-repeat');
        const audioAutoRepeatCheck = document.getElementById('audio-auto-repeat-check');
        const audioAutoScroll = document.getElementById('audio-auto-scroll');
        const audioAutoScrollCheck = document.getElementById('audio-auto-scroll-check');
        const audioDownload = document.getElementById('audio-download');
        const audioPlaySpeed = document.getElementById('audio-play-speed');
        const audioPlaySpeedMenu = document.getElementById('audio-play-speed-menu');
        const audioReciter = document.getElementById('audio-reciter');
        const audioReciterMenu = document.getElementById('audio-reciter-menu');
        let playState = 'play';
        let muteState = 'unmute';
        let raf = null;
        let isAudioRepeated = localStorage.getItem("audioRepeat");
        let isAudioScrolled = localStorage.getItem("audioScroll");
        let playbackSpeed = localStorage.getItem("playbackSpeed");
        let reciterName = localStorage.getItem("reciterName");

        audioPlayerBtn.addEventListener('click', () => {
            audioPlayerDiv.classList.remove('no-opacity');
            audioPlayerDiv.classList.add('active');
            audioPlayerBtn.setAttribute('aria-expanded', 'true');

            audioPlayPath.classList.add('hide');
            audioPausePath.classList.remove('hide');
            audio.play();
            requestAnimationFrame(whilePlaying);
            playState = 'pause';
        });
        audioCloseBtn.addEventListener('click', () => {
            audioPlayerDiv.classList.add('no-opacity');
            audioPlayerDiv.classList.remove('active', 'enable-clicks');
            audioPlayerBtn.setAttribute('aria-expanded', 'false');

            audioPlayPath.classList.remove('hide');
            audioPausePath.classList.add('hide');
            audio.pause();
            audio.src = audio.src;
            cancelAnimationFrame(raf);
            playState = 'play';
        });

        function calculateTime(secs) {
            const hours = Math.floor(secs / 3600);
            const minutes = Math.floor((secs % 3600) / 60);
            const seconds = Math.floor((secs % 3600) % 60);
            const returnedHours = hours < 10 ? `0${hours}` : `${hours}`;
            const returnedMinutes = minutes < 10 ? `0${minutes}` : `${minutes}`;
            const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
            if (returnedHours == '00') {
                return `${returnedMinutes}:${returnedSeconds}`;
            } else {
                return `${returnedHours}:${returnedMinutes}:${returnedSeconds}`;
            }
        }

        function displayBufferedAmount() {
            const bufferedAmount = Math.floor(audio.buffered.end(audio.buffered.length - 1));
            audioPlayerDiv.style.setProperty('--buffered-width', `${(bufferedAmount / audioSlider.max) * 100}%`);
        }

        function whilePlaying() {
            audioSlider.value = Math.floor(audio.currentTime);
            audioCurrentTime.textContent = calculateTime(audioSlider.value);
            audioPlayerDiv.style.setProperty('--seek-before-width', audioSlider.value / audioSlider.max * 100 + '%');
            raf = requestAnimationFrame(whilePlaying);
        }

        function changePlaybackSpeed(speed) {
            audio.playbackRate = parseFloat(speed);
            localStorage.setItem("playbackSpeed", speed);
            playbackSpeed = speed;
        }

        function changeReciterFile(reciter) {
            const file = document.getElementById(reciter);
            audio.src = file.src;
            localStorage.setItem("reciterName", reciter);
            reciterName = reciter;
            if (playState === 'pause') {
                audio.play();
            }
        }

        if (!reciterName) {
            try {
                localStorage.setItem("reciterName", "audio-mishari");
                reciterName = "audio-mishari";
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        }
        const file = document.getElementById(reciterName);
        audio.src = file.src;
        if (!playbackSpeed) {
            try {
                localStorage.setItem("playbackSpeed", '1');
                playbackSpeed = '1';
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        } else {
            audio.playbackRate = parseFloat(playbackSpeed);
        }
        if (audio.readyState > 0) {
            audioDuration.textContent = calculateTime(audio.duration);
            audioSlider.max = Math.floor(audio.duration);
            displayBufferedAmount();
        } else {
            audio.addEventListener('loadedmetadata', () => {
                audioDuration.textContent = calculateTime(audio.duration);
                audioSlider.max = Math.floor(audio.duration);
                displayBufferedAmount();
            });
        }

        audioDownload.addEventListener('click', () => {
            fetch('/Maktaba-tul-Ahadith/download.php?file=' + encodeURIComponent(audio.src))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.blob();
                })
                .catch(error => console.error('Error downloading audio file: ', error));
        });

        audio.addEventListener('progress', displayBufferedAmount);

        if (!isAudioRepeated) {
            try {
                localStorage.setItem("audioRepeat", 'N');
                isAudioRepeated = 'N';
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        } else if (isAudioRepeated == 'Y') {
            audioAutoRepeatCheck.classList.remove('hide');
        }
        audioAutoRepeat.addEventListener('click', () => {
            audioAutoRepeatCheck.classList.toggle('hide');
            if (audioAutoRepeatCheck.classList.contains('hide')) {
                localStorage.setItem("audioRepeat", 'N');
                isAudioRepeated = 'N';
            } else {
                localStorage.setItem("audioRepeat", 'Y');
                isAudioRepeated = 'Y';
            }
        });

        /* if (!isAudioScrolled) {
            try {
                localStorage.setItem("audioScroll", 'N');
                isAudioScrolled = 'Y';
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    console.error('LocalStorage quota exceeded. Cannot store more data.');
                } else {
                    console.error('An error occurred while accessing localStorage:', e);
                }
            }
        } else if (isAudioScrolled == 'Y') {
            audioAutoScrollCheck.classList.remove('hide');
        } */
        /* audioAutoScroll.addEventListener('click', () => {
            audioAutoScrollCheck.classList.toggle('hide');
            if (audioAutoScrollCheck.classList.contains('hide')) {
                localStorage.setItem("audioScroll", 'N');
                isAudioScrolled = 'N';
            } else {
                localStorage.setItem("audioScroll", 'Y');
                isAudioScrolled = 'Y';
            }
        }); */

        audio.addEventListener('ended', function () {
            if (isAudioRepeated == 'Y') {
                audioPlayPath.classList.add('hide');
                audioPausePath.classList.remove('hide');
                audio.play();
                requestAnimationFrame(whilePlaying);
                playState = 'pause';
            } else {
                audioPlayPath.classList.remove('hide');
                audioPausePath.classList.add('hide');
                playState = 'play';
            }
        });

        audioSlider.addEventListener('input', () => {
            audioPlayerDiv.style.setProperty('--seek-before-width', audioSlider.value / audioSlider.max * 100 + '%');
            audioCurrentTime.textContent = calculateTime(audioSlider.value);
            if (!audio.paused) {
                cancelAnimationFrame(raf);
            }
        });

        audioSlider.addEventListener('change', () => {
            audio.currentTime = audioSlider.value;
            if (!audio.paused) {
                requestAnimationFrame(whilePlaying);
            }
        });

        volumeSlider.addEventListener('input', () => {
            audioPlayerDiv.style.setProperty('--volume-before-width', volumeSlider.value / volumeSlider.max * 100 + '%');
            volumeValue.textContent = volumeSlider.value;
            audio.volume = (volumeSlider.value) / 100;
            if (audio.volume == 0) {
                volumeSoundPath.classList.add('hide');
                volumeMutePath.classList.remove('hide');
                audio.muted = true;
                muteState = 'mute';
            } else {
                volumeSoundPath.classList.remove('hide');
                volumeMutePath.classList.add('hide');
                audio.muted = false;
                muteState = 'unmute';
            }
        });

        audioPlayPause.addEventListener('click', () => {
            if (playState === 'play') {
                audioPlayPath.classList.add('hide');
                audioPausePath.classList.remove('hide');
                audio.play();
                requestAnimationFrame(whilePlaying);
                playState = 'pause';
            } else {
                audioPlayPath.classList.remove('hide');
                audioPausePath.classList.add('hide');
                audio.pause();
                cancelAnimationFrame(raf);
                playState = 'play';
            }
        });

        volumeMuteBtn.addEventListener('click', () => {
            if (muteState === 'unmute') {
                volumeSoundPath.classList.add('hide');
                volumeMutePath.classList.remove('hide');
                audio.muted = true;
                muteState = 'mute';
            } else {
                volumeSoundPath.classList.remove('hide');
                volumeMutePath.classList.add('hide');
                audio.muted = false;
                muteState = 'unmute';
            }
        });

        let audioMoreMenuClicked = false;
        audioMore.addEventListener('click', (e) => {
            e.stopPropagation();
            audioMoreMenu.classList.remove('no-opacity');
            audioMoreMenu.classList.add('active', 'enable-clicks');
            body.classList.add('disable-clicks');
            audioMore.setAttribute('aria-expanded', 'true');
            if (!audioMoreMenuClicked) {
                document.addEventListener('click', (event) => {
                    if (!audioMoreMenu.contains(event.target)) {
                        audioMoreMenu.classList.add('no-opacity');
                        audioMoreMenu.classList.remove('active', 'enable-clicks');
                        body.classList.remove('disable-clicks');
                        audioMore.setAttribute('aria-expanded', 'false');
                    }
                });
            }
            audioMoreMenuClicked = true;
        });

        let audioPlaySpeedMenuClicked = false;
        audioPlaySpeed.addEventListener('click', (e) => {
            e.stopPropagation();
            audioMoreMenu.classList.add('no-opacity');
            audioMoreMenu.classList.remove('active', 'enable-clicks');
            audioMore.setAttribute('aria-expanded', 'false');
            audioPlaySpeedMenu.classList.remove('no-opacity');
            audioPlaySpeedMenu.classList.add('active', 'enable-clicks');
            body.classList.add('disable-clicks');
            audioPlaySpeed.setAttribute('aria-expanded', 'true');
            if (!audioPlaySpeedMenuClicked) {
                document.addEventListener('click', (event) => {
                    if (!audioPlaySpeedMenu.contains(event.target)) {
                        audioPlaySpeedMenu.classList.add('no-opacity');
                        audioPlaySpeedMenu.classList.remove('active', 'enable-clicks');
                        body.classList.remove('disable-clicks');
                        audioPlaySpeed.setAttribute('aria-expanded', 'false');
                    }
                });
            }
            audioPlaySpeedMenuClicked = true;
        });

        let audioReciterMenuClicked = false;
        audioReciter.addEventListener('click', (e) => {
            e.stopPropagation();
            audioMoreMenu.classList.add('no-opacity');
            audioMoreMenu.classList.remove('active', 'enable-clicks');
            audioMore.setAttribute('aria-expanded', 'false');
            audioReciterMenu.classList.remove('no-opacity');
            audioReciterMenu.classList.add('active', 'enable-clicks');
            body.classList.add('disable-clicks');
            audioReciter.setAttribute('aria-expanded', 'true');
            if (!audioReciterMenuClicked) {
                document.addEventListener('click', (event) => {
                    if (!audioReciterMenu.contains(event.target)) {
                        audioReciterMenu.classList.add('no-opacity');
                        audioReciterMenu.classList.remove('active', 'enable-clicks');
                        body.classList.remove('disable-clicks');
                        audioReciter.setAttribute('aria-expanded', 'false');
                    }
                });
            }
            audioReciterMenuClicked = true;
        });

        const speedButtons = audioPlaySpeedMenu.querySelectorAll('button');
        speedButtons.forEach(button => {
            if (button.value == playbackSpeed) {
                button.firstElementChild.classList.add('audio-more-submenu__checked');
            } else {
                button.firstElementChild.classList.remove('audio-more-submenu__checked');
            }
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const speed = button.value;
                if (!isNaN(speed)) {
                    changePlaybackSpeed(speed);
                    let spans = audioPlaySpeedMenu.querySelectorAll('button span');
                    for (let i = 0; i < spans.length; i++) {
                        let span = spans[i];
                        if (span.classList.contains('audio-more-submenu__checked')) {
                            span.classList.remove('audio-more-submenu__checked');
                            break;
                        }
                    }
                    button.firstElementChild.classList.add('audio-more-submenu__checked');
                }
            });
        });

        const reciterButtons = audioReciterMenu.querySelectorAll('button');
        reciterButtons.forEach(button => {
            if (button.value == reciterName) {
                button.firstElementChild.classList.add('audio-more-submenu__checked');
            } else {
                button.firstElementChild.classList.remove('audio-more-submenu__checked');
            }
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const name = button.value;
                changeReciterFile(name);
                let spans = audioReciterMenu.querySelectorAll('button span');
                for (let i = 0; i < spans.length; i++) {
                    let span = spans[i];
                    if (span.classList.contains('audio-more-submenu__checked')) {
                        span.classList.remove('audio-more-submenu__checked');
                        break;
                    }
                }
                button.firstElementChild.classList.add('audio-more-submenu__checked');
            });
        });

        if ('mediaSession' in navigator) {
            navigator.mediaSession.setActionHandler('play', () => {
                if (playState === 'play') {
                    audioPlayPath.classList.add('hide');
                    audioPausePath.classList.remove('hide');
                    audio.play();
                    requestAnimationFrame(whilePlaying);
                    playState = 'pause';
                } else {
                    audioPlayPath.classList.remove('hide');
                    audioPausePath.classList.add('hide');
                    audio.pause();
                    cancelAnimationFrame(raf);
                    playState = 'play';
                }
            });
            navigator.mediaSession.setActionHandler('pause', () => {
                if (playState === 'play') {
                    audioPlayPath.classList.add('hide');
                    audioPausePath.classList.remove('hide');
                    audio.play();
                    requestAnimationFrame(whilePlaying);
                    playState = 'pause';
                } else {
                    audioPlayPath.classList.remove('hide');
                    audioPausePath.classList.add('hide');
                    audio.pause();
                    cancelAnimationFrame(raf);
                    playState = 'play';
                }
            });
            navigator.mediaSession.setActionHandler('seekbackward', (details) => {
                audio.currentTime = audio.currentTime - (details.seekOffset || 10);
            });
            navigator.mediaSession.setActionHandler('seekforward', (details) => {
                audio.currentTime = audio.currentTime + (details.seekOffset || 10);
            });
            navigator.mediaSession.setActionHandler('seekto', (details) => {
                if (details.fastSeek && 'fastSeek' in audio) {
                    audio.fastSeek(details.seekTime);
                    return;
                }
                audio.currentTime = details.seekTime;
            });
            navigator.mediaSession.setActionHandler('stop', () => {
                audio.currentTime = 0;
                audioSlider.value = 0;
                audioPlayerDiv.style.setProperty('--seek-before-width', '0%');
                audioCurrentTime.textContent = '00:00';
                if (playState === 'pause') {
                    audioPlayPath.classList.remove('hide');
                    audioPausePath.classList.add('hide');
                    audio.pause();
                    cancelAnimationFrame(raf);
                    playState = 'play';
                }
            });
        }
    });
});