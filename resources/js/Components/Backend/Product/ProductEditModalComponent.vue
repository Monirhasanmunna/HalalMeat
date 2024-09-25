<script setup>
import { ClassicEditor, Bold, Essentials, Italic, Mention, Paragraph, Undo, Font, Link } from 'ckeditor5';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';

import 'ckeditor5/ckeditor5.css';

import { ref, watch } from 'vue';
import ProductStore from '@/store/product';
import { computed } from 'vue';


const imageUrl = ref('');

const editor = ClassicEditor;
const editorConfig = {
        plugins: [ Bold, Essentials, Italic, Mention, Paragraph, Undo, Font, Link ],
        toolbar: [ 'undo', 'redo', '|', 'bold', 'italic','link', '|', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'],
        licenseKey: '<YOUR_LICENSE_KEY>',
    }

function fileInput(event){
    const file = event.target.files[0];
    ProductStore.productForm.image = file;

    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imageUrl.value = (e.target.result);
        };
        reader.readAsDataURL(file);
    } 
}


watch(()=> ProductStore.productForm.src, ()=>{
    imageUrl.value = ProductStore.productForm.src
})

function deleteImage(index){
    ProductStore.productForm.image = '';
    imageUrl.value = '';
}


function submit(){
    ProductStore.update();
}

</script>

<template>
    <div id="product-edit-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-3xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-6rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border border-[#6FD943] shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                <h3 class="font-semibold text-[#6FD943] dark:text-white">
                    Product Edit
                </h3>
                <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#product-edit-modal">
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
                                <input type="text" v-model="ProductStore.productForm.name" autofocus class="form-input" placeholder="Enter name" id="name">
                                <span v-if="ProductStore.errors.name" class="form-error" >{{ ProductStore.errors.name[0] }}</span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group h-auto">
                                <label for="description" class="label">Product Description</label>
                                <Ckeditor
                                    v-model="ProductStore.productForm.description"
                                    :editor="editor"
                                    :config="editorConfig"
                                    class="ck-editor__editable"
                                />
                                <span v-if="ProductStore.errors.description" class="form-error" >{{ ProductStore.errors.description[0] }}</span>
                            </div>
                        </div>
                        

                        <div class="row sm:flex gap-4 space-y-4 sm:space-y-0">
                            <div class="form-group w-full sm:w-4/12">
                                <label for="category" class="label">Category</label>
                                <select v-model="ProductStore.productForm.category_id" name="category_id" class="form-input text-gray-500" id="category">
                                    <option hidden value="">Select once</option>
                                    <option v-for="category in ProductStore.categories" :key="category.id" :value="category.id">{{ category.name }}</option>

                                </select>
                                <span v-if="ProductStore.errors.category_id" class="form-error" >{{ ProductStore.errors.category_id[0] }}</span>
                            </div>

                            <div class="form-group w-full sm:w-4/12">
                                <label for="brand" class="label">Brand</label>
                                <select v-model="ProductStore.productForm.brand_id" name="brand_id" class="form-input text-gray-500" id="brand">
                                    <option hidden value="">Select once</option>
                                    <option v-for="brand in ProductStore.brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>

                                </select>
                                <span v-if="ProductStore.errors.brand_id" class="form-error" >{{ ProductStore.errors.brand_id[0] }}</span>
                            </div>

                            <div class="form-group w-full sm:w-4/12">
                                <label for="unit" class="label">Unit</label>
                                <select v-model="ProductStore.productForm.unit_id" name="unit_id" class="form-input text-gray-500" id="unit">
                                    <option hidden value="">Select once</option>
                                    <option v-for="unit in ProductStore.units" :key="unit.id" :value="unit.id">{{ unit.name }}</option>

                                </select>
                                <span v-if="ProductStore.errors.unit_id" class="form-error" >{{ ProductStore.errors.unit_id[0] }}</span>
                            </div>
                        </div>


                        <div class="row sm:flex gap-4 space-y-4 sm:space-y-0">
                            <div class="form-group w-full sm:w-6/12">
                                <label for="purchase_price" class="label">Purchase Price</label>
                                <input type="number" id="purchase_price" v-model="ProductStore.productForm.purchase_price" class="form-input" placeholder="Enter Purchase Price" >
                                <span v-if="ProductStore.errors.purchase_price" class="form-error" >{{ ProductStore.errors.purchase_price[0] }}</span>
                            </div>

                            <div class="form-group w-full sm:w-6/12">
                                <label for="selling_price" class="label">Selling Price</label>
                                <input type="number" id="selling_price" v-model="ProductStore.productForm.selling_price" class="form-input" placeholder="Enter Selling Price" >
                                <span v-if="ProductStore.errors.selling_price" class="form-error" >{{ ProductStore.errors.selling_price[0] }}</span>
                            </div>
                        </div>

                        <div class="row w-full sm:flex gap-4 space-y-9 sm:space-y-0">
                            <div class="form-group w-full sm:w-6/12">
                                <label for="unit" class="label">Images</label>
                                <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input @change="fileInput"  type="file" class="custom-file-upload block w-full text-sm text-gray-500
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
                                
                                <span v-if="ProductStore.errors.image" class="form-error" >{{ ProductStore.errors.image[0] }}</span>
                            </div>

                            <div class="from-group w-full sm:w-6/12 flex flex-wrap gap-2" v-if="imageUrl">
                                <div class="w-[70px] h-[70px] border border-[#6FD943] rounded-lg">
                                    <img class="w-full h-full object-cover rounded-lg"  :src="imageUrl" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group py-2">
                            <button v-if="!ProductStore.isLoaderOn" type="submit" class="px-3 py-2 float-end bg-green-500 text-white rounded-md hover:bg-green-600 duration-200">Add New</button>

                            <button v-else type="submit"
                                    class="px-3 py-2 text-white hover:bg-green-600 duration-200 flex justify-center items-center w-[90px] bg-[#3AC18C] rounded-md float-end hover:text-white">
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

<style>
.ck-editor__editable_inline {
    min-height: 150px;
}
</style>