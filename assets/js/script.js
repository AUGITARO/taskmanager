'use strict';

const checkbox = document.querySelector('.checkbox-input');

if (checkbox) {
    checkbox.addEventListener('change', function (evt) {
        const is_checked = +evt.target.checked;

        const searchParams = new URLSearchParams(window.location.search);
        searchParams.set('show-completed', is_checked);

        window.location = '/index.php?' + searchParams.toString();
    });
}