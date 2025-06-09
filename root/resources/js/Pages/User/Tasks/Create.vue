<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const form = reactive({
    title: '',
    priority : 'low',
    due_date : '',
    description : '',
});

const storeTask = () => {
    router.post(route('user.tasks.store'), form);
};

</script>

<template>
    <Head title="タスク作成" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800" >
                タスク作成
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="storeTask">
                                <div class="container px-5 py-16 mx-auto">
                                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
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
                                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                                </div>
                                            </div>

                                            <div class="p-2 w-1/3 mx-auto">
                                                <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">タスク登録</button>
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
