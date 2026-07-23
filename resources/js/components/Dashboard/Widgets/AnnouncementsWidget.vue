<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Megaphone, Pin, ArrowRight } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    data?: any;
}>();

const activeCount = computed(() => props.data?.active_count ?? 0);
const pinnedList = computed(() => props.data?.pinned ?? []);
</script>

<template>
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">
                Active Notices: <strong class="text-amber-600 font-mono">{{ activeCount }}</strong>
            </span>
            <Link href="/admin/announcements" class="text-xs font-semibold text-amber-600 hover:underline flex items-center gap-1">
                Manage
                <ArrowRight class="size-3" />
            </Link>
        </div>

        <div class="space-y-2">
            <div v-if="pinnedList.length === 0" class="p-3 text-center text-xs text-slate-400 rounded-xl bg-slate-50 dark:bg-slate-800/30">
                No pinned announcements active.
            </div>

            <div
                v-for="item in pinnedList"
                :key="item.id"
                class="flex items-center justify-between p-2.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs"
            >
                <div class="flex items-center gap-2 min-w-0">
                    <Pin class="size-3.5 text-amber-600 shrink-0" />
                    <span class="font-semibold text-slate-900 dark:text-white truncate">{{ item.title }}</span>
                </div>
                <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded bg-amber-500 text-white shrink-0">
                    {{ item.type || item.priority || 'Notice' }}
                </span>
            </div>
        </div>
    </div>
</template>
