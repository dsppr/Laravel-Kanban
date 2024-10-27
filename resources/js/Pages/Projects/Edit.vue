<template>
    <AuthenticatedLayout>
        <h1>Edit Project</h1>
        <form @submit.prevent="updateProject">
            <div>
                <label>Name</label>
                <input v-model="form.name" type="text" required />
            </div>
            <div>
                <label>Description</label>
                <textarea v-model="form.description"></textarea>
            </div>
            <div>
                <label>Status</label>
                <select v-model="form.status_id">
                    <option
                        v-for="status in statuses"
                        :value="status.id"
                        :key="status.id"
                    >
                        {{ status.name }}
                    </option>
                </select>
            </div>
            <button type="submit">Update Project</button>
        </form>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps(["project", "statuses"]);
const form = ref({ ...props.project });

const updateProject = () => {
    router.put(`/projects/${form.value.id}`, form.value, {
        onSuccess: () => alert("Project updated successfully"),
    });
};
</script>
