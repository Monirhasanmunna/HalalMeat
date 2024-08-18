<script setup>
import UserIcon from '@/Components/Icons/Frontend/UserIcon.vue';
import CartIcon from '@/Components/Icons/Frontend/CartIcon.vue';
import SearchIcon from '@/Components/Icons/Frontend/SearchIcon.vue';
</script>


<template>
    <header class="w-full z-[5]">
            <div class="header w-full bg-gray-800/90">
                <div class="container p-3">
                    <div class="flex justify-between items-center">
                        <div class="logo w-[80px]">
                            <img class="w-full shadow" src="/image/logo/logo.png" alt="">
                        </div>

                        <div class="search hidden md:block md:w-[300px]">
                            <div class="relative flex rounded-lg shadow-sm">
                                <input type="text" id="hs-trailing-button-add-on-with-icon-and-button"
                                    name="hs-trailing-button-add-on-with-icon-and-button" placeholder="search here"
                                    class="py-2 px-4 block w-full border-gray-200 rounded-sm text-sm focus:ring-0 focus:border-0 placeholder:text-gray-400 placeholder:capitalize">

                                <button type="button"
                                    class="px-2.5 inline-flex justify-center items-center text-xl font-semibold rounded-sm border border-transparent bg-[#145829] text-white">
                                    <SearchIcon />
                                </button>
                            </div>

                        </div>

                        <div class="flex items-center gap-5">

                            <button class="text-gray-100 text-[22px] cursor-pointer md:hidden" aria-haspopup="dialog"
                                aria-expanded="false" aria-controls="hs-basic-modal" data-hs-overlay="#hs-basic-modal">
                                <SearchIcon />
                            </button>

                            <div id="hs-basic-modal"
                                class="hs-overlay hs-overlay-backdrop-open:bg-blue-950/70 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-[85px] start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none"
                                role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">
                                <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                    <div class="flex flex-col bg-transparent border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">

                                        <div class="flex justify-between items-center py-3 px-4 dark:border-neutral-700">
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

                            <div class="hs-dropdown relative inline-flex [--offset:32] [--placement:bottom]">
                                <button
                                    class="singin flex gap-2 items-center cursor-pointer duration-150 border border-gray-100 px-2 py-1 text-yellow-400  hover:border-yellow-400">
                                    <CartIcon class="text-[22px]" />
                                </button>

                                <div class="hs-dropdown-menu transition-[opacity,margin] duration-300 hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-green-400 shadow-md rounded-b-lg p-1 space-y-0.5 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700"
                                    role="menu" aria-orientation="vertical"
                                    aria-labelledby="hs-dropdown-slideup-animation">

                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        href="#">
                                        Newsletter
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        href="#">
                                        Purchases
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        href="#">
                                        Downloads
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        href="#">
                                        Team Account
                                    </a>
                                </div>
                            </div>

                            <Link :href="route('login')" class="singin hover:border-yellow-400 duration-150 cursor-pointer flex gap-2 items-center border border-gray-100 px-2 py-1 text-gray-100">
                                <UserIcon class="text-yellow-400 text-[19px]" />
                                <span>Sign In</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </header>
</template>