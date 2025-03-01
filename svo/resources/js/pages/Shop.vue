<template>
    <Head title="Shop" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-6 dark:bg-gray-900 dark:text-white">
            <h1 class="text-4xl font-bold text-center mb-8">Магазин</h1>

            <div class="text-center mb-8">
                <p class="text-lg font-semibold dark:text-white">
                    Ваши монеты: <span class="text-yellow-500">{{ user.coins }}</span>
                </p>
            </div>

           
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
                        @click="purchaseItem(item)"
                        :disabled="user.coins < item.price || item.stocks <= 0"
                        class="w-full px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed"
                    >
                        Купить за {{ item.price }} монет
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import axios from 'axios';

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
           
            props.user.coins -= item.price;
            item.stocks -= 1;

            
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
