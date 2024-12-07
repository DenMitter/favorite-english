<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const fields = ref({
    email: '',
    password: '',
});

const errors = ref({});
const router = useRouter();

const submit = () => {
    axios.post('/api/auth/login', fields.value)
        .then((response) => {
            localStorage.setItem('authenticated', 'true');
            localStorage.setItem('token', response.data.token);
            router.push({ name: 'Home' });
        })
        .catch((error) => {
            if (error.response.status === 401) {
                errors.value.message = 'Невірний логін або пароль';
            } else {
                errors.value = error.response.data.data || {};
                console.log(errors.value);
            }
        });
};
</script>

<template>
    <!-- Модальне вікно авторизації -->
    <div id="login" class="modal" data-modal="login">
        <div class="modal-content">
            <span class="close">
                <ion-icon name="close-outline"></ion-icon>
            </span>
            <form @submit.prevent="submit">
                <h2>Вхід</h2>
                <div class="modal-inputs">
                    <span v-if="errors.message" class="error-text">{{ errors.message }}</span>

                    <input type="email" placeholder="Email" required v-model="fields.email">
                    <span v-if="errors.email" class="error-text">{{ errors.email[0] }}</span>

                    <input type="password" placeholder="Пароль" required v-model="fields.password">
                    <span v-if="errors.password" class="error-text">{{ errors.password[0] }}</span>
                </div>
                <div class="modal__bottom-section">
                    <a href="#">Відновити пароль?</a>
                    <button type="submit" class="button">Увійти</button>
                </div>
            </form>
            <div class="modal-some-information">
                <p>Або увійдіть через</p>
                <div class="buttons">
                    <button class="icon-btn"><img src="icons/apple.png" alt="Apple" width="14"></button>
                    <button class="icon-btn google-btn"><img src="icons/google.png" alt="Google" width="14"></button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.error-text {
    color: red;
    font-size: 12px;
    margin-top: 4px;
}
</style>
