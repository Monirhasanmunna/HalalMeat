<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import BreadcrumbComponent from '@/Components/Backend/BreadcrumbComponent.vue';
import { ref, onMounted } from 'vue';
import {Head } from '@inertiajs/vue3';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import ProductCreateModalComponent from '@/Components/Backend/Product/ProductCreateModalComponent.vue';
import ProductEditModalComponent from '@/Components/Backend/Product/ProductEditModalComponent.vue';
import ProductStore from '@/store/product';
import TableSkeleton from '@/Components/Backend/TableSkeleton.vue';


    const breadcrumb = {
        title : 'Product List',

        items : [
            {
                name: 'Product',
                link: '/product',
                active: true
            }
        ]
    }

    onMounted(() => ProductStore.itemList())

    const headers = [
        { text: "Image", value: "image", width:200 },
        { text: "Product Name", value: "name" },
        { text: "Category", value: "category" },
        { text: "Brand", value: "brand" },
        { text: "Unit", value: "unit" },
        { text: "Purchase Price", value: "purchase_price" },
        { text: "Selling Price", value: "selling_price" },
        { text: "Quantity", value: "quantity" },
        { text: "Action", value: "action", width:100 }
    ]

    const searchValue = ref("");
    const selectField = ref("20");

</script>

<template>
    <Head title="Category List" />
    <MasterLayout>
        <div class="w-full px-4 flex justify-between items-center bg-[#F9F9F9] dark:bg-[#151E32]">
            <BreadcrumbComponent :breadcrumb="breadcrumb" />


            <div class="wrapper flex item-center gap-4">
                <button @click="ProductStore.reset()" class="btn btn-primary text-[20px] p-1.5 rounded-lg bg-[#6FD943] text-white"  data-hs-overlay="#product-create-modal">
                    <PlusIcon />
                </button>
            </div>
        </div>


        <div class="space-y-6 h-auto mt-3 card">
            <div class="w-full space-y-5 card-body" v-if="!ProductStore.skeletonIsActive">
                <div class="w-full flex justify-between items-center">
                    <div class="w-1/12">
                        <select class="table-select" v-model="selectField">
                            <option value="10" >10</option>
                             <option value="20" >20</option>
                            <option value="50" >50</option>
                            <option value="100" >100</option>
                        </select>
                    </div>

                    <div class="w-11/12 flex items-center justify-end">
                        <div class="relative max-w-xs">
                            <label for="hs-table-search" class="sr-only">Search</label>
                            <input type="text" v-model="searchValue" name="hs-table-search" id="hs-table-search" class="table-search" placeholder="Search for items">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- {{ ProductStore.products }} -->

                <div class="flex  flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700 dark:shadow-gray-900">
                                <DataTable 
                                :headers="headers"
                                :items="ProductStore.products"
                                show-index
                                alternating
                                border-cell
                                buttons-pagination
                                :table-min-height=0
                                table-class-name="customize-table"
                                :search-field="selectField"
                                :search-value="searchValue"
                                >
                                    <template #item-image="{src}">
                                        <div v-if="src" class="w-[45px] h-[45px] overflow-hidden rounded-xl border-2 border-[#6FD943]">
                                            <img :src="src" class="w-full h-full object-cover" :alt="src" srcset="">
                                        </div>

                                        <div v-else class="w-[45px] h-[45px] rounded-xl border-2 border-[#6FD943] flex justify-center items-center text-[20px] text-gray-300">BR</div>
                                    </template>

                                    <template #item-name="{name}">
                                        <h2 class="capitalize">{{ name }}</h2>
                                    </template>

                                    <template #item-category="{category}">
                                        <h2 class="capitalize">{{ category.name }}</h2>
                                    </template>

                                    <template #item-brand="{brand}">
                                        <h2 class="capitalize">{{ brand.name }}</h2>
                                    </template>

                                    <template #item-unit="{unit}">
                                        <span class="capitalize">{{ unit.name }}</span>
                                    </template>

                                    <template #item-purchase_price="{purchase_price}">
                                        <span class="text-[15px]">{{ purchase_price }}</span>
                                    </template>

                                    <template #item-selling_price="{selling_price}">
                                        <span class="text-[15px]">{{ selling_price }}</span>
                                    </template>

                                    <template #item-quantity="{quantity}">
                                        <span class="text-[15px]">{{ quantity }}</span>
                                    </template>

                                    <template #item-action="{id}">
                                        <div class="flex gap-3 items-center">
                                            <button @click="ProductStore.edit(id)" class="p-1.5 text-[14px] text-green-500 border border-green-500 rounded-md duration-200 hover:bg-[#6FD943] hover:text-white">
                                                <EditIcon/>
                                            </button>

                                            <button @click="ProductStore.destroy(id)" class="p-1.5 text-[15px] text-red-500 border border-red-400 rounded-md duration-200 hover:bg-red-400 hover:text-white">
                                                <DeleteIcon/>
                                            </button>
                                        </div>
                                    </template>
                                </DataTable>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <TableSkeleton v-else />
        </div>

        <ProductCreateModalComponent />

        <ProductEditModalComponent />

    </MasterLayout>
</template>

<style scoped>
.customize-table{
    --easy-table-body-row-height: 60px;
}
</style>
