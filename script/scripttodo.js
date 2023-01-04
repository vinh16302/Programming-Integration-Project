document.addEventListener("DOMContentLoaded", function () {
    var todo;
    var date;
    for (let i = 1; i <= localStorage.length; i++)
    {
        todo = JSON.parse(localStorage.getItem(i));
        date = new Date(todo[1]);
        $('#listed').append('<div id="note' + i + '" style="background-color: ' + todo[3] + '"><div class="list-title">' + todo[0] + '</div> <div class="list-text">' + "Due at: " + date.toLocaleString("en-US") + '</div> </div>');
    };
});

$(document).ready(function () {

    var noteCount = 0;
    var activeNote = null;

    $('.color-box').click(function () {
        var color = $(this).css('background-color');
        $('notepad').css('background-color', color);
        $('#title-field').css('background-color', color);
        $('#body-field').css('background-color', color);
    })

    $('#btn-save').click(function () {
        var title = $('#title-field').val();
        var due = $('#body-field').val();
        var body = new Date(due);
        if (title == '') {
            alert('Please add a title for your task');
            return;
        }
        var color = $('notepad').css('background-color');
        var id = noteCount + 1;
        $('#listed').append('<div id="note' + id + '" style="background-color: ' + color + '"><div class="list-title">' + title + '</div> <div class="list-text">' + "Due at: " + body.toLocaleString("en-US") + '</div> </div>');
        noteCount++;
        var checked = 0;
        var todo = [title, body, checked, color];
        localStorage.setItem(id, JSON.stringify(todo));
        $('#title-field').val('');
        $('#body-field').val('');
    });

    $('#btn-delete').click(function () {
        if (activeNote) {
            $('#' + activeNote)[0].remove();
            activeNote = null;
            $('#edit-mode').removeClass('display').addClass('no-display');
        }
        $('#title-field').val('');
        $('#body-field').val('');
        $('notepad').css('background-color', 'white');
        $('#title-field').css('background-color', 'white');
        $('#body-field').css('background-color', 'white');
    });

    $('#listed').click(function (e) {
        if (e.target.parentElement.style.textDecoration != "line-through")
            e.target.parentElement.style.textDecoration = "line-through";
        else
            e.target.parentElement.style.textDecoration = "none";
    })

})
