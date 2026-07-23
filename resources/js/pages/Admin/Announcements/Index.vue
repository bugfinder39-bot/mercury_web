<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import {
    Megaphone,
    Plus,
    Search,
    Filter,
    Edit3,
    Trash2,
    Pin,
    Eye,
    EyeOff,
    Settings,
    Check,
    X,
    ArrowUpDown,
    CheckCircle2,
    XCircle,
    Calendar,
    Clock,
    AlertTriangle,
    Layers,
} from '@lucide/vue';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    announcements: Array<{
        id: number;
        title: string;
        short_description: string;
        full_description?: string;
        type: string;
        priority: string;
        bg_color?: string;
        text_color?: string;
        icon?: string;
        button_text?: string;
        button_url?: string;
        display_order: number;
        is_active: boolean;
        is_pinned: boolean;
        is_dismissible: boolean;
        start_date?: string;
        end_date?: string;
        display_location: string;
        target_pages: string;
        specific_pages?: string[];
        created_at: string;
    }>;
    types: string[];
    priorities: string[];
    locations: Record<string, string>;
    filters: {
        search?: string;
        type?: string;
        priority?: string;
        location?: string;
        status?: string;
    };
    sectionSettings: Record<string, any>;
}>();

// Filter state
const search = ref(props.filters.search || '');
const selectedType = ref(props.filters.type || '');
const selectedPriority = ref(props.filters.priority || '');
const selectedLocation = ref(props.filters.location || '');
const selectedStatus = ref(props.filters.status || '');

const applyFilters = () => {
    router.get(
        '/admin/announcements',
        {
            search: search.value || undefined,
            type: selectedType.value || undefined,
            priority: selectedPriority.value || undefined,
            location: selectedLocation.value || undefined,
            status: selectedStatus.value || undefined,
        },
        { preserveState: true, replace: true }
    );
};

const clearFilters = () => {
    search.value = '';
    selectedType.value = '';
    selectedPriority.value = '';
    selectedLocation.value = '';
    selectedStatus.value = '';
    applyFilters();
};

// Toggles
const toggleStatus = (id: number) => {
    router.patch(`/admin/announcements/${id}/toggle-status`, {}, { preserveScroll: true });
};

const togglePin = (id: number) => {
    router.patch(`/admin/announcements/${id}/toggle-pin`, {}, { preserveScroll: true });
};

// Delete Modal
const deleteModalOpen = ref(false);
const itemToDelete = ref<number | null>(null);

const confirmDelete = (id: number) => {
    itemToDelete.value = id;
    deleteModalOpen.value = true;
};

const deleteAnnouncement = () => {
    if (itemToDelete.value) {
        router.delete(`/admin/announcements/${itemToDelete.value}`, {
            onSuccess: () => {
                deleteModalOpen.value = false;
                itemToDelete.value = null;
            },
        });
    }
};

// Settings Modal
const settingsModalOpen = ref(false);
const settingsForm = useForm({
    announcement_system_enabled: props.sectionSettings.announcement_system_enabled ?? 'true',
    announcement_show_multiple: props.sectionSettings.announcement_show_multiple ?? 'true',
    announcement_max_items: props.sectionSettings.announcement_max_items ?? '5',
    announcement_auto_rotate: props.sectionSettings.announcement_auto_rotate ?? 'true',
    announcement_animation_style: props.sectionSettings.announcement_animation_style ?? 'slide',
    announcement_display_duration: props.sectionSettings.announcement_display_duration ?? '5',
    announcement_sticky: props.sectionSettings.announcement_sticky ?? 'false',
});

const submitSettings = () => {
    settingsForm.put('/admin/announcements/settings', {
        onSuccess: () => {
            settingsModalOpen.value = false;
        },
    });
};

// Preview Modal
const previewModalOpen = ref(false);
const previewItem = ref<any>(null);
const openPreview = (item: any) => {
    previewItem.value = item;
    previewModalOpen.value = true;
};

// Reorder State
const isReordering = ref(false);
const localOrders = ref(
    props.announcements.map((item) => ({
        id: item.id,
        display_order: item.display_order,
    }))
);

