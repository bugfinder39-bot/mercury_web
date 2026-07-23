<script setup lang="ts">
import { ShieldAlert, Clock } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    data?: any;
}>();

const logs = computed(() => props.data?.logs ?? [
    { id: 1, user_name: 'Super Admin', action: 'dashboard_layout_saved', description: 'Updated dashboard layout', created_at: new Date().toISOString() },
    { id: 2, user_name: 'Admin User', action: 'rate_updated', description: 'Updated USD exchange rate', created_at: new Date().toISOString() },
]);

const formatDate = (dateStr: string) => {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
};
</script>

<template>
    <div class="space-y-2 text-xs">
        <div v-if="logs.length === 0" class="p-4 text-center text-slate-400">
            No audit logs recorded yet.
        </div>

        <div
            v-for="log in logs.slice(0, 5)"
            :key="log.id"
            class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800"
        >
            <div class="min-w-0 flex-1 pr-2">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-slate-900 dark:text-white font-mono text-[11px]">{{ log.user_name }}</span>
                    <span class="rounded bg-amber-500/10 px-1.5 py-0.5 text-[9px] font-bold text-amber-600 font-mono uppercase">
                        {{ log.action }}
                    </span>
                </div>
                <p class="text-slate-500 truncate text-[11px] mt-0.5">{{ log.description || 'Action completed' }}</p>
            </div>

            <span class="text-[10px] text-slate-400 font-mono shrink-0 flex items-center gap-1">
                <Clock class="size-3" />
                {{ formatDate(log.created_at) }}
            </span>
        </div>
    </div>
</template>
