<template>
    <div class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Token refresh</h2>

        <div class="flex flex-col justify-left mt-4">
            <details>
                <summary><span>Get a new token</span></summary>
                <button
                    class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                >
                    {{ "Refresh Token" }}
                </button>
            </details>
        </div>
    </div>
</template>
<script>
export default {
    name: 'TokenRefresher'
};
</script>
