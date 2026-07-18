<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Edit, Trash2, Plus, Folder, ExternalLink, Image } from '@lucide/vue';

defineProps<{
    partners: any[];
}>();

defineOptions({
    layout: AdminLayout,
});

const deletePartner = (id: number) => {
    if (confirm('Are you sure you want to delete this partner?')) {
        router.delete(`/admin/partners/${id}`, {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Manage Partners" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-amber">MB · 04 — PARTNERS MODULE</span>
                <h1 class="text-3xl font-bold font-display mt-1" style="color: #0B2540;">Partners</h1>
                <p class="font-body text-sm mt-0.5" style="color: #5B6B79;">Manage partner and client company logos, external websites, and display order.</p>
            </div>
            <div>
                <Link 
                    href="/admin/partners/create" 
                    class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg px-5 flex items-center gap-2 font-semibold shadow-sm transition-colors duration-150"
                >
                    <Plus class="size-4" />
                    <span>Add Partner</span>
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
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Logo</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Name</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Website Link</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Status</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white text-right" style="background-color: #0B2540;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-body">
                        <tr 
                            v-for="partner in partners" 
                            :key="partner.id" 
                            class="hover:bg-slate-50 transition-colors duration-150"
                        >
                            <td class="px-6 py-4 font-mono text-xs font-medium text-slate-500">
                                #{{ partner.order }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-16 h-10 bg-slate-50 border border-slate-200 rounded flex items-center justify-center overflow-hidden p-1">
                                    <img 
                                        v-if="partner.logo" 
                                        :src="partner.logo" 
                                        :alt="partner.name"
                                        class="max-w-full max-h-full object-contain"
                                    />
                                    <Image v-else class="size-5 text-slate-300" />
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium" style="color: #0B2540;">
                                {{ partner.name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                                <a 
                                    v-if="partner.link" 
                                    :href="partner.link" 
                                    target="_blank" 
                                    class="text-amber hover:underline inline-flex items-center gap-1 font-mono text-xs"
                                >
                                    <span>{{ partner.link }}</span>
                                    <ExternalLink class="size-3" />
                                </a>
                                <span v-else class="text-slate-400 font-mono text-xs">—</span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-mono font-semibold uppercase tracking-wide border"
                                    :style="partner.is_active
                                        ? 'background-color: rgba(31,122,92,0.12); color: #1F7A5C; border-color: rgba(31,122,92,0.25);'
                                        : 'background-color: rgba(11,37,64,0.06); color: #5B6B79; border-color: rgba(11,37,64,0.12);'"
                                >
                                    {{ partner.is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3 items-center">
                                    <Link
                                        :href="`/admin/partners/${partner.id}/edit`"
                                        class="font-mono text-xs font-semibold uppercase tracking-wide transition-colors flex items-center gap-1 hover:underline"
                                        style="color: #E8770C;"
                                    >
                                        <Edit class="size-3.5" />
                                        <span>Edit</span>
                                    </Link>
                                    <button
                                        @click="deletePartner(partner.id)"
                                        class="font-mono text-xs font-semibold uppercase tracking-wide transition-colors flex items-center gap-1 hover:underline text-red-600 hover:text-red-800"
                                    >
                                        <Trash2 class="size-3.5" />
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!partners || partners.length === 0">
                            <td colspan="6" class="text-center py-16 font-body text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <Folder class="size-8 text-slate-300" />
                                    <span>No partners found. Add a partner to get started.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
