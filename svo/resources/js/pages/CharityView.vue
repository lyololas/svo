<template>
    <Head title="Charity" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="charities.data.length > 0" class="container mx-auto p-6 dark:bg-gray-900 dark:text-white">
            <h1 class="text-4xl font-bold text-center mb-8">Благотворительности</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="charity in charities.data" :key="charity.id" class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-4">{{ charity.name }}</h2>
                    <div class="text-lg font-semibold mb-2">
                        Собрано: {{ formatCurrency(charity.raised_amount) }} из {{ formatCurrency(charity.goal_amount) }}
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4">
                        <div
                            class="bg-blue-500 dark:bg-blue-600 h-4 rounded-full"
                            :style="{ width: `${((charity.raised_amount / charity.goal_amount) * 100).toFixed(2)}%` }"
                        ></div>
                    </div>
                    <p class="text-lg font-semibold mt-4">Статус: {{ charity.status }}</p>
                    
                    <div class="flex gap-2 mt-4">
        <button
            @click="handleDetails(charity)"
            class="w-full px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition-colors"
        >
            Подробнее
        </button>
        
    </div>
                </div>
            </div>

            <div class="flex justify-center mt-8">
                <button
                    @click="fetchCharities(charities.prev_page_url)"
                    :disabled="!charities.prev_page_url"
                    class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                >
                    Предыдущая
                </button>
                <span class="mx-4 text-lg font-semibold dark:text-white">
                    Страница {{ charities.current_page }} из {{ charities.last_page }}
                </span>
                <button
                    @click="fetchCharities(charities.next_page_url)"
                    :disabled="!charities.next_page_url"
                    class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                >
                    Следующая
                </button>
            </div>
        </div>


        <div v-else class="container mx-auto p-6 dark:bg-gray-900 dark:text-white">
            <h1 class="text-4xl font-bold text-center mb-8">Благотворительности недоступны</h1>
            <p class="text-center text-xl">В данный момент нет доступных благотворительных мероприятий.</p>
        </div>

        <Dialog v-model:open="isAuthDialogOpen">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Войдите или зарегистрируйтесь</DialogTitle>
                    <DialogDescription>
                        Чтобы сделать пожертвование, пожалуйста, войдите или зарегистрируйтесь.
                    </DialogDescription>
                </DialogHeader>
                <div class="flex justify-end gap-2">
                    <Button @click="router.visit(route('login'))">Войти</Button>
                    <Button @click="router.visit(route('register'))">Зарегистрироваться</Button>
                </div>
            </DialogContent>
        </Dialog>
        <Dialog v-model:open="isDetailsDialogOpen">
        <DialogContent class="max-w-md">
            <DialogHeader>
                <DialogTitle class="text-2xl">{{ selectedCharity?.name }}</DialogTitle>
            </DialogHeader>
            
            <div class="space-y-4">
                <p class="text-gray-600 dark:text-gray-300">{{ selectedCharity?.description }}</p>
                
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Сумма пожертвования (рубли)
                    </label>
                    <input
                        type="number"
                        v-model.number="donationAmount"
                        :min="1"
                        :max="selectedCharity ? selectedCharity.goal_amount - selectedCharity.raised_amount : 0"
                        class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Введите сумму"
                    />
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Максимум: {{ selectedCharity ? formatCurrency(selectedCharity.goal_amount - selectedCharity.raised_amount) : 0 }}
                    </p>
                </div>
                
                <button
                    @click="handleDonation(selectedCharity?.id)"
                    class="w-full px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                    :disabled="!donationAmount || isSubmitting"
                >
                    <span v-if="!isSubmitting">Пожертвовать {{ formatCurrency(donationAmount) }}</span>
                    <span v-else>Обработка...</span>
                </button>
            </div>
        </DialogContent>
    </Dialog>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed, ref, onMounted } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
} from '@/components/ui/dialog'; // Ensure this path is correct
import { Button } from '@/components/ui/button'; // Ensure this path is correct

interface Charity {
    id: number;
    name: string;
    description: string;
    goal_amount: number;
    raised_amount: number;
    start_date: string;
    end_date: string;
    status: string;
}

interface PaginatedCharities {
    data: Charity[];
    current_page: number;
    last_page: number;
    prev_page_url: string | null;
    next_page_url: string | null;
}

const props = defineProps<{
    charities: PaginatedCharities;
    user: {
        coins: number;
    };
}>();


const isAuthDialogOpen = ref(false); 
const isDetailsDialogOpen = ref(false); 
const selectedCharity = ref<Charity | null>(null); 
const donationAmount = ref(0); 
const donationError = ref(''); 
const isSubmitting = ref(false); 

const page = usePage();
const isAuthenticated = computed(() => !!page.props.auth.user);

const formatCurrency = (amount: number): string => {
    return new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: 'RUB',
        minimumFractionDigits: 0
    }).format(amount);
};

const fetchCharities = (url: string | null) => {
    if (url) {
        router.visit(url, {
            preserveState: true,
            preserveScroll: true
        });
    }
};

const maxDonation = computed(() => {
    if (!selectedCharity.value) return 0;
    return Math.max(selectedCharity.value.goal_amount - selectedCharity.value.raised_amount, 0);
});

const donationAmountValid = computed(() => {
    return donationAmount.value > 0 && donationAmount.value <= maxDonation.value;
});

const handleDetails = (charity: Charity) => {
    selectedCharity.value = charity;
    donationAmount.value = 0;
    donationError.value = '';
    isDetailsDialogOpen.value = true;
};

const handleDonation = async (charityId?: number) => {
    if (!isAuthenticated.value) {
        isAuthDialogOpen.value = true;
        return;
    }

    if (!charityId || !donationAmountValid.value) {
        donationError.value = 'Введите корректную сумму';
        return;
    }

    isSubmitting.value = true;
    donationError.value = '';

    try {
        await router.post(`/charity/${charityId}/donate`, {
            amount: donationAmount.value
        }, {
            preserveScroll: true,
            onSuccess: () => {
                isDetailsDialogOpen.value = false;
                donationAmount.value = 0;
            },
            onError: () => {
                donationError.value = 'Ошибка при выполнении пожертвования';
            }
        });
    } finally {
        isSubmitting.value = false;
    }
};

onMounted(() => {
    if (!isAuthenticated.value) {
        isAuthDialogOpen.value = true;
    }
});
</script>