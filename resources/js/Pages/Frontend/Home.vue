<script setup>
    import ArrowIcon from '@/Components/Icons/Frontend/ArrowIcon.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { reactive, ref } from 'vue'

    import 'vue3-carousel/dist/carousel.css'
    import { Carousel, Slide} from 'vue3-carousel'
    
    import HeaderComponent from '@/Components/Frontend/HeaderComponent.vue';
    import CategorySliderComponent from '@/Components/Frontend/CategorySliderComponent.vue';
    import FooterSection from '@/Components/Frontend/FooterSection.vue';

    const myCarousel = ref(null)

    const products = [{
            image: '/image/product/product-1.jpg',
        },
        {
            image: '/image/product/product-2.jpg',
        },
        {
            image: '/image/product/product-3.jpg',
        },
        {
            image: '/image/product/product-4.jpg',
        },
        {
            image: '/image/product/product-5.jpg',
        },
        {
            image: '/image/product/product-6.jpg',
        },
        {
            image: '/image/product/product-7.jpg',
        },
    ];


    const Productbreakpoints = reactive({

        720: {
            itemsToShow: 2,
            snapAlign: 'start',
        },

        960: {
            itemsToShow: 2.5,
            snapAlign: 'start',
        },

        1200: {
            itemsToShow: 3,
            snapAlign: 'start',
        },
    })

</script>

