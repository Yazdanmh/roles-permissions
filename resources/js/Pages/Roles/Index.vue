<template>
    <Head title="Roles" />
    <AuthenticatedLayout>
        <div class="card" ref="formContainer">
            <div class="card-body">
                <h4 class="card-title">
                    {{ isEditing ? "Edit Role" : "Create Role" }}
                </h4>
                <p class="card-description">
                    {{ isEditing ? "Edit Role" : "Create Role" }}
                </p>
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
                        {{ isEditing ? "Update Role" : "Create Role" }}
                    </button>
                    <button
                        type="button"
                        class="btn btn-light"
                        @click.prevent="resetForm"
                    >
                        Cancel
                    </button>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Roles</h4>
                <p class="card-description">All Roles</p>
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
                                <td class="d-flex align-items-center gap-2">
                                    <Link
                                        :href="
                                            route('roles.addPermission', role.id)

                                        "
                                        class="btn btn-inverse-info btn-icon d-flex align-items-center justify-content-center m-2"
                                    >
                                        <i class="ti-key"></i>
                                    </Link>

                                    <button
                                        @click="editRole(role)"
                                        type="button"
                                        class="btn btn-inverse-info btn-icon d-flex align-items-center justify-content-center m-2"
                                    >
                                        <i class="ti-pencil"></i>
                                    </button>

                                    <button
                                        @click="deleteRole(role.id)"
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

const props = defineProps({
    roles: Array,
});

const toast = useToast();
const isEditing = ref(false);
const selectedRoleId = ref(null);
const formContainer = ref(null); // Reference to the form container
const form = useForm({
    name: "",
});

const editRole = (role) => {
    isEditing.value = true;
    selectedRoleId.value = role.id;
    form.name = role.name;

    // Scroll to the form smoothly
    setTimeout(() => {
        formContainer.value.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    }, 100);
};

const resetForm = () => {
    isEditing.value = false;
    selectedRoleId.value = null;
    form.reset();
};

const submit = () => {
    if (isEditing.value && selectedRoleId.value) {
        form.put(route("roles.update", selectedRoleId.value), {
            onSuccess: () => {
                toast.success("Role updated successfully");
                resetForm();
            },
            onError: () => {
                toast.error("Something went wrong!");
            },
        });
    } else {
        form.post(route("roles.store"), {
            onSuccess: () => {
                toast.success("Role created successfully");
                form.reset();
            },
            onError: () => {
                toast.error("Something went wrong!");
            },
        });
    }
};
const deleteRole = (id) => {
    Swal.fire({
        title: "danger",
        text: "Are you to delete this role?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route("roles.destroy", id), {
                onSuccess: () => {
                    toast.success("Role deleted successfully");
                },
                onError: () => {
                    toast.error("Something went wrong!");
                },
            });
        }
    });
};
</script>
