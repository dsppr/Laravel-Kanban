<template>
    <div>
        <h2>{{ project.name }}</h2>
        <p>{{ project.description }}</p>
        <p>Status: {{ project.status.name }}</p>

        <h3>Tasks</h3>
        <ul>
            <li v-for="task in project.tasks" :key="task.id">
                {{ task.title }} - {{ task.status.name }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        project: Object,
    },
};
</script>
