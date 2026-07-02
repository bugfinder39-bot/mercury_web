<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    page: any;
    sections: any[];
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head :title="`Edit Page: ${page?.name}`" />

    <div class="space-y-6">
        <h1 class="text-3xl font-bold font-display text-base-content">Edit Page: {{ page?.name }}</h1>
        <p class="text-base-content/70">Modify sections, ordering, and static texts for this page.</p>

        <div class="space-y-4">
            <!-- Sections list -->
            <div v-for="section in sections" :key="section.id" class="p-6 bg-base-100 border border-base-300 rounded-lg">
                <h3 class="font-display font-bold text-base-content">{{ section.heading || section.type }}</h3>
                <span class="text-xs font-mono text-base-content/60 uppercase">{{ section.type }}</span>
            </div>
        </div>
    </div>
</template>
