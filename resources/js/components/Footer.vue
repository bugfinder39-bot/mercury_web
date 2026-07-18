<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { Mail, Phone, MapPin } from '@lucide/vue';
import { computed } from 'vue';

const page = usePage();
const settings = computed(() => (page.props.settings as Record<string, any>) || {});

const currentYear = computed(() => new Date().getFullYear());
</script>

<template>
    <footer
        class="font-body relative overflow-hidden"
        style="background-color: #0B2540; color: rgba(255,255,255,0.85); box-shadow: 0 -2px 20px rgba(11,37,64,0.25);"
    >
        <!-- Subtle geometric background decoration -->
        <div class="absolute inset-0 pointer-events-none opacity-[0.03]">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <line x1="0" y1="50%" x2="100%" y2="50%" stroke="white" stroke-width="1" stroke-dasharray="8,8" />
                <line x1="50%" y1="0" x2="50%" y2="100%" stroke="white" stroke-width="1" stroke-dasharray="8,8" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-16 pb-8 relative z-10">
            <!-- 4-Column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 pb-12">

                <!-- Column 1: Company Info -->
                <div class="space-y-5">
                    <div>
                        <span class="font-mono text-xs uppercase tracking-widest" style="color: #E8770C;">Mercury Bangladesh</span>
                        <h3 class="text-white font-bold font-display text-2xl uppercase tracking-wider mt-2">
                            {{ settings.company_name || 'Mercury Bangladesh' }}
                        </h3>
                    </div>
                    <p class="text-sm leading-relaxed max-w-xs" style="color: rgba(255,255,255,0.60);">
                        {{ settings.company_tagline || 'Your better choice for any shipping need.' }}
                    </p>
                    <!-- Social Links -->
                    <div class="flex items-center gap-3 pt-1">
                        <a
                            v-if="settings.social_linkedin"
                            :href="settings.social_linkedin"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-2.5 rounded-lg transition-all duration-200"
                            style="background-color: rgba(255,255,255,0.08); color: rgba(255,255,255,0.70);"
                            onmouseover="this.style.backgroundColor='#E8770C'; this.style.color='#fff';"
                            onmouseout="this.style.backgroundColor='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.70)';"
                            aria-label="LinkedIn"
                        >
                            <svg class="size-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a
                            v-if="settings.social_facebook"
                            :href="settings.social_facebook"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-2.5 rounded-lg transition-all duration-200"
                            style="background-color: rgba(255,255,255,0.08); color: rgba(255,255,255,0.70);"
                            onmouseover="this.style.backgroundColor='#E8770C'; this.style.color='#fff';"
                            onmouseout="this.style.backgroundColor='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.70)';"
                            aria-label="Facebook"
                        >
                            <svg class="size-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="text-white font-semibold font-display text-sm uppercase tracking-wider mb-6">Quick Links</h4>
                    <ul class="space-y-3 text-sm">
                        <li v-for="(link, label) in { 'Home': '/', 'About Us': '/about', 'Services': '/services', 'Contact': '/contact' }" :key="label">
                            <Link
                                :href="link"
                                class="transition-colors duration-150 flex items-center gap-2 group"
                                style="color: rgba(255,255,255,0.65);"
                                onmouseover="this.style.color='#E8770C';"
                                onmouseout="this.style.color='rgba(255,255,255,0.65)';"
                            >
                                <span class="w-1 h-1 rounded-full transition-colors duration-150" style="background-color: #E8770C; opacity: 0.5;"></span>
                                {{ label }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Our Services -->
                <div>
                    <h4 class="text-white font-semibold font-display text-sm uppercase tracking-wider mb-6">Our Services</h4>
                    <ul class="space-y-3 text-sm">
                        <li v-for="service in ['Sea Freight', 'Air Freight', 'Land / Inland Transport', 'Warehousing & Distribution']" :key="service">
                            <Link
                                href="/services"
                                class="transition-colors duration-150 flex items-center gap-2"
                                style="color: rgba(255,255,255,0.65);"
                                onmouseover="this.style.color='#E8770C';"
                                onmouseout="this.style.color='rgba(255,255,255,0.65)';"
                            >
                                <span class="w-1 h-1 rounded-full" style="background-color: #E8770C; opacity: 0.5;"></span>
                                {{ service }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Contact Information -->
                <div class="space-y-5">
                    <h4 class="text-white font-semibold font-display text-sm uppercase tracking-wider mb-6">Head Office</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <MapPin class="size-5 shrink-0 mt-0.5" style="color: #E8770C;" />
                            <span class="leading-relaxed" style="color: rgba(255,255,255,0.65);">{{ settings.contact_address || 'Dhaka, Bangladesh' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <Phone class="size-4 shrink-0" style="color: #E8770C;" />
                            <span style="color: rgba(255,255,255,0.65);">{{ settings.contact_phone || '+880 2 9876543' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <Mail class="size-4 shrink-0" style="color: #E8770C;" />
                            <a
                                :href="`mailto:${settings.contact_email || 'ops@mercury-bd.com'}`"
                                class="transition-colors duration-150"
                                style="color: rgba(255,255,255,0.65);"
                                onmouseover="this.style.color='#E8770C';"
                                onmouseout="this.style.color='rgba(255,255,255,0.65)';"
                            >
                                {{ settings.contact_email || 'ops@mercury-bd.com' }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div
                class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-mono uppercase"
                style="border-top: 1px solid rgba(255,255,255,0.10); color: rgba(255,255,255,0.45);"
            >
                <span>© {{ currentYear }} {{ settings.company_name || 'Mercury Bangladesh (Pvt.) Ltd.' }} All rights reserved.</span>
                <span class="tracking-widest text-[10px]" style="color: #E8770C; opacity: 0.75;">PRECISE · CALM · DEPENDABLE</span>
            </div>
        </div>
    </footer>
</template>
