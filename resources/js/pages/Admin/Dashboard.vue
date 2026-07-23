<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import {
    BookOpen,
    Folder,
    Globe,
    Award,
    Mail,
    Settings,
    Clock,
    ExternalLink,
    Sparkles,
    Sliders,
    Save,
    RotateCcw,
    Download,
    Upload,
    Users,
    Activity,
    Eye,
    TrendingUp,
    DollarSign,
    Megaphone,
    UserCheck,
    ShieldAlert,
    HardDrive,
    BarChart3,
    Layout,
    Server,
    Database,
} from '@lucide/vue';
import { computed, ref, onMounted, onUnmounted } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import WidgetCard from '@/components/Dashboard/WidgetCard.vue';

// Widget components
import VisitorsWidget from '@/components/Dashboard/Widgets/VisitorsWidget.vue';
import PageViewsWidget from '@/components/Dashboard/Widgets/PageViewsWidget.vue';
import ContactMessagesWidget from '@/components/Dashboard/Widgets/ContactMessagesWidget.vue';
import AnnouncementsWidget from '@/components/Dashboard/Widgets/AnnouncementsWidget.vue';
import ExchangeRatesWidget from '@/components/Dashboard/Widgets/ExchangeRatesWidget.vue';
import SystemHealthWidget from '@/components/Dashboard/Widgets/SystemHealthWidget.vue';
import StorageUsageWidget from '@/components/Dashboard/Widgets/StorageUsageWidget.vue';
import CompanyStatsWidget from '@/components/Dashboard/Widgets/CompanyStatsWidget.vue';
import HomepageStatusWidget from '@/components/Dashboard/Widgets/HomepageStatusWidget.vue';
import AuditLogsWidget from '@/components/Dashboard/Widgets/AuditLogsWidget.vue';
import RecentUsersWidget from '@/components/Dashboard/Widgets/RecentUsersWidget.vue';

interface Widget {
    id: number;
    widget_key: string;
    title: string;
    subtitle: string | null;
    icon: string;
    bg_style: string;
    chart_type: string;
    size: string;
    display_order: number;
    refresh_interval: number;
    animation: string;
    is_enabled: boolean;
    permission_role: string;
}

const props = defineProps<{
    widgets?: Widget[];
    initial_widget_data?: Record<string, any>;
    stats?: {
        pages_count: number;
        services_count: number;
        services_total: number;
        partners_count: number;
        partners_total: number;
        unread_messages_count: number;
        total_messages_count: number;
        network_locations_count: number;
        network_locations_total: number;
        certifications_count: number;
        certifications_total: number;
        users_count: number;
    };
    recent_messages?: any[];
}>();

defineOptions({
    layout: AdminLayout,
});

const page = usePage();
const authUser = computed(() => page.props.auth?.user as Record<string, any> | null);

