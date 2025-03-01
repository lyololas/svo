<template>
    <Head title="Take Quiz" />
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold mb-4">{{ quiz.title }}</h1>
            <p class="text-gray-600 mb-6">{{ quiz.description }}</p>
            <form @submit.prevent="submit">
                <div v-if="quiz.questions && quiz.questions.length > 0">
                    <div v-for="(question, index) in quiz.questions" :key="question.id" class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">
                            Вопрос {{ index + 1 }}: {{ question.question_text }}
                        </h3>

                        <!-- Display Question Image -->
                        <div v-if="question.image" class="mb-4">
                            <img :src="`/storage/${question.image}`" alt="Question Image" class="w-full h-auto rounded-lg" />
                        </div>

                        <!-- Display Answers -->
                        <div v-if="question.answers && question.answers.length > 0">
                            <div v-for="answer in question.answers" :key="answer.id" class="mb-2">
                                <label class="flex items-center">
                                    <input
                                        type="checkbox"
                                        :name="`question-${question.id}`"
                                        :value="answer.id"
                                        v-model="selectedAnswers[question.id]"
                                        class="mr-2"
                                    />
                                    {{ answer.answer_text }}
                                </label>
                            </div>
                        </div>
                        <div v-else>
                            <p class="text-red-500">Нет ответов</p>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <p class="text-red-500">Вопросов здесь нет.</p>
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    quiz: {
        type: Object,
        required: true,
    },
});

// Initialize selectedAnswers as an object with question IDs as keys and arrays as values
const selectedAnswers = ref({});

// Ensure each question's selected answers are stored as an array
const initializeSelectedAnswers = () => {
    props.quiz.questions.forEach((question) => {
        selectedAnswers.value[question.id] = [];
    });
};

// Call the initialization function when the component is mounted
initializeSelectedAnswers();

const submit = () => {
    const payload = {
        answers: selectedAnswers.value,
    };

    useForm(payload).post(`/quizzes/${props.quiz.id}/complete`);
};
</script>