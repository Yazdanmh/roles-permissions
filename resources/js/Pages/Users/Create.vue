<template>
    <Head title="Create User" />
    <AuthenticatedLayout>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create User</h4>
                <p class="card-description">Create User</p>
                <form class="" @submit.prevent="submit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    v-model="form.name"
                                    placeholder="John"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    v-model="form.email"
                                    placeholder="john@example.com"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    v-model="form.password"
                                    placeholder="Your Password"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="form-group px-4">
                        <label for="roles">Roles</label>
                        <div class="d-flex flex-wrap">
                            <span v-for="role in roles" :key="role.id" class="mx-3">
                                <input
                                    type="checkbox"
                                    v-model="form.roles"
                                    :value="role.id"
                                    :id="'role-' + role.id"
                                    class="form-check-input"
                                />
                                <label :for="'role-' + role.id">{{ role.name }}</label>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">
                        Create User
                    </button>
                    <button
                        type="button"
                        class="btn btn-light"
                        @click.prevent="back"
                    >
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, Head, Link } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref } from "vue";
import { useSwal } from "@/swal";

const Swal = useSwal();

const props = defineProps({
    roles: Array, // Add roles prop to receive the available roles
});

const toast = useToast();

const form = useForm({
    name: "",
    email: "",
    password: "", 
    roles: [], 
});

const back = () => {
    window.history.back();
};

const submit = () => {
    form.post(route("users.store"), {
        onSuccess: () => {
            toast.success("User created successfully");
            form.reset();
        },
        onError: () => {
            toast.error("Something went wrong!");
        },
    });
};
</script>
