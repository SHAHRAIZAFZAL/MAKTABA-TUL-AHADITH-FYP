document.addEventListener('DOMContentLoaded', () => {
    const messagesContainer = document.querySelector('.chatbot-container');
    const userInput = document.getElementById('chatbot-input');
    const submitButton = document.getElementById('chatbot-submit-btn');

    function addMessage(text, sender) {
        const messageElem = document.createElement('div');
        messageElem.classList.add(sender);
        messagesContainer.appendChild(messageElem);
        const pTag = document.createElement('p');
        if (sender == 'chatbot-container__user')
            pTag.textContent = 'You:';
        else if (sender == 'chatbot-container__ai')
            pTag.textContent = 'Chatbot:';
        const pText = document.createElement('p');
        pText.textContent = text;
        messageElem.appendChild(pTag);
        messageElem.appendChild(pText);
        /* window.scrollTo(0, document.body.scrollHeight - 600); */
    }

    function sendPythonData(inputData) {
        let xhr;
        if (xhr && xhr.readyState !== 4) {
            return;
        }
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                addMessage(xhr.responseText, 'chatbot-container__ai');
            }
            xhr.onerror = function () {
                addMessage('Sorry, something went wrong. Try again!', 'chatbot-container__ai');
            };
        };
        xhr.open("GET", "http://localhost:5000/printsome/?variable=" + encodeURIComponent(inputData), true);
        xhr.send();
    }

    submitButton.addEventListener('click', () => {
        const message = userInput.value.trim();
        if (message !== '') {
            addMessage(message, 'chatbot-container__user');
            userInput.value = '';
            sendPythonData(message);
        }
    });

    userInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            const message = userInput.value.trim();
            if (message !== '') {
                addMessage(message, 'chatbot-container__user');
                userInput.value = '';
                sendPythonData(message);
            }
        }
    });
});