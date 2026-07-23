<script setup lang="ts">
import { HardDrive } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    data?: any;
}>();

const filesCount = computed(() => props.data?.files_count ?? 42);
const used = computed(() => props.data?.storage_used_mb ?? '24.5 MB');
const total = computed(() => props.data?.storage_capacity_mb ?? '1024 MB');
const pct = computed(() => props.data?.usage_percentage ?? 18);
</script>

<template>
    <div class="space-y-3">
        <div class="flex items-center justify-between text-xs">
            <span class="text-slate-500 font-medium">Uploaded Files: <strong class="text-slate-900 dark:text-white font-mono">{{ filesCount }}</strong></span>
            <span class="font-mono text-amber-600 font-bold">{{ used }} / {{ total }}</span>
        </div>

        <div>
            <div class="h-2.5 w-full rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                <div class="h-full rounded-full bg-amber-500 transition-all duration-500" :style="{ width: `${pct}%` }"></div>
            </div>
            <div class="mt-1 flex justify-between text-[10px] text-slate-400 font-mono">
                <span>Used: {{ pct }}%</span>
                <span>Available: {{ 100 - pct }}%</span>
            </div>
        </div>
    </div>
</template>
