<script setup lang="ts">
import { computed } from 'vue';
import MiniChart from '../MiniChart.vue';
import { Users, Eye, Activity } from '@lucide/vue';

const props = defineProps<{
    data?: any;
    widgetKey?: string;
}>();

const onlineCount = computed(() => props.data?.online_count ?? 24);
const todaysCount = computed(() => props.data?.todays_count ?? 482);
const totalCount = computed(() => props.data?.total_count ?? 14290);
const trend = computed(() => props.data?.trend?.values ?? [120, 210, 180, 310, 290, 420, 380]);
</script>

<template>
    <div class="space-y-4">
        <!-- Stats summary row -->
        <div class="grid grid-cols-3 gap-2">
            <div class="rounded-xl bg-slate-50 p-2.5 dark:bg-slate-800/50">
                <span class="text-[10px] text-slate-500 uppercase font-mono block">Online</span>
                <span class="text-base font-bold text-amber-600 flex items-center gap-1">
                    <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    {{ onlineCount }}
                </span>
            </div>
            <div class="rounded-xl bg-slate-50 p-2.5 dark:bg-slate-800/50">
                <span class="text-[10px] text-slate-500 uppercase font-mono block">Today</span>
                <span class="text-base font-bold text-slate-900 dark:text-white">{{ todaysCount }}</span>
            </div>
            <div class="rounded-xl bg-slate-50 p-2.5 dark:bg-slate-800/50">
                <span class="text-[10px] text-slate-500 uppercase font-mono block">Total</span>
                <span class="text-base font-bold text-slate-700 dark:text-slate-300">{{ totalCount }}</span>
            </div>
        </div>

        <!-- Trend Chart -->
        <div>
            <MiniChart type="area" :data="trend" color="#E8770C" :height="70" />
        </div>
    </div>
</template>
