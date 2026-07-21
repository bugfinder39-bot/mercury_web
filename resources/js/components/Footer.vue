<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { Mail, Phone, MapPin, Send } from '@lucide/vue';
import { computed, ref, onMounted, onUnmounted } from 'vue';

const page = usePage();
const settings = computed(() => (page.props.settings as Record<string, any>) || {});

const currentYear = computed(() => new Date().getFullYear());

// Viewport observer for scroll animation
const footerRef = ref<HTMLElement | null>(null);
const isVisible = ref(false);
let observer: IntersectionObserver | null = null;

onMounted(() => {
    observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                isVisible.value = true;
                observer?.disconnect();
            }
        });
    }, { threshold: 0.05 });

    if (footerRef.value) {
        observer.observe(footerRef.value);
    }
});

onUnmounted(() => {
    observer?.disconnect();
});

// Decode JSON array helpers
const parsedQuickLinks = computed(() => {
    try {
        const val = settings.value.footer_quick_links;

        if (!val) {
return [];
}

        const links = typeof val === 'string' ? JSON.parse(val) : val;

        return Array.isArray(links) ? links : [];
    } catch {
        return [];
    }
});

const parsedServices = computed(() => {
    try {
        const val = settings.value.footer_services;

        if (!val) {
return [];
}

        const links = typeof val === 'string' ? JSON.parse(val) : val;

        return Array.isArray(links) ? links : [];
    } catch {
        return [];
    }
});

const parsedSocials = computed(() => {
    try {
        const val = settings.value.footer_socials;

        if (!val) {
return [];
}

        const socials = typeof val === 'string' ? JSON.parse(val) : val;

        return Array.isArray(socials) ? socials : [];
    } catch {
        return [];
    }
});

