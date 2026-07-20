<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { 
    Save, 
    Image as ImageIcon, 
    Plus, 
    Trash2, 
    ArrowUp, 
    ArrowDown, 
    Check, 
    X, 
    Eye, 
    Edit2,
    Link as LinkIcon,
    AlertCircle
} from '@lucide/vue';

const props = defineProps<{
    settings: Record<string, any>;
}>();

defineOptions({
    layout: AdminLayout,
});

const activeTab = ref<'navbar_content' | 'navbar_design' | 'footer_content' | 'footer_design' | 'global_design'>('navbar_content');
const previewMode = ref<boolean>(true);

// Initialize form
const form = useForm({
    _method: 'POST',
    settings: {
        navbar_website_name: props.settings.navbar_website_name || '',
        navbar_website_tagline: props.settings.navbar_website_tagline || '',
        navbar_logo: props.settings.navbar_logo || '',
        navbar_links: Array.isArray(props.settings.navbar_links) ? props.settings.navbar_links : [],
        navbar_cta_text: props.settings.navbar_cta_text || '',
        navbar_cta_url: props.settings.navbar_cta_url || '',
        navbar_cta_active: String(props.settings.navbar_cta_active || 'true'),
        navbar_style: props.settings.navbar_style || 'glassmorphism',
        navbar_sticky: String(props.settings.navbar_sticky || 'true'),
        navbar_blur: String(props.settings.navbar_blur || 'true'),
        navbar_shadow: String(props.settings.navbar_shadow || 'true'),
        navbar_border_bottom: String(props.settings.navbar_border_bottom || 'true'),
        navbar_bg: props.settings.navbar_bg || '#FFFFFF',
        navbar_text: props.settings.navbar_text || '#0B2540',
        navbar_hover: props.settings.navbar_hover || '#E8770C',
        navbar_active: props.settings.navbar_active || '#E8770C',
        navbar_cta_bg: props.settings.navbar_cta_bg || '#E8770C',
        navbar_cta_text_color: props.settings.navbar_cta_text_color || '#FFFFFF',
        navbar_cta_hover_bg: props.settings.navbar_cta_hover_bg || '#CC6608',
        navbar_cta_hover_text: props.settings.navbar_cta_hover_text || '#FFFFFF',
        navbar_glass_opacity: Number(props.settings.navbar_glass_opacity ?? 0.9),
        navbar_glass_blur: props.settings.navbar_glass_blur || '12px',
        navbar_border_color: props.settings.navbar_border_color || 'rgba(226, 232, 240, 0.5)',
        navbar_shadow_strength: props.settings.navbar_shadow_strength || 'rgba(11, 37, 64, 0.05)',
        navbar_height: props.settings.navbar_height || '72px',
        navbar_font_weight: props.settings.navbar_font_weight || '500',

        // Footer
        footer_logo: props.settings.footer_logo || '',
        footer_company_name: props.settings.footer_company_name || '',
        footer_description: props.settings.footer_description || '',
        footer_quick_links: Array.isArray(props.settings.footer_quick_links) ? props.settings.footer_quick_links : [],
        footer_services: Array.isArray(props.settings.footer_services) ? props.settings.footer_services : [],
        footer_newsletter_title: props.settings.footer_newsletter_title || '',
        footer_newsletter_desc: props.settings.footer_newsletter_desc || '',
        footer_newsletter_active: String(props.settings.footer_newsletter_active || 'true'),
        footer_socials: Array.isArray(props.settings.footer_socials) ? props.settings.footer_socials : [],
        footer_address: props.settings.footer_address || '',
        footer_phone: props.settings.footer_phone || '',
        footer_email: props.settings.footer_email || '',
        footer_copyright: props.settings.footer_copyright || '',
        footer_tagline: props.settings.footer_tagline || '',
        footer_bg: props.settings.footer_bg || '#FFFFFF',
        footer_text: props.settings.footer_text || '#475569',
        footer_heading_color: props.settings.footer_heading_color || '#0B2540',
        footer_link_color: props.settings.footer_link_color || '#475569',
        footer_link_hover_color: props.settings.footer_link_hover_color || '#E8770C',
        footer_icon_bg: props.settings.footer_icon_bg || '#F8FAFC',
        footer_icon_color: props.settings.footer_icon_color || '#123A5E',
        footer_border_color: props.settings.footer_border_color || '#F1F5F9',
        footer_newsletter_bg: props.settings.footer_newsletter_bg || '#F8FAFC',
        footer_newsletter_btn_bg: props.settings.footer_newsletter_btn_bg || '#E8770C',
        footer_newsletter_btn_text: props.settings.footer_newsletter_btn_text || 'Subscribe',
        footer_copyright_color: props.settings.footer_copyright_color || '#94A3B8',
        footer_bottom_bg: props.settings.footer_bottom_bg || '#FFFFFF',
        footer_shadow_strength: props.settings.footer_shadow_strength || 'rgba(11, 37, 64, 0.05)',
        footer_top_padding: props.settings.footer_top_padding || '80px',
        footer_bottom_padding: props.settings.footer_bottom_padding || '40px',
        footer_font_weight: props.settings.footer_font_weight || '400',

        // Global Design
        heading_color: props.settings.heading_color || '#0B2540',
        paragraph_color: props.settings.paragraph_color || '#475569',
        small_text_color: props.settings.small_text_color || '#94A3B8',
        container_width: props.settings.container_width || '1280px',
    },
    navbar_logo_file: null as File | null,
    footer_logo_file: null as File | null,
});

// Image preview state
const navbarLogoPreview = ref<string | null>(props.settings.navbar_logo || null);
const footerLogoPreview = ref<string | null>(props.settings.footer_logo || null);

const handleNavbarLogoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0];
    if (file) {
        form.navbar_logo_file = file;
        navbarLogoPreview.value = URL.createObjectURL(file);
    }
};

const handleFooterLogoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0];
    if (file) {
        form.footer_logo_file = file;
        footerLogoPreview.value = URL.createObjectURL(file);
    }
};

// Item editing modals helper state
const linkModalType = ref<'navbar' | 'quick_links' | 'services' | 'socials' | null>(null);
const currentLinkIndex = ref<number | null>(null);
const linkForm = ref({
    name: '',
    href: '',
    target_blank: false,
    is_active: true,
    platform: '',
    url: ''
});

const openLinkModal = (type: 'navbar' | 'quick_links' | 'services' | 'socials', index: number | null = null) => {
    linkModalType.value = type;
    currentLinkIndex.value = index;

    if (index !== null) {
        let item;
        if (type === 'navbar') item = form.settings.navbar_links[index];
        else if (type === 'quick_links') item = form.settings.footer_quick_links[index];
        else if (type === 'services') item = form.settings.footer_services[index];
        else item = form.settings.footer_socials[index];

        linkForm.value = {
            name: item.name || '',
            href: item.href || '',
            target_blank: !!item.target_blank,
            is_active: item.is_active !== false,
            platform: item.platform || '',
            url: item.url || ''
        };
    } else {
        linkForm.value = {
            name: '',
            href: '',
            target_blank: false,
            is_active: true,
            platform: type === 'socials' ? 'facebook' : '',
            url: ''
        };
    }
};

const saveLinkItem = () => {
    const type = linkModalType.value;
    if (!type) return;

    let targetArray: any[] = [];
    if (type === 'navbar') targetArray = form.settings.navbar_links;
    else if (type === 'quick_links') targetArray = form.settings.footer_quick_links;
    else if (type === 'services') targetArray = form.settings.footer_services;
    else targetArray = form.settings.footer_socials;

    const record: any = {};
    if (type === 'socials') {
        record.platform = linkForm.value.platform;
        record.url = linkForm.value.url;
        record.is_active = linkForm.value.is_active;
    } else {
        record.name = linkForm.value.name;
        record.href = linkForm.value.href;
        record.is_active = linkForm.value.is_active;
        if (type === 'navbar') {
            record.target_blank = linkForm.value.target_blank;
        }
    }

    // Validation: Require Name/URL/Platform
    if (type !== 'socials' && !record.name) {
        alert('Label is required');
        return;
    }
    if (type !== 'socials' && !record.href) {
        alert('URL path is required');
        return;
    }
    if (type === 'socials' && !record.url) {
        alert('Social URL is required');
        return;
    }

    if (currentLinkIndex.value !== null) {
        targetArray[currentLinkIndex.value] = record;
    } else {
        targetArray.push(record);
    }

    linkModalType.value = null;
    currentLinkIndex.value = null;
};

const deleteLinkItem = (type: 'navbar' | 'quick_links' | 'services' | 'socials', index: number) => {
    if (!confirm('Are you sure you want to delete this menu item?')) return;
    if (type === 'navbar') form.settings.navbar_links.splice(index, 1);
    else if (type === 'quick_links') form.settings.footer_quick_links.splice(index, 1);
    else if (type === 'services') form.settings.footer_services.splice(index, 1);
    else form.settings.footer_socials.splice(index, 1);
};

const moveLinkItem = (type: 'navbar' | 'quick_links' | 'services' | 'socials', index: number, direction: 'up' | 'down') => {
    let arr: any[] = [];
    if (type === 'navbar') arr = form.settings.navbar_links;
    else if (type === 'quick_links') arr = form.settings.footer_quick_links;
    else if (type === 'services') arr = form.settings.footer_services;
    else arr = form.settings.footer_socials;

    const targetIndex = direction === 'up' ? index - 1 : index + 1;
    if (targetIndex < 0 || targetIndex >= arr.length) return;

    const temp = arr[index];
    arr[index] = arr[targetIndex];
    arr[targetIndex] = temp;
};

const toggleItemActive = (type: 'navbar' | 'quick_links' | 'services' | 'socials', index: number) => {
    if (type === 'navbar') form.settings.navbar_links[index].is_active = !form.settings.navbar_links[index].is_active;
    else if (type === 'quick_links') form.settings.footer_quick_links[index].is_active = !form.settings.footer_quick_links[index].is_active;
    else if (type === 'services') form.settings.footer_services[index].is_active = !form.settings.footer_services[index].is_active;
    else form.settings.footer_socials[index].is_active = !form.settings.footer_socials[index].is_active;
};

const deleteLogo = (type: 'navbar' | 'footer') => {
    if (confirm(`Remove the ${type} logo?`)) {
        if (type === 'navbar') {
            form.settings.navbar_logo = '';
            form.navbar_logo_file = null;
            navbarLogoPreview.value = null;
        } else {
            form.settings.footer_logo = '';
            form.footer_logo_file = null;
            footerLogoPreview.value = null;
        }
    }
};

