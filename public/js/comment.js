console.log('JavaScript file loaded successfully!');
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
console.log('csrfToken is: ' + csrfToken);
let currentUrl = location.protocol + "//" + location.hostname + ":8000";
console.log(currentUrl);
$('#comment-send').on('click', function (e) {
    e.preventDefault();
    console.log('Onclick adding event successful!');

    $.ajax({
        url: '/api/comments/store',
        method: 'POST',
        cache: false,
        timeout: 10000,
        headers: {'X-CSRF-TOKEN': csrfToken},
        data: {
            username: $('input[name="username"]').val(),
            password: $('input[name="password"]').val(),
            email: $('input[name="email"]').val(),
            comment: $('textarea[name="comment"]').val(),
        },
        success: function(msg) {
            console.log('We got a successful response, everything allright! Look below to check the response:');
            console.log(msg);
            let responce = JSON.parse(msg);
            let message = '' +
                '<div class="chat-comment" id="comment-{{ $comment->id }}">' +
                    '<div>' +
                        '<span class="chat-name">- ' + responce['comment'] + '</span> <br>' +
                        '<span class="chat-email">- ' + responce['comment'] + '</span> <br>' +
                        '<span class="chat-message">' + responce['comment'] + '</span>' +
                    '<div>' +
                '</div>'
            $('#comment_field').prepend(message);

            document.querySelector('input[name="username"]').value = '';
            document.querySelector('input[name="password"]').value = '';
            document.querySelector('input[name="email"]').value = '';
            document.querySelector('textarea[name="comment"]').value = '';
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('We got an error. Look console');
        }
    });
});

$('.delete-comment').on('click', function (e) {
    e.preventDefault();
    console.log('Onclick deleting event successful!');

    let commentId = $(this).siblings('input[name="hiddenId"]').val();
    let deleteUrl = $(this).data('url');

    $.ajax({
        url: deleteUrl + '/' + commentId,
        method: 'DELETE',
        cache: false,
        timeout: 10000,
        headers: {'X-CSRF-TOKEN': csrfToken},
        data: {id: commentId},
        success: function(msg){
            console.log('We got a successful response, everything allright! Look below to check the response:');
            console.log(msg);

            $('#comments-' + commentId).remove();
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('We got an error. Look console');
        }
    });
});

$('.edit-comment').on('click', function (e) {
    e.preventDefault();
    console.log('Onclick editing event successful!');

    let commentId = $(this).siblings('input[name="hiddenId"]').val();
    let username = $(this).siblings('input[name="hiddenUsername"]').val();
    let email = $(this).siblings('input[name="hiddenEmail"]').val();
    let comment = $(this).siblings('input[name="hiddenComment"]').val();
    let editUrl = $(this).data('url');

    $.ajax({
        url: editUrl + '/' + commentId,
        method: 'POST',
        cache: false,
        timeout: 10000,
        headers: {'X-CSRF-TOKEN': csrfToken},
        data: {
            id: commentId,
            username: username,
            email: email,
            comment: comment,
        },
        success: function(msg) {
            console.log('We got a successful response, everything allright! Look below to check the response:');
            console.log(msg);

            let currentUsername = document.getElementById(username + '-' + commentId);
            let newUsername = document.createElement("input");
            newUsername.type = "text";
            newUsername.name = "username";
            newUsername.id = "username-" + commentId;
            newUsername.value = username;
            currentUsername.parentNode.replaceChild(newUsername, currentUsername);

            let currentEmail = document.getElementById(email + '-' + commentId);
            let newEmail = document.createElement("input");
            newEmail.type = "email";
            newEmail.name = "email";
            newEmail.id = "email-" + commentId;
            newEmail.value = email;
            currentEmail.parentNode.replaceChild(newEmail, currentEmail);

            let currentComment = document.getElementById(comment + '-' + commentId);
            let newComment = document.createElement("textarea");
            newComment.rows = 5;
            newComment.cols = 50;
            newComment.name = "comment";
            newComment.id = "comment-" + commentId;
            newComment.value = comment;
            currentComment.parentNode.replaceChild(newComment, currentComment);

            let editButton = document.getElementById("edit-" + commentId);
            let updateButton = document.createElement("button");
            updateButton.type = "button";
            updateButton.id = "update-" + commentId;
            updateButton.classList.add("btn");
            updateButton.classList.add("btn-primary");
            updateButton.classList.add("fw-bold");
            updateButton.classList.add("update-comment");
            updateButton.setAttribute("data-url", currentUrl + "/api/comments/update");
            updateButton.innerHTML = 'Сохранить';
            editButton.parentNode.replaceChild(updateButton, editButton);

            updateButton.addEventListener('click', function () {
                console.log('Onclick updating event successful!');

                let commentId = $(this).siblings('input[name="hiddenId"]').val();
                console.log(commentId);
                let username = document.getElementById("username-" + commentId);
                console.log(username.value);
                let email = document.getElementById("email-" + commentId);
                console.log(email.value);
                let comment = document.getElementById("comment-" + commentId);
                console.log(comment.value);
                let updateUrl = $(this).data('url');

                $.ajax({
                    url: updateUrl + '/' + commentId,
                    method: "POST",
                    cache: false,
                    timeout: 10000,
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    data: {
                        id: commentId,
                        username: username.value,
                        email: email.value,
                        comment: comment.value,
                    },
                    success: function(msg) {
                        console.log('We got a successful response, everything allright! Look below to check the response:');
                        console.log(msg);

                        let updatedUsername = document.createElement("span");
                        updatedUsername.classList.add("chat-name");
                        updatedUsername.id = username.value + '-' + commentId;
                        updatedUsername.innerHTML = username.value;
                        username.parentNode.replaceChild(updatedUsername, username);

                        let updatedEmail = document.createElement("span");
                        updatedEmail.classList.add("chat-email");
                        updatedEmail.id = email.value + '-' + commentId;
                        updatedEmail.innerHTML = email.value;
                        email.parentNode.replaceChild(updatedEmail, email);

                        let updatedComment = document.createElement("span");
                        updatedComment.classList.add("chat-message");
                        updatedComment.id = comment.value + '-' + commentId;
                        updatedComment.innerHTML = comment.value;
                        comment.parentNode.replaceChild(updatedComment, comment);

                        document.getElementById("update-" + commentId).remove();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('We got an error. Look console');
                    }
                });
            });
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('We got an error. Look console');
        }
    });
});
