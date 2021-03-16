<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="absolute bg-blue-200 opacity-95">
                         <strong>EXPENSES DETAILS FOR {{ $name }} To: {{ $department_id }} DEPARTMENT</strong>
                    </div>
            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Created At :</strong>  {{ $created_at }}</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Created By :</strong>
                    @foreach($created_by as $v)
                      <label class="badge badge-success"> {{ $v->name }} </label>
                    @endforeach
                </label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Name :</strong>  {{ $name }}</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Description :</strong>  {{ $description }}</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Paid To :</strong>
                    @foreach($paid_to as $v)
                      <label class="badge badge-success"> {{ $v->name }} </label>
                    @endforeach
                </label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Amount :</strong> @money($amount)</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Expense Start Date :</strong>  {{ $expense_start_date }}</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Expense End Date :</strong>  {{ $expense_end_date }}</label>
            </div>
                  
            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Payment Type :</strong>  {{ $payment_type }}</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Department :</strong>  {{ $department_id}}</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Category :</strong>  {{ $category_id}}</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Approved By :</strong>
                    @if(count($approved_by) > 0)
                    @foreach($approved_by as $v)
                      <label class="badge badge-success"> {{ $v->name }} </label>
                    @endforeach
                    @else
                      <label class="badge badge-success"> Not approved </label>
                    @endif
                </label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Approved At :</strong>  {{ $approved_at }}</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Updated At :</strong>  {{ $updated_at }}</label>
            </div>

            <div class="mb-4">
                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2"> <strong>Tags :</strong>
                    @if(count($tags) > 0)
                    @foreach($tags as $v)
                      <label class="badge badge-success"> {{ $v->name }} </label>
                    @endforeach
                    @else
                       <label class="badge badge-success"> No tags on this expense! </label>
                    @endif
                </label>
            </div>

        </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    
                    <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                      Back
                    </button>
                </span>
        </div>
        </div>
    </div>
</div>
