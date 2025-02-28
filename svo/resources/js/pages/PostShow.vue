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

  
        <form @submit.prevent="addComment" class="mt-4">
            <textarea v-model="newComment" placeholder="коммент" class="w-full p-2 border rounded"></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Отправить
            </button>
        </form>
    </AppLayout>
</template>

<script setup lang="ts">
import { defineProps, ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';


const props = defineProps({
    post: Object, 
    comments: Array<{ 
        id: number;
        content: string;
        user: {
            username: string;
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

const addComment = async () => {
    await router.post(`/posts/${props.post.id}/comments`, {
        content: newComment.value,
    });
    newComment.value = ''; 
};
</script>