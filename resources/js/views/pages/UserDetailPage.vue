<template>
    <div class="px-4 sm:px-0">
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
                        <h1 class="text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">User Detail</h1>
                        <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
                            A page with more detailed user information than the user list page.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="successResponse">

            <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">            <img
                            v-if="user.photo"
                            :src="`/storage/${user.photo}`"
                            alt="Profile avatar"
                            class="h-20 w-20 flex-none rounded-full bg-gray-50"
                        /></dt>
                        <dd class="text-lg font-medium text-gray-500 sm:text-xl/8">{{ user.name }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">User ID</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ user.id }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Position for</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ user.position }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Position ID</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ user.position_id }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Email address</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ user.email }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Phone</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ user.phone }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Date of registration</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                            <FormatDate :timestamp="user.registration_timestamp"/>
                        </dd>
                    </div>
                </dl>
                <router-link :to="`/users`">
                    <ActionButton text="Back to users list"/>
                </router-link>
            </div>
        </div>
        <div v-else class="text-red-500 font-bold">
            <p>{{ errorMessage }}</p>
            <router-link :to="`/users`">
                <ActionButton text="Back to users list"/>
            </router-link>
        </div>
    </div>
</template>

<script>
import {ref, onMounted} from 'vue';
import axios from 'axios';
import FormatDate from "@/views/components/FormatDate.vue";
import ActionButton from "@/views/components/ActionButton.vue";

export default {
    name: 'UserDetailPage',
    components: {ActionButton, FormatDate},
    props: ['id'],
    setup(props) {
        const user = ref(null);
        const successResponse = ref(false);
        const errorMessage = ref('');

        const fetchUser = async () => {
            try {
                const response = await axios.get(`/api/v1/users/${props.id}`);
                if (response.data.success) {
                    user.value = response.data.user;
                    successResponse.value = true;
                } else {
                    errorMessage.value = response.data.message;
                    if (response.data.fails) {
                        const failMessages = Object.values(response.data.fails)
                            .flat()
                            .join(' ');
                        errorMessage.value += ` ${failMessages}`;
                    }
                    successResponse.value = false;
                }
            } catch (err) {
                errorMessage.value = err.response?.data?.message || 'An unexpected error occurred';
                if (err.response?.data?.fails) {
                    const failMessages = Object.values(err.response.data.fails)
                        .flat()
                        .join(' ');
                    errorMessage.value += ` ${failMessages}`;
                }
                successResponse.value = false;
            }
        };

        onMounted(() => {
            fetchUser();
        });

        return {
            user,
            successResponse,
            errorMessage,
        };
    },
};
</script>
