<script setup>
import Layout from './Layout.vue'
import { ref, computed } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext'

defineProps({ userName: String })

let counter = ref(0);
let visible = ref(false)

const page = usePage()

const user = computed(() => {console.log(page.props.auth.user);return page.props.auth.user})
</script>

<template>
    <Layout>
        <div class="p-12">
            <Head title="Welcome" />
            <h1>Welcome</h1>
            <p>Hello {{ user.name }}, welcome to your first Inertia app!</p>
            <p>Your number is {{ counter }}</p>
            <Button label='+ Add' raised @click="counter++" />
        </div>

    </Layout>
</template>
