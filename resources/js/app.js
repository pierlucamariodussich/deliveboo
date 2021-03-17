/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');




window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('footercomponent', require('./components/FooterComponent.vue').default);


//HOMEPAGE
Vue.component('resturantsectionhome', require('./components/homepage/ResturantSectionHome.vue').default);
Vue.component('partnersectionhome', require('./components/homepage/PartnerSectionHome.vue').default);
Vue.component('infosectionhome', require('./components/homepage/InfosectionHome.vue').default);
Vue.component('joincomponent', require('./components/homepage/JoinComponent.vue').default);
Vue.component('buttonscomponent', require('./components/homepage/ButtonsComponent.vue').default);
Vue.component('resturantcomponent', require('./components/homepage/ResturantComponent.vue').default);


//SUCCESS PAGE
Vue.component('successpage', require('./components/success/SuccessPage.vue').default);


//RESTOURANT MENU
Vue.component('inforestaurant', require('./components/RestaurantMenu/InfoRestaurant.vue').default);
Vue.component('typemenu', require('./components/RestaurantMenu/TypeMenu.vue').default);
Vue.component('prefooter', require('./components/RestaurantMenu/PreFooter.vue').default);
Vue.component('menugenre', require('./components/RestaurantMenu/MenuGenre.vue').default);


//CHECKOUT
Vue.component('cart', require('./components/checkout/Cart.vue').default);

//DASHBOARD
Vue.component('dashboardcomponent', require('./components/dashboard/DashboardComponent.vue').default);

//ORDERS
Vue.component('orderscomponent', require('./components/orders/OrdersComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",

});
