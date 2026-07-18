<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    users: any[];
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head title="Manage Users" />

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold font-display" style="color: #0B2540;">Admin Users</h1>
                <p class="mt-1 font-body text-sm" style="color: #64748B;">Manage admin accounts and roles.</p>
            </div>
            <Link href="/admin/users/create" class="btn-primary">Add User</Link>
        </div>

        <div class="card-premium overflow-hidden p-0">
            <table class="w-full table-premium">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td class="font-medium" style="color: #1E293B;">{{ user.name }}</td>
                        <td style="color: #475569;">{{ user.email }}</td>
                        <td>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full font-mono text-xs font-semibold uppercase tracking-wide"
                                style="background-color: rgba(11,37,64,0.08); color: #0B2540; border: 1px solid rgba(11,37,64,0.15);"
                            >{{ user.role }}</span>
                        </td>
                        <td>
                            <Link
                                :href="`/admin/users/${user.id}/edit`"
                                class="font-mono text-xs font-semibold uppercase tracking-wide transition-colors"
                                style="color: #E8770C;"
                                onmouseover="this.style.textDecoration='underline';"
                                onmouseout="this.style.textDecoration='none';"
                            >Edit</Link>
                        </td>
                    </tr>
                    <tr v-if="!users || users.length === 0">
                        <td colspan="4" class="text-center py-12 font-body" style="color: #64748B;">No users found.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
