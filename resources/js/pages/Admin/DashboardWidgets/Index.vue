<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import {
    LayoutGrid,
    Search,
    RotateCcw,
    Download,
    Upload,
    Save,
    Eye,
    EyeOff,
    Settings,
    Sliders,
    Sparkles,
    CheckCircle,
    X,
    Maximize2,
} from '@lucide/vue';
import { ref, computed } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import WidgetCard from '@/components/Dashboard/WidgetCard.vue';

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
    widgets: Widget[];
    available_roles: string[];
    available_sizes: { key: string; label: string; cols: number }[];
    available_bg_styles: string[];
    available_chart_types: string[];
}>();

defineOptions({
    layout: AdminLayout,
});

const searchQuery = ref('');
const selectedCategory = ref('all');
const editingWidget = ref<Widget | null>(null);

const filteredWidgets = computed(() => {
    return props.widgets.filter((w) => {
        const matchesQuery =
            w.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            w.widget_key.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            (w.subtitle && w.subtitle.toLowerCase().includes(searchQuery.value.toLowerCase()));

        if (selectedCategory.value === 'enabled') return matchesQuery && w.is_enabled;
        if (selectedCategory.value === 'disabled') return matchesQuery && !w.is_enabled;
        return matchesQuery;
    });
});

// Edit form
const editForm = useForm({
    title: '',
    subtitle: '',
    icon: 'LayoutGrid',
    bg_style: 'default',
    chart_type: 'line',
    size: 'medium',
    refresh_interval: 0,
    animation: 'fade',
    is_enabled: true,
    permission_role: 'all',
});

const openEditModal = (widget: Widget) => {
    editingWidget.value = widget;
    editForm.title = widget.title;
    editForm.subtitle = widget.subtitle || '';
    editForm.icon = widget.icon;
    editForm.bg_style = widget.bg_style;
    editForm.chart_type = widget.chart_type;
    editForm.size = widget.size;
    editForm.refresh_interval = widget.refresh_interval;
    editForm.animation = widget.animation;
    editForm.is_enabled = widget.is_enabled;
    editForm.permission_role = widget.permission_role;
};

