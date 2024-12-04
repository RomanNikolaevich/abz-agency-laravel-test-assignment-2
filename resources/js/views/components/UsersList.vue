<template>
    <div>
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Users List</h2>
        <p>Select position</p>
    </div>

    <div v-if="state.success">
        <div class="mb-4">
            <label for="user-count" class="block text-sm font-medium text-gray-700">Users per page:</label>
            <input
                type="number"
                id="user-count"
                v-model="state.userCount"
                @change="handleCountChange"
                min="1"
                class="mt-2 w-20 h-8 p-1 border border-gray-300 rounded-md"
            />
        </div>

        <div class="mb-4">
            <label for="page-number" class="block text-sm font-medium text-gray-700">Page number:</label>
            <input
                type="number"
                id="page-number"
                v-model="state.pageCount"
                @change="handlePageChange"
                min="1"
                class="mt-2 w-20 h-8 p-1 border border-gray-300 rounded-md"
            />
        </div>
        <ActionButton :onClick="resetFilters"
                      text="Reset filters"
        />

        <ul class="divide-y divide-gray-100">
            <li v-for="user in state.users" :key="user.id" class="flex justify-between gap-x-6 py-5">
                <div class="flex min-w-0 gap-x-4">
                    <router-link :to="`/users/${user.id}`">
                        <img
                            v-if="user.photo"
                            :src="`/storage/${user.photo}`"
                            alt="Profile avatar"
                            class="h-12 w-12 flex-none rounded-full bg-gray-50"
                        />
                    </router-link>
                    <div class="min-w-0 flex-auto">
                        <router-link :to="`/users/${user.id}`">
                            <p class="text-sm font-semibold text-gray-900">{{ user.name }}</p>
                        </router-link>
                        <p class="mt-1 truncate text-xs text-gray-500">{{ user.email }}</p>
                        <p class="mt-1 truncate text-xs text-gray-500">Reg. id: {{ user.id }}</p>
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm/6 text-gray-900">{{ user.position }}</p>
                    <p class="mt-1 text-xs text-gray-500">{{ user.phone }}</p>
                    <p class="mt-1 text-xs text-gray-500">
                        Date of registration:
                        <FormatDate :timestamp="user.registration_timestamp"/>
                    </p>
                </div>
            </li>
        </ul>

        <div class="flex justify-left mt-4">
            <ActionButton :onClick="loadMore"
                          :disabled="!state.nextPageUrl"
                          text="Show more"
            />
        </div>
    </div>

    <div v-else class="text-red-500 font-bold">
        <p>{{ state.errorMessage }}</p>
        <ActionButton :onClick="resetFilters"
                      text="Reset filters"
        />
    </div>
</template>

<script>
import axios from 'axios';
import {ref, onMounted} from 'vue';
import FormatDate from "@/views/components/FormatDate.vue";
import ActionButton from "@/views/components/ActionButton.vue";

const API_USERS_URL = '/api/v1/users';

export default {
    name: 'UsersList',
    components: {ActionButton, FormatDate},
    props: {
        userCount: {
            type: Number,
            default: 6
        },
        pageCount: {
            type: Number,
            default: 1
        }
    },
    setup(props) {
        const state = ref({
            users: [],
            success: false,
            errorMessage: '',
            nextPageUrl: null,
            userCount: props.userCount,
            pageCount: props.pageCount,
        });

        const fetchUsers = async (url = API_USERS_URL, reset = false) => {
            try {
                const response = await axios.get(url, {
                    params: {
                        count: state.value.userCount,
                        page: state.value.pageCount,
                    }
                });

                if (response.data.success) {
                    if (reset) {
                        state.value.users = response.data.users;
                    } else {
                        state.value.users.push(...response.data.users);
                    }

                    // Получаем URL следующей страницы
                    state.value.nextPageUrl = response.data.links?.next_link || null;

                    state.value.success = true;
                    state.value.errorMessage = '';

                    if (state.value.users.length === 0) {
                        state.value.errorMessage = response.data.message || 'No users found';
                    }
                } else {
                    state.value.success = false;
                    handleFailsMessages(response.data);
                }
            } catch (err) {
                state.value.success = false;
                handleFailsMessages(err.response?.data || {message: 'Failed to load users. Please try again later.'});
            }
        };

        const handleFailsMessages = (data) => {
            state.value.errorMessage = data.message || 'An error occurred';
            if (data.fails) {
                const validationErrors = Object.values(data.fails).flat().join(' ');
                state.value.errorMessage += ` ${validationErrors}`;
            }
        };

        const handleCountChange = () => {
            state.value.pageCount = 1;
            fetchUsers(API_USERS_URL, true);
        };

        const handlePageChange = () => {
            fetchUsers(API_USERS_URL, true);
        };

        const loadMore = () => {
            if (state.value.nextPageUrl) {
                state.value.pageCount += 1;  // Увеличиваем номер страницы
                fetchUsers(state.value.nextPageUrl);  // Загружаем пользователей с новой страницы
            }
        };

        const resetFilters = () => {
            state.value.userCount = props.userCount;
            state.value.pageCount = props.pageCount;
            state.value.errorMessage = null;
            fetchUsers(API_USERS_URL, true);
        };

        onMounted(() => {
            fetchUsers();
        });

        return {
            state,
            fetchUsers,
            handleCountChange,
            handlePageChange,
            loadMore,
            resetFilters,
        };
    },
};
</script>
