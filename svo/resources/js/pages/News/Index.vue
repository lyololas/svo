<template>
    <Head title="News" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-6 dark:bg-gray-900 dark:text-white">
            <h1 class="text-4xl font-bold text-center mb-8">News</h1>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="newsItem in newsItems"
                    :key="newsItem.id"
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md cursor-pointer"
                    @click="openDialog(newsItem)"
                >
                  
                    <img
                        :src="newsItem.image"
                        :alt="newsItem.title"
                        class="w-full h-48 object-cover rounded-lg mb-4"
                    />

       
                    <h2 class="text-2xl font-semibold mb-4 dark:text-white">
                        {{ newsItem.title }}
                    </h2>

               
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        {{ truncateDescription(newsItem.description, 100) }}
                    </p>

               
                    <div class="flex items-center justify-between">
                        <button
                            @click.stop="toggleLike(newsItem)"
                            class="flex items-center space-x-2 text-gray-600 dark:text-gray-300 hover:text-red-500 dark:hover:text-red-400"
                        >
                            <span v-if="newsItem.is_liked" class="text-red-500">
                                ❤️
                            </span>
                            <span v-else>
                                🤍
                            </span>
                            <span>{{ newsItem.likes_count }} Likes</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <Dialog v-model:open="isDialogOpen">
            <DialogContent class="sm:max-w-2xl">
                <DialogHeader>
                    <DialogTitle class="text-2xl font-bold">
                        {{ selectedNewsItem?.title }}
                    </DialogTitle>
                </DialogHeader>
                <div class="space-y-4">
                  
                    <img
                        :src="selectedNewsItem?.image"
                        :alt="selectedNewsItem?.title"
                        class="w-full h-64 object-cover rounded-lg"
                    />

                    <p class="text-gray-600 dark:text-gray-300">
                        {{ selectedNewsItem?.description }}
                    </p>

      
                    <div class="flex items-center justify-between">
                        <button
                            @click="toggleLike(selectedNewsItem)"
                            class="flex items-center space-x-2 text-gray-600 dark:text-gray-300 hover:text-red-500 dark:hover:text-red-400"
                        >
                            <span v-if="selectedNewsItem?.is_liked" class="text-red-500">
                                ❤️
                            </span>
                            <span v-else>
                                🤍
                            </span>
                            <span>{{ selectedNewsItem?.likes_count }} Likes</span>
                        </button>
                    </div>
                </div>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'; 


const props = defineProps({
    newsItems: {
        type: Array,
        required: true,
    },
});


const breadcrumbs = [
    {
        title: 'News',
        href: '/news',
    },
];


const isDialogOpen = ref(false);
const selectedNewsItem = ref(null);


const openDialog = (newsItem) => {
    selectedNewsItem.value = newsItem;
    isDialogOpen.value = true;
};


const truncateDescription = (text, maxLength) => {
    return text.length > maxLength ? text.slice(0, maxLength) + '...' : text;
};


const toggleLike = async (newsItem) => {
    try {
        const response = await router.post(`/news/${newsItem.id}/like`, {}, {
            preserveScroll: true, 
            onSuccess: (response) => {
                
                newsItem.is_liked = response.props.newsItem.is_liked;
                newsItem.likes_count = response.props.newsItem.likes_count;

              
                if (selectedNewsItem.value?.id === newsItem.id) {
                    selectedNewsItem.value.is_liked = response.props.newsItem.is_liked;
                    selectedNewsItem.value.likes_count = response.props.newsItem.likes_count;
                }
            },
            onError: (errors) => {
                console.error('Error toggling like:', errors);
                alert('Failed to toggle like. Please try again.');
            },
        });
    } catch (error) {
        console.error('Error toggling like:', error);
        alert('Failed to toggle like. Please try again.');
    }
};
</script>
