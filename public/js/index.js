let isDown = false;
let startX;
let scrollLeft;

window.addEventListener('load', function() {
    const slider = document.querySelector('.slider');
    if (slider) {
        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();

            const x = e.pageX - slider.offsetLeft;
            const walk = x - startX;

            slider.scrollLeft = scrollLeft - walk;
        });

        slider.addEventListener('touchstart', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.touches[0].pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('touchend', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        slider.addEventListener('touchmove', (e) => {
            if (!isDown) return;

            const x = e.touches[0].pageX - slider.offsetLeft;
            const walk = x - startX;

            slider.scrollLeft = scrollLeft - walk;
        });
    }
    else {
        return 1;
    }
});

function toggleMenu() {
    const menu = document.querySelector('.nav__items');
    menu.classList.toggle('show');
}

// Modal window
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    const modalContent = modal.querySelector('.modal-content');

    modal.style.display = "flex";
    document.body.style.overflow = "hidden";
    modalContent.style.animation = 'none';
    modalContent.offsetHeight;
    modalContent.style.animation = 'slideUp 0.5s ease';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    const modalContent = modal.querySelector('.modal-content');

    modalContent.style.animation = 'slideOut 0.5s ease';

    setTimeout(() => {
        modal.style.display = "none";
        document.body.style.overflow = "";
    }, 230);
}

window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            closeModal(modal.id);
        }
    });
}

window.onkeydown = function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            closeModal(modal.id);
        });
    }
};
