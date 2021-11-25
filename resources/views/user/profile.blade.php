<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
        <div class="font-semibold text-xl text-gray-800 leading-tight float-right">
            <a href="{{route('user.history')}}">
                <button>Trade History</button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 relative">
                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-3">Name</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Balance</th>
                            <th class="p-3 text-left">Invested</th>
                            <th class="p-3 text-left">
                                <button class="button" value="add" onclick="show()">Deposit</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-blue-100 lg:text-black">
                            <td class="p-3">{{$user->name}}</td>
                            <td class="p-3">{{$user->email}} </td>
                            <td class="p-3">{{number_format($user->balance )}} USD</td>
                            <td class="p-3">{{number_format($activeInvestments)}} USD</td>
                            <td class="p-3">
                                <form method="post" class="deposit" style="display:none"
                                      action="{{route('user.deposit')}}">
                                    @csrf
                                    <input class="w-24 h-6 text-sm" type="text" name="depositAmount" id="depositAmount"
                                           placeholder="Amount">
                                    <button type="submit" class="color ">Deposit</button>

                                </form>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <form method="post" class="deposit" style="display:none"
                          action="{{route('user.deposit')}}">
                        @csrf
                        <input class="w-24 h-6 text-sm" type="text" name="depositAmount" id="depositAmount"
                               placeholder="Amount">
                        <button type="submit" class="color text-sm">Deposit</button>

                    </form>
                    @error('depositAmount')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="pt-5 text-center ">

                        <button id="withdraw" class="bg-green-600 m-4 p-5 ">WITHDRAW</button>
                        <iframe style="display: none; margin-right: auto; margin-left: auto"
                                src="https://giphy.com/embed/WOYjDaFngeyAQBW7wd" width="480" height="270"
                                 class="giphy-embed" allowFullScreen></iframe>
                    </div>


                    <script>
                        const button = document.querySelector('.button')
                        const container = document.querySelector('.deposit');
                        button.addEventListener('click', () => {
                            if (container.style.display === 'none') {
                                container.style.display = 'block';
                            } else {
                                container.style.display = 'none';
                            }

                        });
                        const withdraw = document.querySelector('#withdraw')
                        const celebrate = document.querySelector('iframe')
                        withdraw.addEventListener('click', () => {
                            if (celebrate.style.display === 'none') {
                                celebrate.style.display = 'block';
                            } else {
                                celebrate.style.display = 'none';
                            }

                        });

                    </script>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

