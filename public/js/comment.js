let loadedFile = 'JavaScript file loaded successfully!';
let successfulEvent = 'event successfull!';
let successfulResponse = 'Successful response!';
let error = 'We got an error. Look console';

console.log(loadedFile);

let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let uri = '/api/v1/comments/';

console.log('csrfToken is: ' + csrfToken);

window.onload = function () {
    console.log('Onload: ' + successfulEvent);

    $.ajax({
        url: uri,
        method: 'GET',
        cache: false,
        timeout: 10000,
        headers: {'X-CSRF-TOKEN': csrfToken},
        success: function(data) {
            console.log(successfulResponse);
            console.log(data);

            data['data'].forEach( function (el) {
                let date = el['created_at'];
                let formattedDate = new Date(date).toLocaleDateString('en-US', {
                    year: 'numeric', month: '2-digit', day: '2-digit',
                    hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true});
                let comment =
                    '<div class="chat-comment" id="comments-' + el['id'] + '">' +
                        '<span class="chat-name" id="' + el['username'] + '-' + el['id'] + '">' +
                            '-' + el['username'] +
                        '</span>' +
                        '<span class="chat-time">' +
                            ' в ' + formattedDate +
                        '</span>' +
                        '<br>' +
                        '<span class="chat-email" id="' + el['email'] + '-' + el['id'] + '">' +
                            '-' + el['email'] +
                        '</span>' +
                        '<br>' +
                        '<span class="chat-message" id="' + el['comment'] + '-' + el['id'] + '">' +
                            el['comment'] +
                        '</span>' +
                        '<form class="comment-buttons">' +
                            '<input type="hidden" name="hiddenId" value="' + el['id'] + '">' +
                            '<input type="hidden" name="hiddenUsername" value="' + el['username'] + '">' +
                            '<input type="hidden" name="hiddenEmail" value="' + el['email'] + '">' +
                            '<input type="hidden" name="hiddenComment" value="' + el['comment'] + '">' +
                            '<button type="button" id="edit-' + el['id'] + '" class="btn btn-primary fw-bold edit-comment">' +
                                'Ред-ть' +
                            '</button>' +
                            '<button type="button" class="btn btn-primary fw-bold delete-comment">' +
                                'Удалить' +
                            '</button>' +
                        '</form>' +
                    '</div>'

                $('#comment_field').prepend(comment);
            })
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert(error);
        }
    });
};

$('#comment-send').on('click', function (e) {
    e.preventDefault();
    console.log('Adding: ' + successfulEvent);

    $.ajax({
        url: uri,
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
        success: function(id) {
            console.log(successfulResponse);
            console.log(id['commentId'])

            let username = document.getElementById('username').value;
            let email = document.getElementById('email').value;
            let comment = document.getElementById('comment').value;

            let message = '' +
                '<div class="chat-comment" id="comment-' + id['commentId'] + '">' +
                    '<span class="chat-name" id="' + username + '-' + id['commentId'] +'">- ' +
                        username +
                    '</span> <br>' +
                    '<span class="chat-email" id="' + email + '-' + id['commentId'] +'">- ' +
                        email +
                    '</span> <br>' +
                    '<span class="chat-message" id="' + comment + '-' + id['commentId'] +'">' +
                        comment +
                    '</span>' +
                    '<form class="comment-buttons">' +
                        '<input type="hidden" name="hiddenId" value="' + id['commentId'] + '">' +
                        '<input type="hidden" name="hiddenUsername" value="' + username + '">' +
                        '<input type="hidden" name="hiddenEmail" value="' + email + '">' +
                        '<input type="hidden" name="hiddenComment" value="' + comment + '">' +
                        '<button type="button" id="edit-' + id['commentId'] + '" class="btn btn-primary fw-bold edit-comment">' +
                            'Ред-ть' +
                        '</button>' +
                        '<button type="button" class="btn btn-primary fw-bold delete-comment">' +
                            'Удалить' +
                        '</button>' +
                    '</form>' +
                '</div>'
            $('#comment_field').prepend(message);

            document.querySelector('input[name="username"]').value = '';
            document.querySelector('input[name="password"]').value = '';
            document.querySelector('input[name="email"]').value = '';
            document.querySelector('textarea[name="comment"]').value = '';
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert(error);
        }
    });
});

