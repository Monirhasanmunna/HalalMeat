<script setup>
import { useForm } from '@inertiajs/vue3';

const emits = defineEmits(['create']);
    
const createForm = useForm({
    name : '',
    percentage : ''
});


function submit(){
    emits('create', createForm);
}

</script>

<template>
    <div id="tax-create-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                <div class="flex flex-col bg-white border border-[#6FD943] shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-[#6FD943] dark:border-neutral-700">
                    <h3 class="font-semibold text-[#6FD943] dark:text-white">
                    Unit Create
                    </h3>
                    <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#tax-create-modal">
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
                                <input type="text" v-model="createForm.name" autofocus class="form-input" placeholder="Enter name" id="name">
                                <span v-if="createForm.errors.name" class="form-error" >{{ createForm.errors.name }}</span>
                            </div>

                            <div class="form-group">
                                <label for="percentage" class="label">Percentage</label>
                                <input type="number" v-model="createForm.percentage" autofocus class="form-input" placeholder="Enter percentage" id="percentage">
                                <span v-if="createForm.errors.percentage" class="form-error" >{{ createForm.errors.percentage }}</span>
                            </div>

                            <div class="form-group py-2">
                                <button class="px-3 py-2 float-end bg-green-500 text-white rounded-md hover:bg-green-600 duration-200" >Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>