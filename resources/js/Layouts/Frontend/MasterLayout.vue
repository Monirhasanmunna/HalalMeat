<script setup>
    import HeaderComponent from '@/Components/Frontend/HeaderComponent.vue';
    import FooterComponent from '@/Components/Frontend/FooterComponent.vue';
    import { onMounted } from 'vue';
    
    onMounted(() => {
        window.HSStaticMethods.autoInit();

    });

    defineProps({
        headerClass : {
            type : String,
            default : ''
        }
    })
</script>

<template>
    <div class="w-full">
        <HeaderComponent :class="headerClass" />
            <div class="" >
                <slot/>
            </div>
        <FooterComponent/>
    </div>
</template>