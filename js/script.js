function slider() {
    const prev = document.querySelector('.main-slider-btn_prev');
    const next = document.querySelector('.main-slider-btn_next');
    const feed = document.querySelector('.main-slider-feed');
    let pos = 0;

    next.addEventListener('click', () => {
        if (pos > -800) {
            pos -= 400
            feed.style.left = pos + 'px'
        }
    })
    prev.addEventListener('click', () => {
        if (pos < 0) {
            pos += 400
            feed.style.left = pos + 'px'
        }
    })
}
function modalLog() {
    const modalBg = document.querySelector('.modal-bg');
    const formAuth = document.querySelector('#form-auth');
    const formReg = document.querySelector('#form-reg');

    const closeBtns = document.querySelectorAll('.form-log__btn_close');
    const navLinkAuth = document.querySelector('.nav__link_auth');
    const navLinkReg = document.querySelector('.nav__link_reg');

    navLinkAuth.addEventListener('click', () => {
        modalBg.classList.add('modal-bg_active');
        formAuth.classList.add('form-log_active');
    })
    navLinkReg.addEventListener('click', () => {
        modalBg.classList.add('modal-bg_active');
        formReg.classList.add('form-log_active');
    })
    closeBtns.forEach(closeBtn => {
        closeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            modalBg.classList.remove('modal-bg_active');
            formAuth.classList.remove('form-log_active');
            formReg.classList.remove('form-log_active');   
        })
    })
    
}
function viewProduct() {
    const catalogItems = document.querySelectorAll('.catalog-catalog__item');

    for (let i = 0; i < catalogItems.length; i++) {
        catalogItems[i].addEventListener('click', location.href('http://'))
    }
}