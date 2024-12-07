<script>
export default {
    data() {
        return {
            id: '',
            avatar: '',
        }
    },
    mounted() {
        const token = localStorage.getItem('token');
        axios
            .get('/api/user', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then((response) => {
                this.id = response.data.id
                this.avatar = response.data.avatar
            })
            .catch((error) => {
                console.log('Unauthorized: Invalid token | ' + token);
            });
    },
    methods: {
        logout() {
            axios
                .get('/api/auth/logout')
                .then((response) => {
                    localStorage.removeItem('authenticated');
                    localStorage.removeItem('token');
                    this.$router.push({ name: 'Index' });
                })
                .catch((error) => {
                    console.log('Error logging out:', error);
                });
        }
    }
}
</script>

<template>
    <header>
        <nav class="personal-nav">
            <div class="container">

                <ul class="personal-nav__items">
                    <li class="personal-nav__item">
                        <div class="personal-nav__burger-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </li>
                    <li class="personal-nav__item">
                        <img src="/../images/Logo.svg" alt="Logo">
                    </li>
                    <li class="personal-nav__items personal-nav__center personal-nav__burger-menu">
                        <a class="personal-nav__item__active" href="">Заняття з тічером</a>
                        <a href="">Практика</a>
                    </li>
                    <li class="personal-nav__item">
                        <div class="profile">
                            <div :style="{ backgroundImage: 'url(' + avatar + ')' }" class="avatar"></div>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">
                                        <ion-icon name="settings-outline"></ion-icon>
                                        Налаштування
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <ion-icon name="wallet-outline"></ion-icon>
                                        Оплата
                                    </a>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'AdminHome' }">
                                        <ion-icon name="hammer-outline"></ion-icon>
                                        Адмін панель
                                    </router-link>
                                </li>
                                <li><button class="button" @click="logout">Вийти</button></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="header-bottom">
            <p>Успіхів у вивченні англійської!</p>
            <img src="/../emojies/british-flag.svg" alt="British flag">
        </div>
    </header>
</template>
