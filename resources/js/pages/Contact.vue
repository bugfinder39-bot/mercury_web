<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import ContactForm from '@/components/ContactForm.vue';
import HeroBanner from '@/components/HeroBanner.vue';
import OfficeTeamSection from '@/components/OfficeTeamSection.vue';
import PublicLayout from '@/layouts/PublicLayout.vue';

defineProps<{
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
</script>

<template>
    <Head>
        <title>{{ page?.meta_title || 'Contact Us - Mercury Bangladesh' }}</title>
        <meta name="description" :content="page?.meta_description || 'Get in touch with our operations desk.'" />
    </Head>

    <div class="pb-24">
        <!-- Loop and dynamically render each section in the order returned by the CMS -->
        <template v-for="section in sections" :key="section.id">
            <!-- Hero Banner Section -->
            <HeroBanner
                v-if="section.type === 'hero_banner'"
                :section="section"
            />

            <!-- Office Team Section -->
            <OfficeTeamSection
                v-else-if="section.type === 'office_team'"
                :section="section"
            />

            <!-- Office Locations Section -->
            <div v-else-if="section.type === 'office_locations'" class="relative overflow-hidden py-24 bg-light-steel-blue-soft border-b border-light-steel-blue">
                <!-- Background blobs -->
                <div class="gradient-blob gradient-blob-orange w-80 h-80 top-0 left-[-5%] opacity-10"></div>
                <div class="gradient-blob gradient-blob-navy w-[450px] h-[450px] bottom-0 right-[-10%] opacity-[0.06]"></div>

                <div class="max-w-7xl mx-auto px-6 relative z-10">
                    <div class="text-center max-w-3xl mx-auto mb-16 reveal-fade-up">
                        <span v-if="section.subheading" class="eyebrow-orange block mb-2">
                            {{ section.subheading }}
                        </span>
                        <h2 class="text-3xl md:text-4xl font-bold font-display tracking-tight mb-4 text-primary-navy">
                            {{ section.heading || 'Our Office Locations' }}
                        </h2>
                        <div class="h-1 w-12 rounded-full mx-auto bg-primary-orange mb-4"></div>
                        <p v-if="section.body" class="text-slate-600 font-body text-base">
                            {{ section.body }}
                        </p>
                    </div>

                    <!-- Offices Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                        <div 
                            v-for="(office, index) in section.items" 
                            :key="office.id"
                            class="card-premium hover-glow-card rounded-2xl p-8 flex flex-col justify-between bg-white hover:bg-gradient-to-br hover:from-white hover:to-[var(--color-light-steel-blue)]/15 transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden reveal-fade-up"
                            :class="'stagger-' + (index % 6 + 1)"
                        >
                            <!-- Top Accent line on hover -->
                            <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#E8770C] to-[#123A5E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                            <!-- Accent corner -->
                            <div class="absolute top-0 right-0 w-8 h-8 bg-gradient-to-bl from-[#E8770C] to-transparent opacity-10 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>

                            <div>
                                <!-- Optional Office Image -->
                                <div v-if="office.image_media?.file_path || office.value" class="w-full h-48 rounded-xl overflow-hidden mb-6 bg-slate-100/50 border border-slate-200">
                                    <img 
                                        :src="office.image_media?.file_path || office.value" 
                                        :alt="office.title" 
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
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

                                <h3 class="text-2xl font-bold font-display mb-3 text-primary-navy group-hover:text-primary-orange transition-colors">
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
            </div>
        </template>

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
