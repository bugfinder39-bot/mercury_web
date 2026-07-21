<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    partners?: Array<{
        id: number;
        name: string;
        logo?: string;
        link?: string;
        order: number;
    }>;
    section?: {
        heading?: string;
        subheading?: string;
    };
}>();

const activePartners = computed(() => {
    return props.partners || [];
});
</script>

<template>
    <div v-if="activePartners.length > 0" class="py-16 md:py-20 relative overflow-hidden bg-light-steel-blue-soft border-t border-light-steel-blue">
        <!-- Floating gradient blobs -->
        <div class="gradient-blob gradient-blob-navy w-64 h-64 -top-12 -left-12 opacity-[0.05]"></div>
        <div class="gradient-blob gradient-blob-orange w-80 h-80 -bottom-20 -right-20 opacity-[0.04]"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Orange Eyebrow Title -->
            <span class="eyebrow-orange block text-center mb-4 reveal-fade-up">
                {{ section?.subheading || 'GLOBAL CARRIERS & SHIPPING LINES' }}
            </span>

            <h2 v-if="section?.heading" class="text-3xl md:text-4xl font-bold font-display text-center mb-12 text-primary-navy reveal-fade-up">
                {{ section.heading }}
            </h2>

            <!-- Logo Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 items-center justify-items-center">
                <template v-for="(partner, index) in activePartners" :key="partner.id">
                    <component
                        :is="partner.link ? 'a' : 'div'"
                        :href="partner.link"
                        :target="partner.link ? '_blank' : undefined"
                        :rel="partner.link ? 'noopener noreferrer' : undefined"
                        class="w-full h-24 flex items-center justify-center p-5 rounded-2xl border border-slate-100 bg-white shadow-sm hover:shadow-md hover:border-primary-orange/30 transition-all duration-300 filter grayscale hover:grayscale-0 opacity-70 hover:opacity-100 hover:-translate-y-1 relative overflow-hidden reveal-fade-up"
                        :class="'stagger-' + (index % 6 + 1)"
                        :title="partner.name"
                    >
                        <!-- Top Accent line on hover -->
                        <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-[#E8770C] to-[#123A5E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                        <img
                            v-if="partner.logo"
                            :src="partner.logo"
                            :alt="partner.name"
                            class="max-h-full max-w-full object-contain relative z-10"
                            loading="lazy"
                            @error="($event.target as HTMLImageElement).style.display = 'none'"
                        />
                        <!-- Fallback -->
                        <span
                            v-else
                            class="font-display font-bold text-sm tracking-widest uppercase select-none px-3 py-2 rounded-lg relative z-10"
                            style="color: #0B2540; background-color: #ffffff; border: 1px solid rgba(11,37,64,0.12);"
                        >
                            {{ partner.name }}
                        </span>
                    </component>
                </template>
            </div>
        </div>
    </div>
</template>
