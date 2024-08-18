<script setup>
import Box from '@/Components/Box.vue';
import MasterLayout from '@/Layouts/MasterLayout.vue';
import BreadcrumbComponent from '@/Components/Backend/BreadcrumbComponent.vue';
import {debounce} from 'lodash';
import { reactive } from 'vue';
import { watch } from 'vue';
import { router,Link, Head, useForm } from '@inertiajs/vue3';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import { HSOverlay } from 'preline/preline';
import axios from 'axios';
import taxCreateModalComponent from '@/Components/Backend/tax/taxCreateModalComponent.vue';


const props = defineProps({
    taxes : Object,
    filters: Array
});


const breadcrumb = {
    title : 'Tax List',

    items : [
        {
            name: 'Tax',
            link: '/tax',
            active: true
        }
    ]
}


const selectAndSearch = reactive({
    count : props.filters.count ?? 20,
    search : props.filters.search ?? ''
});


watch(selectAndSearch, debounce(function() {
    router.get(route('tax.index'), selectAndSearch, {
        preserveState: true,
        preserveScroll: true
    });

}, 200));



function create(createForm){
    createForm.post(route('tax.store'), {
        onSuccess: () => {
            createForm.name = ''
            createForm.percentage = ''
            HSOverlay.close('#tax-create-modal')
        }
    });
}


const editForm = useForm({
    name : '',
    percentage : '',
    id: '',
    status: '',
    _method: 'PUT'
});



function edit($id){
    axios.get(route('tax.edit', {'id': $id}))
    .then(res => {
        if(res.data){
            editForm.name = res.data.name
            editForm.id = res.data.id
            editForm.percentage = res.data.percentage
            editForm.status = res.data.status
            HSOverlay.open('#tax-edit-modal')
        }
    });
}

function update(){
    editForm.post(route('tax.update', {'id' : editForm.id}), {
        onSuccess: () => {
            editForm.reset()
            HSOverlay.close('#tax-edit-modal')
        }
    });
}


function destroy($id){
    router.delete(route('tax.destroy', {'id' : $id}),{
        preserveScroll:true,
    });
}

</script>

<template>
    <Head title="tax List" />
    <MasterLayout>
        <div class="w-full px-1.5 flex justify-between items-center">
            <BreadcrumbComponent :breadcrumb="breadcrumb" />

            <div class="wrapper flex item-center gap-4">
                <button class="btn btn-primary text-[20px] p-1.5 rounded-lg bg-[#6FD943] text-white"  data-hs-overlay="#tax-create-modal">
                    <PlusIcon />
                </button>
            </div>
        </div>

        <Box class="space-y-6 h-auto mt-3">
            <div class="w-full space-y-5">
                <div class="w-full flex justify-between items-center">
                        <div class="w-1/12">
                            <select class="table-select" v-model="selectAndSearch.count">
                                <option value="10" >10</option>
                                <option value="20" >20</option>
                                <option value="50" >50</option>
                                <option value="100" >100</option>
                            </select>
                        </div>

                        <div class="w-11/12 flex items-center justify-end">
                            <div class="relative max-w-xs">
                                <label for="hs-table-search" class="sr-only">Search</label>
                                <input type="text" v-model="selectAndSearch.search" name="hs-table-search" id="hs-table-search" class="table-search" placeholder="Search for items">
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex  flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700 dark:shadow-gray-900">
                                <table class="table">
                                    <thead class="bg-gray-50 dark:bg-neutral-700">
                                        <tr>
                                            <th width="10%" class="table-th">SL</th>
                                            <th scope="col" class="table-th">Name</th>
                                            <th scope="col" class="table-th">Percentage</th>
                                            <th width="25%" class="table-th">Status</th>
                                            <th width="10%" class="table-th text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        <tr v-for="(tax, index) in taxes.data" :key="index" >
                                            <td class="table-td">{{ index+1 }}</td>
                                            <td class="table-td">{{ tax.name }}</td>
                                            <td class="table-td">{{ tax.percentage + '%' }}</td>
                                            <td class="table-td">
                                                <span v-if="tax.status == 1" class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-teal-500 text-teal-500">Active</span>
                                                <span v-else class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-red-500 text-red-500">Inactive</span>
                                            </td>
                                            <td class="table-td flex gap-4 items-center h-[90px]">
                                                <button @click="edit(tax.id)" class="px-2 py-1.5 text-[17px] text-green-500 border border-green-500 rounded-md duration-200 hover:bg-[#6FD943] hover:text-white">
                                                    <EditIcon/>
                                                </button>

                                                <button @click="destroy(tax.id)" class="px-2 py-1.5 text-[17px] text-red-500 border border-red-400 rounded-md duration-200 hover:bg-red-400 hover:text-white">
                                                    <DeleteIcon/>
                                                </button>
                                            </td>
                                        </tr>

                                        <tr v-if="taxes.data.length == 0">
                                            <th colspan="5" class="text-center p-3 text-gray-400 font-semibold">No data found</th>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="py-1 flex justify-end mt-2" v-if="taxes.data.length > 0">
                                <nav class="flex items-center space-x-1">
                                    <Link v-for="(link, index) in taxes.links" :key="index" :href="link.url" v-html="link.label" :class="{'bg-[#6FD943] font-semibold text-white' : link.active}" type="button" class="table-paginate"></Link>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </Box>

        <taxCreateModalComponent @create="create" />

        <div id="tax-edit-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                <div class="flex flex-col bg-white border border-[#6FD943] shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-[#6FD943] dark:border-neutral-700">
                    <h3 class="font-semibold text-[#6FD943] dark:text-white">
                    tax Edit
                    </h3>
                    <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#tax-edit-modal">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                    </button>
                </div>
                    <div class="p-4 overflow-y-auto">
                        <form @submit.prevent="update" class="space-y-3">
                            <div class="form-group">
                                <label for="name" class="label">Name</label>
                                <input type="text" v-model="editForm.name" autofocus class="form-input" placeholder="Enter name" id="name">
                                <span v-if="editForm.errors.name" class="form-error" >{{ editForm.errors.name }}</span>
                            </div>

                            <div class="form-group">
                                <label for="percentage" class="label">Short Name</label>
                                <input type="text" v-model="editForm.percentage" autofocus class="form-input" placeholder="Enter short name" id="percentage">
                                <span v-if="editForm.errors.percentage" class="form-error" >{{ editForm.errors.percentage }}</span>
                            </div>


                            <div class="form-group">
                                <label for="status" class="label">Status</label>
                                <select class="form-input" v-model="editForm.status">
                                    <option value="1" >Active</option>
                                    <option value="0" >Inactive</option>
                                </select>
                            </div>


                            <div class="flex justify-end items-center w-full py-1">
                                <button class="px-3 h-[43px] bg-green-500 text-white rounded-md hover:bg-green-600 duration-200" >Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </MasterLayout>
</template>

<style scoped>

</style>
