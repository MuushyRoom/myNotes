
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('textarea[data-autogrow]').forEach(function(textarea) {
        // Function to auto-resize
        function autoResize() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        }
        // Initial resize
        autoResize.call(textarea);
        // Resize on input
        textarea.addEventListener('input', autoResize);
    });
});


document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('textarea[data-autogrower]').forEach(function(textarea) {
        // Function to auto-resize
        function autoResize() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        }
        // Initial resize
        autoResize.call(textarea);
        // Resize on input
        textarea.addEventListener('input', autoResize);
    });
});



//UNPIN FUNCTION
function unpin(note_id){


       // Submit the form when the pin checkbox is clicked
    const checkbox = document.querySelector('input[type="checkbox"][data-id="' + note_id + '"]');
  
 checkbox.checked = false;
 
            const form = document.querySelector('form[data-id="form' + note_id + '"]');
            console.log("🚀 ~ checkbox.addEventListener ~ form:", form)
            if (form) {
                form.submit();
            }
      
  
    // Prevent openNote when clicking delete link
    document.querySelectorAll('.delete-note-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
    

}



//PIN FUNCTION
function pin(note_id){


       // Submit the form when the pin checkbox is clicked
    const checkbox = document.querySelector('input[type="checkbox"][data-id="' + note_id + '"]');
  
 checkbox.checked = true;
 
            const form = document.querySelector('form[data-id="form' + note_id + '"]');
            console.log("🚀 ~ checkbox.addEventListener ~ form:", form)
            if (form) {
                form.submit();
            }
      
  
    // Prevent openNote when clicking delete link
    document.querySelectorAll('.delete-note-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
    

}


function togglePin(){
 const checkbox = document.getElementById('pinned-checkbox');
 const pinned_icon = document.getElementById('create-pinned-icon');
  const unpinned_icon = document.getElementById('create-unpinned-icon');
 if(checkbox.checked == false){
pinned_icon.classList.add('hide');
unpinned_icon.classList.remove('hide');
 }else{
pinned_icon.classList.remove('hide');
unpinned_icon.classList.add('hide');
 }

}
