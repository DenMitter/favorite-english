<script setup>
import '../../../../../public/js/admin.js'
import { onMounted } from 'vue';

import { ref } from 'vue'

// Дані для періодів
const dayData = [
    { x: new Date('2024-12-01 00:00').getTime(), y: 50 },
    { x: new Date('2024-12-01 06:00').getTime(), y: 55 },
    { x: new Date('2024-12-01 12:00').getTime(), y: 60 },
    { x: new Date('2024-12-01 18:00').getTime(), y: 65 },
    { x: new Date('2024-12-02 00:00').getTime(), y: 60 }
]

const weekData = [
    { x: new Date('2024-12-01').getTime(), y: 200 },
    { x: new Date('2024-12-02').getTime(), y: 220 },
    { x: new Date('2024-12-03').getTime(), y: 210 },
    { x: new Date('2024-12-04').getTime(), y: 250 },
    { x: new Date('2024-12-05').getTime(), y: 230 },
    { x: new Date('2024-12-06').getTime(), y: 240 },
    { x: new Date('2024-12-07').getTime(), y: 250 }
]

const monthData = [
    { x: new Date('2024-11-01').getTime(), y: 1000 },
    { x: new Date('2024-11-07').getTime(), y: 1050 },
    { x: new Date('2024-11-14').getTime(), y: 1100 },
    { x: new Date('2024-11-21').getTime(), y: 1150 },
    { x: new Date('2024-11-30').getTime(), y: 1200 }
]

const yearData = [
    { x: new Date('2023-01-01').getTime(), y: 15000 },
    { x: new Date('2023-03-01').getTime(), y: 15500 },
    { x: new Date('2023-06-01').getTime(), y: 16000 },
    { x: new Date('2023-09-01').getTime(), y: 16500 },
    { x: new Date('2023-12-31').getTime(), y: 17000 }
]

const options = {
    chart: {
        type: 'area',
        height: 350,
        toolbar: false
    },
    stroke: {
        curve: 'smooth',
    },
    dataLabels: {
        enabled: false
    },
    series: [{
        name: 'Активність',
        data: dayData
    }],
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [0, 90, 100]
        }
    },
    xaxis: {
        type: 'datetime',
    }
}

const chart1 = ref(null)
const renderChart = () => {
    chart1.value = new ApexCharts(document.querySelector("#chart1"), options)
    chart1.value.render()
}

onMounted(renderChart)

const statUpdate = (period, el) => {
    let data
    switch (period) {
        case 1:
            data = dayData
            break
        case 2:
            data = weekData
            break
        case 3:
            data = monthData
            break
        case 4:
            data = yearData
            break
    }

    chart1.value.updateSeries([{
        name: 'Активність',
        data: data
    }])

    document.querySelectorAll('.chart__buttons .buttons__content .btn-mini').forEach(button => {
        button.classList.remove('active')
    })
    el.classList.add('active')
}

const logout = () => {
    const userConfirmed = confirm('Ви точно хочете вийти з аккаунту?');

    if (!userConfirmed) {
        return;
    }

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
</script>

<template>
    <div class="admin-panel active">
        <ion-icon name="arrow-back-outline" class="admin-panel__arrow"></ion-icon>
        <div class="admin-panel__content">
            <router-link :to="{ name: 'Index' }" class="admin-logo">
                <p>Favorite English</p>
                <img src="/images/admin.svg" alt="Admin">
            </router-link>
            <div class="admin-panel-list">
                <div class="admin-panel-lists">
                    <ul class="admin-panel-list__header">
                        <li>
                            <a href="">
                                <ion-icon name="home"></ion-icon>
                                Головна
                            </a>
                        </li>
                    </ul>
                    <ul class="admin-panel-list__cener">
                        <li>
                            <a href="">
                                <ion-icon name="people"></ion-icon>
                                Користувачі
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <ion-icon name="people"></ion-icon>
                                Викладачі
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <ion-icon name="folder-open"></ion-icon>
                                Курси
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="" class="button btn-red" @click="logout">Вийти</a>
            </div>
        </div>
    </div>
    <section class="admin-main active">
        <div class="admin-main__content">
            <div class="long-cards">
                <div class="long-card">
                    <div class="long-card__content">
                        <p>Всього користувачів</p>
                        <span>42</span>
                    </div>
                </div>
                <div class="long-card">
                    <div class="long-card__content">
                        <p>Заявок на навчання</p>
                        <span>42</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-list">
            <p class="card-list__title">Активність</p>
            <div class="card-list__content">
                <div class="card-list__info">
                    <p>Користувачів за місяць</p>
                    <span>523</span>
                </div>
                <div class="card-list__info">
                    <p>Користувачів за день</p>
                    <span>50</span>
                </div>
            </div>

            <p class="card-list__title">Графік</p>

            <!-- Кнопки для перемикання періодів -->
            <div class="buttons chart__buttons">
                <div></div>
                <div class="buttons__content">
                    <button class="button btn-mini active" @click="statUpdate(1, $event.target)">За день</button>
                    <button class="button btn-mini" @click="statUpdate(2, $event.target)">За тиждень</button>
                    <button class="button btn-mini" @click="statUpdate(3, $event.target)">За місяць</button>
                    <button class="button btn-mini" @click="statUpdate(4, $event.target)">За рік</button>
                </div>
            </div>

            <!-- Місце для графіка -->
            <div id="chart1" class="apex-charts"></div>
        </div>
    </section>
</template>

<style>
body {
    overflow-x: hidden;
}
</style>
