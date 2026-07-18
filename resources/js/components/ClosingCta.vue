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
    if (props.section?.items && props.section.items.length > 0) {
        const itemWithImage = props.section.items.find(item => item.value && item.value.startsWith('/'));

        if (itemWithImage) {
return itemWithImage.value;
}
    }

    return '/images/closing-cta.jpg';
});

const ctaButton = computed(() => {
    if (props.section?.items && props.section.items.length > 0) {
        const itemWithButton = props.section.items.find(item => item.title && item.link);

        if (itemWithButton) {
            return {
                text: itemWithButton.title,
                link: itemWithButton.link
            };
        }
    }

    return {
        text: 'Contact Our Operations Desk',
        link: '/contact'
    };
});
</script>

<template>
    <div v-if="section" class="relative py-20 md:py-28 overflow-hidden flex items-center" style="background-color: #0B2540;">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img
                :src="backgroundImage"
                alt="CTA Background"
                class="w-full h-full object-cover"
                style="opacity: 0.15;"
                loading="lazy"
            />
            <!-- Navy gradient -->
            <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(11,37,64,0.95) 0%, rgba(18,58,94,0.85) 100%);"></div>
        </div>

        <!-- Orange accent lines -->
        <div class="absolute top-0 left-0 w-full h-0.5" style="background: linear-gradient(to right, transparent, #E8770C 30%, #E8770C 70%, transparent);"></div>
        <div class="absolute bottom-0 left-0 w-full h-0.5" style="background: linear-gradient(to right, transparent, #E8770C 30%, #E8770C 70%, transparent);"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center space-y-7">
            <!-- Eyebrow -->
            <span class="inline-block font-mono text-xs md:text-sm tracking-widest uppercase" style="color: #E8770C;">
                {{ section.subheading || 'MB · CALL TO ACTION' }}
            </span>

            <!-- Headline -->
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display tracking-tight leading-tight text-white max-w-2xl mx-auto">
                {{ section.heading }}
            </h2>

            <!-- Orange divider -->
            <div class="flex justify-center">
                <div class="h-1 w-16 rounded-full" style="background-color: #E8770C;"></div>
            </div>

            <!-- Subtext -->
            <p v-if="section.body" class="font-body text-base md:text-lg max-w-xl mx-auto leading-relaxed" style="color: rgba(255,255,255,0.72);">
                {{ section.body }}
            </p>

            <!-- CTA Button -->
            <div class="pt-2">
                <Link
                    :href="ctaButton.link"
                    class="btn-primary inline-flex items-center gap-2 group"
                >
                    <span>{{ ctaButton.text }}</span>
                    <ArrowRight class="size-4 transition-transform duration-150 group-hover:translate-x-1" />
                </Link>
            </div>
        </div>
    </div>
</template>
