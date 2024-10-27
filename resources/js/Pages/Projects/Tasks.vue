<template>
    <AuthenticatedLayout>
        <div class="tasks-page">
            <Breadcrumb :items="breadcrumbs" />

            <div class="header-actions mb-6">
                <button
                    @click="openAddTaskModal"
                    class="bg-indigo-600 text-white px-6 py-2 rounded shadow-md transition duration-300 ease-in-out transform hover:bg-indigo-700 hover:scale-105 focus:outline-none focus:ring focus:ring-indigo-300"
                >
                    Add Task
                </button>
            </div>

            <div class="task-board grid grid-cols-4 gap-6">
                <div
                    v-for="status in taskStatuses"
                    :key="status.id"
                    class="task-column bg-gray-50 p-6 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:shadow-xl"
                >
                    <h2 class="text-xl font-semibold text-indigo-600 mb-4">
                        {{ status.name }}
                    </h2>
                    <div
                        v-for="task in filteredTasksByStatus(status.name)"
                        :key="task.id"
                        class="task-card mb-6 p-4 bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition duration-300 ease-in-out"
                    >
                        <strong
                            class="text-xs bg-indigo-500 text-white px-2 py-1 rounded-full"
                            >{{ task.status }}</strong
                        >
                        <h3 class="text-lg font-semibold mt-2">
                            {{ task.title }}
                        </h3>
                        <p class="text-sm text-gray-700 mt-1">
                            {{ task.description }}
                        </p>
                    </div>
                </div>
            </div>

            <div v-if="isModalOpen" class="modal-overlay">
                <div class="modal">
                    <h2>Add New Task</h2>
                    <input
                        type="text"
                        v-model="newTaskName"
                        placeholder="Task Name"
                    />
                    <textarea
                        v-model="newTaskDescription"
                        placeholder="Description"
                    ></textarea>
                    <button @click="submitNewTask">Submit</button>
                    <button @click="closeAddTaskModal">Close</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { ref, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";

const breadcrumbs = [
    { name: "Projects", url: "/projects" },
    { name: "Project Details", url: "/projects" },
    { name: "Edit Project" },
];

export default {
    components: {
        AuthenticatedLayout,
        Breadcrumb,
    },
    props: {
        projectName: String,
        tasks: Array,
        taskStatuses: Array,
    },
    setup(props) {
        const isModalOpen = ref(false);
        const newTaskName = ref("");
        const newTaskDescription = ref("");

        const filteredTasksByStatus = (status) => {
            return props.tasks.filter((task) => task.status === status);
        };

        const openAddTaskModal = () => {
            isModalOpen.value = true;
        };

        const closeAddTaskModal = () => {
            isModalOpen.value = false;
        };

        const submitNewTask = () => {
            console.log(
                "Task submitted:",
                newTaskName.value,
                newTaskDescription.value
            );
            closeAddTaskModal();
        };

        return {
            filteredTasksByStatus,
            openAddTaskModal,
            closeAddTaskModal,
            submitNewTask,
            isModalOpen,
            newTaskName,
            newTaskDescription,
            breadcrumbs,
        };
    },
};
</script>

<style scoped>
.tasks-page {
    padding: 20px;
    background-color: #f7fafc;
}
.header-actions {
    display: flex;
    justify-content: flex-end;
}
.task-board {
    margin-top: 20px;
}
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
}
</style>
