<script setup lang="ts">
import { ShieldCheck, CheckCircle2 } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    data?: any;
}>();

const phpVer = computed(() => props.data?.php_version ?? '8.2.12');
const laravelVer = computed(() => props.data?.laravel_version ?? '11.x');
const env = computed(() => props.data?.environment ?? 'production');
const memory = computed(() => props.data?.memory_usage ?? '18.4 MB');
</script>

<template>
    <div class="space-y-3 text-xs">
        <div class="flex items-center justify-between p-2 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 font-bold">
            <span class="flex items-center gap-1.5">
                <CheckCircle2 class="size-4" />
                Website Core Systems
            </span>
            <span class="uppercase text-[10px] bg-emerald-600 text-white px-2 py-0.5 rounded font-mono">ONLINE</span>
        </div>

        <div class="grid grid-cols-2 gap-2 text-slate-300">
            <div class="p-2 rounded-lg bg-white/5 border border-white/10">
                <span class="text-[10px] text-slate-400 block uppercase font-mono">PHP Engine</span>
                <span class="font-bold text-white font-mono">{{ phpVer }}</span>
            </div>
            <div class="p-2 rounded-lg bg-white/5 border border-white/10">
                <span class="text-[10px] text-slate-400 block uppercase font-mono">Laravel Framework</span>
                <span class="font-bold text-white font-mono">{{ laravelVer }}</span>
            </div>
            <div class="p-2 rounded-lg bg-white/5 border border-white/10">
                <span class="text-[10px] text-slate-400 block uppercase font-mono">RAM Usage</span>
                <span class="font-bold text-amber-400 font-mono">{{ memory }}</span>
            </div>
            <div class="p-2 rounded-lg bg-white/5 border border-white/10">
                <span class="text-[10px] text-slate-400 block uppercase font-mono">Environment</span>
                <span class="font-bold text-white uppercase font-mono">{{ env }}</span>
            </div>
        </div>
    </div>
</template>
