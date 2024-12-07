<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

import Registration from "./auth/Registration.vue";
import Login from "./auth/Login.vue";
import Footer from "./Footer.vue";

const nickname = ref('');
const token = localStorage.getItem('token');

onMounted(() => {
    if (token) {
        axios
            .get('/api/user', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => {
                nickname.value = response.data.name;  // Зберігаємо нікнейм
            })
            .catch(error => {
                console.log('Unauthorized: Invalid token');
                localStorage.removeItem('token');  // Видаляємо токен у разі помилки
            });
    }
});
</script>

<template>
    <div class="content">
        <registration></registration>
        <login></login>

        <div class="container">
            <header>
                <nav>
                    <div class="menu">
                        <div class="menu-icon" onclick="toggleMenu()">☰</div>
                        <ul class="nav__items">
                            <li class="nav__item"><a href="">Головна</a></li>
                            <li class="nav__item"><a href="">Блог</a></li>
                            <li class="nav__item"><a href="">Про платформу</a></li>
                            <li class="nav__item"><a href="">Контакти</a></li>
                        </ul>
                    </div>
                    <div class="buttons">
                        <!-- Якщо токен є, показуємо нікнейм -->
                        <router-link v-if="token" :to="{ name: 'Home' }" class="button btn-transparrent btn-adaptive">{{ nickname || 'Завантаження...' }}</router-link>
                        <a v-if="!token" onclick="openModal('registration')" href="#" class="button btn-adaptive">Зареєструватися</a>
                        <a v-if="!token" onclick="openModal('login')" href="#" class="button btn-transparrent btn-adaptive">Увійти</a>
                    </div>
                </nav>
            </header>
            <main>
                <span class="bg-circle"></span>
                <span class="bg-circle bg-circle-blue"></span>
                <div class="main__content">
                    <h1 class="title">Вивчай англійську.</h1>
                    <div class="doings">
                        <div class="doings__item">
                            <h4>Дивись фільми на англійській</h4>
                            <img src="/emojies/eye.svg" alt="Eye">
                        </div>
                        <div class="doings__item">
                            <h4>Розмовляй англійською</h4>
                            <img src="/emojies/speak.svg" alt="Speak">
                        </div>
                        <div class="doings__item">
                            <h4>Думай англійською</h4>
                            <img src="/emojies/brain.svg" alt="Brain">
                        </div>
                    </div>
                    <span class="hr"></span>

                    <div class="propositions">
                        <div class="propositions__item">
                            <p>
                                Запишись на безкоштовний
                                пробний урок та отримай бонуси
                            </p>
                            <a href="#" class="button">Записатися</a>
                        </div>
                        <div class="propositions__item">
                            <p>
                                Чому вчитися з нами
                                ефективніше, ніж із репетитором
                            </p>
                            <a href="#" class="button btn-transparrent">Дізнатися</a>
                        </div>
                    </div>
                </div>
            </main>
            <section class="learn-english">
                <div class="learn-english__content">
                    <div class="learn-english__block">
                            <span class="learn-english__prefix">
                                Freedom
                            </span>
                        <span class="learn-english__name">
                                вчити англійську як хочеш
                            </span>
                    </div>
                    <p class="learn-english__subprefix">Ми — не просто онлайн-школа з репетиторами, а екосистема вивчення англійської:</p>

                    <ul class="box-list">
                        <li class="list__items">
                            <img src="/emojies/backhand.svg" alt="backhand">
                            <p>навчайся хоч з ноуту, хоч зі смартфону</p>
                        </li>
                        <li class="list__items">
                            <img src="/emojies/backhand.svg" alt="backhand">
                            <p> вивчай мову з perfect teacher match</p>
                        </li>
                        <li class="list__items">
                            <img src="/emojies/backhand.svg" alt="backhand">
                            <p> додатково прокачуйся на спікінг-клабах, онлайн-курсах й інших активностях</p>
                        </li>
                    </ul>
                </div>
            </section>
            <section class="test-proposition">
                <div class="test-proposition__card">
                    <div class="test-proposition__items">
                        <p class="test-proposition__title">Круто, якщо ти знаєш свій рівень англійської. А якщо ні — <span class="test-proposition__title__blue">ми поруч ;)</span></p>
                    </div>
                    <div class="test-proposition__items">
                        <p class="test-proposition_subtitle">Проведемо для тебе пробне заняття, де познайомимося, пройдемо тест на рівень англійської та визначимо твої цілі на навчання.</p>
                    </div>
                    <div class="test-proposition__button"><a href="" class="button">Пройти тест</a></div>
                </div>
            </section>
        </div>
        <section class="slider">
            <div class="slider-track">
                <div class="slide">
                    <div class="slide__content">
                        <img src="/emojies/work.svg" alt="work">
                        <span class="slide__title"> Англійська для роботи</span>
                    </div>
                    <p class="slide__subtitle">Опануєш ділову лексику, зможеш читати англомовні джерела та легко порозумієшся з іноземними колегами</p>
                </div>
                <div class="slide">
                    <div class="slide__content">
                        <img src="/emojies/work.svg" alt="work">
                        <span class="slide__title">Розмовний курс</span>
                    </div>
                    <p class="slide__subtitle">Мінімум теорії, максимум практики та a bunch of topics на будь-який випадок. Все це допоможе швидко подолати мовний бар’єр</p>
                </div>
                <div class="slide">
                    <div class="slide__content">
                        <img src="/emojies/work.svg" alt="work">
                        <span class="slide__title">Англійська для початківців</span>
                    </div>
                    <p class="slide__subtitle">База-основа-фундамент, щоб опанувати базову граматику та підтримувати прості побутові розмови</p>
                </div>
                <div class="slide">
                    <div class="slide__content">
                        <img src="/emojies/work.svg" alt="work">
                        <span class="slide__title">Англійська для початківців</span>
                    </div>
                    <p class="slide__subtitle">База-основа-фундамент, щоб опанувати базову граматику та підтримувати прості побутові розмови</p>
                </div>
            </div>
        </section>
        <section class="price">
            <div class="price-content">
                <p class="how-much">How much?</p>
                <ul class="price-lessons__info">
                    <li class="list__items">
                        <img src="/emojies/clock.svg" alt="clock">
                        <p>Урок – 50 хвилин</p>
                    </li>
                    <li class="list__items">
                        <img src="/emojies/okay.svg" alt="okay">
                        <p>Є оплата частинами</p>
                    </li>
                </ul>
                <div class="price-privileges">
                    <p>Окрім занять з тічером, тобі доступні:</p>
                    <ul class="box-list">
                        <li class="list__items">
                            <img src="/emojies/backhand.svg" alt="backhand">
                            <p>Support superheroes, які вирішать будь-яке питання</p>
                        </li>
                        <li class="list__items">
                            <img src="/emojies/backhand.svg" alt="backhand">
                            <p>Спікінг-клаби і self-study-курси — безкоштовно у пакетах від 20 занять</p>
                        </li>
                    </ul>
                    <p class="price-memo">І пам’ятай:<span> більше занять — нижча ціна. А ще — більше бонусів.</span></p>
                </div>
                <div class="price-button">
                    <a href="" class="button">Спробувати безкоштовно</a>
                </div>
            </div>
            <div class="price-cards">
                <div class="price-card">
                    <div class="left-card">
                        <div class="price-card-content">
                            <p class="price-card__name">Мінімальний</p>
                            <div class="price-card__lessons price-card__lessons__left">
                                <span>5 занять</span>
                                <img src="/emojies/image 12.svg" alt="">
                            </div>
                            <span class="hr price-card__hr"></span>
                            <p class="card-feature">Освіжиш знання та зануришся у процес онлайн‑навчання.</p>
                        </div>
                    </div>
                    <div class="prices">
                        <div class="price-left price-item">
                            <p>Локал</p>
                            <span>350 грн</span>
                        </div>
                        <div class="price-right price-item">
                            <p>Носій</p>
                            <span>1100 грн</span>
                        </div>
                    </div>
                </div>
                <div class="price-card right-card">
                    <div class="price-card-content">
                        <p class="price-card__name">Популярний</p>
                        <div class="price-card__lessons price-card__lessons__right">
                            <span>10 занять</span>
                            <img src="/emojies/okay.svg" alt="">
                        </div>
                        <span class="hr price-card__hr"></span>
                        <p class="card-feature">Заповниш прогалини у grammar skills та зробиш перші кроки до подолання мовного бар’єру.</p>
                    </div>
                    <div class="prices">
                        <div class="price-left price-item">
                            <p>Локал</p>
                            <span>330 грн</span>
                        </div>
                        <div class="price-right price-item">
                            <p>Носій</p>
                            <span>1040 грн</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <Footer></Footer>
</template>

<style scoped>
.buttons {
    align-items: center;
}
</style>
