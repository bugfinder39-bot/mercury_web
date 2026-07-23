<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import {
    Megaphone,
    X,
    ChevronLeft,
    ChevronRight,
    Pin,
    ArrowRight,
    Wrench,
    Plane,
    AlertTriangle,
    Info,
    CheckCircle,
    Calendar,
    Bell,
} from '@lucide/vue';
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';

const page = usePage();

const settings = computed(() => (page.props.settings as Record<string, any>) || {});
const announcementsProp = computed(() => (page.props.announcements as any[]) || []);
const currentUrl = computed(() => page.url || '/');

const isSystemEnabled = computed(() => {
    const val = settings.value.announcement_system_enabled;
    if (val === undefined || val === null) return true;
    return String(val) !== 'false' && String(val) !== '0';
});

const isShowMultiple = computed(() => {
    const val = settings.value.announcement_show_multiple;
    if (val === undefined || val === null) return true;
    return String(val) !== 'false' && String(val) !== '0';
});

const maxItems = computed(() => {
    const val = parseInt(settings.value.announcement_max_items || '5', 10);
    return isNaN(val) ? 5 : val;
});

const isAutoRotate = computed(() => {
    const val = settings.value.announcement_auto_rotate;
    if (val === undefined || val === null) return true;
    return String(val) !== 'false' && String(val) !== '0';
});

const displayDuration = computed(() => {
    const val = parseInt(settings.value.announcement_display_duration || '5', 10);
    return (isNaN(val) ? 5 : val) * 1000;
});

const animationStyle = computed(() => {
    return settings.value.announcement_animation_style || 'slide';
});

const dismissedIds = ref<number[]>([]);

onMounted(() => {
    try {
        const stored = sessionStorage.getItem('dismissed_announcements');
        if (stored) {
            dismissedIds.value = JSON.parse(stored);
        }
    } catch (e) {
        dismissedIds.value = [];
    }
});

const filteredAnnouncements = computed(() => {
    if (!isSystemEnabled.value) return [];

    return announcementsProp.value.filter((item) => {
        if (dismissedIds.value.includes(item.id)) return false;

        // Check display location
        if (item.display_location && item.display_location !== 'top_bar') {
            return false;
        }

        // Check target pages
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
    }).slice(0, maxItems.value);
});

const currentIndex = ref(0);
let timer: any = null;

const activeAnnouncement = computed(() => {
    if (filteredAnnouncements.value.length === 0) return null;
    return filteredAnnouncements.value[currentIndex.value % filteredAnnouncements.value.length];
});

const nextAnnouncement = () => {
    if (filteredAnnouncements.value.length > 1) {
        currentIndex.value = (currentIndex.value + 1) % filteredAnnouncements.value.length;
    }
};

const prevAnnouncement = () => {
    if (filteredAnnouncements.value.length > 1) {
        currentIndex.value =
            (currentIndex.value - 1 + filteredAnnouncements.value.length) %
            filteredAnnouncements.value.length;
    }
};

const startTimer = () => {
    stopTimer();
    if (isAutoRotate.value && filteredAnnouncements.value.length > 1) {
        timer = setInterval(() => {
            nextAnnouncement();
        }, displayDuration.value);
    }
};

const stopTimer = () => {
    if (timer) {
        clearInterval(timer);
        timer = null;
    }
};

watch(
    () => [filteredAnnouncements.value.length, isAutoRotate.value, displayDuration.value],
    () => {
        if (currentIndex.value >= filteredAnnouncements.value.length) {
            currentIndex.value = 0;
        }
        startTimer();
    },
    { immediate: true }
);

onUnmounted(() => {
    stopTimer();
});

const dismiss = (id: number) => {
    dismissedIds.value.push(id);
    try {
        sessionStorage.setItem('dismissed_announcements', JSON.stringify(dismissedIds.value));
    } catch (e) {}

    if (currentIndex.value >= filteredAnnouncements.value.length) {
        currentIndex.value = 0;
    }
};

