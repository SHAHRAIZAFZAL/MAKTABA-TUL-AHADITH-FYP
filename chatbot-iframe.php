<body>
    <script src='https://cdn.botpress.cloud/webchat/v1/inject.js'></script>
    <script>
        window.botpressWebChat.init({
            'composerPlaceholder': 'Enter your prompt here...',
            'botConversationDescription': 'Ask any query related to Quran and Hadith',
            'botName': 'Maktaba-tul-Ahadith Bot',
            'botId': '996a9af6-42b3-4fcb-99a4-d2b3756bd8bd',
            'hostUrl': 'https://cdn.botpress.cloud/webchat/v1',
            'messagingUrl': 'https://messaging.botpress.cloud',
            'clientId': '996a9af6-42b3-4fcb-99a4-d2b3756bd8bd',
            'enableConversationDeletion': true,
            'className': 'webchatIframe',
            'containerWidth': '100%25',
            'layoutWidth': '100%25',
            'hideWidget': true,
            'showCloseButton': false,
            'disableAnimations': true,
            'closeOnEscape': false,
            'showConversationsButton': false,
            'enableTranscriptDownload': false,
            'avatarUrl': 'https://i.ibb.co/qW9cZfC/logo-icon.png',
            /* 'useSessionStorage': true, */
            'stylesheet': 'https://webchat-styler-css.botpress.app/prod/code/baeb8e61-ff07-48b1-b6bc-6aa058cb9b07/v31976/style.css'
        });
        window.botpressWebChat.onEvent(function () { window.botpressWebChat.sendEvent({ type: 'show' }) }, ['LIFECYCLE.LOADED']);
    </script>
</body>