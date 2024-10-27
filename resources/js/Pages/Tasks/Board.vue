<template>
    <div>
        <h1>{{ project.name }} - Kanban Board</h1>
        <div class="kanban-board">
            <div
                v-for="status in taskStatuses"
                :key="status.id"
                class="kanban-column"
            >
                <h3>{{ status.name }}</h3>
                <div class="kanban-cards">
                    <div
                        v-for="task in tasks"
                        v-if="task.status_id === status.id"
                        :key="task.id"
                        class="kanban-card"
                    >
                        {{ task.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        project: Object,
        tasks: Array,
        taskStatuses: Array, // Berikan array status tugas dari controller
    },
};
</script>
