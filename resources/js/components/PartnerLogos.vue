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
    <div v-if="activePartners.length > 0" class="py-16 md:py-20" style="background-color: #EEF2F7; border-top: 1px solid rgba(11,37,64,0.08);">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Orange Eyebrow Title -->
            <span class="eyebrow-orange block text-center mb-4">
                {{ section?.subheading || 'GLOBAL CARRIERS & SHIPPING LINES' }}
            </span>

            <h2 v-if="section?.heading" class="text-3xl md:text-4xl font-bold font-display text-center mb-12" style="color: #0B2540;">
                {{ section.heading }}
            </h2>

            <!-- Logo Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 items-center justify-items-center">
                <template v-for="partner in activePartners" :key="partner.id">
                    <component
                        :is="partner.link ? 'a' : 'div'"
                        :href="partner.link"
                        :target="partner.link ? '_blank' : undefined"
                        :rel="partner.link ? 'noopener noreferrer' : undefined"
                        class="h-12 w-full max-w-[150px] flex items-center justify-center transition-all duration-300 filter grayscale hover:grayscale-0 opacity-55 hover:opacity-100"
                        :title="partner.name"
                    >
                        <img
                            v-if="partner.logo"
                            :src="partner.logo"
                            :alt="partner.name"
                            class="max-h-full max-w-full object-contain"
                            loading="lazy"
                            @error="($event.target as HTMLImageElement).style.display = 'none'"
                        />
                        <!-- Fallback -->
                        <span
                            class="font-display font-bold text-sm tracking-widest uppercase select-none px-3 py-2 rounded-lg"
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
