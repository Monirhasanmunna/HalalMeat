<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthStore from '@/store/auth';

const submit = () => {
    AuthStore.login()
};

</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="AuthStore.credentials.email"
                    autofocus
                    autocomplete="username"
                />

                <span v-if="AuthStore.errors.email" class="form-error" >{{ AuthStore.errors.email[0] }}</span>

            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="AuthStore.credentials.password"
                    autocomplete="current-password"
                />

                <span v-if="AuthStore.errors.password" class="form-error" >{{ AuthStore.errors.password[0] }}</span>

            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="AuthStore.credentials.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                
                <button v-if="!AuthStore.isLoaderOn" type="submit" class="px-3 py-2 float-end bg-green-500 text-white rounded-md hover:bg-green-600 duration-200">Login</button>

                <button v-else type="submit" disabled class="px-3 py-2 w-[62px] text-white cursor-not-allowed hover:bg-green-600 duration-200 flex justify-center items-center bg-[#3AC18C] rounded-md float-end hover:text-white">
                    <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-white rounded-full dark:text-blue-500"
                        User="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
