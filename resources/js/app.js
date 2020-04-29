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

Vue.component('vue-categories', require('./components/Categories.vue').default);
Vue.component('vue-tags', require('./components/Tags.vue').default);
Vue.component('vue-services', require('./components/Services.vue').default);
Vue.component('vue-links', require('./components/Links.vue').default);
Vue.component('vue-types', require('./components/Types.vue').default);
Vue.component('vue-industry', require('./components/Industry.vue').default);
Vue.component('name-edit', require('./components/edit_client/NameComponent.vue').default);
Vue.component('company-edit', require('./components/edit_client/CompanyComponent.vue').default);
Vue.component('email-edit', require('./components/edit_client/EmailComponent.vue').default);
Vue.component('industry-edit', require('./components/edit_client/IndustryComponent.vue').default);
Vue.component('services-edit', require('./components/edit_client/ServicesComponent.vue').default);
Vue.component('links-edit', require('./components/edit_client/LinksComponent.vue').default);
Vue.component('budget-edit', require('./components/edit_client/BudgetComponent.vue').default);
Vue.component('time-edit', require('./components/edit_client/TimeComponent.vue').default);
Vue.component('credentials-edit', require('./components/edit_client/CredentialsComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