$(document).on('click','.edit-comment', function (e) {
    e.preventDefault();
    console.log('Editing: ' + successfulEvent);

    let commentId = $(this).siblings('input[name="hiddenId"]').val();
    let username = $(this).siblings('input[name="hiddenUsername"]').val();
    let email = $(this).siblings('input[name="hiddenEmail"]').val();
    let comment = $(this).siblings('input[name="hiddenComment"]').val();

    $.ajax({
        method: 'GET',
        cache: false,
        timeout: 10000,
        headers: {'X-CSRF-TOKEN': csrfToken},
        data: {
            id: commentId,
            username: username,
            email: email,
            comment: comment,
        },
        success: function() {
            console.log(successfulResponse);

            let currentUsername = document.getElementById(username + '-' + commentId);
            let newUsername = document.createElement("input");
            let attributesUsername = {
                type: "text",
                name: "username",
                id: "username-" + commentId,
                value: username
            };
            for (let key in attributesUsername) {
                newUsername.setAttribute(key, attributesUsername[key])
            }
            currentUsername.parentNode.replaceChild(newUsername, currentUsername);

            let currentEmail = document.getElementById(email + '-' + commentId);
            let newEmail = document.createElement("input");
            let attributesEmail = {
                type: "email",
                name: "email",
                id: "email-" + commentId,
                value: email
            };
            for (let key in attributesEmail) {
                newEmail.setAttribute(key, attributesEmail[key])
            }
            currentEmail.parentNode.replaceChild(newEmail, currentEmail);

            let currentComment = document.getElementById(comment + '-' + commentId);
            let newComment = document.createElement("textarea");
            let attributesComment = {
                rows: 5,
                cols: 50,
                name: "comment",
                id: "comment-" + commentId
            };
            for (let key in attributesComment) {
                newComment.setAttribute(key, attributesComment[key])
            }
            newComment.value = comment;
            currentComment.parentNode.replaceChild(newComment, currentComment);

            let editButton = document.getElementById("edit-" + commentId);
            let updateButton = document.createElement("button");
            let attributesButton = {
                type: "button",
                id: "update-" + commentId,
            };
            for (let key in attributesButton) {
                updateButton.setAttribute(key, attributesButton[key])
            }
            updateButton.classList.add("btn", "btn-primary", "fw-bold", "update-comment");
            updateButton.innerHTML = 'Сохранить';
            editButton.parentNode.replaceChild(updateButton, editButton);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert(error);
        }
    });
});

$(document).on('click','.update-comment', function (e){
    e.preventDefault();
    console.log('Updating: ' + successfulEvent)

    let commentId = $(this).siblings('input[name="hiddenId"]').val();
    let username = document.getElementById("username-" + commentId);
    let email = document.getElementById("email-" + commentId);
    let comment = document.getElementById("comment-" + commentId);

    $.ajax({
        url: uri + commentId,
        method: "PUT",
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
            console.log(successfulResponse);
            console.log(msg);

            let updatedUsername = document.createElement("span");
            updatedUsername.classList.add("chat-name");
            updatedUsername.id = username.value + '-' + commentId;
            updatedUsername.innerHTML = '- ' + username.value;
            username.parentNode.replaceChild(updatedUsername, username);

            let updatedEmail = document.createElement("span");
            updatedEmail.classList.add("chat-email");
            updatedEmail.id = email.value + '-' + commentId;
            updatedEmail.innerHTML = '- ' + email.value;
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
            alert(error);
        }
    });
});

$(document).on('click','.delete-comment', function (e) {
    e.preventDefault();
    console.log('Deleting: ' + successfulEvent);

    let commentId = $(this).siblings('input[name="hiddenId"]');
    console.log(commentId.val());
    let grandparent = commentId.parent().parent();

    $.ajax({
        url: uri + commentId.val(),
        method: 'DELETE',
        cache: false,
        timeout: 10000,
        headers: {'X-CSRF-TOKEN': csrfToken},
        data: {id: commentId.val()},
        success: function(msg){
            console.log(successfulResponse);
            console.log(msg);

            grandparent.remove();
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert(error);
        }
    });
});