const iconMap: Record<string, any> = {
    Megaphone,
    Wrench,
    Plane,
    AlertTriangle,
    Info,
    CheckCircle,
    Calendar,
    Bell,
};

const getIconComponent = (iconName?: string) => {
    if (iconName && iconMap[iconName]) {
        return iconMap[iconName];
    }
    return Megaphone;
};

const getPriorityClass = (priority: string) => {
    switch (priority) {
        case 'Critical':
            return 'bg-rose-500 text-white font-bold animate-pulse px-2 py-0.5 rounded text-xs';
        case 'High':
            return 'bg-amber-500 text-white font-semibold px-2 py-0.5 rounded text-xs';
        case 'Low':
            return 'bg-slate-600 text-slate-100 px-2 py-0.5 rounded text-xs';
        default:
            return 'bg-sky-600 text-white px-2 py-0.5 rounded text-xs';
    }
};

const detailModalOpen = ref(false);
const openDetailModal = () => {
    if (activeAnnouncement.value?.full_description) {
        detailModalOpen.value = true;
    }
};
</script>

<template>
    <div
        v-if="filteredAnnouncements.length > 0 && activeAnnouncement"
        class="relative z-50 text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm"
        :style="{
            backgroundColor: activeAnnouncement.bg_color || '#0b2540',
            color: activeAnnouncement.text_color || '#ffffff',
        }"
        @mouseenter="stopTimer"
        @mouseleave="startTimer"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2.5 flex items-center justify-between gap-3">
            <!-- Left & Content -->
            <div class="flex items-center gap-2.5 overflow-hidden flex-1 min-w-0">
                <!-- Pinned Badge -->
                <span
                    v-if="activeAnnouncement.is_pinned"
                    class="inline-flex items-center gap-1 bg-amber-400/20 text-amber-300 border border-amber-400/30 px-2 py-0.5 rounded-full text-xs font-semibold shrink-0"
                >
                    <Pin class="w-3 h-3 text-amber-300" />
                    <span>Pinned</span>
                </span>

                <!-- Priority Badge -->
                <span :class="getPriorityClass(activeAnnouncement.priority)" class="shrink-0 uppercase tracking-wider font-extrabold text-[10px]">
                    {{ activeAnnouncement.type || activeAnnouncement.priority }}
                </span>

                <!-- Main Text -->
                <div class="truncate flex items-center gap-2">
                    <component
                        :is="getIconComponent(activeAnnouncement.icon)"
                        class="w-4 h-4 shrink-0 opacity-90 hidden sm:inline-block"
                    />
                    <span class="font-semibold text-white tracking-wide shrink-0">
                        {{ activeAnnouncement.title }}:
                    </span>
                    <span class="opacity-90 truncate font-normal">
                        {{ activeAnnouncement.short_description }}
                    </span>
                </div>

                <!-- Full description modal trigger link -->
                <button
                    v-if="activeAnnouncement.full_description"
                    @click="openDetailModal"
                    class="underline hover:opacity-100 opacity-80 text-xs shrink-0 whitespace-nowrap ml-1 font-semibold"
                >
                    Read more
                </button>

                <!-- Action Button -->
                <template v-if="activeAnnouncement.button_text && activeAnnouncement.button_url">
                    <a
                        v-if="activeAnnouncement.button_url.startsWith('http')"
                        :href="activeAnnouncement.button_url"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-1 bg-white/15 hover:bg-white/25 text-white px-2.5 py-1 rounded-md text-xs font-semibold transition-colors shrink-0 ml-2 border border-white/20"
                    >
                        <span>{{ activeAnnouncement.button_text }}</span>
                        <ArrowRight class="w-3 h-3" />
                    </a>
                    <Link
                        v-else
                        :href="activeAnnouncement.button_url"
                        class="inline-flex items-center gap-1 bg-white/15 hover:bg-white/25 text-white px-2.5 py-1 rounded-md text-xs font-semibold transition-colors shrink-0 ml-2 border border-white/20"
                    >
                        <span>{{ activeAnnouncement.button_text }}</span>
                        <ArrowRight class="w-3 h-3" />
                    </Link>
                </template>
            </div>

            <!-- Controls (Prev / Next / Count / Dismiss) -->
            <div class="flex items-center gap-2 shrink-0">
                <!-- Multiple items pagination controls -->
                <div v-if="filteredAnnouncements.length > 1 && isShowMultiple" class="flex items-center gap-1 bg-black/20 rounded-md px-1.5 py-0.5">
                    <button
                        @click="prevAnnouncement"
                        class="p-0.5 rounded hover:bg-white/20 transition-colors"
                        title="Previous announcement"
                    >
                        <ChevronLeft class="w-3.5 h-3.5" />
                    </button>

                    <span class="text-[11px] px-1 font-mono opacity-85">
                        {{ currentIndex + 1 }}/{{ filteredAnnouncements.length }}
                    </span>

                    <button
                        @click="nextAnnouncement"
                        class="p-0.5 rounded hover:bg-white/20 transition-colors"
                        title="Next announcement"
                    >
                        <ChevronRight class="w-3.5 h-3.5" />
                    </button>
                </div>

                <!-- Dismiss Button -->
                <button
                    v-if="activeAnnouncement.is_dismissible"
                    @click="dismiss(activeAnnouncement.id)"
                    class="p-1 rounded-md hover:bg-white/20 transition-colors opacity-80 hover:opacity-100"
                    title="Dismiss announcement"
                >
                    <X class="w-4 h-4" />
                </button>
            </div>
        </div>

        <!-- Detail Modal -->
        <div
            v-if="detailModalOpen && activeAnnouncement"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            @click.self="detailModalOpen = false"
        >
            <div class="bg-white text-slate-800 rounded-xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-100 animate-in fade-in zoom-in-95 duration-200">
                <div
                    class="px-6 py-4 flex items-center justify-between text-white"
                    :style="{ backgroundColor: activeAnnouncement.bg_color || '#0b2540' }"
                >
                    <div class="flex items-center gap-2">
                        <component :is="getIconComponent(activeAnnouncement.icon)" class="w-5 h-5" />
                        <h3 class="font-bold text-base tracking-tight">{{ activeAnnouncement.title }}</h3>
                    </div>
                    <button
                        @click="detailModalOpen = false"
                        class="text-white/80 hover:text-white rounded-lg p-1 hover:bg-white/10"
                    >
                        <X class="w-5 h-5" />
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex items-center gap-2">
                        <span :class="getPriorityClass(activeAnnouncement.priority)">
                            {{ activeAnnouncement.type }}
                        </span>
                        <span class="text-xs text-slate-500 font-medium">
                            Priority: {{ activeAnnouncement.priority }}
                        </span>
                    </div>

                    <p class="text-slate-700 font-medium text-sm leading-relaxed">
                        {{ activeAnnouncement.short_description }}
                    </p>

                    <div
                        v-if="activeAnnouncement.full_description"
                        class="text-slate-600 text-sm leading-relaxed border-t border-slate-100 pt-3 whitespace-pre-line"
                    >
                        {{ activeAnnouncement.full_description }}
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <template v-if="activeAnnouncement.button_text && activeAnnouncement.button_url">
                            <a
                                v-if="activeAnnouncement.button_url.startsWith('http')"
                                :href="activeAnnouncement.button_url"
                                target="_blank"
                                class="px-4 py-2 bg-sky-600 text-white font-semibold rounded-lg hover:bg-sky-700 text-xs transition"
                            >
                                {{ activeAnnouncement.button_text }}
                            </a>
                            <Link
                                v-else
                                :href="activeAnnouncement.button_url"
                                @click="detailModalOpen = false"
                                class="px-4 py-2 bg-sky-600 text-white font-semibold rounded-lg hover:bg-sky-700 text-xs transition"
                            >
                                {{ activeAnnouncement.button_text }}
                            </Link>
                        </template>
                        <button
                            @click="detailModalOpen = false"
                            class="px-4 py-2 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 text-xs transition"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
