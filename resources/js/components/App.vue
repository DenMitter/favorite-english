<script setup>
import { watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

watch(() => route.path, (newPath) => {
    if (newPath.startsWith('/dashboard')) {
        import('../../css/personal.css');
        const script = document.createElement('script');
        script.src = '/js/personal.js';
        script.type = 'text/javascript';
        script.defer = true;
        document.body.appendChild(script);
    }
});
</script>

<template>
    <router-view />
</template>