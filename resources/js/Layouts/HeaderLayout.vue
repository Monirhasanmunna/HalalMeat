<script setup>
    import BarsIcon from '@/Components/Icons/BarsIcon.vue';
    import UserActionButton from '@/Components/Header/UserActionButton.vue';
    import { ref } from 'vue';


    const isDarkMode = ref(false);

    localStorage.theme === 'dark' ? isDarkMode.value = true : isDarkMode.value = false;

    if(localStorage.theme || isDarkMode.value == true && (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)){
        localStorage.theme = 'dark'
        document.documentElement.classList.add('dark')
        isDarkMode.value == true;
    }else{
        localStorage.removeItem('theme');
        document.documentElement.classList.remove('dark')
        isDarkMode.value == false
    }



    const toggleTheme = () => {
        if(!localStorage.theme && isDarkMode.value == false){
            isDarkMode.value = true;
            localStorage.theme = 'dark'
            document.documentElement.classList.add('dark')
        }else{
            isDarkMode.value = false;
            localStorage.removeItem('theme');
            document.documentElement.classList.remove('dark')
        }
    }
</script>

<template>
    <div
        class="header sticky top-0 z-20 flex space-x-2 w-full h-[60px] border-b-[1px] border-gray-300 dark:border-gray-500 bg-[#FAFBFC] dark:bg-[#1F2940] text-slate-800 dark:text-slate-200">

        <div class="min-w-[251px] hidden md:block">
            <div class="sidebar-title px-2 py-4 border-r-[1px] border-gray-300  dark:border-gray-700">
                <h3 class="text-xl  text-center">Dashboard</h3>
            </div>
        </div>

        <div class="flex justify-between items-center w-full pr-5">
            <!-- left side content here -->
            <div class="" id="toggleButton">
                <BarsIcon id="barsIcon" class="text-2xl  duration-300 hover:scale-110" />
            </div>

            <!-- header right side content here -->
            <div class="flex gap-6 items-center ">
                <!-- <div class="relative inline-block pt-0.5">
                    <button @click="toggleTheme" class="w-9 h-9 rounded-full text-gray-500 dark:text-gray-100 p-2 duration-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg v-if="isDarkMode == false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full hover:scale-110">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>

                        <svg v-if="isDarkMode == true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full hover:scale-110">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>
                    </button>
                </div> -->
               <UserActionButton/> 
            </div>
            
        </div>
    </div>
</template>

<style scoped>
    #barsIcon.rotate {
        transform: rotate(180deg);
    }

</style>
