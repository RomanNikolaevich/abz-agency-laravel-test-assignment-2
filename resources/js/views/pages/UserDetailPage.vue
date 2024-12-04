<template>
    <div class="px-4 sm:px-0">
        <h1 class="text-2xl font-semibold text-gray-900 mb-4">User Detail</h1>
        <div v-if="successResponse">
            <img
                v-if="user.photo"
                :src="`/storage/${user.photo}`"
                alt="Profile avatar"
                class="h-12 w-12 flex-none rounded-full bg-gray-50"
            />
            <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm/6 font-medium text-gray-900">Full name</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ user.name }}</dd>
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
