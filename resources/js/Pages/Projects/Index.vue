<template>
    <AuthenticatedLayout @search="onSearch">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Your Work
                </h2>

                <div class="flex items-center">
                    <!-- Create Project Button -->
                    <Link
                        href="/projects/create"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
                    >
                        Create Project
                    </Link>
                </div>
            </div>
        </template>

        <!-- Daftar Proyek -->
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text-lg font-semibold mb-4">
                            Daftar Proyek
                        </h1>
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 text-left">
                                        Nama Proyek
                                    </th>
                                    <th class="py-2 px-4 text-left">
                                        Deskripsi
                                    </th>
                                    <th class="py-2 px-4 text-left">Status</th>
                                    <th class="py-2 px-4 text-left">
                                        Start Date
                                    </th>
                                    <th class="py-2 px-4 text-left">
                                        Due Date
                                    </th>
                                    <th class="py-2 px-4 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="project in filteredProjects"
                                    :key="project.id"
                                >
                                    <td class="py-2 px-4">
                                        <Link
                                            :href="
                                                route('tasks.board', project.id)
                                            "
                                            class="text-blue-500 hover:underline"
                                        >
                                            {{ project.name }}
                                        </Link>
                                    </td>
                                    <td class="py-2 px-4">
                                        {{ project.description }}
                                    </td>
                                    <td class="py-2 px-4">
                                        {{ project.status.name }}
                                    </td>
                                    <td class="py-2 px-4">
                                        {{ project.start_date }}
                                    </td>
                                    <td class="py-2 px-4">
                                        {{ project.due_date }}
                                    </td>
                                    <td class="py-2 px-4 relative">
                                        <button
                                            @click="toggleDropdown(project.id)"
                                            class="ellipsis-button"
                                        >
                                            •••
                                        </button>
                                        <div
                                            v-if="isDropdownOpen(project.id)"
                                            class="dropdown-menu absolute bg-white border rounded shadow-lg py-1 right-0 mt-1"
                                        >
                                            <Link
                                                :href="`/projects/${project.id}/edit`"
                                                class="block px-4 py-2 text-green-600 hover:bg-gray-100"
                                                >Edit</Link
                                            >
                                            <button
                                                @click="
                                                    deleteProject(project.id)
                                                "
                                                class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="!filteredProjects.length">
                                    <td colspan="6" class="py-4 text-center">
                                        No projects found
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        projects: Array,
    },
};
</script>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, computed } from "vue";
import { Link, router } from "@inertiajs/vue3";

const props = defineProps(["projects"]);
const search = ref("");

// Listen for search input from AuthenticatedLayout.vue
const onSearch = (query) => {
    search.value = query;
};

// Filter projects based on search input
const filteredProjects = computed(() => {
    if (!search.value) {
        return props.projects;
    }
    return props.projects.filter((project) =>
        project.name.toLowerCase().includes(search.value.toLowerCase())
    );
});

const dropdownOpenId = ref(null);

// Toggle dropdown for specific project
const toggleDropdown = (id) => {
    dropdownOpenId.value = dropdownOpenId.value === id ? null : id;
};

// Check if dropdown is open for specific project
const isDropdownOpen = (id) => {
    return dropdownOpenId.value === id;
};

// Delete project function
const deleteProject = (id) => {
    if (confirm("Are you sure you want to delete this project?")) {
        router.delete(`/projects/${id}`, {
            onSuccess: () => {
                alert("Project deleted successfully");
            },
            onError: (errors) => {
                console.error("Delete failed:", errors);
                alert("Failed to delete project. Please try again.");
            },
        });
    }
};
</script>

<style scoped>
.ellipsis-button {
    background: none;
    border: none;
    font-size: 1.5em;
    cursor: pointer;
    color: #333;
}
.dropdown-menu {
    min-width: 100px;
    z-index: 10;
}
</style>
