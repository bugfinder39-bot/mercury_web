<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    partners: any[];
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head title="Manage Partners" />

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold font-display text-base-content">Partners</h1>
                <p class="text-base-content/70">Manage partner logos and references.</p>
            </div>
            <Link href="/admin/partners/create" class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg">Add Partner</Link>
        </div>

        <div class="bg-base-100 border border-base-300 rounded-lg overflow-hidden">
            <table class="table w-full">
                <thead>
                    <tr class="border-b border-base-300 text-base-content">
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="partner in partners" :key="partner.id" class="border-b border-base-300 text-base-content/85">
                        <td>{{ partner.name }}</td>
                        <td>
                            <Link :href="`/admin/partners/${partner.id}/edit`" class="text-amber hover:underline font-medium">Edit</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
