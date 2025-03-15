<template>
    <Head title="Edit User" />
    <AuthenticatedLayout>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <p class="card-description">Edit User Details</p>
                <form @submit.prevent="submit">
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
                                <label for="password">Password (Leave blank to keep current password)</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    v-model="form.password"
                                    placeholder="Leave blank to keep current password"
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
                        Save Changes
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
import { useSwal } from "@/swal";

const Swal = useSwal();

const props = defineProps({
    user: Object, // The user object passed to the component
    roles: Array, // The available roles
});

const toast = useToast();

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: "",  // Leave the password blank initially
    roles: props.user.roles.map(role => role.id),  // Pre-select the roles assigned to the user
});

const back = () => {
    window.history.back();
};

const submit = () => {
    form.put(route("users.update", props.user.id), {
        onSuccess: () => {
            toast.success("User updated successfully");
        },
        onError: () => {
            toast.error("Something went wrong!");
        },
    });
};
</script>
