import { reactive, ref } from "vue"
import axios from "axios";
import { HSOverlay } from 'preline/preline';
import { useToast } from "@/service/toast_service";

const UnitStore = reactive({
    units : [],
    skeletonIsActive : true,
    isLoaderOn : false,

    unitForm: {
        name : '',
        short_name : ''
    },
    
    errors : [],

    showToast : useToast().showToast,

    itemList : ()=>{
        axios.get(route('product.unit.allUnits'))
        .then(res => {
            if(res.data.status == 200){
                UnitStore.units = res.data.units
                UnitStore.skeletonIsActive = false;
            }
        });
    },


    store : async () => {
        UnitStore.isLoaderOn = true;
        try {
            const response = await axios.post(route('product.unit.store', UnitStore.unitForm))
            
            if(response.data.status == 200){
                console.log('submites')
                UnitStore.units.unshift(response.data.unit);
                HSOverlay.close('#unit-create-modal')
                UnitStore.reset()
                UnitStore.showToast('Unit Created', 'success')
            }else{
                HSOverlay.open('#unit-create-modal')
            }
        } catch (error) {
            UnitStore.errors = error.response.data.errors;
        }

        UnitStore.isLoaderOn = false;
    },


    edit : async (id)=>{
        UnitStore.reset()
       try {
            const response = await axios.get(route('product.unit.edit', {'id': id}));
            if(response.data.status == 200){
                UnitStore.unitForm.id = response.data.unit.id
                UnitStore.unitForm.name = response.data.unit.name
                UnitStore.unitForm.short_name = response.data.unit.short_name
                UnitStore.unitForm.status = response.data.unit.status
                HSOverlay.open('#unit-edit-modal')
            }
       } catch (error) {
            UnitStore.errors = error.response.data.errors;
       }
    },


    update : async ()=>{
        try {
            const response = await axios.put(route('product.unit.update', {'id' : UnitStore.unitForm.id}), UnitStore.unitForm)

            if(response.data.status == 200){
                const findIndex =  UnitStore.units.findIndex(item => item.id === response.data.unit.id);

                if(findIndex != -1){
                    UnitStore.units.splice(findIndex, 1, response.data.unit);
                }

                HSOverlay.close('#unit-edit-modal')
                UnitStore.reset()
                UnitStore.showToast('Unit Updated', 'success')
            }
        } catch (error) {
            UnitStore.errors = error.response.data.errors;
        }
    },


    destroy: async (id)=>{
        try {
            const response = await axios.delete(route('product.unit.destroy', {'id' : id}))

            if(response.data.status == 200){
                const index = UnitStore.units.findIndex(item => item.id === id);
                if (index >= 0) {
                    UnitStore.units.splice(index, 1);
                    UnitStore.showToast('Unit Deleted', 'success')
                }
            }
            
        } catch (error) {
            console.error('Error delete unit:', error);
        }
    },


    reset : ()=>{
        UnitStore.unitForm.name = '',
        UnitStore.unitForm.short_name = ''
        UnitStore.errors = []
    }
    
});



export default UnitStore;