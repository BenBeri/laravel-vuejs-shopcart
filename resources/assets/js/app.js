
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('headernav', require('./components/headernav.vue'));
Vue.component('products', require('./components/products.vue'));


const app = new Vue({
    el: '#app',
    data () {
        return {
            cart: {
                products: [],
                count: 0
            }
        }
    },
    methods: {
        setCart: function(resData) {
            this.cart.products = resData.products;
            this.cart.count = resData.count;
        }
    },
    computed: {
        cartItems: function () {
            return this.cart.count + " Items"
        }
    },
    mounted() {
        axios.get("api/cart").then(response => (this.setCart(response.data)));
    }
});
