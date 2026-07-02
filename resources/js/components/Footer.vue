<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { Mail, Phone, MapPin } from '@lucide/vue';
import { computed } from 'vue';

const page = usePage();
const settings = computed(() => (page.props.settings as Record<string, any>) || {});

const currentYear = computed(() => new Date().getFullYear());
</script>

<template>
    <footer class="bg-neutral text-neutral-content border-t border-neutral-content/10 font-body relative overflow-hidden">
        <!-- Subtly styled background route decoration -->
        <div class="absolute inset-0 opacity-[0.02] pointer-events-none">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <line x1="0" y1="50%" x2="100%" y2="50%" stroke="currentColor" stroke-width="2" stroke-dasharray="12,12" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-16 pb-8 relative z-10">
            <!-- 4-Column Layout Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 pb-12">
                <!-- Column 1: Company Info -->
                <div class="space-y-4">
                    <span class="font-mono text-xs uppercase tracking-widest text-amber">MB · GLOBAL / OFFICE INFO</span>
                    <h3 class="text-neutral-content font-bold font-display text-xl tracking-wide">
                        {{ settings.company_name || 'Mercury Bangladesh' }}
                    </h3>
                    <p class="text-sm text-neutral-content/70 leading-relaxed max-w-xs">
                        {{ settings.company_tagline || 'Your better choice for any shipping need.' }}
                    </p>
                    <!-- Social Links -->
                    <div class="flex items-center gap-4 pt-2">
                        <a 
                            v-if="settings.social_linkedin" 
                            :href="settings.social_linkedin" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="p-2 bg-neutral-content/5 hover:bg-amber hover:text-white rounded-md text-neutral-content transition-colors duration-150 ease-in-out"
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
                            class="p-2 bg-neutral-content/5 hover:bg-amber hover:text-white rounded-md text-neutral-content transition-colors duration-150 ease-in-out"
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
                    <h4 class="text-neutral-content font-semibold font-display text-sm uppercase tracking-wider mb-5">Quick Links</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <Link href="/" class="hover:text-amber hover:underline transition-colors duration-150 ease-in-out">Home</Link>
                        </li>
                        <li>
                            <Link href="/about" class="hover:text-amber hover:underline transition-colors duration-150 ease-in-out">About Us</Link>
                        </li>
                        <li>
                            <Link href="/services" class="hover:text-amber hover:underline transition-colors duration-150 ease-in-out">Services</Link>
                        </li>
                        <li>
                            <Link href="/contact" class="hover:text-amber hover:underline transition-colors duration-150 ease-in-out">Contact</Link>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Logistics Services -->
                <div>
                    <h4 class="text-neutral-content font-semibold font-display text-sm uppercase tracking-wider mb-5">Our Services</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <Link href="/services" class="hover:text-amber hover:underline transition-colors duration-150 ease-in-out">Sea Freight</Link>
                        </li>
                        <li>
                            <Link href="/services" class="hover:text-amber hover:underline transition-colors duration-150 ease-in-out">Air Freight</Link>
                        </li>
                        <li>
                            <Link href="/services" class="hover:text-amber hover:underline transition-colors duration-150 ease-in-out">Land / Inland Transport</Link>
                        </li>
                        <li>
                            <Link href="/services" class="hover:text-amber hover:underline transition-colors duration-150 ease-in-out">Warehousing & Distribution</Link>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Contact Information -->
                <div class="space-y-4">
                    <h4 class="text-neutral-content font-semibold font-display text-sm uppercase tracking-wider mb-5">Head Office</h4>
                    <ul class="space-y-3.5 text-sm text-neutral-content/70">
                        <li class="flex items-start gap-3">
                            <MapPin class="size-5 text-amber shrink-0 mt-0.5" />
                            <span class="leading-relaxed">{{ settings.contact_address || 'Dhaka, Bangladesh' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <Phone class="size-4 text-amber shrink-0" />
                            <span>{{ settings.contact_phone || '+880 2 9876543' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <Mail class="size-4 text-amber shrink-0" />
                            <a :href="`mailto:${settings.contact_email || 'ops@mercury-bd.com'}`" class="hover:text-amber transition-colors duration-150 ease-in-out">
                                {{ settings.contact_email || 'ops@mercury-bd.com' }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom bar -->
            <div class="pt-8 border-t border-neutral-content/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-mono uppercase text-neutral-content/50">
                <span>© {{ currentYear }} {{ settings.company_name || 'Mercury Bangladesh (Pvt.) Ltd.' }} All rights reserved.</span>
                <span class="tracking-widest text-[10px] text-neutral-content/75">PRECISE · CALM · DEPENDABLE</span>
            </div>
        </div>
    </footer>
</template>

