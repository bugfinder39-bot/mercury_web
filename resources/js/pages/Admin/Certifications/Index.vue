<script setup lang="ts">
import { ref, watch } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import {
    Award,
    Plus,
    Search,
    Filter,
    Edit3,
    Trash2,
    Copy,
    Eye,
    EyeOff,
    ExternalLink,
    FileText,
    Settings,
    Check,
    X,
    ArrowUpDown,
    CheckCircle2,
    XCircle,
    Building2,
    Calendar,
    BadgeCheck,
} from '@lucide/vue';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    certifications: Array<{
        id: number;
        title: string;
        short_name?: string;
        category: string;
        issuing_organization: string;
        issue_date?: string;
        expiry_date?: string;
        certificate_number?: string;
        short_description?: string;
        detailed_description?: string;
        official_website_url?: string;
        logo?: string;
        certificate_image?: string;
        certificate_pdf?: string;
        background_image?: string;
        order: number;
        is_active: boolean;
        is_featured: boolean;
    }>;
    categories: string[];
    filters: {
        search?: string;
        category?: string;
        status?: string;
    };
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
        is_active: boolean;
    };
}>();

// Filter states
const search = ref(props.filters.search || '');
const selectedCategory = ref(props.filters.category || '');
const selectedStatus = ref(props.filters.status || '');

const applyFilters = () => {
    router.get(
        '/admin/certifications',
        {
            search: search.value || undefined,
            category: selectedCategory.value || undefined,
            status: selectedStatus.value || undefined,
        },
        { preserveState: true, replace: true }
    );
};

const clearFilters = () => {
    search.value = '';
    selectedCategory.value = '';
    selectedStatus.value = '';
    applyFilters();
};

// Toggle status
const toggleStatus = (id: number) => {
    router.patch(
        `/admin/certifications/${id}/toggle-status`,
        {},
        { preserveScroll: true }
    );
};

// Duplicate certification
const duplicateCertification = (id: number) => {
    router.post(
        `/admin/certifications/${id}/duplicate`,
        {},
        { preserveScroll: true }
    );
};

// Delete certification
const deleteCertification = (id: number, title: string) => {
    if (confirm(`Are you sure you want to delete "${title}"?`)) {
        router.delete(`/admin/certifications/${id}`, { preserveScroll: true });
    }
};

// Section Settings Modal State & Form
const showSettingsModal = ref(false);
const sectionForm = useForm({
    heading: props.section?.heading || 'Certifications & Accreditations',
    subheading: props.section?.subheading || 'TRUST & COMPLIANCE · GLOBAL STANDARDS',
    body: props.section?.body || '',
    is_active: props.section?.is_active ?? true,
});

const saveSectionSettings = () => {
    sectionForm.put('/admin/certifications/section-settings', {
        onSuccess: () => {
            showSettingsModal.value = false;
        },
    });
};

// Category Badge Color Mapping
const getCategoryBadgeClass = (category: string) => {
    switch (category) {
        case 'Certification':
            return 'bg-amber-50 text-amber-700 border-amber-200';
        case 'Membership':
            return 'bg-blue-50 text-blue-700 border-blue-200';
        case 'Accreditation':
            return 'bg-emerald-50 text-emerald-700 border-emerald-200';
        case 'License':
            return 'bg-purple-50 text-purple-700 border-purple-200';
        case 'Award':
            return 'bg-rose-50 text-rose-700 border-rose-200';
        default:
            return 'bg-slate-50 text-slate-700 border-slate-200';
    }
};
</script>

