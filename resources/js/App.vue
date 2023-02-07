<script setup>
import { useRouter } from "vue-router";

const router = useRouter();
axios.get('/api/v1/initial-path')
.then(data => {
    if (data.data.param === 'register') {
        router.push({
            name: 'Register'
        });
    } else {
        router.push({
            name: 'Login'
        });
    }
});
</script>

<template>
  <router-view></router-view>
</template>

<style>
</style>
