function openNote(note_id) {
    const selected_note = document.querySelector('div[data-id="div' + note_id + '"]');
    const bg = document.querySelector('#capsule');

    // Get the title and content textareas
    const titleTextarea = document.querySelector('textarea[data-id="title' + note_id + '"]');
    const contentTextarea = document.querySelector('textarea[data-id="content' + note_id + '"]');

    selected_note.classList.add('open-selected-note');
    selected_note.classList.remove('display-created-note');
    bg.classList.remove('hide');

    // Store original heights
    let originalTitleHeight = titleTextarea ? titleTextarea.style.height : '';
    let originalContentHeight = contentTextarea ? contentTextarea.style.height : '';

    // Auto-resize function defined inside openNote
    function autoResizeTextarea(textarea) {
        function resize() {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
        textarea.addEventListener('input', resize);
        resize();
    }

    // Remove readonly when opening and auto-resize
    if (titleTextarea) {
        titleTextarea.removeAttribute('readonly');
        autoResizeTextarea(titleTextarea);
    }
    if (contentTextarea) {
        contentTextarea.removeAttribute('readonly');
        autoResizeTextarea(contentTextarea);
    }

    function handleClick(e) {
        if (!selected_note.contains(e.target)) {
            selected_note.classList.remove('open-selected-note');
            selected_note.classList.add('display-created-note');
            bg.classList.add('hide');
            // Restore readonly and original height when closing
            if (titleTextarea) {
                titleTextarea.setAttribute('readonly', true);
                titleTextarea.style.height = originalTitleHeight;
            }
            if (contentTextarea) {
                contentTextarea.setAttribute('readonly', true);
                contentTextarea.style.height = originalContentHeight;
            }
            document.removeEventListener('click', handleClick);
        }
    }

    document.addEventListener('click', handleClick);
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-note-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.stopPropagation();
            // The link will still work, but the parent openNote won't trigger
        });
    });
});