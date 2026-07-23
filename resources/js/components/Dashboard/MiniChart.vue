<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        type?: 'line' | 'bar' | 'pie' | 'area' | 'mini';
        data?: number[];
        labels?: string[];
        height?: number;
        color?: string;
    }>(),
    {
        type: 'line',
        data: () => [25, 40, 30, 55, 45, 70, 65, 90],
        labels: () => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        height: 80,
        color: '#E8770C',
    }
);

// Calculate Line / Area Path
const svgPath = computed(() => {
    if (!props.data || props.data.length === 0) return '';
    const max = Math.max(...props.data, 1);
    const min = Math.min(...props.data, 0);
    const range = max - min || 1;

    const points = props.data.map((val, idx) => {
        const x = (idx / (props.data.length - 1)) * 300;
        const y = props.height - ((val - min) / range) * (props.height - 10) - 5;
        return `${x},${y}`;
    });

    return `M ${points.join(' L ')}`;
});

const areaPath = computed(() => {
    if (!svgPath.value) return '';
    return `${svgPath.value} L 300,${props.height} L 0,${props.height} Z`;
});

// Calculate Bar items
const bars = computed(() => {
    if (!props.data || props.data.length === 0) return [];
    const max = Math.max(...props.data, 1);
    return props.data.map((val, idx) => {
        const heightPct = Math.max(8, (val / max) * 100);
        return {
            val,
            label: props.labels[idx] || '',
            heightPct,
        };
    });
});
</script>

<template>
    <div class="w-full select-none">
        <!-- Line or Area Chart -->
        <div v-if="type === 'line' || type === 'area'" class="relative w-full overflow-hidden">
            <svg class="w-full" :height="height" viewBox="0 0 300 80" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" :stop-color="color" stop-opacity="0.3" />
                        <stop offset="100%" :stop-color="color" stop-opacity="0.0" />
                    </linearGradient>
                </defs>

                <!-- Area Fill -->
                <path
                    v-if="type === 'area'"
                    :d="areaPath"
                    fill="url(#chartGradient)"
                />

                <!-- Line -->
                <path
                    :d="svgPath"
                    fill="none"
                    :stroke="color"
                    stroke-width="3"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </div>

        <!-- Bar Chart -->
        <div v-else-if="type === 'bar'" class="flex items-end justify-between gap-1.5 pt-2" :style="{ height: `${height}px` }">
            <div
                v-for="(bar, idx) in bars"
                :key="idx"
                class="group relative flex flex-1 flex-col items-center justify-end h-full"
            >
                <div
                    class="w-full rounded-t transition-all duration-300 group-hover:brightness-110"
                    :style="{ height: `${bar.heightPct}%`, backgroundColor: color }"
                ></div>
                <span v-if="bar.label" class="mt-1 text-[9px] text-slate-400 font-mono truncate w-full text-center">
                    {{ bar.label }}
                </span>
            </div>
        </div>

        <!-- Pie / Donut Chart representation -->
        <div v-else-if="type === 'pie'" class="flex items-center justify-center py-2">
            <div class="relative size-16 rounded-full border-4 border-amber-500 border-t-amber-200 border-r-amber-400 animate-spin-slow flex items-center justify-center">
                <span class="text-[10px] font-bold text-slate-700 font-mono">100%</span>
            </div>
        </div>

        <!-- Mini Stat Card -->
        <div v-else class="flex items-center justify-between">
            <div class="font-display text-xl font-bold" :style="{ color }">
                {{ data[data.length - 1] ?? 0 }}
            </div>
            <div class="text-xs font-semibold text-emerald-600 flex items-center gap-0.5">
                <span>+12.4%</span>
            </div>
        </div>
    </div>
</template>
