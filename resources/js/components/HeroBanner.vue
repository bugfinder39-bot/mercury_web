<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
        items?: Array<{
            id: number;
            title: string;
            description?: string;
            value?: string;
        }>;
    };
}>();

const backgroundImage = computed(() => {
    if (props.section?.items && props.section.items.length > 0) {
        const itemWithImage = props.section.items.find(item => item.value);

        if (itemWithImage) {
return itemWithImage.value;
}
    }

    return '/images/about-hero.jpg';
});
</script>

<template>
    <div v-if="section" class="relative h-[65vh] md:h-[70vh] flex items-center overflow-hidden" style="background-color: #0B2540;">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img
                :src="backgroundImage"
                alt="Banner Background"
                class="w-full h-full object-cover"
                style="opacity: 0.18;"
                loading="eager"
            />
            <!-- Navy gradient overlays -->
            <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(11,37,64,0.10) 0%, rgba(11,37,64,0.25) 50%, rgba(11,37,64,0.40) 100%);"></div>
            <!-- Bottom divider line -->
            <div class="absolute bottom-0 left-0 w-full h-[1px]" style="background-color: rgba(232,119,12,0.30);"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center space-y-5">
            <!-- Eyebrow -->
            <span class="inline-block font-mono text-xs md:text-sm tracking-widest uppercase" style="color: #E8770C;">
                {{ section.subheading || 'MB · FOUNDATION' }}
            </span>

            <!-- Headline -->
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold font-display tracking-tight leading-none text-white max-w-3xl mx-auto">
                {{ section.heading }}
            </h1>

            <!-- Subtext -->
            <p v-if="section.body" class="font-body text-base md:text-lg max-w-xl mx-auto leading-relaxed" style="color: rgba(255,255,255,0.70);">
                {{ section.body }}
            </p>

            <!-- Orange underline accent -->
            <div class="flex justify-center pt-2">
                <div class="h-1 w-16 rounded-full" style="background-color: #E8770C;"></div>
            </div>
        </div>
    </div>
</template>
