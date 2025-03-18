<script setup>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
</script>

<template>
    <div class="personal-body">
        <div class="content">
            <Header></Header>

            <div class="container">
                <section class="main">
                    <div class="main-cards">
                        <div class="main-cards__card main-left__card gap-small">
                            <p>Отримати бонус</p>
                        </div>
                        <div class="main-cards__card">
                            <p>
                                Баланс:
                                <span class="blue">5 уроків</span>
                            </p>
                            <a href="" class="button btn-icon">
                                <img src="/../emojies/wallet.svg" alt="Wallet">
                                Поповнити
                            </a>
                        </div>
                    </div>
                    <div class="main-cards">
                        <div class="main-cards__card justify-content-around">
                            <!-- <img class="lessons-image" src="../images/lesson.jpg" alt="Lesson background image"> -->
                            <div class="lessons-image" style="background-image: url('../images/lesson.jpg');"></div>
                            <div class="lessons__info">
                                <h5 class="lessons-title">26 Other news</h5>
                                <p class="lessons-subtitle">Дивилися новини?<br>I did, I used to do, I was doing</p>
                                <div class="lessons-buttons">
                                    <a href="" class="button w-auto">Приєднатися</a>
                                    <a href="" class="button w-auto btn-transparent">Виконати Д/З</a>
                                </div>
                            </div>
                        </div>
                        <div class="main-cards__card">
                            <div class="chat-content">
                                <div class="chat-teacher__info">
                                    <img src="/../images/teacher-avatar.svg" alt="">
                                    <div class="chat-teacher__items">
                                        <h4 class="chat-teacher__name">Богдан Жижула</h4>
                                        <p class="teacher">Твій вчитель</p>
                                    </div>
                                </div>
                                <h4 class="text-chat">Поки тут пусто</h4>
                                <div class="chat__input-items">
                                    <input name="" class="chat__input" placeholder="Повідомлення">
                                    <ion-icon name="send" class="button btn-mini"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="news">
                        <div class="news-content">
                            <img src="/../images/news-image.png" alt="" class="news-image">
                            <div class="news-text">
                                <div class="news-text-content">'
                                    <h1 class="news-title">Найчастіші фрази для бізнесу</h1>
                                    <p class="news-subtitle">Перегляньте цю новину та дізнайтесь більше про англійську мову</p>
                                </div>
                                <a href=""class="button btn-big btn-transparent">Детальніше</a>
                            </div>
                        </div>
                        <div>
                            <span class="bg-circle bg-circle__news"></span>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <Footer></Footer>
</template>

<style scoped>

</style>
