<script setup>
import UnitStore from '@/store/unit';

function submit(){
    UnitStore.store()
}

</script>

<template>
    <div id="unit-create-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                <div class="flex flex-col bg-white border border-[#6FD943] shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-[#6FD943] dark:border-neutral-700">
                    <h3 class="font-semibold text-[#6FD943] dark:text-white">
                    Unit Create
                    </h3>
                    <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#unit-create-modal">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                    </button>
                </div>

                    <div class="p-4 overflow-y-auto">
                        <form @submit.prevent="submit" class="space-y-3">
                            <div class="form-group">
                                <label for="name" class="label">Name</label>
                                <input type="text" v-model="UnitStore.unitForm.name" autofocus class="form-input" placeholder="Enter name" id="name">
                                <span v-if="UnitStore.errors.name" class="form-error" >{{ UnitStore.errors.name[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label for="short_name" class="label">Short Name</label>
                                <input type="text" v-model="UnitStore.unitForm.short_name" autofocus class="form-input" placeholder="Enter short name" id="short_name">
                                <span v-if="UnitStore.errors.short_name" class="form-error" >{{ UnitStore.errors.short_name[0] }}</span>
                            </div>

                            <div class="form-group py-2">
                                <button v-if="!UnitStore.isLoaderOn" type="submit" class="px-3 py-2 float-end bg-green-500 text-white rounded-md hover:bg-green-600 duration-200">Add New</button>

                                <button v-else type="submit"
                                    class="px-3 py-2 float-end bg-green-500 text-white rounded-md hover:bg-green-600 duration-200 flex justify-center items-center w-[90px] bg-[#3AC18C] rounded-md float-end hover:text-white">
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