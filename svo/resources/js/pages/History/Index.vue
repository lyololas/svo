<template>
    <Head title="History" />
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">История</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="historyItem in historyItems"
                    :key="historyItem.id"
                    class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:shadow-lg transition-shadow"
                    @click="openDialog(historyItem)"
                >
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800">
                            {{ historyItem.title }}
                        </h2>
                    </div>
                </div>
            </div>

        
            <Dialog v-model:open="isDialogOpen">
                <DialogContent class="sm:max-w-2xl">
                    <DialogHeader>
                        <DialogTitle class="text-2xl font-bold text-gray-800">
                            {{ selectedHistory?.title }}
                        </DialogTitle>
                    </DialogHeader>
                    <div class="space-y-4">
                       
                        <img
                            v-if="selectedHistory?.image"
                            :src="selectedHistory.image"
                            :alt="selectedHistory.title"
                            class="w-full h-64 object-cover rounded-lg"
                        />

                    
                        <p class="text-gray-600">
                            {{ selectedHistory?.description }}
                        </p>
                    </div>
                </DialogContent>
            </Dialog>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'; 

defineProps({
    historyItems: {
        type: Array,
        required: true,
    },
});

const selectedHistory = ref(null);
const isDialogOpen = ref(false);

function openDialog(historyItem) {
    selectedHistory.value = historyItem;
    isDialogOpen.value = true;
}
</script>