const submit = () => {
    form.post('/admin/layout', {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Layout Management" />

    <div class="space-y-6 max-w-6xl pb-20">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-slate">MB · 07 — LAYOUT</span>
                <h1 class="text-3xl font-bold font-display text-base-content mt-1" style="color: #0B2540;">Layout Management</h1>
                <p class="text-sm text-slate mt-1 font-body">Fully dynamic customizer for header menus, logos, footer maps, socials, typography, and styling.</p>
            </div>
            <div class="flex items-center gap-2">
                <button
                    type="button"
                    @click="previewMode = !previewMode"
                    class="btn btn-outline border-slate-300 hover:bg-slate-100 text-slate-700 rounded-lg flex items-center gap-2"
                >
                    <Eye class="size-4" />
                    <span>{{ previewMode ? 'Hide Preview' : 'Show Live Preview' }}</span>
                </button>
                <button
                    @click="submit"
                    class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg px-6 font-semibold flex items-center gap-2 transition-colors duration-150"
                    :disabled="form.processing"
                >
                    <Save class="size-4" />
                    <span>{{ form.processing ? 'Saving...' : 'Save Changes' }}</span>
                </button>
            </div>
        </div>

        <!-- Alerts -->
        <div v-if="form.errors && Object.keys(form.errors).length > 0" class="alert alert-error bg-rose-50 border-rose-200 text-rose-800 rounded-lg flex items-start gap-2 p-4">
            <AlertCircle class="size-5 text-rose-600 shrink-0 mt-0.5" />
            <div>
                <p class="font-bold text-sm">Validation failed. Please correct the errors:</p>
                <ul class="list-disc pl-5 text-xs mt-1 space-y-1">
                    <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div v-if="$page.props.flash?.success" class="alert alert-success text-white rounded-lg flex items-center gap-2 border-none bg-freight-green">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-body text-sm font-semibold">{{ $page.props.flash.success }}</span>
        </div>

        <!-- Layout Grid for Tabs + Preview -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left: Settings Form Panel -->
            <div class="lg:col-span-7 bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                <!-- Navigation Tabs -->
                <div class="flex flex-wrap border-b border-slate-200 bg-slate-50">
                    <button
                        v-for="tab in [
                            { id: 'navbar_content', label: 'Navbar Menu' },
                            { id: 'navbar_design', label: 'Navbar Design' },
                            { id: 'footer_content', label: 'Footer Content' },
                            { id: 'footer_design', label: 'Footer Design' },
                            { id: 'global_design', label: 'Typography' }
                        ]"
                        :key="tab.id"
                        type="button"
                        @click="activeTab = tab.id as any"
                        class="px-5 py-3.5 text-xs font-semibold uppercase tracking-wider font-mono border-b-2 transition-colors duration-150"
                        :class="activeTab === tab.id ? 'border-amber text-amber bg-white font-bold' : 'border-transparent text-slate-500 hover:text-slate-900 hover:bg-slate-100/50'"
                    >
                        {{ tab.label }}
                    </button>
                </div>

                <!-- Form Inputs -->
                <form @submit.prevent="submit" class="p-6 space-y-6">
                    
                    <!-- TAB 1: Navbar Content -->
                    <div v-show="activeTab === 'navbar_content'" class="space-y-6">
                        <h3 class="text-sm font-bold font-mono uppercase tracking-wider text-[#0B2540] border-b pb-2">Navbar branding & Links</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Website Name</label>
                                <input v-model="form.settings.navbar_website_name" type="text" class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 rounded-lg w-full" />
                            </div>
                            <div class="form-control">
                                <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Website Tagline</label>
                                <input v-model="form.settings.navbar_website_tagline" type="text" class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 rounded-lg w-full" />
                            </div>
                        </div>

                        <!-- Brand Logo upload -->
                        <div class="form-control border-t pt-4">
                            <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Navbar Logo</label>
                            <div class="flex items-center gap-4">
                                <div class="w-20 h-20 bg-slate-50 border rounded-lg flex items-center justify-center p-2 shrink-0 relative overflow-hidden">
                                    <img v-if="navbarLogoPreview" :src="navbarLogoPreview" class="max-w-full max-h-full object-contain" />
                                    <ImageIcon v-else class="size-6 text-slate-300" />
                                </div>
                                <div class="space-y-2 flex-grow">
                                    <div class="flex items-center gap-2">
                                        <input type="file" accept="image/*" @change="handleNavbarLogoChange" class="file-input file-input-bordered file-input-sm max-w-xs focus:ring-2 focus:ring-amber/20" />
                                        <button v-if="navbarLogoPreview" type="button" @click="deleteLogo('navbar')" class="btn btn-sm btn-error btn-outline rounded-lg">Delete</button>
                                    </div>
                                    <p class="text-[10px] text-slate-400">Supported: SVG, PNG, JPG, WebP. Recommended height: 40px.</p>
                                    <input v-model="form.settings.navbar_logo" type="text" class="input input-bordered input-sm rounded-lg w-full mt-1" placeholder="Or enter manual logo URL path (e.g. /images/logo.svg)" />
                                </div>
                            </div>
                        </div>

                        <!-- Navigation links CRUD list -->
                        <div class="form-control border-t pt-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Navigation Menu Items</label>
                                <button type="button" @click="openLinkModal('navbar')" class="btn btn-xs bg-amber border-none text-white hover:bg-amber-dark flex items-center gap-1">
                                    <Plus class="size-3" />
                                    <span>Add Menu Link</span>
                                </button>
                            </div>

                            <div class="border rounded-lg divide-y bg-slate-50 overflow-hidden text-sm">
                                <div v-if="form.settings.navbar_links.length === 0" class="p-6 text-center text-slate-400">
                                    No menu items defined. Click Add Menu Link.
                                </div>
                                <div 
                                    v-for="(link, index) in form.settings.navbar_links" 
                                    :key="index"
                                    class="flex items-center justify-between p-3.5 bg-white transition-colors duration-150"
                                    :class="!link.is_active ? 'opacity-50' : ''"
                                >
                                    <div class="flex items-center gap-3">
                                        <span class="font-mono text-xs font-semibold text-slate-400">#{{ index + 1 }}</span>
                                        <div>
                                            <div class="font-semibold text-slate-800 flex items-center gap-2">
                                                <span>{{ link.name }}</span>
                                                <span v-if="link.target_blank" class="text-[10px] font-mono bg-slate-100 text-slate-500 px-1 rounded">New Tab</span>
                                            </div>
                                            <div class="text-xs text-slate-400 flex items-center gap-1 font-mono mt-0.5">
                                                <LinkIcon class="size-3" />
                                                <span>{{ link.href }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button type="button" @click="toggleItemActive('navbar', index)" class="btn btn-xs rounded" :class="link.is_active ? 'btn-success text-white' : 'btn-ghost text-slate-400'" title="Toggle Active">
                                            <Check class="size-3" />
                                        </button>
                                        <button type="button" @click="openLinkModal('navbar', index)" class="btn btn-xs btn-ghost text-slate-600 rounded" title="Edit">
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button type="button" @click="moveLinkItem('navbar', index, 'up')" :disabled="index === 0" class="btn btn-xs btn-ghost text-slate-600 rounded disabled:opacity-30">
                                            <ArrowUp class="size-3" />
                                        </button>
                                        <button type="button" @click="moveLinkItem('navbar', index, 'down')" :disabled="index === form.settings.navbar_links.length - 1" class="btn btn-xs btn-ghost text-slate-600 rounded disabled:opacity-30">
                                            <ArrowDown class="size-3" />
                                        </button>
                                        <button type="button" @click="deleteLinkItem('navbar', index)" class="btn btn-xs btn-ghost text-rose-500 rounded" title="Delete">
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Button configuration -->
                        <div class="form-control border-t pt-4 space-y-4">
                            <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Call-To-Action (CTA) Button</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Button Text</label>
                                    <input v-model="form.settings.navbar_cta_text" type="text" class="input input-bordered input-sm rounded-lg" />
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Button URL</label>
                                    <input v-model="form.settings.navbar_cta_url" type="text" class="input input-bordered input-sm rounded-lg" />
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Enabled Status</label>
                                    <select v-model="form.settings.navbar_cta_active" class="select select-bordered select-sm rounded-lg">
                                        <option value="true">Enabled</option>
                                        <option value="false">Disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: Navbar Design -->
                    <div v-show="activeTab === 'navbar_design'" class="space-y-6">
                        <h3 class="text-sm font-bold font-mono uppercase tracking-wider text-[#0B2540] border-b pb-2">Navbar styles & Colors</h3>
                        
                        <!-- Properties -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label text-xs uppercase font-mono text-slate-500">Style Profile</label>
                                <select v-model="form.settings.navbar_style" class="select select-bordered rounded-lg">
                                    <option value="transparent">Transparent</option>
                                    <option value="solid">Solid Background</option>
                                    <option value="glassmorphism">Glassmorphism</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label text-xs uppercase font-mono text-slate-500">Sticky Header</label>
                                <select v-model="form.settings.navbar_sticky" class="select select-bordered rounded-lg">
                                    <option value="true">Sticky (Fixed Top)</option>
                                    <option value="false">Static Flow</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label text-xs uppercase font-mono text-slate-500">Blur Background</label>
                                <select v-model="form.settings.navbar_blur" class="select select-bordered rounded-lg">
                                    <option value="true">Blur Enabled</option>
                                    <option value="false">Blur Disabled</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t pt-4">
                            <div class="form-control">
                                <label class="label text-xs uppercase font-mono text-slate-500">Shadow</label>
                                <select v-model="form.settings.navbar_shadow" class="select select-bordered rounded-lg">
                                    <option value="true">Shadow Enabled</option>
                                    <option value="false">Shadow Disabled</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label text-xs uppercase font-mono text-slate-500">Bottom Border</label>
                                <select v-model="form.settings.navbar_border_bottom" class="select select-bordered rounded-lg">
                                    <option value="true">Border Enabled</option>
                                    <option value="false">Border Disabled</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label text-xs uppercase font-mono text-slate-500">Height (px)</label>
                                <input v-model="form.settings.navbar_height" type="text" class="input input-bordered rounded-lg" placeholder="e.g. 72px" />
                            </div>
                        </div>

                        <!-- Color pickers -->
                        <div class="border-t pt-4 space-y-4">
                            <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Color Palette</label>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Navbar Background</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.navbar_bg" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.navbar_bg" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Navbar Text</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.navbar_text" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.navbar_text" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Navbar Hover</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.navbar_hover" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.navbar_hover" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Active Link</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.navbar_active" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.navbar_active" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">CTA Button BG</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.navbar_cta_bg" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.navbar_cta_bg" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">CTA Button Text</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.navbar_cta_text_color" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.navbar_cta_text_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">CTA Hover BG</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.navbar_cta_hover_bg" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.navbar_cta_hover_bg" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">CTA Hover Text</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.navbar_cta_hover_text" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.navbar_cta_hover_text" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Glass Opacity (0.1 to 1)</label>
                                    <input type="number" step="0.1" min="0.1" max="1" v-model="form.settings.navbar_glass_opacity" class="input input-bordered input-sm rounded-lg w-full" />
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Glass Blur Radius (px)</label>
                                    <input type="text" v-model="form.settings.navbar_glass_blur" class="input input-bordered input-sm rounded-lg w-full font-mono" placeholder="e.g. 12px" />
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Border Color (RGBA)</label>
                                    <input type="text" v-model="form.settings.navbar_border_color" class="input input-bordered input-sm rounded-lg w-full font-mono" />
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Shadow Tint (RGBA)</label>
                                    <input type="text" v-model="form.settings.navbar_shadow_strength" class="input input-bordered input-sm rounded-lg w-full font-mono" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: Footer Content -->
                    <div v-show="activeTab === 'footer_content'" class="space-y-6">
                        <h3 class="text-sm font-bold font-mono uppercase tracking-wider text-[#0B2540] border-b pb-2">Footer Info & Links</h3>
                        
                        <div class="form-control">
                            <label class="label text-xs uppercase font-mono text-slate-500">Company Name</label>
                            <input v-model="form.settings.footer_company_name" type="text" class="input input-bordered rounded-lg w-full" />
                        </div>

                        <div class="form-control">
                            <label class="label text-xs uppercase font-mono text-slate-500">Company Description</label>
                            <textarea v-model="form.settings.footer_description" class="textarea textarea-bordered rounded-lg w-full h-20"></textarea>
                        </div>

                        <!-- Footer Logo upload -->
                        <div class="form-control border-t pt-4">
                            <label class="label text-xs uppercase font-mono text-slate-500">Footer Logo</label>
                            <div class="flex items-center gap-4">
                                <div class="w-20 h-20 bg-slate-50 border rounded-lg flex items-center justify-center p-2 shrink-0 relative overflow-hidden">
                                    <img v-if="footerLogoPreview" :src="footerLogoPreview" class="max-w-full max-h-full object-contain" />
                                    <ImageIcon v-else class="size-6 text-slate-300" />
                                </div>
                                <div class="space-y-2 flex-grow">
                                    <div class="flex items-center gap-2">
                                        <input type="file" accept="image/*" @change="handleFooterLogoChange" class="file-input file-input-bordered file-input-sm max-w-xs focus:ring-2 focus:ring-amber/20" />
                                        <button v-if="footerLogoPreview" type="button" @click="deleteLogo('footer')" class="btn btn-sm btn-error btn-outline rounded-lg">Delete</button>
                                    </div>
                                    <p class="text-[10px] text-slate-400">Supported: SVG, PNG, JPG, WebP. Recommended height: 40px.</p>
                                    <input v-model="form.settings.footer_logo" type="text" class="input input-bordered input-sm rounded-lg w-full mt-1" placeholder="Or enter manual logo URL path (e.g. /images/logo.svg)" />
                                </div>
                            </div>
                        </div>

                        <!-- Contacts -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t pt-4">
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Address</label>
                                <input v-model="form.settings.footer_address" type="text" class="input input-bordered input-sm rounded-lg w-full" />
                            </div>
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Phone</label>
                                <input v-model="form.settings.footer_phone" type="text" class="input input-bordered input-sm rounded-lg w-full" />
                            </div>
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Email</label>
                                <input v-model="form.settings.footer_email" type="email" class="input input-bordered input-sm rounded-lg w-full" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t pt-4">
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Copyright Text</label>
                                <input v-model="form.settings.footer_copyright" type="text" class="input input-bordered input-sm rounded-lg w-full" />
                            </div>
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Bottom Tagline</label>
                                <input v-model="form.settings.footer_tagline" type="text" class="input input-bordered input-sm rounded-lg w-full" placeholder="e.g. Precise • Calm • Dependable" />
                            </div>
                        </div>

                        <!-- Newsletter settings -->
                        <div class="border-t pt-4 space-y-4">
                            <label class="label text-xs uppercase font-semibold font-mono text-slate-500">Newsletter Settings</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Newsletter Title</label>
                                    <input v-model="form.settings.footer_newsletter_title" type="text" class="input input-bordered input-sm rounded-lg" />
                                </div>
                                <div class="form-control md:col-span-2">
                                    <label class="label text-[11px] font-mono text-slate-400">Description</label>
                                    <input v-model="form.settings.footer_newsletter_desc" type="text" class="input input-bordered input-sm rounded-lg" />
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Active State</label>
                                    <select v-model="form.settings.footer_newsletter_active" class="select select-bordered select-sm rounded-lg">
                                        <option value="true">Enabled</option>
                                        <option value="false">Disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Lists: Quick Links CRUD -->
                        <div class="border-t pt-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Quick Links List</label>
                                <button type="button" @click="openLinkModal('quick_links')" class="btn btn-xs bg-amber border-none text-white hover:bg-amber-dark flex items-center gap-1">
                                    <Plus class="size-3" />
                                    <span>Add Quick Link</span>
                                </button>
                            </div>
                            
                            <div class="border rounded-lg divide-y bg-slate-50 overflow-hidden text-sm">
                                <div v-if="form.settings.footer_quick_links.length === 0" class="p-4 text-center text-slate-400">
                                    No Quick Links defined.
                                </div>
                                <div v-for="(link, idx) in form.settings.footer_quick_links" :key="idx" class="flex items-center justify-between p-3 bg-white" :class="!link.is_active ? 'opacity-50' : ''">
                                    <div>
                                        <span class="font-semibold text-slate-800">{{ link.name }}</span>
                                        <span class="text-xs font-mono text-slate-400 block">{{ link.href }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button type="button" @click="toggleItemActive('quick_links', idx)" class="btn btn-xs rounded" :class="link.is_active ? 'btn-success text-white' : 'btn-ghost text-slate-400'">
                                            <Check class="size-3" />
                                        </button>
                                        <button type="button" @click="openLinkModal('quick_links', idx)" class="btn btn-xs btn-ghost text-slate-600 rounded">
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button type="button" @click="moveLinkItem('quick_links', idx, 'up')" :disabled="idx === 0" class="btn btn-xs btn-ghost text-slate-600 rounded disabled:opacity-30">
                                            <ArrowUp class="size-3" />
                                        </button>
                                        <button type="button" @click="moveLinkItem('quick_links', idx, 'down')" :disabled="idx === form.settings.footer_quick_links.length - 1" class="btn btn-xs btn-ghost text-slate-600 rounded disabled:opacity-30">
                                            <ArrowDown class="size-3" />
                                        </button>
                                        <button type="button" @click="deleteLinkItem('quick_links', idx)" class="btn btn-xs btn-ghost text-rose-500 rounded">
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lists: Services List CRUD -->
                        <div class="border-t pt-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Services List</label>
                                <button type="button" @click="openLinkModal('services')" class="btn btn-xs bg-amber border-none text-white hover:bg-amber-dark flex items-center gap-1">
                                    <Plus class="size-3" />
                                    <span>Add Service Link</span>
                                </button>
                            </div>
                            
                            <div class="border rounded-lg divide-y bg-slate-50 overflow-hidden text-sm">
                                <div v-if="form.settings.footer_services.length === 0" class="p-4 text-center text-slate-400">
                                    No Services Links defined.
                                </div>
                                <div v-for="(link, idx) in form.settings.footer_services" :key="idx" class="flex items-center justify-between p-3 bg-white" :class="!link.is_active ? 'opacity-50' : ''">
                                    <div>
                                        <span class="font-semibold text-slate-800">{{ link.name }}</span>
                                        <span class="text-xs font-mono text-slate-400 block">{{ link.href }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button type="button" @click="toggleItemActive('services', idx)" class="btn btn-xs rounded" :class="link.is_active ? 'btn-success text-white' : 'btn-ghost text-slate-400'">
                                            <Check class="size-3" />
                                        </button>
                                        <button type="button" @click="openLinkModal('services', idx)" class="btn btn-xs btn-ghost text-slate-600 rounded">
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button type="button" @click="moveLinkItem('services', idx, 'up')" :disabled="idx === 0" class="btn btn-xs btn-ghost text-slate-600 rounded disabled:opacity-30">
                                            <ArrowUp class="size-3" />
                                        </button>
                                        <button type="button" @click="moveLinkItem('services', idx, 'down')" :disabled="idx === form.settings.footer_services.length - 1" class="btn btn-xs btn-ghost text-slate-600 rounded disabled:opacity-30">
                                            <ArrowDown class="size-3" />
                                        </button>
                                        <button type="button" @click="deleteLinkItem('services', idx)" class="btn btn-xs btn-ghost text-rose-500 rounded">
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lists: Socials Media CRUD -->
                        <div class="border-t pt-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Social Media Links</label>
                                <button type="button" @click="openLinkModal('socials')" class="btn btn-xs bg-amber border-none text-white hover:bg-amber-dark flex items-center gap-1">
                                    <Plus class="size-3" />
                                    <span>Add Social Link</span>
                                </button>
                            </div>
                            
                            <div class="border rounded-lg divide-y bg-slate-50 overflow-hidden text-sm">
                                <div v-if="form.settings.footer_socials.length === 0" class="p-4 text-center text-slate-400">
                                    No Social Media channels configured.
                                </div>
                                <div v-for="(link, idx) in form.settings.footer_socials" :key="idx" class="flex items-center justify-between p-3 bg-white" :class="!link.is_active ? 'opacity-50' : ''">
                                    <div>
                                        <span class="font-semibold text-slate-800 capitalize">{{ link.platform }}</span>
                                        <span class="text-xs font-mono text-slate-400 block">{{ link.url }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button type="button" @click="toggleItemActive('socials', idx)" class="btn btn-xs rounded" :class="link.is_active ? 'btn-success text-white' : 'btn-ghost text-slate-400'">
                                            <Check class="size-3" />
                                        </button>
                                        <button type="button" @click="openLinkModal('socials', idx)" class="btn btn-xs btn-ghost text-slate-600 rounded">
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button type="button" @click="deleteLinkItem('socials', idx)" class="btn btn-xs btn-ghost text-rose-500 rounded">
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: Footer Design -->
                    <div v-show="activeTab === 'footer_design'" class="space-y-6">
                        <h3 class="text-sm font-bold font-mono uppercase tracking-wider text-[#0B2540] border-b pb-2">Footer styles & Colors</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label text-xs uppercase font-mono text-slate-500">Top Padding</label>
                                <input v-model="form.settings.footer_top_padding" type="text" class="input input-bordered rounded-lg" placeholder="e.g. 80px" />
                            </div>
                            <div class="form-control">
                                <label class="label text-xs uppercase font-mono text-slate-500">Bottom Padding</label>
                                <input v-model="form.settings.footer_bottom_padding" type="text" class="input input-bordered rounded-lg" placeholder="e.g. 40px" />
                            </div>
                            <div class="form-control">
                                <label class="label text-xs uppercase font-mono text-slate-500">Font Weight</label>
                                <input v-model="form.settings.footer_font_weight" type="text" class="input input-bordered rounded-lg" placeholder="e.g. 400" />
                            </div>
                        </div>

                        <!-- Footer colors -->
                        <div class="border-t pt-4 space-y-4">
                            <label class="label text-xs uppercase tracking-wider font-semibold font-mono text-slate-500">Color Palette</label>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Footer Background</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_bg" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_bg" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Footer Text</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_text" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_text" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Heading Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_heading_color" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_heading_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Link Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_link_color" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_link_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Link Hover Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_link_hover_color" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_link_hover_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Icon Background</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_icon_bg" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_icon_bg" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Icon Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_icon_color" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_icon_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Border Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_border_color" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_border_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Newsletter BG</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_bg" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_bg" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Newsletter Button</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_btn_bg" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_btn_bg" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Newsletter Button Text</label>
                                    <input type="text" v-model="form.settings.footer_newsletter_btn_text" class="input input-bordered input-sm rounded-lg w-full" />
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Copyright Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_copyright_color" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_copyright_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label text-[11px] font-mono text-slate-400">Bottom Section BG</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_bottom_bg" class="w-10 h-8 rounded border" />
                                        <input type="text" v-model="form.settings.footer_bottom_bg" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                    </div>
                                </div>
                                <div class="form-control md:col-span-2">
                                    <label class="label text-[11px] font-mono text-slate-400">Shadow Strength (RGBA)</label>
                                    <input type="text" v-model="form.settings.footer_shadow_strength" class="input input-bordered input-sm rounded-lg w-full font-mono" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 5: Global Typography -->
                    <div v-show="activeTab === 'global_design'" class="space-y-6">
                        <h3 class="text-sm font-bold font-mono uppercase tracking-wider text-[#0B2540] border-b pb-2">Global Typography & Container Spacing</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Heading Color</label>
                                <div class="flex items-center gap-2">
                                    <input type="color" v-model="form.settings.heading_color" class="w-10 h-8 rounded border" />
                                    <input type="text" v-model="form.settings.heading_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                </div>
                            </div>
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Paragraph Text Color</label>
                                <div class="flex items-center gap-2">
                                    <input type="color" v-model="form.settings.paragraph_color" class="w-10 h-8 rounded border" />
                                    <input type="text" v-model="form.settings.paragraph_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                </div>
                            </div>
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Small/Label Text Color</label>
                                <div class="flex items-center gap-2">
                                    <input type="color" v-model="form.settings.small_text_color" class="w-10 h-8 rounded border" />
                                    <input type="text" v-model="form.settings.small_text_color" class="input input-bordered input-sm rounded-lg flex-grow font-mono" />
                                </div>
                            </div>
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Max Container Width</label>
                                <input v-model="form.settings.container_width" type="text" class="input input-bordered rounded-lg" placeholder="e.g. 1280px" />
                            </div>
                            <div class="form-control">
                                <label class="label text-xs font-mono text-slate-500">Navigation Font Weight</label>
                                <input v-model="form.settings.navbar_font_weight" type="text" class="input input-bordered rounded-lg" placeholder="e.g. 500" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right: Live Preview Panel -->
            <div v-if="previewMode" class="lg:col-span-5 space-y-6 sticky top-6">
                <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm space-y-5">
                    <div class="flex items-center justify-between border-b pb-3">
                        <h2 class="text-sm font-bold font-mono uppercase tracking-wider text-[#0B2540] flex items-center gap-1.5">
                            <Eye class="size-4 text-amber" />
                            <span>Interactive Live Preview</span>
                        </h2>
                        <span class="text-[10px] font-mono text-slate-400 bg-slate-100 px-2 py-0.5 rounded">Unsaved Changes</span>
                    </div>

                    <!-- Navbar Preview Box -->
                    <div class="border rounded-lg overflow-hidden bg-slate-800/10 p-2 space-y-1.5 relative">
                        <div class="text-[10px] font-bold font-mono text-slate-400 uppercase tracking-wide">Header / Navbar</div>
                        
                        <!-- Mini Navbar Mockup -->
                        <div 
                            class="border rounded shadow-sm py-2 px-3 flex items-center justify-between transition-all duration-300"
                            :style="{
                                backgroundColor: form.settings.navbar_bg,
                                color: form.settings.navbar_text,
                                borderColor: form.settings.navbar_border_bottom === 'true' ? form.settings.navbar_border_color : 'transparent',
                                minHeight: '44px'
                            }"
                        >
                            <!-- Logo -->
                            <div class="flex items-center gap-2">
                                <img v-if="navbarLogoPreview" :src="navbarLogoPreview" class="h-6 w-auto" />
                                <div v-else class="flex flex-col leading-none">
                                    <span class="font-bold text-xs uppercase tracking-wider" :style="{ color: form.settings.navbar_text }">{{ form.settings.navbar_website_name || 'MERCURY' }}</span>
                                    <span class="text-[8px] font-mono mt-0.5" style="color: #E8770C;">{{ form.settings.navbar_website_tagline || 'BANGLADESH' }}</span>
                                </div>
                            </div>
                            
                            <!-- Links -->
                            <nav class="flex items-center gap-3 text-[10px] font-semibold" :style="{ fontWeight: form.settings.navbar_font_weight }">
                                <span 
                                    v-for="(link, i) in form.settings.navbar_links.filter((l: any) => l.is_active)" 
                                    :key="i"
                                    :style="{ color: i === 0 ? form.settings.navbar_active : form.settings.navbar_text }"
                                    class="cursor-pointer hover:opacity-85"
                                >
                                    {{ link.name }}
                                </span>
                            </nav>

                            <!-- CTA Button -->
                            <div v-if="form.settings.navbar_cta_active === 'true'" class="text-[9px] font-bold py-1 px-2.5 rounded transition-colors" :style="{ backgroundColor: form.settings.navbar_cta_bg, color: form.settings.navbar_cta_text_color }">
                                {{ form.settings.navbar_cta_text || 'Get a Quote' }}
                            </div>
                        </div>
                    </div>

                    <!-- Footer Preview Box -->
                    <div class="border rounded-lg overflow-hidden bg-slate-800/10 p-2 space-y-1.5">
                        <div class="text-[10px] font-bold font-mono text-slate-400 uppercase tracking-wide">Footer Mockup</div>
                        
                        <!-- Mini Footer Mockup -->
                        <div 
                            class="border rounded p-4 text-[10px] space-y-4"
                            :style="{
                                backgroundColor: form.settings.footer_bg,
                                color: form.settings.footer_text,
                                borderColor: form.settings.footer_border_color
                            }"
                        >
                            <!-- Top Area -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <img v-if="footerLogoPreview" :src="footerLogoPreview" class="h-6 w-auto" />
                                    <h4 v-else class="font-bold text-xs uppercase" :style="{ color: form.settings.footer_heading_color }">
                                        {{ form.settings.footer_company_name || 'Mercury Bangladesh' }}
                                    </h4>
                                    <p class="text-[9px] opacity-80 leading-normal">{{ form.settings.footer_description }}</p>
                                </div>
                                <div class="space-y-1.5">
                                    <h4 class="font-bold text-[9px] uppercase tracking-wider" :style="{ color: form.settings.footer_heading_color }">Newsletter</h4>
                                    <div class="flex items-center gap-1">
                                        <input type="text" placeholder="Your Email" class="w-full text-[8px] p-1.5 border rounded" disabled />
                                        <button class="p-1.5 rounded text-[8px] font-bold text-white shrink-0" :style="{ backgroundColor: form.settings.footer_newsletter_btn_bg }">Go</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Middle lists -->
                            <div class="grid grid-cols-2 gap-4 border-t pt-2" :style="{ borderColor: form.settings.footer_border_color }">
                                <div>
                                    <h5 class="font-bold text-[8px] uppercase mb-1.5" :style="{ color: form.settings.footer_heading_color }">Quick Links</h5>
                                    <div class="space-y-1 text-[8px]">
                                        <div v-for="(l, i) in form.settings.footer_quick_links.filter((x: any) => x.is_active).slice(0, 3)" :key="i" class="opacity-80">
                                            • {{ l.name }}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-bold text-[8px] uppercase mb-1.5" :style="{ color: form.settings.footer_heading_color }">Services</h5>
                                    <div class="space-y-1 text-[8px]">
                                        <div v-for="(l, i) in form.settings.footer_services.filter((x: any) => x.is_active).slice(0, 3)" :key="i" class="opacity-80">
                                            • {{ l.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Address/Contact info -->
                            <div class="border-t border-b py-2 text-[9px]" :style="{ borderColor: form.settings.footer_border_color }">
                                <div><strong>Address:</strong> {{ form.settings.footer_address }}</div>
                                <div class="mt-0.5"><strong>Phone:</strong> {{ form.settings.footer_phone }} | <strong>Email:</strong> {{ form.settings.footer_email }}</div>
                            </div>

                            <!-- Copyright Bar -->
                            <div class="flex items-center justify-between text-[8px] opacity-80">
                                <span>{{ form.settings.footer_copyright }}</span>
                                <span :style="{ color: form.settings.footer_link_hover_color }">{{ form.settings.footer_tagline }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit modal for menu links -->
    <div v-if="linkModalType !== null" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full overflow-hidden border border-slate-200 animate-in fade-in zoom-in-95 duration-150">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <h3 class="font-bold font-display text-slate-800 text-sm uppercase tracking-wide">
                    {{ currentLinkIndex !== null ? 'Edit Link Record' : 'Add Link Record' }}
                </h3>
                <button type="button" @click="linkModalType = null" class="p-1 rounded-md text-slate-400 hover:bg-slate-100">
                    <X class="size-4" />
                </button>
            </div>
            
            <div class="p-5 space-y-4 text-sm">
                <!-- If Social Link -->
                <div v-if="linkModalType === 'socials'" class="space-y-4">
                    <div class="form-control">
                        <label class="label font-semibold text-slate-700 text-xs">Social Platform</label>
                        <select v-model="linkForm.platform" class="select select-bordered select-sm rounded-lg w-full">
                            <option value="facebook">Facebook</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="instagram">Instagram</option>
                            <option value="youtube">YouTube</option>
                            <option value="twitter">Twitter</option>
                            <option value="whatsapp">WhatsApp</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label font-semibold text-slate-700 text-xs">Profile URL</label>
                        <input v-model="linkForm.url" type="url" class="input input-bordered input-sm rounded-lg w-full" placeholder="e.g. https://facebook.com/mycompany" />
                    </div>
                </div>

                <!-- If Standard Link (Navbar, Quick Links, Services) -->
                <div v-else class="space-y-4">
                    <div class="form-control">
                        <label class="label font-semibold text-slate-700 text-xs">Link Label</label>
                        <input v-model="linkForm.name" type="text" class="input input-bordered input-sm rounded-lg w-full" placeholder="e.g. Services" />
                    </div>
                    <div class="form-control">
                        <label class="label font-semibold text-slate-700 text-xs">URL Path</label>
                        <input v-model="linkForm.href" type="text" class="input input-bordered input-sm rounded-lg w-full" placeholder="e.g. /services" />
                    </div>
                    <div v-if="linkModalType === 'navbar'" class="form-control flex flex-row items-center gap-2 pt-2">
                        <input type="checkbox" v-model="linkForm.target_blank" id="target_blank" class="checkbox checkbox-sm checkbox-primary rounded" />
                        <label for="target_blank" class="text-xs text-slate-600 cursor-pointer">Open in new tab</label>
                    </div>
                </div>

                <div class="form-control flex flex-row items-center gap-2">
                    <input type="checkbox" v-model="linkForm.is_active" id="is_active" class="checkbox checkbox-sm checkbox-primary rounded" />
                    <label for="is_active" class="text-xs text-slate-600 cursor-pointer">Enabled / Active</label>
                </div>
            </div>

            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50 flex justify-end gap-2">
                <button type="button" @click="linkModalType = null" class="btn btn-sm btn-ghost rounded-lg">Cancel</button>
                <button type="button" @click="saveLinkItem" class="btn btn-sm bg-amber hover:bg-amber-dark text-white border-none rounded-lg px-4">Save</button>
            </div>
        </div>
    </div>
</template>
