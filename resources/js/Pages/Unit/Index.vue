<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import BreadcrumbComponent from '@/Components/Backend/BreadcrumbComponent.vue';
import { onMounted, reactive} from 'vue';
import { Head } from '@inertiajs/vue3';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import UnitCreateModalComponent from '@/Components/Backend/Unit/UnitCreateModalComponent.vue';
import UnitStore from '@/store/unit';
import UnitEditModalComponent from '@/Components/Backend/Unit/UnitEditModalComponent.vue';
import TableSkeleton from '@/Components/Backend/TableSkeleton.vue';

const breadcrumb = {
    title : 'Unit List',

    items : [
        {
            name: 'Unit',
            link: '/product/unit',
            active: true
        }
    ]
}

onMounted(() => UnitStore.itemList())

const selectAndSearch = reactive({
    searchValue : "",
    searchField : "25"
});

const headers = [
  { text: "Name", value: "name" },
  { text: "Short Name", value: "short_name" },
  { text: "Status", value: "status" },
  { text: "Action", value: "action", width:100 }
]

</script>

<template>
    <Head title="Unit List" />
    <MasterLayout>
        <div class="w-full px-4 flex justify-between items-center bg-[#F9F9F9] dark:bg-[#151E32]">
            <BreadcrumbComponent :breadcrumb="breadcrumb" />

            <div class="wrapper flex item-center gap-4">
                <button @click="UnitStore.reset()" class="btn btn-primary text-[20px] p-1.5 rounded-lg bg-[#6FD943] text-white"  data-hs-overlay="#unit-create-modal">
                    <PlusIcon />
                </button>
            </div>
        </div>

        <div class="space-y-6 h-auto mt-3 card">
            <div class="w-full space-y-5 card-body" v-if="!UnitStore.skeletonIsActive">
                <div class="w-full flex justify-between items-center">
                        <div class="w-1/12">
                            <select class="table-select w-[100px] py-[5px] px-[10px] border-gray-400" v-model="selectAndSearch.searchField">
                                <option value="25" >25</option>
                                <option value="50" >50</option>
                                <option value="100" >100</option>
                            </select>
                        </div>

                        <div class="w-11/12 flex items-center justify-end">
                            <div class="relative max-w-xs">
                                <label for="hs-table-search" class="sr-only">Search</label>
                                <input type="text" v-model="selectAndSearch.searchValue" name="hs-table-search" id="hs-table-search" class="table-search w-[200px] py-[5px] px-[10px] border-gray-400" placeholder="Search for items">
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                            </div>
                        </div>
                    </div>
                </div>

                <DataTable 
                :headers="headers"
                :items="UnitStore.units"
                show-index
                alternating
                border-cell
                buttons-pagination
                :table-min-height=0
                table-class-name="customize-table"
                :search-field="selectAndSearch.searchField"
                :search-value="selectAndSearch.searchValue"
                >
                    <template #item-name="{name}">
                        <h2 class="capitalize">{{ name }}</h2>
                    </template>

                    <template #item-status="{status}">
                        <span v-if="status == 1" class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium border border-teal-500 text-teal-500">Active</span>
                        <span v-else class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium border border-red-500 text-red-500">Inactive</span>
                    </template>

                    <template #item-action="{id}">
                        <div class="flex gap-3 items-center">
                            <button @click="UnitStore.edit(id)" class="p-1.5 text-[14px] text-green-500 border border-green-500 rounded-md duration-200 hover:bg-[#6FD943] hover:text-white">
                                <EditIcon/>
                            </button>

                            <button @click="UnitStore.destroy(id)" class="p-1.5 text-[15px] text-red-500 border border-red-400 rounded-md duration-200 hover:bg-red-400 hover:text-white">
                                <DeleteIcon/>
                            </button>
                        </div>
                    </template>
                </DataTable>

                
            </div>

            <TableSkeleton v-else />

        </div>

        <UnitCreateModalComponent />

        <UnitEditModalComponent />

    </MasterLayout>
</template>

<style scoped>

</style>
