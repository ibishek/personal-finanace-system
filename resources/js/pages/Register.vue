<script setup>
import Label from "@/components/Label.vue";
import Row from "@/components/Row.vue";
import Input from "@/components/Input.vue";
import YGap from "@/components/YGap.vue";
import Button from "@/components/Button.vue";
import Validations from "../components/Validations.vue";
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

let credentials = ref({
    first_name: "",
    last_name: "",
    email: "",
    password: "",
    password_confirmation: ""
});

let errors = ref({
    first_name: [],
    last_name: [],
    email: [],
    password: [],
    password_confirmation: []
});

function registerUser() {
    axios.get('sanctum/csrf-cookie')
    .then(() => {
        axios.post('/register', {...credentials.value})
        .then(data => {
            router.push({
                name: 'Login'
            });
        })
        .catch((error) => {
            const validated = error.response.data.errors;
            errors.value.first_name = validated.first_name ?? [];
            errors.value.last_name = validated.last_name ?? [];
            errors.value.email = validated.email ?? [];
            errors.value.password = validated.password ?? [];
            errors.value.password_confirmation = validated.password_confirmation ?? [];
        });
    });
}
</script>

<template>
    <section class="container mx-auto">
        <div class="grid h-screen place-items-center">
            <div class="px-8 py-12 bg-white shadow-lg relative">
                <h1 class="text-2xl text-center font-bold mb-8">Register</h1>
                <form @submit.prevent="registerUser" class="space-y-3" autocomplete="off" >
                    <Row class="space-x-2">
                        <YGap>
                            <Label for="firstName">First name:</Label>
                            <Input id="firstName" name="firstName" v-model="credentials.first_name" required></Input>
                            <Validations :errors="errors.first_name" />
                        </YGap>
                        <YGap>
                            <Label for="lastName">Last name:</Label>
                            <Input id="lastName" name="lastName" v-model="credentials.last_name" required></Input>
                            <Validations :errors="errors.last_name" />
                        </YGap>
                    </Row>
                    <YGap>
                        <Label for="email">Email</Label>
                        <Input id="email" name="email" inputType="email" class="w-full" v-model="credentials.email" required></Input>
                        <Validations :errors="errors.email" />
                    </YGap>
                    <Row class="space-x-2">
                        <YGap>
                            <Label for="password">Password:</Label>
                            <Input id="password" inputType="password" name="password" v-model="credentials.password" required></Input>
                            <Validations :errors="errors.password" />
                        </YGap>
                        <YGap>
                            <Label for="confirm">Confirm:</Label>
                            <Input id="confirm" inputType="password" name="confirm" v-model="credentials.password_confirmation" required></Input>
                            <Validations :errors="errors.password_confirmation" />
                        </YGap>
                    </Row>
                    <Button buttonType="submit">
                        Register
                    </Button>
                </form>
            </div>
        </div>
    </section>
</template>

<style>
</style>