const currentDate = computed(() => {
    return new Intl.DateTimeFormat('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    }).format(new Date());
});

// Customizable Layout State
const isCustomizing = ref(false);
const activeWidgets = ref<Widget[]>(props.widgets ? [...props.widgets] : []);
const widgetDataMap = ref<Record<string, any>>(props.initial_widget_data || {});
const refreshingMap = ref<Record<string, boolean>>({});

// Keep local activeWidgets in sync with props
computed(() => {
    if (props.widgets) {
        activeWidgets.value = [...props.widgets];
    }
});

const visibleWidgets = computed(() => {
    return activeWidgets.value
        .filter((w) => isCustomizing.value || w.is_enabled)
        .sort((a, b) => a.display_order - b.display_order);
});

// Icon component lookup helper
const getWidgetIcon = (iconName: string) => {
    switch (iconName) {
        case 'Users': return Users;
        case 'Eye': return Eye;
        case 'Activity': return Activity;
        case 'TrendingUp': return TrendingUp;
        case 'Mail': return Mail;
        case 'DollarSign': return DollarSign;
        case 'Megaphone': return Megaphone;
        case 'BookOpen': return BookOpen;
        case 'UserCheck': return UserCheck;
        case 'ShieldAlert': return ShieldAlert;
        case 'HardDrive': return HardDrive;
        case 'BarChart3': return BarChart3;
        case 'Layout': return Layout;
        case 'Server': return Server;
        case 'Database': return Database;
        default: return Sparkles;
    }
};

// Reorder helper methods
const moveWidget = (index: number, direction: 'up' | 'down') => {
    const list = [...visibleWidgets.value];
    if (direction === 'up' && index > 0) {
        const temp = list[index].display_order;
        list[index].display_order = list[index - 1].display_order;
        list[index - 1].display_order = temp;
    } else if (direction === 'down' && index < list.length - 1) {
        const temp = list[index].display_order;
        list[index].display_order = list[index + 1].display_order;
        list[index + 1].display_order = temp;
    }
};

const changeWidgetSize = (widget: Widget, newSize: string) => {
    widget.size = newSize;
};

const toggleWidgetHide = (widget: Widget) => {
    widget.is_enabled = !widget.is_enabled;
};

// Save custom layout
const saveLayout = () => {
    const payload = activeWidgets.value.map((w, idx) => ({
        widget_key: w.widget_key,
        display_order: idx + 1,
        size: w.size,
        is_enabled: w.is_enabled,
        bg_style: w.bg_style,
    }));

    router.post('/admin/dashboard-widgets/layout', { widgets: payload }, {
        preserveScroll: true,
        onSuccess: () => {
            isCustomizing.value = false;
        },
    });
};

const resetLayout = () => {
    if (confirm('Restore default dashboard widget layout?')) {
        router.post('/admin/dashboard-widgets/reset', {}, { preserveScroll: true });
    }
};

// Real-time polling per widget
let pollingTimers: any[] = [];

const refreshSingleWidget = async (key: string) => {
    refreshingMap.value[key] = true;
    try {
        const res = await fetch(`/admin/dashboard-widgets/data?keys=${key}`);
        if (res.ok) {
            const json = await res.json();
            if (json.data && json.data[key]) {
                widgetDataMap.value[key] = json.data[key];
            }
        }
    } catch (e) {
        console.error('Failed to poll widget:', key, e);
    } finally {
        setTimeout(() => {
            refreshingMap.value[key] = false;
        }, 300);
    }
};

const setupPolling = () => {
    pollingTimers.forEach((t) => clearInterval(t));
    pollingTimers = [];

    activeWidgets.value.forEach((w) => {
        if (w.is_enabled && w.refresh_interval > 0) {
            const timer = setInterval(() => {
                refreshSingleWidget(w.widget_key);
            }, w.refresh_interval * 1000);
            pollingTimers.push(timer);
        }
    });
};

onMounted(() => {
    setupPolling();
});

onUnmounted(() => {
    pollingTimers.forEach((t) => clearInterval(t));
});
</script>

<template>
    <Head title="CMS Admin Dashboard" />

    <div class="space-y-8 pb-12">
        <!-- ── Top Hero Welcome Banner ── -->
        <div
            class="relative overflow-hidden rounded-2xl p-6 lg:p-8 shadow-sm transition-all duration-300"
            style="
                background: linear-gradient(135deg, #0B2540 0%, #123A5E 60%, #162A3A 100%);
                border: 1px solid rgba(255, 255, 255, 0.1);
            "
        >
            <div
                class="pointer-events-none absolute -right-16 -top-16 size-72 rounded-full opacity-10 blur-2xl"
                style="background-color: #E8770C"
            ></div>

            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold tracking-wide text-white uppercase"
                            style="background-color: rgba(232, 119, 12, 0.2); border: 1px solid rgba(232, 119, 12, 0.4); color: #E8770C;"
                        >
                            <span class="size-2 rounded-full bg-amber-500 animate-pulse"></span>
                            Customizable Control Desk
                        </span>
                        <span class="hidden items-center gap-1.5 text-xs text-slate-300 sm:inline-flex">
                            <Clock class="size-3.5 text-amber-400" />
                            {{ currentDate }}
                        </span>
                    </div>

                    <h1 class="font-display text-2xl font-bold tracking-tight text-white lg:text-3xl">
                        Welcome back, <span style="color: #E8770C;">{{ authUser?.name || 'Administrator' }}</span>
                    </h1>
                    <p class="max-w-2xl text-sm text-slate-300">
                        Monitor site analytics, real-time exchange rates, contact messages, and system health via fully customizable dashboard widgets.
                    </p>
                </div>

                <!-- Right Action Buttons -->
                <div class="flex flex-wrap items-center gap-3">
                    <!-- Customize Dashboard Toggle -->
                    <button
                        @click="isCustomizing = !isCustomizing"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-xs font-semibold text-white shadow-md transition-all duration-200"
                        :style="isCustomizing ? 'background-color: #10B981;' : 'background-color: #E8770C;'"
                    >
                        <Sliders class="size-4" />
                        <span>{{ isCustomizing ? 'Done Editing' : 'Customize Dashboard' }}</span>
                    </button>

                    <Link
                        href="/admin/dashboard-widgets"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-xs font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/15 transition-all duration-200"
                    >
                        <Settings class="size-4 text-amber-400" />
                        <span>Widget Module</span>
                    </Link>

                    <a
                        href="/"
                        target="_blank"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-xs font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/15 transition-all duration-200"
                    >
                        <Globe class="size-4 text-amber-400" />
                        <span>Public Website</span>
                        <ExternalLink class="size-3 text-slate-400" />
                    </a>
                </div>
            </div>
        </div>

        <!-- Customization Control Bar when editing mode is ON -->
        <div v-if="isCustomizing" class="flex flex-wrap items-center justify-between gap-4 rounded-2xl bg-amber-500/10 border border-amber-500/30 p-4 animate-in fade-in">
            <div class="flex items-center gap-2 text-xs font-semibold text-amber-800 dark:text-amber-300">
                <Sparkles class="size-4 text-amber-600" />
                <span>Customize Mode Active: Drag, resize, or toggle widgets below, then click "Save Layout".</span>
            </div>

            <div class="flex items-center gap-3">
                <button
                    @click="resetLayout"
                    class="inline-flex items-center gap-1.5 rounded-xl px-3 py-1.5 text-xs font-semibold bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 transition-colors"
                >
                    <RotateCcw class="size-3.5 text-rose-500" />
                    <span>Reset Layout</span>
                </button>

                <button
                    @click="saveLayout"
                    class="inline-flex items-center gap-1.5 rounded-xl px-4 py-1.5 text-xs font-semibold bg-emerald-600 text-white hover:bg-emerald-700 transition-colors shadow-sm"
                >
                    <Save class="size-3.5" />
                    <span>Save Layout</span>
                </button>
            </div>
        </div>

        <!-- ── Dynamic Responsive Grid Widgets ── -->
        <div class="grid grid-cols-12 gap-6">
            <template v-for="(widget, idx) in visibleWidgets" :key="widget.widget_key">
                <WidgetCard
                    :id="widget.id"
                    :widget-key="widget.widget_key"
                    :title="widget.title"
                    :subtitle="widget.subtitle"
                    :bg-style="widget.bg_style"
                    :size="widget.size"
                    :refresh-interval="widget.refresh_interval"
                    :is-editing="isCustomizing"
                    :is-refreshing="refreshingMap[widget.widget_key] || false"
                    :animation="widget.animation"
                    @refresh="refreshSingleWidget(widget.widget_key)"
                    @change-size="(newSize) => changeWidgetSize(widget, newSize)"
                    @toggle-hide="toggleWidgetHide(widget)"
                    @edit="router.get('/admin/dashboard-widgets')"
                >
                    <template #icon>
                        <component :is="getWidgetIcon(widget.icon)" class="size-4 stroke-[2]" />
                    </template>

                    <!-- Error Fallback -->
                    <div v-if="widgetDataMap[widget.widget_key]?.error" class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/30 border border-rose-200 dark:border-rose-900/50 text-center text-xs text-rose-600 dark:text-rose-400">
                        <p class="font-semibold">Widget Temporarily Unavailable</p>
                        <p class="text-[11px] opacity-80 mt-1">{{ widgetDataMap[widget.widget_key]?.message || 'Data stream could not be loaded.' }}</p>
                    </div>

                    <!-- Render matching widget component -->
                    <VisitorsWidget
                        v-else-if="widget.widget_key === 'website_visitors' || widget.widget_key === 'todays_visitors' || widget.widget_key === 'online_visitors'"
                        :data="widgetDataMap[widget.widget_key]"
                        :widget-key="widget.widget_key"
                    />

                    <PageViewsWidget
                        v-else-if="widget.widget_key === 'page_views'"
                        :data="widgetDataMap[widget.widget_key]"
                    />

                    <ContactMessagesWidget
                        v-else-if="widget.widget_key === 'contact_messages'"
                        :data="widgetDataMap[widget.widget_key]"
                        :recent-messages="recent_messages"
                    />

                    <AnnouncementsWidget
                        v-else-if="widget.widget_key === 'announcements'"
                        :data="widgetDataMap[widget.widget_key]"
                    />

                    <ExchangeRatesWidget
                        v-else-if="widget.widget_key === 'exchange_rates'"
                        :data="widgetDataMap[widget.widget_key]"
                    />

                    <SystemHealthWidget
                        v-else-if="widget.widget_key === 'system_health' || widget.widget_key === 'server_info'"
                        :data="widgetDataMap[widget.widget_key]"
                    />

                    <StorageUsageWidget
                        v-else-if="widget.widget_key === 'media_storage'"
                        :data="widgetDataMap[widget.widget_key]"
                    />

                    <CompanyStatsWidget
                        v-else-if="widget.widget_key === 'company_stats'"
                        :data="widgetDataMap[widget.widget_key]"
                    />

                    <HomepageStatusWidget
                        v-else-if="widget.widget_key === 'homepage_status'"
                        :data="widgetDataMap[widget.widget_key]"
                    />

                    <AuditLogsWidget
                        v-else-if="widget.widget_key === 'audit_logs'"
                        :data="widgetDataMap[widget.widget_key]"
                    />

                    <RecentUsersWidget
                        v-else-if="widget.widget_key === 'recent_users'"
                        :data="widgetDataMap[widget.widget_key]"
                    />

                    <!-- Fallback -->
                    <div v-else class="p-4 text-center text-xs text-slate-400">
                        Widget component ready.
                    </div>

                    <!-- Reorder Up/Down controls when customizing -->
                    <div v-if="isCustomizing" class="mt-4 pt-3 flex items-center justify-between border-t border-slate-100 dark:border-slate-800 text-[10px]">
                        <span class="font-mono text-slate-400">Order: {{ widget.display_order }}</span>
                        <div class="flex items-center gap-1">
                            <button
                                @click="moveWidget(idx, 'up')"
                                :disabled="idx === 0"
                                class="rounded px-2 py-0.5 bg-slate-100 hover:bg-slate-200 disabled:opacity-30 text-slate-700 font-bold"
                            >
                                ↑ Move Up
                            </button>
                            <button
                                @click="moveWidget(idx, 'down')"
                                :disabled="idx === visibleWidgets.length - 1"
                                class="rounded px-2 py-0.5 bg-slate-100 hover:bg-slate-200 disabled:opacity-30 text-slate-700 font-bold"
                            >
                                ↓ Move Down
                            </button>
                        </div>
                    </div>
                </WidgetCard>
            </template>
        </div>
    </div>
</template>
