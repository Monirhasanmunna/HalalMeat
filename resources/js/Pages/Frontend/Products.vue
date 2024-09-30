<script setup>
import HeaderComponent from '@/Components/Frontend/HeaderComponent.vue';
import CategorySliderComponent from '@/Components/Frontend/CategorySliderComponent.vue';
import FooterSection from '@/Components/Frontend/FooterComponent.vue';
import { Head } from '@inertiajs/vue3';
</script>


<template>
    <Head title="Halal Meat | Products" />

    <div class="w-full">
        <!-- header section start -->
            <HeaderComponent />
        <!-- header section ends -->

        <main>
            <!-- category slide start -->
                <CategorySliderComponent/>
            <!-- category slide end -->

            <section class="products w-full overflow-hidden">
                <div class="container my-[40px] min-h-[400px] px-3 z-[1]">
                    <div class="row w-full">
                        <div class="title text-[30px] border-b border-gray-600 w-6/12 text-[#e8461d]/80 font-semibold">Mutton</div>
                    </div>

                    <div class="row w-full mt-6">
                        <div class="row w-8/12 ">
                            <div class="title text-[30px] bg-gradient-to-r text-white px-5 from-[#16592c] to-white font-semibold">Regular Cut</div>
                        </div>

                        <div class="row w-full mt-3">
                            <div class="row grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <div class="w-full h-[270px] border-[1px] border-[#175a27]/30" v-for="i in 5" :key="i">
                                    <div class="h-[180px]">
                                        <img class="h-full w-full bg-cover" src="/image/product/product-1.jpg" alt="" srcset="">
                                    </div>

                                    <div class="footer p-3 bg-white space-y-3">
                                        <div class="title">
                                            <h3 class="text-sm text-left font-semibold">Beef Bowels</h3>
                                        </div>
                                        <div class="row flex justify-between">
                                            <div class="weight">
                                                <span class="px-5 py-1 rounded-full bg-gray-500/10 text-[13px] font-semibold flex items-center justify-center">1Kg</span>
                                            </div>
                                            <div class="price">
                                                <span class="px-5 py-1 rounded-full bg-gray-500/10 text-[13px] flex items-center justify-center">ট <span class="pl-2 font-semibold">500</span></span>
                                            </div>
                                            <div class="addCart">
                                                <button class="px-3.5 py-1 rounded-full font-semibold bg-yellow-400 hover:bg-yellow-500 duration-150 cursor-pointer text-[13px] flex items-center justify-center">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row w-full mt-10">
                        <div class="row w-8/12 ">
                            <div class="title text-[30px] bg-gradient-to-r text-white px-5 from-[#16592c] to-white font-semibold">Special Cuts</div>
                        </div>

                        <div class="row w-full mt-3">
                            <div class="row grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <div class="w-full h-[270px] border-[1px] border-[#175a27]/30" v-for="i in 6" :key="i">
                                    <div class="h-[180px]">
                                        <img class="h-full w-full bg-cover" src="/image/product/product-2.jpg" alt="" srcset="">
                                    </div>

                                    <div class="footer p-3 bg-white space-y-3">
                                        <div class="title">
                                            <h3 class="text-sm text-left font-semibold">Beef Bowels</h3>
                                        </div>
                                        <div class="row flex justify-between">
                                            <div class="weight">
                                                <span class="px-5 py-1 rounded-full bg-gray-500/10 text-[13px] font-semibold flex items-center justify-center">1Kg</span>
                                            </div>
                                            <div class="price">
                                                <span class="px-5 py-1 rounded-full bg-gray-500/10 text-[13px] flex items-center justify-center">ট <span class="pl-2 font-semibold">500</span></span>
                                            </div>
                                            <div class="addCart">
                                                <button class="px-3.5 py-1 rounded-full font-semibold bg-yellow-400 hover:bg-yellow-500 duration-150 cursor-pointer text-[13px] flex items-center justify-center">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- foter section starts -->
             <FooterSection/>
            <!-- foter section ends -->
        </main>
    </div>
</template>