<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-3">Company</th>
                            <th class="p-3 text-left">Symbol</th>
                            <th class="p-3 text-left">Buy date</th>
                            <th class="p-3 text-left">Buy price</th>
                            <th class="p-3 text-left">Buy amount</th>
                            <th class="p-3 text-left">Total Usd invested</th>
                            <th class="p-3 text-left">Sell price</th>
                            <th class="p-3 text-left">Sell date</th>
                            <th class="p-3 text-left">Current price</th>
                            <th class="p-3 text-left">profit/loss</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trades as $trade)
                            <tr class="bg-blue-100 lg:text-black">
                                <td class="p-3"><a href="{{route('stocks.info', $trade->company_symbol)}}">{{$trade->company}}</a></td>
                                <td class="p-3">{{$trade->company_symbol}}</td>
                                <td class="p-3">{{$trade->created_at}}</td>
                                <td class="p-3">{{$trade->buy_price}}</td>
                                <td class="p-3">{{$trade->amount_bought}}</td>
                                <td class="p-3">{{$trade->amount_bought*$trade->buy_price}}</td>
                                <td class="p-3">{{$trade->sell_price ?? 'Active'}}</td>
                                <td class="p-3">{{$trade->sell_price ?? 'Active'}}</td>
                                <td class="p-3">{{$currentPrices[$trade->company_symbol] ?? 'no Data'}}</td>
                                @if($currentProfits[$trade->id] < 0)
                                    <div class="text-pink-700"> @else <div class="text-green-700 font-bold">  @endif
                                        <td class="p-3">{{$currentProfits[$trade->id] ?? 'No data'}}</td>
                                            </div>
                                                <td class="p-3">
                                                    @if(!$trade->sell_price)
                                                        <form method="post" action="{{route('stock.sell')}}">
                                                            @csrf
                                                            <button type="submit" value="sell">Sell</button>
                                                        </form>
                                                    @endif
                                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>


