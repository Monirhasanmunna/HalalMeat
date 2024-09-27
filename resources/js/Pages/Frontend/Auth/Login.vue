<script setup>
import HeaderComponent from '@/Components/Frontend/HeaderComponent.vue';
import FooterSection from '@/Components/Frontend/FooterSection.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    number: '',
});

const submit = () => {
    form.post(route('customer.login.submit'), {
        onFinish: () => form.reset('number'),
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
                        <div class="p-4 sm:p-7 w-[400px]">
                            <div class="text-center">
                                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign in</h1>
                            </div>

                            <div class="mt-5">
                                <!-- Form -->
                                <form @submit.prevent="submit">
                                    <div class="grid gap-y-4">
                                        <div>
                                            <label for="number" class="block text-sm mb-2 font-semibold text-gray-700">Mobile Number</label>
                                            <div class="relative">
                                            <input type="number" id="number" v-model="form.number" name="number" class="py-3 px-4 block w-full border-gray-400 rounded-md text-sm focus:ring-0" >

                                            <span v-if="form.errors.number" class="form-error font-semibold" >{{ form.errors.number }}</span>
                                            </div>
                                        </div>


                                        <button type="submit" :disabled="form.processing" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-60 disabled:cursor-progress">Sign in</button>
                                    </div>

                                    <div class="mt-5">
                                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                            Don't have an account yet?
                                            <Link :href="route('customer.register')" class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="../examples/html/signup.html">
                                            Registration here
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