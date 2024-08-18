import { reactive} from "vue"
import axios from "axios";
import { HSOverlay } from 'preline/preline';
import { useToast } from "@/service/toast_service";

const BrandStore = reactive({
    brands : [],
    skeletonIsActive : true,
    isLoaderOn : false,

    brandForm: {
        image: '',
        name : ''
    },
    
    errors : [],

    showToast : useToast().showToast,

    itemList : ()=>{
        axios.get(route('product.brand.allBrand'))
        .then(res => {
            if(res.data.status == 200){
                BrandStore.brands = res.data.brands
                BrandStore.skeletonIsActive = false;
            }
        });
    },


    store : async () => {
        BrandStore.isLoaderOn = true;
        try {

            const formData = new FormData();

            for (const key in BrandStore.brandForm) {
                formData.append(key, BrandStore.brandForm[key]);
            }

            const response = await axios.post(route('product.brand.store'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            
            if(response.data.status == 200){
                console.log('submites')
                BrandStore.brands.unshift(response.data.brand);
                HSOverlay.close('#brand-create-modal')
                BrandStore.reset()
                BrandStore.showToast('Brand Created', 'success')
            }else{
                HSOverlay.open('#brand-create-modal')
            }
        } catch (error) {
            BrandStore.errors = error.response.data.errors;
        }

        BrandStore.isLoaderOn = false;
    },


    edit : async (id)=>{
        BrandStore.reset()
       try {
            const response = await axios.get(route('product.brand.edit', {'id': id}));
            if(response.data.status == 200){
                BrandStore.brandForm.id = response.data.brand.id
                BrandStore.brandForm.src = response.data.brand.src
                BrandStore.brandForm.name = response.data.brand.name
                BrandStore.brandForm.status = response.data.brand.status
                HSOverlay.open('#brand-edit-modal')
            }
       } catch (error) {
            BrandStore.errors = error.response.data.errors;
       }
    },


    update : async ()=>{
        try {
            const formData = new FormData();

            for (const key in BrandStore.brandForm) {
                formData.append(key, BrandStore.brandForm[key]);
            }

            const response = await axios.post(route('product.brand.update', {'id' : BrandStore.brandForm.id}), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })

            if(response.data.status == 200){
                const findIndex =  BrandStore.brands.findIndex(item => item.id === response.data.brand.id);

                if(findIndex != -1){
                    BrandStore.brands.splice(findIndex, 1, response.data.brand);
                    BrandStore.showToast('Brand Updated', 'success')
                }

                HSOverlay.close('#brand-edit-modal')
                BrandStore.reset()
            }
        } catch (error) {
            BrandStore.errors = error.response.data.errors;
        }
    },


    destroy: async (id)=>{
        try {
            const response = await axios.delete(route('product.brand.destroy', {'id' : id}))

            if(response.data.status == 200){
                const index = BrandStore.brands.findIndex(item => item.id === id);
                if (index >= 0) {
                    BrandStore.brands.splice(index, 1);
                    BrandStore.showToast('Brand Deleted', 'success')
                }
            }
            
        } catch (error) {
            console.error('Error delete brand:', error);
        }
    },


    reset : ()=>{
        BrandStore.brandForm.image = '',
        BrandStore.brandForm.name = '',
        BrandStore.errors = []
    }
    
});



export default BrandStore;