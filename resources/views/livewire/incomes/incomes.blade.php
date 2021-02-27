<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Income List
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

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Inter Income</button>
            
            @if($isModal)
                @include('livewire.incomes.create')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">S/N</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Sent From</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incomes as $row)
                        <tr>
                            <td class="border px-4 py-1">{{ $row->id }}</td>
                            <td class="border px-4 py-2">{{ $row->date }}</td>
                            <td class="border px-4 py-2">{{ $row->type }}</td>
                            <td class="border px-4 py-2">{{ $row->user->name }}</td>
                            <td class="border px-4 py-2">{{ $row->amount }}</td>
                            <td class="border px-4 py-2">{{ $row->amount }}</td>
                            <td class="border px-4 py-2">{{ $row->description }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="8">No Incomes Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>