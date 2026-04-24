document.addEventListener('DOMContentLoaded', function () {
    var toggleButton = document.querySelector('.menu-toggle');
    var navContainer = document.querySelector('.site-header');

    if (!toggleButton) {
        return;
    }

    toggleButton.addEventListener('click', function (e) {
        e.preventDefault();
        navContainer.classList.toggle('site-navigation-toggled');
        var expanded = toggleButton.getAttribute('aria-expanded') === 'true' || false;
        toggleButton.setAttribute('aria-expanded', !expanded);
    });
});
