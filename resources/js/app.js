import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//フラッシュメッセージの自動消去
window.setTimeout(() => {
    $('#flash-message').slideUp()
}, 5000);
