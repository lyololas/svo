<template>
    <Head title="Создать викторину" />
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold mb-4">Создать новую викторину</h1>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Заголовок</label>
                    <input v-model="form.title" type="text" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Краткое описание</label>
                    <textarea v-model="form.description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>
                <div class="mb-4">
                    <label for="reward_coins" class="block text-sm font-medium text-gray-700">Награда(в монетах)</label>
                    <input v-model="form.reward_coins" type="number" id="reward_coins" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div>

                <!-- Questions -->
                <div v-for="(question, index) in form.questions" :key="index" class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Question {{ index + 1 }}</h3>
                    <div class="mb-4">
                        <label :for="`question-${index}`" class="block text-sm font-medium text-gray-700">Вопрос</label>
                        <input v-model="question.question_text" type="text" :id="`question-${index}`" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                    </div>

                    <!-- Answers -->
                    <div v-for="(answer, answerIndex) in question.answers" :key="answerIndex" class="mb-4">
                        <label :for="`answer-${index}-${answerIndex}`" class="block text-sm font-medium text-gray-700">Ответ {{ answerIndex + 1 }}</label>
                        <input v-model="answer.answer_text" type="text" :id="`answer-${index}-${answerIndex}`" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                        <label>
                            <input v-model="answer.is_correct" type="checkbox" class="mr-2" />
                            Правильный ответ
                        </label>
                    </div>
                    <button type="button" @click="addAnswer(index)" class="btn btn-secondary">Добавить ответ</button>
                </div>
                <button type="button" @click="addQuestion" class="btn btn-secondary">Лобавить вопрос</button>

                <button type="submit" class="btn btn-primary">Создать викторину</button>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    reward_coins: 0,
    questions: [
        {
            question_text: '',
            answers: [
                { answer_text: '', is_correct: false },
            ],
        },
    ],
});

const addQuestion = () => {
    form.questions.push({
        question_text: '',
        answers: [
            { answer_text: '', is_correct: false },
        ],
    });
};

const addAnswer = (questionIndex) => {
    form.questions[questionIndex].answers.push({
        answer_text: '',
        is_correct: false,
    });
};

const submit = () => {
    form.post('/quizzes', {
        onSuccess: () => {
            alert('Quiz created successfully!');
        },
        onError: () => {
            alert('Failed to create the quiz.');
        },
    });
};
</script>