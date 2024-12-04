<template>
    <button
        :class="buttonClass"
        :disabled="disabled"
        @click="onClick"
    >
        <slot>{{ text }}</slot>
    </button>
</template>

<script>
export default {
    name: 'ActionButton',
    props: {
        text: {
            type: String,
            default: 'Click me',
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        onClick: {
            type: Function,
            default: () => {
            },
        },
    },
    computed: {
        buttonClass() {
            return [
                'mt-4 py-2 px-4 rounded-md focus:outline-none focus:ring-2',
                this.disabled
                    ? 'bg-gray-400 cursor-not-allowed text-gray-200'
                    : 'bg-indigo-500 hover:bg-indigo-600 text-white focus:ring-indigo-400',
            ];
        },
    },
};
</script>
