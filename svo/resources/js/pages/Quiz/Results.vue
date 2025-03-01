<template>
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold mb-4">Результаты!</h1>
            <p class="text-lg">
                You answered <strong>{{ correctAnswers }}</strong> out of
                <strong>{{ totalQuestions }}</strong> questions correctly.
            </p>
            <p v-if="isPerfectScore" class="text-green-600 font-bold mt-4">
                🎉 Поздравляю! Вы получили {{ rewardCoins }} V-монет(ок)!
            </p>
            <p v-else class="text-red-600 font-bold mt-4">
                К сожалению, вы не выполнили все условия! Удачи в следующий раз
            </p>

           
            <button @click="goBack" class="btn btn-primary mt-6">
                Вернуться обратно
            </button>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';


const { quiz, correctAnswers, totalQuestions, isPerfectScore, rewardCoins } = usePage().props;


const goBack = () => {
    router.visit('/quizzes');
};
</script>