
<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>
    <div id="app" class="h-screen">
        <div class="container h-screen mx-auto">
            <header class="column site-header">
                <button class="btn btn--primary ml-auto" @click="$modal.show('listing-registration-modal')">{{ trans('translations.add_a_listing') }}</button>
            </header>
            <main>
                @yield('content')
            </main>
            <footer class="text-center mt-24 py-4">
                <a href="{{ route('advertise') }}" target="_blank" class="hover:text-primary">{{ trans('translations.advertise_with_us') }}</a>
            </footer>
        </div>
        @include('partials/modals/listingRegistration')
    </div>
    @include('partials.scripts')
</body>
</html>