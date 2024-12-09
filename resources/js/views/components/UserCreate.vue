<template>
    <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">User
                registration</h2>
            <ul class="mt-2 text-lg/8 text-gray-600">
                <li>All fields are required</li>
                <li>Name, should be 2-60 characters.</li>
                <li>Phone number, should start with code of Ukraine +380.</li>
                <li>Photo should be with resolution at least 70x70px and size must not exceed 5MB.</li>
            </ul>
        </div>

        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="w-full">
                <form @submit.prevent="handleRegister" class="space-y-6" enctype="multipart/form-data">
                    <!-- Full Name -->
                    <div class="sm:col-span-2">
                        <label for="company" class="block text-sm/6 font-semibold text-gray-900">Full Name</label>
                        <div class="mt-2.5">
                            <input v-model="form.name" id="name" name="name" type="text" required
                                   class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600"/>
                        </div>
                        <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name }}</p>
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm/6 font-semibold text-gray-900">Email</label>
                        <div class="mt-2.5">
                            <input v-model="form.email" id="email" name="email" type="email" required
                                   class="block w-full rounded-md bg-white px-3.5 py-2 text-base
                                   text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300
                                   placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2
                                   focus:outline-indigo-600"/>
                        </div>
                        <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
                    </div>

                    <!-- Phone -->
                    <div class="sm:col-span-2">
                        <label for="phone" class="block text-sm/6 font-semibold text-gray-900">Phone number</label>
                        <div class="mt-2.5">
                            <div class="flex rounded-md bg-white outline outline-1 -outline-offset-1 outline-gray-300
                                has-[input:focus-within]:outline has-[input:focus-within]:outline-2 has-[input:focus-within]:-outline-offset-2
                                has-[input:focus-within]:outline-indigo-600">
                                <input v-model="form.phone" id="phone" name="phone" type="tel"
                                       placeholder="+380123456789"
                                       required
                                       class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900
                                       placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"/>
                            </div>
                        </div>
                        <p v-if="errors.phone" class="mt-1 text-sm text-red-600">{{ errors.phone }}</p>
                    </div>

                    <!-- Position List -->
                    <div class="sm:col-span-2">
                        <label for="positions" class="block text-sm/6 font-semibold text-gray-900">Select
                            Position</label>
                        <PositionsList v-model:positionId="form.position_id"/>
                        <p v-if="errors.position_id" class="mt-1 text-sm text-red-600">{{ errors.position_id }}</p>
                    </div>

                    <!-- Photo -->
                    <div class="sm:col-span-2">
                        <label for="photo" class="block text-sm/6 font-semibold text-gray-900">Photo</label>
                        <div class="mt-2.5">
                            <input @change="handleFileUpload" id="photo" name="photo" type="file"
                                   accept="image/jpeg"
                                   class="block w-full text-sm text-gray-900 border-gray-300 rounded-md focus:ring-indigo-600 focus:border-indigo-600">
                        </div>
                        <p v-if="errors.photo" class="mt-1 text-sm text-red-600">{{ errors.photo }}</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-10">
                        <ActionButton text="Register" type="submit" class="block w-full"/>
                    </div>
                </form>
            </div>

            <!-- Message Block -->
            <div v-if="message" class="mt-4 p-4 rounded-md"
                 :class="{'bg-green-100 text-green-800': success, 'bg-red-100 text-red-800': !success}">
                {{ message }}
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {ref} from 'vue';
import PositionsList from '../components/PositionsList.vue';
import ActionButton from "../components/ActionButton.vue";

export default {
    name: 'RegisterNewUser',
    components: {ActionButton, PositionsList},
    props: {
        token: {
            type: String,
            required: true,
        }
    },
    setup(props) {
        const form = ref({
            name: '',
            email: '',
            phone: '',
            position_id: '',
            photo: null,
        });
        const errors = ref({});
        const successMessage = ref('');
        const errorMessage = ref('');
        const message = ref('');
        const success = ref(true); // Для визначення, чи успішне повідомлення

        const handleRegister = async () => {
            try {
                const formData = new FormData();
                formData.append('name', form.value.name);
                formData.append('email', form.value.email);
                formData.append('phone', form.value.phone);
                formData.append('position_id', form.value.position_id);
                formData.append('photo', form.value.photo);

                const response = await axios.post('/api/v1/users', formData, {
                    headers: {
                        'token': props.token,
                        'Content-Type': 'multipart/form-data',
                    },
                });

                if (response.status === 201) {
                    successMessage.value = response.data.message || 'Registration successful!';
                    form.value = {
                        name: '',
                        email: '',
                        phone: '',
                        position_id: '',
                        photo: null,
                    };
                    errors.value = {};
                    showMessage(successMessage.value, true);
                }
            } catch (error) {
                if (error.response) {
                    const {status, data} = error.response;

                    if (status === 409) {
                        showMessage(data.message, false);
                    } else if (status === 422) {
                        successMessage.value = '';
                        errors.value = data.fails || {};
                    } else if (status === 401 || data.message === 'The token expired.' || data.message === 'The token has already been used.') {
                        showMessage(data.message || 'Token error', false);
                    } else {
                        showMessage(data.message || 'An unexpected error occurred.', false);
                    }
                } else {
                    showMessage('Network error or server is not reachable.', false);
                }
            }
        };

        const showMessage = (msg, isSuccess) => {
            message.value = msg;
            success.value = isSuccess;

            setTimeout(() => {
                message.value = '';
            }, 5000);
        };

        const handleFileUpload = (event) => {
            form.value.photo = event.target.files[0];
        };

        return {
            form,
            errors,
            handleRegister,
            handleFileUpload,
            message,
            success,
        };
    },
};
</script>
