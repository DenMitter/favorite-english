<script>
export default {
    methods: {
        openModal(modalId) {
            const modal = document.getElementById(modalId);
            const modalContent = modal.querySelector('.modal-content');

            modal.style.display = "flex";
            document.body.style.overflow = "hidden";
            modalContent.style.animation = 'none';
            modalContent.offsetHeight;
            modalContent.style.animation = 'slideUp 0.5s ease';
        }
    }
}
</script>

<template>
    <router-view></router-view>
</template>
