<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($company->getName() . ' info') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img src="{{$company->profile()->getLogo()}}" alt="LOGO" style="width: 50px">

                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-3">Name</th>
                            <th class="p-3 text-left">Industry</th>
                            <th class="p-3 text-left">Symbol</th>
                            <th class="p-3 text-left">Price</th>
                            <th class="p-3 text-left">Country</th>
                            <th class="p-3 text-left">Currency</th>
                            <th class="p-3 text-left">Exchange</th>
                            <th class="p-3 text-left">Web Page</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-blue-100 lg:text-black">
                            <td class="p-3">{{$company->getName()}}</td>
                            <td class="p-3">{{$company->profile()->getFinnhubIndustry()}}</td>
                            <td class="p-3">{{$company->getSymbol()}}</td>
                            <td class="p-3 font-bold">{{$price}}</td>
                            <td class="p-3">{{$company->profile()->getCountry()}}</td>
                            <td class="p-3">{{$company->profile()->getCurrency()}}</td>
                            <td class="p-3">{{$company->profile()->getExchange()}}</td>
                            <td class="p-3 text-green-800 hover:text-green-400"><a
                                    href="{{$company->profile()->getWeburl()}}">Visit website</a></td>
                        </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-3">Recommendation</th>
                            <th class="p-3 text-left">Buy</th>
                            <th class="p-3 text-left">Hold</th>
                            <th class="p-3 text-left">Sell</th>
                            <th class="p-3 text-left">Period</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-blue-100 lg:text-black">
                            <td class="p-3">{{$company->getName()}}</td>
                            <td class="p-3">{{$company->recommendationTrend()->getBuy()}}</td>
                            <td class="p-3">{{$company->recommendationTrend()->getHold()}}</td>
                            <td class="p-3">{{$company->recommendationTrend()->getSell()}}</td>
                            <td class="p-3">{{$company->recommendationTrend()->getPeriod()}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <form method="post" action="{{ route('stock.buy', $company->getSymbol() ) }}"
                          class="content-center text-sm">
                        @csrf

                        <input class="h-8" id="amount" name="amount" type="text" placeholder="Amount">
                        <button type="submit" class="border-black border-2  bg-green-600 text-lg w-12">Buy</button>
                        <br>
                        <label for="amount">Available Balance ({{$userBalance}}) </label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