const saveOrders = () => {
    router.post(
        '/admin/announcements/reorder',
        { orders: localOrders.value },
        {
            onSuccess: () => {
                isReordering.value = false;
            },
        }
    );
};

const getPriorityBadgeClass = (priority: string) => {
    switch (priority) {
        case 'Critical':
            return 'bg-rose-100 text-rose-800 border-rose-200';
        case 'High':
            return 'bg-amber-100 text-amber-800 border-amber-200';
        case 'Low':
            return 'bg-slate-100 text-slate-700 border-slate-200';
        default:
            return 'bg-sky-100 text-sky-800 border-sky-200';
    }
};
</script>

<template>
    <Head title="Announcements Management" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 flex items-center gap-2">
                    <Megaphone class="w-7 h-7 text-sky-600" />
                    Announcements CMS
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Manage website notices, emergency alerts, maintenance schedules, and global announcements.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button
                    @click="settingsModalOpen = true"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-slate-700 font-semibold text-sm rounded-xl border border-slate-200 shadow-sm hover:bg-slate-50 transition"
                >
                    <Settings class="w-4 h-4 text-slate-500" />
                    <span>System Settings</span>
                </button>

                <Link
                    href="/admin/announcements/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-sky-600 text-white font-semibold text-sm rounded-xl shadow-sm hover:bg-sky-700 transition"
                >
                    <Plus class="w-4 h-4" />
                    <span>New Announcement</span>
                </Link>
            </div>
        </div>

        <!-- Filters & Tools Bar -->
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 space-y-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3">
                <!-- Search -->
                <div class="relative md:col-span-2">
                    <Search class="w-4 h-4 absolute left-3 top-3 text-slate-400" />
                    <input
                        v-model="search"
                        @keyup.enter="applyFilters"
                        type="text"
                        placeholder="Search announcements..."
                        class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition"
                    />
                </div>

                <!-- Type -->
                <select
                    v-model="selectedType"
                    @change="applyFilters"
                    class="py-2 px-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-sky-500 outline-none transition"
                >
                    <option value="">All Types</option>
                    <option v-for="t in types" :key="t" :value="t">{{ t }}</option>
                </select>

                <!-- Priority -->
                <select
                    v-model="selectedPriority"
                    @change="applyFilters"
                    class="py-2 px-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-sky-500 outline-none transition"
                >
                    <option value="">All Priorities</option>
                    <option v-for="p in priorities" :key="p" :value="p">{{ p }}</option>
                </select>

                <!-- Location -->
                <select
                    v-model="selectedLocation"
                    @change="applyFilters"
                    class="py-2 px-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-sky-500 outline-none transition"
                >
                    <option value="">All Locations</option>
                    <option v-for="(name, key) in locations" :key="key" :value="key">{{ name }}</option>
                </select>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs">
                <div class="flex items-center gap-2 text-slate-500">
                    <span>Status:</span>
                    <button
                        @click="selectedStatus = ''; applyFilters()"
                        :class="selectedStatus === '' ? 'font-bold text-sky-600 underline' : 'hover:text-slate-700'"
                    >
                        All
                    </button>
                    <span>•</span>
                    <button
                        @click="selectedStatus = 'active'; applyFilters()"
                        :class="selectedStatus === 'active' ? 'font-bold text-emerald-600 underline' : 'hover:text-slate-700'"
                    >
                        Active
                    </button>
                    <span>•</span>
                    <button
                        @click="selectedStatus = 'inactive'; applyFilters()"
                        :class="selectedStatus === 'inactive' ? 'font-bold text-rose-600 underline' : 'hover:text-slate-700'"
                    >
                        Inactive
                    </button>
                </div>

                <button
                    v-if="search || selectedType || selectedPriority || selectedLocation || selectedStatus"
                    @click="clearFilters"
                    class="text-rose-600 hover:text-rose-800 font-semibold"
                >
                    Clear Filters
                </button>
            </div>
        </div>

        <!-- Reorder Bar -->
        <div v-if="isReordering" class="bg-amber-50 p-4 rounded-xl border border-amber-200 flex items-center justify-between">
            <p class="text-xs text-amber-800 font-semibold flex items-center gap-2">
                <ArrowUpDown class="w-4 h-4" />
                Edit the Order values below and click Save Order.
            </p>
            <div class="flex gap-2">
                <button
                    @click="saveOrders"
                    class="px-3 py-1.5 bg-amber-600 text-white font-bold text-xs rounded-lg hover:bg-amber-700 transition"
                >
                    Save Orders
                </button>
                <button
                    @click="isReordering = false"
                    class="px-3 py-1.5 bg-slate-200 text-slate-700 font-bold text-xs rounded-lg hover:bg-slate-300 transition"
                >
                    Cancel
                </button>
            </div>
        </div>

        <!-- Announcements Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                    <span>Announcements List</span>
                    <span class="px-2 py-0.5 rounded-full text-xs bg-slate-100 text-slate-600">
                        {{ announcements.length }} Total
                    </span>
                </h3>

                <button
                    @click="isReordering = !isReordering"
                    class="text-xs font-semibold text-slate-600 hover:text-sky-600 flex items-center gap-1"
                >
                    <ArrowUpDown class="w-3.5 h-3.5" />
                    <span>{{ isReordering ? 'Done Reordering' : 'Reorder Items' }}</span>
                </button>
            </div>

            <div v-if="announcements.length === 0" class="p-12 text-center text-slate-400">
                <Megaphone class="w-12 h-12 mx-auto stroke-1 mb-3 opacity-50" />
                <p class="font-medium text-slate-600 text-base">No announcements found</p>
                <p class="text-xs text-slate-400 mt-1">Create your first announcement or adjust your search filters.</p>
            </div>

            <div v-else class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50/70 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <tr>
                            <th v-if="isReordering" class="px-4 py-3 text-center">Order</th>
                            <th class="px-6 py-3">Announcement</th>
                            <th class="px-4 py-3">Type / Priority</th>
                            <th class="px-4 py-3">Location</th>
                            <th class="px-4 py-3">Target Pages</th>
                            <th class="px-4 py-3 text-center">Pinned</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr
                            v-for="(item, index) in announcements"
                            :key="item.id"
                            class="hover:bg-slate-50/60 transition"
                        >
                            <!-- Reorder Input -->
                            <td v-if="isReordering" class="px-4 py-3 text-center">
                                <input
                                    v-model.number="localOrders[index].display_order"
                                    type="number"
                                    class="w-16 text-center py-1 bg-white border border-slate-300 rounded text-xs font-semibold focus:ring-1 focus:ring-sky-500"
                                />
                            </td>

                            <!-- Title & Description -->
                            <td class="px-6 py-4 max-w-sm">
                                <div class="flex items-start gap-3">
                                    <!-- Color Indicator dot -->
                                    <div
                                        class="w-3.5 h-3.5 rounded-full shrink-0 mt-0.5 shadow-sm border border-black/10"
                                        :style="{ backgroundColor: item.bg_color || '#0284c7' }"
                                        :title="`Color: ${item.bg_color}`"
                                    ></div>
                                    <div class="min-w-0">
                                        <div class="font-bold text-slate-900 text-sm flex items-center gap-1.5">
                                            <span class="truncate">{{ item.title }}</span>
                                        </div>
                                        <p class="text-slate-500 text-xs line-clamp-1 mt-0.5">
                                            {{ item.short_description }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <!-- Type & Priority -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="space-y-1">
                                    <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-700 font-semibold rounded text-[11px]">
                                        {{ item.type }}
                                    </span>
                                    <div>
                                        <span
                                            :class="getPriorityBadgeClass(item.priority)"
                                            class="inline-block px-2 py-0.5 border font-extrabold rounded text-[10px] uppercase"
                                        >
                                            {{ item.priority }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- Location -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="capitalize font-semibold text-slate-700">
                                    {{ locations[item.display_location] || item.display_location }}
                                </span>
                            </td>

                            <!-- Target Pages -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700 capitalize">
                                    {{ item.target_pages }}
                                </span>
                            </td>

                            <!-- Pinned Toggle -->
                            <td class="px-4 py-4 text-center whitespace-nowrap">
                                <button
                                    @click="togglePin(item.id)"
                                    :class="item.is_pinned ? 'text-amber-500 bg-amber-50 border-amber-200' : 'text-slate-300 border-transparent hover:text-slate-400'"
                                    class="p-1.5 rounded-lg border transition"
                                    :title="item.is_pinned ? 'Pinned (Click to Unpin)' : 'Unpinned (Click to Pin)'"
                                >
                                    <Pin class="w-4 h-4 fill-current" />
                                </button>
                            </td>

                            <!-- Status Toggle -->
                            <td class="px-4 py-4 text-center whitespace-nowrap">
                                <button
                                    @click="toggleStatus(item.id)"
                                    :class="item.is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-500 border-slate-200'"
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full border text-xs font-semibold transition"
                                >
                                    <span
                                        class="w-2 h-2 rounded-full"
                                        :class="item.is_active ? 'bg-emerald-500' : 'bg-slate-400'"
                                    ></span>
                                    <span>{{ item.is_active ? 'Active' : 'Disabled' }}</span>
                                </button>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        @click="openPreview(item)"
                                        class="p-1.5 text-slate-400 hover:text-sky-600 hover:bg-sky-50 rounded-lg transition"
                                        title="Preview"
                                    >
                                        <Eye class="w-4 h-4" />
                                    </button>

                                    <Link
                                        :href="`/admin/announcements/${item.id}/edit`"
                                        class="p-1.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition"
                                        title="Edit"
                                    >
                                        <Edit3 class="w-4 h-4" />
                                    </Link>

                                    <button
                                        @click="confirmDelete(item.id)"
                                        class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                        title="Delete"
                                    >
                                        <Trash2 class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delete Modal -->
        <div
            v-if="deleteModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
        >
            <div class="bg-white rounded-2xl p-6 max-w-sm w-full space-y-4 shadow-xl border border-slate-100">
                <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center mx-auto">
                    <AlertTriangle class="w-6 h-6" />
                </div>
                <div class="text-center">
                    <h4 class="font-bold text-slate-900 text-base">Delete Announcement?</h4>
                    <p class="text-xs text-slate-500 mt-1">This action cannot be undone. This announcement will be permanently removed.</p>
                </div>
                <div class="flex gap-3 pt-2">
                    <button
                        @click="deleteModalOpen = false"
                        class="flex-1 py-2.5 bg-slate-100 text-slate-700 font-semibold text-xs rounded-xl hover:bg-slate-200 transition"
                    >
                        Cancel
                    </button>
                    <button
                        @click="deleteAnnouncement"
                        class="flex-1 py-2.5 bg-rose-600 text-white font-semibold text-xs rounded-xl hover:bg-rose-700 transition"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>

        <!-- Preview Modal -->
        <div
            v-if="previewModalOpen && previewItem"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            @click.self="previewModalOpen = false"
        >
            <div class="bg-white text-slate-800 rounded-2xl shadow-2xl max-w-xl w-full overflow-hidden border border-slate-100">
                <div class="p-4 bg-slate-900 text-white flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-300">Announcement Visual Preview</span>
                    <button @click="previewModalOpen = false" class="text-slate-400 hover:text-white">
                        <X class="w-5 h-5" />
                    </button>
                </div>

                <!-- Preview Banner Banner Simulation -->
                <div
                    class="p-4 flex items-center justify-between gap-3 text-xs sm:text-sm font-medium"
                    :style="{
                        backgroundColor: previewItem.bg_color || '#0b2540',
                        color: previewItem.text_color || '#ffffff',
                    }"
                >
                    <div class="flex items-center gap-2 truncate">
                        <span v-if="previewItem.is_pinned" class="bg-amber-400/20 text-amber-300 px-2 py-0.5 rounded text-xs font-bold">Pinned</span>
                        <span class="uppercase tracking-wider font-extrabold text-[10px] px-2 py-0.5 rounded bg-white/20">
                            {{ previewItem.type }}
                        </span>
                        <span class="font-bold shrink-0">{{ previewItem.title }}:</span>
                        <span class="opacity-90 truncate">{{ previewItem.short_description }}</span>
                    </div>
                    <span v-if="previewItem.button_text" class="px-2.5 py-1 bg-white/20 rounded font-semibold text-xs shrink-0">
                        {{ previewItem.button_text }}
                    </span>
                </div>

                <div class="p-6 space-y-3 bg-slate-50">
                    <div>
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Full Details</span>
                        <p class="text-sm font-semibold text-slate-800 mt-1">{{ previewItem.short_description }}</p>
                        <p v-if="previewItem.full_description" class="text-xs text-slate-600 mt-2 whitespace-pre-line">
                            {{ previewItem.full_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Settings Modal -->
        <div
            v-if="settingsModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
        >
            <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-100">
                <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
                    <h3 class="font-bold text-base flex items-center gap-2">
                        <Settings class="w-5 h-5 text-sky-400" />
                        Announcement System Settings
                    </h3>
                    <button @click="settingsModalOpen = false" class="text-slate-400 hover:text-white">
                        <X class="w-5 h-5" />
                    </button>
                </div>

                <form @submit.prevent="submitSettings" class="p-6 space-y-4 text-xs text-slate-700">
                    <!-- Enable System Toggle -->
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <div>
                            <span class="font-bold text-slate-900 text-sm block">Announcement System</span>
                            <span class="text-slate-500 text-xs">Globally enable or disable announcements on the website</span>
                        </div>
                        <select
                            v-model="settingsForm.announcement_system_enabled"
                            class="py-1.5 px-3 bg-white border border-slate-300 rounded-lg font-semibold text-xs"
                        >
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>

                    <!-- Show Multiple Announcements -->
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <div>
                            <span class="font-bold text-slate-900 text-sm block">Show Multiple Notices</span>
                            <span class="text-slate-500 text-xs">Allow carousel/rotation of multiple notices</span>
                        </div>
                        <select
                            v-model="settingsForm.announcement_show_multiple"
                            class="py-1.5 px-3 bg-white border border-slate-300 rounded-lg font-semibold text-xs"
                        >
                            <option value="true">Yes</option>
                            <option value="false">No (First Only)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Max Items -->
                        <div>
                            <label class="font-bold text-slate-800 block mb-1">Max Announcements</label>
                            <input
                                v-model.number="settingsForm.announcement_max_items"
                                type="number"
                                min="1"
                                max="20"
                                class="w-full py-2 px-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white font-semibold outline-none"
                            />
                        </div>

                        <!-- Display Duration -->
                        <div>
                            <label class="font-bold text-slate-800 block mb-1">Duration (Seconds)</label>
                            <input
                                v-model.number="settingsForm.announcement_display_duration"
                                type="number"
                                min="2"
                                max="30"
                                class="w-full py-2 px-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white font-semibold outline-none"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Auto Rotate -->
                        <div>
                            <label class="font-bold text-slate-800 block mb-1">Auto Rotate</label>
                            <select
                                v-model="settingsForm.announcement_auto_rotate"
                                class="w-full py-2 px-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white font-semibold outline-none"
                            >
                                <option value="true">Enabled</option>
                                <option value="false">Disabled</option>
                            </select>
                        </div>

                        <!-- Animation Style -->
                        <div>
                            <label class="font-bold text-slate-800 block mb-1">Animation Style</label>
                            <select
                                v-model="settingsForm.announcement_animation_style"
                                class="w-full py-2 px-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white font-semibold outline-none"
                            >
                                <option value="slide">Slide</option>
                                <option value="fade">Fade</option>
                                <option value="bounce">Bounce</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button
                            type="button"
                            @click="settingsModalOpen = false"
                            class="px-4 py-2 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="settingsForm.processing"
                            class="px-5 py-2 bg-sky-600 text-white font-semibold rounded-xl hover:bg-sky-700 transition"
                        >
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
