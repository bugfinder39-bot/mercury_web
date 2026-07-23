<script setup lang="ts">
import { CheckCircle2, XCircle } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    data?: any;
}>();

const sections = computed(() => props.data?.sections ?? [
    { name: 'Hero Banner', is_active: true },
    { name: 'Services Grid', is_active: true },
    { name: 'Global Network Map', is_active: true },
    { name: 'Certifications Carousel', is_active: true },
    { name: 'Exchange Rates Ticker', is_active: true },
    { name: 'Announcements Banner', is_active: true },
]);
</script>

<template>
    <div class="space-y-2 text-xs">
        <div
            v-for="sec in sections"
            :key="sec.name"
            class="flex items-center justify-between p-2 rounded-lg bg-slate-50 dark:bg-slate-800/40"
        >
            <span class="font-medium text-slate-800 dark:text-slate-200 truncate">{{ sec.name }}</span>
            <span v-if="sec.is_active" class="flex items-center gap-1 text-[11px] font-bold text-emerald-600">
                <CheckCircle2 class="size-3.5" />
                Active
            </span>
            <span v-else class="flex items-center gap-1 text-[11px] font-bold text-slate-400">
                <XCircle class="size-3.5" />
                Hidden
            </span>
        </div>
    </div>
</template>
