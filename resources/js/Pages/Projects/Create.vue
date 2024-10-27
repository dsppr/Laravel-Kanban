<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Project
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label
                                    for="name"
                                    class="block text-sm font-medium text-gray-700"
                                    >Project Name</label
                                >
                                <input
                                    type="text"
                                    id="name"
                                    v-model="form.name"
                                    required
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="description"
                                    class="block text-sm font-medium text-gray-700"
                                    >Description</label
                                >
                                <textarea
                                    id="description"
                                    v-model="form.description"
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                ></textarea>
                            </div>
                            <div class="mb-4">
                                <label
                                    for="status"
                                    class="block text-sm font-medium text-gray-700"
                                    >Status</label
                                >
                                <select
                                    id="status"
                                    v-model="form.status_id"
                                    required
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                >
                                    <option
                                        v-for="status in statuses"
                                        :key="status.id"
                                        :value="status.id"
                                    >
                                        {{ status.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label
                                    for="start_date"
                                    class="block text-sm font-medium text-gray-700"
                                    >Start Date</label
                                >
                                <input
                                    type="date"
                                    id="start_date"
                                    v-model="form.start_date"
                                    required
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="due_date"
                                    class="block text-sm font-medium text-gray-700"
                                    >Due Date</label
                                >
                                <input
                                    type="date"
                                    id="due_date"
                                    v-model="form.due_date"
                                    required
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                />
                            </div>
                            <div class="flex justify-end">
                                <button
                                    type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring focus:ring-blue-300"
                                >
                                    Create Project
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({ statuses: Array });
const { ref } = require("vue");
const { useForm } = require("@inertiajs/inertia-vue3");

const form = useForm({
    name: "",
    description: "",
    status_id: "",
    start_date: "",
    due_date: "",
});

function submit() {
    form.post("/projects");
}
</script>
