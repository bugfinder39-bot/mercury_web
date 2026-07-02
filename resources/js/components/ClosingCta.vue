<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
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
            link?: string;
        }>;
    };
}>();

const backgroundImage = computed(() => {
    // Check if there is an image URL in section items
    if (props.section?.items && props.section.items.length > 0) {
        const itemWithImage = props.section.items.find(item => item.value && item.value.startsWith('/'));

        if (itemWithImage) {
return itemWithImage.value;
}
    }

    // High-quality default for closing CTA
    return '/images/closing-cta.jpg';
});

const ctaButton = computed(() => {
    // If the editor configured a custom button text & link via section items
    if (props.section?.items && props.section.items.length > 0) {
        const itemWithButton = props.section.items.find(item => item.title && item.link);

        if (itemWithButton) {
            return {
                text: itemWithButton.title,
                link: itemWithButton.link
            };
        }
    }

    // Defaults
    return {
        text: 'Contact Our Operations Desk',
        link: '/contact'
    };
});
</script>

<template>
    <div v-if="section" class="relative bg-neutral py-20 md:py-28 text-neutral-content overflow-hidden flex items-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img 
                :src="backgroundImage" 
                alt="CTA Background"
                class="w-full h-full object-cover opacity-20"
                loading="lazy"
            />
            <!-- Duotone overlay/gradients -->
            <div class="absolute inset-0 bg-neutral/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-neutral/90 via-transparent to-neutral/90"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center space-y-6">
            <!-- Eyebrow (mono label) -->
            <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-neutral-content/70 uppercase">
                {{ section.subheading || 'MB · 05 — CALL TO ACTION' }}
            </span>
            
            <!-- Headline (Archivo) -->
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display tracking-tight leading-tight text-neutral-content max-w-2xl mx-auto">
                {{ section.heading }}
            </h2>
            
            <!-- Subtext (Plex Sans) -->
            <p v-if="section.body" class="text-neutral-content/80 font-body text-base md:text-lg max-w-xl mx-auto leading-relaxed">
                {{ section.body }}
            </p>

            <!-- Button CTA -->
            <div class="pt-4">
                <Link 
                    :href="ctaButton.link"
                    class="inline-flex items-center gap-2 bg-amber hover:bg-amber-dark text-white px-6 py-3 rounded-lg font-mono text-sm uppercase tracking-wider font-semibold transition-colors duration-150 group"
                >
                    <span>{{ ctaButton.text }}</span>
                    <ArrowRight class="size-4 transition-transform duration-150 group-hover:translate-x-1" />
                </Link>
            </div>
        </div>
    </div>
</template>
