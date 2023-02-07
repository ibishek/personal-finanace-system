<script setup>
const props = defineProps({
    errors: {
        type: Array,
        required: false,
        default: []
    }
});
</script>

<template>
<ul class="text-red-500" role="alert">
    <li v-for="(error, index) in props.errors" :key="index">
        <small class="italic">{{ error }}</small>
    </li>
</ul>
</template>
