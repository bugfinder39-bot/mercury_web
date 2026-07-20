<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
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

const heroSection = computed(() => {
    return props.sections.find(s => s.type === 'hero_banner');
});

const officesSection = computed(() => {
    return props.sections.find(s => s.type === 'office_locations');
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

        <!-- Office Locations Section -->
        <div v-if="officesSection && officesSection.is_active" class="max-w-7xl mx-auto px-6 py-12 md:py-16">
            <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
                <span v-if="officesSection.subheading" class="text-xs font-mono uppercase tracking-wider block mb-2" style="color: #E8770C;">
                    {{ officesSection.subheading }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display tracking-tight mb-4" style="color: #0B2540;">
                    {{ officesSection.heading || 'Our Office Locations' }}
                </h2>
                <p v-if="officesSection.body" class="text-slate-600 font-body text-base">
                    {{ officesSection.body }}
                </p>
            </div>

            <!-- Offices Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                <div 
                    v-for="office in officesSection.items" 
                    :key="office.id"
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between"
                >
                    <div>
                        <!-- Optional Office Image -->
                        <div v-if="office.image_media?.file_path || office.value" class="w-full h-48 rounded-xl overflow-hidden mb-6 bg-slate-100">
                            <img 
                                :src="office.image_media?.file_path || office.value" 
                                :alt="office.title" 
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                            />
                        </div>

                        <!-- Office Header / Badge -->
                        <div class="flex items-center justify-between mb-4">
                            <span v-if="office.subtitle" class="px-3 py-1 rounded-full text-xs font-mono font-semibold" style="background-color: rgba(232, 119, 12, 0.1); color: #E8770C;">
                                {{ office.subtitle }}
                            </span>
                            <span v-if="office.emergency_contact" class="text-xs text-slate-500 font-body flex items-center gap-1">
                                <span class="size-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Emergency: {{ office.emergency_contact }}
                            </span>
                        </div>

                        <h3 class="text-2xl font-bold font-display mb-3" style="color: #0B2540;">
                            {{ office.title }}
                        </h3>
                        <p v-if="office.description" class="text-slate-600 font-body text-sm mb-6">
                            {{ office.description }}
                        </p>

                        <!-- Office Details -->
                        <div class="space-y-4 mb-8">
                            <div v-if="office.address" class="flex items-start gap-3">
                                <span class="text-[#E8770C] mt-1">
                                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </span>
                                <div>
                                    <h4 class="text-xs font-mono uppercase tracking-wider text-slate-400 mb-0.5">Address</h4>
                                    <p class="text-sm font-body text-slate-700">{{ office.address }}</p>
                                </div>
                            </div>

                            <div v-if="office.phone" class="flex items-start gap-3">
                                <span class="text-[#E8770C] mt-1">
                                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </span>
                                <div>
                                    <h4 class="text-xs font-mono uppercase tracking-wider text-slate-400 mb-0.5">Phone</h4>
                                    <p class="text-sm font-body text-slate-700">{{ office.phone }}</p>
                                </div>
                            </div>

                            <div v-if="office.email" class="flex items-start gap-3">
                                <span class="text-[#E8770C] mt-1">
                                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </span>
                                <div>
                                    <h4 class="text-xs font-mono uppercase tracking-wider text-slate-400 mb-0.5">Email</h4>
                                    <a :href="`mailto:${office.email}`" class="text-sm font-body text-[#123A5E] hover:text-[#E8770C] transition-colors">{{ office.email }}</a>
                                </div>
                            </div>

                            <div v-if="office.office_hours" class="flex items-start gap-3">
                                <span class="text-[#E8770C] mt-1">
                                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </span>
                                <div>
                                    <h4 class="text-xs font-mono uppercase tracking-wider text-slate-400 mb-0.5">Business Hours</h4>
                                    <p class="text-sm font-body text-slate-700">{{ office.office_hours }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Google Map Embed / Link -->
                    <div v-if="office.map_url" class="w-full mt-auto pt-6 border-t border-slate-100">
                        <div class="w-full h-64 rounded-xl overflow-hidden border border-slate-200 shadow-inner bg-slate-50 mb-4">
                            <iframe 
                                :src="office.map_url" 
                                class="w-full h-full border-0" 
                                allowfullscreen="false" 
                                loading="lazy"
                            ></iframe>
                        </div>
                        <a 
                            v-if="office.latitude && office.longitude"
                            :href="`https://www.google.com/maps/search/?api=1&query=${office.latitude},${office.longitude}`"
                            target="_blank"
                            class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-lg border border-slate-200 text-sm font-semibold transition-all duration-200 hover:bg-slate-50 hover:scale-[1.02]"
                            style="color: #0B2540;"
                        >
                            <span>Open in Google Maps</span>
                            <svg class="size-4 ml-1.5 text-[#E8770C]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Body: Centered Contact Form -->
        <div class="max-w-7xl mx-auto px-6 py-12 md:py-16 flex flex-col items-center">
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="text-xs font-mono uppercase tracking-wider block mb-2" style="color: #E8770C;">Message Desk</span>
                <h2 class="text-3xl font-bold font-display tracking-tight" style="color: #0B2540;">Send Us a Message</h2>
            </div>
            <div class="w-full max-w-[850px]">
                <ContactForm />
            </div>
        </div>
    </div>
</template>
