
function openNote(note_id) {
    const selected_note = document.querySelector('div[data-id="div' + note_id + '"]');
    const form = document.querySelector('form[data-id="form' + note_id + '"]');
    const bg = document.querySelector('#capsule');


    selected_note.classList.add('open-selected-note');
    selected_note.classList.remove('display-created-note');
    bg.classList.remove('hide');


    function handleClick(e) {
        if (!selected_note.contains(e.target)) {
            // Submit the form before closing
           

            selected_note.classList.remove('open-selected-note');
            selected_note.classList.add('display-created-note');
            bg.classList.add('hide');
            document.removeEventListener('click', handleClick);
        }
    }

    document.addEventListener('click', handleClick);
}

//FUNCTION FOR EVENT PROPAGATION FOR DELETE
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-note-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.stopPropagation();
            // The link will still work, but the parent openNote won't trigger
        });
    });
});



