<script setup>
   const props = defineProps(['barcodeImg', 'barcode'])


</script>

<template>
   <div class="w-[105px] h-[40px] text-center">
      <img class="w-full h-full" :src="barcodeImg" alt="" srcset="">
      <span class="text-[11px]">{{ barcode }}</span>
   </div>
</template>