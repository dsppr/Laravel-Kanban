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
                        v-for="task in filteredTasksByStatus(status.id)"
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
        project: {
            type: Object,
            required: true,
        },
        tasks: {
            type: Array,
            required: true,
        },
        taskStatuses: {
            type: Array,
            required: true,
        },
    },
    methods: {
        filteredTasksByStatus(statusId) {
            return this.tasks.filter((task) => task.status_id === statusId);
        },
    },
};
</script>

<style scoped>
.kanban-board {
    display: flex;
    gap: 16px;
}

.kanban-column {
    min-width: 300px;
    padding: 24px;
    background-color: #f4f4f4;
    border-radius: 8px;
}

.kanban-cards {
    margin-top: 16px;
}

.kanban-card {
    background-color: #ffffff;
    padding: 8px;
    margin-bottom: 8px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
