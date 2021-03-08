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

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">S/N</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Used By</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Total</th>

                        @can('expense-create')    
                         <th class="px-4 py-2">Action</th>
                        @endcan
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
                            <div style='display:none'>
                              {{$t = 0}}
                                @for($i=0; $i<count($row->users); $i++)
                                        {{ $t = $t + $row->category->amount}}
                                @endfor
                            </div>
                            @money($t)
                            </td>

                            @can('expense-create') 
                            <td class="border px-4 py-2">
                                  <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            @endcan

                            @can('expense-create') 
                                  <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </td>
                            @endcan
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