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
    // Check if there is an image URL in section items
    if (props.section?.items && props.section.items.length > 0) {
        const itemWithImage = props.section.items.find(item => item.value);

        if (itemWithImage) {
return itemWithImage.value;
}
    }

    // High-quality default for about page banner
    return '/images/about-hero.jpg';
});
</script>

<template>
    <div v-if="section" class="relative bg-neutral py-20 md:py-28 text-neutral-content overflow-hidden min-h-[40vh] flex items-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img 
                :src="backgroundImage" 
                alt="Banner Background"
                class="w-full h-full object-cover opacity-25"
                loading="eager"
            />
            <!-- Duotone overlay/gradients -->
            <div class="absolute inset-0 bg-neutral/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-neutral/45 via-transparent to-neutral/90"></div>
            
            <!-- Route-line divider at bottom of hero -->
            <div class="absolute bottom-0 left-0 w-full h-[1px] bg-neutral-content/10"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center space-y-4">
            <!-- Eyebrow (mono label) -->
            <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-amber uppercase">
                {{ section.subheading || 'MB · 01 — FOUNDATION' }}
            </span>
            
            <!-- Headline (Archivo) -->
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold font-display tracking-tight leading-none text-neutral-content max-w-3xl mx-auto">
                {{ section.heading }}
            </h1>
            
            <!-- Subtext (Plex Sans) -->
            <p v-if="section.body" class="text-neutral-content/80 font-body text-base md:text-lg max-w-xl mx-auto leading-relaxed">
                {{ section.body }}
            </p>
        </div>
    </div>
</template>