// Computed variables for styles
const footerStyles = computed(() => {
    const bgStyle = settings.value.footer_bg_style || 'navy-gradient';
    const bg = settings.value.footer_bg || '#0B2540';
    const text = settings.value.footer_paragraph_color || settings.value.footer_text || 'rgba(255,255,255,0.7)';
    const heading = settings.value.footer_heading_color || '#FFFFFF';
    
    // Quick Links Colors
    const quickLinksColor = settings.value.footer_quick_links_color || settings.value.footer_link_color || 'rgba(255,255,255,0.65)';
    const quickLinksHover = settings.value.footer_quick_links_hover_color || settings.value.footer_link_hover_color || '#E8770C';
    
    // Services Colors
    const servicesLinksColor = settings.value.footer_services_links_color || settings.value.footer_link_color || 'rgba(255,255,255,0.65)';
    const servicesHover = settings.value.footer_services_hover_color || settings.value.footer_link_hover_color || '#E8770C';
    
    // Newsletter Colors
    const newsletterHeading = settings.value.footer_newsletter_heading_color || heading;
    const newsletterDesc = settings.value.footer_newsletter_description_color || text;
    const newsletterBg = settings.value.footer_newsletter_bg || 'rgba(255,255,255,0.06)';
    const newsletterInputBg = settings.value.footer_newsletter_input_bg || 'rgba(255,255,255,0.06)';
    const newsletterInputBorder = settings.value.footer_newsletter_input_border || 'rgba(255,255,255,0.08)';
    const newsletterInputText = settings.value.footer_newsletter_input_text_color || '#FFFFFF';
    const newsletterPlaceholder = settings.value.footer_newsletter_placeholder_color || 'rgba(255,255,255,0.4)';
    const newsletterBtnBg = settings.value.footer_newsletter_btn_bg || '#E8770C';
    // Backwards compatibility fallback for btn text color
    const newsletterBtnText = settings.value.footer_newsletter_btn_hover_text_color || settings.value.footer_newsletter_btn_text_color || settings.value.footer_newsletter_btn_text || '#FFFFFF';
    const newsletterBtnHoverBg = settings.value.footer_newsletter_btn_hover_bg || '#CC6608';
    const newsletterBtnShadow = settings.value.footer_newsletter_btn_shadow || 'light';

    // Divider Colors
    const borderColor = settings.value.footer_border_color || 'rgba(255,255,255,0.08)';

    // Icon Styles
    const iconStyle = settings.value.footer_icon_style || 'circle';
    const iconBg = settings.value.footer_icon_bg || 'rgba(232, 119, 12, 0.12)';
    const iconColor = settings.value.footer_icon_color || '#E8770C';
    const iconHoverBg = settings.value.footer_icon_hover_bg || '#E8770C';
    const iconHoverColor = settings.value.footer_icon_hover_color || '#FFFFFF';
    const iconBorderColor = settings.value.footer_icon_border_color || '#E8770C';
    const iconShadow = settings.value.footer_icon_shadow || 'light';

    // Social Media Icons
    const socialBg = settings.value.footer_social_icon_bg || 'rgba(232, 119, 12, 0.12)';
    const socialColor = settings.value.footer_social_icon_color || '#E8770C';
    const socialHoverBg = settings.value.footer_social_hover_bg || '#E8770C';
    const socialHoverColor = settings.value.footer_social_hover_color || '#FFFFFF';
    const socialBorder = settings.value.footer_social_border_color || 'transparent';
    const socialShadow = settings.value.footer_social_shadow || 'light';

    // Gaps
    const columnGap = settings.value.footer_column_gap || '3rem';
    const sectionGap = settings.value.footer_section_gap || '4rem';

    let backgroundVal = bg;
    let borderTopStyle = undefined;

    if (bgStyle === 'solid-white') {
        backgroundVal = '#FFFFFF';
    } else if (bgStyle === 'solid-navy') {
        backgroundVal = '#0B2540';
    } else if (bgStyle === 'white-navy-accents') {
        backgroundVal = 'radial-gradient(circle at top right, rgba(11, 37, 64, 0.03) 0%, #FFFFFF 100%)';
    } else if (bgStyle === 'white-orange-lines') {
        backgroundVal = '#FFFFFF';
        borderTopStyle = '3px solid #E8770C';
    } else if (bgStyle === 'navy-gradient') {
        backgroundVal = `linear-gradient(180deg, ${bg} 0%, #091C30 100%)`;
    } else if (bgStyle === 'white-gradient') {
        backgroundVal = `linear-gradient(180deg, #FFFFFF 0%, rgba(11, 37, 64, 0.05) 100%)`;
    }

    return {
        'background': backgroundVal,
        'border-top': borderTopStyle,
        'color': text,
        'padding-top': settings.value.footer_top_padding || '80px',
        'padding-bottom': settings.value.footer_bottom_padding || '40px',
        'font-weight': settings.value.footer_font_weight || '400',
        
        // CSS Custom properties
        '--footer-text-color': text,
        '--footer-secondary-color': settings.value.footer_secondary_text_color || '#94A3B8',
        '--footer-heading-color': heading,
        '--footer-quick-links-color': quickLinksColor,
        '--footer-quick-links-hover-color': quickLinksHover,
        '--footer-services-links-color': servicesLinksColor,
        '--footer-services-hover-color': servicesHover,
        '--footer-newsletter-heading-color': newsletterHeading,
        '--footer-newsletter-description-color': newsletterDesc,
        '--footer-newsletter-bg': newsletterBg,
        '--footer-newsletter-input-bg': newsletterInputBg,
        '--footer-newsletter-input-border': newsletterInputBorder,
        '--footer-newsletter-input-text': newsletterInputText,
        '--footer-newsletter-placeholder': newsletterPlaceholder,
        '--footer-newsletter-btn-bg': newsletterBtnBg,
        '--footer-newsletter-btn-hover-bg': newsletterBtnHoverBg,
        '--footer-newsletter-btn-text': newsletterBtnText,
        '--footer-newsletter-btn-shadow': newsletterBtnShadow === 'none' ? 'none' : newsletterBtnShadow === 'light' ? '0 2px 4px rgba(0,0,0,0.1)' : newsletterBtnShadow === 'medium' ? '0 4px 8px rgba(0,0,0,0.15)' : '0 8px 16px rgba(0,0,0,0.25)',
        '--footer-border-color': borderColor,
        '--footer-copyright-color': settings.value.footer_copyright_color || 'rgba(255,255,255,0.4)',
        '--footer-bottom-bg': settings.value.footer_bottom_bg || 'transparent',
        '--footer-bottom-tagline-color': settings.value.footer_bottom_tagline_color || '#E8770C',

        // Icons
        '--footer-icon-style': iconStyle,
        '--footer-icon-bg': iconBg,
        '--footer-icon-color': iconColor,
        '--footer-icon-hover-bg': iconHoverBg,
        '--footer-icon-hover-color': iconHoverColor,
        '--footer-icon-border-color': iconBorderColor,
        '--footer-icon-shadow': iconShadow === 'none' ? 'none' : iconShadow === 'light' ? '0 2px 4px rgba(0,0,0,0.05)' : iconShadow === 'medium' ? '0 4px 8px rgba(0,0,0,0.1)' : '0 8px 16px rgba(0,0,0,0.15)',

        // Socials
        '--footer-social-bg': socialBg,
        '--footer-social-color': socialColor,
        '--footer-social-hover-bg': socialHoverBg,
        '--footer-social-hover-color': socialHoverColor,
        '--footer-social-border': socialBorder,
        '--footer-social-shadow': socialShadow === 'none' ? 'none' : socialShadow === 'light' ? '0 2px 4px rgba(0,0,0,0.05)' : socialShadow === 'medium' ? '0 4px 8px rgba(0,0,0,0.1)' : '0 8px 16px rgba(0,0,0,0.15)',

        // Gaps
        '--footer-column-gap': columnGap,
        '--footer-section-gap': sectionGap,
    };
});

