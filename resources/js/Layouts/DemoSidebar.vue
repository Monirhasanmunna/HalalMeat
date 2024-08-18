<template>
    <nav class="hs-accordion-group py-6 px-[8px] w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
            <ul class="space-y-2">
                <li>
                    <RouterLink :to="{name:'Dashboard'}"  class="menu">
                        <DashboardIcon class="menu-icon" />
                        Dashboard
                    </RouterLink>
                </li>

                <li v-if="authUser.hasPermission('department list') || authUser.hasPermission('designation list') || authUser.hasPermission('chamber list') || authUser.hasPermission('speciality list')" class="hs-accordion" id="user-management-accordion" :class="{'active' : route.name == 'Department' || route.name == 'Designation'|| route.name == 'Speciality' || route.name == 'Chamber' || route.name == 'Doctor' || route.name == 'Assistant'}">
                    <button type="button" class="menu hs-accordion-toggle">
                        <DoctorIcon class="menu-icon" />
                        Doctor
                        <MenuArrowIcon />
                    </button>

                    <div id="user-management-accordion-child" class="hs-accordion-content sub-menu-content hs-accordion-active:block">
                        <ul class="p-2 ml-[20px] border-l-2 border-[#75e5ab] space-y-2">
                            <li v-if="authUser.hasPermission('doctor list')">
                                <RouterLink :to="{name:'Doctor'}" class="sub-menu">
                                    <DotIcon class="sub-menu-icon" />
                                    Doctor List
                                </RouterLink>
                            </li>
                            <li v-if="authUser.hasPermission('assistant list')">
                                <RouterLink :to="{name:'Assistant'}" class="sub-menu">
                                    <DotIcon class="sub-menu-icon" />
                                    Assistant List
                                </RouterLink>
                            </li>

                            <li v-if="authUser.hasPermission('department list') || authUser.hasPermission('designation list') || authUser.hasPermission('chamber list') || authUser.hasPermission('speciality list')" class="hs-accordion mt-2" id="user-management-accordion" :class="{'active' : route.name == 'Department' || route.name == 'Designation'|| route.name == 'Speciality' || route.name == 'Chamber'}">
                                <button type="button" class="sub-menu w-full hs-accordion-toggle">
                                    <DotIcon class="sub-menu-icon" />
                                    Config
                                    <MenuArrowIcon />
                                </button>

                                <div id="user-management-accordion-child" class="hs-accordion-content sub-menu-content hs-accordion-active:block ">
                                    <ul class="p-2 ml-[5px] border-l-2 border-[#75e5ab] space-y-2">
                                        <li v-if="authUser.hasPermission('department list')">
                                            <RouterLink :to="{name:'Department'}" class="sub-menu">
                                                <DotIcon class="sub-menu-icon" />
                                                Department
                                            </RouterLink>
                                        </li>
                                        <li v-if="authUser.hasPermission('designation list')" >
                                            <RouterLink :to="{name: 'Designation'}" class="sub-menu">
                                                <DotIcon class="sub-menu-icon" />
                                                Designation
                                            </RouterLink>
                                        </li>
                                        <li v-if="authUser.hasPermission('speciality list')" >
                                            <RouterLink :to="{name: 'Speciality'}" class="sub-menu">
                                                <DotIcon class="sub-menu-icon" />
                                                Speciality
                                            </RouterLink>
                                        </li>
                                        <li v-if="authUser.hasPermission('chamber list')" >
                                            <RouterLink :to="{name: 'Chamber'}" class="sub-menu">
                                                <DotIcon class="sub-menu-icon" />
                                                Chamber
                                            </RouterLink>
                                        </li>
                                        
                                    
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </li>

                <li v-if="authUser.hasPermission('blood donor list')" class="hs-accordion" id="user-management-accordion" :class="{'active' : route.name == 'BloodDonor'}">
                    <button type="button" class="menu hs-accordion-toggle">
                        <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="15" r="3"/><circle cx="9" cy="7" r="4"/><path d="M10 15H6a4 4 0 0 0-4 4v2"/><path d="m21.7 16.4-.9-.3"/><path d="m15.2 13.9-.9-.3"/><path d="m16.6 18.7.3-.9"/><path d="m19.1 12.2.3-.9"/><path d="m19.6 18.7-.4-1"/><path d="m16.8 12.3-.4-1"/><path d="m14.3 16.6 1-.4"/><path d="m20.7 13.8 1-.4"/></svg>
                        Blood Donor

                        <MenuArrowIcon />
                    </button>

                    <div id="user-management-accordion-child" class="hs-accordion-content sub-menu-content hs-accordion-active:block">
                        <ul class="p-2 ml-[20px] border-l-2 border-[#75e5ab] space-y-2">
                            <li v-if="authUser.hasPermission('blood donor list')">
                                <RouterLink :to="{name:'BloodDonor'}" class="sub-menu">
                                    <DotIcon class="sub-menu-icon" />
                                    Donor List
                                </RouterLink>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                
                <li v-if="authUser.hasPermission('user list') || authUser.hasPermission('role list')" class="hs-accordion" id="user-management-accordion" :class="{'active' : route.name == 'Role' || route.name == 'Permission' || route.name == 'User'}">
                    <button type="button" class="menu hs-accordion-toggle">
                        <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="15" r="3"/><circle cx="9" cy="7" r="4"/><path d="M10 15H6a4 4 0 0 0-4 4v2"/><path d="m21.7 16.4-.9-.3"/><path d="m15.2 13.9-.9-.3"/><path d="m16.6 18.7.3-.9"/><path d="m19.1 12.2.3-.9"/><path d="m19.6 18.7-.4-1"/><path d="m16.8 12.3-.4-1"/><path d="m14.3 16.6 1-.4"/><path d="m20.7 13.8 1-.4"/></svg>
                        User Management

                        <MenuArrowIcon />
                    </button>

                    <div id="user-management-accordion-child" class="hs-accordion-content sub-menu-content hs-accordion-active:block">
                        <ul class="p-2 ml-[20px] border-l-2 border-[#75e5ab] space-y-2">
                            <li v-if="authUser.hasPermission('role list')">
                                <RouterLink :to="{name:'Role'}" class="sub-menu" :class="{'activeNav' : route.name == 'Permission'}">
                                    <DotIcon class="sub-menu-icon" />
                                    Role
                                </RouterLink>
                            </li>
                            <li v-if="authUser.hasPermission('user list')" >
                                <RouterLink :to="{name: 'User'}" class="sub-menu">
                                    <DotIcon class="sub-menu-icon" />
                                    User
                                </RouterLink>
                            </li>
                        </ul>
                    </div>
                </li>


                <li v-if="authUser.hasPermission('upazilla list') || authUser.hasPermission('district list')" class="hs-accordion" id="user-management-accordion" :class="{'active' : route.name == 'Upazilla' || route.name == 'District'}">
                    <button type="button" class="menu hs-accordion-toggle">
                        <GearsIcon class="menu-icon" />
                        Settings
                        <MenuArrowIcon />
                    </button>

                    <div id="user-management-accordion-child" class="hs-accordion-content sub-menu-content hs-accordion-active:block">
                        <ul class="p-2 ml-[20px] border-l-2 border-[#75e5ab] space-y-2">
                            <li v-if="authUser.hasPermission('upazilla list')">
                                <RouterLink :to="{name:'Upazilla'}" class="sub-menu">
                                    <DotIcon class="sub-menu-icon" />
                                    Upazilla
                                </RouterLink>
                            </li>
                            <li v-if="authUser.hasPermission('district list')" >
                                <RouterLink :to="{name: 'District'}" class="sub-menu">
                                    <DotIcon class="sub-menu-icon" />
                                    District
                                </RouterLink>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </nav>
</template>