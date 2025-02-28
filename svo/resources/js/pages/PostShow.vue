<template>
    <Head title="Posts" />
    <AppLayout :breadcrumbs="breadcrumbs">
        {{ $page.props.post.description }}
    </AppLayout>
  </template>
  
  <script setup lang="ts">
  import { defineProps } from 'vue';
  import AppLayout from '@/layouts/AppLayout.vue';
  import { type BreadcrumbItem } from '@/types';
  import { Head, Link } from '@inertiajs/vue3';
  import PlaceholderPattern from '../components/PlaceholderPattern.vue';
  
  const breadcrumbs: BreadcrumbItem[] = [
      {
          title: 'PostsShow',
          href: '/post1',
      },
  ];
  
  defineProps<{
      name?: string;
  }>();
  

  </script>
  