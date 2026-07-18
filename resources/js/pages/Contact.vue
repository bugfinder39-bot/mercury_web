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

const introSection = computed(() => {
    return props.sections.find(s => s.type === 'intro');
});

const heroSection = computed(() => {
    return props.sections.find(s => s.type === 'hero_banner');
});
</script>

<template>
    <Head>
        <title>{{ page?.meta_title || 'Contact Us - Mercury Bangladesh' }}</title>
        <meta name="description" :content="page?.meta_description || 'Get in touch with our operations desk.'" />
    </Head>

    <div class="pb-24">
        <!-- Hero Banner Section -->
        <HeroBanner
            v-if="heroSection"
            :section="heroSection"
        />

        <!-- Main Body Grid -->
        <div class="max-w-7xl mx-auto px-6 py-16 md:py-24 grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            <!-- Left Side: Contact Form -->
            <div class="lg:col-span-7">
                <ContactForm />
            </div>

            <!-- Right Side: Contact Info & Map -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Info Card -->
                <div v-if="introSection || settings" class="card-premium p-7 md:p-9 space-y-6">
                    <div v-if="introSection" class="space-y-4">
                        <span class="eyebrow-orange">
                            {{ introSection.subheading || 'MB · LOCATIONS' }}
                        </span>
                        <h2 class="text-2xl md:text-3xl font-bold font-display leading-tight" style="color: #0B2540;">
                            {{ introSection.heading }}
                        </h2>
                        <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>
                        <p class="font-body text-sm md:text-base leading-relaxed" style="color: #475569;">
                            {{ introSection.body }}
                        </p>
                    </div>

                    <!-- Details list -->
                    <div class="space-y-5 pt-4" style="border-top: 1px solid rgba(11,37,64,0.08);">
                        <!-- Address -->
                        <div v-if="settings.contact_address" class="flex gap-4 items-start">
                            <div class="icon-orange-wrap flex-shrink-0">
                                <MapPin class="size-4 stroke-[1.5]" />
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider font-semibold" style="color: #64748B;">Head Office Address</h4>
                                <p class="font-body text-sm leading-relaxed" style="color: #1E293B;">{{ settings.contact_address }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div v-if="settings.contact_phone" class="flex gap-4 items-start">
                            <div class="icon-orange-wrap flex-shrink-0">
                                <Phone class="size-4 stroke-[1.5]" />
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider font-semibold" style="color: #64748B;">Phone Support</h4>
                                <p class="font-body text-sm" style="color: #1E293B;">{{ settings.contact_phone }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div v-if="settings.contact_email" class="flex gap-4 items-start">
                            <div class="icon-orange-wrap flex-shrink-0">
                                <Mail class="size-4 stroke-[1.5]" />
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider font-semibold" style="color: #64748B;">Email Operations</h4>
                                <p class="font-body text-sm" style="color: #1E293B;">
                                    <a :href="`mailto:${settings.contact_email}`" class="transition-colors"
                                        style="color: #1E293B;"
                                        onmouseover="this.style.color='#E8770C';"
                                        onmouseout="this.style.color='#1E293B';"
                                    >{{ settings.contact_email }}</a>
                                </p>
                            </div>
                        </div>

                        <!-- Office Hours -->
                        <div v-if="settings.office_hours" class="flex gap-4 items-start">
                            <div class="icon-orange-wrap flex-shrink-0">
                                <Clock class="size-4 stroke-[1.5]" />
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider font-semibold" style="color: #64748B;">Office Hours</h4>
                                <p class="font-body text-sm" style="color: #1E293B;">{{ settings.office_hours }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Map Embed -->
                <div class="rounded-xl overflow-hidden h-[280px] lg:h-[320px] relative" style="border: 1px solid rgba(11,37,64,0.10); box-shadow: var(--shadow-card);">
                    <iframe
                        v-if="settings.google_maps_embed"
                        :src="settings.google_maps_embed"
                        class="absolute inset-0 w-full h-full border-0 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
                        allowfullscreen="false"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                    <div v-else class="absolute inset-0 flex items-center justify-center font-body text-sm" style="background-color: #EEF2F7; color: #64748B;">
                        No map coordinates configured.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
