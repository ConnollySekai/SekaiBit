<template>
    <div class="listing-registration">
        <div class="listing-registration__header" v-if="this.form.currentStep !== 3">
            <strong class="listing-registration__title">
                <slot></slot>
                {{ trans('translations.company_information') }}
            </strong>
            <div class="listing-registration__steps">
                {{ trans('translations.step') }} <span>{{ form.currentStep }}</span>/2
            </div>
        </div>
        <div class="listing-registration__body">
            <form @submit.prevent="validate()" novalidate>
                <transition name="fade" mode="out-in">
                    <div class="listing-registration__step" v-if="form.currentStep === 1" :key="1">
                        <div class="form-group mb-3">
                            <label for="businessName">{{ trans('translations.business_name') }}</label>
                            <input type="text" id="businessName" name="business_name" class="input" v-model="form.businessName" :class="form.errors.has('businessName') ? 'input--error':''">
                            <span class="error-message" v-if="form.errors.has('businessName')">{{ form.errors.first('businessName') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="websiteUrl">{{ trans('translations.website_url') }}</label>
                            <input type="text" id="websiteUrl" class="input" name="website_url" v-model="form.websiteUrl" :placeholder="trans('translations.website_url_placeholder')" :class="form.errors.has('websiteUrl') ? 'input--error':''">
                            <span class="error-message" v-if="form.errors.has('websiteUrl')">{{ form.errors.first('websiteUrl') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="contactEmail">{{ trans('translations.contact_email') }} <span class="hint">({{ trans('translations.optional') }})</span> </label>
                            <input type="email" id="contactEmail" class="input" name="contact_email" v-model="form.contactEmail" :class="form.errors.has('contactEmail') ? 'input--error':''">
                            <span class="error-message" v-if="form.errors.has('contactEmail')">{{ form.errors.first('contactEmail') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <div class="toggle" role="checkbox">
                                <label>
                                    <input type="checkbox" id="acceptsBitcoin" class="input" v-model="form.acceptsBitcoin">
                                    <span class="toggle__label">{{ trans('translations.this_business_accepts_bitcoin') }}</span>
                                    <span class="toggle__switch"></span>
                                </label>
                            </div>                                
                        </div>
                    </div>
                    <div class="listing-registration__step" v-if="form.currentStep === 2" :key="2">
                        <div class="form-group mb-3">
                            <div class="toggle" role="checkbox">
                                <label>
                                    <input type="checkbox" id="hasPhysicalStore" name="has_physical_store" v-model="form.hasPhysicalStore">
                                    <span class="toggle__label">{{ trans('translations.has_physical_store') }}</span>
                                    <span class="toggle__switch"></span>
                                </label>
                            </div>
                        </div>
                        <transition-group name="fade">
                            <div class="form-group mb-3" v-if="form.hasPhysicalStore" key="country">
                                <label for="country">{{ trans('translations.country') }}</label>
                                <select id="country" class="input" name="country" v-model="form.country" :class="form.errors.has('country') ? 'input--error':''">
                                    <option v-for="(country, index) in countries" :key="index">{{ country.country }}</option>
                                </select>
                                <span class="error-message" v-if="form.errors.has('country')">{{ form.errors.first('country') }}</span>
                            </div>
                            <div class="form-group mb-3" v-if="form.hasPhysicalStore" key="city">
                                <label for="city">{{ trans('translations.city') }}</label>
                                <input type="text" id="city" class="input" name="city" v-model="form.city" :class="form.errors.has('city') ? 'input--error':''">
                                <span class="error-message" v-if="form.errors.has('city')">{{ form.errors.first('city') }}</span>
                            </div>
                        </transition-group>
                        <div class="form-group mb-3">
                            <label for="productsServices">{{ trans('translations.products_services') }} <span class="hint">({{ trans('translations.product_description') }})</span></label>
                            <input type="text" id="productsServices" class="input" name="products_services" v-model="form.productsServices" :class="form.errors.has('productsServices') ? 'input--error':''">
                            <span class="error-message" v-if="form.errors.has('productsServices')">{{ form.errors.first('productsServices') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="searchTag">{{ trans('translations.search_tag') }} <span class="hint">({{ trans('translations.search_tag_description') }})</span></label>
                                <search-input
                                    ref="searchTagInput" 
                                    :base-class="'input-custom'"
                                    :search="search" 
                                    :handle-submit="handleSubmit" 
                                    :input-name="'q'" 
                                    :handle-enter="handleEnter"
                                    :default-value="form.searchTag"
                                    :placeholder="trans('translations.press_enter')"
                                    :clear-on-submit="true"></search-input>
                            <span class="error-message" v-if="form.errors.has('searchTags')">{{ form.errors.first('searchTags') }}</span>
                        </div>
                        <div class="tag-list w-full" v-if="form.searchTags.length">
                            <div class="tag" v-for="(searchTag,index) in form.searchTags" :key="index">
                                    <span class="mr-1">{{ searchTag.tagName}}</span>
                                    <span class="tag__close" @click="removeTag(searchTag)">x</span>
                            </div>
                        </div>
                    </div>
                    <div class="listing-registration__step text-center" v-if="form.currentStep === 3" :key="3">
                         <strong class="text-center text-2xl block my-4" v-if="this.form.currentStep === 3">
                            {{ trans('translations.registration_successful') }}
                        </strong>
                        <div class="success-checkmark">
                            <div class="check-icon">
                                <span class="icon-line line-tip"></span>
                                <span class="icon-line line-long"></span>
                                <div class="icon-circle"></div>
                                <div class="icon-fix"></div>
                            </div>
                        </div>
                        <p class="w-3/4 mx-auto" v-if="form.contactEmail !== ''">{{ trans('translations.registration_successful_message') }}</p>
                        <p class="w-3/4 mx-auto" v-else>{{ trans('translations.registration_successful_message_no_email') }}</p>
                    </div>
                </transition>
                <div class="listing-registration__actions">
                    <button type="button" class="btn mr-2" v-show="form.currentStep === 1" @click="$modal.hide('listing-registration-modal')">{{ trans('translations.cancel') }}</button>
                    <button type="submit" class="btn btn--primary" v-show="form.currentStep === 1">{{ trans('translations.next') }}</button>
                    <button type="button" class="btn mr-2" v-show="form.currentStep === 2" @click="form.currentStep = 1">{{ trans('translations.back') }}</button>
                    <button type="submit" class="btn btn--primary" v-show="form.currentStep === 2">{{ trans('translations.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import Form from 'form-backend-validation';

    import SearchInput from './SearchInput';

    export default {
        props: {
            countries: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                form: new Form({
                    businessName: '',
                    websiteUrl: '',
                    contactEmail: '',
                    acceptsBitcoin: false,
                    hasPhysicalStore: false,
                    city: '',
                    country: '',
                    productsServices: '',
                    searchTag: '',
                    searchTags: [],
                    currentStep: 1
                },{ resetOnSuccess: false })
            }
        },
        methods: {
            /* add search tag to array */
            addTag(tagName, tagId) {

                let searchTags = this.form.searchTags;

                if (searchTags.length < 5 && this.tagIsAdded(tagName)) {

                    this.form.searchTag = tagName;

                    searchTags.push({
                        id: tagId,
                        tagName: tagName
                    });

                    this.form.searchTag = '';

                    this.form.searchTags = searchTags;

                    this.form.errors.clear('searchTags');
                }
            },
            /* Add multiple tags */
            addTags(tagNames) {

                tagNames = tagNames.replace(/,+$/,'');
                //check if theres a comma
                if (tagNames.includes(',')) {
                    
                    let tagNamesArray = tagNames.split(',');

                    tagNamesArray.forEach(tagName => {
                        tagName = tagName.trim();

                        if (tagName.length > 0) {
                            this.addTag(tagName, null);
                        }
                    });
                    
                } else {
                    this.addTag(tagNames, null);
                }
            },
            /* Adds the tag if user did not click enter but submit the form */
            addTagOnSubmit() {
            
                const searchTagInput = this.$refs.searchTagInput;

                if (this.form.currentStep === 2) {

                    let tagName = searchTagInput.$data.currentValue;

                    if (tagName.trim().length > 0) {
                        this.addTags(tagName);
                        searchTagInput.clearInput();
                    }
                    
                }
            },
            /* handle autocomplete enter event */
            handleEnter(e) {

                let tagName = e.target.value.trim();

                if (typeof tagName !== 'undefined') {

                    this.addTags(tagName, null);
                }                
            },
            /* handle autocomplete submit(click & enter) event */
            handleSubmit(result) {

                if (typeof result !== 'undefined') {
                    this.addTag(result.tag_name, result.id);
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

                let results = response.data.result.map(result=> {
                    return result;
                });

                // check if tag is already
                if (this.form.searchTags.length > 0) {

                    results = results.filter(result => {

                        /* let added = this.form.searchTags.find(tag => {
                            return result.tag_name.toLowerCase() === tag.tagName.toLowerCase();
                        });

                        if (typeof added === 'undefined') {
                            return result;
                        } */

                        if (this.tagIsAdded(result.tag_name)) {
                            return result;
                        }

                    });
                }

                return results;
            },
            /* remove tag from list */
            removeTag(tag) {
                this.form.searchTags.splice(this.form.searchTags.indexOf(tag), 1);
            },
            /* Check if tag is already in the tag list */
            tagIsAdded(tagName) {
                let added = this.form.searchTags.find(tag => {
                    return tagName.toLowerCase() === tag.tagName.toLowerCase();
                });

                if (typeof added === 'undefined') {
                    return true;
                }

                return false;
            },
            /* validate input before saving */
            async validate() {

                this.addTagOnSubmit();

                try { 
                    const response = await this.form.post('/listing/store'); 

                    this.form.currentStep = response.step + 1;

                } catch(e) {}
            }
        }
    }
</script>