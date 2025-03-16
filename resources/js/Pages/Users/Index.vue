<template>
    <Head title="Users" />
    <AuthenticatedLayout>
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Users</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="card-description">All Users</p>
                    <Link
                        v-if="hasPermission('create users')"
                        :href="route('users.create')"
                        class="btn btn-primary btn-icon-text"
                    >Create User</Link>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th v-if="hasPermission('update users') || hasPermission('delete users')">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in props.users" :key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>
                                    <!-- Display Roles as Badges -->
                                    <span
                                        v-for="role in user.roles"
                                        :key="role.id"
                                        class="badge badge-primary mr-1"
                                    >
                                        {{ role.name }}
                                    </span>
                                </td>
                                <td class="d-flex align-items-center gap-2" v-if="hasPermission('update users') || hasPermission('delete users')">
                                    <Link
                                        v-if="hasPermission('update users')"
                                        :href="route('users.edit', user.id)"
                                        class="btn btn-inverse-info btn-icon d-flex align-items-center justify-content-center m-2"
                                    >
                                        <i class="ti-pencil"></i>
                                    </Link>
                                    <button
                                        v-if="hasPermission('delete users')"
                                        @click="deleteUser(user.id)"
                                        type="button"
                                        class="btn btn-inverse-danger btn-icon d-flex align-items-center justify-content-center m-2"
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
import { useForm, Head, Link } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref } from "vue";
import { useSwal } from "@/swal";

const Swal = useSwal();
const form = useForm({});
const props = defineProps({
    users: Array,
    permissions: Array,
});

const toast = useToast();

const deleteUser = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you really want to delete this user?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Delete",
        cancelButtonText: "No",
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route("users.destroy", id), {
                onSuccess: () => {
                    toast.success("User deleted successfully");
                },
                onError: () => {
                    toast.error("Something went wrong!");
                },
            });
        }
    });
};

const hasPermission = (permission) => {
    return props.permissions.includes(permission);
};
</script>
