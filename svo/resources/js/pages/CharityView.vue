<template>
    <Head title="Charity" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-6 dark:bg-gray-900 dark:text-white">
            <h1 class="text-4xl font-bold text-center mb-8">Поддержите!</h1>

            <div class="mb-8">
                <div class="text-lg font-semibold mb-2">
                    Собрано: {{ raisedAmount }} из {{ goalAmount }}
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4">
                    <div
                        class="bg-blue-500 dark:bg-blue-600 h-4 rounded-full"
                        :style="{ width: progressPercentage + '%' }"
                    ></div>
                </div>
            </div>

            <div class="flex justify-center mb-8">
                <div class="relative w-48 h-64 border-4 border-gray-700 dark:border-gray-600 rounded-lg overflow-hidden">
                    <div
                        class="absolute bottom-0 w-full bg-yellow-300 dark:bg-yellow-400"
                        :style="{ height: progressPercentage + '%' }"
                    ></div>

                    <div class="absolute inset-0 border-4 border-gray-700 dark:border-gray-600 rounded-lg"></div>
                </div>
            </div>


            <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4 dark:text-white">Сделать пожертвование</h2>
                <form @submit.prevent="submitDonation" class="space-y-4">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Сумма (в рублях)</label>
                        <input
                            type="number"
                            id="amount"
                            v-model="donationAmount"
                            class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter amount"
                            required
                        />
                    </div>
                    <button
                        type="submit"
                        class="w-full px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700"
                    >
                        Сделать пожертвование
                    </button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Charity',
        href: '/charity',
    },
];


const goalAmount = ref(10000); 
const raisedAmount = ref(4500); 

// Donation Amount
const donationAmount = ref(0);


const progressPercentage = computed(() => {
    return ((raisedAmount.value / goalAmount.value) * 100).toFixed(2);
});


const submitDonation = () => {
    if (donationAmount.value > 0) {
        raisedAmount.value += donationAmount.value; 
        donationAmount.value = 0; 
        alert('Спасибо за вашу поддержку!');
    } else {
        alert('Пожалуйста, введите коректную сумму(без символов).');
    }
};
</script>

<style scoped>
.money-jar {
    background: linear-gradient(to top, #fbbf24, #f59e0b);
}
</style>