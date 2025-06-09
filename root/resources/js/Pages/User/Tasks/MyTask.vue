<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { reactive, ref } from 'vue';
import ShowTask from '@/Components/ShowTask.vue';

const props = defineProps({
    user : Array,
    errors : Object,
});

// console.log(props.user);

const taskData = ref({});
const userData = ref({
    name: '',
});

const modalVisible = ref(false);

const showTask = (task, userName) => {
    taskData.value = task;
    userData.value.name = userName;
    modalVisible.value = true
    // console.log(userData.value);
};

</script>

<template>
    <Head title="My Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ props.user[0].name }} : 担当タスク
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="text-gray-900">
                        <section class="text-gray-600 body-font w-full">
                            <!-- Modal -->
                            <Modal :show="modalVisible" @close="modalVisible = false">
                                <ShowTask :taskData="taskData" :userName="userData.name" @close="modalVisible = false" :errors="props.errors"/>
                            </Modal>

                            <div class="container px-5 w-3/4 mx-auto">
                                <div>
                                    <div class="my-10" style="box-shadow: 6px 10px 29px -7px #777777; border-radius: 29px;">
                                        <div class="border p-6 rounded-lg">
                                            <div class="flex items-center mb-3">
                                                <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 m-2">
                                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                                                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                                    </svg>
                                                </div>
                                                <h2>👤 {{ props.user[0].name }}</h2>
                                            </div>
                                            <div class="w-full mx-auto">
                                                <table class="table-auto text-left whitespace-no-wrap border-collapse w-full">
                                                    <thead>
                                                        <tr>
                                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">タスク</th>
                                                            <th class="px-4 py-3 text-center title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">優先度</th>
                                                            <th class="px-4 py-3 text-center title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">タスク状態</th>
                                                            <th class="px-4 py-3 text-center title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">期限</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="task in props.user[0].tasks" :key="task.id" @click="showTask(task, props.user[0].name)" @mousedown="startDrag"
                                                            class="cursor-pointer transition transform hover:scale-[1.01] hover:shadow-md hover:bg-gray-100">
                                                            <td class="p-3 tracking-wider">{{ task.title }}</td>
                                                            <td class="p-3 text-center tracking-wider">{{ task.priority_jp }}</td>
                                                            <td class="p-3 text-center tracking-wider">{{ task.status_jp }}</td>
                                                            <td class="p-3 text-center tracking-wider">
                                                                <span v-if="task.due_date === null">期限なし</span>
                                                                <span v-if="task.due_date !== null">{{ task.due_date_formatted }}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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
