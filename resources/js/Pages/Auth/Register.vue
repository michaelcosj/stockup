<script setup>
import { computed } from 'vue'
import { Link, router, useForm } from '@inertiajs/vue3'

import GuestLayout from '@/Layout/GuestLayout.vue'

import Card from 'primevue/card';
import Divider from 'primevue/divider';
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import Password from 'primevue/password';
import Message from 'primevue/message';
import Checkbox from 'primevue/checkbox';

const form = useForm({
    email: null,
    username: null,
    password: null,
    password_confirmation: null,
})

const isConfirmedPassword = computed(() => {
    return form.password !== form.password_confirmation
});

function submit() {
    form.post('/register', {
        preserveState: true,
        onError: (errors) => {
            form.reset('password')
            form.reset('password_confirmation')
            console.log(errors)
        }
    })
}
</script>

<template>
    <GuestLayout>
        <form @submit.prevent="submit" class="h-full w-full flex justify-center items-center">
            <Card class="w-full max-w-md">
                <template #content>
                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm">Email</label>
                            <InputText id="email" type="email" placeholder="johnnydoe@example.com" v-model="form.email"
                                :invalid="form.errors.email" />
                            <p v-if="form.errors.email" class="text-right text-sm text-red-800">
                                {{ form.errors.email }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="username" class="text-sm">Username</label>
                            <InputText id="username" placeholder="Hikaru Nakamura" v-model="form.username"
                                :invalid="form.errors.username" />
                            <p v-if="form.errors.username" class="text-right text-sm text-red-800">
                                {{ form.errors.username }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="password" class="text-sm">Password</label>
                            <Password toggleMask placeholder="password@123" inputClass="w-full" v-model="form.password"
                                :invalid="form.errors.password">
                                <template #header>
                                    <div class="font-semibold text-xm mb-4">Pick a password</div>
                                </template>
                                <template #footer>
                                    <Divider />
                                    <ul class="pl-2 ml-2 my-0 leading-normal">
                                        <li>At least one lowercase</li>
                                        <li>At least one uppercase</li>
                                        <li>At least one numeric</li>
                                        <li>Minimum 8 characters</li>
                                    </ul>
                                </template>
                            </Password>
                            <p v-if="form.errors.password" class="text-right text-sm text-red-800">
                                {{ form.errors.password }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="password-confirm" class="text-sm">Confirm Password</label>
                            <InputText id="password-confirm" type="password" placeholder="passWord@123"
                                v-model="form.password_confirmation" :invalid="isConfirmedPassword" />
                            <p v-if="isConfirmedPassword" class="text-right text-sm text-red-800">
                                Must be the same as password
                            </p>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <div class="flex items-center gap-3 mt-4 justify-end">
                        <Button raised type="submit">Register</Button>
                    </div>
                </template>
            </Card>
        </form>
    </GuestLayout>
</template>
