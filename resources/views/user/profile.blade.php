<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
        <div class="font-semibold text-xl text-gray-800 leading-tight float-right">
            <a href="{{route('user.history')}}"><button>Trade History</button></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <table class="table text-gray-400 border-separate space-y-6 text-sm">
                            <thead class="bg-blue-500 text-white">
                            <tr>
                                <th class="p-3">Name</th>
                                <th class="p-3 text-left">Email</th>
                                <th class="p-3 text-left">Balance</th>
                                <th class="p-3 text-left">Invested</th>
                                <th class="p-3 text-left"><button  class="button" value="add" onclick="show()">Add Money</button></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-blue-100 lg:text-black">
                                    <td class="p-3">{{$user->name}}</td>
                                    <td class="p-3">{{$user->email}} </td>
                                    <td class="p-3">{{number_format($user->balance )?? 0}} USD</td>
                                    <td class="p-3">{{number_format($activeInvestments)}} USD</td>
                                    <td class="p-3">
                                        <form method="post" class="deposit" style="display:none" action="{{route('user.deposit')}}">
                                            @csrf
                                            <input class="w-24 h-6 text-sm" type="text" name="depositAmount" id="depositAmount" placeholder="Amount">
                                            <button type="submit" class="color ">Deposit</button>
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

                                            </script>
                                        </form>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    @error('depositAmount')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

