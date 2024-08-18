<script setup>
import CategoryStore from '@/store/category';

function fileInput(event){
    CategoryStore.categoryForm.image = event.target.files[0];
}

</script>

<template>
    <div id="category-edit-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                <div class="flex flex-col bg-white border border-[#6FD943] shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-[#6FD943] dark:border-neutral-700">
                    <h3 class="font-semibold text-[#6FD943] dark:text-white">
                    Catgory Edit
                    </h3>
                    <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#category-edit-modal">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                    </button>
                </div>

                    <div class="p-4 overflow-y-auto">
                        <form @submit.prevent="CategoryStore.update" class="space-y-3">
                            <div class="form-group">
                                <label for="name" class="label">Name</label>
                                <input type="text" v-model="CategoryStore.categoryForm.name" autofocus class="form-input" placeholder="Enter name" id="name">
                                <span v-if="CategoryStore.errors.name" class="form-error" >{{ CategoryStore.errors.name[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label for="image" class="label">Image</label>
                                <input type="file" @input="fileInput($event)" name="file-input-medium" id="file-input-medium" class="block w-full border border-gray-400 shadow-sm focus:z-10 rounded-md text-sm focus:ring-[#6FD943] disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                                file:bg-gray-50 file:border-0
                                file:me-4
                                file:py-2.5 file:px-4
                                dark:file:bg-neutral-700 dark:file:text-neutral-400">
                                <span v-if="CategoryStore.errors.image" class="form-error" >{{ CategoryStore.errors.image[0] }}</span>
                            </div>


                            <div class="form-group">
                                <label for="status" class="label">Status</label>
                                <select class="form-input" v-model="CategoryStore.categoryForm.status">
                                    <option value="1" >Active</option>
                                    <option value="0" >Inactive</option>
                                </select>
                            </div>


                            <div class="flex justify-between items-center w-full py-1">
                                
                                <div class="div">
                                    <div v-if="CategoryStore.categoryForm.image" class="w-[60px] h-[60px] overflow-hidden rounded-xl border-2 border-[#6FD943]">
                                        <img :src="CategoryStore.categoryForm.src" class="w-full h-full object-cover" :alt="CategoryStore.categoryForm.src" srcset="">
                                    </div>

                                    <div v-else class="w-[60px] h-[60px] rounded-xl border-2 border-[#6FD943] flex justify-center items-center text-[20px] text-gray-300">CA</div>
                                </div>

                                <button v-if="!CategoryStore.isLoaderOn" type="submit" class="px-3 py-2 float-end bg-green-500 text-white rounded-md hover:bg-green-600 duration-200">Update</button>

                                <button v-else type="submit" class="px-3 py-2 float-end bg-green-500 text-white rounded-md hover:bg-green-600 duration-200 flex justify-center items-center w-[90px] bg-[#3AC18C] rounded-md float-end hover:text-white">
                                    <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-white rounded-full dark:text-blue-500"
                                        User="status" aria-label="loading">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>