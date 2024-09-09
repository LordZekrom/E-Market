document.addEventListener('DOMContentLoaded', () => {
    const blocks = document.querySelectorAll('.block');

    blocks.forEach(block => {
        block.addEventListener('click', () => {
            block.classList.toggle('expanded');
        });
    });
});
