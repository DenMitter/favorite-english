<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const fields = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});

const errors = ref({});
const router = useRouter();

const submit = () => {
    axios.post('/api/auth/register', fields.value)
        .then((response) => {
            localStorage.setItem('authenticated', 'true');
            localStorage.setItem('token', response.data.token);
            router.push({ name: 'Home' });
        })
        .catch((error) => {
            errors.value = error.response.data.data || {};
        });
};
</script>

<template>
    <!-- Модальне вікно реєстрації -->
    <div id="registration" class="modal" data-modal="registration">
        <div class="modal-content">
            <span class="close" onclick="closeModal('registration')">
                <ion-icon name="close-outline"></ion-icon>
            </span>
            <form @submit.prevent="submit">
                <h2>Реєстрація</h2>
                <div class="modal-inputs">
                    <input type="text" placeholder="Ім'я" required v-model="fields.name">
                    <span v-if="errors.name" class="error-text">{{ errors.name[0] }}</span>

                    <input type="email" placeholder="Email" required v-model="fields.email">
                    <span v-if="errors.email" class="error-text">{{ errors.email[0] }}</span>

                    <input type="password" placeholder="Пароль" required v-model="fields.password">
                    <span v-if="errors.password" class="error-text">{{ errors.password[0] }}</span>

                    <input type="password" placeholder="Підтвердження паролю" required v-model="fields.password_confirmation">
                    <span v-if="errors.password_confirmation" class="error-text">{{ errors.password_confirmation[0] }}</span>

                </div>
                <div class="modal__bottom-section">
                    <a href="#">Є аккаунт? Увійти</a>
                    <button type="submit" class="button">Зареєструватись</button>
                </div>
            </form>
            <div class="modal-some-information">
                <p>Або через</p>
                <div class="buttons">
                    <button class="icon-btn">
                        <img src="/icons/apple.png" alt="Apple" width="14">
                    </button>
                    <button class="icon-btn google-btn">
                        <img src="/icons/google.png" alt="Google" width="14">
                    </button>
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
