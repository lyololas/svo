<template>
    <Head title="Создать викторину" />
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold mb-8">Создать новую викторину</h1>

            <!-- Success/Error Message -->
            <div v-if="form.recentlySuccessful" class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                Викторина успешно создана!
            </div>
            <div v-if="form.hasErrors" class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                Ошибка при создании викторины. Пожалуйста, проверьте введенные данные.
            </div>

            <!-- Quiz Form -->
            <form @submit.prevent="submit" class="bg-white p-6 rounded-lg shadow-md">
                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Заголовок</label>
                    <input
                        v-model="form.title"
                        type="text"
                        id="title"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    <InputError :message="form.errors.title" />
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Краткое описание</label>
                    <textarea
                        v-model="form.description"
                        id="description"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        rows="3"
                    ></textarea>
                    <InputError :message="form.errors.description" />
                </div>

                <!-- Reward Coins -->
                <div class="mb-6">
                    <label for="reward_coins" class="block text-sm font-medium text-gray-700 mb-2">Награда (в монетах)</label>
                    <input
                        v-model="form.reward_coins"
                        type="number"
                        id="reward_coins"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    <InputError :message="form.errors.reward_coins" />
                </div>

                <!-- Questions -->
                <div v-for="(question, index) in form.questions" :key="index" class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">Вопрос {{ index + 1 }}</h3>

                    <!-- Question Text -->
                    <div class="mb-6">
                        <label :for="`question-${index}`" class="block text-sm font-medium text-gray-700 mb-2">Вопрос</label>
                        <input
                            v-model="question.question_text"
                            type="text"
                            :id="`question-${index}`"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        />
                        <InputError :message="form.errors[`questions.${index}.question_text`]" />
                    </div>

                    <!-- Question Image -->
                    <div class="mb-6">
                        <label :for="`question-image-${index}`" class="block text-sm font-medium text-gray-700 mb-2">Изображение (опционально)</label>
                        <input
                            type="file"
                            :id="`question-image-${index}`"
                            @change="handleImageUpload(index, $event)"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <InputError :message="form.errors[`questions.${index}.image`]" />
                    </div>

                    <!-- Answers -->
                    <div v-for="(answer, answerIndex) in question.answers" :key="answerIndex" class="mb-4">
                        <label :for="`answer-${index}-${answerIndex}`" class="block text-sm font-medium text-gray-700 mb-2">Ответ {{ answerIndex + 1 }}</label>
                        <input
                            v-model="answer.answer_text"
                            type="text"
                            :id="`answer-${index}-${answerIndex}`"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        />
                        <label class="flex items-center mt-2">
                            <input
                                v-model="answer.is_correct"
                                type="checkbox"
                                class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            />
                            <span class="text-sm text-gray-700">Правильный ответ</span>
                        </label>
                        <InputError :message="form.errors[`questions.${index}.answers.${answerIndex}.answer_text`]" />
                    </div>

                    <!-- Add Answer Button -->
                    <button
                        type="button"
                        @click="addAnswer(index)"
                        class="w-full sm:w-auto px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
                    >
                        Добавить ответ
                    </button>
                </div>

                <!-- Add Question Button -->
                <button
                    type="button"
                    @click="addQuestion"
                    class="w-full sm:w-auto px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors mb-8"
                >
                    Добавить вопрос
                </button>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full px-6 py-3 bg-green-500 text-white rounded-lg font-semibold hover:bg-green-600 transition-colors"
                    :disabled="form.processing"
                >
                    <span v-if="form.processing">Создание...</span>
                    <span v-else>Создать викторину</span>
                </button>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';

const form = useForm({
    title: '',
    description: '',
    reward_coins: 0,
    questions: [
        {
            question_text: '',
            image: null,
            answers: [
                { answer_text: '', is_correct: false },
            ],
        },
    ],
});

const addQuestion = () => {
    form.questions.push({
        question_text: '',
        image: null,
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

const handleImageUpload = (questionIndex, event) => {
    const file = event.target.files[0];
    if (file) {
        form.questions[questionIndex].image = file;
    }
};

const submit = () => {
    form.post('/quizzes', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>