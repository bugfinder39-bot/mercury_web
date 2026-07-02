<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    user?: any;
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head :title="user ? 'Edit User' : 'Create User'" />

    <div class="space-y-6">
        <h1 class="text-3xl font-bold font-display text-base-content">{{ user ? 'Edit User' : 'Create User' }}</h1>

        <div class="bg-base-100 border border-base-300 p-6 rounded-lg max-w-2xl">
            <p class="text-base-content/70">Form placeholder for creating/editing user accounts and roles.</p>
        </div>
    </div>
</template>
