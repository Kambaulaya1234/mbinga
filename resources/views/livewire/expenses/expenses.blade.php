<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Expenses List
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

            @can('expense-create')              
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Expenses</button>
            
            @if($isModal)
                @include('livewire.expenses.create')
            @endif
            @endcan

            @if($showModal)
                @include('livewire.expenses.show')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">S/N</th>
                        <th class="px-4 py-2">Created AT</th>
                        <th class="px-4 py-2">Created By</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Paid To</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Approved By</th>

                        @can('expense-create')    
                         <th class="px-4 py-2">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $key => $row)
                        <tr>
                            <td class="border px-4 py-1">{{ $key + 1 }}</td>
                            <td class="border px-4 py-2">{{ $row->created_at }}</td>
                            
                            <td class="border px-4 py-2">
                                @foreach($row->created_by as $v)
                                   <label class="badge badge-success"> {{ $v->name }} </label>
                                @endforeach
                            </td>
                            <td class="border px-4 py-2">{{ $row->name }}</td>
                            <td class="border px-4 py-2">@money($row->amount)</td>

                            <td class="border px-4 py-2">
                                @foreach($row->paid_to as $v)
                                   <label class="badge badge-success"> {{ $v->name }} </label>
                                @endforeach
                            </td>
                            
                            <td class="border px-4 py-2">{{ $row->category->name }}</td>

                            <td class="border px-4 py-2">{{ $row->category->name }}</td>

                            <td class="border px-4 py-2">
                             @foreach($expenses_approved  as $key => $v)                                   
                                @php
                                 if($v->approved_by = $row->approved_by){
                                    $approved = true;
                                 }
                                @endphp
                             @endforeach
                                @if($approved)
                                    @foreach($row->approved_by as $v)
                                       <label class="badge badge-success"> {{ $v->name }} </label>
                                    @endforeach
                                @else
                                    <label class="badge badge-success"> Not approved! </label>
                                    <button wire:click="approve({{ $row->id }})" class="bg-green-500 hover:green-red-700 text-white font-bold py-2 px-4 rounded">Aprrove</button>
                                @endif
                            </td>


                            @can('expense-create') 
                            <td class="border px-4 py-2">
                                  <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            @endcan

                                  <button wire:click="show({{ $row->id }})" class="bg-green-500 hover:green-red-700 text-white font-bold py-2 px-4 rounded">Show</button>
                                  
                            @can('expense-create') 
                                  <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            @endcan
                            
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="5">No Expenses Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>