<template>

    <Head title="Halal Meat" />

    <div class="w-full">
        <!-- header section start -->
        <HeaderComponent class="fixed" />
        <!-- header section ends -->
        <main>
            <section class="main_section_banner w-full h-[450px] bg-no-repeat bg-cover"
                style="background-image: url('/image/main_cover.png')">
                <div class="main-content container p-3">
                    <div class="w-full mt-[140px]">
                        <h2 class="text-[35px] sm:text-[40px] text-yellow-500 text-shadow uppercase">Rangpur's</h2>
                        <h3 class="text-[25px] sm:text-[30px] text-yellow-500 text-shadow">First & Only</h3>
                        <h3 class=" text-[30px] sm:text-[35px] text-gray-50 text-shadow">International Standard Abattoir
                        </h3>
                        <button
                            class="bg-yellow-400 px-3 py-1.5 rounded-md capitalize font-semibold text-[#000000] mt-4">Start
                            Shopping Now</button>
                    </div>
                </div>
            </section>

            <!-- category slide start -->
             <CategorySliderComponent/>
            <!-- category slide end -->

            <section class="to_saller_slider w-full relative overflow-hidden">
                <div class="w-full h-[150px] bg-[#e9471f]/80 absolute top-[37%] z-[-1]"></div>

                <div class="container my-[40px] p-3 z-[1]">
                    <div class="row flex justify-end mb-2">
                        <Link class="text-blue-600 text-[13px] cursor-pointer font-semibold">View all</Link>
                    </div>
                    <div class="w-full shadow-md">
                        <div
                            class="w-full bg-gradient-to-r from-[#16592c]/90 to-[#e9471f]/90 p-3 flex justify-between items-center">
                            <div class="title">
                                <h2 class="text-[20px] text-yellow-400 font-semibold">Top Saller</h2>
                            </div>

                            <div class="pagination flex gap-4">
                                <button class="text-[25px] text-yellow-400" @click="myCarousel.prev()">
                                    <ArrowIcon />
                                </button>

                                <button class="rotate-180 text-[25px] text-yellow-400" @click="myCarousel.next()">
                                    <ArrowIcon />
                                </button>
                            </div>
                        </div>

                        <div class="w-full py-5 bg-white">
                            <Carousel ref="myCarousel" autoplay="4000" :items-to-show="3" :wrap-around="true"
                                v-bind="settings" :breakpoints="Productbreakpoints">
                                <Slide v-for="(product, index) in products" :key="index">
                                    <div class="w-[320px] h-[270px] border-[1px] border-[#175a27]/80">
                                        <div class="h-[180px]">
                                            <img class="h-full w-full bg-cover" :src="product.image" alt="" srcset="">
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
                                </Slide>
                            </Carousel>
                        </div>
                    </div>
                </div>

            </section>

            <section class="product_slider w-full bg-[#F4F6F9]  relative overflow-hidden z-[-2]">
                <div class="w-[350px] h-[400px] leftBg absolute left-0 top-[-10px] opacity-[0.2] z-[-1]">
                    <img class="w-full h-full bg-cover" src="/image/bg_overlay_left.png" alt="">
                </div>

                <div class="container my-[40px] p-3 z-[1]">
                    <div class="row flex justify-end mb-2">
                        <Link class="text-blue-600 text-[13px] cursor-pointer font-semibold">View all</Link>
                    </div>
                    <div class="w-full shadow-md">
                        <div
                            class="w-full bg-gradient-to-r from-[#16592c]/90 to-[#e9471f]/90 p-3 flex justify-between items-center">
                            <div class="title">
                                <h2 class="text-[20px] text-yellow-400 font-semibold">Products</h2>
                            </div>

                            <div class="pagination flex gap-4">
                                <button class="text-[25px] text-yellow-400" @click="myCarousel.prev()">
                                    <ArrowIcon />
                                </button>

                                <button class="rotate-180 text-[25px] text-yellow-400" @click="myCarousel.next()">
                                    <ArrowIcon />
                                </button>
                            </div>
                        </div>

                        <div class="w-full py-5 bg-white">
                            <Carousel ref="myCarousel" autoplay="4000" :items-to-show="3" :wrap-around="true"
                                v-bind="settings" :breakpoints="Productbreakpoints">
                                <Slide v-for="(product, index) in products" :key="index">
                                    <div class="w-[320px] h-[270px] border-[1px] border-[#175a27]/80 hover:bg-yellow-400 duration-150 hover:text-[#16592c] hover:border-yellow-400">
                                        <div class="h-[180px]">
                                            <img class="h-full w-full bg-cover" :src="product.image" alt="" srcset="">
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
                                </Slide>
                            </Carousel>
                        </div>
                    </div>
                </div>

                <div class="w-[350px] h-[400px] rightBg absolute right-0 top-[-10px] opacity-[0.2] z-[-1]">
                    <img class="w-full h-full bg-cover" src="/image/bg_overlay_right.png" alt="">
                </div>
            </section>

            <section class="about_section w-full relative overflow-hidden">
                <div class="w-full h-[150px] bg-[#e9471f]/80 absolute top-[37%] z-[-1]"></div>

                <div class="container my-[40px] p-3 z-[1]">
                    <div class="row w-full min-h-[400px] md:flex shadow-lg shadow-[#001c08]/60">
                        <div class="w-full md:w-6/12 min-h-full">
                            <img class="w-full h-full bg-cover" src="/image/home-about-us.jpg" alt="">
                        </div>
                        <div class="w-full md:w-6/12 p-[40px] bg-[#145829]">
                            <div class="row">
                                <div class="title">
                                    <h1 class="text-[35px] text-white">About Us</h1>
                                </div>
                                <div class="sub-title">
                                    <h2 class="text-[22px] text-gray-200">The Real Meatshop</h2>
                                </div>
                            </div>

                            <hr class="border-[2px] border-yellow-400 w-[100px] my-5">

                            <div class="details">
                                <p class="font-semibold text-[17px] text-white">Best-in-class service provider, wholesaler, and retailer of safe, fresh, high-quality frozen, chilled, and processed meats to family tables, community restaurants, and reputable food service providers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="policy_section w-full bg-[#F4F6F9] relative overflow-hidden z-[-2]">
                <div class="w-[350px] h-[400px] leftBg absolute left-0 top-[-10px] opacity-[0.2] z-[-1]">
                    <img class="w-full h-full bg-cover" src="/image/bg_overlay_left.png" alt="">
                </div>

                <div class="container my-[40px] p-3 z-[1]">
                    <div class="row w-full md:flex items-center justify-between min-h-[230px]">
                        
                        <div class="w-full md:w-3/12 h-auto p-[80px] md:p-[50px] text-center">
                            <div class="w-full border-[2px] border-gray-600 rounded-lg" >
                                <img class="w-full bg-cover" src="/image/well-cut.png" alt="" srcset="">
                            </div>
                            <span class="font-semibold text-gray-500 text-[15px]">Well Cut and Packed</span>
                        </div>

                        <div class="w-full md:w-3/12 h-auto p-[80px] md:p-[50px] text-center">
                            <div class="w-full border-[2px] border-gray-600 rounded-lg" >
                                <img class="w-full bg-cover" src="/image/well-cut.png" alt="" srcset="">
                            </div>
                            <span class="font-semibold text-gray-500 text-[15px]">Well Cut and Packed</span>
                        </div>

                        <div class="w-full md:w-3/12 h-auto p-[80px] md:p-[50px] text-center">
                            <div class="w-full border-[2px] border-gray-600 rounded-lg" >
                                <img class="w-full bg-cover" src="/image/well-cut.png" alt="" srcset="">
                            </div>
                            <span class="font-semibold text-gray-500 text-[15px]">Well Cut and Packed</span>
                        </div>

                        <div class="w-full md:w-3/12 h-auto p-[80px] md:p-[50px] text-center">
                            <div class="w-full border-[2px] border-gray-600 rounded-lg" >
                                <img class="w-full bg-cover" src="/image/well-cut.png" alt="" srcset="">
                            </div>
                            <span class="font-semibold text-gray-500 text-[15px]">Well Cut and Packed</span>
                        </div>

                        
                    </div>
                </div>

                <div class="w-[350px] h-[400px] rightBg absolute right-0 top-[-10px] opacity-[0.2] z-[-1]">
                    <img class="w-full h-full bg-cover" src="/image/bg_overlay_right.png" alt="">
                </div>
            </section>

            <FooterSection/>
        </main>
    </div>
</template>

<style scoped>
    .text-shadow {
        text-shadow: 0 6px 10px #000;
    }

    header {
     transition: all 0.5s ease; /* Smooth transition for all properties */
    }
</style>