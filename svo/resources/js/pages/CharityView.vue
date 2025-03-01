<template>
    <Head title="Charity" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-6 dark:bg-gray-900 dark:text-white">
            <h1 class="text-4xl font-bold text-center mb-8">{{ charity.name }}</h1>

            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="text-lg font-semibold mb-2">
                    Собрано: {{ formatCurrency(charity.raised_amount) }} из {{ formatCurrency(charity.goal_amount) }}
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4">
                    <div
                        class="bg-blue-500 dark:bg-blue-600 h-4 rounded-full transition-all duration-500"
                        :style="{ width: `${progressPercentage}%` }"
                    ></div>
                </div>
            </div>

            <!-- Money Jar Visualization -->
            <div class="flex justify-center mb-8">
                <div class="relative w-48 h-64 border-4 border-gray-700 dark:border-gray-600 rounded-lg overflow-hidden">
                    <div
                        class="absolute bottom-0 w-full bg-yellow-300 dark:bg-yellow-400 transition-all duration-500"
                        :style="{ height: `${progressPercentage}%` }"
                    ></div>
                    <div class="absolute inset-0 border-4 border-gray-700 dark:border-gray-600 rounded-lg"></div>
                </div>
            </div>

            <!-- Donation Form -->
            <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <div class="mb-4 text-center text-xl font-semibold">
                    {{ timerText }}
                </div>
                
                <h2 class="text-2xl font-semibold mb-4 dark:text-white">Сделать пожертвование</h2>
                <form @submit.prevent="submitDonation" class="space-y-4">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Сумма (в рублях)
                        </label>
                        <input
                            type="number"
                            id="amount"
                            v-model.number="donationAmount"
                            min="1"
                            :max="maxDonation"
                            class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Введите сумму"
                            required
                        />
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Максимум: {{ formatCurrency(maxDonation) }}
                        </p>
                    </div>
                    <button
                        type="submit"
                        class="w-full px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                        :disabled="!isActive || isSubmitting"
                    >
                        <span v-if="!isSubmitting">Сделать пожертвование</span>
                        <span v-else>Обработка...</span>
                    </button>
                </form>
                <div class="mt-4 text-center">
                    <p class="text-lg font-semibold dark:text-white">
                        Вы заработали: {{ coinsEarned.toLocaleString() }} монет
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed, ref, onMounted, onUnmounted } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';

interface Charity {
    id: number;
    name: string;
    description: string;
    goal_amount: number;
    raised_amount: number;
    start_date: string;
    end_date: string;
}

const props = defineProps<{

charity: {
    id: number;
    name: string;
    goal_amount: number;
    raised_amount: number;
    start_date: string;
    end_date: string;
};

user: {
    coins: number;
};

}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Благотворительность', href: '/charity' },
    { title: props.charity.name, href: `/charity/${props.charity.id}` }
];

const donationAmount = ref<number>(0);
const now = ref<Date>(new Date());
const isSubmitting = ref(false);
let timerId: number;

const isActive = computed(() => {
    const start = new Date(props.charity.start_date);
    const end = new Date(props.charity.end_date);
    return now.value >= start && now.value <= end;
});

const maxDonation = computed(() => {
    return Math.max(props.charity.goal_amount - props.charity.raised_amount, 0);
});

const progressPercentage = computed(() => {
    return Number(
        ((props.charity.raised_amount / props.charity.goal_amount) * 100).toFixed(2)
    );
});

const coinsEarned = computed(() => {
    return Math.floor(props.charity.raised_amount / 10);
});

const timerText = computed(() => {
    const start = new Date(props.charity.start_date);
    const end = new Date(props.charity.end_date);
    
    if (now.value < start) {
        const diff = start.getTime() - now.value.getTime();
        return `Начало через: ${formatTime(diff)}`;
    }
    
    if (now.value > end) {
        return 'Мероприятие завершено';
    }
    
    const diff = end.getTime() - now.value.getTime();
    return `Осталось времени: ${formatTime(diff)}`;
});

const formatTime = (milliseconds: number): string => {
    const days = Math.floor(milliseconds / (1000 * 60 * 60 * 24));
    const hours = Math.floor((milliseconds % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((milliseconds % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((milliseconds % (1000 * 60)) / 1000);
    
    return [
        days > 0 ? `${days}д` : null,
        hours > 0 ? `${hours}ч` : null,
        minutes > 0 ? `${minutes}м` : null,
        seconds > 0 ? `${seconds}с` : null
    ].filter(Boolean).join(' ');
};

const formatCurrency = (amount: number): string => {
    return new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: 'RUB',
        minimumFractionDigits: 0
    }).format(amount);
};

onMounted(() => {
    timerId = window.setInterval(() => {
        now.value = new Date();
    }, 1000);
});

onUnmounted(() => {
    clearInterval(timerId);
});
const submitDonation = () => {
router.post(`/charity/${props.charity.id}/donate`, {
    amount: donationAmount.value
}, {
    preserveScroll: true,
    onSuccess: () => {
        donationAmount.value = 0;
    }
});

};
</script>