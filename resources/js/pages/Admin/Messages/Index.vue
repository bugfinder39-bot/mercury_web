<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    messages: any[];
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head title="Contact Messages" />

    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold font-display text-base-content">Contact Messages</h1>
            <p class="text-base-content/70">Manage form submissions from the public website.</p>
        </div>

        <div class="bg-base-100 border border-base-300 rounded-lg overflow-hidden">
            <table class="table w-full">
                <thead>
                    <tr class="border-b border-base-300 text-base-content">
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="message in messages" :key="message.id" class="border-b border-base-300 text-base-content/85">
                        <td>{{ message.name }} ({{ message.email }})</td>
                        <td>{{ message.subject }}</td>
                        <td>
                            <span class="badge badge-sm font-mono uppercase" :class="message.is_read ? 'badge-outline text-base-content/50' : 'badge-accent bg-amber border-none text-white'">
                                {{ message.is_read ? 'Read' : 'Unread' }}
                            </span>
                        </td>
                        <td>{{ new Date(message.created_at).toLocaleDateString() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
