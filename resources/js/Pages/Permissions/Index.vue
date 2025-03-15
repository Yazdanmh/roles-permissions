<template>
    <Head title="Permissions" />
    <AuthenticatedLayout>
        <!-- Permission Form -->
        <div class="card" ref="formContainer">
            <div class="card-body">
                <h4 class="card-title">{{ isEditing ? "Edit Permission" : "Create Permission" }}</h4>
                <p class="card-description">{{ isEditing ? "Edit the selected permission" : "Create a new permission" }}</p>
                <form class="forms-sample" @submit.prevent="submit">
                    <div class="form-group">
                        <label for="permissionName">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="permissionName"
                            v-model="form.name"
                            placeholder="Permission Name"
                            required
                        />
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">
                        {{ isEditing ? "Update Permission" : "Create Permission" }}
                    </button>
                    <button type="button" class="btn btn-light" @click.prevent="resetForm">
                        Cancel
                    </button>
                </form>
            </div>
        </div>

        <!-- Permissions List -->
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Permissions</h4>
                <p class="card-description">List of all permissions</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="permission in props.permissions" :key="permission.id">
                                <td>{{ permission.id }}</td>
                                <td>{{ permission.name }}</td>
                                <td>
                                    <button @click="editPermission(permission)" type="button" class="btn btn-inverse-info btn-icon m-1">
                                        <i class="ti-pencil"></i>
                                    </button>
                                    <button @click="deletePermission(permission.id)" type="button" class="btn btn-inverse-danger btn-icon m-1">
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
import { useForm, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref } from "vue";
import { useSwal } from "@/swal";

const Swal = useSwal();

const props = defineProps({
    permissions: Array,
});

const toast = useToast();
const isEditing = ref(false);
const selectedPermissionId = ref(null);
const formContainer = ref(null);

const form = useForm({
    name: "",
});

// Edit Permission
const editPermission = (permission) => {
    isEditing.value = true;
    selectedPermissionId.value = permission.id;
    form.name = permission.name;

    // Scroll to the form smoothly
    setTimeout(() => {
        formContainer.value.scrollIntoView({ behavior: "smooth", block: "start" });
    }, 100);
};

// Reset Form
const resetForm = () => {
    isEditing.value = false;
    selectedPermissionId.value = null;
    form.reset();
};

// Create or Update Permission
const submit = () => {
    if (isEditing.value && selectedPermissionId.value) {
        form.put(route("permissions.update", selectedPermissionId.value), {
            onSuccess: () => {
                toast.success("Permission updated successfully");
                resetForm();
            },
            onError: () => {
                toast.error("Something went wrong!");
            },
        });
    } else {
        form.post(route("permissions.store"), {
            onSuccess: () => {
                toast.success("Permission created successfully");
                form.reset();
            },
            onError: () => {
                toast.error("Something went wrong!");
            },
        });
    }
};

// Delete Permission
const deletePermission = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you really want to delete this permission?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Delete",
        cancelButtonText: "Cancel",
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route("permissions.destroy", id), {
                onSuccess: () => {
                    toast.success("Permission deleted successfully");
                },
                onError: () => {
                    toast.error("Something went wrong!");
                },
            });
        }
    });
};
</script>
