<script setup>
import { useForm } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, onMounted } from 'vue';

const emits = defineEmits(['create']);

const createForm = useForm({
    name : '',
    category_id : '',
    brand_id : '',
    unit_id : '',
    tax_id : '',
    description : '',
    purchase_price : '',
    selling_price : '',
    sku: '',
    images : []
});


const imageUrls = ref([]);

function fileInput(event){
    const files = event.target.files;
    imageUrls.value = []; //clear previous image

    for(let image of files){
        createForm.images.push(image)
    }

    Array.from(files).forEach((file) => {
        if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imageUrls.value.push(e.target.result);
        };
        reader.readAsDataURL(file);
        }
    });
}


function deleteImage(index){
    createForm.images.splice(index, 1);
    imageUrls.value.splice(index, 1);
}


const categories = ref([]);
const brands = ref([]);
const units = ref([]);
const taxes = ref([]);

function getAllData(){
    axios.get(route('product.getAllData')).then(response => {
        categories.value = response.data.categories;
        brands.value = response.data.brands;
        units.value = response.data.units;
        taxes.value = response.data.taxes;
    });
}


onMounted(() => getAllData());


function submit(){
    emits('create', createForm);
    imageUrls.value = [];
}

</script>

<template>
    <div id="product-create-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-3xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-6rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border border-[#6FD943] shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                <h3 class="font-semibold text-[#6FD943] dark:text-white">
                    Product Create
                </h3>
                <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#product-create-modal">
                <span class="sr-only">Close</span>
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
                </button>
            </div>
                <div class="p-4 py-8">
                    
                    <form class="space-y-8" @submit.prevent="submit">
                        <div class="row">
                            <div class="form-group">
                                <label for="name" class="label">Product Name</label>
                                <input type="text" v-model="createForm.name" autofocus class="form-input" placeholder="Enter name" id="name">
                                <span v-if="createForm.errors.name" class="form-error" >{{ createForm.errors.name }}</span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group h-auto">
                                <label for="image" class="label">Product Description</label>
                                <QuillEditor style="height: 150px;" theme="snow" contentType="text" v-model:content="createForm.description" />
                                <span v-if="createForm.errors.image" class="form-error" >{{ createForm.errors.image }}</span>
                            </div>
                        </div>
                        

                        <div class="row sm:flex gap-4 space-y-4 sm:space-y-0">
                            <div class="form-group w-full sm:w-6/12">
                                <label for="category" class="label">Category</label>
                                <select v-model="createForm.category_id" name="category_id" class="form-input text-gray-500" id="category">
                                    <option hidden value="">Select once</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>

                                </select>
                                <span v-if="createForm.errors.name" class="form-error" >{{ createForm.errors.name }}</span>
                            </div>

                            <div class="form-group w-full sm:w-6/12">
                                <label for="brand" class="label">Brand</label>
                                <select v-model="createForm.brand_id" name="brand_id" class="form-input text-gray-500" id="brand">
                                    <option hidden value="">Select once</option>
                                    <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>

                                </select>
                                <span v-if="createForm.errors.name" class="form-error" >{{ createForm.errors.name }}</span>
                            </div>
                        </div>


                        <div class="row sm:flex gap-4 space-y-4 sm:space-y-0">
                            <div class="form-group w-full sm:w-6/12">
                                <label  for="tax" class="label">Tax</label>
                                <select v-model="createForm.tax_id" name="tax_id" class="form-input text-gray-500" id="tax">
                                    <option hidden value="">Select once</option>
                                    <option v-for="tax in taxes" :key="tax.id" :value="tax.id">{{ tax.name }}</option>

                                </select>
                                <span v-if="createForm.errors.name" class="form-error" >{{ createForm.errors.name }}</span>
                            </div>

                            <div class="form-group w-full sm:w-6/12">
                                <label for="unit" class="label">Unit</label>
                                <select v-model="createForm.unit_id" name="unit_id" class="form-input text-gray-500" id="unit">
                                    <option hidden value="">Select once</option>
                                    <option v-for="unit in units" :key="unit.id" :value="unit.id">{{ unit.name }}</option>

                                </select>
                                <span v-if="createForm.errors.name" class="form-error" >{{ createForm.errors.name }}</span>
                            </div>
                        </div>

                        <div class="row w-full sm:flex gap-4 space-y-9 sm:space-y-0">
                            <div class="form-group w-full sm:w-6/12">
                                <label for="unit" class="label">Images</label>
                                <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input @input="fileInput" multiple  type="file" class="custom-file-upload block w-full text-sm text-gray-500
                                    file:me-4 file:py-2 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-600 file:text-white
                                    hover:file:bg-blue-700
                                    file:disabled:opacity-50 file:disabled:pointer-events-none
                                    dark:text-neutral-500
                                    dark:file:bg-blue-500
                                    dark:hover:file:bg-blue-400
                                ">
                                </label>
                                
                                <span v-if="createForm.errors.name" class="form-error" >{{ createForm.errors.name }}</span>
                            </div>

                            <div class="from-group w-full sm:w-6/12 flex flex-wrap gap-2" v-if="imageUrls.length > 0">
                                <div v-for="(imageUrl, index) in imageUrls" :key="index" class="w-[70px] h-[70px] border relative border-[#6FD943] rounded-lg">
                                    <img class="w-full h-full object-cover rounded-lg"  :src="imageUrl" alt="">
                                    <button @click="deleteImage(index)" class="w-[20px] h-[20px] bg-red-500 rounded-full text-white absolute top-[-1px] right-[-1px] flex justify-center items-center">x</button>
                                </div>
                            </div>
                        </div>


                        <div class="row w-full sm:flex gap-4 space-y-4 sm:space-y-0">
                            <div class="form-group w-full sm:w-6/12">
                                <label for="purchase_price" class="label">Purchase Price</label>
                                <input type="number" id="purchase_price" v-model="createForm.purchase_price" class="form-input" placeholder="Enter Purchase Price" >
                                <span v-if="createForm.errors.name" class="form-error" >{{ createForm.errors.name }}</span>
                            </div>

                            <div class="form-group w-full sm:w-6/12">
                                <label for="selling_price" class="label">Selling Price</label>
                                <input type="number" id="selling_price" v-model="createForm.selling_price" class="form-input" placeholder="Enter Selling Price" >
                                <span v-if="createForm.errors.selling_price" class="form-error" >{{ createForm.errors.selling_price }}</span>
                            </div>

                            <div class="form-group w-full sm:w-6/12">
                                <label for="sku" class="label">SKU</label>
                                <input type="text" id="sku" v-model="createForm.sku" class="form-input" placeholder="Enter SKU Code" >
                                <span v-if="createForm.errors.sku" class="form-error" >{{ createForm.errors.sku }}</span>
                            </div>
                        </div>


                        <div class="row py-3 mb-5">
                            <button class="px-3 py-2 float-end bg-green-500 text-white rounded-md hover:bg-green-600 duration-200" >Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.custom-file-upload input[type="file"] {
  display: none !important;
}
</style>