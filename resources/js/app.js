/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VModal from 'vue-js-modal';

import Autocomplete from '@trevoreyre/autocomplete-vue';

Vue.use(VModal);

Vue.use(Autocomplete);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('listing-registration',  require('./components/ListingRegistration.vue').default);

Vue.component('tag-list',  require('./components/TagList.vue').default);

Vue.component('search-input',  require('./components/SearchInput.vue').default);

Vue.prototype.trans = (string, args) => {
    
    let value = _.get(window.i18n, string);

    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal);
    });
    return value;
};
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        searchTerm: '',
        results: []
    },
    methods: {
        /* handle autocomplete enter event */
        handleEnter(e) {
            if (e.target.value.trim().length !== 0) {
                this.$refs.searchForm.submit();
            }
        },
        /* handle autocomplete submit(click & enter) event */
        handleSubmit(result) {
            if (typeof result !== 'undefined') {
                window.location.href = '/search/listing/tag?q='+result.tag_name;
            }
        },
         /* Returns search result based on query string */
        async search(input) {
            if (input.length < 1) { return [] }

            const response = await axios.get('search/tag',{
                params: {
                    q: input
                }
            });

            const results = response.data.result.map((result)=> {
                return result;
            });

            return results;
        }
    }
});
