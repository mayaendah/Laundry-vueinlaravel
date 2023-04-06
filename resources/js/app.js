import './bootstrap';

import {createApp} from 'vue';

import App from '@/components/App.vue';
import router from '@/router';

axios.defaults.baseURL = 'http://localhost:8000/api/';
// axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
axios.defaults.headers.common['Accept'] = 'application/json';

createApp(App).use(router).mount('#app')
