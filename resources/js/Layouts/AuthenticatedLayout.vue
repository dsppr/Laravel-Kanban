<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
const searchQuery = ref(""); // Menambahkan searchQuery ref
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="border-b border-gray-100 bg-white">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Dashboard
                                </NavLink>
                                <NavLink
                                    :href="route('projects.index')"
                                    :active="route().current('projects.index')"
                                >
                                    Your Work
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Search Bar -->
                            <input
                                type="text"
                                placeholder="Search projects..."
                                v-model="searchQuery"
                                @input="$emit('search', searchQuery)"
                                class="border rounded px-3 py-1 mr-4 w-48"
                            />

                            <!-- Create Project Button -->
                            <Link
                                :href="route('projects.create')"
                                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-3 py-2 rounded-md mr-4"
                            >
                                Create Project
                            </Link>

                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <!-- Dropdown Content -->
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Page Heading and Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
