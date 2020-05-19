@extends('layouts.admin')

@section('content')
    <div class="panel shadow-normal p-6">
        <header class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-2xl mb-0">{{ trans('translations.business_listing') }}</h1>
            <nav class="filter mt-2 md:mt-0">
                <a href="{{ route('listing.index') }}?status=new" class="{{ (request('status') === null || request('status') === 'new') ? 'active': '' }}">{{ trans('translations.new') }}</a> | 
                <a href="{{ route('listing.index') }}?status=approved" class="{{ request('status') === 'approved' ? 'active': '' }}">{{ trans('translations.approved') }}</a> |
                <a href="{{ route('listing.index') }}?status=rejected" class="{{ request('status') === 'rejected' ? 'active': '' }}">{{ trans('translations.rejected') }}</a>
            </nav>
        </header>
        <div class="table-wrap-overflow">
            <table class="table table--bordered table--stackable rounded-md">
                <thead>
                    <tr>
                        <th>{{ trans('translations.business_name') }}</th>
                        <th>{{ trans('translations.website_url') }}</th>
                        <th>{{ trans('translations.products_services') }}</th>
                        <th>{{ trans('translations.contact_email') }}</th>
                        <th>{{ trans('translations.accepts_bitcoin') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($listing->count())
                        @foreach($listing as $business)
                        <tr>
                            <td data-label="{{ trans('translations.business_name') }}">{{ $business->business_name }}</td>
                            <td data-label="{{ trans('translations.website_url') }}"><a href="{{ generate_url_string($business->website_url) }}" target="_blank" class="text-primary hover:text-primary-dark">{{ $business->website_url }}</a></td>
                            <td data-label="{{ trans('translations.products_services') }}">{{ $business->products_services }}</td>
                            <td data-label="{{ trans('translations.contact_email') }}">{{ $business->contact_email }}</td>
                            <td data-label="{{ trans('translations.accepts_bitcoin') }}">
                                @if ($business->accepts_bitcoin)
                                    @svg('public/images/bitcoin_icon', 'fill-bitcoin ml-auto md:mx-auto w-4')
                                @else
                                    @svg('public/images/bitcoin_icon', 'fill-muted ml-auto md:mx-auto w-4')
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @if ($business->status === 'new')
                                        <form action="{{ route('listing.update',['listing' => $business, 'status' => 'approved' ]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn--sm btn--primary mr-2">{{ trans('translations.approve') }}</button>
                                        </form>
                                        <form action="{{ route('listing.update',['listing' => $business, 'status' => 'rejected' ]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn--sm btn--error">{{ trans('translations.reject') }}</button>
                                        </form>
                                    @else
                                        <form action="{{ route('listing.destroy',['listing' => $business ]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn--sm btn--error" onclick="return confirm('{{ trans('translations.delete_listing') }}')">{{ trans('translations.delete') }}</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-gray-400"><span class="mx-auto">{{ trans('translations.no_available_listing') }}</span></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{ $listing->withQueryString()->links() }}
    </div>
@endsection