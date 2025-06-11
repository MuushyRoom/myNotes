let note_form = document.querySelector("#create-note-form");
let note_box = document.querySelector("#create-note-box");
let note_content = document.querySelector("#create-note-content");
let note_title = document.querySelector("#create-note-title");
let note_options = document.querySelector("#create-note-options");


note_form.addEventListener("click",() =>{

note_title.classList.remove('hide');
note_options.classList.remove('hide');
note_form.classList.remove('inactive-note-content');
note_form.classList.add('active-note-content');
});


document.addEventListener('click', e=>{

    /*IF A USER CLICKED OUTSIDE CREATE NOTE FORM */
    if(!note_box.contains(e.target)){
        
        if(note_content.value.length > 0 || note_title.value.length > 0){
            note_form.submit();
            
        }


        note_form.classList.add('inactive-note-content');
        note_form.classList.remove('active-note-content');
        note_title.classList.add('hide');
         note_options.classList.add('hide');
         note_title.value = '';
            note_content.value = '';    
    }

});
