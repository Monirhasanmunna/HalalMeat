<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    breadcrumb : Object
});
    
</script>

<template>
    <div class="py-[10px]">
            <div class="space-y-3">
                <div class="left-side space-y-2">
                    <h1 class="text-xl font-semibold text-[#4CC897]">{{ breadcrumb.title }}</h1>

                    <ol class="flex items-center whitespace-nowrap">
                    <li class="flex items-center">
                        <Link :href="route('dashboard')" class="flex bg-transparent items-center text-[13px] text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:text-gray-100 dark:hover:text-blue-500 dark:focus:text-blue-500">
                        <svg class="flex-shrink-0 me-1.5 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Home
                        </Link>
                        <svg v-if="breadcrumb.items" class="flex-shrink-0 mx-0.5 pt-[4px] overflow-visible size-4 text-gray-400 dark:text-gray-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </li>

                    <li v-for="(item, index) in breadcrumb.items" :key="index" class="flex items-center pb-0">
                        <Link :href="item.link" :class="{'text-green-600': item.active == true }" class="flex items-center text-[13px] text-gray-500 focus:outline-none focus:text-blue-600 dark:text-gray-100 dark:hover:text-blue-500 dark:focus:text-blue-500">
                        {{ item.name }}
                        <svg v-if="breadcrumb.items.length - 1 !== index" class="flex-shrink-0 mx-0.5 pt-[4px] overflow-visible size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                        </Link>
                    </li>
                </ol>
            </div>

        </div>
    </div>
    
</template>