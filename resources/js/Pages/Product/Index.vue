<script setup>
import Box from '@/Components/Box.vue';
import MasterLayout from '@/Layouts/MasterLayout.vue';
import BreadcrumbComponent from '@/Components/Backend/BreadcrumbComponent.vue';
import {debounce} from 'lodash';
import { reactive, watch, ref } from 'vue';
import { router,Link, Head, useForm } from '@inertiajs/vue3';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import { HSOverlay } from 'preline/preline';
import axios from 'axios';
import ProductCreateModalComponent from '@/Components/Backend/Product/ProductCreateModalComponent.vue';
import ProductEditModalComponent from '@/Components/Backend/Product/ProductEditModalComponent.vue';
import BarcodeComponent from '@/Components/Backend/Product/BarcodeComponent.vue';


const props = defineProps({
    products : Object,
    filters: Array,
    categories : Array,
    brands : Array,
    units : Array,
    taxes : Array
});

console.log(props.products.data);

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


const selectAndSearch = reactive({
    count : props.filters.count ?? 20,
    search : props.filters.search ?? ''
});


watch(selectAndSearch, debounce(function() {
    router.get(route('product.index'), selectAndSearch, {
        preserveState: true,
        preserveScroll: true
    });

}, 200));


function fileInput(event, form){
    form.image = event.target.files[0];
}

function create(createForm){
    createForm.post(route('product.store'), {
        onSuccess: () => {
            createForm.reset()
            HSOverlay.close('#product-create-modal')
        }
    });
}


const editForm = useForm({
    name : '',
    image : '',
    src: '',
    id: '',
    status: '',
    _method: 'PUT'
});

const selectedProduct = ref({});

async function edit($id){
   await axios.get(route('product.edit', {'id': $id}))
    .then(res => {
        if(res.data){
            selectedProduct.value = res.data;
            HSOverlay.open('#product-edit-modal')
        }
    });
}

function update(editForm){
    editForm.post(route('product.update', {'id' : editForm.id}), {
        onSuccess: () => {
            editForm.reset()
            HSOverlay.close('#product-edit-modal')
        }
    });
}


function destroy($id){
    router.delete(route('product.destroy', {'id' : $id}),{
        preserveScroll:true,
    });
}

</script>

<template>
    <Head title="Category List" />
    <MasterLayout>
        <div class="w-full px-4 flex justify-between items-center bg-[#F9F9F9] dark:bg-[#151E32]">
            <BreadcrumbComponent :breadcrumb="breadcrumb" />


            <div class="wrapper flex item-center gap-4">
                <button class="btn btn-primary text-[20px] p-1.5 rounded-lg bg-[#6FD943] text-white"  data-hs-overlay="#product-create-modal">
                    <PlusIcon />
                </button>
            </div>
        </div>

        <div class="space-y-6 h-auto mt-3 card">
            <div class="w-full space-y-5 card-body">
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
                                            <th width="3%" class="table-th">SL</th>
                                            <th scope="col" class="table-th text-center">Image</th>
                                            <th scope="col" class="table-th text-center">Product Name</th>
                                            <th scope="col" class="table-th text-center">Category</th>
                                            <th scope="col" class="table-th text-center">Brand</th>
                                            <th scope="col" class="table-th text-center">Unit</th>
                                            <th scope="col" class="table-th text-center">Tax</th>
                                            <th scope="col" class="table-th text-center">Purchase Price</th>
                                            <th scope="col" class="table-th text-center">Selling Price</th>
                                            <th scope="col" class="table-th text-center">Quantity</th>
                                            <th scope="col" class="table-th text-center">Barcode</th>
                                            <th width="10%" class="table-th  text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        <tr v-for="(product, index) in products.data" :key="product.id" >
                                            <td class="table-td">{{ index+1 }}</td>
                                            <td class="table-td">
                                                <div v-if="product.images.length > 0" class="w-[50px] h-[50px] overflow-hidden rounded-xl border-2 border-[#6FD943]">
                                                    <img :src="product.images[0].src" class="w-full h-full object-cover" :alt="product.images[0].src" srcset="">
                                                </div>

                                                <div v-else class="w-[50px] h-[50px] rounded-xl border-2 border-[#6FD943] flex justify-center items-center text-[20px] text-gray-300">PT</div>
                                            </td>
                                            <td class="table-td text-center">{{ product.name }}</td>
                                            <td class="table-td text-center">{{ product.category.name }}</td>
                                            <td class="table-td text-center">{{ product.brand.name }}</td>
                                            <td class="table-td text-center">{{ product.unit.name }}</td>
                                            <td class="table-td text-center">{{ product.tax.name }}</td>
                                            <td class="table-td text-center">{{ '$'+ product.details.purchase_price }}</td>
                                            <td class="table-td text-center">{{ '$'+ product.details.selling_price }}</td>
                                            <td class="table-td text-center">
                                                <span v-if="product.details.quantity != 0" class="inline-flex items-center gap-x-1 py-1.5 px-2.5 cursor-pointer rounded-full text-[16px] font-medium border border-[#6FD943] text-[#6FD943] duration-200 hover:bg-[#6FD943] hover:text-white">{{ product.details.quantity }}</span>
                                                <span v-else class="inline-flex items-center gap-x-1 py-1.5 px-2.5 cursor-pointer rounded-full text-[16px] font-medium border border-red-500 text-red-500 duration-200 hover:bg-red-500 hover:text-white">{{ product.details.quantity }}</span>
                                            </td>
                                            <td class="table-td text-end">
                                                <BarcodeComponent :barcodeImg="product.barcodeImg" :barcode="product.barcode" />
                                            </td>
                                            <td class="table-td flex gap-4 justify-center items-center h-[90px]">
                                                <button @click="edit(product.id)" class="px-2 py-1.5 text-[17px] text-green-500 border border-green-500 rounded-md duration-200 hover:bg-[#6FD943] hover:text-white">
                                                    <EditIcon/>
                                                </button>

                                                <button @click="destroy(product.id)" class="px-2 py-1.5 text-[17px] text-red-500 border border-red-400 rounded-md duration-200 hover:bg-red-400 hover:text-white">
                                                    <DeleteIcon/>
                                                </button>
                                            </td>
                                        </tr>

                                        <tr v-if="products.data.length == 0">
                                            <th colspan="12" class="text-center p-3 text-gray-400 font-semibold">No data found</th>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="py-1 flex justify-end mt-2" v-if="products.data.length > 0">
                                <nav class="flex items-center space-x-1">
                                    <Link v-for="(link, index) in products.links" :key="index" :href="link.url" v-html="link.label" :class="{'bg-[#6FD943] font-semibold text-white' : link.active}" type="button" class="table-paginate"></Link>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ProductCreateModalComponent @create="create" :categories="categories" :brands="brands" :units="units" :taxes="taxes" />

        <ProductEditModalComponent @update="update" :selectedProduct="selectedProduct" />

    </MasterLayout>
</template>

<style scoped>

</style>
