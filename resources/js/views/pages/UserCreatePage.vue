<template>
    <div>
        <div class="bg-white">
            <div class="relative isolate px-6 pt-6 lg:px-8">
                <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                     aria-hidden="true">
                    <div
                        class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"/>
                </div>
                <div class="mx-auto max-w-2xl py-32 sm:py-20 lg:py-20">
                    <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    </div>
                    <div class="text-center">
                        <h1 class="text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">Create a new user</h1>
                        <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
                            To create a user, you do not need registration, but you do need a token.
                            This token is one-time use and limited in time to 40 minutes. After creating the user, refresh the token.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Token refresher component to generate token if it's missing or expired -->
        <TokenRefresher @token-refreshed="updateToken" />

        <!-- User registration form -->
        <RegisterNewUser :token="token" />

    </div>
</template>

<script>
import {ref} from "vue";
import RegisterNewUser from "@/views/components/UserCreate.vue";
import TokenRefresher from "@/views/components/TokenRefresher.vue";

export default {
    name: 'UsersPage',
    components: {TokenRefresher, RegisterNewUser},
    setup() {
        const token = ref(localStorage.getItem('token'));

        const updateToken = (newToken) => {
            token.value = newToken;
        };

        return {token, updateToken};
    }
};

</script>