<template>
    <Head title="Certifications & Memberships - CMS Admin" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <Award class="size-6 text-[#E8770C]" />
                    <h1 class="text-2xl font-bold tracking-tight text-[#0B2540]">
                        Certifications & Memberships
                    </h1>
                </div>
                <p class="mt-1 text-sm text-slate-500">
                    Manage professional certifications, industry memberships, licenses, and accreditations.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button
                    @click="showSettingsModal = true"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:border-slate-300 hover:bg-slate-50"
                >
                    <Settings class="size-4 text-slate-500" />
                    <span>Section Settings</span>
                </button>

                <Link
                    href="/admin/certifications/create"
                    class="inline-flex items-center gap-2 rounded-xl bg-[#E8770C] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-[#d66b09] hover:shadow"
                >
                    <Plus class="size-4" />
                    <span>Add Certification</span>
                </Link>
            </div>
        </div>

        <!-- Filters Bar -->
        <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <!-- Search Input -->
                <div class="relative md:col-span-2">
                    <Search class="absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                    <input
                        v-model="search"
                        @input="applyFilters"
                        type="text"
                        placeholder="Search title, organization, or certificate number..."
                        class="w-full rounded-xl border border-slate-200 pl-10 pr-4 py-2 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                    />
                </div>

                <!-- Category Select -->
                <div>
                    <select
                        v-model="selectedCategory"
                        @change="applyFilters"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                    >
                        <option value="">All Categories</option>
                        <option v-for="cat in categories" :key="cat" :value="cat">
                            {{ cat }}
                        </option>
                    </select>
                </div>

                <!-- Status & Clear -->
                <div class="flex items-center gap-2">
                    <select
                        v-model="selectedStatus"
                        @change="applyFilters"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                    >
                        <option value="">All Statuses</option>
                        <option value="active">Active Only</option>
                        <option value="inactive">Inactive Only</option>
                    </select>

                    <button
                        v-if="search || selectedCategory || selectedStatus"
                        @click="clearFilters"
                        class="rounded-xl border border-rose-200 bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-600 transition-colors hover:bg-rose-100"
                        title="Clear filters"
                    >
                        Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
            <div v-if="certifications.length === 0" class="p-12 text-center">
                <BadgeCheck class="mx-auto size-12 text-slate-300" />
                <h3 class="mt-3 text-base font-semibold text-slate-800">No certifications found</h3>
                <p class="mt-1 text-sm text-slate-500">
                    Get started by adding your first company certification or accreditation.
                </p>
                <div class="mt-6">
                    <Link
                        href="/admin/certifications/create"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#E8770C] px-4 py-2 text-sm font-semibold text-white hover:bg-[#d66b09]"
                    >
                        <Plus class="size-4" />
                        <span>Add Certification</span>
                    </Link>
                </div>
            </div>

            <div v-else class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-100 bg-slate-50/60 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Order</th>
                            <th class="px-6 py-4">Certification</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Issuing Organization</th>
                            <th class="px-6 py-4">Media</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr
                            v-for="cert in certifications"
                            :key="cert.id"
                            class="transition-colors hover:bg-slate-50/50"
                        >
                            <!-- Order -->
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-slate-400">
                                #{{ cert.order }}
                            </td>

                            <!-- Title & Info -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex size-10 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50"
                                    >
                                        <img
                                            v-if="cert.logo"
                                            :src="cert.logo"
                                            :alt="cert.title"
                                            class="size-full object-contain p-1"
                                        />
                                        <Award v-else class="size-5 text-slate-400" />
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-[#0B2540]">{{ cert.title }}</span>
                                            <span
                                                v-if="cert.is_featured"
                                                class="rounded-full bg-amber-100 px-2 py-0.5 text-[10px] font-bold text-amber-800"
                                            >
                                                Featured
                                            </span>
                                        </div>
                                        <div class="mt-0.5 text-xs text-slate-500">
                                            <span v-if="cert.certificate_number" class="font-mono">#{{ cert.certificate_number }}</span>
                                            <span v-if="cert.certificate_number && cert.short_name"> • </span>
                                            <span v-if="cert.short_name" class="font-medium text-slate-600">{{ cert.short_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-lg border px-2.5 py-1 text-xs font-semibold"
                                    :class="getCategoryBadgeClass(cert.category)"
                                >
                                    {{ cert.category }}
                                </span>
                            </td>

                            <!-- Organization -->
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-700">
                                    {{ cert.issuing_organization }}
                                </div>
                                <div v-if="cert.issue_date || cert.expiry_date" class="mt-0.5 flex items-center gap-1 text-xs text-slate-400">
                                    <Calendar class="size-3" />
                                    <span>{{ cert.issue_date || 'N/A' }} — {{ cert.expiry_date || 'Ongoing' }}</span>
                                </div>
                            </td>

                            <!-- Media Attached -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-xs">
                                    <span
                                        v-if="cert.certificate_image"
                                        class="rounded bg-slate-100 px-2 py-0.5 text-slate-600 font-mono"
                                        title="Has Certificate Image"
                                    >IMG</span>
                                    <span
                                        v-if="cert.certificate_pdf"
                                        class="rounded bg-rose-100 text-rose-700 px-2 py-0.5 font-bold font-mono"
                                        title="Has PDF Certificate"
                                    >PDF</span>
                                    <span
                                        v-if="!cert.certificate_image && !cert.certificate_pdf"
                                        class="text-slate-400 italic"
                                    >None</span>
                                </div>
                            </td>

                            <!-- Status Toggle -->
                            <td class="px-6 py-4">
                                <button
                                    @click="toggleStatus(cert.id)"
                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold transition-all"
                                    :class="
                                        cert.is_active
                                            ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100'
                                            : 'bg-slate-100 text-slate-500 hover:bg-slate-200'
                                    "
                                >
                                    <CheckCircle2 v-if="cert.is_active" class="size-3.5 text-emerald-600" />
                                    <XCircle v-else class="size-3.5 text-slate-400" />
                                    <span>{{ cert.is_active ? 'Active' : 'Disabled' }}</span>
                                </button>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <Link
                                        :href="`/admin/certifications/${cert.id}/edit`"
                                        class="rounded-lg p-1.5 text-slate-500 hover:bg-slate-100 hover:text-slate-900 transition-colors"
                                        title="Edit Certification"
                                    >
                                        <Edit3 class="size-4" />
                                    </Link>

                                    <button
                                        @click="duplicateCertification(cert.id)"
                                        class="rounded-lg p-1.5 text-slate-500 hover:bg-slate-100 hover:text-slate-900 transition-colors"
                                        title="Duplicate Certification"
                                    >
                                        <Copy class="size-4" />
                                    </button>

                                    <button
                                        @click="deleteCertification(cert.id, cert.title)"
                                        class="rounded-lg p-1.5 text-rose-500 hover:bg-rose-50 hover:text-rose-700 transition-colors"
                                        title="Delete Certification"
                                    >
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section Settings Modal -->
        <div
            v-if="showSettingsModal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 backdrop-blur-sm"
            style="background-color: rgba(11, 37, 64, 0.4)"
        >
            <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-2xl animate-in fade-in zoom-in-95 duration-150">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <Settings class="size-5 text-[#E8770C]" />
                        <h3 class="text-lg font-bold text-[#0B2540]">Certifications Section Settings</h3>
                    </div>
                    <button
                        @click="showSettingsModal = false"
                        class="rounded-lg p-1 text-slate-400 hover:bg-slate-100 hover:text-slate-600"
                    >
                        <X class="size-5" />
                    </button>
                </div>

                <form @submit.prevent="saveSectionSettings" class="mt-4 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Section Heading
                        </label>
                        <input
                            v-model="sectionForm.heading"
                            type="text"
                            required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Subheading / Tagline
                        </label>
                        <input
                            v-model="sectionForm.subheading"
                            type="text"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Section Description Body
                        </label>
                        <textarea
                            v-model="sectionForm.body"
                            rows="3"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        ></textarea>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <input
                            v-model="sectionForm.is_active"
                            id="section_is_active"
                            type="checkbox"
                            class="size-4 rounded border-slate-300 text-[#E8770C] focus:ring-[#E8770C]"
                        />
                        <label for="section_is_active" class="text-sm font-medium text-slate-700">
                            Enable Certifications Section on Public Website
                        </label>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button
                            type="button"
                            @click="showSettingsModal = false"
                            class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="sectionForm.processing"
                            class="rounded-xl bg-[#E8770C] px-5 py-2 text-sm font-semibold text-white hover:bg-[#d66b09] disabled:opacity-50"
                        >
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
