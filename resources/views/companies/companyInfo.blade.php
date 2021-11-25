<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'About '.__($company->getName()) }}
        </h2>
    </x-slot>
    <div class="bg-gray-200 min-h-screen flex justify-center items-center shadow-xl">
        <div class="flex flex-col lg:flex-row w-full justify-center gap-7">
            <div class="bg-white w-full lg:w-1/3 p-10 rounded-lg order-2 lg:order-first">
                <h1 class="text-gray-700 font-bold tracking-wider">{{$company->getName()}}</h1>
                <h3>{{$company->profile()->getCountry()}} {{$company->profile()->getFinnhubIndustry()}}</h3>
                <p class="text-gray-500 mt-4">{{$company->profile()->getExchange()}}</p>

                <div class="flex my-10 border-2 border-blue-700 rounded-sm p-5 bg-blue-50 justify-between items-center">
                    <div>
                        <span class="text-gray-500">USD</span> <span
                            class="text-3xl">{{$price}} </span> <span class="text-gray-500">/per Stock</span>
                    </div>
                </div>

                <h1 class="text-gray-700 font-bold tracking-wider">Buy Stock</h1>

                <form method="post" action="{{ route('stock.buy', $company->getSymbol() ) }}"
                      class="content-center text-sm">
                    @csrf
                    <input class="w-full outline-none border-2 border-gray-300 py-3 pl-5 rounded-sm mt-4" id="amount"
                           name="amount" type="text" placeholder="Amount">
                    <input hidden name="companySymbol" type="text" value="{{ $company->getSymbol() }}">
                    <label for="amount">Available Balance ({{$userBalance}}) </label>
                    <button type="submit"
                            class="w-full rounded-sm py-5 mt-5 text-center bg-blue-600 text-white font-bold tracking-wider">
                        Buy
                    </button>
                    <br>
                </form>
                @error('balance')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                @error('amount')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full lg:w-1/5 order-1 lg:order-last flex flex-col justify-start gap-7">
                <div class="bg-white p-2 rounded-lg text-center">
                    <img src="{{$company->profile()->getLogo()}}" alt=""
                         class="h-20 w-full object-cover content-center rounded-t-lg"/>
                    <div class="flex justify-center">
                        <img src="{{$company->profile()->getLogo()}}" alt=""
                             class="w-20 h-20 rounded-full object-cover content-center -mt-10 border-4 border-white"/>
                    </div>
                    <h1 class="text-center font-bold tracking-wider text-gray-700 mt-4">{{$company->getName()}}</h1>
                    <p class="text-gray-500 mt-1 text-center">{{$company->profile()->getFinnhubIndustry()}}</p>
                    <br/>
                    <button class="bg-blue-700 py-2 px-4 rounded-full text-white text-sm font-semibold">
                        <a href="{{$company->profile()->getWeburl()}}" target="_blank" >Visit Official Page</a></button>


                </div>
                <div class="bg-white rounded-lg p-6">
                    <h1 class="font-bold tracking-wider text-gray-800 text-center">Recommendations</h1>
                    <p class="text-sm text-gray-500 mt-2 text-center">  {{$company->recommendationTrend()->getPeriod()}}</p>
                    <div class="my-4 flex justify-between gap-5">
                        <div class="border-2 border-blue-400 rounded-lg py-2  w-full text-gray-700 text-center">
                            Buy {{$company->recommendationTrend()->getBuy()}}
                        </div>
                        <div class="border-2 border-gray-200 rounded-lg py-2 w-full  text-gray-700 text-center">
                            Hold {{$company->recommendationTrend()->getHold()}}
                        </div>
                        <div class="border-2 border-gray-200 rounded-lg py-2 w-full  text-gray-700 text-center">
                            Sell {{$company->recommendationTrend()->getSell()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
