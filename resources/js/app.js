require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('productos', require('./components/ProductoComponent.vue').default);
Vue.component('vehiculos', require('./components/VehiculoComponent.vue').default);


const app = new Vue({
    el: '#app',
});
