<template>
    <div class="comment">
      <p>{{ comment.content }}</p>
      <small>{{ comment.created_at }}</small>
    </div>
  </template>
  
  <script setup lang="ts">
  import { defineProps } from 'vue';
  
  const props = defineProps({
    comment: Object,
  });
  </script>