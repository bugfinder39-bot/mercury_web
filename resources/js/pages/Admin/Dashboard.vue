<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    stats: {
        pages_count: number;
        services_count: number;
        partners_count: number;
        unread_messages_count: number;
    };
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head title="CMS Dashboard" />

    <div class="space-y-8">
        <div>
            <h1 class="text-3xl font-bold font-display text-base-content">CMS Control Panel</h1>
            <p class="text-base-content/70 mt-1">Manage public website contents and incoming messages.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="card bg-base-100 border border-base-300 p-6 rounded-lg">
                <span class="text-sm font-mono text-base-content/70 uppercase">Web Pages</span>
                <h2 class="text-3xl font-bold font-display mt-2 text-base-content">{{ stats?.pages_count ?? 4 }}</h2>
            </div>
            <div class="card bg-base-100 border border-base-300 p-6 rounded-lg">
                <span class="text-sm font-mono text-base-content/70 uppercase">Active Services</span>
                <h2 class="text-3xl font-bold font-display mt-2 text-base-content">{{ stats?.services_count ?? 4 }}</h2>
            </div>
            <div class="card bg-base-100 border border-base-300 p-6 rounded-lg">
                <span class="text-sm font-mono text-base-content/70 uppercase">Partners</span>
                <h2 class="text-3xl font-bold font-display mt-2 text-base-content">{{ stats?.partners_count ?? 4 }}</h2>
            </div>
            <div class="card bg-base-100 border border-base-300 p-6 rounded-lg">
                <span class="text-sm font-mono text-base-content/70 uppercase">Unread Messages</span>
                <h2 class="text-3xl font-bold font-display mt-2 text-amber">{{ stats?.unread_messages_count ?? 0 }}</h2>
            </div>
        </div>
    </div>
</template>
