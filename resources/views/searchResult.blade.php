@extends('layouts.default')

@section('content')
    <div class="flex flex-col md:flex-row">
        <div class="column w-full md:w-7/12 ml-auto">
            <h1 class="hidden">{{ trans('translations.search_page') }}</h1>
            <div class="search mb-8">
                <div class="search__input mb-8" role="search">
                    <form action="{{ route('search.index') }}" method="get" ref="searchForm" @submit.prevent="formSubmit">
                        <search-input 
                        :input-name="'q'"
                        :default-value="'{{ request('q') }}'" 
                        :handle-enter="handleEnter"
                        :handle-submit="handleSubmit" 
                        :placeholder="'{{ trans('translations.browse_websites') }}'"
                        :search="search" ></search-input>
                    </form>
                </div>
                
                <div class="search__result-count">
                    @if ($listings !== null)
                        @if ($listings->total() === 0)
                            <p class="text-sm"> {!! trans('translations.record_not_found',['search_term' => request('q') ]) !!}</p>
                            <p class="text-sm">{{ trans('translations.try_searching') }}</p>
                        @else
                            <p class="text-sm">{{ trans_choice('translations.record_found', $listings->total()) }}</p>
                        @endif
                    @else
                        <p class="text-sm"> {!! trans('translations.record_not_found',['search_term' => request('q') ]) !!}</p>
                        <p class="text-sm">{{ trans('translations.try_searching') }}</p>
                    @endif
                </div>
                
                @include('partials/ads/mobile',['image' => asset('images/ads/320x100.jpg')])
                <div class="search-results space-y-4">
                    <h2 class="hidden">{{ trans('translations.search_results') }}</h2>
                    @if ($listings !== null)
                        @foreach ($listings as $business)
                            <a class="search-result-link" href="{{ generate_url_string($business->website_url) }}">
                                <div class="search-result panel">
                                    <div class="search-result__header">
                                        <h3>{{ $business->business_name }}</h3>
                                        <span>{{ $business->website_url }}</span>
                                    </div>
                                    <div class="search-result__body">
                                        <p>{{ $business->products_services }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
                {{ $listings->withQueryString()->links() }}
            </div>
            <tag-list :tags="{{ json_encode($popular_tags) }}" :search-url="'{{ route('search.listing.tag') }}'"></tag-list>
        </div>
        <div class="column w-2/12 mr-auto hidden md:block">
            @include('partials/ads/desktopSide',['image' => asset('images/ads/160x600.jpg')])
        </div>
    </div>
@endsection