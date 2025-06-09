<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';


const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const storeUser = () => {
    router.post(route('admin.users.store'), form);
};

</script>

<template>
    <Head title="タスク担当者新規作成" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800" >
                タスク担当者新規作成
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="storeUser">
                                <div class="container px-5 py-16 mx-auto">
                                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                        <div class="-m-2">
                                            <div class="p-2">
                                                <div class="relative">
                                                    <InputLabel for="name" value="タスク担当者名" />
                                                    <TextInput id="name" type="text" name="name"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                        v-model="form.name" required
                                                        autofocus autocomplete="name" />
                                                    <InputError class="mt-2" :message="form.errors.name" />
                                                </div>
                                            </div>

                                            <div class="p-2">
                                                <div class="relative">
                                                    <InputLabel for="email" value="メールアドレス" />
                                                    <TextInput id="email" type="email" class="w-full name='email' bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" v-model="form.email" required autocomplete="username" />
                                                    <InputError class="mt-2" :message="form.errors.email" />
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <InputLabel for="password" value="パスワード" />
                                                    <TextInput id="password" type="password"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                        v-model="form.password" required autocomplete="new-password" />
                                                    <InputError class="mt-2" :message="form.errors.password" />
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <InputLabel for="password_confirmation" value="パスワード（確認）" />
                                                    <TextInput id="password_confirmation" type="password"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                        v-model="form.password_confirmation" required autocomplete="new-password" />
                                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/3 mx-auto mt-5">
                                                <button class="flex mx-auto text-white whitespace-nowrap bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">タスク担当者登録</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
