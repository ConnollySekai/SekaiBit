@extends('layouts.default')

@section('content')
    <div class="column w-full md:w-8/12 mx-auto">
        <div class="logo">
            @svg('public/images/bitcoin','mx-auto')
        </div>
        <div class="search mb-8">
            <form action="{{ route('search.index') }}" method="get" ref="searchForm" @submit.prevent="formSubmit">
                <search-input 
                    :input-name="'q'" 
                    :handle-enter="handleEnter"
                    :handle-submit="handleSubmit" 
                    :placeholder="'{{ trans('translations.browse_websites') }}'"
                    :search="search" ></search-input>
            </form>
        </div>
        
        <tag-list 
            :search-url="'{{ route('search.listing.tag') }}'"
            :tags="{{ json_encode($popular_tags) }}"></tag-list>
    </div>
@endsection