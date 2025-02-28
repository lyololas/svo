<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router, Link } from '@inertiajs/vue3'; 
import { ref, computed } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
} from '@/components/ui/dialog'; 
import { Button } from '@/components/ui/button'; 
import { Input } from '@/components/ui/input'; 
import { Label } from '@/components/ui/label'; 

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];


const isDialogOpen = ref(false);


const newPost = ref({
    title: '',
    description: '',
    image: null as File | null, 
});

const { posts } = defineProps<{
    posts: Array<{
        id: number;
        title: string;
        description: string;
        image: string | null;
        created_at: string;
        is_moderated: number;
    }>;
}>();


const moderatedPosts = computed(() => posts.filter(post => post.is_moderated === 1));


const submitPost = async () => {
    const formData = new FormData();
    formData.append('title', newPost.value.title);
    formData.append('description', newPost.value.description);
    if (newPost.value.image) {
        formData.append('image', newPost.value.image);
    }

    await router.post('/posts', formData, {
        forceFormData: true, 
    });

    isDialogOpen.value = false; 
    newPost.value = { title: '', description: '', image: null }; 
};


const handleFileChange = (event: Event) => {
    const input = event.target as HTMLInputElement;
    if (input.files && input.files[0]) {
        newPost.value.image = input.files[0]; 
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <Button @click="isDialogOpen = true" class="mb-4">
                Создать новый пост
            </Button>


            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div 
                    v-for="post in moderatedPosts" 
                    :key="post.id" 
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <Link 
                        :href="route('post.show', { id: post.id })"
                        class="block w-full h-full"
                    >

                        <div v-if="post.image" class="w-full h-full">
                            <img :src="`/storage/${post.image}`" alt="Post Image" class="w-full h-full object-cover" />
                        </div>


                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 p-4 text-white">
                            <h2 class="text-lg font-semibold">{{ post.title }}</h2>
                            <p class="text-sm">{{ post.description }}</p>
                            <p class="text-xs text-gray-300">{{ new Date(post.created_at).toLocaleDateString() }}</p>
                        </div>
                    </Link>
                </div>
            </div>

            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>

      
        <Dialog v-model:open="isDialogOpen">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Создать пост</DialogTitle>
                    <DialogDescription>
                        Заполните форму для поста
                    </DialogDescription>
                </DialogHeader>

             
                <form @submit.prevent="submitPost" class="space-y-4">
                    <div>
                        <Label for="title">Заголовок</Label>
                        <Input id="title" v-model="newPost.title" placeholder="Напишите заголовок..." required />
                    </div>
                    <div>
                        <Label for="description">Описание</Label>
                        <Input id="description" v-model="newPost.description" placeholder="Опишите" required />
                    </div>
                    <div>
                        <Label for="image">Изображение(не обязательно)</Label>
                        <Input id="image" type="file" @change="handleFileChange" accept="image/*" />
                    </div>
                    <Button type="submit" class="w-full">
                        Submit
                    </Button>
                </form>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>