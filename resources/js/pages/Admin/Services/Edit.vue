<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    service?: any;
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head :title="service ? 'Edit Service' : 'Create Service'" />

    <div class="space-y-6">
        <h1 class="text-3xl font-bold font-display text-base-content">{{ service ? 'Edit Service' : 'Create Service' }}</h1>

        <!-- Form stub -->
        <div class="bg-base-100 border border-base-300 p-6 rounded-lg max-w-2xl">
            <!-- Form fields go here -->
            <p class="text-base-content/70">Form placeholder for creating/editing service parameters.</p>
        </div>
    </div>
</template>
