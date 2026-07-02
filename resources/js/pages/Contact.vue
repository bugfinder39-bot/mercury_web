<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { MapPin, Phone, Mail, Clock } from '@lucide/vue';
import { computed } from 'vue';
import ContactForm from '@/components/ContactForm.vue';
import HeroBanner from '@/components/HeroBanner.vue';
import PublicLayout from '@/layouts/PublicLayout.vue';

const props = defineProps<{
    page: {
        id: number;
        name: string;
        slug: string;
        meta_title?: string;
        meta_description?: string;
    };
    sections: Array<{
        id: number;
        type: string;
        heading?: string;
        subheading?: string;
        body?: string;
        order: number;
        is_active: boolean;
        items?: any[];
    }>;
}>();

defineOptions({
    layout: PublicLayout,
});

const pageData = usePage();
const settings = computed(() => (pageData.props.settings as Record<string, any>) || {});

// Extract intro section
const introSection = computed(() => {
    return props.sections.find(s => s.type === 'intro');
});

// Extract hero section
const heroSection = computed(() => {
    return props.sections.find(s => s.type === 'hero_banner');
});
</script>

<template>
    <Head>
        <title>{{ page?.meta_title || 'Contact Us - Mercury Bangladesh' }}</title>
        <meta name="description" :content="page?.meta_description || 'Get in touch with our operations desk.'" />
    </Head>

    <div class="space-y-16 md:space-y-24 pb-24">
        <!-- Hero Banner Section -->
        <HeroBanner 
            v-if="heroSection" 
            :section="heroSection" 
        />

        <!-- Main Body Grid -->
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Side: Contact Form -->
            <div class="lg:col-span-7">
                <ContactForm />
            </div>

            <!-- Right Side: Contact Info & Map -->
            <div class="lg:col-span-5 space-y-8">
                <!-- Info Card -->
                <div v-if="introSection || settings" class="bg-base-100 border border-base-300 p-6 md:p-8 rounded-lg space-y-6">
                    
                    <div v-if="introSection" class="space-y-3">
                        <!-- Eyebrow -->
                        <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-base-content/70 uppercase">
                            {{ introSection.subheading || 'MB · 02 — LOCATIONS' }}
                        </span>
                        <!-- Heading -->
                        <h2 class="text-2xl md:text-3xl font-bold font-display text-base-content leading-tight">
                            {{ introSection.heading }}
                        </h2>
                        <!-- Body -->
                        <p class="text-base-content/70 font-body text-sm md:text-base leading-relaxed">
                            {{ introSection.body }}
                        </p>
                    </div>

                    <!-- Details list -->
                    <div class="space-y-5 pt-5 border-t border-base-300">
                        <!-- Address -->
                        <div v-if="settings.contact_address" class="flex gap-4 items-start">
                            <div class="text-amber mt-1 flex-shrink-0">
                                <MapPin class="size-5 stroke-[1.5]" />
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider text-base-content/70">Head Office Address</h4>
                                <p class="text-base-content text-sm font-body leading-relaxed">{{ settings.contact_address }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div v-if="settings.contact_phone" class="flex gap-4 items-start">
                            <div class="text-amber mt-1 flex-shrink-0">
                                <Phone class="size-5 stroke-[1.5]" />
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider text-base-content/70">Phone Support</h4>
                                <p class="text-base-content text-sm font-body">{{ settings.contact_phone }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div v-if="settings.contact_email" class="flex gap-4 items-start">
                            <div class="text-amber mt-1 flex-shrink-0">
                                <Mail class="size-5 stroke-[1.5]" />
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider text-base-content/70">Email Operations</h4>
                                <p class="text-base-content text-sm font-body">
                                    <a :href="`mailto:${settings.contact_email}`" class="hover:text-amber transition-colors">{{ settings.contact_email }}</a>
                                </p>
                            </div>
                        </div>

                        <!-- Office Hours -->
                        <div v-if="settings.office_hours" class="flex gap-4 items-start">
                            <div class="text-amber mt-1 flex-shrink-0">
                                <Clock class="size-5 stroke-[1.5]" />
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider text-base-content/70">Office Hours</h4>
                                <p class="text-base-content text-sm font-body">{{ settings.office_hours }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Map Embed iframe -->
                <div class="rounded-lg overflow-hidden border border-base-300 h-[300px] lg:h-[350px] bg-base-200 relative group/map">
                    <iframe 
                        v-if="settings.google_maps_embed"
                        :src="settings.google_maps_embed" 
                        class="absolute inset-0 w-full h-full border-0 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
                        allowfullscreen="false" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                    <div v-else class="absolute inset-0 flex items-center justify-center text-base-content/50 font-body text-sm">
                        No map coordinates configured.
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
