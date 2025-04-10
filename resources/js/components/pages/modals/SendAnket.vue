<script setup>
import { ref } from 'vue'
import axios from 'axios'

const isUnknown = ref(false)
const fields = ref({
    name: '',
    contact: '',
    level: '',
})

const errors = ref({})

const toggleUnknown = () => {
    isUnknown.value = true
    fields.value.level = 'unknown'
}

const resetUnknown = () => {
    isUnknown.value = false
    fields.value.level = ''
}

const submit = () => {
    errors.value = {}

    axios.post('/api/applications', fields.value)
        .then(() => {
            alert('Заявка успішно відправлена!')
        })
        .catch(error => {
            if (error.response?.data?.data) {
                errors.value = error.response.data.data
            } else {
                alert('Сталася помилка')
                console.log(error)
            }
        })
}
</script>

<template>
    <!-- Модальне вікно відправки анкети -->
    <div id="send-anket" class="modal" data-modal="send-anket">
        <div class="modal-content">
            <span class="close" onclick="closeModal('send-anket')">
                <ion-icon name="close-outline"></ion-icon>
            </span>
            <form @submit.prevent="submit">
                <h2>Запишись на безкоштовний пробний урок</h2>
                <div class="modal-inputs">
                    <input type="text" placeholder="Ім'я" required v-model="fields.name">
                    <span v-if="errors.name" class="error-text">{{ errors.name[0] }}</span>

                    <input type="text" placeholder="Телеграм ( @nickname ) або номер телефону" required v-model="fields.contact">
                    <span v-if="errors.contact" class="error-text">{{ errors.contact[0] }}</span>

                    <fieldset v-if="!isUnknown">
                        <div class="button-group" v-for="level in ['A1', 'A2', 'B1', 'B2', 'C1']" :key="level">
                            <input type="radio" :value="level.toLowerCase()" :id="level" name="level" v-model="fields.level"/>
                            <label :for="level">{{ level }}</label>
                        </div>
                    </fieldset>
                    <span v-if="errors.level" class="error-text">{{ errors.level[0] }}</span>
                </div>
                <div class="modal__bottom-section">
                    <div class="unknown-section">
                        <a href="#" @click.prevent="toggleUnknown">Не знаю свого рівня</a>
                        <a href="#" v-if="isUnknown" @click.prevent="resetUnknown">← Назад</a>
                    </div>

                    <router-link v-if="isUnknown" :to="{ name: 'AdminHome' }" class="button">Тест ~15хв</router-link>
                    <button v-else type="submit" class="button">Отримати знижку</button>
                </div>
            </form>
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
