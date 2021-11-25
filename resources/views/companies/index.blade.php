<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search for Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center">
                        <form action="{{ route('stocks.search') }}">
                            @csrf
                            <input id="company" name="company" type="text" placeholder="Company name">
                            <button type="submit">Search</button>
                            @error('company')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror

                        </form>
                    </div>

                    @if (!empty($companies))
                        <table class="table text-gray-400 border-separate space-y-6 text-sm">
                            <thead class="bg-blue-500 text-white">
                            <tr>
                                <th class="p-3">Name</th>
                                <th class="p-3 text-left">Symbol</th>
                                <th class="p-3 text-left">Stock type</th>
                                <th class="p-3 text-center">More info</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies->toArray() as $company)

                                <tr class="bg-blue-100 lg:text-black">


                                    <td class="p-3">{{$company->getName()}}</td>
                                    <td class="p-3">{{$company->getSymbol()}}</td>
                                    <td class="p-3">{{$company->getStockType()}}</td>


                                    <td class="p-3 ">

                                        <a href="{{ route('stocks.info', $company->getSymbol()) }}"><h1>Click for
                                                Info</h1></a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="flex flex-wrap ">
                            @foreach($companyLogos as $company)
                                <div class="xl:w-1/8 md:w-1/8 ">
                                    <a href="{{ route('stocks.info', $company->symbol) }}">
                                        <div class="bg-white p-6 rounded-lg">
                                            <div
                                                class="pt-4 bg-white w-auto md:w-20 justify-center items-center shadow px-6 py-4 flex flex-col">
                                                <img src="{{$company->logo}}" alt="{{$company->symbol}}" title="img"
                                                     class=" object-cover">
                                                <h4 class="mt-8 border-b-2">{{$company->symbol}}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
