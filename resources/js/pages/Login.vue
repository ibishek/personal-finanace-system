<script setup>
import Label from "@/components/Label.vue";
import Input from "@/components/Input.vue";
import YGap from "@/components/YGap.vue";
import Button from "@/components/Button.vue";
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../store/authProvider";

const router = useRouter();

const credentials = ref({
    email: "admin@admin.com",
    password: "Admin12345"
});

const authStore = useAuthStore();

function loginUser() {
    axios.get('sanctum/csrf-cookie')
    .then(() => {
        axios.post('/login', {...credentials.value})
        .then(data => {
            authStore.getUser();
            router.push({
                name: 'Dashboard'
            });
        })
        .catch((error) => {
            console.log(error);
        });
    });
}
</script>

<template>
    <section class="container mx-auto">
        <div class="grid h-screen place-items-center">
            <div class="px-8 py-12 bg-white shadow-lg relative">
                <h1 class="text-2xl text-center font-bold mb-8">Login</h1>
                <form @submit.prevent="loginUser" class="space-y-3">
                    <YGap>
                        <Label for="email">Email:</Label>
                        <Input id="email" name="email" v-model="credentials.email" required></Input>
                    </YGap>
                    <YGap>
                        <Label for="password">Password:</Label>
                        <Input id="password" inputType="password" name="password" v-model="credentials.password" required></Input>
                    </YGap>
                    <Button buttonType="submit">
                        Login
                    </Button>
                </form>
            </div>
        </div>
    </section>
</template>

<style>
</style>

