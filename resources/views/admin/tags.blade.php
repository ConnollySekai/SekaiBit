@extends('layouts.admin')

@section('content')
    <div class="panel shadow-normal p-6">
        <header class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-2xl mb-0">{{ trans('translations.tags') }}</h1>
        </header>
        <div class="mb-4">
            <form action="{{ route('tag.store') }}" method="post" class="flex flex-col md:flex-row md:items-end">
                @csrf
                <div class="form-group flex-1 mb-4 pr-4 md:mb-0">
                    <label for="tagName">{{ trans('translations.tag_name') }}</label>
                    <input type="text" id="tagName" class="input @error('tag_name') input--error @enderror" name="tag_name" value="{{ old('tag_name') }}">
                </div>
                <div class="form-group flex-1 mb-4 pr-4 md:mb-0">
                    <label for="tagCount">{{ trans('translations.tag_count') }}</label>
                    <input type="number" id="tagCount" class="input @error('tag_count') input--error @enderror" name="tag_count" value="{{ old('tag_count') }}">
                </div>
                <div class="form-group">
                    <button class="btn btn--primary w-full md:w-auto">{{ trans('translations.submit') }}</button>
                </div>
            </form>
        </div>
        <div class="table-wrap-overflow">
            <table class="table table--bordered table--stackable rounded-md">
                <thead>
                    <tr>
                        <th>{{ trans('translations.tag_name') }}</th>
                        <th>{{ trans('translations.tag_count') }}</th>
                        <th>{{ trans('translations.business_listing') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tags->count())
                        @foreach($tags as $tag)
                        <tr>
                            <td data-label="{{ trans('translations.tag_name') }}">{{ $tag->tag_name }}</td>
                            <td data-label="{{ trans('translations.tag_count') }}">{{ $tag->tag_count }}</td>
                            <td data-label="{{ trans('translations.business_listing') }}">{{ $tag->listings()->count() }}</td>
                            <td>
                                <div class="flex justify-end">
                                    <form action="{{ route('tag.destroy',['tag' => $tag ]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn--sm btn--error" onclick="return confirm('{{ trans('translations.delete_tag') }}')">{{ trans('translations.delete') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-gray-400"><span class="mx-auto">{{ trans('translations.no_tags_available') }}</span></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{ $tags->links() }}
    </div>
@endsection