<template>
    <div>
        <h1>Buat Tugas Baru untuk Proyek: {{ project.name }}</h1>
        <form @submit.prevent="submit">
            <label>Nama Tugas</label>
            <input v-model="form.title" type="text" required />

            <label>Deskripsi</label>
            <textarea v-model="form.description"></textarea>

            <label>Status</label>
            <select v-model="form.status_id">
                <option
                    v-for="status in statuses"
                    :key="status.id"
                    :value="status.id"
                >
                    {{ status.name }}
                </option>
            </select>

            <button type="submit">Buat Tugas</button>
        </form>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    props: {
        project: Object,
        statuses: Array,
    },
    setup() {
        const form = useForm({
            title: "",
            description: "",
            status_id: "",
        });

        const submit = () => {
            form.post(`/projects/${project.id}/tasks`);
        };

        return { form, submit };
    },
};
</script>

<style scoped>
/* Add your styles here */
</style>
