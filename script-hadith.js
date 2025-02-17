document.addEventListener('DOMContentLoaded', () => {
    window.addEventListener('pageshow', () => {
        /* HADITH SETTINGS MENU TOGGLE */
        const hadithSettingsButton = document.getElementById('hadith-settings-button');
        const hadithSettingsCloseButton = document.getElementById('hadith-settings-close-button');
        const settingsSidebar = document.querySelector('.settings-sidebar');
        if (hadithSettingsButton) {
            let hadithSettingsClicked = false;
            hadithSettingsButton.addEventListener('click', (e) => {
                e.stopPropagation();
                settingsSidebar.classList.remove('no-opacity');
                settingsSidebar.classList.add('active');
                hadithSettingsButton.setAttribute('aria-expanded', 'true');
                if (!hadithSettingsClicked) {
                    document.addEventListener('click', (event) => {
                        if (!settingsSidebar.contains(event.target)) {
                            settingsSidebar.classList.add('no-opacity');
                            settingsSidebar.classList.remove('active');
                            hadithSettingsButton.setAttribute('aria-expanded', 'false');
                        }
                    });
                }
                hadithSettingsClicked = true;
            });
            hadithSettingsCloseButton.addEventListener('click', () => {
                settingsSidebar.classList.add('no-opacity');
                settingsSidebar.classList.remove('active');
                hadithSettingsButton.setAttribute('aria-expanded', 'false');
            });
        }

        let hadithBook = document.querySelector('.quran-settings-form input[type="hidden"]').name;
        let indexRadios = document.querySelectorAll('.hadith-index-language input[type="radio"]');
        if (indexRadios.length > 0) {
            let indexLanguage = localStorage.getItem(hadithBook + '-index');
            if (!indexLanguage) {
                try {
                    localStorage.setItem(hadithBook + '-index', 'en');
                } catch (e) {
                    if (e.name === 'QuotaExceededError') {
                        console.error('LocalStorage quota exceeded. Cannot store more data.');
                    } else {
                        console.error('An error occurred while accessing localStorage:', e);
                    }
                }
                indexLanguage = 'en';
            }
            document.getElementById(indexLanguage).checked = true;
            toggleIndexVisibility(indexLanguage);

            indexRadios.forEach(function (radio) {
                radio.addEventListener('change', (e) => {
                    let id = e.target.id;
                    toggleIndexVisibility(id);
                    try {
                        localStorage.setItem(hadithBook + '-index', radio.id);
                    } catch (e) {
                        if (e.name === 'QuotaExceededError') {
                            console.error('LocalStorage quota exceeded. Cannot store more data.');
                        } else {
                            console.error('An error occurred while accessing localStorage:', e);
                        }
                    }
                });
            });

            function toggleIndexVisibility(id) {
                let enIndexes = document.querySelectorAll('.book-index__kitab-eng');
                let urIndexes = document.querySelectorAll('.book-index__kitab-urdu');
                if (id == 'en') {
                    urIndexes.forEach(function (index) {
                        index.classList.add('hide');
                    });
                    enIndexes.forEach(function (index) {
                        index.classList.remove('hide');
                    });
                } else {
                    enIndexes.forEach(function (index) {
                        index.classList.add('hide');
                    });
                    urIndexes.forEach(function (index) {
                        index.classList.remove('hide');
                    });
                }
            }
        }

        let translatorCount = document.querySelector('.quran-settings-form input[type="hidden"]').value;
        if (translatorCount != 1) {
            let savedSelection = localStorage.getItem(hadithBook);
            if (!savedSelection) {
                let translator = document.querySelector('.quran-settings-form input[type="radio"]:first-of-type').id;
                try {
                    localStorage.setItem(hadithBook, translator);
                } catch (e) {
                    if (e.name === 'QuotaExceededError') {
                        console.error('LocalStorage quota exceeded. Cannot store more data.');
                    } else {
                        console.error('An error occurred while accessing localStorage:', e);
                    }
                }
                savedSelection = translator;
            }
            document.getElementById(savedSelection).checked = true;
            toggleVisibility(savedSelection);
            toggleChapterVisibility(savedSelection);
            toggleNoteVisibility(savedSelection);
            setTimeout(updateTranslatorInfo, 100);

            let radios = document.querySelectorAll('.quran-settings-form input[type="radio"]');
            radios.forEach(function (radio) {
                radio.addEventListener('change', (e) => {
                    let id = e.target.id;
                    toggleVisibility(id);
                    toggleChapterVisibility(id);
                    toggleNoteVisibility(id);
                    updateTranslatorInfo();
                    try {
                        localStorage.setItem(hadithBook, radio.id);
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
                let divsToShowHide = document.querySelectorAll('.divsToShowHide');
                divsToShowHide.forEach(function (div) {
                    if (div.classList.contains(id)) {
                        div.classList.remove('hide');
                    } else {
                        div.classList.add('hide');
                    }
                });
            }

            function toggleNoteVisibility(id) {
                let notesToShowHide = document.querySelectorAll('.noteToShowHide');
                if (notesToShowHide.length > 0) {
                    let firstTwoLetters = id.substring(0, 2);
                    if (firstTwoLetters == 'en') {
                        notesToShowHide.forEach(function (div) {
                            if (div.classList.contains('english-text')) {
                                div.classList.remove('hide');
                            } else {
                                div.classList.add('hide');
                            }
                        });
                    }
                    else if (firstTwoLetters == 'ur') {
                        notesToShowHide.forEach(function (div) {
                            if (div.classList.contains('urdu-text')) {
                                div.classList.remove('hide');
                            } else {
                                div.classList.add('hide');
                            }
                        });
                    }
                }
            }

            function toggleChapterVisibility(id) {
                let chapterToShowHide = document.querySelectorAll('.chapterToShowHide');
                if (chapterToShowHide.length > 0) {
                    let firstTwoLetters = id.substring(0, 2);
                    if (firstTwoLetters == 'en') {
                        chapterToShowHide.forEach(function (div) {
                            if (div.classList.contains('english-text')) {
                                div.classList.remove('hide');
                            } else {
                                div.classList.add('hide');
                            }
                        });
                    }
                    else if (firstTwoLetters == 'ur') {
                        chapterToShowHide.forEach(function (div) {
                            if (div.classList.contains('urdu-text')) {
                                div.classList.remove('hide');
                            } else {
                                div.classList.add('hide');
                            }
                        });
                    }
                }
            }

            function updateTranslatorInfo() {
                let translatorInfoDiv = document.getElementById('translator-info');
                if (translatorInfoDiv) {
                    radios.forEach(function (radio) {
                        if (radio.checked) {
                            let label = document.querySelector('label[for="' + radio.id + '"]').textContent.trim();
                            translatorInfoDiv.textContent = label;
                        }
                    });
                }
            }
        }
    });
});