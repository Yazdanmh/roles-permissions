<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-success">
            {{ status }}
        </div>

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg p-5 rounded-lg" style="max-width: 420px; width: 100%;">

                <!-- Title Section -->
                <h2 class="text-center mb-4">Welcome Back!</h2>
                <p class="text-center text-muted mb-4">Please log in to your account</p>

                <!-- Login Form -->
                <form @submit.prevent="submit" class="space-y-4">

                    <!-- Email Input -->
                    <div class="mb-4">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            class="form-control"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2 text-danger" :message="form.errors.email" />
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            class="form-control"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />
                        <InputError class="mt-2 text-danger" :message="form.errors.password" />
                    </div>

                   

                    <!-- Forgot Password Link -->
                    <div class="text-end mb-4">
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-decoration-none text-primary"
                        >
                            Forgot your password?
                        </Link>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <PrimaryButton
                            class="btn btn-primary"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Background styling for the full page */
body {
    background-color: #f8f9fa;
    font-family: 'Arial', sans-serif;
}

/* Card Styling */
.card {
    background-color: #ffffff;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
}

/* Title Styling */
h2 {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

/* Button Styling */
.btn-primary {
    font-size: 16px;
    font-weight: 500;
    padding: 12px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #007bff;
}

/* Error Styling */
.text-danger {
    color: #e74a3b;
}

/* Customization for inputs */
.form-control {
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #ced4da;
    transition: border 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Checkbox styling */
.form-check-label {
    font-size: 14px;
}

/* Centering the form */
.container {
    max-width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
