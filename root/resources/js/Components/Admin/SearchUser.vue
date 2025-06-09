<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const emit = defineEmits([
    'close',
    'getUser',
]);

const close = () => {
    emit('close'); // 親に「閉じて」と伝える
};

const users = ref([]);

onMounted(async () => {
    try {
        // 認証済みリクエスト
        const response = await axios.get('/admin/api/getuser');
        users.value = response.data.users;
    } catch (error) {
        console.error('認証エラー', error);
    }

});

const getUser = (userInfo) => {
    emit('getUser', userInfo);
    emit('close');
};
</script>

<template>
    <Head title="タスク担当者" />
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <section class="text-gray-600 body-font relative flex flex-col">
                    <div class="flex justify-between items-center">
                        <h1>タスク担当者選択</h1>
                        <button type="button" class="self-end cursor-pointer transition transform hover:scale-[1.01] hover:shadow-md hover:bg-gray-50"
                            @click="close">
                            閉じる
                        </button>
                    </div>

                    <div class="w-full mx-auto mt-10">
                        <table class="table-auto text-left whitespace-no-wrap border-collapse w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                    <th class="px-4 py-3 text-center title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ユーザー名</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id" @click="getUser(user)"
                                    class="cursor-pointer transition transform hover:scale-[1.01] hover:shadow-md hover:bg-gray-100 overflow-auto">
                                    <td class="p-3">{{ user.id }}</td>
                                    <td class="p-3 text-center">{{ user.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
