<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    services: any[];
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head title="Manage Services" />

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold font-display text-base-content">Services</h1>
                <p class="text-base-content/70">Manage logistics and freight services list.</p>
            </div>
            <Link href="/admin/services/create" class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg">Add Service</Link>
        </div>

        <div class="bg-base-100 border border-base-300 rounded-lg overflow-hidden">
            <!-- Services table stub -->
            <table class="table w-full">
                <thead>
                    <tr class="border-b border-base-300 text-base-content">
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="service in services" :key="service.id" class="border-b border-base-300 text-base-content/85">
                        <td>{{ service.name }}</td>
                        <td>
                            <span class="badge badge-sm uppercase font-mono px-2 py-0.5 rounded-full" :class="service.is_active ? 'badge-success text-white border-none bg-emerald-600' : 'badge-outline text-base-content/60'">
                                {{ service.is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <Link :href="`/admin/services/${service.id}/edit`" class="text-amber hover:underline font-medium">Edit</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
