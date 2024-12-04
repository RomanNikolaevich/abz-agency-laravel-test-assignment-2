<template>
    <div>
        <h1 class="text-3xl font-semibold text-gray-900 mb-4">Users page</h1>

        <TokenRefresher/>
        <RegisterNewUser/>

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
import TokenRefresher from "@/views/components/TokenRefresher.vue";
import RegisterNewUser from "@/views/components/RegisterNewUser.vue";

export default {
    name: 'UsersPage',
    components: {RegisterNewUser, TokenRefresher, UsersList},
    setup() {
        const userCount = ref(6);
        const pageCount = ref(1);

        return {userCount, pageCount};
    }
};
</script>
