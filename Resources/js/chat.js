function updateChat() {
    $.ajax({
        url: 'app.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var textArea = document.getElementById('chat');
            textArea.value = '';
            for (var i = 0; i < data.length; i++) {
                textArea.value += new Date(data[i].time*1000).toLocaleString() + ' ' + data[i].name + '> ' + data[i].text + '\n';
                textArea.scrollTop = textArea.scrollHeight;
            }
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}

function sendForm(event) {
    event.preventDefault();
    $.ajax({
        url: 'app.php',
        type: 'POST',
        data: $(event.target).serialize(),
        success: function() {
            updateChat();
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}

updateChat();