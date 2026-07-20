<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { Mail, Phone, MapPin, Send } from '@lucide/vue';
import { computed } from 'vue';

const page = usePage();
const settings = computed(() => (page.props.settings as Record<string, any>) || {});

const currentYear = computed(() => new Date().getFullYear());

// Decode JSON array helpers
const parsedQuickLinks = computed(() => {
    try {
        const val = settings.value.footer_quick_links;
        if (!val) return [];
        const links = typeof val === 'string' ? JSON.parse(val) : val;
        return Array.isArray(links) ? links : [];
    } catch (e) {
        return [];
    }
});

const parsedServices = computed(() => {
    try {
        const val = settings.value.footer_services;
        if (!val) return [];
        const links = typeof val === 'string' ? JSON.parse(val) : val;
        return Array.isArray(links) ? links : [];
    } catch (e) {
        return [];
    }
});

const parsedSocials = computed(() => {
    try {
        const val = settings.value.footer_socials;
        if (!val) return [];
        const socials = typeof val === 'string' ? JSON.parse(val) : val;
        return Array.isArray(socials) ? socials : [];
    } catch (e) {
        return [];
    }
});

// Computed variables for styles
const footerStyles = computed(() => {
    return {
        'background-color': settings.value.footer_bg || '#FFFFFF',
        'color': settings.value.footer_text || '#475569',
        'padding-top': settings.value.footer_top_padding || '80px',
        'padding-bottom': settings.value.footer_bottom_padding || '40px',
        'font-weight': settings.value.footer_font_weight || '400',
        '--footer-text-color': settings.value.footer_text || '#475569',
        '--footer-heading-color': settings.value.footer_heading_color || '#0B2540',
        '--footer-link-color': settings.value.footer_link_color || '#475569',
        '--footer-link-hover-color': settings.value.footer_link_hover_color || '#E8770C',
        '--footer-icon-bg': settings.value.footer_icon_bg || '#F8FAFC',
        '--footer-icon-color': settings.value.footer_icon_color || '#123A5E',
        '--footer-border-color': settings.value.footer_border_color || '#F1F5F9',
        '--footer-newsletter-bg': settings.value.footer_newsletter_bg || '#F8FAFC',
        '--footer-newsletter-btn-bg': settings.value.footer_newsletter_btn_bg || '#E8770C',
        '--footer-newsletter-btn-text': settings.value.footer_newsletter_btn_text_color || '#FFFFFF',
        '--footer-copyright-color': settings.value.footer_copyright_color || '#94A3B8',
        '--footer-bottom-bg': settings.value.footer_bottom_bg || '#FFFFFF',
    };
});
</script>

