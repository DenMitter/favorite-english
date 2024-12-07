<script setup>
import Header from "./Header.vue";
</script>

<template>
    <Header></Header>

    <div class="container">
        <section class="main">
            <div class="main-cards">
                <div class="main-cards__card gap-small">
                    <p>Отримати бонус</p>
                    <img class="img-icon" src="/../emojies/coins.svg" alt="Coins">
                </div>
                <div class="main-cards__card">
                    <p>Баланс: <span>5 уроків</span></p>
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
                        <a href="" class="button">Приєднатися</a>
                    </div>
                </div>
                <div class="main-cards__card">
                    <div class="chat-content">
                        <div class="chat-tacher__info">
                            <img src="/../images/teacher-avatar.svg" alt="">
                            <div class="chat-teacher__items">
                                <h4 class="chat-teacher__name">Богдан Жижула</h4>
                                <p class="teacher">Твій вчитель</p>
                            </div>
                        </div>
                        <h4 class="text-chat">Чат</h4>
                        <div class="chat__input-items">
                            <textarea name="" class="chat__input" placeholder="Повідомлення"></textarea>
                            <ion-icon name="send" class="button btn-mini"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>

</style>
