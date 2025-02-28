<template>
    <Head title="Posts" />
    <AppLayout :breadcrumbs="breadcrumbs">
      <div class="container mx-auto p-4">
        <table class="min-w-full table-auto">
          <thead>
            <tr>
              <th class="px-4 py-2 text-left">Title</th>
              <th class="px-4 py-2 text-left">Description</th>
            </tr>
          </thead>
          <tbody>
            <tr  v-for="post in $page.props.posts" :key="post.id" @click="navigateToPost(post.id)" class="cursor-pointer hover:bg-gray-100">
                <Link v-if="post.is_moderated == 1 " :href="route('post.show', { id: post.id })"><td class="border px-4 py-2">{{ post.title }}</td></Link>
            </tr>
          </tbody>
        </table>
      </div>
    </AppLayout>
  </template>
    
  <script setup lang="ts">
  import { defineProps } from 'vue';
  import AppLayout from '@/layouts/AppLayout.vue';
  import { type BreadcrumbItem } from '@/types';
  import { Head, Link, Inertia } from '@inertiajs/vue3';
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
  