<template>
    <footer
        class="font-body relative border-t"
        :style="footerStyles"
    >
        <!-- Subtle geometric background decoration using only primary navy opacity -->
        <div class="absolute inset-0 pointer-events-none opacity-[0.02]">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <line x1="0" y1="30%" x2="100%" y2="30%" :stroke="settings.footer_heading_color || '#0B2540'" stroke-width="1" stroke-dasharray="10,10" />
                <line x1="0" y1="70%" x2="100%" y2="70%" :stroke="settings.footer_heading_color || '#0B2540'" stroke-width="1" stroke-dasharray="10,10" />
                <line x1="30%" y1="0" x2="30%" y2="100%" :stroke="settings.footer_heading_color || '#0B2540'" stroke-width="1" stroke-dasharray="10,10" />
                <line x1="70%" y1="0" x2="70%" y2="100%" :stroke="settings.footer_heading_color || '#0B2540'" stroke-width="1" stroke-dasharray="10,10" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Main Grid: 4-columns layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 pb-16">

                <!-- Column 1: Company Logo & Tagline (span 4) -->
                <div class="lg:col-span-4 space-y-6">
                    <div>
                        <img 
                            v-if="settings.footer_logo" 
                            :src="settings.footer_logo" 
                            :alt="settings.footer_company_name || 'Mercury Logo'" 
                            class="h-10 w-auto mb-4" 
                        />
                        <h3 
                            v-else
                            class="font-bold font-display text-2xl uppercase tracking-wider mt-2"
                            :style="{ color: footerStyles['--footer-heading-color'] }"
                        >
                            {{ settings.footer_company_name || 'Mercury Bangladesh' }}
                        </h3>
                    </div>
                    <p class="text-sm leading-relaxed max-w-sm" :style="{ color: footerStyles['--footer-text-color'] }">
                        {{ settings.footer_description || 'Your better choice for any shipping and international logistics need.' }}
                    </p>
                    
                    <!-- Social Links -->
                    <div class="flex items-center gap-3 pt-2" v-if="parsedSocials.filter((s: any) => s.is_active && s.url).length > 0">
                        <a
                            v-for="social in parsedSocials.filter((s: any) => s.is_active && s.url)"
                            :key="social.platform"
                            :href="social.url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-2.5 rounded-full transition-all duration-300 border hover:opacity-90"
                            :style="{ 
                                backgroundColor: footerStyles['--footer-icon-bg'], 
                                color: footerStyles['--footer-icon-color'],
                                borderColor: footerStyles['--footer-border-color']
                            }"
                            @mouseover="e => { (e.currentTarget as HTMLElement).style.backgroundColor = footerStyles['--footer-link-hover-color']; (e.currentTarget as HTMLElement).style.color = '#fff'; }"
                            @mouseleave="e => { (e.currentTarget as HTMLElement).style.backgroundColor = footerStyles['--footer-icon-bg']; (e.currentTarget as HTMLElement).style.color = footerStyles['--footer-icon-color']; }"
                            :aria-label="social.platform"
                        >
                            <!-- Simple custom social icons or letters based on platform name -->
                            <span v-if="social.platform === 'linkedin'">
                                <svg class="size-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </span>
                            <span v-else-if="social.platform === 'facebook'">
                                <svg class="size-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </span>
                            <span v-else-if="social.platform === 'instagram'">
                                <svg class="size-4 fill-current" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </span>
                            <span v-else class="capitalize font-mono text-[9px] font-bold">{{ social.platform.charAt(0) }}</span>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links (span 2) -->
                <div class="lg:col-span-2">
                    <h4 
                        class="font-semibold font-display text-sm uppercase tracking-wider mb-6" 
                        :style="{ color: footerStyles['--footer-heading-color'] }"
                    >
                        Quick Links
                    </h4>
                    <ul class="space-y-3.5 text-sm">
                        <li v-for="link in parsedQuickLinks.filter((x: any) => x.is_active)" :key="link.name">
                            <Link
                                :href="link.href"
                                class="transition-colors duration-250 flex items-center gap-2 group"
                                :style="{ color: footerStyles['--footer-link-color'] }"
                                @mouseover="e => (e.target as HTMLElement).style.color = footerStyles['--footer-link-hover-color']"
                                @mouseleave="e => (e.target as HTMLElement).style.color = footerStyles['--footer-link-color']"
                            >
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E8770C] scale-0 group-hover:scale-100 transition-transform duration-200" :style="{ backgroundColor: footerStyles['--footer-link-hover-color'] }"></span>
                                {{ link.name }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Our Services (span 3) -->
                <div class="lg:col-span-3">
                    <h4 
                        class="font-semibold font-display text-sm uppercase tracking-wider mb-6" 
                        :style="{ color: footerStyles['--footer-heading-color'] }"
                    >
                        Services
                    </h4>
                    <ul class="space-y-3.5 text-sm">
                        <li v-for="link in parsedServices.filter((x: any) => x.is_active)" :key="link.name">
                            <Link
                                :href="link.href"
                                class="transition-colors duration-250 flex items-center gap-2 group"
                                :style="{ color: footerStyles['--footer-link-color'] }"
                                @mouseover="e => (e.target as HTMLElement).style.color = footerStyles['--footer-link-hover-color']"
                                @mouseleave="e => (e.target as HTMLElement).style.color = footerStyles['--footer-link-color']"
                            >
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E8770C] scale-0 group-hover:scale-100 transition-transform duration-200" :style="{ backgroundColor: footerStyles['--footer-link-hover-color'] }"></span>
                                {{ link.name }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Newsletter (span 3) -->
                <div class="lg:col-span-3 space-y-6" v-if="settings.footer_newsletter_active === 'true'">
                    <div>
                        <h4 
                            class="font-semibold font-display text-sm uppercase tracking-wider mb-3" 
                            :style="{ color: footerStyles['--footer-heading-color'] }"
                        >
                            {{ settings.footer_newsletter_title || 'Newsletter' }}
                        </h4>
                        <p class="text-xs leading-relaxed" :style="{ color: footerStyles['--footer-text-color'] }">
                            {{ settings.footer_newsletter_desc }}
                        </p>
                    </div>
                    <form @submit.prevent class="relative flex items-center">
                        <input
                            type="email"
                            placeholder="Enter your email"
                            class="w-full text-xs py-3 pl-4 pr-12 rounded-full border focus:ring-2 focus:ring-[#E8770C]/10 outline-none transition-all duration-300"
                            :style="{ 
                                backgroundColor: footerStyles['--footer-newsletter-bg'], 
                                color: footerStyles['--footer-heading-color'],
                                borderColor: footerStyles['--footer-border-color']
                            }"
                            required
                        />
                        <button
                            type="submit"
                            class="absolute right-1 p-2 rounded-full text-white transition-colors duration-300 hover:opacity-90"
                            :style="{ backgroundColor: footerStyles['--footer-newsletter-btn-bg'] }"
                            aria-label="Subscribe"
                        >
                            <Send class="size-3.5" />
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact/Address Horizontal Bar -->
            <div 
                class="py-8 border-t border-b flex flex-col lg:flex-row gap-6 justify-between items-start lg:items-center text-sm"
                :style="{ borderColor: footerStyles['--footer-border-color'] }"
            >
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-orange-50 text-[#E8770C]">
                        <MapPin class="size-4" />
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-mono uppercase tracking-wider">Office Location</p>
                        <p class="font-semibold" :style="{ color: footerStyles['--footer-heading-color'] }">
                            {{ settings.footer_address || 'Dhaka, Bangladesh' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-orange-50 text-[#E8770C]">
                        <Phone class="size-4" />
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-mono uppercase tracking-wider">Call Desk</p>
                        <p class="font-semibold" :style="{ color: footerStyles['--footer-heading-color'] }">
                            {{ settings.footer_phone || '+880 2 9876543' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-orange-50 text-[#E8770C]">
                        <Mail class="size-4" />
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-mono uppercase tracking-wider">Email Inquiry</p>
                        <p class="font-semibold">
                            <a :href="`mailto:${settings.footer_email || 'ops@mercury-bd.com'}`" class="transition-colors" :style="{ color: footerStyles['--footer-heading-color'] }" @mouseover="e => (e.target as HTMLElement).style.color = footerStyles['--footer-link-hover-color']" @mouseleave="e => (e.target as HTMLElement).style.color = footerStyles['--footer-heading-color']">
                                {{ settings.footer_email || 'ops@mercury-bd.com' }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Copyright Bar -->
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-mono uppercase">
                <span :style="{ color: footerStyles['--footer-copyright-color'] }">
                    © {{ currentYear }} {{ settings.footer_company_name || 'Mercury Bangladesh (Pvt.) Ltd.' }} All rights reserved.
                </span>
                <span class="tracking-widest text-[10px]" :style="{ color: footerStyles['--footer-link-hover-color'] }">
                    {{ settings.footer_tagline || 'PRECISE · CALM · DEPENDABLE' }}
                </span>
            </div>
        </div>
    </footer>
</template>
