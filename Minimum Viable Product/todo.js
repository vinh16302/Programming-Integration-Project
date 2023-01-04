$(document).ready(function(){

    var noteCount = 0;
    var activeNote = null;
  
    $('.color-box').click(function(){
      var color = $(this).css('background-color');
      $('notepad').css('background-color', color);
      $('#title-field').css('background-color', color);
      $('#body-field').css('background-color', color);
    })
  
    $('#btn-save').click(function(){
      var title = $('#title-field').val();
      var body = $('#body-field').val();
      if (title === '' && body === '') {
        alert ('Please add a title or body to your note.');
        return;
      }
      var created = new Date();
      var color = $('notepad').css('background-color');
      var id = noteCount + 1;
      if (activeNote) {
        $('#' + activeNote)[0].children[0].innerHTML = title;
        $('#' + activeNote)[0].children[1].innerHTML = created.toLocaleString("en-US");
        $('#' + activeNote)[0].children[2].innerHTML = body;
        $('#' + activeNote)[0].style.backgroundColor = color;
        activeNote = null;
        $('#edit-mode').removeClass('display').addClass('no-display');
      } else {
        var created = new Date();
        $('#listed').append('<div id="note' + id + '" style="background-color: ' + color + '"><div class="list-title">' + title + '</div> <div class="list-date">' + created.toLocaleString("en-US") + '</div> <div class="list-text">' + body + '</div> </div>');
        noteCount++;
      };
      $('#title-field').val('');
      $('#body-field').val('');
      $('notepad').css('background-color', 'white');
      $('#title-field').css('background-color', 'white');
      $('#body-field').css('background-color', 'white');
    });
  
    $('#btn-delete').click(function(){
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
  
    $('#listed').click(function(e){
      var id = e.target.parentElement.id;
      var color = e.target.parentElement.style.backgroundColor;
      activeNote = id;
      $('#edit-mode').removeClass('no-display').addClass('display');
      var titleSel = $('#' + id)[0].children[0].innerHTML;
      var bodySel = $('#' + id)[0].children[2].innerHTML;
      $('#title-field').val(titleSel);
      $('#body-field').val(bodySel);
      $('notepad').css('background-color', color);
      $('#title-field').css('background-color', color);
      $('#body-field').css('background-color', color);
    })
  })
  
  // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}