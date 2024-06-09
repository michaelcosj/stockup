<script setup>
import { useForm } from '@inertiajs/vue3'

import GuestLayout from '@/Layout/GuestLayout.vue'

import Card from 'primevue/card';
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import Password from 'primevue/password';
import Message from 'primevue/message';
import Checkbox from 'primevue/checkbox';

const form = useForm({
    email: null,
    password: null,
    remember_me: false,
})

function submit() {
    form.post('/login', {
        preserveState: true,
        onError: (errors) => {
            form.reset('password')
            console.log(errors)
        }
    })
}
</script>

<template>
    <GuestLayout>
        <form @submit.prevent="submit" class="h-full w-full flex justify-center items-center">
            <Card class="w-full max-w-md p-3">
                <template #content>
                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm">Email</label>
                            <InputText id="email" type="email" placeholder="johnnydoe@example.com" v-model="form.email"
                                :invalid="form.errors.email" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="password" class="text-sm">Password</label>
                            <Password toggleMask placeholder="password@123" inputClass="w-full" v-model="form.password"
                                :invalid="form.errors.password" :feedback="false" />
                        </div>

                        <Message v-if="form.hasErrors" severity="error">
                            Invalid user details
                        </Message>

                        <p class="text-sm pt-2">Forgot password?</p>
                    </div>
                </template>
                <template #footer>
                    <div class="flex items-center gap-3 mt-4 justify-between">
                        <div class="flex items-center gap-2">
                            <Checkbox id="remember-me" v-model="form.remember_me" binary />
                            <label for="remember-me" class="text-sm">Remember me</label>
                        </div>
                        <Button raised type="submit">Login</Button>
                    </div>
                </template>
            </Card>
        </form>
    </GuestLayout>
</template>
