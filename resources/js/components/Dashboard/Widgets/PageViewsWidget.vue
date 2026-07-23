<script setup lang="ts">
import { computed } from 'vue';
import MiniChart from '../MiniChart.vue';

const props = defineProps<{
    data?: any;
}>();

const viewsCount = computed(() => props.data?.views_count ?? 6840);
const topPages = computed(() => props.data?.top_pages ?? [
    { path: '/', views: 2450 },
    { path: '/services', views: 1210 },
    { path: '/about', views: 780 },
    { path: '/exchange-rates', views: 640 }
]);
</script>

<template>
    <div class="space-y-4">
        <div class="flex items-baseline justify-between">
            <span class="text-2xl font-bold font-display text-slate-900 dark:text-white">
                {{ viewsCount }}
            </span>
            <span class="text-xs text-emerald-600 font-semibold">+18.5% this week</span>
        </div>

        <div class="space-y-2">
            <div
                v-for="page in topPages"
                :key="page.path"
                class="flex items-center justify-between text-xs p-1.5 rounded-lg bg-slate-50 dark:bg-slate-800/40"
            >
                <span class="font-mono text-slate-700 dark:text-slate-300 truncate">{{ page.path }}</span>
                <span class="font-bold text-amber-600">{{ page.views }} views</span>
            </div>
        </div>
    </div>
</template>
