import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import swal from 'sweetalert2';
window.Swal = swal;

createApp(App).use(router).mount('#app')
