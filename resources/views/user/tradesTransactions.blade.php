<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trade Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6 float-right">
                        <form method="get" action="{{route('user.history')}}">
                            @csrf
                            <label for="transactionType" class="text-sm text-gray-600 dark:text-gray-400">Transaction Type
                                :</label>
                            <select class="h-9 text-sm content-center" id="transactionType" name="transactionType">
                                <option value="" ></option>
                                <option value="buy" @if (request('transactionType') === "buy") selected="selected" @endif  >Buy</option>
                                <option value="sell" @if (request('transactionType') === "sell") selected="selected" @endif >Sell</option>
                            </select>
                            <label for="companyFilter" class="text-sm text-gray-600 dark:text-gray-400">Company
                                :</label>
                            <select class="h-9 text-sm content-center" id="companyFilter" name="companyFilter">
                                <option value="" ></option>
                                @foreach($companyList as $company)
                                    <option class="h-8" value="{{$company->company}}"
                                            @if (request('companyFilter') === $company->company) selected="selected" @endif>{{$company->company}}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit">Filter</button>
                        </form>
                    </div>

                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-3">Type</th>
                            <th class="p-3">Company</th>
                            <th class="p-3 text-left">Transaction time</th>
                            <th class="p-3 text-left">Buy price</th>
                            <th class="p-3 text-left">Amount</th>
                            <th class="p-3 text-left">
                                <form action="{{route('user.history')}}">
                                    <input hidden name="sortDirection" type="text" value="{{$sortDirection}}">
                                    <input hidden name="companyFilter" type="text" value="{{request('companyFilter')}}">
                                    <input hidden name="transactionType" type="text" value="{{request('transactionType')}}">
                                    <button value="usd_invested" name="sortBy" type="submit">Usd amount</button>
                                </form></th>
                            <th class="p-3 text-left">Sell price</th>
                            <th class="p-3 text-left"><form action="{{route('user.history')}}">
                                    <input hidden name="sortDirection" type="text" value="{{$sortDirection}}">
                                    <input hidden name="companyFilter" type="text" value="{{request('companyFilter')}}">
                                    <input hidden name="transactionType" type="text" value="{{request('transactionType')}}">
                                    <button value="profit" name="sortBy" type="submit">Profit</button>

                                </form></th>
                            <th class="p-3 text-left"><form action="{{route('user.history')}}">
                                    <input hidden name="sortDirection" type="text" value="{{$sortDirection}}">
                                    <input hidden name="companyFilter" type="text" value="{{request('companyFilter')}}">
                                    <input hidden name="transactionType" type="text" value="{{request('transactionType')}}">
                                    <button value="profit_to_investment" name="sortBy" type="submit">Profit/Invested</button>
                                </form></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trades as $trade)
                        <tr class="bg-blue-100 lg:text-black">
                            <td class="p-3">{{$trade->sell_price ? 'Sell' : 'Buy'}}</td>
                            <td class="p-3">{{$trade->company}}</td>
                            <td class="p-3">{{$trade->created_at}}</td>
                            <td class="p-3">{{$trade->buy_price}}</td>
                            <td class="p-3">{{$trade->amount_bought}}</td>
                            <td class="p-3">{{$trade->usd_invested}}</td>
                            <td class="p-3">{{$trade->sell_price ?? ''}}</td>
                            @if($trade->sell_price)
                            @if($trade->profit < 0)
                                <td class="py-3 px-5 mb-4 bg-red-200 text-red-900 text-sm rounded-md border border-red-200">
                                    {{$trade->profit}}</td>
                                <td class="py-3 px-5 mb-4 bg-red-200 text-red-900 text-sm rounded-md border border-red-100">
                                    {{$trade->profit_to_investment .'%'}}</td>
                            @else
                                <td class="py-3 px-5 mb-4 bg-green-200 text-green-900 text-sm rounded-md border border-green-100">
                                    {{$trade->profit}}</td>
                                <td class="py-3 px-5 mb-4 bg-green-200 text-green-900 text-sm rounded-md border border-green-100">
                                    {{$trade->profit_to_investment .'%'}}</td>
                            @endif
                                @endif

                        </tr>
                        @endforeach


                        </tbody>
                    </table>
                    {{ $trades->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


