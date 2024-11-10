document.addEventListener("DOMContentLoaded", function() {
    const leftArrow = document.querySelector('.left-arrow');
    const rightArrow = document.querySelector('.right-arrow');
    const timeline = document.querySelector('.container');

    if (leftArrow) {
        leftArrow.addEventListener('click', function(event) {
            event.preventDefault();
            timeline.classList.add('slide-right');
            setTimeout(() => {
                window.location.href = leftArrow.href;
            }, 500);
        });
    }

    if (rightArrow) {
        rightArrow.addEventListener('click', function(event) {
            event.preventDefault();
            timeline.classList.add('slide-left');
            setTimeout(() => {
                window.location.href = rightArrow.href;
            }, 500);
        });
    }
});