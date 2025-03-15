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
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </Link>
            </li>
            <li class="nav-item">
                <!-- Use href instead of :url -->
                <Link class="nav-link" :href="route('roles.index')">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Roles</span>
                </Link>
            </li>
            <li class="nav-item">
                <!-- Use href instead of :url -->
                <Link class="nav-link" :href="route('permissions.index')">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Permissions</span>
                </Link>
            </li>
            <li class="nav-item">
                <!-- Use href instead of :url -->
                <Link class="nav-link" :href="route('users.index')">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Users</span>
                </Link>
            </li>
        </ul>
    </nav>
</template>
