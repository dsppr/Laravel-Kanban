<template>
    <nav aria-label="Breadcrumb">
        <ol class="flex items-center gap-1 text-sm text-gray-600">
            <li>
                <a href="/" class="block transition hover:text-gray-700">
                    <span class="sr-only">Home</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                </a>
            </li>

            <li
                v-for="(item, index) in items"
                :key="index"
                class="flex items-center"
            >
                <!-- Separator -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 rtl:rotate-180 mx-1"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                    />
                </svg>

                <!-- Breadcrumb Item -->
                <a
                    v-if="item.url"
                    :href="item.url"
                    class="block transition hover:text-gray-700"
                >
                    {{ item.name }}
                </a>
                <span v-else class="text-gray-500">{{ item.name }}</span>
            </li>
        </ol>
    </nav>
</template>

<script setup>
import { defineProps } from "vue";

// Define props for dynamic breadcrumb links
const props = defineProps({
    items: {
        type: Array,
        default: () => [],
    },
});
</script>

<style scoped>
/* Custom styles if needed */
</style>
