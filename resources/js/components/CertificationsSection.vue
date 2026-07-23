<script setup lang="ts">
import { ref, computed } from 'vue';
import {
    Award,
    ShieldCheck,
    CheckCircle2,
    Calendar,
    ExternalLink,
    FileText,
    Download,
    X,
    Eye,
    Building2,
    ChevronRight,
    BadgeCheck,
} from '@lucide/vue';

interface Certification {
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
}

const props = defineProps<{
    section?: {
        id?: number;
        heading?: string;
        subheading?: string;
        body?: string;
        is_active?: boolean;
    };
    certifications: Certification[];
}>();

// Filter category tab
const activeTab = ref<string>('All');

// Selected certification for detail modal
const activeModalCert = ref<Certification | null>(null);

// Category options extracted from items
const categoryTabs = computed(() => {
    const set = new Set<string>();
    props.certifications.forEach((c) => {
        if (c.category) set.add(c.category);
    });
    return ['All', ...Array.from(set)];
});

// Filtered certifications
const filteredCertifications = computed(() => {
    if (activeTab.value === 'All') {
        return props.certifications;
    }
    return props.certifications.filter((c) => c.category === activeTab.value);
});

// Category Badge Color
const getCategoryColor = (category: string) => {
    switch (category) {
        case 'Certification':
            return 'bg-amber-50 text-amber-700 border-amber-200/80';
        case 'Membership':
            return 'bg-blue-50 text-blue-700 border-blue-200/80';
        case 'Accreditation':
            return 'bg-emerald-50 text-emerald-700 border-emerald-200/80';
        case 'License':
            return 'bg-purple-50 text-purple-700 border-purple-200/80';
        case 'Award':
            return 'bg-rose-50 text-rose-700 border-rose-200/80';
        default:
            return 'bg-slate-50 text-slate-700 border-slate-200/80';
    }
};

const openModal = (cert: Certification) => {
    activeModalCert.value = cert;
    document.body.style.overflow = 'hidden';
};

const closeModal = () => {
    activeModalCert.value = null;
    document.body.style.overflow = '';
};
</script>

