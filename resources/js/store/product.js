import { reactive} from "vue"
import axios from "axios";
import { HSOverlay } from 'preline/preline';
import { useToast } from "@/service/toast_service";

const ProductStore = reactive({
    products : [],
    categories : [],
    brands : [],
    units : [],

    skeletonIsActive : true,
    isLoaderOn : false,

    productForm: {
        name : '',
        category_id : '',
        brand_id : '',
        unit_id : '',
        description : '',
        purchase_price : '',
        selling_price : '',
        image : ''
    },

    
    errors : [],

    showToast : useToast().showToast,

    itemList : async ()=>{
        ProductStore.skeletonIsActive = true;
        try {
           await axios.get(route('product.allProducts'))
            .then(res => {
                if(res.data.status == 200){
                    ProductStore.products = res.data.products
                    ProductStore.categories = res.data.categories
                    ProductStore.brands = res.data.brands
                    ProductStore.units = res.data.units

                    ProductStore.skeletonIsActive = false
                }
            });
        } catch (error) {
            ProductStore.showToast('Opps something went wrong', 'error')
        }
    },


    store : async () => {
        ProductStore.isLoaderOn = true;
        try {

            const formData = new FormData();

            for (const key in ProductStore.productForm) {
                formData.append(key, ProductStore.productForm[key]);
            }

            const response = await axios.post(route('product.store'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            
            if(response.data.status == 200){
                console.log('submites')
                ProductStore.products.unshift(response.data.product);
                HSOverlay.close('#product-create-modal')
                ProductStore.reset()
                ProductStore.showToast('Product Created', 'success')
            }else{
                HSOverlay.open('#product-create-modal')
            }
        } catch (error) {
            ProductStore.errors = error.response.data.errors;
        }

        ProductStore.isLoaderOn = false;
    },


    edit : async (id)=>{
        ProductStore.reset()
       try {
            const response = await axios.get(route('product.edit', {'id': id}));
            if(response.data.status == 200){
                ProductStore.productForm.id = response.data.product.id
                ProductStore.productForm.src = response.data.product.src
                ProductStore.productForm.name = response.data.product.name
                ProductStore.productForm.category_id = response.data.product.category_id
                ProductStore.productForm.brand_id = response.data.product.brand_id
                ProductStore.productForm.unit_id = response.data.product.unit_id
                ProductStore.productForm.description = response.data.product.description
                ProductStore.productForm.purchase_price = response.data.product.purchase_price
                ProductStore.productForm.selling_price = response.data.product.selling_price

                HSOverlay.open('#product-edit-modal')
            }
       } catch (error) {
            ProductStore.errors = error.response.data.errors;
       }
    },


    update : async ()=>{
        try {
            const formData = new FormData();

            for (const key in ProductStore.productForm) {
                formData.append(key, ProductStore.productForm[key]);
            }

            const response = await axios.post(route('product.update', {'id' : ProductStore.productForm.id}), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })

            if(response.data.status == 200){
                const findIndex =  ProductStore.products.findIndex(item => item.id === response.data.product.id);

                if(findIndex != -1){
                    ProductStore.products.splice(findIndex, 1, response.data.product);
                    ProductStore.showToast('Product Updated', 'success')
                }

                HSOverlay.close('#product-edit-modal')
                ProductStore.reset()
            }
        } catch (error) {
            ProductStore.errors = error.response.data.errors;
        }
    },


    destroy: async (id)=>{
        try {
            const response = await axios.delete(route('product.destroy', {'id' : id}))

            if(response.data.status == 200){
                const index = ProductStore.products.findIndex(item => item.id === id);
                if (index >= 0) {
                    ProductStore.products.splice(index, 1);
                    ProductStore.showToast('Brand Deleted', 'success')
                }
            }
            
        } catch (error) {
            console.error('Error delete product:', error);
        }
    },


    reset : ()=>{
        ProductStore.productForm.image = '',
        ProductStore.productForm.name = '',
        ProductStore.productForm.category_id = '',
        ProductStore.productForm.brand_id = '',
        ProductStore.productForm.unit_id = '',
        ProductStore.productForm.description = '',
        ProductStore.productForm.purchase_price = '',
        ProductStore.productForm.selling_price = '',
        ProductStore.errors = []
    }
    
});



export default ProductStore;