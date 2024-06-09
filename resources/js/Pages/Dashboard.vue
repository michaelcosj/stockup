<script setup>
import AppLayout from '@/Layout/AppLayout.vue'
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

import Card from 'primevue/card';
import ProgressBar from 'primevue/progressbar';
import Button from 'primevue/button';

let counter = ref(0);

const page = usePage()
const user = computed(() => page.props.auth.user)
</script>

<template>
    <AppLayout>
        <Card class="w-full max-w-md">
            <template #title>Hello {{ user.name }}</template>
            <template #content>

                <div class="w-full p-12 flex flex-col gap-5">
                    <ProgressBar :value="counter">{{ counter }}</ProgressBar>
                    <Button raised @click="counter += 10">Click Me</Button>
                </div>
            </template>
        </Card>
    </AppLayout>
</template>
