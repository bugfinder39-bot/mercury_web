<script setup lang="ts">
import { UserCheck } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    data?: any;
}>();

const users = computed(() => props.data?.users ?? []);
</script>

<template>
    <div class="space-y-2 text-xs">
        <div v-if="users.length === 0" class="p-3 text-center text-slate-400">
            No admin users found.
        </div>

        <div
            v-for="u in users"
            :key="u.id"
            class="flex items-center justify-between p-2 rounded-lg bg-slate-50 dark:bg-slate-800/40"
        >
            <div class="flex items-center gap-2 min-w-0">
                <div class="flex size-6 shrink-0 items-center justify-center rounded-full bg-amber-500 font-bold text-white text-[10px]">
                    {{ u.name ? u.name.charAt(0) : 'U' }}
                </div>
                <div class="min-w-0">
                    <span class="font-bold text-slate-900 dark:text-white truncate block leading-tight">{{ u.name }}</span>
                    <span class="text-[10px] text-slate-400 truncate block">{{ u.email }}</span>
                </div>
            </div>
            <span class="text-[9px] uppercase font-bold font-mono px-1.5 py-0.5 rounded bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                {{ u.role || 'Admin' }}
            </span>
        </div>
    </div>
</template>
