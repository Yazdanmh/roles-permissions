<template>
    <Head title="Add Permission to Role" />
    <AuthenticatedLayout>
        <div class="card" ref="formContainer">
            <div class="card-body">
                <h4 class="card-title">
                    Add Permissions to Role
                </h4>
                <p class="card-description">
                    Add Permissions to Role
                </p>
                <form class="forms-sample" @submit.prevent="submit">
                    <div class="form-group px-4">
                        <div class="">
                            <span v-for="permission in permissions" :key="permission.id" class="mx-4">
                                <input
                                    type="checkbox"
                                    v-model="form.permissions"
                                    :value="permission.id"
                                    class="form-check-input"
                                    :id="'permission-' + permission.id"
                                />
                                <label :for="'permission-' + permission.id" class="ml-2">
                                    {{ permission.name }}
                                </label>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">
                        Update Role
                    </button>
                    <button
                        type="button"
                        class="btn btn-light"
                        @click.prevent="back"
                    >
                        Back
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
import { ref, computed } from "vue";

const props = defineProps({
    role: Object,
    permissions: Array,
    assignedPermissions: Array, 
});


const form = useForm({
    permissions: props.assignedPermissions, 
});

const toast = useToast();

const submit = () => {
    form.put(
        route(`roles.storePermission`, props.role.id),
        {
            onSuccess: () => {
                toast.success('Updated role successfully!');
            },
            onError: () => {
                toast.error('There was an error processing the form.');
            },
        }
    );
};
const back = () => {
    window.history.back();
};
</script>
