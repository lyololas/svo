<template>
    <Head title="Quizzes" />
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold mb-4">Викторины</h1>
            <Link href="/quizzes/create" class="btn btn-primary">Создать новый викторину</Link>
            <div class="mt-6">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Заголовок</th>
                            <th class="px-4 py-2">Краткое описание</th>
                            <th class="px-4 py-2">Награда(в монетах)</th>
                            <th class="px-4 py-2">Пройти</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="quiz in quizzes" :key="quiz.id">
                            <td class="border px-4 py-2">{{ quiz.title }}</td>
                            <td class="border px-4 py-2">{{ quiz.description }}</td>
                            <td class="border px-4 py-2">{{ quiz.reward_coins }}</td>
                            <td class="border px-4 py-2">
                                <Link
                                    v-if="!completedQuizIds.includes(quiz.id)"
                                    :href="`/quizzes/${quiz.id}/take`"
                                    class="btn btn-success"
                                >
                                    Пройти квиз
                                </Link>
                                <span v-else class="text-green-600 font-bold">Пройдено!</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    quizzes: {
        type: Array,
        required: true,
    },
    completedQuizIds: {
        type: Array,
        required: true,
    },
});
</script>