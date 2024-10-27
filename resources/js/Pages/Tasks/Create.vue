<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Task
            </h2>
        </template>

        <div class="mt-6 max-w-lg mx-auto">
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700"
                        >Title</label
                    >
                    <input
                        v-model="form.title"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700"
                        >Description</label
                    >
                    <textarea
                        v-model="form.description"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    ></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700"
                        >Status</label
                    >
                    <select
                        v-model="form.status_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
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

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Save Task
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { ref } from "vue";
import { usePage, router } from "@inertiajs/vue3";

export default {
    setup() {
        const { statuses, project } = usePage().props.value;
        const form = ref({
            title: "",
            description: "",
            status_id: "",
        });

        const submitForm = () => {
            router.post(`/projects/${project.id}/tasks`, form.value, {
                onSuccess: () => {
                    router.visit(`/projects/${project.id}/tasks`);
                },
            });
        };

        return {
            form,
            statuses,
            submitForm,
        };
    },
};
</script>

<style scoped>
/* Tambahkan styling sesuai kebutuhan */
</style>
