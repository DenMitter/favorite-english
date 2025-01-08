<template>
    <div>
        <h1>404 - Сторінка не знайдена</h1>
        <p>На жаль, такої сторінки не існує.</p>
        <router-link :to="{ name: 'Home' }">Повернутися на головну</router-link>
    </div>
</template>

<script>
export default {
    name: 'NotFound',
};
</script>

<style scoped>
div {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
    min-height: 100vh;
}
</style>
