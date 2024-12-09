<template>
    <div id="app">
        <HeaderMenu />
        <router-view></router-view>
        <ScrollToTop />
    </div>
</template>

<script>
import HeaderMenu from "@/views/components/HeaderMenu.vue";
import ScrollToTop from "@/views/components/ScrollToTop.vue";

export default {
    name: 'App',
    components: {ScrollToTop, HeaderMenu},
}
</script>
