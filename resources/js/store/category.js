import { reactive} from "vue"
import axios from "axios";
import { HSOverlay } from 'preline/preline';
import { useToast } from "@/service/toast_service";

const CategoryStore = reactive({
    categories : [],
    skeletonIsActive : true,
    isLoaderOn : false,

    categoryForm: {
        image: '',
        name : ''
    },
    
    errors : [],

    showToast : useToast().showToast,

    itemList : ()=>{
        try {
            CategoryStore.skeletonIsActive = true;
            axios.get(route('product.category.allCategory'))
            .then(res => {
                if(res.data.status == 200){
                    CategoryStore.categories = res.data.categories
                    CategoryStore.skeletonIsActive = false;
                }
            });
        } catch (error) {
            CategoryStore.showToast('Opps something went wrong', 'error')
        }
    },


    store : async () => {
        CategoryStore.isLoaderOn = true;
        try {

            const formData = new FormData();

            for (const key in CategoryStore.categoryForm) {
                formData.append(key, CategoryStore.categoryForm[key]);
            }

            const response = await axios.post(route('product.category.store'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            
            if(response.data.status == 200){
                console.log('submites')
                CategoryStore.categories.unshift(response.data.category);
                HSOverlay.close('#category-create-modal')
                CategoryStore.reset()
                CategoryStore.showToast('Category Created', 'success')
            }else{
                HSOverlay.open('#category-create-modal')
            }
        } catch (error) {
            CategoryStore.errors = error.response.data.errors;
        }

        CategoryStore.isLoaderOn = false;
    },


    edit : async (id)=>{
        CategoryStore.reset()
       try {
            const response = await axios.get(route('product.category.edit', {'id': id}));
            if(response.data.status == 200){
                CategoryStore.categoryForm.id = response.data.category.id
                CategoryStore.categoryForm.src = response.data.category.src
                CategoryStore.categoryForm.name = response.data.category.name
                CategoryStore.categoryForm.image = response.data.category.image
                CategoryStore.categoryForm.status = response.data.category.status
                HSOverlay.open('#category-edit-modal')
            }
       } catch (error) {
            CategoryStore.errors = error.response.data.errors;
       }
    },


    update : async ()=>{
        CategoryStore.isLoaderOn = true;
        try {
            const formData = new FormData();

            for (const key in CategoryStore.categoryForm) {
                formData.append(key, CategoryStore.categoryForm[key]);
            }

            const response = await axios.post(route('product.category.update', {'id' : CategoryStore.categoryForm.id}), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })

            if(response.data.status == 200){
                const findIndex =  CategoryStore.categories.findIndex(item => item.id === response.data.category.id);

                if(findIndex != -1){
                    CategoryStore.categories.splice(findIndex, 1, response.data.category);
                    CategoryStore.showToast('Category Updated', 'success')
                }

                HSOverlay.close('#category-edit-modal')
                CategoryStore.reset()
            }
        } catch (error) {
            CategoryStore.errors = error.response.data.errors;
        }

        CategoryStore.isLoaderOn = false;
    },


    destroy: async (id)=>{
        try {
            const response = await axios.delete(route('product.category.destroy', {'id' : id}))

            if(response.data.status == 200){
                const index = CategoryStore.categories.findIndex(item => item.id === id);
                if (index >= 0) {
                    CategoryStore.categories.splice(index, 1);
                    CategoryStore.showToast('Category Deleted', 'success')
                }
            }
            
        } catch (error) {
            console.error('Error delete category:', error);
        }
    },


    reset : ()=>{
        CategoryStore.categoryForm.image = '',
        CategoryStore.categoryForm.name = '',
        CategoryStore.errors = []
    }
    
});



export default CategoryStore;