const contactBarDividerStyles = computed(() => {
    const style = settings.value.footer_divider_style || 'thin-accent';
    const color = footerStyles.value['--footer-border-color'];

    if (style === 'orange') {
        return {
            borderTop: '1px solid #E8770C',
            borderBottom: '1px solid #E8770C',
        };
    } else if (style === 'navy') {
        return {
            borderTop: '1px solid #0B2540',
            borderBottom: '1px solid #0B2540',
        };
    } else if (style === 'gradient') {
        return {
            borderStyle: 'solid none',
            borderTopWidth: '1px',
            borderBottomWidth: '1px',
            borderImage: 'linear-gradient(to right, transparent, #E8770C 20%, #E8770C 80%, transparent) 1',
        };
    } else if (style === 'double') {
        return {
            borderTop: `3px double ${color}`,
            borderBottom: `3px double ${color}`,
        };
    }

    // default thin-accent
    return {
        borderTop: `1px solid ${color}`,
        borderBottom: `1px solid ${color}`,
    };
});

const topLineStyle = computed(() => {
    const style = settings.value.footer_divider_style || 'thin-accent';
    const color = footerStyles.value['--footer-border-color'];

    if (style === 'orange') {
        return { background: '#E8770C', height: '3px' };
    } else if (style === 'navy') {
        return { background: '#0B2540', height: '3px' };
    } else if (style === 'gradient') {
        return { background: 'linear-gradient(to right, transparent, #E8770C 20%, #E8770C 80%, transparent)', height: '3px' };
    } else if (style === 'double') {
        return { borderTop: `3px double ${color}`, background: 'transparent', height: '3px' };
    }

    // default thin-accent
    return { background: color, height: '1px' };
});

const circleAccentStyle = computed(() => {
    const bgStyle = settings.value.footer_bg_style || 'navy-gradient';
    const isDark = bgStyle === 'solid-navy' || bgStyle === 'navy-gradient';
    const accentColor = isDark ? '#E8770C' : '#0B2540';
    const opacity = isDark ? '0.03' : '0.015';

    return {
        background: `radial-gradient(circle, ${accentColor}, transparent)`,
        opacity: opacity,
    };
});

