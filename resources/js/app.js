import {createApp} from 'vue'
import axios from 'axios'
import router from './routes'

require('./bootstrap')


const app = createApp({})
app.config.globalProperties.$axios = axios;
app.use(router)
app.mount('#app')

