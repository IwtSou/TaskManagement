<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

import Modal from '@/Components/Modal.vue';
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';

import ShowUser from '@/Components/Admin/ShowUser.vue';

const props = defineProps({
    users : Array,
    errors : Object,
});

const userData = ref({});

const modalVisible = ref(false);

const showUser = (user) => {
    userData.value= user;
    modalVisible.value = true
};

</script>

<template>
    <Head title="管理者：タスク担当者一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                管理者用：タスク担当者一覧
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="text-gray-900">
                        <section class="text-gray-600 body-font w-full">
                            <!-- Modal -->
                            <Modal :show="modalVisible" @close="modalVisible = false">
                                <ShowUser :user="userData" @close="modalVisible = false" :errors="props.errors"/>
                            </Modal>

                            <div class="container w-3/4 mx-auto">
                                <div class="my-10" style="box-shadow: 6px 10px 29px -7px #777777; border-radius: 29px;">
                                    <div class="p-3 rounded-lg">
                                        <div class="w-full mx-auto">
                                            <table class="table-auto text-left whitespace-no-wrap　border-collapse w-full">
                                                <thead>
                                                    <tr>
                                                        <th class="px-4 py-3 whitespace-nowrap title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">タスク担当者名</th>
                                                        <th class="px-4 py-3 whitespace-nowrap text-center title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">担当者メールアドレス</th>
                                                        <th class="px-4 py-3 whitespace-nowrap text-center title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">全タスク数</th>
                                                        <th class="px-4 py-3 whitespace-nowrap text-center title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">未対応タスク数</th>
                                                        <th class="px-4 py-3 whitespace-nowrap text-center title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">進行中タスク数</th>
                                                        <th class="px-4 py-3 whitespace-nowrap text-center title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">完了タスク数</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="user in props.users" :key="user.id" @click="showUser(user)"
                                                        class="cursor-pointer transition transform hover:scale-[1.01] hover:shadow-md hover:bg-gray-100">
                                                        <td class="px-4 py-3">{{ user.name }}</td>
                                                        <td class="px-4 py-3">{{ user.email }}</td>
                                                        <td class="px-4 py-3  text-center">{{ user.tasks_count }}</td>
                                                        <td class="px-4 py-3  text-center">{{ user.pending_tasks_count }}</td>
                                                        <td class="px-4 py-3  text-center">{{ user.in_progress_tasks_count }}</td>
                                                        <td class="px-4 py-3  text-center">{{ user.done_tasks_count }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
