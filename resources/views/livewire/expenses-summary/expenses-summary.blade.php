<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Income Expenses Balances
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left" style="margin-top: 10px;">{{ session()->get('message') }}</p>
          @endif

          <legend>Search Expenses Summary</legend>

          <form action="{{ route('getExpensesSummary') }}" method="get">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="">
                    <div class="mb-4">
                        <label for="formName" class="block text-gray-700 text-sm font-bold mb-2">Start Date:</label>
                        <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formName" wire:model="start_date">
                        @error('start_date') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="formName" class="block text-gray-700 text-sm font-bold mb-2">End Date:</label>
                        <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formName" wire:model="end_date">
                        @error('end_date') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
{{-- 
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button wire:click.prevent="getExpensesSummary()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Save
                    </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"> 
                    
                   <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Cancel
                    </button>
                </span> 
            </div> --}}
             </form>
          <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    @if (session()->has('message'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
        
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-green-100">
                                <th class="border px-4 py-2 text-center" colspan="4.5">Total Income is: @money($totalIncome)</th>
                                <th class="border px-4 py-2 text-center" colspan="4.5">
                                    Cashflow is: 
                                    <div style="display: none" >
                                        {{$t = $totalIncome - $totalExpenses }}
                                    </div>
                                    @money( $t)        
                                </th>
                            </tr>
                            <tr class="bg-red-100">
                                <th class="border px-4 py-2 text-center" colspan="4">Total Expenses is:  @money($totalExpenses)</th>
                            </tr>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-1">S/N</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Type</th>
                                <th class="px-4 py-2">Used By</th>
                                <th class="px-4 py-2">Category</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Amount</th>
                                {{-- <th class="px-4 py-2">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($expenses as $key => $row)
                                <tr>
                                    <td class="border px-4 py-1">{{ $key + 1 }}</td>
                                    <td class="border px-4 py-2">{{ $row->date }}</td>
                                    <td class="border px-4 py-2">{{ $row->type }}</td>
        
                                    <td class="border px-4 py-2">
                                        @foreach($row->users as $v)
                                            <label class="badge badge-success"> {{ $v->name }} </label>
                                        @endforeach
                                    </td>

                                    <td class="border px-4 py-2">{{ $row->category->name }}</td>
                                    <td class="border px-4 py-2">{{ $row->name }}</td>
                                    <td class="border px-4 py-2">{{ $row->description }}</td>
                                    <td class="border px-4 py-2">
                                    <div style="display: none">
                                        {{$t = 0}}
                                        {{ $t = $row->category->amount}}
                                    </div>
                                        @money($t)
                                    </td>
                                    {{-- <td class="border px-4 py-2">
                                        <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                        <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="8">No Expenses Summary Found, Please select date to get the summary!</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        </div>
    </div>
</div>