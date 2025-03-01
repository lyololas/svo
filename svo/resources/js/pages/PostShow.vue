<template>
    <Head title="Posts" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h1 class="text-2xl font-bold mb-2">{{ post.title }}</h1>
            <p class="text-gray-600 mb-4">{{ post.description }}</p>
            <div class="flex items-center text-sm text-gray-500">
                <span class="mr-4">Theme: {{ post.theme }}</span>
                <span>Posted on: {{ new Date(post.created_at).toLocaleDateString() }}</span>
            </div>
            <div v-if="post.image" class="mt-4">
                <img :src="`/storage/${post.image}`" alt="Post Image" class="w-full h-auto rounded-lg" />
            </div>
        </div>


        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Comments</h2>

 
            <div class="space-y-4">
                <div v-for="comment in comments" :key="comment.id" class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                            <span class="text-gray-600">{{ comment.user.name.charAt(0) }}</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="font-semibold">{{ comment.user.name }}</span>
                            <p class="text-gray-700 mt-1">{{ comment.content }}</p>
                        </div>
                        <div class="text-sm text-gray-500 mt-2">
                            {{ new Date(comment.created_at).toLocaleDateString() }}
                        </div>
                    </div>
                </div>
            </div>


            <form @submit.prevent="handleAddComment" class="mt-6">
                <textarea
                    v-model="newComment"
                    placeholder="Write your comment..."
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="3"
                ></textarea>
                <button
                    type="submit"
                    class="mt-3 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
                >
                    Отправить
                </button>
            </form>
        </div>

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
import { Head, router, usePage } from '@inertiajs/vue3';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
} from '@/components/ui/dialog'; 
import { Button } from '@/components/ui/button'; 

const props = defineProps({
    post: Object, 
    comments: Array<{
        id: number;
        content: string;
        created_at: string;
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
const page = usePage();

const handleAddComment = () => {
    if (!page.props.auth.user) {
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