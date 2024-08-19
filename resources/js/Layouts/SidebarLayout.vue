<script setup>
import DashboardIcon from '@/Components/Icons/DashboardIcon.vue';
import DotIcon from '@/Components/Icons/DotIcon.vue';
import MenuArrowIcon from '@/Components/Icons/MenuArrowIcon.vue';
import CategoryIcon from '@/Components/Icons/CategoryIcon.vue';
import BrandIcon from '@/Components/Icons/BrandIcon.vue';
import UnitIcon from '@/Components/Icons/UnitIcon.vue';
import TaxIcon from '@/Components/Icons/TaxIcon.vue';
import {Link} from '@inertiajs/vue3';


</script>

<template>
    <div id="sidebar" class="sidebar w-[0px] sm:min-w-[250px] z-20 bg-[#FFFFFF] dark:bg-[#1F2940] fixed h-full overflow-hidden overflow-y-auto">
        <nav class="hs-accordion-group py-6 px-[8px] w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
            <ul class="space-y-2">
                <li>
                    <Link :href="route('dashboard')" :class="{'activeNav' : route().current('dashboard')}" class="menu">
                    <DashboardIcon class="menu-icon" />
                    Dashboard
                    </Link>
                </li>


                <li class="hs-accordion" id="product"  >
                    <button type="button" class="menu hs-accordion-toggle" :class="{'activeNav' : route().current('product.*')}">
                    <CategoryIcon class="menu-icon" />
                    Product

                    <MenuArrowIcon />
                    </button>

                    <div id="product-child" class="hs-accordion-content sub-menu-content" :class="{'block' : route().current('product.*')}">
                        <ul class="p-2 border-l-2 border-[#75e5ab] space-y-2">
                            <li>
                                <Link :href="route('product.index')" class="sub-menu" :class="{'activeNav' : route().current('product.index') || route().current('product.create')}">
                                    <DotIcon class="sub-menu-icon" />
                                    Product List
                                </Link>
                            </li>

                            <li class="hs-accordion" id="config" :class="{'active' : route().current('product.category.*') || route().current('product.brand.*') || route().current('product.unit.*')}">
                                <button type="button" class="sub-menu w-full hs-accordion-toggle">
                                    <DotIcon class="sub-menu-icon" />
                                    Config
                                    <MenuArrowIcon />
                                </button>

                                <div id="config-child" class="hs-accordion-content sub-menu-content" :class="{'block' : route().current('product.category.*') || route().current('product.brand.*') || route().current('product.unit.*') ||route().current('product.subCategory.*')}">
                                    <ul class="p-2 ml-[5px] border-l-2 border-[#75e5ab] space-y-2">
                                        <li>
                                            <Link :href="route('product.category.index')" class="sub-menu" :class="{'activeNav' : route().current('product.category.*')}">
                                                <DotIcon class="sub-menu-icon" />
                                                Category List
                                            </Link>
                                        </li>
                                        <li>
                                            <Link :href="route('product.subCategory.index')" class="sub-menu" :class="{'activeNav' : route().current('product.subCategory.*')}">
                                                <DotIcon class="sub-menu-icon" />
                                                Sub Category List
                                            </Link>
                                        </li>
                                        <li>
                                            <Link :href="route('product.brand.index')" class="sub-menu" :class="{'activeNav' : route().current('product.brand.*')}">
                                                <DotIcon class="sub-menu-icon" />
                                                Brand List
                                            </Link>
                                        </li>
                                        <li>
                                            <Link :href="route('product.unit.index')" class="sub-menu" :class="{'activeNav' : route().current('product.unit.*')}">
                                                <DotIcon class="sub-menu-icon" />
                                                Unit List
                                            </Link>
                                        </li>
 
                                    </ul>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </li>

            


            </ul>
        </nav>
    </div>
</template>

<style scoped>
.activeNav{
    background-color: #EAFFF4;
    color: #69AA8A;
}
</style>
