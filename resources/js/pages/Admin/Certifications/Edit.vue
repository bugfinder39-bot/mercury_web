<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import {
    Award,
    ArrowLeft,
    Upload,
    X,
    FileText,
    Image as ImageIcon,
    Building2,
    Calendar,
    Globe,
    FileCode,
    Trash2,
    ExternalLink,
} from '@lucide/vue';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    certification: {
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
    };
    categories: string[];
}>();

const form = useForm({
    _method: 'PUT',
    title: props.certification.title || '',
    short_name: props.certification.short_name || '',
    category: props.certification.category || 'Certification',
    issuing_organization: props.certification.issuing_organization || '',
    issue_date: props.certification.issue_date || '',
    expiry_date: props.certification.expiry_date || '',
    certificate_number: props.certification.certificate_number || '',
    short_description: props.certification.short_description || '',
    detailed_description: props.certification.detailed_description || '',
    official_website_url: props.certification.official_website_url || '',
    logo: null as File | null,
    certificate_image: null as File | null,
    certificate_pdf: null as File | null,
    background_image: null as File | null,
    delete_logo: false,
    delete_certificate_image: false,
    delete_certificate_pdf: false,
    delete_background_image: false,
    order: props.certification.order,
    is_active: props.certification.is_active,
    is_featured: props.certification.is_featured,
});

// File Previews
const logoPreview = ref<string | null>(props.certification.logo || null);
const certImagePreview = ref<string | null>(props.certification.certificate_image || null);
const pdfFileName = ref<string | null>(props.certification.certificate_pdf ? 'Existing Certificate PDF' : null);
const bgPreview = ref<string | null>(props.certification.background_image || null);

const handleLogoUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.logo = file;
        form.delete_logo = false;
        logoPreview.value = URL.createObjectURL(file);
    }
};

const handleCertImageUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.certificate_image = file;
        form.delete_certificate_image = false;
        certImagePreview.value = URL.createObjectURL(file);
    }
};

const handlePdfUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.certificate_pdf = file;
        form.delete_certificate_pdf = false;
        pdfFileName.value = file.name;
    }
};

const handleBgUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.background_image = file;
        form.delete_background_image = false;
        bgPreview.value = URL.createObjectURL(file);
    }
};

const removeLogo = () => {
    form.logo = null;
    form.delete_logo = true;
    logoPreview.value = null;
};

const removeCertImage = () => {
    form.certificate_image = null;
    form.delete_certificate_image = true;
    certImagePreview.value = null;
};

const removePdf = () => {
    form.certificate_pdf = null;
    form.delete_certificate_pdf = true;
    pdfFileName.value = null;
};

const removeBg = () => {
    form.background_image = null;
    form.delete_background_image = true;
    bgPreview.value = null;
};

const submit = () => {
    // Submit using post with _method: 'PUT' for Inertia multipart file handling
    router.post(`/admin/certifications/${props.certification.id}`, form.data(), {
        forceFormData: true,
    });
};
</script>

