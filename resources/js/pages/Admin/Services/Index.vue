<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Edit, Trash2, Plus, Folder } from '@lucide/vue';

defineProps<{
    services: any[];
}>();

defineOptions({
    layout: AdminLayout,
});

const deleteService = (id: number) => {
    if (confirm('Are you sure you want to delete this service?')) {
        router.delete(`/admin/services/${id}`, {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Manage Services" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-amber">MB · 03 — SERVICES MODULE</span>
                <h1 class="text-3xl font-bold font-display mt-1" style="color: #0B2540;">Services</h1>
                <p class="font-body text-sm mt-0.5" style="color: #5B6B79;">Manage and organize your logistics and freight service options displayed on the public site.</p>
            </div>
            <div>
                <Link 
                    href="/admin/services/create" 
                    class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg px-5 flex items-center gap-2 font-semibold shadow-sm transition-colors duration-150"
                >
                    <Plus class="size-4" />
                    <span>Add Service</span>
                </Link>
            </div>
        </div>

        <!-- Success Alert -->
        <div v-if="$page.props.flash?.success" class="alert alert-success text-white rounded-lg flex items-center gap-2 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ $page.props.flash.success }}</span>
        </div>

        <!-- Main Card Container -->
        <div class="card-premium overflow-hidden p-0 border border-slate-200">
            <div class="overflow-x-auto">
                <table class="w-full table-premium text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200">
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Order</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Icon</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Name</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Short Description</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Status</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white text-right" style="background-color: #0B2540;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-body">
                        <tr 
                            v-for="service in services" 
                            :key="service.id" 
                            class="hover:bg-slate-50 transition-colors duration-150"
                        >
                            <td class="px-6 py-4 font-mono text-xs font-medium text-slate-500">
                                #{{ service.order }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-slate-100 text-slate-700 font-mono text-xs border border-slate-200">
                                    {{ service.icon || '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium" style="color: #0B2540;">
                                {{ service.name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                                {{ service.short_description || '—' }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-mono font-semibold uppercase tracking-wide border"
                                    :style="service.is_active
                                        ? 'background-color: rgba(31,122,92,0.12); color: #1F7A5C; border-color: rgba(31,122,92,0.25);'
                                        : 'background-color: rgba(11,37,64,0.06); color: #5B6B79; border-color: rgba(11,37,64,0.12);'"
                                >
                                    {{ service.is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3 items-center">
                                    <Link
                                        :href="`/admin/services/${service.id}/edit`"
                                        class="font-mono text-xs font-semibold uppercase tracking-wide transition-colors flex items-center gap-1 hover:underline"
                                        style="color: #E8770C;"
                                    >
                                        <Edit class="size-3.5" />
                                        <span>Edit</span>
                                    </Link>
                                    <button
                                        @click="deleteService(service.id)"
                                        class="font-mono text-xs font-semibold uppercase tracking-wide transition-colors flex items-center gap-1 hover:underline text-red-600 hover:text-red-800"
                                    >
                                        <Trash2 class="size-3.5" />
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!services || services.length === 0">
                            <td colspan="6" class="text-center py-16 font-body text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <Folder class="size-8 text-slate-300" />
                                    <span>No services found. Add a service to get started.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

