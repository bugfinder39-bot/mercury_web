<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import {
    Megaphone,
    ArrowLeft,
    Save,
    Pin,
    Calendar,
    Palette,
    Eye,
    Wrench,
    Plane,
    AlertTriangle,
    Info,
    CheckCircle,
    Bell,
    ArrowRight,
} from '@lucide/vue';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    types: string[];
    priorities: string[];
    locations: Record<string, string>;
    maxOrder: number;
}>();

const form = useForm({
    title: '',
    short_description: '',
    full_description: '',
    type: 'General',
    priority: 'Normal',
    bg_color: '#0284c7',
    text_color: '#ffffff',
    icon: 'Megaphone',
    button_text: '',
    button_url: '',
    display_order: props.maxOrder,
    is_active: true,
    is_pinned: false,
    is_dismissible: true,
    start_date: '',
    end_date: '',
    display_location: 'top_bar',
    target_pages: 'all',
    specific_pages: [] as string[],
});

const presetColors = [
    { label: 'Sky Blue', bg: '#0284c7', text: '#ffffff' },
    { label: 'Emerald Green', bg: '#059669', text: '#ffffff' },
    { label: 'Amber Yellow', bg: '#d97706', text: '#ffffff' },
    { label: 'Rose Red', bg: '#e11d48', text: '#ffffff' },
    { label: 'Dark Slate', bg: '#0f172a', text: '#ffffff' },
    { label: 'Indigo Purple', bg: '#4f46e5', text: '#ffffff' },
];

const availableIcons = [
    'Megaphone',
    'Wrench',
    'Plane',
    'AlertTriangle',
    'Info',
    'CheckCircle',
    'Calendar',
    'Bell',
];

const pageOptions = [
    { label: 'About Us Page', path: '/about' },
    { label: 'Services Page', path: '/services' },
    { label: 'Contact Page', path: '/contact' },
    { label: 'Coming Soon Page', path: '/coming-soon' },
];

const specificPageInput = ref('');
const addSpecificPage = () => {
    if (specificPageInput.value && !form.specific_pages.includes(specificPageInput.value)) {
        form.specific_pages.push(specificPageInput.value);
        specificPageInput.value = '';
    }
};

const removeSpecificPage = (index: number) => {
    form.specific_pages.splice(index, 1);
};

const togglePresetColor = (preset: { bg: string; text: string }) => {
    form.bg_color = preset.bg;
    form.text_color = preset.text;
};

const submit = () => {
    form.post('/admin/announcements');
};
</script>

