<template>
    <AuthenticatedLayout>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Roles</h4>
                <p class="card-description">Create a Role</p>
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
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Roles</h4>
                <p class="card-description">All Roles <code></code></p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="role in props.roles" :key="role.id">
                                <td>{{ role.id }}</td>

                                <td>{{ role.name }}</td>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-inverse-info btn-icon m-1"
                                    >
                                        <i class="ti-pencil"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-inverse-danger btn-icon m-1"
                                    >
                                        <i class="ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const props = defineProps({
    roles: Array,
});
const toast = useToast();
const form = useForm({
    name: "",
});

const submit = () => {
    form.post(route("roles.store"), {
        onSuccess: () => {
            toast.success("Role created successfully");
            form.reset();
        },
        onError: () => {
            toast.error("Something went wrong!");
        },
    });
};
</script>