const iconContainerClasses = computed(() => {
    const style = settings.value.footer_icon_style || 'circle';
    let shapeClass = 'rounded-full';

    if (style === 'square') {
        shapeClass = 'rounded-xl';
    }

    return `flex items-center justify-center shrink-0 transition-all duration-300 ${shapeClass}`;
});

const iconContainerStyles = computed(() => {
    const style = settings.value.footer_icon_style || 'circle';
    const bg = footerStyles.value['--footer-icon-bg'];
    const color = footerStyles.value['--footer-icon-color'];
    const borderColor = footerStyles.value['--footer-icon-border-color'];
    const shadow = footerStyles.value['--footer-icon-shadow'];

    const customStyles = {
        backgroundColor: bg,
        color: color,
        boxShadow: shadow,
        border: '1px solid transparent',
    } as Record<string, any>;

    if (style === 'orange-gradient') {
        customStyles.background = 'linear-gradient(135deg, #E8770C 0%, #CC6608 100%)';
        customStyles.color = '#FFFFFF';
    } else if (style === 'navy-outline') {
        customStyles.backgroundColor = 'transparent';
        customStyles.border = '2px solid #0B2540';
        customStyles.color = '#0B2540';
    } else if (style === 'circle' || style === 'square') {
        customStyles.border = `1px solid ${borderColor || 'transparent'}`;
    }

    return customStyles;
});

const footerClasses = computed(() => {
    const anim = settings.value.footer_animation_style || 'none';
    const classes = [];

    if (anim === 'footer-reveal') {
        classes.push('md:sticky md:bottom-0 md:z-[-10]');
    }
    
    if (anim === 'slide-up') {
        if (isVisible.value) {
            classes.push('opacity-100 translate-y-0');
        } else {
            classes.push('opacity-0 translate-y-8 pointer-events-none');
        }
    } else if (anim === 'fade-in') {
        if (isVisible.value) {
            classes.push('opacity-100');
        } else {
            classes.push('opacity-0 pointer-events-none');
        }
    }

    return classes.join(' ');
});

</script>

