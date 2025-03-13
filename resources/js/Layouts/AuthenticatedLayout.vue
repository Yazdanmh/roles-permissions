<template>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <Navbar />

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <Sidebar />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <slot></slot>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div
                        class="d-sm-flex justify-content-center justify-content-sm-between"
                    >
                        <span
                            class="text-muted text-center text-sm-left d-block d-sm-inline-block"
                            >Copyright © 2021. Premium
                            <a
                                href="https://www.bootstrapdash.com/"
                                target="_blank"
                                >Bootstrap admin template</a
                            >
                            from BootstrapDash. All rights reserved.</span
                        >
                        <span
                            class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"
                            >Hand-crafted & made with
                            <i class="ti-heart text-danger ml-1"></i
                        ></span>
                    </div>
                    <div
                        class="d-sm-flex justify-content-center justify-content-sm-between"
                    >
                        <span
                            class="text-muted text-center text-sm-left d-block d-sm-inline-block"
                            >Distributed by
                            <a
                                href="https://www.themewagon.com/"
                                target="_blank"
                                >Themewagon</a
                            ></span
                        >
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</template>

<script setup>
import Navbar from "@/Components/Navbar.vue";
import Sidebar from "@/Components/Sidebar.vue";
import { onMounted } from "vue";

onMounted(() => {
    const script = document.createElement("script");
    script.src = "/path/to/vendors/js/vendor.bundle.base.js";
    script.onload = () => {
        console.log("Vendor script loaded");
    };
    document.body.appendChild(script);
});
</script>
