<script setup>
const props = defineProps({
    buttonType: {
        type: String,
        required: false,
        default: 'button'
    }
});
</script>

<template>
    <button :type="props.buttonType" class="py-2 px-6 rounded-full bg-indigo-700 text-white hover:shadow-lg active:bg-indigo-800 active:translate-y-0.5">
        <slot></slot>
    </button>
</template>
