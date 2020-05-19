<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>
    <div id="app" class="h-screen">
        <div class="container h-screen mx-auto">
            <main class="py-20">
                <div class="column w-full md:w-8/12 text-center mx-auto">
                    <h1>{{ trans('translations.advertise_with_us') }}</h1>
                    <p class="text-2xl">{{ trans('translations.ad_layout') }}</p>
                    <img src="{{ asset('images/ad_image.jpg') }}" alt="Ad layout image">
                    <div class="panel p-8 w-10/12 sm:w-8/12 md:w-6/12 mx-auto">
                        <strong><span class="text-primary text-5xl">$100</span>/{{ trans('translations.month') }}</strong>
                        <p>{{ trans('translations.ad_space') }}</p>
                        <p  class="mb-0">{{ trans('translations.contact_us') }}</p>
                        <strong>{{ env('MAIL_SUPPORT_ADDRESS') }}</strong>
                    </div>
                </div>
            </main>
            <footer class="hover:text-primary text-center py-4">
                <a href="{{ Url::to('/') }}">{{ trans('translations.back_to_search') }}</a>
            </footer>
        </div>
    </div>
</body>
</html>