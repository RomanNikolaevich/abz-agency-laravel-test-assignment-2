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
                'rounded-md px-3.5 py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2',
                this.disabled
                    ? 'bg-gray-400 text-gray-200 cursor-not-allowed'
                    : 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600',
            ];
        },
    },
};
</script>
