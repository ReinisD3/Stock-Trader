<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('World News') }}
        </h2>
    </x-slot>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto max-w-7x1">
            <div class="flex flex-wrap w-full mb-4 p-4">
                <div class="w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-4xl text-5xl font-medium font-bold title-font mb-2 text-gray-900">
                        News</h1>
                    <div class="h-1 w-20 bg-indigo-500 rounded"></div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach($news as $article)
                    <div class="xl:w-1/3 md:w-1/2 p-4">
                        <div class="bg-white p-6 rounded-lg">
                            <img
                                class="lg:h-60 xl:h-56 md:h-64 sm:h-72 xs:h-72 h-72  rounded w-full object-cover object-center mb-6"
                                src="{{$article->getImage()}}" alt="Image Size 720x400">
                            <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font" ><a
                                    href="{{$article->getUrl()}}" target="_blank" >Read more at {{$article->getSource()}}</a></h3>
                            <h2 class="text-lg text-gray-900 font-medium title-font mb-4">{{$article->getHeadline()}}</h2>
                            <p class="leading-relaxed text-base">{{$article->getSummary()}}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</x-app-layout>
