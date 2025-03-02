<template>
    <Head title="Quizzes" />
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Викторины</h1>
            

           
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Заголовок
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Краткое описание
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Награда (в монетах)
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Действие
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="quiz in quizzes" :key="quiz.id" class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-800 font-medium">
                                {{ quiz.title }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ quiz.description }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ quiz.reward_coins }} 🪙
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <button
                                    v-if="!completedQuizIds.includes(quiz.id)"
                                    @click="handleTakeQuiz(quiz.id)"
                                    class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition-colors"
                                >
                                    Пройти квиз
                                </button>
                                <span v-else class="text-green-600 font-bold">Пройдено! 🎉</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

     
        <Dialog v-model:open="isAuthDialogOpen">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle class="text-xl font-bold text-gray-800">
                        Войдите или зарегистрируйтесь
                    </DialogTitle>
                    <DialogDescription class="text-gray-600">
                        Чтобы пройти викторину, пожалуйста, войдите или зарегистрируйтесь.
                    </DialogDescription>
                </DialogHeader>
                <div class="flex justify-end gap-2 mt-4">
                    <Button
                        @click="router.visit(route('login'))"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors"
                    >
                        Войти
                    </Button>
                    <Button
                        @click="router.visit(route('register'))"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors"
                    >
                        Зарегистрироваться
                    </Button>
                </div>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>

<script setup>
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, computed, onMounted } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
} from '@/components/ui/dialog'; 
import { Button } from '@/components/ui/button'; 

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

const page = usePage();
const isAuthenticated = computed(() => !!page.props.auth.user); 
const isAuthDialogOpen = ref(false); 


onMounted(() => {
    if (!isAuthenticated.value) {
        isAuthDialogOpen.value = true;
    }
});

const handleTakeQuiz = (quizId) => {
    if (!isAuthenticated.value) {
        isAuthDialogOpen.value = true;
        return;
    }
    router.visit(`/quizzes/${quizId}/take`);
};
</script>