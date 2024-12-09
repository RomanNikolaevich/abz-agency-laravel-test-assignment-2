<template>
    <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8 relative z-10">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Token refresh</h2>
            <p class="mt-2 text-lg/8 text-gray-600">This token does not need to be copied anywhere. It is used
                automatically.</p>
        </div>
        <div
            class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div
                class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"/>
        </div>

        <div class="flex flex-col justify-left mt-4">
            <button
                @click="refreshToken"
                :disabled="loading"
                class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >
                {{ loading ? "Refreshing..." : "Refresh Token" }}
            </button>

            <!-- Message Block -->
            <div v-if="newToken" class="mt-4 p-4 rounded-md bg-green-100 text-green-800">

                Token create successful. Refresh after using. <br>
                New token: {{ newToken }}
            </div>
            <div v-if="errorMessage" class="mt-4 p-4 rounded-md bg-red-100 text-red-800">
                {{ errorMessage }}
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "TokenRefresher",
    data() {
        return {
            loading: false,
            newToken: null,
            errorMessage: null,
        };
    },
    methods: {
        async refreshToken() {
            this.loading = true;
            this.newToken = null;
            this.errorMessage = null;

            try {
                const response = await axios.get("/api/v1/token", {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem("token")}`,
                    },
                });
                if (response.data.success) {
                    this.newToken = response.data.token;
                    localStorage.setItem("token", this.newToken);
                    this.$emit('token-refreshed', this.newToken);

                    setTimeout(() => {
                        this.newToken = null;
                    }, 5000);
                }
            } catch (error) {
                this.errorMessage = error.response?.data?.message || "Failed to refresh token.";

                setTimeout(() => {
                    this.errorMessage = null;
                }, 5000);
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>
