<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formEmail" wire:model="name">
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formEmail" wire:model="description">
                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="formStatus" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                            <select class="form-control" wire:model="payment_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Payment Type</option>
                                <option value="Float">Float</option>
                                <option value="Cash">Cash</option>
                            </select>
                            @error('payment_type') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formEmail" wire:model="amount">
                            @error('amount') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Paid To:</label>
                                <select class="form-control" wire:model="paid_to" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
                                <option > Paid To: </option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">  {{ $user->name }} </option>
                                @endforeach
                            </select>
                            @error('paid_to') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="formName" class="block text-gray-700 text-sm font-bold mb-2">Paid at:</label>
                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formName" wire:model="paid_at">
                            @error('paid_at') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                                <select class="form-control" wire:model="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option > Select Category </option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">  {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Department:</label>
                                <select class="form-control" wire:model="department_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option > Select Department </option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">  {{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="formName" class="block text-gray-700 text-sm font-bold mb-2">Expense Start Date:</label>
                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formName" wire:model="expense_start_date">
                            @error('expense_start_date') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="formName" class="block text-gray-700 text-sm font-bold mb-2">Expense End Date:</label>
                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formName" wire:model="expense_end_date">
                            @error('expense_end_date') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Created By:</label>
                                <select class="form-control" wire:model="created_by" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
                                <option > Select User: </option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">  {{ $user->name }} </option>
                                @endforeach
                            </select>
                            @error('created_by') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        {{-- <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Approved By:</label>
                                <select class="form-control" wire:model="approved_by" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
                                <option > Select User: </option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">  {{ $user->name }} </option>
                                @endforeach
                            </select>
                            @error('approved_by') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div> --}}

                        {{-- <div class="mb-4">
                            <label for="formName" class="block text-gray-700 text-sm font-bold mb-2">Approved At:</label>
                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formName" wire:model="approved_at">
                            @error('approved_at') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div> --}}

                        <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Tags:</strong>   </label>
                            {{-- here you can input ','(comma)separated tag names you want to associate with the expense --}}
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formEmail" wire:model="tags">
                        </div>
                        
                    </div>
                </div>
    
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                          Save
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        
                        <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                          Cancel
                        </button>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
