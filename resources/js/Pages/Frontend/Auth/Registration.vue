<script setup>
import HeaderComponent from '@/Components/Frontend/HeaderComponent.vue';
import FooterSection from '@/Components/Frontend/FooterSection.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';


const form = useForm({
    name: '',
    email: '',
    number: '',
    address: '',
    gender: '',
});

const submit = () => {
    form.post(route('customer.register.store'), {
        onFinish: () => form.reset(),
    });
};

</script>

<template>
    <Head title="Halal Meat | Login" />

    <div class="w-full h-screen">
        <!-- header section start -->
            <HeaderComponent />
        <!-- header section ends -->

        <main class="h-full flex flex-col justify-between">
            <div class="h-full container flex items-center justify-center">
                    <div class="bg-white border border-gray-300 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-7 w-full sm:w-[400px]">
                            <div class="text-center">
                                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Registration</h1>
                            </div>

                            <div class="mt-5">
                                <!-- Form -->
                                <form @submit.prevent="submit">
                                    <div class="grid gap-y-4">
                                        <div>
                                            <label for="name" class="block text-sm mb-2 font-semibold text-gray-700">Name</label>
                                            <div class="relative">
                                            <input type="text" id="name" v-model="form.name" name="name" class="py-3 px-4 block w-full border-gray-400 rounded-md text-sm focus:ring-0" >

                                            <span v-if="form.errors.name" class="form-error font-semibold" >{{ form.errors.name }}</span>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="email" class="block text-sm mb-2 font-semibold text-gray-700">Email</label>
                                            <div class="relative">
                                            <input type="email" id="email" v-model="form.email" name="email" class="py-3 px-4 block w-full border-gray-400 rounded-md text-sm focus:ring-0" >

                                            <span v-if="form.errors.email" class="form-error font-semibold" >{{ form.errors.email }}</span>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="number" class="block text-sm mb-2 font-semibold text-gray-700">Mobile Number</label>
                                            <div class="relative">
                                            <input type="number" id="number" v-model="form.number" name="number" class="py-3 px-4 block w-full border-gray-400 rounded-md text-sm focus:ring-0" >

                                            <span v-if="form.errors.number" class="form-error font-semibold" >{{ form.errors.number }}</span>
                                            </div>
                                        </div>

                                        
                                        <div>
                                            <label for="address" class="block text-sm mb-2 font-semibold text-gray-700">Address</label>
                                            <div class="relative">
                                            <input type="text" id="address" v-model="form.address" name="address" class="py-3 px-4 block w-full border-gray-400 rounded-md text-sm focus:ring-0" >

                                            <span v-if="form.errors.address" class="form-error font-semibold" >{{ form.errors.address }}</span>
                                            </div>
                                        </div>

                                        
                                        <div>
                                            <label for="gender" class="block text-sm mb-2 font-semibold text-gray-700">Gender</label>
                                            <div class="relative">
                                            <select name="gender" id="gender" v-model="form.gender" class="py-3 px-4 block w-full border-gray-400 rounded-md text-sm focus:ring-0">
                                                <option value="" disabled hidden>Select Once</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>

                                            <span v-if="form.errors.gender" class="form-error font-semibold" >{{ form.errors.gender }}</span>
                                            </div>
                                        </div>


                                        <button type="submit" :disabled="form.processing" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-60 disabled:cursor-progress">Registration</button>
                                    </div>

                                    <div class="mt-5">
                                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                                Already have an account?
                                            <Link :href="route('customer.login')" class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="../examples/html/signup.html">
                                                Sign in here
                                            </Link>
                                        </p>
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div>
                </div>

            <!-- foter section starts -->
             <FooterSection/>
            <!-- foter section ends -->
        </main>
    </div>
</template>