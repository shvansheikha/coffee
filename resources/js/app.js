import {createApp} from 'vue'
import axios from 'axios'
import router from './routes'
import App from './components/Pages/App.vue'

require('./bootstrap')


// const app = createApp({App})
// app.config.globalProperties.$axios = axios;
createApp(App)
    .use(router)
    .mount('#app')