<template>
    <section
        v-if="section?.is_active !== false"
        class="relative overflow-hidden py-20 lg:py-28"
        style="background-color: #0b2540"
    >
        <!-- Background Decorative Elements -->
        <div class="pointer-events-none absolute inset-0 opacity-10">
            <div
                class="absolute -top-40 -left-40 size-96 rounded-full blur-3xl"
                style="background-color: #e8770c"
            ></div>
            <div
                class="absolute -bottom-40 -right-40 size-96 rounded-full blur-3xl"
                style="background-color: #0284c7"
            ></div>
            <div
                class="h-full w-full"
                style="
                    background-image: radial-gradient(
                        rgba(255, 255, 255, 0.15) 1px,
                        transparent 1px
                    );
                    background-size: 32px 32px;
                "
            ></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="mx-auto max-w-3xl text-center">
                <div
                    class="inline-flex items-center gap-2 rounded-full border px-4 py-1.5 text-xs font-bold uppercase tracking-widest"
                    style="
                        background-color: rgba(232, 119, 12, 0.12);
                        border-color: rgba(232, 119, 12, 0.3);
                        color: #e8770c;
                    "
                >
                    <ShieldCheck class="size-4" />
                    <span>{{
                        section?.subheading ||
                        'TRUST & COMPLIANCE · GLOBAL STANDARDS'
                    }}</span>
                </div>

                <h2
                    class="mt-4 font-display text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl"
                >
                    {{
                        section?.heading || 'Certifications & Accreditations'
                    }}
                </h2>

                <p
                    class="mt-4 text-base leading-relaxed text-slate-300 sm:text-lg"
                >
                    {{
                        section?.body ||
                        'Mercury Bangladesh operates under globally recognized quality standards, international shipping licenses, and freight forwarding memberships to ensure complete regulatory compliance.'
                    }}
                </p>
            </div>

            <!-- Category Filter Tabs -->
            <div
                v-if="categoryTabs.length > 1"
                class="mt-10 flex flex-wrap items-center justify-center gap-2"
            >
                <button
                    v-for="tab in categoryTabs"
                    :key="tab"
                    @click="activeTab = tab"
                    class="rounded-xl px-4 py-2 text-xs font-semibold tracking-wide uppercase transition-all duration-200 cursor-pointer"
                    :style="
                        activeTab === tab
                            ? 'background-color: #E8770C; color: #FFFFFF; box-shadow: 0 4px 14px rgba(232, 119, 12, 0.4);'
                            : 'background-color: rgba(255, 255, 255, 0.06); color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(255, 255, 255, 0.1);'
                    "
                >
                    {{ tab }}
                </button>
            </div>

            <!-- Certifications Cards Grid -->
            <div
                class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
            >
                <div
                    v-for="cert in filteredCertifications"
                    :key="cert.id"
                    class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border transition-all duration-300 hover:-translate-y-1.5"
                    style="
                        background-color: rgba(15, 42, 70, 0.75);
                        border-color: rgba(255, 255, 255, 0.1);
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                        backdrop-filter: blur(12px);
                    "
                >
                    <!-- Background Pattern Image if available -->
                    <div
                        v-if="cert.background_image"
                        class="absolute inset-0 z-0 opacity-10 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                        :style="`background-image: url('${cert.background_image}')`"
                    ></div>

                    <!-- Card Body -->
                    <div class="relative z-10 p-6 sm:p-7 flex-1 flex flex-col">
                        <!-- Top Row: Badge & Featured Star -->
                        <div class="flex items-center justify-between gap-2">
                            <span
                                class="inline-flex rounded-lg border px-2.5 py-1 text-[11px] font-bold tracking-wide uppercase"
                                :class="getCategoryColor(cert.category)"
                            >
                                {{ cert.category }}
                            </span>

                            <div
                                v-if="cert.is_featured"
                                class="flex items-center gap-1 rounded-full px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider text-amber-300"
                                style="
                                    background-color: rgba(245, 158, 11, 0.15);
                                    border: 1px solid rgba(245, 158, 11, 0.3);
                                "
                            >
                                <Award class="size-3 text-amber-400" />
                                <span>Featured</span>
                            </div>
                        </div>

                        <!-- Logo & Header -->
                        <div class="mt-6 flex items-start gap-4">
                            <div
                                class="flex size-14 shrink-0 items-center justify-center overflow-hidden rounded-2xl border shadow-sm transition-transform duration-300 group-hover:scale-105"
                                style="
                                    background-color: #ffffff;
                                    border-color: rgba(255, 255, 255, 0.2);
                                "
                            >
                                <img
                                    v-if="cert.logo"
                                    :src="cert.logo"
                                    :alt="cert.title"
                                    class="size-full object-contain p-2"
                                />
                                <BadgeCheck
                                    v-else
                                    class="size-7 text-[#0B2540]"
                                />
                            </div>

                            <div>
                                <h3
                                    class="font-display text-lg font-bold leading-snug text-white group-hover:text-[#E8770C] transition-colors"
                                >
                                    {{ cert.title }}
                                </h3>
                                <p
                                    class="mt-1 text-xs font-semibold text-slate-400"
                                >
                                    {{ cert.issuing_organization }}
                                </p>
                            </div>
                        </div>

                        <!-- Description -->
                        <p
                            v-if="cert.short_description"
                            class="mt-4 text-xs leading-relaxed text-slate-300 line-clamp-3 flex-1"
                        >
                            {{ cert.short_description }}
                        </p>

                        <!-- Certificate Number & Dates -->
                        <div
                            class="mt-5 pt-4 border-t flex flex-wrap items-center justify-between gap-2 text-[11px] text-slate-400"
                            style="border-color: rgba(255, 255, 255, 0.08)"
                        >
                            <span
                                v-if="cert.certificate_number"
                                class="font-mono text-slate-300"
                            >
                                ID: {{ cert.certificate_number }}
                            </span>
                            <span v-else class="text-emerald-400 font-semibold"
                                >Active Accreditation</span
                            >

                            <span
                                v-if="cert.issue_date"
                                class="flex items-center gap-1"
                            >
                                <Calendar class="size-3 text-slate-400" />
                                <span>{{
                                    cert.issue_date.substring(0, 4)
                                }}</span>
                            </span>
                        </div>
                    </div>

                    <!-- Card Actions Footer -->
                    <div
                        class="relative z-10 grid grid-cols-2 gap-px p-1"
                        style="
                            background-color: rgba(255, 255, 255, 0.08);
                            border-top: 1px solid rgba(255, 255, 255, 0.08);
                        "
                    >
                        <button
                            @click="openModal(cert)"
                            class="flex items-center justify-center gap-1.5 rounded-xl py-2.5 text-xs font-bold text-white transition-colors duration-150 cursor-pointer"
                            style="background-color: rgba(255, 255, 255, 0.05)"
                        >
                            <Eye class="size-3.5 text-[#E8770C]" />
                            <span>View Details</span>
                        </button>

                        <a
                            v-if="cert.certificate_pdf"
                            :href="cert.certificate_pdf"
                            target="_blank"
                            class="flex items-center justify-center gap-1.5 rounded-xl py-2.5 text-xs font-bold text-rose-300 transition-colors duration-150"
                            style="background-color: rgba(244, 63, 94, 0.12)"
                        >
                            <FileText class="size-3.5" />
                            <span>PDF Document</span>
                        </a>

                        <a
                            v-else-if="cert.official_website_url"
                            :href="cert.official_website_url"
                            target="_blank"
                            rel="noopener"
                            class="flex items-center justify-center gap-1.5 rounded-xl py-2.5 text-xs font-bold text-slate-300 transition-colors duration-150"
                            style="background-color: rgba(255, 255, 255, 0.05)"
                        >
                            <ExternalLink class="size-3.5" />
                            <span>Official Site</span>
                        </a>

                        <button
                            v-else
                            @click="openModal(cert)"
                            class="flex items-center justify-center gap-1.5 rounded-xl py-2.5 text-xs font-bold text-slate-300 transition-colors duration-150 cursor-pointer"
                            style="background-color: rgba(255, 255, 255, 0.05)"
                        >
                            <span>Verify</span>
                            <ChevronRight class="size-3.5" />
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Modal -->
        <div
            v-if="activeModalCert"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 backdrop-blur-md animate-in fade-in duration-200"
            style="background-color: rgba(11, 37, 64, 0.8)"
            @click.self="closeModal"
        >
            <div
                class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl border bg-white shadow-2xl animate-in zoom-in-95 duration-200"
                style="border-color: rgba(11, 37, 64, 0.15)"
            >
                <!-- Modal Header Banner -->
                <div
                    class="relative p-6 sm:p-8"
                    style="background-color: #0b2540"
                >
                    <button
                        @click="closeModal"
                        class="absolute right-4 top-4 rounded-full p-2 text-slate-400 hover:bg-white/10 hover:text-white transition-colors cursor-pointer"
                    >
                        <X class="size-5" />
                    </button>

                    <div class="flex items-center gap-4">
                        <div
                            class="flex size-16 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-white/20 bg-white p-2 shadow-md"
                        >
                            <img
                                v-if="activeModalCert.logo"
                                :src="activeModalCert.logo"
                                :alt="activeModalCert.title"
                                class="size-full object-contain"
                            />
                            <Award v-else class="size-8 text-[#0B2540]" />
                        </div>

                        <div>
                            <span
                                class="inline-flex rounded-lg px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider"
                                :class="
                                    getCategoryColor(activeModalCert.category)
                                "
                            >
                                {{ activeModalCert.category }}
                            </span>
                            <h3
                                class="mt-1 font-display text-xl font-bold text-white sm:text-2xl"
                            >
                                {{ activeModalCert.title }}
                            </h3>
                            <p class="mt-1 text-xs text-slate-300">
                                {{ activeModalCert.issuing_organization }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Modal Content Body -->
                <div class="p-6 sm:p-8 space-y-6">
                    <!-- High-Res Certificate Image Scan (if uploaded) -->
                    <div
                        v-if="activeModalCert.certificate_image"
                        class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-2 shadow-inner"
                    >
                        <img
                            :src="activeModalCert.certificate_image"
                            :alt="activeModalCert.title"
                            class="w-full max-h-72 object-contain rounded-xl"
                        />
                    </div>

                    <!-- Metadata Grid -->
                    <div
                        class="grid grid-cols-2 gap-4 rounded-2xl border border-slate-100 bg-slate-50/80 p-4 text-xs"
                    >
                        <div>
                            <span
                                class="font-semibold text-slate-400 uppercase tracking-wider text-[10px]"
                                >Certificate ID</span
                            >
                            <p class="mt-0.5 font-mono font-bold text-slate-800">
                                {{ activeModalCert.certificate_number || 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <span
                                class="font-semibold text-slate-400 uppercase tracking-wider text-[10px]"
                                >Issuing Body</span
                            >
                            <p class="mt-0.5 font-semibold text-slate-800">
                                {{ activeModalCert.issuing_organization }}
                            </p>
                        </div>
                        <div>
                            <span
                                class="font-semibold text-slate-400 uppercase tracking-wider text-[10px]"
                                >Issue Date</span
                            >
                            <p class="mt-0.5 font-medium text-slate-700">
                                {{ activeModalCert.issue_date || 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <span
                                class="font-semibold text-slate-400 uppercase tracking-wider text-[10px]"
                                >Validity / Expiry</span
                            >
                            <p class="mt-0.5 font-medium text-slate-700">
                                {{ activeModalCert.expiry_date || 'Ongoing Accreditation' }}
                            </p>
                        </div>
                    </div>

                    <!-- Detailed Description -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Description & Compliance Scope
                        </h4>
                        <p class="mt-2 text-sm leading-relaxed text-slate-700">
                            {{
                                activeModalCert.detailed_description ||
                                activeModalCert.short_description ||
                                'No additional description specified.'
                            }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <a
                            v-if="activeModalCert.official_website_url"
                            :href="activeModalCert.official_website_url"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors"
                        >
                            <ExternalLink class="size-4 text-[#E8770C]" />
                            <span>Visit Official Website</span>
                        </a>

                        <a
                            v-if="activeModalCert.certificate_pdf"
                            :href="activeModalCert.certificate_pdf"
                            target="_blank"
                            download
                            class="inline-flex items-center gap-2 rounded-xl bg-rose-600 px-5 py-2.5 text-xs font-bold text-white shadow-md hover:bg-rose-700 transition-colors"
                        >
                            <Download class="size-4" />
                            <span>Download Official PDF</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
