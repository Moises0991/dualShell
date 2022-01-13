import Vue from 'vue'
import App from './App.vue'
import router from './router'

new Vue({
    router,
    render: h => h(App)
}).$mount('#app')

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);