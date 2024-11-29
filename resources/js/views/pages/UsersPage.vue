<template>
    <div>
        <h1 class="text-3xl font-semibold text-gray-900 mb-4">Users page</h1>

        <TokenRefresher/>
        <RegisterNewUser/>
        <UsersList/>
    </div>
</template>

<script>

import UsersList from "@/views/components/UsersList.vue";
import TokenRefresher from "@/views/components/TokenRefresher.vue";
import RegisterNewUser from "@/views/components/RegisterNewUser.vue";

export default {
    name: 'UsersPage',
    components: {RegisterNewUser, TokenRefresher, UsersList}
};
</script>
