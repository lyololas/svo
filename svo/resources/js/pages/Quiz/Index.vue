<template>
    <Head title="Quizzes" />
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold mb-4">Викторины</h1>
            <Link v-if="isAuthenticated" href="/quizzes/create" class="btn btn-primary">Создать новый викторину</Link>
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
                                <button
                                    v-if="!completedQuizIds.includes(quiz.id)"
                                    @click="handleTakeQuiz(quiz.id)"
                                    class="btn btn-success"
                                >
                                    Пройти квиз
                                </button>
                                <span v-else class="text-green-600 font-bold">Пройдено!</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Dialog for unauthenticated users -->
        <Dialog v-model:open="isAuthDialogOpen">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Войдите или зарегистрируйтесь</DialogTitle>
                    <DialogDescription>
                        Чтобы пройти викторину, пожалуйста, войдите или зарегистрируйтесь.
                    </DialogDescription>
                </DialogHeader>
                <div class="flex justify-end gap-2">
                    <Button @click="router.visit(route('login'))">Войти</Button>
                    <Button @click="router.visit(route('register'))">Зарегистрироваться</Button>
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
} from '@/components/ui/dialog'; // Ensure this path is correct
import { Button } from '@/components/ui/button'; // Ensure this path is correct

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
const isAuthenticated = computed(() => !!page.props.auth.user); // Check if user is authenticated
const isAuthDialogOpen = ref(false); // Control the visibility of the auth dialog

// Show the auth dialog when the page loads if the user is not authenticated
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