<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';


const props = defineProps({
    user : Object,
    errors   : Object
});

const form = reactive({
    id : props.user.id,
    name : props.user.name,
    email : props.user.email,
    password : props.user.password,
});

const emit = defineEmits(['close']);

const close = () => {
    emit('close'); // 親に「閉じて」と伝える
};

const updateUser= id => {
    router.put(route('admin.users.update', {id}), form, {
        onSuccess: () => {
            emit('close');
        },
        onError: () => {
            console.warn('バリデーションエラーが発生しました');
        }
    });
};

const deleteUser = id => {
    if (!confirm('本当に削除しますか？')) return;

    router.delete(route('admin.users.destroy', { user: id }), {
        onSuccess: () => emit('close'),
    });
};
</script>

<template>
    <Head title="タスク担当者詳細" />

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <section class="text-gray-600 body-font relative flex flex-col">
                    <div class="flex justify-between items-center">
                        <h1>担当者　詳細</h1>

                        <button type="button" @click="deleteUser(form.id)" class="cursor-pointer transition transform hover:scale-[1.01]">
                            <img src="/images/trash_icon.svg" alt="" class="h-7 w-10 " />
                        </button>

                        <button type="button" class="self-end cursor-pointer transition transform hover:scale-[1.01] hover:shadow-md hover:bg-gray-50"
                            @click="close">
                            閉じる
                        </button>
                    </div>
                    <form @submit.prevent="updateUser(form.id)">
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
                                            <InputError class="mt-2" :message="props.errors.name" />
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <InputLabel for="email" value="メールアドレス" />
                                            <TextInput id="email" type="email" class="w-full name='email' bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" v-model="form.email" required autocomplete="username" />
                                            <InputError class="mt-2" :message="props.errors.email" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <InputLabel for="password" value="新規パスワード" />
                                            <input id="password" type="password"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                v-model="form.password" required autocomplete="new-password" />
                                            <InputError class="mt-2" :message="props.errors.password" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <InputLabel for="password_confirmation" value="新規パスワード（確認）" />
                                            <input id="password_confirmation" type="password"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                v-model="form.password_confirmation" required autocomplete="new-password" />
                                            <InputError class="mt-2" :message="props.errors.password_confirmation" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-2/3 mx-auto">
                                        <button type="button" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</template>
