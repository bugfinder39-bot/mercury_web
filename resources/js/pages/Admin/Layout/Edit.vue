<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
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
    AlertCircle,
} from '@lucide/vue';
import { ref, computed } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

const props = defineProps<{
    settings: Record<string, any>;
}>();

defineOptions({
    layout: AdminLayout,
});

const activeTab = ref<
    | 'navbar_content'
    | 'navbar_design'
    | 'footer_content'
    | 'footer_design'
    | 'global_design'
    | 'coming_soon'
>('navbar_content');
const previewMode = ref<boolean>(true);

// Initialize form
const form = useForm({
    _method: 'POST',
    settings: {
        show_navbar: String(props.settings.show_navbar ?? props.settings.coming_soon_show_navbar ?? 'false'),
        show_footer: String(props.settings.show_footer ?? props.settings.coming_soon_show_footer ?? 'false'),
        coming_soon_show_navbar: String(props.settings.coming_soon_show_navbar ?? props.settings.show_navbar ?? 'false'),
        coming_soon_show_footer: String(props.settings.coming_soon_show_footer ?? props.settings.show_footer ?? 'false'),
        navbar_website_name: props.settings.navbar_website_name || '',
        navbar_website_tagline: props.settings.navbar_website_tagline || '',
        navbar_logo: props.settings.navbar_logo || '',
        navbar_links: Array.isArray(props.settings.navbar_links)
            ? props.settings.navbar_links
            : [],
        navbar_cta_text: props.settings.navbar_cta_text || '',
        navbar_cta_url: props.settings.navbar_cta_url || '',
        navbar_cta_active: String(props.settings.navbar_cta_active || 'true'),
        navbar_login_button: String(props.settings.navbar_login_button ?? props.settings.show_login_button ?? 'true'),
        show_login_button: String(props.settings.show_login_button ?? props.settings.navbar_login_button ?? 'true'),
        navbar_style: props.settings.navbar_style || 'glassmorphism',
        navbar_sticky: String(props.settings.navbar_sticky || 'true'),
        navbar_blur: String(props.settings.navbar_blur || 'true'),
        navbar_shadow: String(props.settings.navbar_shadow || 'true'),
        navbar_border_bottom: String(
            props.settings.navbar_border_bottom || 'true',
        ),
        navbar_bg: props.settings.navbar_bg || '#FFFFFF',
        navbar_text: props.settings.navbar_text || '#0B2540',
        navbar_hover: props.settings.navbar_hover || '#E8770C',
        navbar_active: props.settings.navbar_active || '#E8770C',
        navbar_cta_bg: props.settings.navbar_cta_bg || '#E8770C',
        navbar_cta_text_color:
            props.settings.navbar_cta_text_color || '#FFFFFF',
        navbar_cta_hover_bg: props.settings.navbar_cta_hover_bg || '#CC6608',
        navbar_cta_hover_text:
            props.settings.navbar_cta_hover_text || '#FFFFFF',
        navbar_glass_opacity: Number(
            props.settings.navbar_glass_opacity ?? 0.9,
        ),
        navbar_glass_blur: props.settings.navbar_glass_blur || '12px',
        navbar_border_color:
            props.settings.navbar_border_color || 'rgba(226, 232, 240, 0.5)',
        navbar_shadow_strength:
            props.settings.navbar_shadow_strength || 'rgba(11, 37, 64, 0.05)',
        navbar_height: props.settings.navbar_height || '72px',
        navbar_font_weight: props.settings.navbar_font_weight || '500',

        // Footer
        footer_logo: props.settings.footer_logo || '',
        footer_company_name: props.settings.footer_company_name || '',
        footer_description: props.settings.footer_description || '',
        footer_quick_links: Array.isArray(props.settings.footer_quick_links)
            ? props.settings.footer_quick_links
            : [],
        footer_services: Array.isArray(props.settings.footer_services)
            ? props.settings.footer_services
            : [],
        footer_newsletter_title: props.settings.footer_newsletter_title || '',
        footer_newsletter_desc: props.settings.footer_newsletter_desc || '',
        footer_newsletter_active: String(
            props.settings.footer_newsletter_active || 'true',
        ),
        footer_socials: Array.isArray(props.settings.footer_socials)
            ? props.settings.footer_socials
            : [],
        footer_phones: Array.isArray(props.settings.footer_phones)
            ? props.settings.footer_phones
            : [],
        footer_emails: Array.isArray(props.settings.footer_emails)
            ? props.settings.footer_emails
            : [],
        footer_addresses: Array.isArray(props.settings.footer_addresses)
            ? props.settings.footer_addresses
            : [],
        footer_address: props.settings.footer_address || '',
        footer_phone: props.settings.footer_phone || '',
        footer_email: props.settings.footer_email || '',
        footer_copyright: props.settings.footer_copyright || '',
        footer_tagline: props.settings.footer_tagline || '',
        footer_bg: props.settings.footer_bg || '#FFFFFF',
        footer_text: props.settings.footer_text || '#475569',
        footer_heading_color: props.settings.footer_heading_color || '#0B2540',
        footer_link_color: props.settings.footer_link_color || '#475569',
        footer_link_hover_color:
            props.settings.footer_link_hover_color || '#E8770C',
        footer_icon_bg: props.settings.footer_icon_bg || '#F8FAFC',
        footer_icon_color: props.settings.footer_icon_color || '#123A5E',
        footer_border_color: props.settings.footer_border_color || '#F1F5F9',
        footer_newsletter_bg: props.settings.footer_newsletter_bg || '#F8FAFC',
        footer_newsletter_btn_bg:
            props.settings.footer_newsletter_btn_bg || '#E8770C',
        footer_newsletter_btn_text:
            props.settings.footer_newsletter_btn_text || 'Subscribe',
        footer_copyright_color:
            props.settings.footer_copyright_color || '#94A3B8',
        footer_bottom_bg: props.settings.footer_bottom_bg || '#FFFFFF',
        footer_shadow_strength:
            props.settings.footer_shadow_strength || 'rgba(11, 37, 64, 0.05)',
        footer_top_padding: props.settings.footer_top_padding || '80px',
        footer_bottom_padding: props.settings.footer_bottom_padding || '40px',
        footer_font_weight: props.settings.footer_font_weight || '400',
        footer_bg_style: props.settings.footer_bg_style || 'solid-white',
        footer_paragraph_color: props.settings.footer_paragraph_color || '#475569',
        footer_secondary_text_color: props.settings.footer_secondary_text_color || '#94A3B8',
        footer_quick_links_color: props.settings.footer_quick_links_color || '#475569',
        footer_quick_links_hover_color: props.settings.footer_quick_links_hover_color || '#E8770C',
        footer_services_links_color: props.settings.footer_services_links_color || '#475569',
        footer_services_hover_color: props.settings.footer_services_hover_color || '#E8770C',
        footer_newsletter_heading_color: props.settings.footer_newsletter_heading_color || '#0B2540',
        footer_newsletter_description_color: props.settings.footer_newsletter_description_color || '#475569',
        footer_bottom_tagline_color: props.settings.footer_bottom_tagline_color || '#E8770C',
        footer_icon_style: props.settings.footer_icon_style || 'circle',
        footer_icon_hover_bg: props.settings.footer_icon_hover_bg || '#E8770C',
        footer_icon_hover_color: props.settings.footer_icon_hover_color || '#FFFFFF',
        footer_icon_border_color: props.settings.footer_icon_border_color || '#E8770C',
        footer_icon_shadow: props.settings.footer_icon_shadow || 'light',
        footer_newsletter_input_bg: props.settings.footer_newsletter_input_bg || '#F8FAFC',
        footer_newsletter_input_border: props.settings.footer_newsletter_input_border || '#F1F5F9',
        footer_newsletter_input_text_color: props.settings.footer_newsletter_input_text_color || '#475569',
        footer_newsletter_placeholder_color: props.settings.footer_newsletter_placeholder_color || '#94A3B8',
        footer_newsletter_btn_hover_bg: props.settings.footer_newsletter_btn_hover_bg || '#CC6608',
        footer_newsletter_btn_hover_text_color: props.settings.footer_newsletter_btn_hover_text_color || '#FFFFFF',
        footer_newsletter_btn_shadow: props.settings.footer_newsletter_btn_shadow || 'light',
        footer_divider_style: props.settings.footer_divider_style || 'thin-accent',
        footer_social_icon_bg: props.settings.footer_social_icon_bg || '#F8FAFC',
        footer_social_icon_color: props.settings.footer_social_icon_color || '#123A5E',
        footer_social_hover_bg: props.settings.footer_social_hover_bg || '#E8770C',
        footer_social_hover_color: props.settings.footer_social_hover_color || '#FFFFFF',
        footer_social_border_color: props.settings.footer_social_border_color || 'transparent',
        footer_social_shadow: props.settings.footer_social_shadow || 'light',
        footer_column_gap: props.settings.footer_column_gap || '3rem',
        footer_section_gap: props.settings.footer_section_gap || '4rem',
        footer_link_hover_effect: props.settings.footer_link_hover_effect || 'underline',
        footer_animation_style: props.settings.footer_animation_style || 'none',

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
const navbarLogoPreview = ref<string | null>(
    props.settings.navbar_logo || null,
);
const footerLogoPreview = ref<string | null>(
    props.settings.footer_logo || null,
);

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
const linkModalType = ref<
    'navbar' | 'quick_links' | 'services' | 'socials' | null
>(null);
const currentLinkIndex = ref<number | null>(null);
const linkForm = ref({
    name: '',
    href: '',
    target_blank: false,
    is_active: true,
    platform: '',
    url: '',
});

const openLinkModal = (
    type: 'navbar' | 'quick_links' | 'services' | 'socials',
    index: number | null = null,
) => {
    linkModalType.value = type;
    currentLinkIndex.value = index;

    if (index !== null) {
        let item;

        if (type === 'navbar') {
item = form.settings.navbar_links[index];
} else if (type === 'quick_links') {
item = form.settings.footer_quick_links[index];
} else if (type === 'services') {
item = form.settings.footer_services[index];
} else {
item = form.settings.footer_socials[index];
}

        linkForm.value = {
            name: item.name || '',
            href: item.href || '',
            target_blank: !!item.target_blank,
            is_active: item.is_active !== false,
            platform: item.platform || '',
            url: item.url || '',
        };
    } else {
        linkForm.value = {
            name: '',
            href: '',
            target_blank: false,
            is_active: true,
            platform: type === 'socials' ? 'facebook' : '',
            url: '',
        };
    }
};

const saveLinkItem = () => {
    const type = linkModalType.value;

    if (!type) {
return;
}

    let targetArray: any[] = [];

    if (type === 'navbar') {
targetArray = form.settings.navbar_links;
} else if (type === 'quick_links') {
targetArray = form.settings.footer_quick_links;
} else if (type === 'services') {
targetArray = form.settings.footer_services;
} else {
targetArray = form.settings.footer_socials;
}

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

const deleteLinkItem = (
    type: 'navbar' | 'quick_links' | 'services' | 'socials',
    index: number,
) => {
    if (!confirm('Are you sure you want to delete this menu item?')) {
return;
}

    if (type === 'navbar') {
form.settings.navbar_links.splice(index, 1);
} else if (type === 'quick_links') {
form.settings.footer_quick_links.splice(index, 1);
} else if (type === 'services') {
form.settings.footer_services.splice(index, 1);
} else {
form.settings.footer_socials.splice(index, 1);
}
};

const moveLinkItem = (
    type: 'navbar' | 'quick_links' | 'services' | 'socials',
    index: number,
    direction: 'up' | 'down',
) => {
    let arr: any[] = [];

    if (type === 'navbar') {
arr = form.settings.navbar_links;
} else if (type === 'quick_links') {
arr = form.settings.footer_quick_links;
} else if (type === 'services') {
arr = form.settings.footer_services;
} else {
arr = form.settings.footer_socials;
}

    const targetIndex = direction === 'up' ? index - 1 : index + 1;

    if (targetIndex < 0 || targetIndex >= arr.length) {
return;
}

    const temp = arr[index];
    arr[index] = arr[targetIndex];
    arr[targetIndex] = temp;
};

const toggleItemActive = (
    type: 'navbar' | 'quick_links' | 'services' | 'socials',
    index: number,
) => {
    if (type === 'navbar') {
form.settings.navbar_links[index].is_active =
            !form.settings.navbar_links[index].is_active;
} else if (type === 'quick_links') {
form.settings.footer_quick_links[index].is_active =
            !form.settings.footer_quick_links[index].is_active;
} else if (type === 'services') {
form.settings.footer_services[index].is_active =
            !form.settings.footer_services[index].is_active;
} else {
form.settings.footer_socials[index].is_active =
            !form.settings.footer_socials[index].is_active;
}
};

// Contact repeatable items helper state & functions
const contactModalType = ref<'phone' | 'email' | 'address' | null>(null);
const currentContactIndex = ref<number | null>(null);
const contactForm = ref({
    phone: '',
    email: '',
    name: '',
    address: '',
    label: '',
    map_url: '',
    is_active: true,
});

const openContactModal = (
    type: 'phone' | 'email' | 'address',
    index: number | null = null,
) => {
    contactModalType.value = type;
    currentContactIndex.value = index;

    if (index !== null) {
        let item: any;
        if (type === 'phone') {
            item = form.settings.footer_phones[index];
        } else if (type === 'email') {
            item = form.settings.footer_emails[index];
        } else {
            item = form.settings.footer_addresses[index];
        }

        contactForm.value = {
            phone: item.phone || '',
            email: item.email || '',
            name: item.name || '',
            address: item.address || '',
            label: item.label || '',
            map_url: item.map_url || '',
            is_active: item.is_active !== false,
        };
    } else {
        contactForm.value = {
            phone: '',
            email: '',
            name: '',
            address: '',
            label: '',
            map_url: '',
            is_active: true,
        };
    }
};

const saveContactItem = () => {
    const type = contactModalType.value;
    if (!type) return;

    let targetArray: any[] = [];
    if (type === 'phone') targetArray = form.settings.footer_phones;
    else if (type === 'email') targetArray = form.settings.footer_emails;
    else if (type === 'address') targetArray = form.settings.footer_addresses;

    const record: any = { is_active: contactForm.value.is_active };

    if (type === 'phone') {
        if (!contactForm.value.phone) { alert('Phone number is required'); return; }
        record.phone = contactForm.value.phone;
        record.label = contactForm.value.label;
    } else if (type === 'email') {
        if (!contactForm.value.email) { alert('Email address is required'); return; }
        record.email = contactForm.value.email;
        record.label = contactForm.value.label;
    } else if (type === 'address') {
        if (!contactForm.value.address) { alert('Address is required'); return; }
        record.address = contactForm.value.address;
        record.name = contactForm.value.name;
        record.map_url = contactForm.value.map_url;
    }

    if (currentContactIndex.value !== null) {
        targetArray[currentContactIndex.value] = record;
    } else {
        targetArray.push(record);
    }

    contactModalType.value = null;
    currentContactIndex.value = null;
};

const deleteContactItem = (type: 'phone' | 'email' | 'address', index: number) => {
    if (!confirm('Are you sure you want to delete this contact item?')) return;
    if (type === 'phone') form.settings.footer_phones.splice(index, 1);
    else if (type === 'email') form.settings.footer_emails.splice(index, 1);
    else if (type === 'address') form.settings.footer_addresses.splice(index, 1);
};

const moveContactItem = (type: 'phone' | 'email' | 'address', index: number, direction: 'up' | 'down') => {
    let arr: any[] = [];
    if (type === 'phone') arr = form.settings.footer_phones;
    else if (type === 'email') arr = form.settings.footer_emails;
    else if (type === 'address') arr = form.settings.footer_addresses;

    const targetIndex = direction === 'up' ? index - 1 : index + 1;
    if (targetIndex < 0 || targetIndex >= arr.length) return;

    const temp = arr[index];
    arr[index] = arr[targetIndex];
    arr[targetIndex] = temp;
};

const toggleContactActive = (type: 'phone' | 'email' | 'address', index: number) => {
    if (type === 'phone') form.settings.footer_phones[index].is_active = !form.settings.footer_phones[index].is_active;
    else if (type === 'email') form.settings.footer_emails[index].is_active = !form.settings.footer_emails[index].is_active;
    else if (type === 'address') form.settings.footer_addresses[index].is_active = !form.settings.footer_addresses[index].is_active;
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

const previewFooterStyles = computed(() => {
    const bg = form.settings.footer_bg;
    const bgStyle = form.settings.footer_bg_style;
    let bgGradient = bg;
    
    if (bgStyle === 'solid-white') {
        bgGradient = '#FFFFFF';
    } else if (bgStyle === 'solid-navy') {
        bgGradient = '#0B2540';
    } else if (bgStyle === 'white-navy-accents') {
        bgGradient = 'radial-gradient(circle at top right, rgba(11,37,64,0.03) 0%, #FFFFFF 100%)';
    } else if (bgStyle === 'white-orange-lines') {
        bgGradient = '#FFFFFF';
    } else if (bgStyle === 'navy-gradient') {
        bgGradient = `linear-gradient(180deg, ${bg || '#0B2540'} 0%, #091C30 100%)`;
    } else if (bgStyle === 'white-gradient') {
        bgGradient = `linear-gradient(180deg, #FFFFFF 0%, rgba(11,37,64,0.05) 100%)`;
    }
    
    return {
        background: bgGradient,
        color: form.settings.footer_paragraph_color,
        borderTop: bgStyle === 'white-orange-lines' ? '3px solid #E8770C' : undefined,
        borderColor: form.settings.footer_border_color,
        paddingTop: '20px',
        paddingBottom: '20px',
        fontWeight: form.settings.footer_font_weight,
        '--footer-text-color': form.settings.footer_paragraph_color,
        '--footer-secondary-color': form.settings.footer_secondary_text_color,
        '--footer-heading-color': form.settings.footer_heading_color,
        '--footer-link-color': form.settings.footer_quick_links_color,
        '--footer-link-hover-color': form.settings.footer_quick_links_hover_color,
        '--footer-icon-bg': form.settings.footer_icon_style === 'orange-gradient' ? 'linear-gradient(135deg, #E8770C, #CC6608)' : form.settings.footer_icon_bg,
        '--footer-icon-color': form.settings.footer_icon_style === 'orange-gradient' ? '#FFFFFF' : form.settings.footer_icon_color,
        '--footer-newsletter-bg': form.settings.footer_newsletter_input_bg,
        '--footer-newsletter-btn-bg': form.settings.footer_newsletter_btn_bg,
        '--footer-newsletter-btn-text': form.settings.footer_newsletter_btn_text,
        '--footer-copyright-color': form.settings.footer_copyright_color,
        '--footer-bottom-bg': form.settings.footer_bottom_bg,
        '--footer-divider-color': form.settings.footer_border_color,
    };
});
</script>

<template>
    <Head title="Layout Management" />

    <div class="max-w-6xl space-y-6 pb-20">
        <div
            class="flex flex-col justify-between gap-4 md:flex-row md:items-center"
        >
            <div>
                <span
                    class="text-slate font-mono text-xs tracking-widest uppercase"
                    >MB · 07 — LAYOUT</span
                >
                <h1
                    class="mt-1 font-display text-3xl font-bold text-base-content"
                    style="color: #0b2540"
                >
                    Layout Management
                </h1>
                <p class="text-slate mt-1 font-body text-sm">
                    Fully dynamic customizer for header menus, logos, footer
                    maps, socials, typography, and styling.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <button
                    type="button"
                    @click="previewMode = !previewMode"
                    class="btn flex items-center gap-2 rounded-lg border-slate-300 btn-outline text-slate-700 hover:bg-slate-100"
                >
                    <Eye class="size-4" />
                    <span>{{
                        previewMode ? 'Hide Preview' : 'Show Live Preview'
                    }}</span>
                </button>
                <button
                    @click="submit"
                    class="bg-amber hover:bg-amber-dark btn flex items-center gap-2 rounded-lg border-none px-6 font-semibold text-white transition-colors duration-150"
                    :disabled="form.processing"
                >
                    <Save class="size-4" />
                    <span>{{
                        form.processing ? 'Saving...' : 'Save Changes'
                    }}</span>
                </button>
            </div>
        </div>

        <!-- Alerts -->
        <div
            v-if="form.errors && Object.keys(form.errors).length > 0"
            class="alert flex items-start gap-2 rounded-lg border-rose-200 bg-rose-50 p-4 alert-error text-rose-800"
        >
            <AlertCircle class="mt-0.5 size-5 shrink-0 text-rose-600" />
            <div>
                <p class="text-sm font-bold">
                    Validation failed. Please correct the errors:
                </p>
                <ul class="mt-1 list-disc space-y-1 pl-5 text-xs">
                    <li v-for="(error, key) in form.errors" :key="key">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>

        <div
            v-if="$page.props.flash?.success"
            class="bg-freight-green alert flex items-center gap-2 rounded-lg border-none alert-success text-white"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
            <span class="font-body text-sm font-semibold">{{
                $page.props.flash.success
            }}</span>
        </div>

        <!-- Layout Grid for Tabs + Preview -->
        <div class="grid grid-cols-1 items-start gap-8 lg:grid-cols-12">
            <!-- Left: Settings Form Panel -->
            <div
                class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm lg:col-span-7"
            >
                <!-- Navigation Tabs -->
                <div
                    class="flex flex-wrap border-b border-slate-200 bg-slate-50"
                >
                    <button
                        v-for="tab in [
                            { id: 'navbar_content', label: 'Navbar Menu' },
                            { id: 'navbar_design', label: 'Navbar Design' },
                            { id: 'footer_content', label: 'Footer Content' },
                            { id: 'footer_design', label: 'Footer Design' },
                            { id: 'global_design', label: 'Typography' },
                            { id: 'coming_soon', label: 'Coming Soon' },
                        ]"
                        :key="tab.id"
                        type="button"
                        @click="activeTab = tab.id as any"
                        class="border-b-2 px-5 py-3.5 font-mono text-xs font-semibold tracking-wider uppercase transition-colors duration-150"
                        :class="
                            activeTab === tab.id
                                ? 'border-amber text-amber bg-white font-bold'
                                : 'border-transparent text-slate-500 hover:bg-slate-100/50 hover:text-slate-900'
                        "
                    >
                        {{ tab.label }}
                    </button>
                </div>

                <!-- Form Inputs -->
                <form @submit.prevent="submit" class="space-y-6 p-6">
                    <!-- TAB 1: Navbar Content -->
                    <div
                        v-show="activeTab === 'navbar_content'"
                        class="space-y-6"
                    >
                        <h3
                            class="border-b pb-2 font-mono text-sm font-bold tracking-wider text-[#0B2540] uppercase"
                        >
                            Navbar branding & Links
                        </h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                    >Website Name</label
                                >
                                <input
                                    v-model="form.settings.navbar_website_name"
                                    type="text"
                                    class="input-bordered focus:border-amber focus:ring-amber/20 input w-full rounded-lg focus:ring-2"
                                />
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                    >Website Tagline</label
                                >
                                <input
                                    v-model="
                                        form.settings.navbar_website_tagline
                                    "
                                    type="text"
                                    class="input-bordered focus:border-amber focus:ring-amber/20 input w-full rounded-lg focus:ring-2"
                                />
                            </div>
                        </div>

                        <!-- Brand Logo upload -->
                        <div class="form-control border-t pt-4">
                            <label
                                class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                >Navbar Logo</label
                            >
                            <div class="flex items-center gap-4">
                                <div
                                    class="relative flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-lg border bg-slate-50 p-2"
                                >
                                    <img
                                        v-if="navbarLogoPreview"
                                        :src="navbarLogoPreview"
                                        class="max-h-full max-w-full object-contain"
                                    />
                                    <ImageIcon
                                        v-else
                                        class="size-6 text-slate-300"
                                    />
                                </div>
                                <div class="flex-grow space-y-2">
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="file"
                                            accept="image/*"
                                            @change="handleNavbarLogoChange"
                                            class="file-input-bordered focus:ring-amber/20 file-input max-w-xs file-input-sm focus:ring-2"
                                        />
                                        <button
                                            v-if="navbarLogoPreview"
                                            type="button"
                                            @click="deleteLogo('navbar')"
                                            class="btn rounded-lg btn-outline btn-error btn-sm"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-slate-400">
                                        Supported: SVG, PNG, JPG, WebP.
                                        Recommended height: 40px.
                                    </p>
                                    <input
                                        v-model="form.settings.navbar_logo"
                                        type="text"
                                        class="input-bordered input mt-1 w-full rounded-lg input-sm"
                                        placeholder="Or enter manual logo URL path (e.g. /images/logo.svg)"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Navigation links CRUD list -->
                        <div class="form-control space-y-3 border-t pt-4">
                            <div class="flex items-center justify-between">
                                <label
                                    class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                    >Navigation Menu Items</label
                                >
                                <button
                                    type="button"
                                    @click="openLinkModal('navbar')"
                                    class="bg-amber hover:bg-amber-dark btn flex items-center gap-1 border-none text-white btn-xs"
                                >
                                    <Plus class="size-3" />
                                    <span>Add Menu Link</span>
                                </button>
                            </div>

                            <div
                                class="divide-y overflow-hidden rounded-lg border bg-slate-50 text-sm"
                            >
                                <div
                                    v-if="
                                        form.settings.navbar_links.length === 0
                                    "
                                    class="p-6 text-center text-slate-400"
                                >
                                    No menu items defined. Click Add Menu Link.
                                </div>
                                <div
                                    v-for="(link, index) in form.settings
                                        .navbar_links"
                                    :key="index"
                                    class="flex items-center justify-between bg-white p-3.5 transition-colors duration-150"
                                    :class="!link.is_active ? 'opacity-50' : ''"
                                >
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="font-mono text-xs font-semibold text-slate-400"
                                            >#{{ index + 1 }}</span
                                        >
                                        <div>
                                            <div
                                                class="flex items-center gap-2 font-semibold text-slate-800"
                                            >
                                                <span>{{ link.name }}</span>
                                                <span
                                                    v-if="link.target_blank"
                                                    class="rounded bg-slate-100 px-1 font-mono text-[10px] text-slate-500"
                                                    >New Tab</span
                                                >
                                            </div>
                                            <div
                                                class="mt-0.5 flex items-center gap-1 font-mono text-xs text-slate-400"
                                            >
                                                <LinkIcon class="size-3" />
                                                <span>{{ link.href }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button
                                            type="button"
                                            @click="
                                                toggleItemActive(
                                                    'navbar',
                                                    index,
                                                )
                                            "
                                            class="btn rounded btn-xs"
                                            :class="
                                                link.is_active
                                                    ? 'text-white btn-success'
                                                    : 'btn-ghost text-slate-400'
                                            "
                                            title="Toggle Active"
                                        >
                                            <Check class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                openLinkModal('navbar', index)
                                            "
                                            class="btn rounded btn-ghost text-slate-600 btn-xs"
                                            title="Edit"
                                        >
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                moveLinkItem(
                                                    'navbar',
                                                    index,
                                                    'up',
                                                )
                                            "
                                            :disabled="index === 0"
                                            class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30"
                                        >
                                            <ArrowUp class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                moveLinkItem(
                                                    'navbar',
                                                    index,
                                                    'down',
                                                )
                                            "
                                            :disabled="
                                                index ===
                                                form.settings.navbar_links
                                                    .length -
                                                    1
                                            "
                                            class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30"
                                        >
                                            <ArrowDown class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                deleteLinkItem('navbar', index)
                                            "
                                            class="btn rounded btn-ghost text-rose-500 btn-xs"
                                            title="Delete"
                                        >
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Button configuration -->
                        <div class="form-control space-y-4 border-t pt-4">
                            <label
                                class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                >Call-To-Action (CTA) Button</label
                            >
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Button Text</label
                                    >
                                    <input
                                        v-model="form.settings.navbar_cta_text"
                                        type="text"
                                        class="input-bordered input rounded-lg input-sm"
                                    />
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Button URL</label
                                    >
                                    <input
                                        v-model="form.settings.navbar_cta_url"
                                        type="text"
                                        class="input-bordered input rounded-lg input-sm"
                                    />
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Enabled Status</label
                                    >
                                    <select
                                        v-model="
                                            form.settings.navbar_cta_active
                                        "
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="true">Enabled</option>
                                        <option value="false">Disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Login Button configuration -->
                        <div class="form-control space-y-4 border-t pt-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label
                                        class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                        >Show Login Button</label
                                    >
                                    <p class="text-xs text-slate-500">
                                        Enable or disable the Login button in the website navbar.
                                    </p>
                                </div>
                                <div class="form-control">
                                    <select
                                        v-model="form.settings.navbar_login_button"
                                        @change="form.settings.show_login_button = form.settings.navbar_login_button"
                                        class="select-bordered select rounded-lg select-sm min-w-[120px]"
                                    >
                                        <option value="true">ON (Enabled)</option>
                                        <option value="false">OFF (Disabled)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: Navbar Design -->
                    <div
                        v-show="activeTab === 'navbar_design'"
                        class="space-y-6"
                    >
                        <h3
                            class="border-b pb-2 font-mono text-sm font-bold tracking-wider text-[#0B2540] uppercase"
                        >
                            Navbar styles & Colors
                        </h3>

                        <!-- Properties -->
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500 uppercase"
                                    >Style Profile</label
                                >
                                <select
                                    v-model="form.settings.navbar_style"
                                    class="select-bordered select rounded-lg"
                                >
                                    <option value="transparent">
                                        Transparent
                                    </option>
                                    <option value="solid">
                                        Solid Background
                                    </option>
                                    <option value="glassmorphism">
                                        Glassmorphism
                                    </option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500 uppercase"
                                    >Sticky Header</label
                                >
                                <select
                                    v-model="form.settings.navbar_sticky"
                                    class="select-bordered select rounded-lg"
                                >
                                    <option value="true">
                                        Sticky (Fixed Top)
                                    </option>
                                    <option value="false">Static Flow</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500 uppercase"
                                    >Blur Background</label
                                >
                                <select
                                    v-model="form.settings.navbar_blur"
                                    class="select-bordered select rounded-lg"
                                >
                                    <option value="true">Blur Enabled</option>
                                    <option value="false">Blur Disabled</option>
                                </select>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 gap-4 border-t pt-4 md:grid-cols-3"
                        >
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500 uppercase"
                                    >Shadow</label
                                >
                                <select
                                    v-model="form.settings.navbar_shadow"
                                    class="select-bordered select rounded-lg"
                                >
                                    <option value="true">Shadow Enabled</option>
                                    <option value="false">
                                        Shadow Disabled
                                    </option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500 uppercase"
                                    >Bottom Border</label
                                >
                                <select
                                    v-model="form.settings.navbar_border_bottom"
                                    class="select-bordered select rounded-lg"
                                >
                                    <option value="true">Border Enabled</option>
                                    <option value="false">
                                        Border Disabled
                                    </option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500 uppercase"
                                    >Height (px)</label
                                >
                                <input
                                    v-model="form.settings.navbar_height"
                                    type="text"
                                    class="input-bordered input rounded-lg"
                                    placeholder="e.g. 72px"
                                />
                            </div>
                        </div>

                        <!-- Color pickers -->
                        <div class="space-y-4 border-t pt-4">
                            <label
                                class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                >Color Palette</label
                            >

                            <div
                                class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3"
                            >
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Navbar Background</label
                                    >
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            v-model="form.settings.navbar_bg"
                                            class="h-8 w-10 rounded border"
                                        />
                                        <input
                                            type="text"
                                            v-model="form.settings.navbar_bg"
                                            class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                        />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Navbar Text</label
                                    >
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            v-model="form.settings.navbar_text"
                                            class="h-8 w-10 rounded border"
                                        />
                                        <input
                                            type="text"
                                            v-model="form.settings.navbar_text"
                                            class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                        />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Navbar Hover</label
                                    >
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            v-model="form.settings.navbar_hover"
                                            class="h-8 w-10 rounded border"
                                        />
                                        <input
                                            type="text"
                                            v-model="form.settings.navbar_hover"
                                            class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                        />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Active Link</label
                                    >
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            v-model="
                                                form.settings.navbar_active
                                            "
                                            class="h-8 w-10 rounded border"
                                        />
                                        <input
                                            type="text"
                                            v-model="
                                                form.settings.navbar_active
                                            "
                                            class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                        />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >CTA Button BG</label
                                    >
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            v-model="
                                                form.settings.navbar_cta_bg
                                            "
                                            class="h-8 w-10 rounded border"
                                        />
                                        <input
                                            type="text"
                                            v-model="
                                                form.settings.navbar_cta_bg
                                            "
                                            class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                        />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >CTA Button Text</label
                                    >
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            v-model="
                                                form.settings
                                                    .navbar_cta_text_color
                                            "
                                            class="h-8 w-10 rounded border"
                                        />
                                        <input
                                            type="text"
                                            v-model="
                                                form.settings
                                                    .navbar_cta_text_color
                                            "
                                            class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                        />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >CTA Hover BG</label
                                    >
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            v-model="
                                                form.settings
                                                    .navbar_cta_hover_bg
                                            "
                                            class="h-8 w-10 rounded border"
                                        />
                                        <input
                                            type="text"
                                            v-model="
                                                form.settings
                                                    .navbar_cta_hover_bg
                                            "
                                            class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                        />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >CTA Hover Text</label
                                    >
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="color"
                                            v-model="
                                                form.settings
                                                    .navbar_cta_hover_text
                                            "
                                            class="h-8 w-10 rounded border"
                                        />
                                        <input
                                            type="text"
                                            v-model="
                                                form.settings
                                                    .navbar_cta_hover_text
                                            "
                                            class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                        />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Glass Opacity (0.1 to 1)</label
                                    >
                                    <input
                                        type="number"
                                        step="0.1"
                                        min="0.1"
                                        max="1"
                                        v-model="
                                            form.settings.navbar_glass_opacity
                                        "
                                        class="input-bordered input w-full rounded-lg input-sm"
                                    />
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Glass Blur Radius (px)</label
                                    >
                                    <input
                                        type="text"
                                        v-model="
                                            form.settings.navbar_glass_blur
                                        "
                                        class="input-bordered input w-full rounded-lg font-mono input-sm"
                                        placeholder="e.g. 12px"
                                    />
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Border Color (RGBA)</label
                                    >
                                    <input
                                        type="text"
                                        v-model="
                                            form.settings.navbar_border_color
                                        "
                                        class="input-bordered input w-full rounded-lg font-mono input-sm"
                                    />
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Shadow Tint (RGBA)</label
                                    >
                                    <input
                                        type="text"
                                        v-model="
                                            form.settings.navbar_shadow_strength
                                        "
                                        class="input-bordered input w-full rounded-lg font-mono input-sm"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: Footer Content -->
                    <div
                        v-show="activeTab === 'footer_content'"
                        class="space-y-6"
                    >
                        <h3
                            class="border-b pb-2 font-mono text-sm font-bold tracking-wider text-[#0B2540] uppercase"
                        >
                            Footer Info & Links
                        </h3>

                        <div class="form-control">
                            <label
                                class="label font-mono text-xs text-slate-500 uppercase"
                                >Company Name</label
                            >
                            <input
                                v-model="form.settings.footer_company_name"
                                type="text"
                                class="input-bordered input w-full rounded-lg"
                            />
                        </div>

                        <div class="form-control">
                            <label
                                class="label font-mono text-xs text-slate-500 uppercase"
                                >Company Description</label
                            >
                            <textarea
                                v-model="form.settings.footer_description"
                                class="textarea-bordered textarea h-20 w-full rounded-lg"
                            ></textarea>
                        </div>

                        <!-- Footer Logo upload -->
                        <div class="form-control border-t pt-4">
                            <label
                                class="label font-mono text-xs text-slate-500 uppercase"
                                >Footer Logo</label
                            >
                            <div class="flex items-center gap-4">
                                <div
                                    class="relative flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-lg border bg-slate-50 p-2"
                                >
                                    <img
                                        v-if="footerLogoPreview"
                                        :src="footerLogoPreview"
                                        class="max-h-full max-w-full object-contain"
                                    />
                                    <ImageIcon
                                        v-else
                                        class="size-6 text-slate-300"
                                    />
                                </div>
                                <div class="flex-grow space-y-2">
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="file"
                                            accept="image/*"
                                            @change="handleFooterLogoChange"
                                            class="file-input-bordered focus:ring-amber/20 file-input max-w-xs file-input-sm focus:ring-2"
                                        />
                                        <button
                                            v-if="footerLogoPreview"
                                            type="button"
                                            @click="deleteLogo('footer')"
                                            class="btn rounded-lg btn-outline btn-error btn-sm"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-slate-400">
                                        Supported: SVG, PNG, JPG, WebP.
                                        Recommended height: 40px.
                                    </p>
                                    <input
                                        v-model="form.settings.footer_logo"
                                        type="text"
                                        class="input-bordered input mt-1 w-full rounded-lg input-sm"
                                        placeholder="Or enter manual logo URL path (e.g. /images/logo.svg)"
                                    />
                                </div>
                            </div>
                        </div>


                        <div
                            class="grid grid-cols-1 gap-4 border-t pt-4 md:grid-cols-2"
                        >
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500"
                                    >Copyright Text</label
                                >
                                <input
                                    v-model="form.settings.footer_copyright"
                                    type="text"
                                    class="input-bordered input w-full rounded-lg input-sm"
                                />
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500"
                                    >Bottom Tagline</label
                                >
                                <input
                                    v-model="form.settings.footer_tagline"
                                    type="text"
                                    class="input-bordered input w-full rounded-lg input-sm"
                                    placeholder="e.g. Precise • Calm • Dependable"
                                />
                            </div>
                        </div>

                        <!-- Newsletter settings -->
                        <div class="space-y-4 border-t pt-4">
                            <label
                                class="label font-mono text-xs font-semibold text-slate-500 uppercase"
                                >Newsletter Settings</label
                            >
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Newsletter Title</label
                                    >
                                    <input
                                        v-model="
                                            form.settings
                                                .footer_newsletter_title
                                        "
                                        type="text"
                                        class="input-bordered input rounded-lg input-sm"
                                    />
                                </div>
                                <div class="form-control md:col-span-2">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Description</label
                                    >
                                    <input
                                        v-model="
                                            form.settings.footer_newsletter_desc
                                        "
                                        type="text"
                                        class="input-bordered input rounded-lg input-sm"
                                    />
                                </div>
                                <div class="form-control">
                                    <label
                                        class="label font-mono text-[11px] text-slate-400"
                                        >Active State</label
                                    >
                                    <select
                                        v-model="
                                            form.settings
                                                .footer_newsletter_active
                                        "
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="true">Enabled</option>
                                        <option value="false">Disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Lists: Quick Links CRUD -->
                        <div class="space-y-3 border-t pt-4">
                            <div class="flex items-center justify-between">
                                <label
                                    class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                    >Quick Links List</label
                                >
                                <button
                                    type="button"
                                    @click="openLinkModal('quick_links')"
                                    class="bg-amber hover:bg-amber-dark btn flex items-center gap-1 border-none text-white btn-xs"
                                >
                                    <Plus class="size-3" />
                                    <span>Add Quick Link</span>
                                </button>
                            </div>

                            <div
                                class="divide-y overflow-hidden rounded-lg border bg-slate-50 text-sm"
                            >
                                <div
                                    v-if="
                                        form.settings.footer_quick_links
                                            .length === 0
                                    "
                                    class="p-4 text-center text-slate-400"
                                >
                                    No Quick Links defined.
                                </div>
                                <div
                                    v-for="(link, idx) in form.settings
                                        .footer_quick_links"
                                    :key="idx"
                                    class="flex items-center justify-between bg-white p-3"
                                    :class="!link.is_active ? 'opacity-50' : ''"
                                >
                                    <div>
                                        <span
                                            class="font-semibold text-slate-800"
                                            >{{ link.name }}</span
                                        >
                                        <span
                                            class="block font-mono text-xs text-slate-400"
                                            >{{ link.href }}</span
                                        >
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button
                                            type="button"
                                            @click="
                                                toggleItemActive(
                                                    'quick_links',
                                                    idx,
                                                )
                                            "
                                            class="btn rounded btn-xs"
                                            :class="
                                                link.is_active
                                                    ? 'text-white btn-success'
                                                    : 'btn-ghost text-slate-400'
                                            "
                                        >
                                            <Check class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                openLinkModal(
                                                    'quick_links',
                                                    idx,
                                                )
                                            "
                                            class="btn rounded btn-ghost text-slate-600 btn-xs"
                                        >
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                moveLinkItem(
                                                    'quick_links',
                                                    idx,
                                                    'up',
                                                )
                                            "
                                            :disabled="idx === 0"
                                            class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30"
                                        >
                                            <ArrowUp class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                moveLinkItem(
                                                    'quick_links',
                                                    idx,
                                                    'down',
                                                )
                                            "
                                            :disabled="
                                                idx ===
                                                form.settings.footer_quick_links
                                                    .length -
                                                    1
                                            "
                                            class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30"
                                        >
                                            <ArrowDown class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                deleteLinkItem(
                                                    'quick_links',
                                                    idx,
                                                )
                                            "
                                            class="btn rounded btn-ghost text-rose-500 btn-xs"
                                        >
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lists: Services List CRUD -->
                        <div class="space-y-3 border-t pt-4">
                            <div class="flex items-center justify-between">
                                <label
                                    class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                    >Services List</label
                                >
                                <button
                                    type="button"
                                    @click="openLinkModal('services')"
                                    class="bg-amber hover:bg-amber-dark btn flex items-center gap-1 border-none text-white btn-xs"
                                >
                                    <Plus class="size-3" />
                                    <span>Add Service Link</span>
                                </button>
                            </div>

                            <div
                                class="divide-y overflow-hidden rounded-lg border bg-slate-50 text-sm"
                            >
                                <div
                                    v-if="
                                        form.settings.footer_services.length ===
                                        0
                                    "
                                    class="p-4 text-center text-slate-400"
                                >
                                    No Services Links defined.
                                </div>
                                <div
                                    v-for="(link, idx) in form.settings
                                        .footer_services"
                                    :key="idx"
                                    class="flex items-center justify-between bg-white p-3"
                                    :class="!link.is_active ? 'opacity-50' : ''"
                                >
                                    <div>
                                        <span
                                            class="font-semibold text-slate-800"
                                            >{{ link.name }}</span
                                        >
                                        <span
                                            class="block font-mono text-xs text-slate-400"
                                            >{{ link.href }}</span
                                        >
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button
                                            type="button"
                                            @click="
                                                toggleItemActive(
                                                    'services',
                                                    idx,
                                                )
                                            "
                                            class="btn rounded btn-xs"
                                            :class="
                                                link.is_active
                                                    ? 'text-white btn-success'
                                                    : 'btn-ghost text-slate-400'
                                            "
                                        >
                                            <Check class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                openLinkModal('services', idx)
                                            "
                                            class="btn rounded btn-ghost text-slate-600 btn-xs"
                                        >
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                moveLinkItem(
                                                    'services',
                                                    idx,
                                                    'up',
                                                )
                                            "
                                            :disabled="idx === 0"
                                            class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30"
                                        >
                                            <ArrowUp class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                moveLinkItem(
                                                    'services',
                                                    idx,
                                                    'down',
                                                )
                                            "
                                            :disabled="
                                                idx ===
                                                form.settings.footer_services
                                                    .length -
                                                    1
                                            "
                                            class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30"
                                        >
                                            <ArrowDown class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                deleteLinkItem('services', idx)
                                            "
                                            class="btn rounded btn-ghost text-rose-500 btn-xs"
                                        >
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lists: Socials Media CRUD -->
                        <div class="space-y-3 border-t pt-4">
                            <div class="flex items-center justify-between">
                                <label
                                    class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase"
                                    >Social Media Links</label
                                >
                                <button
                                    type="button"
                                    @click="openLinkModal('socials')"
                                    class="bg-amber hover:bg-amber-dark btn flex items-center gap-1 border-none text-white btn-xs"
                                >
                                    <Plus class="size-3" />
                                    <span>Add Social Link</span>
                                </button>
                            </div>

                            <div
                                class="divide-y overflow-hidden rounded-lg border bg-slate-50 text-sm"
                            >
                                <div
                                    v-if="
                                        form.settings.footer_socials.length ===
                                        0
                                    "
                                    class="p-4 text-center text-slate-400"
                                >
                                    No Social Media channels configured.
                                </div>
                                <div
                                    v-for="(link, idx) in form.settings
                                        .footer_socials"
                                    :key="idx"
                                    class="flex items-center justify-between bg-white p-3"
                                    :class="!link.is_active ? 'opacity-50' : ''"
                                >
                                    <div>
                                        <span
                                            class="font-semibold text-slate-800 capitalize"
                                            >{{ link.platform }}</span
                                        >
                                        <span
                                            class="block font-mono text-xs text-slate-400"
                                            >{{ link.url }}</span
                                        >
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button
                                            type="button"
                                            @click="
                                                toggleItemActive('socials', idx)
                                            "
                                            class="btn rounded btn-xs"
                                            :class="
                                                link.is_active
                                                    ? 'text-white btn-success'
                                                    : 'btn-ghost text-slate-400'
                                            "
                                        >
                                            <Check class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                openLinkModal('socials', idx)
                                            "
                                            class="btn rounded btn-ghost text-slate-600 btn-xs"
                                        >
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button
                                            type="button"
                                            @click="
                                                deleteLinkItem('socials', idx)
                                            "
                                            class="btn rounded btn-ghost text-rose-500 btn-xs"
                                        >
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Repeatable Phone Numbers collection -->
                        <div class="space-y-3 border-t pt-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase">Phone Numbers (Repeatable)</label>
                                    <p class="text-xs text-slate-400">Add multiple telephone or hotline numbers for the Footer.</p>
                                </div>
                                <button
                                    type="button"
                                    @click="openContactModal('phone')"
                                    class="bg-amber hover:bg-amber-dark btn flex items-center gap-1 border-none text-white btn-xs"
                                >
                                    <Plus class="size-3" />
                                    <span>Add Phone</span>
                                </button>
                            </div>

                            <div class="divide-y overflow-hidden rounded-lg border bg-slate-50 text-sm">
                                <div v-if="!form.settings.footer_phones || form.settings.footer_phones.length === 0" class="p-4 text-center text-slate-400 text-xs">
                                    No repeatable phone numbers added yet. (Will fall back to single Phone field)
                                </div>
                                <div
                                    v-for="(item, idx) in form.settings.footer_phones"
                                    :key="idx"
                                    class="flex items-center justify-between bg-white p-3"
                                    :class="!item.is_active ? 'opacity-50' : ''"
                                >
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-800">{{ item.phone }}</span>
                                            <span v-if="item.label" class="rounded bg-amber/10 text-amber px-1.5 py-0.5 font-mono text-[10px] font-bold uppercase">{{ item.label }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button type="button" @click="toggleContactActive('phone', idx)" class="btn rounded btn-xs" :class="item.is_active ? 'text-white btn-success' : 'btn-ghost text-slate-400'">
                                            <Check class="size-3" />
                                        </button>
                                        <button type="button" @click="openContactModal('phone', idx)" class="btn rounded btn-ghost text-slate-600 btn-xs">
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button type="button" @click="moveContactItem('phone', idx, 'up')" :disabled="idx === 0" class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30">
                                            <ArrowUp class="size-3" />
                                        </button>
                                        <button type="button" @click="moveContactItem('phone', idx, 'down')" :disabled="idx === form.settings.footer_phones.length - 1" class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30">
                                            <ArrowDown class="size-3" />
                                        </button>
                                        <button type="button" @click="deleteContactItem('phone', idx)" class="btn rounded btn-ghost text-rose-500 btn-xs">
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Repeatable Email Addresses collection -->
                        <div class="space-y-3 border-t pt-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase">Email Addresses (Repeatable)</label>
                                    <p class="text-xs text-slate-400">Add multiple email addresses for operations, sales, support, etc.</p>
                                </div>
                                <button
                                    type="button"
                                    @click="openContactModal('email')"
                                    class="bg-amber hover:bg-amber-dark btn flex items-center gap-1 border-none text-white btn-xs"
                                >
                                    <Plus class="size-3" />
                                    <span>Add Email</span>
                                </button>
                            </div>

                            <div class="divide-y overflow-hidden rounded-lg border bg-slate-50 text-sm">
                                <div v-if="!form.settings.footer_emails || form.settings.footer_emails.length === 0" class="p-4 text-center text-slate-400 text-xs">
                                    No repeatable emails added yet. (Will fall back to single Email field)
                                </div>
                                <div
                                    v-for="(item, idx) in form.settings.footer_emails"
                                    :key="idx"
                                    class="flex items-center justify-between bg-white p-3"
                                    :class="!item.is_active ? 'opacity-50' : ''"
                                >
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-800">{{ item.email }}</span>
                                            <span v-if="item.label" class="rounded bg-sky-100 text-sky-700 px-1.5 py-0.5 font-mono text-[10px] font-bold uppercase">{{ item.label }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button type="button" @click="toggleContactActive('email', idx)" class="btn rounded btn-xs" :class="item.is_active ? 'text-white btn-success' : 'btn-ghost text-slate-400'">
                                            <Check class="size-3" />
                                        </button>
                                        <button type="button" @click="openContactModal('email', idx)" class="btn rounded btn-ghost text-slate-600 btn-xs">
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button type="button" @click="moveContactItem('email', idx, 'up')" :disabled="idx === 0" class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30">
                                            <ArrowUp class="size-3" />
                                        </button>
                                        <button type="button" @click="moveContactItem('email', idx, 'down')" :disabled="idx === form.settings.footer_emails.length - 1" class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30">
                                            <ArrowDown class="size-3" />
                                        </button>
                                        <button type="button" @click="deleteContactItem('email', idx)" class="btn rounded btn-ghost text-rose-500 btn-xs">
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Repeatable Office Addresses collection -->
                        <div class="space-y-3 border-t pt-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="label font-mono text-xs font-semibold tracking-wider text-slate-500 uppercase">Office Addresses (Repeatable)</label>
                                    <p class="text-xs text-slate-400">Add multiple office locations (Head Office, Port Desks, Regional Offices).</p>
                                </div>
                                <button
                                    type="button"
                                    @click="openContactModal('address')"
                                    class="bg-amber hover:bg-amber-dark btn flex items-center gap-1 border-none text-white btn-xs"
                                >
                                    <Plus class="size-3" />
                                    <span>Add Address</span>
                                </button>
                            </div>

                            <div class="divide-y overflow-hidden rounded-lg border bg-slate-50 text-sm">
                                <div v-if="!form.settings.footer_addresses || form.settings.footer_addresses.length === 0" class="p-4 text-center text-slate-400 text-xs">
                                    No repeatable addresses added yet. (Will fall back to single Address field)
                                </div>
                                <div
                                    v-for="(item, idx) in form.settings.footer_addresses"
                                    :key="idx"
                                    class="flex items-center justify-between bg-white p-3"
                                    :class="!item.is_active ? 'opacity-50' : ''"
                                >
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span v-if="item.name" class="font-semibold text-slate-800">{{ item.name }}: </span>
                                            <span class="text-slate-700">{{ item.address }}</span>
                                        </div>
                                        <div v-if="item.map_url" class="text-[10px] font-mono text-amber mt-0.5">Google Maps Link attached</div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button type="button" @click="toggleContactActive('address', idx)" class="btn rounded btn-xs" :class="item.is_active ? 'text-white btn-success' : 'btn-ghost text-slate-400'">
                                            <Check class="size-3" />
                                        </button>
                                        <button type="button" @click="openContactModal('address', idx)" class="btn rounded btn-ghost text-slate-600 btn-xs">
                                            <Edit2 class="size-3" />
                                        </button>
                                        <button type="button" @click="moveContactItem('address', idx, 'up')" :disabled="idx === 0" class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30">
                                            <ArrowUp class="size-3" />
                                        </button>
                                        <button type="button" @click="moveContactItem('address', idx, 'down')" :disabled="idx === form.settings.footer_addresses.length - 1" class="btn rounded btn-ghost text-slate-600 btn-xs disabled:opacity-30">
                                            <ArrowDown class="size-3" />
                                        </button>
                                        <button type="button" @click="deleteContactItem('address', idx)" class="btn rounded btn-ghost text-rose-500 btn-xs">
                                            <Trash2 class="size-3" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: Footer Design -->
                    <div
                        v-show="activeTab === 'footer_design'"
                        class="space-y-6"
                    >
                        <h3
                            class="border-b pb-2 font-mono text-sm font-bold tracking-wider text-[#0B2540] uppercase"
                        >
                            Footer Design System
                        </h3>

                        <!-- Subsection 1: Background & Spacing -->
                        <div class="space-y-4">
                            <h4 class="font-semibold text-sm text-[#0B2540] border-l-4 border-amber pl-2">Background & Spacing</h4>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Background Style Preset</label>
                                    <select
                                        v-model="form.settings.footer_bg_style"
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="solid-white">Solid White</option>
                                        <option value="solid-navy">Solid Navy</option>
                                        <option value="white-navy-accents">White with Subtle Navy Accents</option>
                                        <option value="white-orange-lines">White with Orange Accent Lines</option>
                                        <option value="navy-gradient">Navy Gradient</option>
                                        <option value="white-gradient">White Gradient (Navy-White)</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Background Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Bottom Section BG</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_bottom_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_bottom_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Top Padding</label>
                                    <input v-model="form.settings.footer_top_padding" type="text" class="input-bordered input rounded-lg input-sm" />
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Bottom Padding</label>
                                    <input v-model="form.settings.footer_bottom_padding" type="text" class="input-bordered input rounded-lg input-sm" />
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Font Weight</label>
                                    <input v-model="form.settings.footer_font_weight" type="text" class="input-bordered input rounded-lg input-sm" />
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Column Gap</label>
                                    <input v-model="form.settings.footer_column_gap" type="text" class="input-bordered input rounded-lg input-sm" placeholder="e.g. 3rem" />
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Section bottom Gap</label>
                                    <input v-model="form.settings.footer_section_gap" type="text" class="input-bordered input rounded-lg input-sm" placeholder="e.g. 4rem" />
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Shadow Strength (RGBA)</label>
                                    <input type="text" v-model="form.settings.footer_shadow_strength" class="input-bordered input w-full rounded-lg font-mono input-sm" />
                                </div>
                            </div>
                        </div>

                        <!-- Subsection 2: Text Colors -->
                        <div class="space-y-4 border-t pt-4">
                            <h4 class="font-semibold text-sm text-[#0B2540] border-l-4 border-amber pl-2">Text Colors</h4>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Headings Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_heading_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_heading_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Paragraph Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_paragraph_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_paragraph_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Secondary Text Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_secondary_text_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_secondary_text_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Quick Links Text</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_quick_links_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_quick_links_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Quick Links Hover</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_quick_links_hover_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_quick_links_hover_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Services Link Text</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_services_links_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_services_links_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Services Link Hover</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_services_hover_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_services_hover_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Newsletter Heading</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_heading_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_heading_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Newsletter Description</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_description_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_description_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Copyright Text Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_copyright_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_copyright_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Bottom Tagline Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_bottom_tagline_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_bottom_tagline_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subsection 3: Icon Customization -->
                        <div class="space-y-4 border-t pt-4">
                            <h4 class="font-semibold text-sm text-[#0B2540] border-l-4 border-amber pl-2">Icon Customization (Location, Call, Email)</h4>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Icon Background Style</label>
                                    <select
                                        v-model="form.settings.footer_icon_style"
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="circle">Circular Background</option>
                                        <option value="square">Rounded Square</option>
                                        <option value="orange-gradient">Orange Gradient</option>
                                        <option value="navy-outline">Navy Outlined Circle</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Icon Background Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_icon_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_icon_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Icon Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_icon_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_icon_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Icon Hover BG</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_icon_hover_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_icon_hover_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Icon Hover Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_icon_hover_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_icon_hover_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Icon Border Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_icon_border_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_icon_border_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Icon Shadow Strength</label>
                                    <select
                                        v-model="form.settings.footer_icon_shadow"
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="none">None</option>
                                        <option value="light">Light</option>
                                        <option value="medium">Medium</option>
                                        <option value="strong">Strong / Dark</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Subsection 4: Newsletter Styling -->
                        <div class="space-y-4 border-t pt-4">
                            <h4 class="font-semibold text-sm text-[#0B2540] border-l-4 border-amber pl-2">Newsletter Styling</h4>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Newsletter Container BG</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Input Background</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_input_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_input_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Input Border</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_input_border" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_input_border" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Input Text Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_input_text_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_input_text_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Placeholder Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_placeholder_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_placeholder_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Button Background</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_btn_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_btn_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Button Text Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_btn_text" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_btn_text" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Button Hover BG</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_btn_hover_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_btn_hover_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Button Hover Text</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_newsletter_btn_hover_text_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_newsletter_btn_hover_text_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Button Shadow</label>
                                    <select
                                        v-model="form.settings.footer_newsletter_btn_shadow"
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="none">None</option>
                                        <option value="light">Light</option>
                                        <option value="medium">Medium</option>
                                        <option value="strong">Strong</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Subsection 5: Dividers -->
                        <div class="space-y-4 border-t pt-4">
                            <h4 class="font-semibold text-sm text-[#0B2540] border-l-4 border-amber pl-2">Separators & Dividers</h4>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Divider Style</label>
                                    <select
                                        v-model="form.settings.footer_divider_style"
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="orange">Orange Divider</option>
                                        <option value="navy">Navy Divider</option>
                                        <option value="gradient">Gradient Divider</option>
                                        <option value="thin-accent">Thin Accent Line</option>
                                        <option value="double">Double Line</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Divider Color / Border Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_border_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_border_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subsection 6: Social Icons Customization -->
                        <div class="space-y-4 border-t pt-4">
                            <h4 class="font-semibold text-sm text-[#0B2540] border-l-4 border-amber pl-2">Social Icons Customization</h4>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Social Icon Background</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_social_icon_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_social_icon_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Social Icon Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_social_icon_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_social_icon_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Hover Background</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_social_hover_bg" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_social_hover_bg" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Hover Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_social_hover_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_social_hover_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-[11px] text-slate-400">Border Color</label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" v-model="form.settings.footer_social_border_color" class="h-8 w-10 rounded border" />
                                        <input type="text" v-model="form.settings.footer_social_border_color" class="input-bordered input flex-grow rounded-lg font-mono input-sm" />
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Shadow Strength</label>
                                    <select
                                        v-model="form.settings.footer_social_shadow"
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="none">None</option>
                                        <option value="light">Light</option>
                                        <option value="medium">Medium</option>
                                        <option value="strong">Strong</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Subsection 7: Interactive Hover Effects & Animations -->
                        <div class="space-y-4 border-t pt-4">
                            <h4 class="font-semibold text-sm text-[#0B2540] border-l-4 border-amber pl-2">Hover & Transition Effects</h4>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Links Hover Style</label>
                                    <select
                                        v-model="form.settings.footer_link_hover_effect"
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="underline">Underline Animation</option>
                                        <option value="slide">Slide Effect</option>
                                        <option value="arrow">Arrow Animation</option>
                                        <option value="color">Color Transition Only</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="label font-mono text-xs text-slate-500 uppercase">Scroll entrance Animation</label>
                                    <select
                                        v-model="form.settings.footer_animation_style"
                                        class="select-bordered select rounded-lg select-sm"
                                    >
                                        <option value="none">None (Static)</option>
                                        <option value="fade-in">Fade In</option>
                                        <option value="slide-up">Slide Up</option>
                                        <option value="footer-reveal">Footer Reveal on Scroll</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 5: Global Typography -->
                    <div
                        v-show="activeTab === 'global_design'"
                        class="space-y-6"
                    >
                        <h3
                            class="border-b pb-2 font-mono text-sm font-bold tracking-wider text-[#0B2540] uppercase"
                        >
                            Global Typography & Container Spacing
                        </h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500"
                                    >Heading Color</label
                                >
                                <div class="flex items-center gap-2">
                                    <input
                                        type="color"
                                        v-model="form.settings.heading_color"
                                        class="h-8 w-10 rounded border"
                                    />
                                    <input
                                        type="text"
                                        v-model="form.settings.heading_color"
                                        class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                    />
                                </div>
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500"
                                    >Paragraph Text Color</label
                                >
                                <div class="flex items-center gap-2">
                                    <input
                                        type="color"
                                        v-model="form.settings.paragraph_color"
                                        class="h-8 w-10 rounded border"
                                    />
                                    <input
                                        type="text"
                                        v-model="form.settings.paragraph_color"
                                        class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                    />
                                </div>
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500"
                                    >Small/Label Text Color</label
                                >
                                <div class="flex items-center gap-2">
                                    <input
                                        type="color"
                                        v-model="form.settings.small_text_color"
                                        class="h-8 w-10 rounded border"
                                    />
                                    <input
                                        type="text"
                                        v-model="form.settings.small_text_color"
                                        class="input-bordered input flex-grow rounded-lg font-mono input-sm"
                                    />
                                </div>
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500"
                                    >Max Container Width</label
                                >
                                <input
                                    v-model="form.settings.container_width"
                                    type="text"
                                    class="input-bordered input rounded-lg"
                                    placeholder="e.g. 1280px"
                                />
                            </div>
                            <div class="form-control">
                                <label
                                    class="label font-mono text-xs text-slate-500"
                                    >Navigation Font Weight</label
                                >
                                <input
                                    v-model="form.settings.navbar_font_weight"
                                    type="text"
                                    class="input-bordered input rounded-lg"
                                    placeholder="e.g. 500"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- TAB 6: Coming Soon Settings -->
                    <div
                        v-show="activeTab === 'coming_soon'"
                        class="space-y-6"
                    >
                        <h3
                            class="border-b pb-2 font-mono text-sm font-bold tracking-wider text-[#0B2540] uppercase"
                        >
                            Coming Soon Page Layout Controls
                        </h3>

                        <div class="p-4 rounded-xl border border-amber/20 bg-amber/5 flex items-start gap-3">
                            <div class="p-2 rounded-lg bg-amber text-white font-bold text-xs uppercase font-mono">CMS</div>
                            <div>
                                <h4 class="font-display font-bold text-navy text-sm">Independent Navbar & Footer Controls</h4>
                                <p class="text-xs text-slate-600 mt-0.5">Independently show or hide the global Navbar and Footer on the Coming Soon page. When turned OFF, the page automatically adapts its layout without empty gaps.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label font-semibold text-slate text-xs uppercase tracking-wider font-mono">Show Navbar</label>
                                <select
                                    v-model="form.settings.show_navbar"
                                    @change="form.settings.coming_soon_show_navbar = form.settings.show_navbar"
                                    class="select select-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full rounded-lg font-mono text-sm"
                                >
                                    <option value="false">OFF — Hide Header Navigation Bar (Default)</option>
                                    <option value="true">ON — Display Existing Navigation Bar</option>
                                </select>
                                <span class="text-xs text-slate-500 mt-1">Controls visibility of the Header Navbar on /coming-soon.</span>
                            </div>

                            <div class="form-control">
                                <label class="label font-semibold text-slate text-xs uppercase tracking-wider font-mono">Show Footer</label>
                                <select
                                    v-model="form.settings.show_footer"
                                    @change="form.settings.coming_soon_show_footer = form.settings.show_footer"
                                    class="select select-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full rounded-lg font-mono text-sm"
                                >
                                    <option value="false">OFF — Hide Footer Section (Default)</option>
                                    <option value="true">ON — Display Existing Footer Section</option>
                                </select>
                                <span class="text-xs text-slate-500 mt-1">Controls visibility of the Footer on /coming-soon.</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right: Live Preview Panel -->
            <div
                v-if="previewMode"
                class="sticky top-6 space-y-6 lg:col-span-5"
            >
                <div
                    class="space-y-5 rounded-xl border border-slate-200 bg-white p-5 shadow-sm"
                >
                    <div
                        class="flex items-center justify-between border-b pb-3"
                    >
                        <h2
                            class="flex items-center gap-1.5 font-mono text-sm font-bold tracking-wider text-[#0B2540] uppercase"
                        >
                            <Eye class="text-amber size-4" />
                            <span>Interactive Live Preview</span>
                        </h2>
                        <span
                            class="rounded bg-slate-100 px-2 py-0.5 font-mono text-[10px] text-slate-400"
                            >Unsaved Changes</span
                        >
                    </div>

                    <!-- Navbar Preview Box -->
                    <div
                        class="relative space-y-1.5 overflow-hidden rounded-lg border bg-slate-800/10 p-2"
                    >
                        <div
                            class="font-mono text-[10px] font-bold tracking-wide text-slate-400 uppercase"
                        >
                            Header / Navbar
                        </div>

                        <!-- Mini Navbar Mockup -->
                        <div
                            class="flex items-center justify-between rounded border px-3 py-2 shadow-sm transition-all duration-300"
                            :style="{
                                backgroundColor: form.settings.navbar_bg,
                                color: form.settings.navbar_text,
                                borderColor:
                                    form.settings.navbar_border_bottom ===
                                    'true'
                                        ? form.settings.navbar_border_color
                                        : 'transparent',
                                minHeight: '44px',
                            }"
                        >
                            <!-- Logo -->
                            <div class="flex items-center gap-2">
                                <img
                                    v-if="navbarLogoPreview"
                                    :src="navbarLogoPreview"
                                    class="h-6 w-auto"
                                />
                                <div v-else class="flex flex-col leading-none">
                                    <span
                                        class="text-xs font-bold tracking-wider uppercase"
                                        :style="{
                                            color: form.settings.navbar_text,
                                        }"
                                        >{{
                                            form.settings.navbar_website_name ||
                                            'MERCURY'
                                        }}</span
                                    >
                                    <span
                                        class="mt-0.5 font-mono text-[8px]"
                                        style="color: #e8770c"
                                        >{{
                                            form.settings
                                                .navbar_website_tagline ||
                                            'BANGLADESH'
                                        }}</span
                                    >
                                </div>
                            </div>

                            <!-- Links -->
                            <nav
                                class="flex items-center gap-3 text-[10px] font-semibold"
                                :style="{
                                    fontWeight:
                                        form.settings.navbar_font_weight,
                                }"
                            >
                                <span
                                    v-for="(
                                        link, i
                                    ) in form.settings.navbar_links.filter(
                                        (l: any) => l.is_active,
                                    )"
                                    :key="i"
                                    :style="{
                                        color:
                                            i === 0
                                                ? form.settings.navbar_active
                                                : form.settings.navbar_text,
                                    }"
                                    class="cursor-pointer hover:opacity-85"
                                >
                                    {{ link.name }}
                                </span>
                            </nav>

                            <!-- CTA Button -->
                            <div
                                v-if="
                                    form.settings.navbar_cta_active === 'true'
                                "
                                class="rounded px-2.5 py-1 text-[9px] font-bold transition-colors"
                                :style="{
                                    backgroundColor:
                                        form.settings.navbar_cta_bg,
                                    color: form.settings.navbar_cta_text_color,
                                }"
                            >
                                {{
                                    form.settings.navbar_cta_text ||
                                    'Get a Quote'
                                }}
                            </div>
                        </div>
                    </div>

                    <!-- Footer Preview Box -->
                    <div
                        class="space-y-1.5 overflow-hidden rounded-lg border bg-slate-800/10 p-2"
                    >
                        <div
                            class="font-mono text-[10px] font-bold tracking-wide text-slate-400 uppercase"
                        >
                            Footer Mockup
                        </div>
                        <!-- Mini Footer Mockup -->
                        <div
                            class="space-y-4 rounded border p-4 text-[10px] transition-all duration-300"
                            :style="previewFooterStyles"
                        >
                            <!-- Top Area -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <img
                                        v-if="footerLogoPreview"
                                        :src="footerLogoPreview"
                                        class="h-6 w-auto"
                                    />
                                    <h4
                                        v-else
                                        class="text-xs font-bold uppercase"
                                        :style="{
                                            color: previewFooterStyles['--footer-heading-color'],
                                        }"
                                    >
                                        {{
                                            form.settings.footer_company_name ||
                                            'Mercury Bangladesh'
                                        }}
                                    </h4>
                                    <p
                                        class="text-[9px] leading-normal opacity-85"
                                        :style="{
                                            color: previewFooterStyles['--footer-text-color'],
                                        }"
                                    >
                                        {{ form.settings.footer_description }}
                                    </p>
                                </div>
                                <div class="space-y-1.5" v-if="form.settings.footer_newsletter_active === 'true'">
                                    <h4
                                        class="text-[9px] font-bold tracking-wider uppercase"
                                        :style="{
                                            color: previewFooterStyles['--footer-heading-color'] || form.settings.footer_newsletter_heading_color,
                                        }"
                                    >
                                        {{ form.settings.footer_newsletter_title || 'Newsletter' }}
                                    </h4>
                                    <div class="flex items-center gap-1">
                                        <input
                                            type="text"
                                            placeholder="Your Email"
                                            class="w-full rounded border p-1.5 text-[8px] outline-none"
                                            :style="{
                                                backgroundColor: form.settings.footer_newsletter_input_bg,
                                                borderColor: form.settings.footer_newsletter_input_border,
                                                color: form.settings.footer_newsletter_input_text_color,
                                            }"
                                            disabled
                                        />
                                        <button
                                            class="shrink-0 rounded p-1.5 text-[8px] font-bold transition-all duration-200"
                                            :style="{
                                                backgroundColor: form.settings.footer_newsletter_btn_bg,
                                                color: form.settings.footer_newsletter_btn_text,
                                            }"
                                        >
                                            Go
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Divider inside mockup -->
                            <div 
                                class="w-full"
                                :style="{
                                    borderTop: form.settings.footer_divider_style === 'double' ? '3px double' : '1px solid',
                                    borderColor: form.settings.footer_border_color,
                                    background: form.settings.footer_divider_style === 'gradient' ? 'linear-gradient(to right, transparent, #E8770C, transparent)' : undefined,
                                    height: form.settings.footer_divider_style === 'gradient' ? '2px' : undefined
                                }"
                            ></div>

                            <!-- Middle lists -->
                            <div
                                class="grid grid-cols-2 gap-4"
                                :style="{
                                    columnGap: form.settings.footer_column_gap,
                                    paddingBottom: form.settings.footer_section_gap,
                                }"
                            >
                                <div>
                                    <h5
                                        class="mb-1.5 text-[8px] font-bold uppercase"
                                        :style="{
                                            color: previewFooterStyles['--footer-heading-color'],
                                        }"
                                    >
                                        Quick Links
                                    </h5>
                                    <div class="space-y-1 text-[8px]">
                                        <div
                                            v-for="(
                                                l, i
                                            ) in form.settings.footer_quick_links
                                                .filter((x: any) => x.is_active)
                                                .slice(0, 3)"
                                            :key="i"
                                            :style="{
                                                color: previewFooterStyles['--footer-link-color'],
                                            }"
                                        >
                                            • {{ l.name }}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5
                                        class="mb-1.5 text-[8px] font-bold uppercase"
                                        :style="{
                                            color: previewFooterStyles['--footer-heading-color'],
                                        }"
                                    >
                                        Services
                                    </h5>
                                    <div class="space-y-1 text-[8px]">
                                        <div
                                            v-for="(
                                                l, i
                                            ) in form.settings.footer_services
                                                .filter((x: any) => x.is_active)
                                                .slice(0, 3)"
                                            :key="i"
                                            :style="{
                                                color: previewFooterStyles['--footer-link-color'],
                                            }"
                                        >
                                            • {{ l.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Address/Contact info -->
                            <div
                                class="py-2 text-[9px]"
                                :style="{
                                    borderTop: form.settings.footer_divider_style === 'double' ? '3px double' : '1px solid',
                                    borderBottom: form.settings.footer_divider_style === 'double' ? '3px double' : '1px solid',
                                    borderColor: form.settings.footer_border_color,
                                }"
                            >
                                <div :style="{ color: previewFooterStyles['--footer-secondary-color'] }">
                                    <strong>Address:</strong>
                                    {{ form.settings.footer_address }}
                                </div>
                                <div class="mt-0.5" :style="{ color: previewFooterStyles['--footer-secondary-color'] }">
                                    <strong>Phone:</strong>
                                    {{ form.settings.footer_phone }} |
                                    <strong>Email:</strong>
                                    {{ form.settings.footer_email }}
                                </div>
                            </div>

                            <!-- Copyright Bar -->
                            <div
                                class="flex items-center justify-between text-[8px]"
                            >
                                <span :style="{ color: previewFooterStyles['--footer-copyright-color'] }">{{
                                    form.settings.footer_copyright
                                }}</span>
                                <span
                                    :style="{
                                        color: form.settings.footer_bottom_tagline_color,
                                    }"
                                >{{ form.settings.footer_tagline }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit modal for menu links -->
    <div
        v-if="linkModalType !== null"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm"
    >
        <div
            class="w-full max-w-md animate-in overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl duration-150 zoom-in-95 fade-in"
        >
            <div
                class="flex items-center justify-between border-b border-slate-100 bg-slate-50 px-5 py-4"
            >
                <h3
                    class="font-display text-sm font-bold tracking-wide text-slate-800 uppercase"
                >
                    {{
                        currentLinkIndex !== null
                            ? 'Edit Link Record'
                            : 'Add Link Record'
                    }}
                </h3>
                <button
                    type="button"
                    @click="linkModalType = null"
                    class="rounded-md p-1 text-slate-400 hover:bg-slate-100"
                >
                    <X class="size-4" />
                </button>
            </div>

            <div class="space-y-4 p-5 text-sm">
                <!-- If Social Link -->
                <div v-if="linkModalType === 'socials'" class="space-y-4">
                    <div class="form-control">
                        <label
                            class="label text-xs font-semibold text-slate-700"
                            >Social Platform</label
                        >
                        <select
                            v-model="linkForm.platform"
                            class="select-bordered select w-full rounded-lg select-sm"
                        >
                            <option value="facebook">Facebook</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="instagram">Instagram</option>
                            <option value="youtube">YouTube</option>
                            <option value="twitter">Twitter</option>
                            <option value="whatsapp">WhatsApp</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label
                            class="label text-xs font-semibold text-slate-700"
                            >Profile URL</label
                        >
                        <input
                            v-model="linkForm.url"
                            type="url"
                            class="input-bordered input w-full rounded-lg input-sm"
                            placeholder="e.g. https://facebook.com/mycompany"
                        />
                    </div>
                </div>

                <!-- If Standard Link (Navbar, Quick Links, Services) -->
                <div v-else class="space-y-4">
                    <div class="form-control">
                        <label
                            class="label text-xs font-semibold text-slate-700"
                            >Link Label</label
                        >
                        <input
                            v-model="linkForm.name"
                            type="text"
                            class="input-bordered input w-full rounded-lg input-sm"
                            placeholder="e.g. Services"
                        />
                    </div>
                    <div class="form-control">
                        <label
                            class="label text-xs font-semibold text-slate-700"
                            >URL Path</label
                        >
                        <input
                            v-model="linkForm.href"
                            type="text"
                            class="input-bordered input w-full rounded-lg input-sm"
                            placeholder="e.g. /services"
                        />
                    </div>
                    <div
                        v-if="linkModalType === 'navbar'"
                        class="form-control flex flex-row items-center gap-2 pt-2"
                    >
                        <input
                            type="checkbox"
                            v-model="linkForm.target_blank"
                            id="target_blank"
                            class="checkbox rounded checkbox-sm checkbox-primary"
                        />
                        <label
                            for="target_blank"
                            class="cursor-pointer text-xs text-slate-600"
                            >Open in new tab</label
                        >
                    </div>
                </div>

                <div class="form-control flex flex-row items-center gap-2">
                    <input
                        type="checkbox"
                        v-model="linkForm.is_active"
                        id="is_active"
                        class="checkbox rounded checkbox-sm checkbox-primary"
                    />
                    <label
                        for="is_active"
                        class="cursor-pointer text-xs text-slate-600"
                        >Enabled / Active</label
                    >
                </div>
            </div>

            <div
                class="flex justify-end gap-2 border-t border-slate-100 bg-slate-50 px-5 py-3"
            >
                <button
                    type="button"
                    @click="linkModalType = null"
                    class="btn rounded-lg btn-ghost btn-sm"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    @click="saveLinkItem"
                    class="bg-amber hover:bg-amber-dark btn rounded-lg border-none px-4 text-white btn-sm"
                >
                    Save
                </button>
            </div>
        </div>
    </div>

    <!-- Contact Item Editing Modal -->
    <div v-if="contactModalType" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="contactModalType = null"></div>
        <div class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl overflow-hidden z-10 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50 px-5 py-4">
                <h3 class="font-display font-bold text-slate-800 text-sm capitalize">
                    {{ currentContactIndex !== null ? 'Edit' : 'Add' }} {{ contactModalType }}
                </h3>
                <button type="button" @click="contactModalType = null" class="btn btn-ghost btn-circle btn-xs text-slate-400">
                    <X class="size-4" />
                </button>
            </div>

            <div class="p-5 space-y-4 text-sm">
                <!-- Phone input -->
                <div v-if="contactModalType === 'phone'" class="space-y-4">
                    <div class="form-control">
                        <label class="label text-xs font-semibold text-slate-700">Phone Number *</label>
                        <input v-model="contactForm.phone" type="text" class="input input-bordered input-sm rounded-lg" placeholder="e.g. +880 2 9876543" />
                    </div>
                    <div class="form-control">
                        <label class="label text-xs font-semibold text-slate-700">Label (Optional)</label>
                        <input v-model="contactForm.label" type="text" class="input input-bordered input-sm rounded-lg" placeholder="e.g. Hotline, Office, Sales, WhatsApp" />
                    </div>
                </div>

                <!-- Email input -->
                <div v-if="contactModalType === 'email'" class="space-y-4">
                    <div class="form-control">
                        <label class="label text-xs font-semibold text-slate-700">Email Address *</label>
                        <input v-model="contactForm.email" type="email" class="input input-bordered input-sm rounded-lg" placeholder="e.g. ops@mercury-bd.com" />
                    </div>
                    <div class="form-control">
                        <label class="label text-xs font-semibold text-slate-700">Label (Optional)</label>
                        <input v-model="contactForm.label" type="text" class="input input-bordered input-sm rounded-lg" placeholder="e.g. General Inquiry, Sales Desk" />
                    </div>
                </div>

                <!-- Address input -->
                <div v-if="contactModalType === 'address'" class="space-y-4">
                    <div class="form-control">
                        <label class="label text-xs font-semibold text-slate-700">Office Name / Title (Optional)</label>
                        <input v-model="contactForm.name" type="text" class="input input-bordered input-sm rounded-lg" placeholder="e.g. Corporate Head Office, Chittagong Port Desk" />
                    </div>
                    <div class="form-control">
                        <label class="label text-xs font-semibold text-slate-700">Office Address *</label>
                        <textarea v-model="contactForm.address" class="textarea textarea-bordered rounded-lg h-20 text-xs" placeholder="Full address string"></textarea>
                    </div>
                    <div class="form-control">
                        <label class="label text-xs font-semibold text-slate-700">Google Maps URL (Optional)</label>
                        <input v-model="contactForm.map_url" type="url" class="input input-bordered input-sm rounded-lg" placeholder="https://maps.google.com/..." />
                    </div>
                </div>

                <div class="form-control flex flex-row items-center gap-2 pt-2">
                    <input type="checkbox" v-model="contactForm.is_active" id="contact_is_active" class="checkbox rounded checkbox-sm checkbox-primary" />
                    <label for="contact_is_active" class="cursor-pointer text-xs text-slate-600">Enabled / Display on Footer</label>
                </div>
            </div>

            <div class="flex justify-end gap-2 border-t border-slate-100 bg-slate-50 px-5 py-3">
                <button type="button" @click="contactModalType = null" class="btn rounded-lg btn-ghost btn-sm">Cancel</button>
                <button type="button" @click="saveContactItem" class="bg-amber hover:bg-amber-dark btn rounded-lg border-none px-4 text-white btn-sm">Save</button>
            </div>
        </div>
    </div>
</template>
