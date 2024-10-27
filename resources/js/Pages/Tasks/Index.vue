<template>
    <div>
        <h1>Task Board</h1>
        <div v-if="projects.length === 0">
            <p>Project belum ada.</p>
        </div>
        <div v-else>
            <p>Pilih proyek untuk melihat tugas:</p>
            <ul>
                <li v-for="project in projects" :key="project.id">
                    <router-link
                        :to="{
                            name: 'tasks.board',
                            params: { id: project.id },
                        }"
                        >{{ project.name }}</router-link
                    >
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        projects: Array,
    },
};
</script>
