<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props = defineProps({
    taskData : Object,
    userName : String,
});

const form = reactive({
    id : props.taskData.id,
    title : props.taskData.title,
    priority : props.taskData.priority,
    due_date : props.taskData.due_date,
    description : props.taskData.description,
    status : props.taskData.status,
});

const emit = defineEmits(['close']);

const close = () => {
    emit('close'); // 親に「閉じて」と伝える
};

const updateTask = (id) => {
    router.put(route('user.tasks.update', {id}), form);
    emit('close');
};

const deleteTask = id => {
    if (!confirm('本当に削除しますか？')) return;

    router.delete(route('user.tasks.destroy', {id}), {
        onSuccess: () => emit('close'),
    });
};
</script>

<template>
    <Head title="タスク詳細" />

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <section class="text-gray-600 body-font relative flex flex-col">
                    <div class="flex justify-between items-center">
                        <h1>詳細タスク</h1>
                        <p>担当者: {{ props.userName }}</p>
                        <Link @click="deleteTask(form.id)" class="cursor-pointer transition transform hover:scale-[1.01]">
                            <img src="/images/trash_icon.svg" alt="" class="h-7 w-10 " />
                        </Link>
                        <Link class="self-end cursor-pointer transition transform hover:scale-[1.01] hover:shadow-md hover:bg-gray-50"
                            @click="close">
                            閉じる
                        </Link>
                    </div>
                    <form @submit.prevent="updateTask(form.id)">
                        <div class="container px-5 py-5 mx-auto">
                            <div class="lg:w-full md:w-2/3 mx-auto">
                                <div class="-m-2">
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="title" class="leading-7 text-sm text-gray-600">タスク</label>
                                            <input type="text" id="title" name="title" v-model="form.title"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label class="leading-7 text-sm text-gray-600">優先度</label>
                                            <div class="flex">
                                                <div>
                                                    <input type="radio" id="low" name="priority" value="low" v-model="form.priority" class="mx-3">
                                                    <label for="low">低</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="medium" name="priority" value="medium" v-model="form.priority" class="mx-3">
                                                    <label for="medium">中</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="high" name="priority" value="high" v-model="form.priority" class="mx-3">
                                                    <label for="high">高</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label class="leading-7 text-sm text-gray-600">タスク状態</label>
                                            <div class="flex">
                                                <div>
                                                    <input type="radio" id="pending" name="status" value="pending" v-model="form.status" class="mx-3">
                                                    <label for="pending">未対応</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="in_progress" name="status" value="in_progress" v-model="form.status" class="mx-3">
                                                    <label for="in_progress">進行中</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="done" name="status" value="done" v-model="form.status" class="mx-3">
                                                    <label for="done">完了</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label for="due_date" class="leading-7 text-sm text-gray-600">期限</label>
                                            <input type="date" id="due_date" name="due_date" v-model="form.due_date"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label for="description" class="leading-7 text-sm text-gray-600">タスク説明</label>
                                            <textarea id="description" name="description" v-model="form.description"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="p-2 w-1/3 mx-auto">
                                        <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">タスク編集</button>
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
