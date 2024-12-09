<template>
    <select
        id="positions"
        v-model="localPosition"
        @change="updatePosition"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
    >
        <option value="" disabled>Select a position</option>
        <option v-for="position in positions" :key="position.id" :value="position.id">
            {{ position.name }}
        </option>
    </select>
</template>

<script>
import {ref, watch, onMounted} from 'vue';
import axios from 'axios';

export default {
    name: 'PositionsList',
    props: {
        positionId: {
            type: String,
            required: true,
        },
    },
    setup(props, {emit}) {
        const positions = ref([]);
        const localPosition = ref(props.positionId);

        const updatePosition = () => {
            emit('update:positionId', localPosition.value);
        };

        watch(() => props.positionId, (newValue) => {
            localPosition.value = newValue;
        });

        onMounted(() => {
            axios.get('/api/v1/positions')
                .then(response => {
                    if (response.data.success) {
                        positions.value = response.data.positions;
                    }
                })
                .catch(error => {
                    console.error('Error fetching positions:', error);
                });
        });

        return {
            positions,
            localPosition,
            updatePosition,
        };
    },
};
</script>
