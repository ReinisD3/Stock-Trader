<x-guest-layout >

        <section>
            <h1 class="text-center md:pt-16 text-4xl font-bold  text-green-800 ">Have STOCK have FUTURE </h1>
            <div
                class="pt-6 text-center"
            @if (Route::has('login'))
                <div class="hidden text-center px-6 py-4 sm:block">

                    @auth
                        <a href="{{ url('/news') }}" class="text-lg text-white-700 dark:text-white-500 m-4">News</a>
                        <a href="{{ url('/search') }}" class="text-lg text-white-700 dark:text-white-500 m-4">Search</a>
                        <a href="{{ route('user.profile') }}" class="text-lg text-white-700 dark:text-white-500 m-4">MyAccount</a>
                    @else
                        <div class="box-content backdrop-opacity-50 m-3">
                            <a href="{{ route('login') }}"
                               class=" text-lg text-white-700 dark:text-white-500 m-4">
                                Keep going</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="ml-4 text-lg text-white-700 dark:text-white-500 m-4">Start having</a>
                            @endif
                        </div>

                    @endauth
                </div>

                @endif



                </div>
        </section>

</x-guest-layout>

