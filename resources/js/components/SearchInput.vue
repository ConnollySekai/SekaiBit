<template>
    <div>
        <autocomplete 
            aria-label="Search Input"
            :base-class="baseClass"
            :debounce-time="200" 
            :placeholder="placeholder"
            :search="search"
            @submit="submitHandler">
            <template
                #default="{
                    rootProps,
                    inputProps,
                    inputListeners,
                    resultListProps,
                    resultListListeners,
                    results,
                    resultProps
                }">
                <div v-bind="rootProps">
                    <input type="text" v-bind="inputProps" v-on="inputListeners" :name="inputName" @keydown.enter.prevent="handleEnter($event)" v-model="currentValue">
                    <ul v-bind="resultListProps" v-on="resultListListeners">
                        <li v-for="(result, index) in results" :key="resultProps[index].id" v-bind="resultProps[index]">
                            <span v-html="highlightResult(result,inputProps.value)"></span>
                        </li>
                    </ul>
                </div>
            </template>
        </autocomplete>
    </div>
</template>
<script>
    import Autocomplete from '@trevoreyre/autocomplete-vue';

    export default {
        components: { Autocomplete },
        props: {
            baseClass: {
                type: String,
                default: 'autocomplete'
            },
            clearOnSubmit: {
                type: Boolean,
                default: false,
            },
            defaultValue: {
                type: String,
                default: ''
            },
            handleEnter: {
                required: true
            },
            handleSubmit: {
                required: true
            },
            inputName: {
                type: String,
                required: true
            },
            placeholder: {
                type: String,
                default: ''
            },
            search: {
               required: true
            }
        },
        data() {
            return {
                currentValue: ''
            }
        },
        methods: {
            /* Clears input text */
            clearInput() {
                this.currentValue = '';
            },
            /* Wraps the result with a strong tag that matches the user input */
            highlightResult(result, input) {
                return result.tag_name.toLowerCase().replace(input.toLowerCase(),`<strong>${input.toLowerCase()}</strong>`);
            },
            /* On submit handler function */
            submitHandler(result)  {
                this.handleSubmit(result);

                if (this.clearOnSubmit) {
                    this.clearInput();
                }
            }
        },
        mounted() {
            this.currentValue = this.defaultValue;
        }
    }
</script>