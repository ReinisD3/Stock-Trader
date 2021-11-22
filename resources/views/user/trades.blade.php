<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Active Trades') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6 float-left">
                    <a href="{{route('user.history')}}"><button>Trade History</button></a>
                    </div>
                    <div class="mb-6 float-right">
                        <form action="{{route('user.trades')}}">
                            @csrf
                            <label for="companyToFilter" class="text-sm text-gray-600 dark:text-gray-400">Company
                                :</label>
                            <select class="h-9 text-sm content-center" id="companyToFilter" name="companyToFilter">
                                <option value="" selected >All</option>
                                @foreach($companyList as $companyName)
                                    <option class="h-8" value="{{$companyName->company}}"
                                            @if (request('companyToFilter') === $companyName->company) selected @endif>{{$companyName->company}}</option>
                                @endforeach

                            </select>
                            <button type="submit">Find</button>
                        </form>
                    </div>
                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-3 text-left"
                            >Company <br><span class="text-xs">(click to check)</span></th>
                            <th class="p-3 text-left">Symbol</th>
                            <th class="p-3 text-left">Buy price</th>
                            <th class="p-3 text-left">Stock amount</th>
                            <th class="p-3 text-left">
                                <form action="{{route('user.trades')}}">
                                    <input hidden name="sortDirection" type="text" value="{{$sortDirection}}">
                                    <button value="usd_invested" name="sortBy" type="submit">Usd invested</button>
                                </form></th>
                            <th class="p-3 text-left"><form action="{{route('user.trades')}}">
                                    <input hidden name="sortDirection" type="text" value="{{$sortDirection}}">
                                    <button value="profit" name="sortBy" type="submit">Profit</button>

                                </form></th>
                            <th class="p-3 text-left"><form action="{{route('user.trades')}}">
                                    <input hidden name="sortDirection" type="text" value="{{$sortDirection}}">
                                    <button value="profit_to_investment" name="sortBy" type="submit">Profit/Invested</button>
                                </form></th>
                            <th class="p-3 text-left">Current price</th>
                            <th class="p-3 text-left">Info/Sell</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trades as $trade)
                            <tr class="bg-blue-100 lg:text-black">
                                <td class="p-2 pl-5 pr-5 bg-transparent border-1 border-blue-500 text-blue-500 text-lg hover:bg-blue-500 hover:text-blue-100 focus:border-2 focus:border-blue-300">
                                    <a href="{{route('stocks.info', $trade->company_symbol)}}">{{$trade->company}}</a>
                                </td>
                                <td class="p-3">{{$trade->company_symbol}}</td>
                                <td class="p-3">{{$trade->buy_price}}</td>
                                <td class="p-3">{{$trade->amount_bought}}</td>
                                <td class="p-3">{{$trade->usd_invested}}</td>

                                @if($trade->profit < 0)
                                    <td class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200">
                                        {{$trade->profit}}</td>
                                    <td class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200">
                                        {{$trade->profit_to_investment .'%'}}</td>
                                @else
                                    <td class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200">
                                        {{$trade->profit}}</td>
                                    <td class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200">
                                        {{$trade->profit_to_investment .'%'}}</td>
                                @endif
                                <td class="p-3">{{$trade->current_price}}</td>

                                <td class="p-3">
                                    <form method="get" action="{{route('stock.sell', $trade)}}">
                                        @csrf
                                        <button
                                            class="p-2 pl-5 pr-5 bg-transparent border-1 border-blue-500 text-blue-500 text-lg hover:bg-blue-500 hover:text-gray-100 focus:border-2 focus:border-blue-300"
                                            type="submit" value="sell">Sell
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

{{--                    {{ $trades->links() }}--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


