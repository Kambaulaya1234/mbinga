<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Roles List
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

            {{-- @can('roles-list') --}}
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Roles</button>
            @if($isModal)
                @include('livewire.roles.create')
            @endif
            {{-- @endcan --}}

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">S/N</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Permission</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $key => $row)
                        <tr>
                            <td class="border px-4 py-1">{{ $key + 1 }}</td>
                            <td class="border px-4 py-2">{{ $row->name }}</td>
                            <td class="border px-4 py-2">
                                @if(!empty($row->getPermissionNames()))
                                  @foreach($row->getPermissionNames() as $v)
                                     <label class="badge badge-success">{{ $v }}</label>
                                  @endforeach
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="5">No Roles Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>