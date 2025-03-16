<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <!-- Use href instead of :url -->
                <Link class="nav-link" :href="route('dashboard')">
                    <i class="ti ti-dashboard menu-icon"></i> <!-- Correct icon class for dashboard -->
                    <span class="menu-title">Dashboard</span>
                </Link>
            </li>
            <li class="nav-item">
                <!-- Use href instead of :url -->
                <Link class="nav-link" :href="route('roles.index')">
                    <i class="ti ti-lock menu-icon"></i> <!-- Correct icon class for roles -->
                    <span class="menu-title">Roles</span>
                </Link>
            </li>
            <li class="nav-item">
                <!-- Use href instead of :url -->
                <Link class="nav-link" :href="route('permissions.index')">
                    <i class="ti ti-key menu-icon"></i> <!-- Correct icon class for permissions -->
                    <span class="menu-title">Permissions</span>
                </Link>
            </li>
            <li class="nav-item">
                <!-- Use href instead of :url -->
                <Link class="nav-link" :href="route('users.index')">
                    <i class="ti ti-user menu-icon"></i> <!-- Changed to ti-user for users -->
                    <span class="menu-title">Users</span>
                </Link>
            </li>
        </ul>
    </nav>
</template>
