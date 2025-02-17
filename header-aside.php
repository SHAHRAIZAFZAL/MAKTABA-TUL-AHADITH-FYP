<header class="flex-row">
    <div class="top-left-nav flex-row">
        <button id="button-hamburger" class="hamburger-button" aria-label="Secondary Navigation" aria-expanded="false"
            type="button">
            <svg class="hamburger-svg" viewBox="0 0 100 100" width="45" height="45">
                <path class="hamburger-svg__top"
                    d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20" />
                <path class="hamburger-svg__middle" d="m 30,50 h 40" />
                <path class="hamburger-svg__bottom"
                    d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20" />
            </svg>
        </button>
        <a class="top-left-nav__logo hide" href="<?php echo BASE_URL ?>index.php">
            <img src="<?php echo BASE_URL ?>images/logo-nav.png" alt="Main Logo of Maktaba tul Ahadith"
                title="Home Page" width="1140" height="270">
        </a>
    </div>

    <nav class="main-navbar" aria-label="Primary Horizontal Navbar">
        <ul class="main-navbar__list flex-row">
            <li class="home-tab-horizontal hide"><a class="hover-effect" href="<?php echo BASE_URL ?>index.php">
                    <span class="langDiv langDiv-en">Home</span><span class="langDiv langDiv-ur urdu-text hide-imp">صفحہ
                        اول</span></a>
            </li>
            <li><a class="hover-effect" href="<?php echo BASE_URL; ?>quran.php"><span
                        class="langDiv langDiv-en">Quran</span><span
                        class="langDiv langDiv-ur urdu-text hide-imp">قرآن</span></a>
                <ul class="main-navbar__list-dropdown" aria-label="Quran submenu in Primary Navbar">
                    <li><a class="hover-effect" href="<?php echo BASE_URL ?>quran/surah.php?surahID=1"><span
                                class="langDiv langDiv-en">Surah Al-Fatihah</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">سورۃ الفاتحہ</span></a></li>
                    <li><a class="hover-effect" href="<?php echo BASE_URL ?>quran/surah.php?surahID=18"><span
                                class="langDiv langDiv-en">Surah Al-Kahf</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">سورۃ الکہف</span></a></li>
                    <li><a class="hover-effect" href="<?php echo BASE_URL ?>quran/surah.php?surahID=36"><span
                                class="langDiv langDiv-en">Surah Ya-Seen</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">سورۃ یس</span></a></li>
                    <li><a class="hover-effect" href="<?php echo BASE_URL ?>quran/surah.php?surahID=67"><span
                                class="langDiv langDiv-en">Surah Al-Mulk</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">سورۃ الملک</span></a></li>
                </ul>
            </li>
            <li><a class="hover-effect" href="<?php echo BASE_URL ?>hadith.php"><span
                        class="langDiv langDiv-en">Hadith</span><span
                        class="langDiv langDiv-ur urdu-text hide-imp">حدیث</span></a>
                <ul class="main-navbar__list-dropdown" aria-label="Hadith submenu in Primary Navbar">
                    <li><a class="hover-effect"
                            href="<?php echo BASE_URL ?>hadith/hadith-book.php?hadithBookID=1&hadithBookName=sahih-bukhari"><span
                                class="langDiv langDiv-en">Sahih Bukhari</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">صحیح بخاری</span></a>
                    </li>
                    <li><a class="hover-effect"
                            href="<?php echo BASE_URL ?>hadith/hadith-book.php?hadithBookID=2&hadithBookName=sahih-muslim"><span
                                class="langDiv langDiv-en">Sahih Muslim</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">صحیح مسلم</span></a>
                    </li>
                    <li><a class="hover-effect"
                            href="<?php echo BASE_URL ?>hadith/hadith-book.php?hadithBookID=3&hadithBookName=sunan-abu-dawud"><span
                                class="langDiv langDiv-en">Sunan Abu Dawud</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">سنن ابو داؤد</span></a></li>
                    <li><a class="hover-effect"
                            href="<?php echo BASE_URL ?>hadith/hadith-book.php?hadithBookID=4&hadithBookName=jamia-sunan-tirmidhi"><span
                                class="langDiv langDiv-en">Jamia Sunan Tirmidhi</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">جامع سنن ترمذی</span></a>
                    </li>
                    <li><a class="hover-effect"
                            href="<?php echo BASE_URL ?>hadith/hadith-book.php?hadithBookID=5&hadithBookName=sunan-nasai"><span
                                class="langDiv langDiv-en">Sunan Nasai</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">سنن نسائی</span></a>
                    </li>
                    <li><a class="hover-effect"
                            href="<?php echo BASE_URL ?>hadith/hadith-book.php?hadithBookID=6&hadithBookName=sunan-ibn-majah"><span
                                class="langDiv langDiv-en">Sunan Ibn Majah</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">سنن ابن ماجہ</span></a></li>
                    <li><a class="hover-effect"
                            href="<?php echo BASE_URL ?>hadith/hadith-book.php?hadithBookID=7&hadithBookName=musnad-ahmad"><span
                                class="langDiv langDiv-en">Musnad Ahmad</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">مسند احمد</span></a>
                    </li>
                    <li><a class="hover-effect"
                            href="<?php echo BASE_URL ?>hadith/hadith-book.php?hadithBookID=8&hadithBookName=mishkat-al-masabih"><span
                                class="langDiv langDiv-en">Mishkat al-Masabih</span><span
                                class="langDiv langDiv-ur urdu-text hide-imp">مشکوٰۃ المصابیح</span></a></li>
                </ul>
            </li>
            <li><a class="hover-effect" href="<?php echo BASE_URL ?>books.php"><span
                        class="langDiv langDiv-en">Books</span><span
                        class="langDiv langDiv-ur urdu-text hide-imp">کتابیں</span></a></li>
            <li class="search-tab-horizontal hide"><a class="hover-effect"
                    href="<?php echo BASE_URL ?>search-text.php"><span class="langDiv langDiv-en">Search
                        Text</span><span class="langDiv langDiv-ur urdu-text hide-imp">الفاظ تلاش کریں</span></a>
            </li>
        </ul>
    </nav>

    <div class="top-right-nav flex-row">
        <button id="button-settings" title="Settings" class="top-right-nav__icon" aria-label="Settings Button"
            type="button" aria-expanded="false">
            <svg class="svg-settings" aria-label="Settings Icon" width="30" height="30" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M10.125 22q-.375 0-.65-.25t-.325-.625l-.3-2.325q-.325-.125-.612-.3t-.563-.375l-2.175.9q-.35.15-.7.038t-.55-.438L2.4 15.4q-.2-.325-.125-.7t.375-.6l1.875-1.425Q4.5 12.5 4.5 12.338v-.675q0-.163.025-.338L2.65 9.9q-.3-.225-.375-.6t.125-.7l1.85-3.225q.2-.325.55-.437t.7.037l2.175.9q.275-.2.575-.375t.6-.3l.3-2.325q.05-.375.325-.625t.65-.25h3.75q.375 0 .65.25t.325.625l.3 2.325q.325.125.613.3t.562.375l2.175-.9q.35-.15.7-.038t.55.438L21.6 8.6q.2.325.125.7t-.375.6l-1.875 1.425q.025.175.025.338v.674q0 .163-.05.338l1.875 1.425q.3.225.375.6t-.125.7l-1.85 3.2q-.2.325-.562.45t-.713-.025l-2.125-.9q-.275.2-.575.375t-.6.3l-.3 2.325q-.05.375-.325.625t-.65.25zm1.925-6.5q1.45 0 2.475-1.025T15.55 12q0-1.45-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12q0 1.45 1.013 2.475T12.05 15.5" />
            </svg>
        </button>
        <div class="pop-up-menu settings-menu no-opacity">
            <button id="settings-menu-close-button" class="settings-sidebar-close-button" type="button"
                aria-label="Button to close prayer timing calculation settings">
                <svg width="30" height="30" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                </svg>
            </button>
            <div class="settings-menu__div settings-menu__language">
                <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Language</h4>
                <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">زبان</h4>
                <div class="settings-menu__div-buttons flex-row">
                    <button type="button" class="button-type-1 hover-effect" id="btn-lang-en">
                        <span class="langDiv langDiv-en fontDiv fontDiv-s">ENGLISH</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">انگریزی</span>
                    </button>
                    <button type="button" class="button-type-1 hover-effect" id="btn-lang-ur">
                        <span class="langDiv langDiv-en fontDiv fontDiv-s">URDU</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">اردو</span>
                    </button>
                </div>
            </div>
            <div class="settings-menu__div settings-menu__fontsize">
                <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Font Size</h4>
                <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">فونٹ سائز</h4>
                <div class="settings-menu__div-buttons flex-row">
                    <button type="button" class="button-type-1 button-links hover-effect" id="btn-font-s">
                        <span class="langDiv langDiv-en fontDiv fontDiv-s">SMALL</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">چھوٹا</span>
                    </button>
                    <button type="button" class="button-type-1 hover-effect" id="btn-font-m">
                        <span class="langDiv langDiv-en fontDiv fontDiv-s">MEDIUM</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">درمیانہ</span>
                    </button>
                    <button type="button" class="button-type-1 button-links hover-effect" id="btn-font-l">
                        <span class="langDiv langDiv-en fontDiv fontDiv-s">LARGE</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">بڑا</span>
                    </button>
                </div>
            </div>
            <div class="settings-menu__div settings-menu__theme">
                <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Color Theme</h4>
                <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">ویب سائٹ تھیم</h4>
                <div class="settings-menu__div-buttons flex-row">
                    <button type="button" class="button-colored active" title="Black Theme"
                        id="btn-theme-black"></button>
                    <button type="button" class="button-colored" title="White Theme" id="btn-theme-white"></button>
                    <button type="button" class="button-colored" title="Grey Theme" id="btn-theme-grey"></button>
                    <button type="button" class="button-colored" title="Golden Theme" id="btn-theme-golden"></button>
                    <button type="button" class="button-colored" title="Red Theme" id="btn-theme-red"></button>
                    <button type="button" class="button-colored" title="Green Theme" id="btn-theme-green"></button>
                    <button type="button" class="button-colored" title="Blue Theme" id="btn-theme-blue"></button>
                </div>
            </div>
        </div>

        <?php
        echo '<div class="account-response';
        if (isset($_SESSION['message']) && isset($_SESSION['messageClass'])) {
            echo ' active"><p class="' . $_SESSION['messageClass']
                . '">' . $_SESSION['message'] . '</p></div>';
            unset($_SESSION['message']);
            unset($_SESSION['messageClass']);
        } else {
            echo '"></div>';
        }
        ?>

        <button id="button-user-account" title="User Account" class="top-right-nav__icon"
            aria-label="User Account Button" type="button" aria-expanded="false">
            <?php if (isset($_COOKIE['cookieUsername'])) { ?>
                <svg class="svg-user-logged-in" aria-label="User Account Icon Logged In" width="30" height="30"
                    viewBox="0 0 640 512">
                    <path fill="currentColor"
                        d="M96 128a128 128 0 1 1 256 0a128 128 0 1 1-256 0zM0 482.3C0 383.8 79.8 304 178.3 304h91.4c98.5 0 178.3 79.8 178.3 178.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM625 177L497 305c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L591 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                </svg>
            <?php } else { ?>
                <svg class="svg-user" aria-label="User Account Icon" width="30" height="30" viewBox="0 0 448 512">
                    <path fill="currentColor"
                        d="M224 256a128 128 0 1 0 0-256a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512h388.6c16.4 0 29.7-13.3 29.7-29.7c0-98.5-79.8-178.3-178.3-178.3h-91.4z" />
                </svg>
            <?php } ?>
        </button>
        <div class="pop-up-menu user-account no-opacity">
            <button id="user-account-close-button" class="settings-sidebar-close-button" type="button"
                aria-label="Button to close prayer timing calculation settings">
                <svg width="30" height="30" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                </svg>
            </button>

            <?php if (isset($_COOKIE['cookieUsername'])) { ?>
                <div class="user-profile">
                    <p class="user-profile__welcome center langDiv langDiv-en fontDiv fontDiv-m">WELCOME BACK
                        <?php echo $_COOKIE['cookieUsername'] ?>
                    </p>
                    <p class="user-profile__welcome center urdu-text langDiv langDiv-ur fontDiv fontDiv-ml">خوش آمدید،
                        <?php echo $_COOKIE['cookieUsername'] ?>
                    </p>
                    <form class="user-account__form flex-column" method="post" id="logout-form">
                        <button type="submit" class="user-account__button button-type-1 hover-effect" name="submit-logout"
                            id="submit-logout">
                            <span class="langDiv langDiv-en fontDiv fontDiv-s">Log out</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">لاگ آؤٹ</span>
                        </button>
                    </form>
                </div>

            <?php } else { ?>
                <div class="tab">
                    <input class="tab__input" type="radio" name="tab-login-register" id="tab-login" checked="checked" />
                    <label class="tab__label" for="tab-login">
                        <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Log in</h4>
                        <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">لاگ ان</h4>
                    </label>
                    <div id="login-tab-first" class="tab__content">
                        <form class="user-account__form flex-column" method="post" id="login-form">
                            <div class="user-account__form-div">
                                <input class="input-without-label" type="text" placeholder="Username / Email"
                                    id="username-login" name="username-login" autocomplete="username">
                                <span class="error-message"></span>
                                <span class="loader hide-imp" id="loader-username-login"></span>
                            </div>
                            <div class="user-account__form-div">
                                <input class="input-without-label" type="password" placeholder="Password"
                                    id="password-login" name="password-login" autocomplete="current-password">
                                <span class="error-message"></span>
                                <span class="loader hide-imp" id="loader-password-login"></span>
                            </div>
                            <button type="submit" class="user-account__button button-type-1 hover-effect"
                                name="submit-login" id="submit-login">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Log in</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">لاگ ان</span>
                            </button>
                            <!-- TO BE CONTINUED (RESET PASSWORD FUNCTIONALITY)
                            <button type="button" id="forgot-btn" class="user-account__forgot button-links">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Forgot Password?</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">پاس ورڈ بھول
                                    گئے؟</span>
                            </button> -->
                        </form>
                    </div>
                    <div id="login-tab-second" class="tab__content hide-imp">
                        <form class="user-account__form flex-column" method="post" id="reset-form">
                            <div class="user-account__form-div">
                                <input class="input-without-label" type="email" placeholder="Enter email of your account"
                                    id="email-reset" name="email-reset" autocomplete="email">
                                <span class="error-message"></span>
                                <span class="loader hide-imp" id="loader-email-reset"></span>
                            </div>
                            <button type="submit" class="user-account__button button-type-1 hover-effect"
                                name="submit-reset" id="submit-reset">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Reset Password</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">پاس ورڈ تبدیل
                                    کریں</span>
                            </button>
                            <button type="button" id="forgot-back-btn" class="user-account__forgot button-links">
                                <span class="disable-clicks langDiv langDiv-en fontDiv fontDiv-s">Back to Log in</span>
                                <span class="disable-clicks langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">لاگ ان
                                    کی طرف</span>
                            </button>
                        </form>
                    </div>
                    <input class="tab__input" type="radio" name="tab-login-register" id="tab-register" />
                    <label class="tab__label" for="tab-register">
                        <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Register</h4>
                        <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">رجسٹریشن</h4>
                    </label>
                    <div class="tab__content">
                        <form class="user-account__form flex-column" method="post" id="registration-form">
                            <div class="user-account__form-div">
                                <input class="input-without-label" type="text" placeholder="Username" id="username-reg"
                                    name="username-reg" autocomplete="username">
                                <span class="error-message"></span>
                                <span class="loader hide-imp" id="loader-username-reg"></span>
                            </div>
                            <div class="user-account__form-div">
                                <input class="input-without-label" type="email" placeholder="Email" id="email-reg"
                                    name="email-reg" autocomplete="email">
                                <span class="error-message"></span>
                                <span class="loader hide-imp" id="loader-email-reg"></span>
                            </div>
                            <div class="user-account__form-div">
                                <input class="input-without-label" type="password" placeholder="Password" id="password-reg"
                                    name="password-reg" autocomplete="new-password">
                                <span class="error-message"></span>
                            </div>
                            <div class="user-account__form-div">
                                <input class="input-without-label" type="password" placeholder="Re-enter Password"
                                    id="password-repeat-reg" name="password-repeat-reg" autocomplete="new-password">
                                <span class="error-message"></span>
                            </div>
                            <button type="submit" class="user-account__button button-type-1 hover-effect" name="submit-reg"
                                id="submit-reg">
                                <span class="disable-clicks langDiv langDiv-en fontDiv fontDiv-s">Register</span>
                                <span
                                    class="disable-clicks langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">رجسٹر</span>
                            </button>
                        </form>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</header>

<aside>
    <nav class="secondary-navbar" aria-label="Secondary Vertical Sidebar">
        <ul class="secondary-navbar__list flex-column">
            <li class="home-tab-vertical"><a href="<?php echo BASE_URL ?>index.php" class="flex-row">
                    <svg class="svg-home" aria-label="Home Page Icon" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
                    </svg>
                    <span class="sidebar-names langDiv langDiv-en">Home</span>
                    <span class="sidebar-names langDiv langDiv-ur urdu-text hide-imp">صفحہ اول</span>
                </a><span class="sidebar-tooltip langDiv langDiv-en">Home</span><span
                    class="sidebar-tooltip langDiv langDiv-ur urdu-text hide-imp">صفحہ اول</span></li>
            <li class="search-tab-vertical"><a href="<?php echo BASE_URL ?>search-text.php" class="flex-row">
                    <svg class="svg-search-text" aria-label="Search Text Icon" width="30" height="30"
                        viewBox="0 0 32 32">
                        <path stroke-width="0"
                            d="m30 28.586l-4.689-4.688a8.028 8.028 0 1 0-1.414 1.414L28.586 30zM19 25a6 6 0 1 1 6-6a6.007 6.007 0 0 1-6 6zM2 12h8v2H2zM2 2h16v2H2zm0 5h16v2H2z" />
                        <circle cx="19" cy="19" r="6" fill="currentColor" />
                    </svg>
                    <span class="sidebar-names langDiv langDiv-en">Search Text</span>
                    <span class="sidebar-names langDiv langDiv-ur urdu-text hide-imp">الفاظ تلاش کریں</span>
                </a><span class="sidebar-tooltip langDiv langDiv-en">Search Text</span><span
                    class="sidebar-tooltip langDiv langDiv-ur urdu-text hide-imp">الفاظ تلاش کریں</span></li>
            <li><a href="<?php echo BASE_URL ?>chatbot.php" class="flex-row">
                    <svg class="svg-ai-chatbot" aria-label="AI Chatbot Icon" viewBox="0 0 1024 1024" width="30"
                        height="30">
                        <path
                            d="m577.27 804.78-41.85.78-166.87 110.62c-.57.41-1.36 0-1.36-.7V804.34h-81.51c-59 0-106.81-47.82-106.81-106.81V394.45c0-58.99 47.81-106.81 106.81-106.81H738.33c58.99 0 106.81 47.82 106.81 106.81v303.08c0 58.99-47.82 106.81-106.81 106.81l-43.64.44H577.27z">
                        </path>
                        <circle cx="389.34" cy="448.2" r="61.34"></circle>
                        <circle cx="635.34" cy="448.2" r="61.34"></circle>
                        <path
                            d="M847.21 634.45V463.13h46.48c19.39 0 35.11 15.72 35.11 35.11v101.11c0 19.39-15.72 35.11-35.11 35.11h-46.48zM95.2 599.35V498.24c0-19.39 15.72-35.11 35.11-35.11h46.48v171.33h-46.48c-19.39-.01-35.11-15.73-35.11-35.11zm546.66 6.99c-8.57 61.51-64.53 109-132.32 109-67.77 0-123.75-47.49-132.32-109h264.64z">
                        </path>
                        <circle cx="509.54" cy="149.59" r="41.94"></circle>
                        <path d="M509.54 244.21v-52.68"></path>
                    </svg>
                    <span class="sidebar-names langDiv langDiv-en">AI Chatbot</span>
                    <span class="sidebar-names langDiv langDiv-ur urdu-text hide-imp">چیٹ بوٹ</span>
                </a><span class="sidebar-tooltip langDiv langDiv-en">AI Chatbot</span><span
                    class="sidebar-tooltip langDiv langDiv-ur urdu-text hide-imp">چیٹ بوٹ</span></li>
            <li><a href="<?php echo BASE_URL ?>biographies.php" class="flex-row">
                    <svg class="svg-biographies" aria-label="Biographies Icon" width="30" height="30"
                        viewBox="0 0 64 64">
                        <path stroke-width="0.5"
                            d="M61.383,2.076c-0.373-0.154-0.804-0.07-1.09,0.217L50,12.586V5c0-0.552-0.447-1-1-1H8c-3.309,0-6,2.691-6,6v46  c0,3.309,2.691,6,6,6h41c0.553,0,1-0.448,1-1V33.414l4.678-4.678c4.722-4.722,7.322-11,7.322-17.677V3  C62,2.596,61.757,2.231,61.383,2.076z M48,60H8c-2.206,0-4-1.794-4-4s1.794-4,4-4h40V60z M48,50H8c-1.538,0-2.937,0.586-4,1.54V10  c0-2.206,1.794-4,4-4h40v8.586L34.293,28.293C34.105,28.48,34,28.735,34,29v8.586l-5.707,5.707l1.414,1.414L35.414,39H44  c0.266,0,0.52-0.105,0.707-0.293L48,35.414V50z M60,11.059c0,6.144-2.393,11.919-6.736,16.263L43.586,37h-6.172l16.293-16.293  l-1.414-1.414L36,35.586v-6.172l24-24V11.059z" />
                        <path
                            d="M26,29c5.514,0,10-4.486,10-10S31.514,9,26,9s-10,4.486-10,10S20.486,29,26,29z M21.081,25.296  C21.427,22.857,23.491,21,26,21s4.573,1.857,4.919,4.296C29.56,26.36,27.855,27,26,27S22.44,26.36,21.081,25.296z M24,17  c0-1.103,0.897-2,2-2s2,0.897,2,2s-0.897,2-2,2S24,18.103,24,17z M26,11c4.411,0,8,3.589,8,8c0,1.699-0.536,3.273-1.443,4.57  c-0.639-1.734-1.942-3.132-3.595-3.906C29.6,18.955,30,18.027,30,17c0-2.206-1.794-4-4-4s-4,1.794-4,4  c0,1.027,0.4,1.955,1.038,2.664c-1.653,0.774-2.956,2.172-3.595,3.906C18.536,22.273,18,20.699,18,19C18,14.589,21.589,11,26,11z" />
                        <rect x="17" y="43" width="10" height="2" />
                        <rect x="17" y="38" width="13" height="2" />
                        <rect x="17" y="33" width="15" height="2" />
                    </svg>
                    <span class="sidebar-names langDiv langDiv-en">Biographies</span>
                    <span class="sidebar-names langDiv langDiv-ur urdu-text hide-imp">سوانح حیات</span>
                </a><span class="sidebar-tooltip langDiv langDiv-en">Biographies</span><span
                    class="sidebar-tooltip langDiv langDiv-ur urdu-text hide-imp">سوانح حیات</span></li>
            <li><a href="<?php echo BASE_URL ?>prayer-timings.php" class="flex-row">
                    <svg class="svg-prayer-timings" aria-label="Prayer Timings Icon" width="30" height="30"
                        viewBox="0 0 48 48">
                        <path
                            d="M35.46 20.175v1.334m-1.713-1.334v1.334m-1.713-1.334v1.334m-1.714-1.334v1.334m-1.711-1.334v1.334m-1.714-1.334v1.334m-1.713-1.334v1.334m5.068-11.224c-1.093.913-1.615 1.681-3.406 2.73c-4.377 2.565-3.362 5.582-3.345 8.494m13.556 0c.017-2.912 1.032-5.93-3.346-8.495c-1.79-1.048-2.313-1.816-3.46-2.729V8.732m1.63-1.94A1.593 1.593 0 1 1 30.285 5.2h.002m2.783-3.726l.658 1.333l1.47.214l-1.063 1.038l.251 1.465l-1.316-.692l-1.316.692l.252-1.465l-1.064-1.038l1.47-.214l.658-1.333Zm-9.467 29.199v-7.386h13.443v9.68m-9.326 1.167v-3.516a2.434 2.434 0 0 1 2.44-2.44h.299a2.435 2.435 0 0 1 2.44 2.44v3.588M45.5 23.608a15.84 15.84 0 0 1-15.016 10.797m-7.107-1.68c-5.179-2.605-8.734-7.968-8.734-14.161A15.842 15.842 0 0 1 28.138 2.898M45.476 23.6c.002.136.004.272.004.409h0c0 11.868-9.62 21.49-21.489 21.49c-11.868 0-21.49-9.62-21.491-21.49h0c0-11.868 9.622-21.489 21.491-21.488h0c1.393 0 2.783.135 4.15.404" />
                    </svg>
                    <span class="sidebar-names langDiv langDiv-en">Prayer Timings</span>
                    <span class="sidebar-names langDiv langDiv-ur urdu-text hide-imp">نماز کے اوقات</span>
                </a><span class="sidebar-tooltip langDiv langDiv-en">Prayer Timings</span><span
                    class="sidebar-tooltip langDiv langDiv-ur urdu-text hide-imp">نماز کے اوقات</span></li>
            <li><a href="<?php echo BASE_URL ?>hijri-calendar.php" class="flex-row">
                    <svg class="svg-hijri-calendar" aria-label="Hijri Calendar Icon" width="30" height="30"
                        viewBox="0 0 96 96" stroke-width="1">
                        <g>
                            <path fill="none" stroke-width="3"
                                d="M86,12H74V9a2,2,0,0,0-4,0v7a1.9983,1.9983,0,0,0,1.25,1.8517A2.0074,2.0074,0,0,1,68.5,16V12H26V9a2,2,0,0,0-4,0v7a1.9983,1.9983,0,0,0,1.25,1.8517A2.0074,2.0074,0,0,1,20.5,16V12H10a6.0066,6.0066,0,0,0-6,6V78a6.0066,6.0066,0,0,0,6,6H86a6.0066,6.0066,0,0,0,6-6c.0192-8.1257-.0139-52.9662,0-60A6.0066,6.0066,0,0,0,86,12Zm4,66a4.0042,4.0042,0,0,1-4,4H10a4.0042,4.0042,0,0,1-4-4V30H90Z" />
                            <path
                                d="M60.3105,65.7412a.9974.9974,0,0,0-1.1181-.3808C50.3944,68.2592,40.85,61.2847,41,52a14.059,14.059,0,0,1,6.9267-12.0658.9983.9983,0,0,0,.4677-1.0845c-.264-1.0519-1.562-.7754-2.3945-.85-23.8779.9882-23.8739,35.0141,0,36a17.8722,17.8722,0,0,0,14.2851-7.0776A1,1,0,0,0,60.3105,65.7412Z" />
                            <path
                                d="M67.9512,47.9351a1,1,0,0,0-.85-.6856l-6.5352-.6655L57.915,40.5752a1,1,0,0,0-1.83,0L53.4336,46.584l-6.5352.6655a1,1,0,0,0-.5654,1.74l4.8955,4.3794-1.3867,6.42a1,1,0,0,0,1.48,1.0752L57,57.562l5.6777,3.3023a1,1,0,0,0,1.48-1.0752l-1.3867-6.42,4.8955-4.3794A1.0008,1.0008,0,0,0,67.9512,47.9351Z" />
                        </g>
                    </svg>
                    <span class="sidebar-names langDiv langDiv-en">Hijri Calendar</span>
                    <span class="sidebar-names langDiv langDiv-ur urdu-text hide-imp">ہجری کیلنڈر</span>
                </a><span class="sidebar-tooltip langDiv langDiv-en">Hijri Calendar</span><span
                    class="sidebar-tooltip langDiv langDiv-ur urdu-text hide-imp">ہجری کیلنڈر</span></li>
            <li><a href="<?php echo BASE_URL ?>zakat-calculator.php" class="flex-row">
                    <svg class="svg-zakat-calculator" aria-label="Zakat Calculator Icon" width="30" height="30"
                        viewBox="0 0 64 64">
                        <path stroke-width="0.5"
                            d="M46.12,30.15a1.13,1.13,0,0,1,0-2.25,1.13,1.13,0,0,1,0,2.25Zm7.15,31a5.49,5.49,0,0,0,1.18-1.77l0-.08.08-.23s0,0,0-.09a4.78,4.78,0,0,0,.22-1,5.46,5.46,0,0,0-5.1-6.13c0-1.82.12-14.9-.11-16.39a10.06,10.06,0,0,0,6.51-9.37c.1-7.84-9-12.76-15.49-8.35L37.88,15a3.09,3.09,0,0,0-1-6l1.54-4.23A2.6,2.6,0,0,0,36,1.25H26.71a2.6,2.6,0,0,0-2.35,3.5L25.9,9a3.09,3.09,0,0,0-1,6l-4,4A27,27,0,0,0,13,38v13.9a5.44,5.44,0,0,0,.3,10.88H49.42A5.42,5.42,0,0,0,53.27,61.15ZM9.4,57.58a4.17,4.17,0,0,1,0-.79.35.35,0,0,0,0-.06c0-.13.05-.27.09-.43a4,4,0,0,1,3.81-2.94h6.29a.75.75,0,0,0,0-1.5H14.53V38A25.49,25.49,0,0,1,22,20.06l4.93-4.93h9l3.56,3.56C31.94,25.5,38.19,37.9,48.14,35.9c.17,1,0,14.63.08,16H43.13a.75.75,0,0,0,0,1.5h6.13a4.11,4.11,0,0,1,4.07,4.45s0,0,0,.07a1.57,1.57,0,0,1,0,.23c0,.1-.05.2-.08.33a.26.26,0,0,0,0,.1.36.36,0,0,0,0,.11l-.05.11v0c-.07.13-.11.28-.19.4l-.19.32h0a4,4,0,0,1-3.27,1.75H13.63A4.2,4.2,0,0,1,9.4,57.58ZM37.63,26A8.36,8.36,0,0,1,41,19.36l0,0h0c5.44-4.26,13.71-.14,13.62,6.77a8.54,8.54,0,0,1-6,8.13h0A8.53,8.53,0,0,1,37.63,26ZM36.18,13.63H25.7a1.58,1.58,0,0,1,0-3.15H37.05a1.58,1.58,0,0,1,0,3.15h-.87ZM25.77,4.23A1.1,1.1,0,0,1,27,2.75l.78,2.15a.75.75,0,0,0,1.41-.51l-.6-1.64h2v1.9a.76.76,0,0,0,.76.75.75.75,0,0,0,.74-.75V2.75h2l-.6,1.64A.75.75,0,0,0,35,4.9l.78-2.15A1.1,1.1,0,0,1,37,4.23L35.26,9H27.49Zm15.29,35a.75.75,0,0,0-1.44-.36C36.8,45.43,27,43.47,26.9,36.28A6.59,6.59,0,0,1,31,30.17a.75.75,0,0,0-.36-1.44,9.46,9.46,0,0,0-8.5,9.43C22.5,50.1,39.43,51,41.06,39.18ZM25.4,36.28a8.15,8.15,0,0,0,12.52,6.81A8,8,0,1,1,26.7,31.86,8.12,8.12,0,0,0,25.4,36.28Zm5.9,4.25,1.9-1,1.91,1a.77.77,0,0,0,.81-.08.76.76,0,0,0,.26-.77L35.74,38l1.4-1.65a.76.76,0,0,0-.42-1.22l-1.82-.37L33.84,33a.78.78,0,0,0-1.28,0l-1.05,1.73-1.82.37a.75.75,0,0,0-.42,1.22L30.67,38l-.44,1.73A.76.76,0,0,0,31.3,40.53Zm.83-4.41c.48,0,.83-1,1.07-1.31.25.33.6,1.27,1.08,1.31l.9.18c-.3.43-1.18,1.09-1,1.64l.13.49-.77-.4c-.44-.29-1.07.23-1.46.4l.12-.49c.19-.55-.68-1.21-1-1.64ZM32,35.39h0ZM52,29V26.11a.75.75,0,0,0-.75-.75H49.15V24h2.09a.75.75,0,0,0,0-1.5H48.4a.75.75,0,0,0-.75.75v2.91a.76.76,0,0,0,.75.75h2.09v1.41H48.4a.75.75,0,0,0,0,1.5h2.84A.74.74,0,0,0,52,29Zm-7.4,0a.76.76,0,0,0-.75-.75H41.75V26.86h2.09a.76.76,0,0,0,.75-.75V23.2a.75.75,0,0,0-.75-.75H41A.75.75,0,0,0,41,24h2.09v1.41H41a.75.75,0,0,0-.75.75V29a.74.74,0,0,0,.75.75h2.84A.75.75,0,0,0,44.59,29Z" />
                    </svg>
                    <span class="sidebar-names langDiv langDiv-en">Zakat Calculator</span>
                    <span class="sidebar-names langDiv langDiv-ur urdu-text hide-imp">زکوٰۃ کیلکولیٹر</span>
                </a><span class="sidebar-tooltip langDiv langDiv-en">Zakat Calculator</span><span
                    class="sidebar-tooltip langDiv langDiv-ur urdu-text hide-imp">زکوٰۃ کیلکولیٹر</span></li>
            <li><a href="<?php echo BASE_URL ?>articles.php" class="flex-row">
                    <svg class="svg-articles" aria-label="Articles Icon" width="30" height="30"
                        viewBox="0 0 26566 31000">
                        <path
                            d="M0 0l22467 0 0 23546 -1180 0 0 -22365 -20106 0 0 28304 20106 0 0 -1556 1180 0 0 2737 -22467 0 0 -30666zm25488 24659l-1088 0 0 2156 1088 0c593,0 1078,-485 1078,-1078l0 0c0,-593 -485,-1078 -1078,-1078zm-15185 0l13318 0 0 2156 -13318 0 0 -2156zm-697 0l-2174 823 -880 0c-140,0 -255,115 -255,255l0 0c0,141 115,256 255,256l880 0 2174 822 0 -1078 0 -1078zm-5950 -11026l15156 0 0 912 -15156 0 0 -912zm0 -9343l15156 0 0 911 -15156 0 0 -911zm0 2335l15156 0 0 912 -15156 0 0 -912zm0 2336l15156 0 0 912 -15156 0 0 -912zm0 2336l15156 0 0 912 -15156 0 0 -912zm0 9344l10511 0 0 911 -10511 0 0 -911zm0 -2336l15156 0 0 911 -15156 0 0 -911zm0 -2336l15156 0 0 912 -15156 0 0 -912z" />
                    </svg>
                    <span class="sidebar-names langDiv langDiv-en">Articles</span>
                    <span class="sidebar-names langDiv langDiv-ur urdu-text hide-imp">مضامین</span>
                </a><span class="sidebar-tooltip langDiv langDiv-en">Articles</span><span
                    class="sidebar-tooltip langDiv langDiv-ur urdu-text hide-imp">مضامین</span></li>
            <li><a href="<?php echo BASE_URL ?>arabic-course.php" class="flex-row">
                    <svg class="svg-arabic-course" aria-label="Arabic Course Icon" width="30" height="30"
                        viewBox="0 0 20 20">
                        <path
                            d="M6.89 11.9c0 1.57 1.61 2.44 4.85 2.63l2.55-.04l.37.05c-.03.14-.29.4-.77.76l-.1.07A6.97 6.97 0 0 1 9.63 17a4.3 4.3 0 0 1-3.16-1.16a4.3 4.3 0 0 1-1.13-3.15c0-1.58.66-3 1.96-4.27v-.05l-.7-.64A1.11 1.11 0 0 1 6.33 7c0-.58.28-1.3.84-2.18C7.93 3.6 8.7 3 9.46 3c1.03 0 1.89.49 2.56 1.45c.38.56-.03.65-1.24.26c-.98-.38-1.78-.06-2.4.96l.02.1l1.31 1h.06c1.64-.57 2.82-.86 3.55-.84a5.5 5.5 0 0 0-.28.86a32.4 32.4 0 0 1-.36 1.14l-.14.44l-.45.05c-2.04.28-3.5.84-4.37 1.67a2.5 2.5 0 0 0-.83 1.78" />
                    </svg>
                    <span class="sidebar-names langDiv langDiv-en">Arabic Course</span>
                    <span class="sidebar-names langDiv langDiv-ur urdu-text hide-imp">عربی کورس</span>
                </a><span class="sidebar-tooltip langDiv langDiv-en">Arabic Course</span><span
                    class="sidebar-tooltip langDiv langDiv-ur urdu-text hide-imp">عربی کورس</span></li>
        </ul>
    </nav>
</aside>