<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight"
                    >
                        {{ project.name }}
                    </h2>
                    <p class="text-sm text-gray-600">
                        <Link
                            href="/projects"
                            class="text-blue-500 hover:underline"
                            >Projects</Link
                        >
                        / {{ project.name }}
                    </p>
                </div>
                <button
                    @click="addTask"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Add Task
                </button>
            </div>
        </template>

        <div class="grid grid-cols-4 gap-4 mt-6">
            <div
                v-for="(tasks, status) in taskStatuses"
                :key="status"
                class="bg-gray-100 p-4 rounded"
            >
                <h3 class="font-semibold text-lg">{{ status }}</h3>
                <div
                    v-for="task in tasks"
                    :key="task.id"
                    class="bg-white p-4 rounded shadow mt-2"
                >
                    <h4 class="font-semibold">{{ task.title }}</h4>
                    <p class="text-sm text-gray-600">{{ task.description }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router } from "@inertiajs/vue3";

export default {
    components: {
        AuthenticatedLayout,
    },
    setup() {
        const { project, tasks } = usePage().props.value;

        // Group tasks by their status
        const taskStatuses = computed(() => {
            return {
                "TO DO": tasks.filter((task) => task.status.name === "TO DO"),
                "IN PROGRESS": tasks.filter(
                    (task) => task.status.name === "IN PROGRESS"
                ),
                "IN REVIEW": tasks.filter(
                    (task) => task.status.name === "IN REVIEW"
                ),
                DONE: tasks.filter((task) => task.status.name === "DONE"),
            };
        });

        const addTask = () => {
            router.visit(route("tasks.index", { project: project.id }));
        };

        return {
            project,
            taskStatuses,
            addTask,
        };
    },
};
</script>

<style scoped>
/* Styling sesuai kebutuhan */
</style>
