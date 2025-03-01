<template>
    <Head title="Shop" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-6 dark:bg-gray-900 dark:text-white">
            <h1 class="text-4xl font-bold text-center mb-8">Магазин</h1>

            <!-- Display user coins if authenticated -->
            <div v-if="isAuthenticated" class="text-center mb-8">
                <p class="text-lg font-semibold dark:text-white">
                    Ваши монеты: <span class="text-yellow-500">{{ user.coins }}</span>
                </p>
            </div>

            <!-- Shop items grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="item in shopItems"
                    :key="item.id"
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md"
                >
                    <h2 class="text-2xl font-semibold mb-4 dark:text-white">{{ item.name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        {{ item.description }}
                    </p>
                    <p class="text-lg font-semibold mb-4 dark:text-white">
                        Цена: <span class="text-yellow-500">{{ item.price }} монет</span>
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        В наличии: {{ item.stocks }} шт.
                    </p>
                    <button
                        @click="handlePurchase(item)"
                        :disabled="!isAuthenticated || user.coins < item.price || item.stocks <= 0"
                        class="w-full px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed"
                    >
                        Купить за {{ item.price }} монет
                    </button>
                </div>
            </div>
        </div>

        <!-- Dialog for unauthenticated users -->
        <Dialog v-model:open="isAuthDialogOpen">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Войдите или зарегистрируйтесь</DialogTitle>
                    <DialogDescription>
                        Чтобы совершать покупки, пожалуйста, войдите или зарегистрируйтесь.
                    </DialogDescription>
                </DialogHeader>
                <div class="flex justify-end gap-2">
                    <Button @click="router.visit(route('login'))">Войти</Button>
                    <Button @click="router.visit(route('register'))">Зарегистрироваться</Button>
                </div>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ref, computed, onMounted } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
} from '@/components/ui/dialog'; // Ensure this path is correct
import { Button } from '@/components/ui/button'; // Ensure this path is correct

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    shopItems: {
        type: Array,
        required: true,
    },
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Shop',
        href: '/shop',
    },
];

const page = usePage();
const isAuthenticated = computed(() => !!page.props.auth.user); // Check if user is authenticated
const isAuthDialogOpen = ref(false); // Control the visibility of the auth dialog

// Show the auth dialog when the page loads if the user is not authenticated
onMounted(() => {
    if (!isAuthenticated.value) {
        isAuthDialogOpen.value = true;
    }
});

const handlePurchase = (item) => {
    if (!isAuthenticated.value) {
        // If the user is not authenticated, show the auth dialog
        isAuthDialogOpen.value = true;
        return;
    }

    // If the user is authenticated, proceed with the purchase
    purchaseItem(item);
};

const purchaseItem = async (item) => {
    if (props.user.coins < item.price) {
        alert('Недостаточно монет для покупки.');
        return;
    }

    if (item.stocks <= 0) {
        alert('Товар закончился.');
        return;
    }

    try {
        const response = await axios.post('/shop/purchase', {
            item_id: item.id,
        });

        if (response.data.success) {
            // Update user coins and item stock
            props.user.coins -= item.price;
            item.stocks -= 1;

            // Show success message with the code
            alert(`Покупка успешна! Ваш код: ${response.data.code}`);
        } else {
            alert('Ошибка при покупке. Попробуйте снова.');
        }
    } catch (error) {
        console.error('Ошибка при покупке:', error);
        alert('Произошла ошибка. Попробуйте снова.');
    }
};
</script>   