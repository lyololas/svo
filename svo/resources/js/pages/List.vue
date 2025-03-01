<template>
    <Head title="Charity Events" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-6 dark:bg-gray-900 dark:text-white">
            <h1 class="text-4xl font-bold text-center mb-8">Charity Events</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div 
                    v-for="charity in charities"
                    :key="charity.id"
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md"
                >
                    <h2 class="text-2xl font-semibold mb-4 dark:text-white">{{ charity.name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ charity.description }}</p>
                    
                    <div class="mb-4">
                        <div class="text-sm font-semibold">
                            Event Timer:
                            <span class="text-blue-500">{{ formatTimeRemaining(charity) }}</span>
                        </div>
                    </div>
                    
                    <Link 
                        :href="`/charity/${charity.id}`"
                        class="w-full px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700"
                    >
                        View Details
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { computed } from 'vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps({
    charities: {
        type: Array,
        required: true
    }
});

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Charity', href: '/charity' }
];

const formatTimeRemaining = (charity) => {
    const now = new Date();
    const startDate = new Date(charity.start_date);
    const endDate = new Date(charity.end_date);

    if (now < startDate) {
        const diff = startDate - now;
        return `Starts in ${formatDuration(diff)}`;
    } else if (now < endDate) {
        const diff = endDate - now;
        return `Ends in ${formatDuration(diff)}`;
    }
    return 'Event Ended';
};

const formatDuration = (milliseconds) => {
    const days = Math.floor(milliseconds / (1000 * 60 * 60 * 24));
    const hours = Math.floor((milliseconds % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((milliseconds % (1000 * 60 * 60)) / (1000 * 60));
    return `${days}d ${hours}h ${minutes}m`;
};
</script>