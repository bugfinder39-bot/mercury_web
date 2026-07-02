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
                <h1 class="text-3xl font-bold font-display text-base-content">Admin Users</h1>
                <p class="text-base-content/70">Manage admin accounts and roles.</p>
            </div>
            <Link href="/admin/users/create" class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg">Add User</Link>
        </div>

        <div class="bg-base-100 border border-base-300 rounded-lg overflow-hidden">
            <table class="table w-full">
                <thead>
                    <tr class="border-b border-base-300 text-base-content">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id" class="border-b border-base-300 text-base-content/85">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td><span class="badge badge-outline rounded-full px-3 py-1 font-mono uppercase text-xs">{{ user.role }}</span></td>
                        <td>
                            <Link :href="`/admin/users/${user.id}/edit`" class="text-amber hover:underline font-medium">Edit</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
