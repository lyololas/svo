<template>
    <Head title="Posts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-for="post in $page.props.posts" :key="post.id" class="flex grid grid-cols-5">
            <h1>{{ post.type === 'idea' ? 'Идея' : 'Проект' }}</h1>
            <h1>{{ post.title }}</h1>
            <h1>{{ post.description }}</h1>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
];

defineProps<{
    name?: string;
}>();
</script>
