<template>
    <Head title="ВОИН - Военно-спортивная подготовка" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 bg-[#F7F7F8]">
            <div class="h-96 w-full flex items-center justify-between">
                <div class="w-1/2">
                    <h1 class="text-3xl font-bold mb-4">ВЕКТОР - САЙТ ДЛЯ ПАТРИОТИЧЕСКОГО ВОСПИТАНИЯ МОЛОДЕЖИ</h1>
                    <p class="text-xl mb-8">Цель сайта – подготовить патриотов нового поколения, любящих свою Родину и умеющих ее защищать</p>
                    <button class="bg-[#B71C1C] text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-colors">
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

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-2">ВОЕННЫЙ РФ СПАС РАНЕНЫХ ТОВАРИЩЕЙ ПОД ОБСТРЕЛОМ ВСУ</h3>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <span class="mr-2">Игорь Недорозов</span>
                                <span>•</span>
                                <span class="ml-2">27.02.2025</span>
                            </div>
                            <button class="bg-[#B71C1C] text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-colors">
                                Подробнее
                            </button>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-2">СПЕЦНАЗОВЦЫ ИЗ ЗОНЫ СВО ПОБЛАГОДАРИЛИ ОРЛОВЦЕВ ЗА ПОМОЩЬ</h3>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <span class="mr-2">Ариан Бурцев</span>
                                <span>•</span>
                                <span class="ml-2">21.02.2025</span>
                            </div>
                            <button class="bg-[#B71C1C] text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-colors">
                                Подробнее
                            </button>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-2">ГЕНШТАБ ВСУ ПРИЗНАЛ НАСТУПЛЕНИЕ АРМИИ РФ НА ХЕРСОНСКОМ НАПРАВЛЕНИИ</h3>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <span class="mr-2">Бгор Веселов</span>
                                <span>•</span>
                                <span class="ml-2">27.02.2025</span>
                            </div>
                            <button class="bg-[#B71C1C] text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-colors">
                                Подробнее
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full py-12">
                <div class="max-w-7xl mx-auto px-4">
                    <h2 class="text-3xl font-bold text-left mb-8">ВОИН</h2>
                    <div class="">
                        <div class="bg-white w-full p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">ВОЕННО-СПОРТИВНАЯ ПОДГОТОВКА</h3>
                            <p class="text-gray-700">
                                Курсанты выбирают подготовку в Центре «ВОИН»
                            </p>
                            <button class="bg-[#B71C1C] text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-colors mt-5">
                                Оставить заявку
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
            <div class="w-full py-12">
                <div class="max-w-7xl mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-8">ЧАСТО ЗАДАВАЕМЫЕ ВОПРОСЫ</h2>
                    <div class="space-y-4">
         
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <button
                                @click="toggleFAQ(0)"
                                class="w-full flex justify-between items-center text-left"
                            >
                                <h3 class="text-xl font-semibold">КАК МЫ РАЗВИВАЕМ ПАТРИОТИЗМ?</h3>
                                <span class="text-2xl">{{ activeFAQ === 0 ? '−' : '+' }}</span>
                            </button>
                            <div v-if="activeFAQ === 0" class="mt-4 text-gray-700">
                                Военная подготовка учит дисциплине, организованности и умению работать в команде. Эти качества помогают молодым людям осознать свою роль в защите страны и её интересов. Также в центрах военной подготовки уделяется внимание изучению истории страны, её военных побед и героев. Это помогает укрепить гордость за свою страну и её прошлое.
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <button
                                @click="toggleFAQ(1)"
                                class="w-full flex justify-between items-center text-left"
                            >
                                <h3 class="text-xl font-semibold">КАКИЕ КЛЮЧЕВЫЕ СОБЫТИЯ В ИСТОРИИ СТРАНЫ СЧИТАЮТСЯ НАИБОЛЕЕ ВАЖНЫМИ ДЛЯ ФОРМИРОВАНИЯ ПАТРИОТИЗМА?</h3>
                                <span class="text-2xl">{{ activeFAQ === 1 ? '−' : '+' }}</span>
                            </button>
                            <div v-if="activeFAQ === 1" class="mt-4 text-gray-700">
                                Ключевые события, такие как Великая Отечественная война, победы в крупных сражениях, и героические подвиги наших предков, играют важную роль в формировании патриотизма. Они напоминают о силе и единстве нашей нации.
                            </div>
                        </div>

            
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <button
                                @click="toggleFAQ(2)"
                                class="w-full flex justify-between items-center text-left"
                            >
                                <h3 class="text-xl font-semibold">КАК ПОДГОТОВИТЬСЯ К СЛУЖБЕ В АРМИИ?</h3>
                                <span class="text-2xl">{{ activeFAQ === 2 ? '−' : '+' }}</span>
                            </button>
                            <div v-if="activeFAQ === 2" class="mt-4 text-gray-700">
                                Подготовка включает физическую, тактическую и психологическую подготовку. Курсанты учатся обращаться с оружием, оказывать первую помощь, работать в команде и принимать быстрые решения в экстремальных ситуациях.
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <button
                                @click="toggleFAQ(3)"
                                class="w-full flex justify-between items-center text-left"
                            >
                                <h3 class="text-xl font-semibold">КАК МОЖНО ВНЕСТИ ВКЛАД В РАЗВИТИЕ СВОЕЙ СТРАНЫ?</h3>
                                <span class="text-2xl">{{ activeFAQ === 3 ? '−' : '+' }}</span>
                            </button>
                            <div v-if="activeFAQ === 3" class="mt-4 text-gray-700">
                                Вклад в развитие страны начинается с личной ответственности и активного участия в общественной жизни. Это может быть служба в армии, волонтерство, участие в патриотических мероприятиях или просто стремление быть полезным обществу.
                            </div>
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
                    type="submit"
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
                            <ul class=" flex space-x-3">
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
import { type BreadcrumbItem } from '@/types';
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

const activeFAQ = ref<number | null>(null);

const toggleFAQ = (index: number) => {
    activeFAQ.value = activeFAQ.value === index ? null : index;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

defineProps<{
    name?: string;
}>();
</script>