<script setup>
import {ref} from "vue";

const formData = ref({
    name: null,
    email: null,
    password: null,
    password_confirmation: null
});

const buttonClass = ref("button");
const buttonText = ref("Зареєструватись");

const registration = () => {
    axios.post('/api/auth/register/', {
        name: formData.value.name,
        email: formData.value.email,
        password: formData.value.password,
        password_confirmation: formData.value.password_confirmation
    }).then(res => {
        formData.value.name = null;
        formData.value.email = null;
        formData.value.password = null;
        formData.value.password_confirmation = null;

        buttonClass.value = "button btn-success";
        buttonText.value = "Успішно";

        setTimeout(() => {
            buttonClass.value = "button";
            buttonText.value = "Зареєструватись";
        }, 5000);
    }).catch(error => {
        if (error.response) {
            buttonClass.value = "button btn-error";
            buttonText.value = "Помилка";

            setTimeout(() => {
                buttonClass.value = "button";
                buttonText.value = "Зареєструватись";
            }, 5000);

            console.error('Помилка сервера:', error.response.data);
        } else if (error.request) {
            console.error('Відсутня відповідь від сервера:', error.request);
        } else {
            console.error('Помилка при відправці запиту:', error.message);
        }
    });
};
</script>

<template>
    <!-- Модальне вікно реєстрації -->
    <div id="registration" class="modal" data-modal="registration">
        <div class="modal-content">
            <span class="close" onclick="closeModal('registration')"><ion-icon name="close-outline"></ion-icon></span>
            <h2>Реєстрація</h2>
            <div class="modal-inputs">
                <input type="text" placeholder="Ім'я" required v-model="formData.name">
                <input type="email" placeholder="Email" required v-model="formData.email">
                <input type="password" placeholder="Пароль" required v-model="formData.password">
                <input type="password" placeholder="Підтвердження паролю" required v-model="formData.password_confirmation">
            </div>
            <div class="modal__bottom-section">
                <a href="#">Є аккаунт? Увійти</a>
                <a @click.prevent="registration" href="" :class="buttonClass">{{ buttonText }}</a>
            </div>
            <div class="modal-some-information">
                <p>Або через</p>
                <div class="buttons">
                    <button class="icon-btn"><img src="icons/apple.png" alt="Apple" width="14"></button>
                    <button class="icon-btn google-btn"><img src="icons/google.png" alt="Google" width="14"></button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.btn-success {
    background-color: #cff99c;
    color: #000000;
}

.btn-error {
    background-color: #eb4e4e;
    color: #ffffff;
}
</style>
