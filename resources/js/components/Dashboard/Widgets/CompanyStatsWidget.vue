<script setup lang="ts">
import { Folder, Globe, Award, Layers } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    data?: any;
}>();

const services = computed(() => props.data?.services ?? 6);
const hubs = computed(() => props.data?.network_hubs ?? 12);
const certs = computed(() => props.data?.certifications ?? 8);
const partners = computed(() => props.data?.partners ?? 15);
</script>

<template>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="flex items-center gap-3 p-4 rounded-xl bg-white/10 backdrop-blur border border-white/15 text-white">
            <div class="p-2.5 rounded-lg bg-amber-500 text-white">
                <Folder class="size-5" />
            </div>
            <div>
                <span class="text-2xl font-bold font-display block">{{ services }}</span>
                <span class="text-xs text-slate-300">Active Services</span>
            </div>
        </div>

        <div class="flex items-center gap-3 p-4 rounded-xl bg-white/10 backdrop-blur border border-white/15 text-white">
            <div class="p-2.5 rounded-lg bg-emerald-500 text-white">
                <Globe class="size-5" />
            </div>
            <div>
                <span class="text-2xl font-bold font-display block">{{ hubs }}</span>
                <span class="text-xs text-slate-300">Global Hubs</span>
            </div>
        </div>

        <div class="flex items-center gap-3 p-4 rounded-xl bg-white/10 backdrop-blur border border-white/15 text-white">
            <div class="p-2.5 rounded-lg bg-sky-500 text-white">
                <Award class="size-5" />
            </div>
            <div>
                <span class="text-2xl font-bold font-display block">{{ certs }}</span>
                <span class="text-xs text-slate-300">Certifications</span>
            </div>
        </div>

        <div class="flex items-center gap-3 p-4 rounded-xl bg-white/10 backdrop-blur border border-white/15 text-white">
            <div class="p-2.5 rounded-lg bg-indigo-500 text-white">
                <Layers class="size-5" />
            </div>
            <div>
                <span class="text-2xl font-bold font-display block">{{ partners }}</span>
                <span class="text-xs text-slate-300">Active Partners</span>
            </div>
        </div>
    </div>
</template>
