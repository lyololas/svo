<template>
    <Head title="Posts" />
    <AppLayout :breadcrumbs="breadcrumbs">
        {{ $page.props.post.description }}
        
        <table>
            <tr v-for="comment in comments" :key="comment.id" class="cursor-pointer hover:bg-gray-100">
                {{ comment.content }}
            </tr>
        </table>

      
        <form @submit.prevent="addComment">
            <textarea v-model="newComment" placeholder="коммент"></textarea>
            <button type="submit">Отправить</button>
        </form>
    </AppLayout>
</template>

<script setup lang="ts">
import { defineProps, ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const props = defineProps({
    post: Object, 
    comments: Array
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
        content: newComment.value
    });
    newComment.value = '';
}; //пж в жизни никогда не буду больше в js перекидывать логику
</script>
