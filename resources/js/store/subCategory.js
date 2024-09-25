import { reactive} from "vue"
import axios from "axios";
import { HSOverlay } from 'preline/preline';
import { useToast } from "@/service/toast_service";

const SubCategoryStore = reactive({
    subCategories : [],
    categories: [],
    skeletonIsActive : true,
    isLoaderOn : false,

    subCategoryForm: {
        category: '',
        name : ''
    },
    
    errors : [],

    showToast : useToast().showToast,

    itemList : ()=>{
        try {
            SubCategoryStore.skeletonIsActive = true;
            axios.get(route('product.subCategory.allSubCategory'))
            .then(res => {
                if(res.data.status == 200){
                    SubCategoryStore.subCategories = res.data.subCategories
                    SubCategoryStore.skeletonIsActive = false;
                }
            });
        } catch (error) {
            SubCategoryStore.showToast('Opps something went wrong', 'error')
        }
    },


    getCategories : ()=>{
        axios.get(route('product.subCategory.getCategories'))
        .then(res => {
            if(res.data.status == 200){
                SubCategoryStore.categories = res.data.categories
            }
        });
    },


    store : async () => {
        SubCategoryStore.isLoaderOn = true;
        try {
            const response = await axios.post(route('product.subCategory.store'), SubCategoryStore.subCategoryForm);
            
            if(response.data.status == 200){
                SubCategoryStore.subCategories.unshift(response.data.subCategory);
                HSOverlay.close('#sub-category-create-modal')
                SubCategoryStore.reset()
                SubCategoryStore.showToast('Sub Category Created', 'success')
            }else{
                HSOverlay.open('#sub-category-create-modal')
            }
        } catch (error) {
            SubCategoryStore.errors = error.response.data.errors;
        }

        SubCategoryStore.isLoaderOn = false;
    },


    edit : async (id)=>{
        SubCategoryStore.reset()
       try {
            const response = await axios.get(route('product.subCategory.edit', {'id': id}));
            if(response.data.status == 200){
                SubCategoryStore.subCategoryForm.id = response.data.subCategory.id
                SubCategoryStore.subCategoryForm.category = response.data.subCategory.category_id
                SubCategoryStore.subCategoryForm.name = response.data.subCategory.name
                HSOverlay.open('#sub-category-edit-modal')
            }
       } catch (error) {
            SubCategoryStore.errors = error.response.data.errors;
       }
    },


    update : async ()=>{
        SubCategoryStore.isLoaderOn = true;
        try {
            const response = await axios.post(route('product.subCategory.update', {'id' : SubCategoryStore.subCategoryForm.id}), SubCategoryStore.subCategoryForm)
            console.log(response);
            if(response.data.status == 200){
                const findIndex =  SubCategoryStore.subCategories.findIndex(item => item.id === response.data.subCategory.id);
                
                if(findIndex != -1){
                    
                    SubCategoryStore.subCategories.splice(findIndex, 1, response.data.subCategory);
                    SubCategoryStore.showToast('Sub Category Updated', 'success')
                }

                HSOverlay.close('#sub-category-edit-modal')
                SubCategoryStore.reset()
            }
        } catch (error) {
            SubCategoryStore.errors = error.response.data.errors;
        }

        SubCategoryStore.isLoaderOn = false;
    },


    destroy: async (id)=>{
        try {
            const response = await axios.delete(route('product.subCategory.destroy', {'id' : id}))

            if(response.data.status == 200){
                const index = SubCategoryStore.subCategories.findIndex(item => item.id === id);
                if (index >= 0) {
                    SubCategoryStore.subCategories.splice(index, 1);
                    SubCategoryStore.showToast('Sub Category Deleted', 'success')
                }
            }
            
        } catch (error) {
            console.error('Error delete sub category:', error);
        }
    },


    reset : ()=>{
        SubCategoryStore.subCategoryForm.image = '',
        SubCategoryStore.subCategoryForm.name = '',
        SubCategoryStore.errors = []
    }
    
});



export default SubCategoryStore;