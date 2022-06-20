<div class="p-16">
    <div class="w-64">

        <form wire:submit.prevent="import">

            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload
                file | Select Excel File</label>

            <input type="file" wire:model="file">

            @error('file')
                <span class="error">{{ $message }}</span>
            @enderror
            <button type="submit"
                class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Start
                Import</button>
        </form>


    </div>
    <div wire:poll="batchProgress" class="w-1/2 mt-16 {{ !$processing ? 'hidden' : null }}">
        <div class="mb-1 text-lg font-medium dark:text-white">Importing Data, Please Wait ...</div>
        <div class="w-full h-6 bg-gray-200 rounded-full dark:bg-gray-700">
            <div class="h-6 bg-green-600 rounded-full dark:bg-green-300" style="width: 45%">
                <div class="px-4">45%</div>
            </div>
        </div>
    </div>
</div>
