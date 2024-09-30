<script setup>
import FacebookIcon from '@/Components/Icons/Frontend/FacebookIcon.vue';
import WhatsAppIcon from '@/Components/Icons/Frontend/WhatsAppIcon.vue';
import InstagramIcon from '@/Components/Icons/Frontend/InstagramIcon.vue';
import SearchIcon from '@/Components/Icons/Frontend/SearchIcon.vue';
</script>


<template>
    <section class="footer-section w-full bg-[#171F24]">
        <div class="container min-h-[300px] p-3 py-[30px] z-[1]">
            <div class="w-full sm:flex justify-between space-y-10 sm:space-y-0">
                <div class="w-full sm:w-3/12 space-y-5">
                    <div class="logo w-[80px]">
                        <img class="w-full" src="/image/logo/logo.png" alt="" srcset="">
                    </div>
                    <div class="about-text text-white text-[12px]">
                        <p>Halal Meat Processing Industry is an export oriented world class meat industry. We produce
                            safe wholesome meat and meat products that are of the highest quality and standard for
                            domestic and international markets</p>
                    </div>
                </div>

                <div class="w-full sm:w-3/12 space-y-5 ">
                    <div class="text-white sm:text-center">
                        <h3>Social Links</h3>
                    </div>
                    <div class="social-media flex sm:justify-center gap-4">
                        <FacebookIcon class="text-white text-[25px] cursor-pointer shadow-md" />
                        <WhatsAppIcon class="text-white text-[25px] cursor-pointer shadow-md" />
                        <InstagramIcon class="text-white text-[25px] cursor-pointer shadow-md" />
                    </div>
                </div>

                <div class="w-full sm:w-3/12 space-y-5">
                    <div class="w-full">
                        <div class="subscribe text-white">
                            <h3>Subscribe Here</h3>
                        </div>

                        <div class="flex justify-between items-center py-3 dark:border-neutral-700">
                            <div class="relative flex rounded-lg shadow-sm w-full">
                                <input type="text" id="hs-trailing-button-add-on-with-icon-and-button"
                                    name="hs-trailing-button-add-on-with-icon-and-button" autofocus
                                    placeholder="search here"
                                    class="py-2 px-4 block w-full border-gray-200 rounded-sm text-sm focus:ring-0 focus:border-0 placeholder:text-gray-400 placeholder:capitalize">

                                <button type="button"
                                    class="px-2.5 inline-flex justify-center items-center text-xl font-semibold rounded-sm border border-transparent bg-[#145829] text-white">
                                    <SearchIcon />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>