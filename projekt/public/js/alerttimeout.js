document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        document.querySelectorAll('.alert-overlay').forEach(el => {
            el.remove();
        });
    }, 3000);
});