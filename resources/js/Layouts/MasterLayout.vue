<script setup>
import HeaderLayout from '@/Layouts/HeaderLayout.vue';
import SidebarLayout from '@/Layouts/SidebarLayout.vue'
import customJs from '@/assets/custom.js';
import {onMounted} from 'vue';


onMounted(() => {
    window.HSStaticMethods.autoInit();
    customJs();
});
</script>

<template>
<div class="main-wrapper">
    <HeaderLayout/>    
    <div class="body flex justify-start">
        <SidebarLayout/>  
        <div class="right w-full">
            <main >
                <div class="w-full min-h-[900px] bg-[#F1F4F6] dark:bg-[#141B2D] px-[20px] py-[26px]">
                    <div id="bodyCard" class=" h-screen md:ml-[250px] rounded-md">
                        <slot></slot>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
</template>

<style scoped>
.sidebar {
    transition: min-width 0.3s; /* Optional: Add a smooth transition effect */
  }

  #bodyCard {
    transition: margin-left 0.3s; /* Optional: Add a smooth transition effect */
  }
</style>