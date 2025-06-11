
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