<template>
    <footer
        ref="footerRef"
        :class="['transition-all duration-1000 ease-out', footerClasses]"
        :style="footerStyles"
    >
        <!-- Top accent line -->
        <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-[#E8770C] via-[#123A5E] to-[#E8770C] z-20"></div>

        <!-- Decorative geometric background -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <!-- Large decorative circle -->
            <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full transition-all duration-1000" :style="circleAccentStyle"></div>
            <div class="absolute -bottom-48 -left-24 w-80 h-80 rounded-full transition-all duration-1000" :style="circleAccentStyle"></div>
            <!-- Grid lines -->
            <svg class="w-full h-full opacity-[0.015]" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <line x1="0" y1="30%" x2="100%" y2="30%" stroke="white" stroke-width="1" stroke-dasharray="10,10" />
                <line x1="0" y1="70%" x2="100%" y2="70%" stroke="white" stroke-width="1" stroke-dasharray="10,10" />
                <line x1="30%" y1="0" x2="30%" y2="100%" stroke="white" stroke-width="1" stroke-dasharray="10,10" />
                <line x1="70%" y1="0" x2="70%" y2="100%" stroke="white" stroke-width="1" stroke-dasharray="10,10" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Main Grid: 4-columns layout -->
            <div 
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 transition-all duration-500" 
                :style="{ columnGap: footerStyles['--footer-column-gap'], paddingBottom: footerStyles['--footer-section-gap'] }"
            >
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
                            class="footer-social-link p-2.5 rounded-full"
                            :style="{ 
                                backgroundColor: footerStyles['--footer-social-bg'], 
                                color: footerStyles['--footer-social-color'],
                                borderColor: footerStyles['--footer-social-border'],
                                boxShadow: footerStyles['--footer-social-shadow']
                            }"
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
                        class="font-semibold font-display text-sm uppercase tracking-wider mb-6 animate-slide" 
                        :style="{ color: footerStyles['--footer-heading-color'] }"
                    >
                        Quick Links
                    </h4>
                    <ul class="space-y-3.5 text-sm">
                        <li v-for="link in parsedQuickLinks.filter((x: any) => x.is_active)" :key="link.name">
                            <Link
                                :href="link.href"
                                :class="['transition-all duration-300 flex items-center gap-2 group', 'hover-effect-' + (settings.footer_link_hover_effect || 'underline')]"
                                :style="{ color: footerStyles['--footer-quick-links-color'] }"
                                @mouseover="(e: any) => (e.target as HTMLElement).style.color = footerStyles['--footer-quick-links-hover-color']"
                                @mouseleave="(e: any) => (e.target as HTMLElement).style.color = footerStyles['--footer-quick-links-color']"
                            >
                                <span v-if="settings.footer_link_hover_effect === 'arrow'" class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-xs">→</span>
                                <span v-else class="w-1.5 h-1.5 rounded-full scale-0 group-hover:scale-100 transition-transform duration-200" :style="{ backgroundColor: footerStyles['--footer-quick-links-hover-color'] }"></span>
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
                                :class="['transition-all duration-300 flex items-center gap-2 group', 'hover-effect-' + (settings.footer_link_hover_effect || 'underline')]"
                                :style="{ color: footerStyles['--footer-services-links-color'] }"
                                @mouseover="(e: any) => (e.target as HTMLElement).style.color = footerStyles['--footer-services-hover-color']"
                                @mouseleave="(e: any) => (e.target as HTMLElement).style.color = footerStyles['--footer-services-links-color']"
                            >
                                <span v-if="settings.footer_link_hover_effect === 'arrow'" class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-xs">→</span>
                                <span v-else class="w-1.5 h-1.5 rounded-full scale-0 group-hover:scale-100 transition-transform duration-200" :style="{ backgroundColor: footerStyles['--footer-services-hover-color'] }"></span>
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
                            :style="{ color: footerStyles['--footer-newsletter-heading-color'] }"
                        >
                            {{ settings.footer_newsletter_title || 'Newsletter' }}
                        </h4>
                        <p class="text-xs leading-relaxed" :style="{ color: footerStyles['--footer-newsletter-description-color'] }">
                            {{ settings.footer_newsletter_desc }}
                        </p>
                    </div>
                    <form @submit.prevent class="relative flex items-center">
                        <input
                            type="email"
                            placeholder="Enter your email"
                            class="w-full text-xs py-3.5 pl-4 pr-12 rounded-full border outline-none transition-all duration-300 footer-newsletter-input"
                            :style="{ 
                                backgroundColor: footerStyles['--footer-newsletter-input-bg'], 
                                borderColor: footerStyles['--footer-newsletter-input-border'],
                                color: footerStyles['--footer-newsletter-input-text']
                            }"
                            required
                        />
                        <button
                            type="submit"
                            class="footer-newsletter-btn absolute right-1.5 p-2.5 rounded-full transition-all duration-300"
                            :style="{ 
                                backgroundColor: footerStyles['--footer-newsletter-btn-bg'], 
                                color: footerStyles['--footer-newsletter-btn-text'],
                                boxShadow: footerStyles['--footer-newsletter-btn-shadow']
                            }"
                            aria-label="Subscribe"
                        >
                            <Send class="size-3.5" />
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact/Address Horizontal Bar -->
            <div 
                class="py-8 flex flex-col lg:flex-row gap-6 justify-between items-start lg:items-center text-sm"
                :style="contactBarDividerStyles"
            >
                <div class="flex items-center gap-3 group">
                    <div :class="iconContainerClasses" :style="iconContainerStyles" class="footer-info-icon p-2.5">
                        <MapPin class="size-4" />
                    </div>
                    <div>
                        <p class="text-[10px] font-mono uppercase tracking-wider" :style="{ color: footerStyles['--footer-secondary-color'], opacity: 0.7 }">Office Location</p>
                        <p class="font-semibold" :style="{ color: footerStyles['--footer-heading-color'] }">
                            {{ settings.footer_address || 'Dhaka, Bangladesh' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3 group">
                    <div :class="iconContainerClasses" :style="iconContainerStyles" class="footer-info-icon p-2.5">
                        <Phone class="size-4" />
                    </div>
                    <div>
                        <p class="text-[10px] font-mono uppercase tracking-wider" :style="{ color: footerStyles['--footer-secondary-color'], opacity: 0.7 }">Call Desk</p>
                        <p class="font-semibold" :style="{ color: footerStyles['--footer-heading-color'] }">
                            {{ settings.footer_phone || '+880 2 9876543' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3 group">
                    <div :class="iconContainerClasses" :style="iconContainerStyles" class="footer-info-icon p-2.5">
                        <Mail class="size-4" />
                    </div>
                    <div>
                        <p class="text-[10px] font-mono uppercase tracking-wider" :style="{ color: footerStyles['--footer-secondary-color'], opacity: 0.7 }">Email Inquiry</p>
                        <p class="font-semibold">
                            <a :href="`mailto:${settings.footer_email || 'ops@mercury-bd.com'}`" class="transition-colors duration-200" :style="{ color: footerStyles['--footer-heading-color'] }" @mouseover="(e: any) => (e.target as HTMLElement).style.color = footerStyles['--footer-quick-links-hover-color']" @mouseleave="(e: any) => (e.target as HTMLElement).style.color = footerStyles['--footer-heading-color']">
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
                <span class="tracking-widest text-[10px]" :style="{ color: footerStyles['--footer-bottom-tagline-color'] }">
                    {{ settings.footer_tagline || 'PRECISE · CALM · DEPENDABLE' }}
                </span>
            </div>
        </div>
    </footer>
</template>

<style scoped>
/* Social link custom styles & micro-interactions */
.footer-social-link {
    border: 1px solid var(--footer-social-border);
    box-shadow: var(--footer-social-shadow);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.footer-social-link:hover {
    background-color: var(--footer-social-hover-bg) !important;
    color: var(--footer-social-hover-color) !important;
    border-color: var(--footer-social-hover-bg) !important;
    transform: translateY(-4px) rotate(360deg);
    box-shadow: 0 6px 20px rgba(232, 119, 12, 0.4);
}

/* Info custom styles & micro-interactions */
.footer-info-icon {
    transition: all 0.3s ease;
}
.group:hover .footer-info-icon {
    background-color: var(--footer-icon-hover-bg) !important;
    color: var(--footer-icon-hover-color) !important;
    border-color: var(--footer-icon-hover-bg) !important;
    transform: scale(1.1) rotate(5deg);
}

/* Newsletter Input focus and placeholder customization */
.footer-newsletter-input:focus {
    border-color: #E8770C !important;
    box-shadow: 0 0 12px rgba(232, 119, 12, 0.25) !important;
}
.footer-newsletter-input::placeholder {
    color: var(--footer-newsletter-placeholder) !important;
    opacity: 1;
}

/* Newsletter Button hover */
.footer-newsletter-btn:hover {
    background-color: var(--footer-newsletter-btn-hover-bg) !important;
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 4px 16px rgba(232, 119, 12, 0.4);
}
.footer-newsletter-btn:active {
    transform: scale(0.95);
}


/* Link hovers customization */
.hover-effect-color {
    transition: color 0.25s ease;
}

.hover-effect-slide {
    transition: transform 0.25s ease, color 0.25s ease;
}
.hover-effect-slide:hover {
    transform: translateX(6px);
}

.hover-effect-arrow {
    transition: transform 0.25s ease, color 0.25s ease;
}
.hover-effect-arrow:hover {
    transform: translateX(4px);
}

.hover-effect-underline {
    position: relative;
    transition: color 0.25s ease;
}
.hover-effect-underline::after {
    content: '';
    position: absolute;
    width: 100%;
    transform: scaleX(0);
    height: 1px;
    bottom: -2px;
    left: 0;
    background-color: var(--footer-link-hover-color);
    transform-origin: bottom right;
    transition: transform 0.25s ease-out;
}
.hover-effect-underline:hover::after {
    transform: scaleX(1);
    transform-origin: bottom left;
}
</style>
