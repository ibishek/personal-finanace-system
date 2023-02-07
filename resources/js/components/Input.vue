<script setup>
const props = defineProps({
    inputType: {
        type: String,
        required: false,
        default: "text"
    },
    modelValue: {
        required: true
    }
});

const emit = defineEmits(['update:modelValue'])
</script>

<template>
    <input
        :type="props.inputType"
        class="bg-gray-100 p-2 indent-3 rounded-full"
        :value="props.modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        v-bind="$attrs" />
</template>