<template>
    <Head :title="`Edit ${certification.title} - CMS Admin`" />

    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <Link
                    href="/admin/certifications"
                    class="rounded-xl border border-slate-200 bg-white p-2 text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                >
                    <ArrowLeft class="size-5" />
                </Link>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-[#0B2540]">
                        Edit Certification
                    </h1>
                    <p class="text-sm text-slate-500">
                        Update details, replacement media, or display options for this certification.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <form @submit.prevent="submit" class="space-y-6">
            <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm space-y-6">
                <h3 class="text-lg font-bold text-[#0B2540] border-b border-slate-100 pb-3 flex items-center gap-2">
                    <Award class="size-5 text-[#E8770C]" />
                    Basic Details
                </h3>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Certification Title <span class="text-rose-500">*</span>
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                        <p v-if="form.errors.title" class="mt-1 text-xs text-rose-500">{{ form.errors.title }}</p>
                    </div>

                    <!-- Short Name -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Short Name / Abbreviation
                        </label>
                        <input
                            v-model="form.short_name"
                            type="text"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Category <span class="text-rose-500">*</span>
                        </label>
                        <select
                            v-model="form.category"
                            required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        >
                            <option v-for="cat in categories" :key="cat" :value="cat">
                                {{ cat }}
                            </option>
                        </select>
                    </div>

                    <!-- Issuing Organization -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Issuing Organization <span class="text-rose-500">*</span>
                        </label>
                        <input
                            v-model="form.issuing_organization"
                            type="text"
                            required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                    </div>

                    <!-- Certificate Number -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Certificate Number / ID
                        </label>
                        <input
                            v-model="form.certificate_number"
                            type="text"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                    </div>

                    <!-- Issue Date -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Issue Date
                        </label>
                        <input
                            v-model="form.issue_date"
                            type="date"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                    </div>

                    <!-- Expiry Date -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Expiry Date
                        </label>
                        <input
                            v-model="form.expiry_date"
                            type="date"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                    </div>

                    <!-- Official Website URL -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Official Website URL
                        </label>
                        <input
                            v-model="form.official_website_url"
                            type="url"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                    </div>

                    <!-- Short Description -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Short Description (Summary Card)
                        </label>
                        <textarea
                            v-model="form.short_description"
                            rows="2"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        ></textarea>
                    </div>

                    <!-- Detailed Description -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Detailed Description (Modal View)
                        </label>
                        <textarea
                            v-model="form.detailed_description"
                            rows="4"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        ></textarea>
                    </div>
                </div>
            </div>

            <!-- Media Uploads Card -->
            <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm space-y-6">
                <h3 class="text-lg font-bold text-[#0B2540] border-b border-slate-100 pb-3 flex items-center gap-2">
                    <ImageIcon class="size-5 text-[#E8770C]" />
                    Media Attachments
                </h3>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Organization Logo -->
                    <div class="rounded-xl border border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                Organization Logo
                            </label>
                            <button
                                v-if="logoPreview"
                                type="button"
                                @click="removeLogo"
                                class="text-xs text-rose-600 hover:underline flex items-center gap-1"
                            >
                                <Trash2 class="size-3" /> Remove
                            </button>
                        </div>
                        <div class="mt-3 flex items-center gap-4">
                            <div class="flex size-16 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                                <img v-if="logoPreview" :src="logoPreview" class="size-full object-contain p-1" />
                                <Building2 v-else class="size-6 text-slate-400" />
                            </div>
                            <div class="flex-1">
                                <input
                                    type="file"
                                    accept="image/*"
                                    @change="handleLogoUpload"
                                    class="text-xs text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-[#E8770C]/10 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-[#E8770C]"
                                />
                                <p class="mt-1 text-[11px] text-slate-400">PNG, SVG, WEBP or JPG</p>
                            </div>
                        </div>
                    </div>

                    <!-- Certificate Image -->
                    <div class="rounded-xl border border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                Certificate Image Scan
                            </label>
                            <button
                                v-if="certImagePreview"
                                type="button"
                                @click="removeCertImage"
                                class="text-xs text-rose-600 hover:underline flex items-center gap-1"
                            >
                                <Trash2 class="size-3" /> Remove
                            </button>
                        </div>
                        <div class="mt-3 flex items-center gap-4">
                            <div class="flex size-16 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                                <img v-if="certImagePreview" :src="certImagePreview" class="size-full object-contain p-1" />
                                <ImageIcon v-else class="size-6 text-slate-400" />
                            </div>
                            <div class="flex-1">
                                <input
                                    type="file"
                                    accept="image/*"
                                    @change="handleCertImageUpload"
                                    class="text-xs text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-[#E8770C]/10 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-[#E8770C]"
                                />
                                <p class="mt-1 text-[11px] text-slate-400">High-res certificate scan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Certificate PDF -->
                    <div class="rounded-xl border border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                Official Certificate PDF
                            </label>
                            <button
                                v-if="pdfFileName"
                                type="button"
                                @click="removePdf"
                                class="text-xs text-rose-600 hover:underline flex items-center gap-1"
                            >
                                <Trash2 class="size-3" /> Remove
                            </button>
                        </div>
                        <div class="mt-3 flex items-center gap-4">
                            <div class="flex size-16 shrink-0 items-center justify-center rounded-xl border border-rose-100 bg-rose-50 text-rose-600">
                                <FileText class="size-7" />
                            </div>
                            <div class="flex-1">
                                <input
                                    type="file"
                                    accept="application/pdf"
                                    @change="handlePdfUpload"
                                    class="text-xs text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-rose-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-rose-700"
                                />
                                <div v-if="certification.certificate_pdf && !form.delete_certificate_pdf" class="mt-1 flex items-center gap-1 text-xs">
                                    <a :href="certification.certificate_pdf" target="_blank" class="font-medium text-rose-700 hover:underline flex items-center gap-1">
                                        <span>View Uploaded PDF</span>
                                        <ExternalLink class="size-3" />
                                    </a>
                                </div>
                                <p v-else-if="pdfFileName" class="mt-1 text-xs font-medium text-rose-700 truncate">
                                    New file: {{ pdfFileName }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Background Image -->
                    <div class="rounded-xl border border-dashed border-slate-200 p-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                Background Image
                            </label>
                            <button
                                v-if="bgPreview"
                                type="button"
                                @click="removeBg"
                                class="text-xs text-rose-600 hover:underline flex items-center gap-1"
                            >
                                <Trash2 class="size-3" /> Remove
                            </button>
                        </div>
                        <div class="mt-3 flex items-center gap-4">
                            <div class="flex size-16 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                                <img v-if="bgPreview" :src="bgPreview" class="size-full object-cover" />
                                <FileCode v-else class="size-6 text-slate-400" />
                            </div>
                            <div class="flex-1">
                                <input
                                    type="file"
                                    accept="image/*"
                                    @change="handleBgUpload"
                                    class="text-xs text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-[#E8770C]/10 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-[#E8770C]"
                                />
                                <p class="mt-1 text-[11px] text-slate-400">Card background pattern</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Card -->
            <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm space-y-4">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Display Order
                        </label>
                        <input
                            v-model.number="form.order"
                            type="number"
                            min="0"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-[#E8770C] focus:outline-none focus:ring-1 focus:ring-[#E8770C]"
                        />
                    </div>

                    <div class="flex items-center gap-3 pt-6">
                        <input
                            v-model="form.is_active"
                            id="is_active"
                            type="checkbox"
                            class="size-4 rounded border-slate-300 text-[#E8770C] focus:ring-[#E8770C]"
                        />
                        <label for="is_active" class="text-sm font-semibold text-slate-700">
                            Active (Visible on public site)
                        </label>
                    </div>

                    <div class="flex items-center gap-3 pt-6">
                        <input
                            v-model="form.is_featured"
                            id="is_featured"
                            type="checkbox"
                            class="size-4 rounded border-slate-300 text-[#E8770C] focus:ring-[#E8770C]"
                        />
                        <label for="is_featured" class="text-sm font-semibold text-slate-700">
                            Featured Certification
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Actions -->
            <div class="flex items-center justify-end gap-3">
                <Link
                    href="/admin/certifications"
                    class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors"
                >
                    Cancel
                </Link>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="rounded-xl bg-[#E8770C] px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#d66b09] disabled:opacity-50 transition-colors"
                >
                    Update Certification
                </button>
            </div>
        </form>
    </div>
</template>
