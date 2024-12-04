<template>
    <span>{{ formattedDate }}</span>
</template>

<script>
export default {
    name: 'FormatDate',
    props: {
        timestamp: {
            type: [Number, String],
            required: true
        }
    },
    computed: {
        formattedDate() {
            const date = new Date(this.timestamp * 1000);
            return date.toLocaleDateString();
        }
    }
};
</script>
