<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { BookOpen, Folder, Layers, Mail } from '@lucide/vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps<{
    stats: {
        pages_count: number;
        services_count: number;
        partners_count: number;
        unread_messages_count: number;
    };
}>();

defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <Head title="CMS Dashboard" />

    <div class="space-y-8">
        <!-- Page Header -->
        <div>
            <h1 class="text-3xl font-bold font-display" style="color: #0B2540;">CMS Control Panel</h1>
            <p class="mt-1 font-body text-sm" style="color: #64748B;">Manage public website contents and incoming messages.</p>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Web Pages -->
            <div class="card-premium p-6 flex items-start gap-4">
                <div class="icon-orange-wrap flex-shrink-0">
                    <BookOpen class="size-5 stroke-[1.5]" />
                </div>
                <div>
                    <p class="font-mono text-xs uppercase tracking-wider" style="color: #64748B;">Web Pages</p>
                    <h2 class="text-3xl font-bold font-display mt-1" style="color: #0B2540;">{{ stats?.pages_count ?? 4 }}</h2>
                </div>
            </div>

            <!-- Active Services -->
            <div class="card-premium p-6 flex items-start gap-4">
                <div class="icon-orange-wrap flex-shrink-0">
                    <Folder class="size-5 stroke-[1.5]" />
                </div>
                <div>
                    <p class="font-mono text-xs uppercase tracking-wider" style="color: #64748B;">Active Services</p>
                    <h2 class="text-3xl font-bold font-display mt-1" style="color: #0B2540;">{{ stats?.services_count ?? 4 }}</h2>
                </div>
            </div>

            <!-- Partners -->
            <div class="card-premium p-6 flex items-start gap-4">
                <div class="icon-orange-wrap flex-shrink-0">
                    <Layers class="size-5 stroke-[1.5]" />
                </div>
                <div>
                    <p class="font-mono text-xs uppercase tracking-wider" style="color: #64748B;">Partners</p>
                    <h2 class="text-3xl font-bold font-display mt-1" style="color: #0B2540;">{{ stats?.partners_count ?? 4 }}</h2>
                </div>
            </div>

            <!-- Unread Messages -->
            <div
                class="card-premium p-6 flex items-start gap-4"
                style="border-color: rgba(232,119,12,0.25); background: linear-gradient(135deg, #fff 60%, rgba(232,119,12,0.04) 100%);"
            >
                <div class="icon-orange-wrap flex-shrink-0">
                    <Mail class="size-5 stroke-[1.5]" />
                </div>
                <div>
                    <p class="font-mono text-xs uppercase tracking-wider" style="color: #64748B;">Unread Messages</p>
                    <h2 class="text-3xl font-bold font-display mt-1" style="color: #E8770C;">{{ stats?.unread_messages_count ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
</template>
