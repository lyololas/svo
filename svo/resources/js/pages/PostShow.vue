<template>
    <Head title="Posts" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div>{{ $page.props.post.description }}</div>

        <table class="w-full">
            <tr v-for="comment in comments" :key="comment.id" class="cursor-pointer hover:bg-gray-100">
                <td class="border px-4 py-2">
                    <span class="font-semibold">{{ comment.user.name }}</span>: {{ comment.content }}
                </td>
            </tr>
        </table>

        <!-- Comment Form -->
        <form @submit.prevent="handleAddComment" class="mt-4">
            <textarea
                v-model="newComment"
                placeholder="коммент"
                class="w-full p-2 border rounded"
                
            ></textarea>
            <button
                type="submit"
                class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                
            >
                Отправить
            </button>
        </form>

        <Dialog v-model:open="isAuthDialogOpen">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Войдите или зарегистрируйтесь</DialogTitle>
                    <DialogDescription>
                        Чтобы оставить комментарий, пожалуйста, войдите или зарегистрируйтесь.
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

<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
} from '@/components/ui/dialog'; // Ensure this path is correct
import { Button } from '@/components/ui/button'; // Ensure this path is correct

const props = defineProps({
    post: Object, // The post object
    comments: Array<{
        id: number;
        content: string;
        user: {
            name: string;
        };
    }>,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'PostsShow',
        href: '/post1',
    },
];

const newComment = ref('');
const isAuthDialogOpen = ref(false);

const handleAddComment = () => {
    if (!$page.props.auth.user) {
        isAuthDialogOpen.value = true;
        return;
    }
    addComment();
};

const addComment = async () => {
    await router.post(`/posts/${props.post.id}/comments`, {
        content: newComment.value,
    });
    newComment.value = '';  
};
</script>