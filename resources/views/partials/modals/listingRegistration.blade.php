<modal name="listing-registration-modal" :adaptive="true" :width="'90%'" :max-width="570" :height="'auto'">
    <listing-registration :countries="{{ json_encode(config('dropdown.countries')) }}">
        @svg('public/images/building-alt', 'fill-primary hidden md:block w-8 h-8 mr-2')
    </listing-registration>
</modal>