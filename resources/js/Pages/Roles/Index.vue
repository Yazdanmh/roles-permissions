<template>
    <AuthenticatedLayout>
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Roles</h4>
            <p class="card-description">List of Roles</p>
            <form class="forms-sample" @submit.prevent="submit">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputName1"
                        v-model="form.name"
                        placeholder="Name"
                    />
                </div>
                <button type="submit" class="btn btn-primary mr-2">
                    Submit
                </button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, useForm } from "@inertiajs/vue3";
const form = useForm({
    name: '',
});

const submit = () => {
    form.post(route('roles.store'));

};
</script>