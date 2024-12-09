<template>
    <div v-if="showButton" class="scroll-to-top" @click="scrollToTop">
        Top
    </div>
</template>

<script>
export default {
    name: "ScrollToTop",
    data() {
        return {
            showButton: false,
        };
    },
    methods: {
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        },
        checkScroll() {
            this.showButton = window.scrollY > 200;
        },
    },
    mounted() {
        window.addEventListener("scroll", this.checkScroll);
    },
    beforeUnmount() {
        window.removeEventListener("scroll", this.checkScroll);
    },
};
</script>

<style scoped>
.scroll-to-top {
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    border: none;
    outline: none;
    background-color: #1143c3;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 50%;
    font-size: 18px;
}

.scroll-to-top:hover {
    background-color: #4c7af1;
}
</style>
