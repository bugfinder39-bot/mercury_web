<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    partner?: any;
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head :title="partner ? 'Edit Partner' : 'Create Partner'" />

    <div class="space-y-6">
        <h1 class="text-3xl font-bold font-display text-base-content">{{ partner ? 'Edit Partner' : 'Create Partner' }}</h1>

        <div class="bg-base-100 border border-base-300 p-6 rounded-lg max-w-2xl">
            <p class="text-base-content/70">Form placeholder for creating/editing partner parameters.</p>
        </div>
    </div>
</template>