const submitWidgetEdit = () => {
    if (!editingWidget.value) return;

    editForm.put(`/admin/dashboard-widgets/${editingWidget.value.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            editingWidget.value = null;
        },
    });
};

const toggleWidgetEnable = (widget: Widget) => {
    router.put(`/admin/dashboard-widgets/${widget.id}`, {
        ...widget,
        is_enabled: !widget.is_enabled,
    }, { preserveScroll: true });
};

const resetDefaultLayout = () => {
    if (confirm('Are you sure you want to restore the default dashboard layout?')) {
        router.post('/admin/dashboard-widgets/reset', {}, { preserveScroll: true });
    }
};

// Export Layout
const exportLayout = () => {
    window.location.href = '/admin/dashboard-widgets/export';
};

// Import Layout Modal
const importModalOpen = ref(false);
const importForm = useForm({
    file: null as File | null,
});

const submitImport = () => {
    importForm.post('/admin/dashboard-widgets/import', {
        preserveScroll: true,
        onSuccess: () => {
            importModalOpen.value = false;
        },
    });
};
</script>

<template>
    <Head title="CMS Dashboard Widgets" />

    <div class="space-y-8 pb-12">
        <!-- Top Hero Section -->
        <div
            class="relative overflow-hidden rounded-2xl p-6 lg:p-8 shadow-sm transition-all duration-300"
            style="background: linear-gradient(135deg, #0B2540 0%, #163A5E 60%, #1C2E3D 100%); border: 1px solid rgba(255, 255, 255, 0.1);"
        >
            <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wider text-amber-500 bg-amber-500/10 border border-amber-500/30">
                            <Sparkles class="size-3.5 animate-pulse" />
                            CMS Widget Matrix
                        </span>
                    </div>
                    <h1 class="font-display text-2xl font-bold tracking-tight text-white lg:text-3xl">
                        Dashboard Widgets Manager
                    </h1>
                    <p class="max-w-2xl text-sm text-slate-300">
                        Enable/disable widgets, reorder positions, adjust refresh intervals, resize components, configure role permissions, export/import custom layouts, and preview live cards.
                    </p>
                </div>

                <!-- Action Controls -->
                <div class="flex flex-wrap items-center gap-3">
                    <button
                        @click="resetDefaultLayout"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-xs font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/15 transition-colors"
                    >
                        <RotateCcw class="size-4 text-amber-400" />
                        <span>Restore Defaults</span>
                    </button>

                    <button
                        @click="exportLayout"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-xs font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/15 transition-colors"
                    >
                        <Download class="size-4 text-amber-400" />
                        <span>Export Layout</span>
                    </button>

                    <button
                        @click="importModalOpen = true"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-xs font-semibold text-white bg-amber-600 hover:bg-amber-700 transition-colors shadow-md"
                    >
                        <Upload class="size-4" />
                        <span>Import Layout</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between rounded-2xl bg-white p-4 shadow-sm border border-slate-200/80">
            <!-- Search Input -->
            <div class="relative flex-1 max-w-md">
                <Search class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4 text-slate-400" />
                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search widgets by title, key, or description..."
                    class="w-full rounded-xl border border-slate-200 pl-10 pr-4 py-2 text-xs font-medium focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500"
                />
            </div>

            <!-- Category filter buttons -->
            <div class="flex items-center gap-2">
                <button
                    @click="selectedCategory = 'all'"
                    class="rounded-xl px-3.5 py-2 text-xs font-semibold transition-colors"
                    :class="selectedCategory === 'all' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                >
                    All Widgets ({{ widgets.length }})
                </button>
                <button
                    @click="selectedCategory = 'enabled'"
                    class="rounded-xl px-3.5 py-2 text-xs font-semibold transition-colors"
                    :class="selectedCategory === 'enabled' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                >
                    Enabled ({{ widgets.filter(w => w.is_enabled).length }})
                </button>
                <button
                    @click="selectedCategory = 'disabled'"
                    class="rounded-xl px-3.5 py-2 text-xs font-semibold transition-colors"
                    :class="selectedCategory === 'disabled' ? 'bg-rose-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                >
                    Disabled ({{ widgets.filter(w => !w.is_enabled).length }})
                </button>
            </div>
        </div>

        <!-- Widgets Grid Matrix -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
                v-for="widget in filteredWidgets"
                :key="widget.id"
                class="flex flex-col justify-between rounded-2xl bg-white p-5 border transition-all duration-200 shadow-sm hover:shadow-md"
                :class="widget.is_enabled ? 'border-slate-200' : 'border-dashed border-slate-300 bg-slate-50/70 opacity-75'"
            >
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-[11px] font-bold text-amber-700 uppercase tracking-wider">
                            {{ widget.widget_key }}
                        </span>
                        <div class="flex items-center gap-1.5">
                            <span class="rounded bg-slate-100 px-2 py-0.5 font-mono text-[10px] font-bold text-slate-600 uppercase">
                                {{ widget.size }}
                            </span>
                            <span class="rounded bg-amber-50 px-2 py-0.5 font-mono text-[10px] font-bold text-amber-700 uppercase">
                                {{ widget.permission_role }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-display text-base font-bold text-slate-900">{{ widget.title }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ widget.subtitle || 'No description set' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-2 border-t border-slate-100 text-[11px] text-slate-600">
                        <div>
                            <span class="text-slate-400 block text-[10px]">Bg Style:</span>
                            <strong class="font-mono uppercase">{{ widget.bg_style }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px]">Refresh Interval:</span>
                            <strong class="font-mono">{{ widget.refresh_interval ? `${widget.refresh_interval}s` : 'Disabled' }}</strong>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 mt-4 border-t border-slate-100">
                    <button
                        @click="toggleWidgetEnable(widget)"
                        class="inline-flex items-center gap-1.5 rounded-xl px-3 py-1.5 text-xs font-semibold transition-colors"
                        :class="widget.is_enabled ? 'bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100'"
                    >
                        <EyeOff v-if="widget.is_enabled" class="size-3.5" />
                        <Eye v-else class="size-3.5" />
                        <span>{{ widget.is_enabled ? 'Disable' : 'Enable' }}</span>
                    </button>

                    <button
                        @click="openEditModal(widget)"
                        class="inline-flex items-center gap-1.5 rounded-xl px-3 py-1.5 text-xs font-semibold bg-amber-500/10 text-amber-700 border border-amber-500/20 hover:bg-amber-500/20 transition-colors"
                    >
                        <Settings class="size-3.5" />
                        <span>Configure</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Edit Configuration Modal -->
        <div v-if="editingWidget" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-in fade-in">
            <div class="w-full max-w-xl rounded-2xl bg-white p-6 shadow-2xl space-y-6">
                <div class="flex items-center justify-between border-b pb-4 border-slate-100">
                    <div>
                        <h3 class="font-display text-lg font-bold text-slate-900">Configure {{ editingWidget.title }}</h3>
                        <p class="text-xs text-slate-500 font-mono">Key: {{ editingWidget.widget_key }}</p>
                    </div>
                    <button @click="editingWidget = null" class="rounded-lg p-1.5 text-slate-400 hover:text-slate-600">
                        <X class="size-5" />
                    </button>
                </div>

                <form @submit.prevent="submitWidgetEdit" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Widget Title</label>
                            <input v-model="editForm.title" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Subtitle</label>
                            <input v-model="editForm.subtitle" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Widget Size</label>
                            <select v-model="editForm.size" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium">
                                <option v-for="s in available_sizes" :key="s.key" :value="s.key">{{ s.label }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Background Style</label>
                            <select v-model="editForm.bg_style" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium">
                                <option v-for="b in available_bg_styles" :key="b" :value="b">{{ b }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Chart Type</label>
                            <select v-model="editForm.chart_type" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium">
                                <option v-for="c in available_chart_types" :key="c" :value="c">{{ c }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Refresh Interval (Seconds)</label>
                            <input v-model.number="editForm.refresh_interval" type="number" min="0" max="3600" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium" />
                            <span class="text-[10px] text-slate-400">Set 0 to disable live polling.</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Role Permission</label>
                            <select v-model="editForm.permission_role" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium">
                                <option v-for="r in available_roles" :key="r" :value="r">{{ r }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-2">
                        <input v-model="editForm.is_enabled" type="checkbox" id="enabledCheck" class="rounded border-slate-300 text-amber-600" />
                        <label for="enabledCheck" class="text-xs font-semibold text-slate-800">Widget Enabled on Dashboard</label>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="editingWidget = null" class="rounded-xl px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100">
                            Cancel
                        </button>
                        <button type="submit" :disabled="editForm.processing" class="rounded-xl px-5 py-2 text-xs font-semibold text-white bg-amber-600 hover:bg-amber-700 shadow-md">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Import Layout Modal -->
        <div v-if="importModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-in fade-in">
            <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b pb-3 border-slate-100">
                    <h3 class="font-display text-base font-bold text-slate-900">Import Layout JSON</h3>
                    <button @click="importModalOpen = false" class="rounded-lg p-1 text-slate-400 hover:text-slate-600">
                        <X class="size-4" />
                    </button>
                </div>

                <form @submit.prevent="submitImport" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Select JSON File</label>
                        <input
                            type="file"
                            accept=".json"
                            @change="(e: any) => importForm.file = e.target.files[0]"
                            class="w-full rounded-xl border border-slate-200 p-2 text-xs"
                        />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" @click="importModalOpen = false" class="rounded-xl px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100">
                            Cancel
                        </button>
                        <button type="submit" :disabled="importForm.processing" class="rounded-xl px-5 py-2 text-xs font-semibold text-white bg-amber-600 hover:bg-amber-700 shadow-md">
                            Import Layout
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
