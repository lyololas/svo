<template>
    <Head title="ВОИН - Военно-спортивная подготовка" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 bg-[#F7F7F8]">
            <div class="h-96 w-full flex items-center justify-between">
                <div class="w-1/2">
                    <h1 class="text-3xl font-bold mb-4">ВЕКТОР - САЙТ ДЛЯ ПАТРИОТИЧЕСКОГО ВОСПИТАНИЯ МОЛОДЕЖИ</h1>
                    <p class="text-xl mb-8">Цель сайта – подготовить патриотов нового поколения, любящих свою Родину и умеющих ее защищать</p>
                    <button
                        @click="router.visit(route('register'))"
                        class="bg-[#B71C1C] text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-colors"
                    >
                        Узнать подробнее
                    </button>
                </div>
                <div class="w-1/2 flex justify-end">
                    <img src="img/borders.svg" alt="Borders" class="h-full object-cover">
                </div>
            </div>

            <div class="w-full py-12">
                <div class="max-w-7xl mx-auto px-4">
                    <h2 class="text-3xl font-bold text-left mb-8">НОВОСТИ</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div
                            v-for="newsItem in newsItems"
                            :key="newsItem.id"
                            class="bg-white p-6 rounded-lg shadow-md"
                        >
                            <h3 class="text-xl font-semibold mb-2">{{ newsItem.title }}</h3>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <span class="mr-2">{{ newsItem.author }}</span>
                                <span class="ml-2">{{ newsItem.description }}</span>
                            </div>
                            <button
                                @click="router.visit(route('news'))"
                                class="bg-[#B71C1C] text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-colors"
                            >
                                Подробнее
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full py-12">
                <div class="max-w-7xl mx-auto px-4">
                    <h2 class="text-3xl font-bold text-left mb-8">ПОЧЕМУ ВОИН?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">ПРОФЕССИОНАЛЬНЫЕ ИНСТРУКТОРЫ</h3>
                            <p class="text-gray-700">
                                В Центре «ВОИН» работают более 400 опытных инструкторов. Они прошли подготовку в Российском университете спецназа, Иолодемном многофункциональном патриотическом центре «Машук» и МПГУ. Многие из них имеют боевой опыт, а также высшие госнаграды.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">ТЕХНИЧЕСКОЕ ОСНАЩЕНИЕ</h3>
                            <p class="text-gray-700">
                                В региональных отделениях центра «ВОИН» есть необходимое оборудование и техника, чтобы успешно обучать курсантов военно-прикладным навыкам, например – управлению БПЛА, огневой, тактической и инженерной подготовке, оказанию первой помощи, прыжкам с парашютной вышки и другим.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">УЛУЧШЕНИЕ ФИЗИЧЕСКОЙ ФОРМЫ</h3>
                            <p class="text-gray-700">
                                Улучшите здоровье и физические показатели: выносливость, силу, ловкость, быстроту, меткость и другие. Поймете, как эффективно работать в команде, и повысите коммуникативный опыт, скорость принятия решений. Найдете близких по духу и друзей, на которых можете положиться в сложные жизненные минуты.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full py-12">
                <div class="max-w-7xl mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-8">ОТЗЫВЫ</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                   
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold">Найти Прыгнов</h3>
                                <div class="flex space-x-1">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                </div>
                            </div>
                            <p class="text-gray-700">
                                Считаю, что каждый юноша должен пройти военную подготовку, а Центр отлично в этом помогает. Инструкторский состав уникален, каждый - мастер своего направления. Рад, что смог получить знания от таких опытных наставников.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold">Взял Иванов</h3>
                                <div class="flex space-x-1">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-gray-300">★</span>
                                </div>
                            </div>
                            <p class="text-gray-700">
                                Нас учили, что надо делать на слово боль, особенно мне понравились занятия по тактической медицине. Полученные знания, я думаю, очень пригодятся мне в жизни, которую я намереваюсь связать с силовыми структурами.
                            </p>
                        </div>

                    
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold">Свет Петров</h3>
                                <div class="flex space-x-1">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-yellow-400">★</span>
                                </div>
                            </div>
                            <p class="text-gray-700">
                                Инструкторы действительно дают уникальные навыки по военному делу. Проходя подготовку в Центре «ВОИН», ты точно знаешь, что тебе ждет на службе в армии или в силовой структуре. Инструкторы для нас как отцы и наставники.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        
            <div class="w-full py-12 bg-white">
                <div class="max-w-7xl mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-8">ОСТАЛИСЬ ВОПРОСЫ?</h2>
                    <div class="text-center mb-8">
                        <p class="text-gray-600">Напишите нам, и мы свяжемся с вами в ближайшее время.</p>
                    </div>
                    <form class="max-w-4xl mx-auto">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                       
                            <input
                                type="text"
                                placeholder="Имя"
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
               
                            <input
                                type="email"
                                placeholder="Почта"
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                 
                            <input
                                type="tel"
                                placeholder="Телефон"
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                           
                            <button
                                type="button"
                                @click="window.location.href = 'https://yakutiya.crvsp.ru/'"
                                class="w-full bg-[#B71C1C] text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition-colors"
                            >
                                Оставить заявку
                            </button>
                        </div>
                        <p class="text-sm text-gray-500 mt-4 text-center">
                            Заполняя данную форму, вы даете согласие на обработку персональных данных и соглашаетесь с политикой конфиденциальности.
                        </p>
                    </form>
                </div>
            </div>


            <footer class="w-full py-8 text-center">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <ul class="flex space-x-3">
                                <li><a href="#" class="hover:text-gray-400">Контакты</a></li>
                                <li><a href="#" class="hover:text-gray-400">Проекты</a></li>
                                <li><a href="#" class="hover:text-gray-400">Региональные отделения</a></li>
                            </ul>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">
                                ©2025 "ВЕКТОР". Все права защищены.
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';


defineProps<{
    newsItems: Array<{
        id: number;
        title: string;
        description: string;
        image: string;
        author: string;
        published_at: string;
    }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('ru-RU');
};
</script>