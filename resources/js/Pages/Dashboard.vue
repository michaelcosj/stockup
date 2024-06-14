<script setup>
import AppLayout from '@/Layout/AppLayout.vue'
import { ref } from 'vue'
import { useForm, router } from '@inertiajs/vue3'

import Card from 'primevue/card';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Divider from 'primevue/divider';
import { useToast } from "primevue/usetoast";

defineProps({ lists: Array })
const toast = useToast();

// create list form
const form = useForm({
    name: null,
    description: null,
})

const visible = ref(false)
const loading = ref(false)

function submit() {
    loading.value = true
    form.post('/lists', {
        onSuccess: () => {
            loading.value = false
            visible.value = false
            form.reset()
        },
        onFinish: () => {
            loading.value = false
        },
    })
}


// delete list
function listDelete(list) {
    router.delete(`/lists/${list.id}`, {
        onError: (errors) => {
            console.log(errors)
            toast.add({
                severity: 'error',
                summary: 'Error Deleting List',
                detail: errors["0"],
                life: 3000
            });
        }
    })
}

</script>

<template>
    <AppLayout>
        <div class="w-full py-12 flex justify-center items-center">
            <Card class="w-full max-w-3xl my-12 mx-5">
                <template #title>
                    <div class="flex justify-between items-center">
                        <h1>
                            My Stock Lists
                        </h1>
                        <Button label="New list" icon="pi pi-plus" @click="visible = true" raised />
                    </div>
                </template>
                <template #content>
                    <div class="px-2 py-6">
                        <template v-for="(list, index) in lists" :key="list.id">
                            <div class="flex justify-between gap-3 items-center">
                                <div class="flex-grow hover:bg-emphasis py-1 px-3 rounded-md">
                                    <p class="font-bold text-primary-emphasis"> {{ list.name }} </p>
                                    <p class="text-sm text-muted-color">{{ list.description }}</p>
                                </div>
                                <Button rounded type="button" icon="pi pi-pen-to-square" severity="secondary"
                                    @click="edit(list)" />
                                <Button rounded type="button" icon="pi pi-trash" severity="danger"
                                    @click="listDelete(list)" />
                            </div>
                            <Divider v-if="(index + 1) < lists.length" />
                        </template>
                    </div>
                </template>
            </Card>
        </div>

        <Dialog v-model:visible="visible" modal header="Create a new list" class="md:max-w-md">
            <form @submit.prevent="submit">
                <div class="flex flex-col gap-2 mb-4">
                    <div class="flex items-center gap-4">
                        <label for="name" class="font-semibold w-24">Name</label>
                        <InputText id="name" class="flex-auto" autocomplete="off" placeholder="e.g Kitchen"
                            v-model="form.name" />
                    </div>
                    <p v-if="form.errors.name" class="text-right text-sm text-red-800">
                        {{ form.errors.name }}
                    </p>
                </div>
                <div class="flex flex-col gap-2 mb-8">
                    <div class="flex items-center gap-4">
                        <label for="description" class="font-semibold w-24">Description</label>
                        <InputText id="description" class="flex-auto" autocomplete="off"
                            placeholder="Describe this list" v-model="form.description" />
                    </div>
                    <p v-if="form.errors.description" class="text-right text-sm text-red-800">
                        {{ form.errors.description }}
                    </p>
                </div>
                <div class="flex justify-end gap-2">
                    <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                    <Button label="Create" type="submit" :loading='loading'></Button>
                </div>
            </form>
        </Dialog>
    </AppLayout>
</template>
