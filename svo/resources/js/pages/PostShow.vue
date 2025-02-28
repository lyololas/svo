<template>
    <Head title="Posts" />
    <AppLayout :breadcrumbs="breadcrumbs">
        {{ $page.props.post.description }}
        
            <table>
                <tr v-for="comment in $page.props.comments" :key="comment.id" class="cursor-pointer hover:bg-gray-100">
                    {{ comment.content }}
                </tr>
            </table>
    
    </AppLayout>
</template>

  
  <script setup lang="ts">
  import { defineProps } from 'vue';
  import AppLayout from '@/layouts/AppLayout.vue';
  import { type BreadcrumbItem } from '@/types';
  import { Head, Link } from '@inertiajs/vue3';
  import PlaceholderPattern from '../components/PlaceholderPattern.vue';
  
  const props = defineProps({
      post: Object, 
      comment: Object  
  });
  
  const breadcrumbs: BreadcrumbItem[] = [
      {
          title: 'PostsShow',
          href: '/post1',
      },
  ];
  </script>
  
  