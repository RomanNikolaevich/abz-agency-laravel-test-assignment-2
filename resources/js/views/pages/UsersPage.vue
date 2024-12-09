<template>
    <div>
        <HeroSection />

        <div class="mb-10">
            <UsersList :userCount="userCount"
                       :pageCount="pageCount"
                       @countChange="userCount = $event"
                       @pageChange="pageCount = $event"
            />
        </div>
    </div>
</template>

<script>
import {ref} from 'vue';
import UsersList from "@/views/components/UsersList.vue";
import HeroSection from "@/views/components/HeroSection.vue";

export default {
    name: 'UsersPage',
    components: {HeroSection, UsersList},
    setup() {
        const userCount = ref(6);
        const pageCount = ref(1);

        return {userCount, pageCount};
    }
};
</script>
