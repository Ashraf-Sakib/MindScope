import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';
import Relief from './components/relief.vue';

createApp(Relief).mount('#app');


window.Alpine = Alpine;

Alpine.start();
