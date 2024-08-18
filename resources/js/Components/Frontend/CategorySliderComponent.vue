<script setup>

import ArrowIcon from '@/Components/Icons/Frontend/ArrowIcon.vue';

import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide } from 'vue3-carousel'
import { reactive, ref } from 'vue';

const myCarousel = ref(null)

const categories = [{
            image: '/image/category/image-1.png',
        },
        {
            image: '/image/category/image-2.png',
        },
        {
            image: '/image/category/image-3.png',
        },
        {
            image: '/image/category/image-4.png',
        },
        {
            image: '/image/category/image-5.png',
        },
        {
            image: '/image/category/image-6.png',
        },
        {
            image: '/image/category/image-7.png',
        },
    ];


    const settings = reactive({
        itemsToShow: 1,
        snapAlign: 'center',
    })


    const breakpoints = reactive({
        420: {
            itemsToShow: 2,
            snapAlign: 'start',
        },

        720: {
            itemsToShow: 3,
            snapAlign: 'start',
        },

        960: {
            itemsToShow: 4,
            snapAlign: 'start',
        },

        1200: {
            itemsToShow: 4,
            snapAlign: 'start',
        },

        1500: {
            itemsToShow: 5,
            snapAlign: 'start',
        },
    })

</script>

<template>
    <section class="category_slider w-full bg-[#c7c7c7]/20 relative overflow-hidden">
        <div class="w-[350px] h-[450px] leftBg absolute left-0 top-[-70px] opacity-[0.2] z-[-1]">
            <img class="w-full h-full bg-cover" src="/image/bg_overlay_left.png" alt="">
        </div>

        <div class="container my-[40px] p-3">
            <div class="row flex justify-end mb-2">
                <Link class="text-blue-600 text-[13px] cursor-pointer font-semibold">View all</Link>
            </div>
            <div class="w-full shadow-md" >
                <div
                    class="w-full bg-gradient-to-r from-[#16592c]/90 to-[#e9471f]/90 p-3 flex justify-between items-center">
                    <div class="title">
                        <h2 class="text-[20px] text-yellow-400 font-semibold">Category</h2>
                    </div>

                    <div class="pagination flex gap-4">
                        <button class="text-[25px] text-yellow-400 cursor-pointer" @click="myCarousel.prev()">
                            <ArrowIcon />
                        </button>

                        <button class="rotate-180 text-[25px] text-yellow-400 cursor-pointer" @click="myCarousel.next()">
                            <ArrowIcon />
                        </button>
                    </div>
                </div>

                <div class="w-full py-5 bg-white z-[2]">
                    <Carousel ref="myCarousel" autoplay="4000" :items-to-show="3" :wrap-around="true" v-bind="settings"
                        :breakpoints="breakpoints">
                        <Slide v-for="(category, index) in categories" :key="index">
                            <div
                                class="w-[200px] h-[150px] flex items-center justify-center border-[2px] border-[#175a27]/80 p-2 hover:bg-yellow-400 duration-150 hover:text-[#16592c] hover:border-yellow-400">
                                <img class="h-full w-full bg-cover" :src="category.image" alt="" srcset="">
                            </div>
                        </Slide>
                    </Carousel>
                </div>
            </div>
        </div>

        <div class="w-[350px] h-[450px] rightBg absolute right-0 top-[-70px] opacity-[0.2] z-[1]">
            <img class="w-full h-full bg-cover" src="/image/bg_overlay_right.png" alt="">
        </div>
    </section>
</template>