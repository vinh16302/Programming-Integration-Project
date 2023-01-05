function deleteTodo(e)
{
    document.getElementById(e.id).style.display = "none";
    localStorage.removeItem(e.id[4]);
}


document.addEventListener("DOMContentLoaded", function () {
    var todo;
    var date;
    for (let l = 0; l < localStorage.length; l++)
    {
        var i = localStorage.key(l);
        if (localStorage.getItem(i) == null)
            continue;
        todo = JSON.parse(localStorage.getItem(i));
        if (todo[1] != null) {
            date = new Date(todo[1]);
            $('#listed').append('<div id="note' + i + '" style="background-color: ' + todo[3] + '"><div class="list-title">' + todo[0] + '<button class="trash-button" onclick="deleteTodo(this.parentElement.parentElement)"><i class="fa-solid fa-trash"></i></button>' + '</div> <div class="list-text">' + "Due at: " + date.toLocaleString("en-US") + '</div> </div>');
        }
        else
        {
            $('#listed').append('<div id="note' + i + '" style="background-color: ' + todo[3] + '"><div class="list-title">' + todo[0] + '<button class="trash-button" onclick="deleteTodo(this.parentElement.parentElement)"><i class="fa-solid fa-trash"></i></button>' + '</div> <div class="list-text">' + "No due date" + '</div> </div>');   
        }
        if (todo[2])
            document.getElementById("note" + i).style.textDecoration = "line-through";
    };
});


$(document).ready(function () {

    var noteCount = localStorage.length;

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
        var id = 1;
        for (let i = 0; i < localStorage.length; i++)
        {
            if (localStorage.key(i) >= id)
                id = JSON.parse(localStorage.key(i)) + 1;
        };
        if (!isNaN(body))
            $('#listed').append('<div id="note' + id + '" style="background-color: ' + color + '"><div class="list-title">' + title + '<button class="trash-button" onclick="deleteTodo(this.parentElement.parentElement)"><i class="fa-solid fa-trash"></i></button>' + '</div> <div class="list-text">' + "Due at: " + body.toLocaleString("en-US") + '</div> </div>');
        else
            $('#listed').append('<div id="note' + id + '" style="background-color: ' + color + '"><div class="list-title">' + title + '<button class="trash-button" onclick="deleteTodo(this.parentElement.parentElement)"><i class="fa-solid fa-trash"></i></button>' + '</div> <div class="list-text">' + "No due date" + '</div> </div>');
        noteCount++;
        var checked = 0;
        var todo = [title, body, checked, color];
        localStorage.setItem(id, JSON.stringify(todo));
        $('#title-field').val('');
        $('#body-field').val('');
    });

    $('#btn-delete').click(function () {
        $('#title-field').val('');
        $('#body-field').val('');
    });

    $('#listed').click(function (e) {
        if (e.target.parentElement.style.textDecoration != "line-through") {
            e.target.parentElement.style.textDecoration = "line-through";
            var temp = JSON.parse(localStorage.getItem(e.target.parentElement.id[4]));
            temp[2] = 1;
            localStorage.setItem(e.target.parentElement.id[4], JSON.stringify(temp));
        }
        else {
            e.target.parentElement.style.textDecoration = "none";
            var temp = JSON.parse(localStorage.getItem(e.target.parentElement.id[4]));
            temp[2] = 0;
            localStorage.setItem(e.target.parentElement.id[4], JSON.stringify(temp));
        }
    })

})
