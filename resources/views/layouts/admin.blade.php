
<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>
    <div class="h-screen">
        <div class="container mx-auto">
            <div class="column flex flex-col w-full md:w-10/12 mx-auto">
                <header class="py-8">
                    <nav class="flex justify-between">
                        <ul class="flex">
                            <li  class="mr-4"><a href="{{ route('listing.index') }}" class="hover:text-primary {{ request()->segment(2) === 'listing' ? 'text-primary font-bold': '' }}">{{ trans('translations.business_listing') }}</a></li>
                            <li><a href="{{ route('tag.index') }}" class="hover:text-primary {{ request()->segment(2) === 'tags' ? 'text-primary font-bold': '' }}">{{ trans('translations.tags') }}</a></li>
                        </ul>
                        <ul class="flex justify-end">
                            <li class="mr-4 flex">@svg('public/images/ui-user','fill-primary h-4 w-4 mr-2 mt-1') <strong>{{ auth()->user()->username }}</strong></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">{{ trans('translations.logout') }}</a>
                                <form action="{{ route('logout') }}" method="POST" id="logoutForm" class="hidden">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
                </header>
                <main class="pb-8">
                    @if ($notification = session('notification'))
                        {{ show_notification($notification['message'], $notification['type']) }}
                    @endif
                    
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>