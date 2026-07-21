<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BookOpen, Edit } from '@lucide/vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    pages: any[];
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head title="Page Management" />

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold font-display" style="color: #0B2540;">Page Management</h1>
                <p class="mt-1 font-body text-sm" style="color: #64748B;">Manage static public pages, their sections, items, and SEO details.</p>
            </div>
        </div>

        <div class="card-premium overflow-hidden p-0">
            <table class="w-full table-premium">
                <thead>
                    <tr>
                        <th class="w-1/4">Page Name</th>
                        <th class="w-1/6">Slug</th>
                        <th class="w-1/4">SEO Meta Title</th>
                        <th class="w-1/4">SEO Meta Description</th>
                        <th class="w-1/12 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="page in pages" :key="page.id">
                        <td class="font-medium" style="color: #1E293B;">
                            <div class="flex items-center gap-2">
                                <BookOpen class="size-4" style="color: #E8770C;" />
                                <span>{{ page.name }}</span>
                            </div>
                        </td>
                        <td class="font-mono text-xs text-secondary-txt font-semibold">/{{ page.slug }}</td>
                        <td class="text-xs text-secondary-txt truncate max-w-xs">{{ page.meta_title || 'Not Set' }}</td>
                        <td class="text-xs text-muted truncate max-w-xs">{{ page.meta_description || 'Not Set' }}</td>
                        <td class="text-right">
                            <Link
                                :href="`/admin/pages/${page.id}/edit`"
                                class="inline-flex items-center gap-1.5 font-mono text-xs font-semibold uppercase tracking-wide transition-colors"
                                style="color: #E8770C;"
                                onmouseover="this.style.textDecoration='underline';"
                                onmouseout="this.style.textDecoration='none';"
                            >
                                <Edit class="size-3" />
                                <span>Edit</span>
                            </Link>
                        </td>
                    </tr>
                    <tr v-if="!pages || pages.length === 0">
                        <td colspan="5" class="text-center py-12 font-body" style="color: #64748B;">No pages found.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
