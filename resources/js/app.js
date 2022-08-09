import {createApp} from 'vue'
import axios from 'axios'
import router from './routes'
import moment from 'moment-jalaali'
import App from './components/Pages/App.vue'

require('./bootstrap')


// const app = createApp({App})
// app.config.globalProperties.$axios = axios;
createApp(App)
    .use(router)
    .use(moment)
    .mount('#app')

