import axios from "axios";
import { useToast } from "@/service/toast_service";
import { ref, reactive } from "vue";
import { router } from '@inertiajs/vue3'
import NProgress from 'nprogress'

const AuthStore = reactive({
    
    credentials : reactive({
        email : '',
        password : '',
        remember : false
    }),

    errors : ref([]),

    showToast : useToast().showToast,

    login : async () => {
        AuthStore.loaderStart()
        try {
            const response = await axios.post(route('login'), AuthStore.credentials);
            console.log(response);
            if(response.data.status == 200){
                router.visit(route('dashboard'));
                AuthStore.showToast('Loginf Successfully', 'success')
            }
        } catch (error) {
            console.log(error);
            AuthStore.errors = error.response.data.errors;
        }

        AuthStore.loaderEnd()
    },


    logout : async () => {
        AuthStore.loaderStart()
        try {
            const response = await axios.post(route('logout'), AuthStore.credentials);
            console.log(response);
            if(response.data.status == 200){
                AuthStore.reset()
                router.visit(route('home'));
                AuthStore.showToast('Logout Successfully', 'success')
                
            }
        } catch (error) {
            AuthStore.showToast('Something is wrong', 'error')
        }

        AuthStore.loaderEnd()
    },


    loaderStart : ()=>{
        AuthStore.isLoaderOn = true;
        NProgress.start()
    },

    loaderEnd : ()=>{
        AuthStore.isLoaderOn = false;
        NProgress.done()
    },

    reset : () =>{
        AuthStore.credentials.email = '',
        AuthStore.credentials.password = '',
        AuthStore.credentials.remember = false,
        AuthStore.errors = ['']
    }
});



export default AuthStore;