<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { AlertTriangle, X, ShieldAlert, CheckCircle, Info, Megaphone, ArrowRight } from '@lucide/vue';
import { ref, computed, onMounted } from 'vue';

const page = usePage();
const settings = computed(() => (page.props.settings as Record<string, any>) || {});
const announcementsProp = computed(() => (page.props.announcements as any[]) || []);
const currentUrl = computed(() => page.url || '/');

const isSystemEnabled = computed(() => {
    const val = settings.value.announcement_system_enabled;
    if (val === undefined || val === null) return true;
    return String(val) !== 'false' && String(val) !== '0';
});

const dismissedModalIds = ref<number[]>([]);

onMounted(() => {
    try {
        const stored = sessionStorage.getItem('dismissed_announcement_modals');
        if (stored) {
            dismissedModalIds.value = JSON.parse(stored);
        }
    } catch (e) {
        dismissedModalIds.value = [];
    }
});

const popupAnnouncements = computed(() => {
    if (!isSystemEnabled.value) return [];

    return announcementsProp.value.filter((item) => {
        if (dismissedModalIds.value.includes(item.id)) return false;
        if (item.display_location !== 'popup') return false;

        if (item.target_pages === 'home') {
            if (currentUrl.value !== '/' && !currentUrl.value.startsWith('/?')) {
                return false;
            }
        } else if (item.target_pages === 'specific' && Array.isArray(item.specific_pages)) {
            const matches = item.specific_pages.some((path: string) =>
                currentUrl.value.startsWith(path)
            );
            if (!matches) return false;
        }

        return true;
    });
});

const activeModalAnnouncement = computed(() => {
    return popupAnnouncements.value[0] || null;
});

const closeModal = (id: number) => {
    dismissedModalIds.value.push(id);
    try {
        sessionStorage.setItem(
            'dismissed_announcement_modals',
            JSON.stringify(dismissedModalIds.value)
        );
    } catch (e) {}
};
</script>

<template>
    <div
        v-if="activeModalAnnouncement"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-md animate-in fade-in duration-300"
        @click.self="activeModalAnnouncement.is_dismissible ? closeModal(activeModalAnnouncement.id) : null"
    >
        <div class="relative bg-white text-slate-800 rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-100">
            <!-- Top Header Accent -->
            <div
                class="px-6 py-5 flex items-center justify-between text-white"
                :style="{ backgroundColor: activeModalAnnouncement.bg_color || '#0f172a' }"
            >
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-xl bg-white/10 backdrop-blur-sm">
                        <AlertTriangle v-if="activeModalAnnouncement.priority === 'Critical'" class="w-6 h-6 text-rose-300 animate-bounce" />
                        <Megaphone v-else class="w-6 h-6 text-white" />
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest font-extrabold px-2 py-0.5 rounded bg-white/20 text-white">
                            {{ activeModalAnnouncement.type }}
                        </span>
                        <h3 class="font-extrabold text-lg tracking-tight mt-1 text-white">
                            {{ activeModalAnnouncement.title }}
                        </h3>
                    </div>
                </div>

                <button
                    v-if="activeModalAnnouncement.is_dismissible"
                    @click="closeModal(activeModalAnnouncement.id)"
                    class="text-white/80 hover:text-white rounded-lg p-1.5 hover:bg-white/10 transition"
                >
                    <X class="w-5 h-5" />
                </button>
            </div>

            <!-- Content Body -->
            <div class="p-6 space-y-4">
                <p class="text-slate-800 font-semibold text-base leading-relaxed">
                    {{ activeModalAnnouncement.short_description }}
                </p>

                <div
                    v-if="activeModalAnnouncement.full_description"
                    class="text-slate-600 text-sm leading-relaxed whitespace-pre-line border-t border-slate-100 pt-3"
                >
                    {{ activeModalAnnouncement.full_description }}
                </div>

                <!-- Footer CTA & Close Button -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <template v-if="activeModalAnnouncement.button_text && activeModalAnnouncement.button_url">
                        <a
                            v-if="activeModalAnnouncement.button_url.startsWith('http')"
                            :href="activeModalAnnouncement.button_url"
                            target="_blank"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 text-white font-bold rounded-xl hover:bg-sky-700 text-xs transition shadow-md hover:shadow-sky-500/25"
                        >
                            <span>{{ activeModalAnnouncement.button_text }}</span>
                            <ArrowRight class="w-4 h-4" />
                        </a>
                        <Link
                            v-else
                            :href="activeModalAnnouncement.button_url"
                            @click="closeModal(activeModalAnnouncement.id)"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 text-white font-bold rounded-xl hover:bg-sky-700 text-xs transition shadow-md hover:shadow-sky-500/25"
                        >
                            <span>{{ activeModalAnnouncement.button_text }}</span>
                            <ArrowRight class="w-4 h-4" />
                        </Link>
                    </template>

                    <button
                        v-if="activeModalAnnouncement.is_dismissible"
                        @click="closeModal(activeModalAnnouncement.id)"
                        class="px-5 py-2.5 bg-slate-100 text-slate-700 font-bold rounded-xl hover:bg-slate-200 text-xs transition"
                    >
                        Dismiss
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