<template>
    <Head title="Create Announcement" />

    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <Link
                    href="/admin/announcements"
                    class="p-2 bg-white rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition"
                >
                    <ArrowLeft class="w-5 h-5" />
                </Link>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-slate-900">Create Announcement</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Configure a new notice, schedule, appearance, and target pages.</p>
                </div>
            </div>
        </div>

        <!-- Live Visual Preview Box -->
        <div class="bg-slate-900 p-6 rounded-2xl shadow-lg border border-slate-800 space-y-3">
            <div class="flex items-center justify-between text-xs text-slate-400">
                <span class="font-semibold uppercase tracking-wider flex items-center gap-1.5 text-sky-400">
                    <Eye class="w-4 h-4" />
                    Real-time Visual Preview
                </span>
                <span class="capitalize font-mono">Location: {{ locations[form.display_location] }}</span>
            </div>

            <!-- Simulated Banner -->
            <div
                class="p-3.5 rounded-xl text-xs sm:text-sm font-medium transition-all shadow-md flex items-center justify-between gap-3"
                :style="{ backgroundColor: form.bg_color || '#0284c7', color: form.text_color || '#ffffff' }"
            >
                <div class="flex items-center gap-2.5 overflow-hidden flex-1 min-w-0">
                    <span
                        v-if="form.is_pinned"
                        class="bg-amber-400/20 text-amber-300 border border-amber-400/30 px-2 py-0.5 rounded-full text-xs font-semibold shrink-0"
                    >
                        <Pin class="w-3 h-3 inline mr-1" />
                        Pinned
                    </span>
                    <span class="uppercase tracking-wider font-extrabold text-[10px] px-2 py-0.5 rounded bg-white/20 shrink-0">
                        {{ form.type || 'General' }}
                    </span>
                    <div class="truncate flex items-center gap-2">
                        <span class="font-bold tracking-wide shrink-0">
                            {{ form.title || 'Announcement Title' }}:
                        </span>
                        <span class="opacity-90 truncate font-normal">
                            {{ form.short_description || 'Your announcement summary will appear here...' }}
                        </span>
                    </div>
                </div>

                <div v-if="form.button_text" class="px-2.5 py-1 bg-white/20 rounded font-semibold text-xs shrink-0 flex items-center gap-1">
                    <span>{{ form.button_text }}</span>
                    <ArrowRight class="w-3 h-3" />
                </div>
            </div>
        </div>

        <!-- Form Form -->
        <form @submit.prevent="submit" class="space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-6">
                <!-- Basic Info -->
                <div class="space-y-4">
                    <h3 class="font-bold text-slate-900 text-sm border-b border-slate-100 pb-2">1. Basic Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Announcement Title <span class="text-rose-500">*</span>
                            </label>
                            <input
                                v-model="form.title"
                                type="text"
                                required
                                placeholder="e.g., Scheduled System Maintenance"
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white focus:ring-2 focus:ring-sky-500 outline-none"
                            />
                            <div v-if="form.errors.title" class="text-rose-500 text-xs mt-1">{{ form.errors.title }}</div>
                        </div>

                        <!-- Type -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Type <span class="text-rose-500">*</span>
                            </label>
                            <select
                                v-model="form.type"
                                required
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white focus:ring-2 focus:ring-sky-500 outline-none"
                            >
                                <option v-for="t in types" :key="t" :value="t">{{ t }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Short Description / Summary <span class="text-rose-500">*</span>
                        </label>
                        <textarea
                            v-model="form.short_description"
                            rows="2"
                            required
                            placeholder="Brief summary visible directly on top bar or banner..."
                            class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-sky-500 outline-none"
                        ></textarea>
                        <div v-if="form.errors.short_description" class="text-rose-500 text-xs mt-1">{{ form.errors.short_description }}</div>
                    </div>

                    <!-- Full Description -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Full Description (Optional)
                        </label>
                        <textarea
                            v-model="form.full_description"
                            rows="4"
                            placeholder="Extended details shown in modal dialog when user clicks 'Read more'..."
                            class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-sky-500 outline-none"
                        ></textarea>
                    </div>
                </div>

                <!-- Appearance & Colors -->
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <h3 class="font-bold text-slate-900 text-sm border-b border-slate-100 pb-2 flex items-center gap-2">
                        <Palette class="w-4 h-4 text-sky-600" />
                        <span>2. Appearance & Styling</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Priority -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Priority</label>
                            <select
                                v-model="form.priority"
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white focus:ring-2 focus:ring-sky-500 outline-none"
                            >
                                <option v-for="p in priorities" :key="p" :value="p">{{ p }}</option>
                            </select>
                        </div>

                        <!-- Background Color -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Background Color</label>
                            <div class="flex gap-2">
                                <input
                                    v-model="form.bg_color"
                                    type="color"
                                    class="h-10 w-12 rounded-lg border border-slate-200 cursor-pointer p-0.5"
                                />
                                <input
                                    v-model="form.bg_color"
                                    type="text"
                                    placeholder="#0284c7"
                                    class="flex-1 py-2 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:bg-white outline-none"
                                />
                            </div>
                        </div>

                        <!-- Text Color -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Text Color</label>
                            <div class="flex gap-2">
                                <input
                                    v-model="form.text_color"
                                    type="color"
                                    class="h-10 w-12 rounded-lg border border-slate-200 cursor-pointer p-0.5"
                                />
                                <input
                                    v-model="form.text_color"
                                    type="text"
                                    placeholder="#ffffff"
                                    class="flex-1 py-2 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:bg-white outline-none"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Preset Palette Buttons -->
                    <div>
                        <span class="block text-xs font-semibold text-slate-500 mb-2">Preset Color Schemes:</span>
                        <div class="flex flex-wrap gap-2">
                            <button
                                v-for="preset in presetColors"
                                :key="preset.label"
                                type="button"
                                @click="togglePresetColor(preset)"
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold text-white shadow-sm border border-black/10 transition hover:scale-105"
                                :style="{ backgroundColor: preset.bg }"
                            >
                                {{ preset.label }}
                            </button>
                        </div>
                    </div>

                    <!-- Icon & Action Button -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
                        <!-- Icon -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Icon</label>
                            <select
                                v-model="form.icon"
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white outline-none"
                            >
                                <option v-for="icon in availableIcons" :key="icon" :value="icon">{{ icon }}</option>
                            </select>
                        </div>

                        <!-- Button Text -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Button Text (Optional)</label>
                            <input
                                v-model="form.button_text"
                                type="text"
                                placeholder="e.g., Learn More"
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white outline-none"
                            />
                        </div>

                        <!-- Button URL -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Button Link URL (Optional)</label>
                            <input
                                v-model="form.button_url"
                                type="text"
                                placeholder="e.g., /services or https://..."
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white outline-none"
                            />
                        </div>
                    </div>
                </div>

                <!-- Display Location & Target Pages -->
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <h3 class="font-bold text-slate-900 text-sm border-b border-slate-100 pb-2">3. Placement & Targeting</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Display Location -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Display Location</label>
                            <select
                                v-model="form.display_location"
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white outline-none"
                            >
                                <option v-for="(name, key) in locations" :key="key" :value="key">{{ name }}</option>
                            </select>
                        </div>

                        <!-- Target Pages -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Target Pages</label>
                            <select
                                v-model="form.target_pages"
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white outline-none"
                            >
                                <option value="all">All Pages</option>
                                <option value="home">Homepage Only</option>
                                <option value="specific">Specific Pages</option>
                            </select>
                        </div>
                    </div>

                    <!-- Specific Pages Input -->
                    <div v-if="form.target_pages === 'specific'" class="p-4 bg-slate-50 rounded-xl border border-slate-200 space-y-3">
                        <span class="text-xs font-bold text-slate-800 block">Specific Target Routes</span>

                        <div class="flex gap-2">
                            <input
                                v-model="specificPageInput"
                                @keyup.enter.prevent="addSpecificPage"
                                type="text"
                                placeholder="Enter page path e.g. /about or /services"
                                class="flex-1 py-2 px-3 bg-white border border-slate-300 rounded-xl text-xs font-semibold outline-none"
                            />
                            <button
                                type="button"
                                @click="addSpecificPage"
                                class="px-4 py-2 bg-slate-800 text-white font-bold text-xs rounded-xl hover:bg-slate-900 transition"
                            >
                                Add Route
                            </button>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <button
                                v-for="opt in pageOptions"
                                :key="opt.path"
                                type="button"
                                @click="!form.specific_pages.includes(opt.path) ? form.specific_pages.push(opt.path) : null"
                                class="px-2.5 py-1 bg-white border border-slate-200 rounded-lg text-xs text-slate-700 font-semibold hover:border-slate-400"
                            >
                                + {{ opt.label }} ({{ opt.path }})
                            </button>
                        </div>

                        <div class="flex flex-wrap gap-2 pt-2">
                            <span
                                v-for="(p, idx) in form.specific_pages"
                                :key="p"
                                class="inline-flex items-center gap-1.5 px-3 py-1 bg-sky-100 text-sky-800 rounded-full text-xs font-bold"
                            >
                                <span>{{ p }}</span>
                                <button type="button" @click="removeSpecificPage(idx)" class="hover:text-rose-600">×</button>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Publishing Schedule & Toggles -->
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <h3 class="font-bold text-slate-900 text-sm border-b border-slate-100 pb-2 flex items-center gap-2">
                        <Calendar class="w-4 h-4 text-sky-600" />
                        <span>4. Schedule & Publishing Controls</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Start Date -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Start Date & Time (Optional)</label>
                            <input
                                v-model="form.start_date"
                                type="datetime-local"
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white outline-none"
                            />
                        </div>

                        <!-- End Date -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">End / Expiry Date (Optional)</label>
                            <input
                                v-model="form.end_date"
                                type="datetime-local"
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white outline-none"
                            />
                        </div>

                        <!-- Display Order -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Display Order</label>
                            <input
                                v-model.number="form.display_order"
                                type="number"
                                min="0"
                                class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:bg-white outline-none"
                            />
                        </div>
                    </div>

                    <!-- Switches -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                        <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200 cursor-pointer">
                            <input v-model="form.is_active" type="checkbox" class="w-4 h-4 text-sky-600 rounded" />
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Active Status</span>
                                <span class="text-[11px] text-slate-500">Enable on website</span>
                            </div>
                        </label>

                        <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200 cursor-pointer">
                            <input v-model="form.is_pinned" type="checkbox" class="w-4 h-4 text-amber-500 rounded" />
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Pinned Notice</span>
                                <span class="text-[11px] text-slate-500">Prioritize at top</span>
                            </div>
                        </label>

                        <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200 cursor-pointer">
                            <input v-model="form.is_dismissible" type="checkbox" class="w-4 h-4 text-sky-600 rounded" />
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Dismissible</span>
                                <span class="text-[11px] text-slate-500">Allow users to close</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Button Footer -->
            <div class="flex justify-end gap-3">
                <Link
                    href="/admin/announcements"
                    class="px-5 py-2.5 bg-slate-100 text-slate-700 font-semibold rounded-xl text-xs hover:bg-slate-200 transition"
                >
                    Cancel
                </Link>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-sky-600 text-white font-bold rounded-xl text-xs hover:bg-sky-700 transition shadow-md hover:shadow-sky-500/20"
                >
                    <Save class="w-4 h-4" />
                    <span>Save Announcement</span>
                </button>
            </div>
        </form>
    </div>
</template>
