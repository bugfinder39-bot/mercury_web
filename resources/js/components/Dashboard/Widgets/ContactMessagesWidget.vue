<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { Mail, MailOpen, ArrowRight } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    data?: any;
    recentMessages?: any[];
}>();

const unreadCount = computed(() => props.data?.unread_count ?? 0);
const totalCount = computed(() => props.data?.total_count ?? 0);
const messagesList = computed(() => props.data?.recent ?? props.recentMessages ?? []);

const toggleRead = (id: number) => {
    router.patch(`/admin/messages/${id}/toggle-read`, {}, {
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="space-y-4">
        <!-- Header summary -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="rounded-full bg-amber-500/10 px-2.5 py-1 text-xs font-bold text-amber-600">
                    {{ unreadCount }} Unread
                </span>
                <span class="text-xs text-slate-500">/ {{ totalCount }} Total</span>
            </div>

            <Link href="/admin/messages" class="text-xs font-semibold text-amber-600 hover:underline flex items-center gap-1">
                View Inbox
                <ArrowRight class="size-3" />
            </Link>
        </div>

        <!-- Recent list -->
        <div class="divide-y divide-slate-100 dark:divide-slate-800 rounded-xl bg-slate-50 dark:bg-slate-800/30 overflow-hidden">
            <div v-if="messagesList.length === 0" class="p-4 text-center text-xs text-slate-400">
                No recent messages.
            </div>

            <div
                v-for="msg in messagesList.slice(0, 4)"
                :key="msg.id"
                class="flex items-center justify-between p-3 text-xs hover:bg-slate-100/60 dark:hover:bg-slate-800/60 transition-colors"
            >
                <div class="min-w-0 flex-1 pr-2">
                    <div class="flex items-center gap-1.5">
                        <span class="font-bold text-slate-900 dark:text-white truncate">{{ msg.name }}</span>
                        <span v-if="!msg.is_read" class="size-1.5 rounded-full bg-amber-500"></span>
                    </div>
                    <p class="text-slate-500 truncate text-[11px]">{{ msg.subject || 'No Subject' }}</p>
                </div>

                <button
                    @click="toggleRead(msg.id)"
                    class="p-1 rounded text-slate-400 hover:text-amber-600 transition-colors shrink-0"
                    :title="msg.is_read ? 'Mark unread' : 'Mark read'"
                >
                    <MailOpen v-if="msg.is_read" class="size-3.5" />
                    <Mail v-else class="size-3.5 text-amber-600" />
                </button>
            </div>
        </div>
    </div>
</template>
