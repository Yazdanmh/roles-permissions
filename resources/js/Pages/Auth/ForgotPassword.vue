<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg p-5 rounded-lg" style="max-width: 420px; width: 100%;">

                <!-- Title Section -->
                <h2 class="text-center mb-4">Forgot Your Password?</h2>
                <p class="text-center text-muted mb-4">Enter your email address, and we'll send you a password reset link.</p>

                <!-- Status Message -->
                <div v-if="status" class="mb-4 text-sm font-medium text-success">
                    {{ status }}
                </div>

                <!-- Forgot Password Form -->
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

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <PrimaryButton
                            class="btn btn-primary"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Email Password Reset Link
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
