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
    <div v-if="section" class="relative py-28 md:py-36 overflow-hidden flex items-center bg-gradient-to-b from-[#0b2540] to-[#081b30]">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img
                :src="backgroundImage"
                alt="CTA Background"
                class="w-full h-full object-cover transition-transform duration-[12000ms] hover:scale-105"
                style="opacity: 0.12;"
                loading="lazy"
            />
            <!-- Navy gradient -->
            <div class="absolute inset-0" style="background: radial-gradient(circle at 30% 50%, rgba(18,58,94,0.92) 0%, rgba(11,37,64,0.96) 80%);"></div>
        </div>

        <!-- Background blobs and abstract circles -->
        <div class="gradient-blob gradient-blob-orange w-[350px] h-[350px] top-[-10%] right-[10%] opacity-15"></div>
        <div class="gradient-blob gradient-blob-navy w-[450px] h-[450px] bottom-[-20%] left-[-10%] opacity-20"></div>
        <div class="absolute top-[30%] left-[80%] w-72 h-72 rounded-full border border-white/5 pointer-events-none select-none"></div>

        <!-- Top / Bottom orange accent lines -->
        <div class="absolute top-0 left-0 w-full h-0.5" style="background: linear-gradient(to right, transparent, #E8770C 30%, #E8770C 70%, transparent);"></div>
        <div class="absolute bottom-0 left-0 w-full h-0.5" style="background: linear-gradient(to right, transparent, #E8770C 30%, #E8770C 70%, transparent);"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center space-y-7">
            <!-- Eyebrow -->
            <span class="inline-block font-mono text-xs md:text-sm tracking-widest uppercase font-semibold text-[#E8770C]">
                {{ section.subheading || 'MB · CALL TO ACTION' }}
            </span>

            <!-- Headline -->
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold font-display tracking-tight leading-tight text-white max-w-3xl mx-auto">
                {{ section.heading }}
            </h2>

            <!-- Orange divider -->
            <div class="flex justify-center">
                <div class="h-[3px] w-16 bg-[#E8770C] rounded-full"></div>
            </div>

            <!-- Subtext -->
            <p v-if="section.body" class="font-body text-base md:text-lg max-w-2xl mx-auto leading-relaxed text-white/70">
                {{ section.body }}
            </p>

            <!-- CTA Button -->
            <div class="pt-2">
                <Link
                    :href="ctaButton.link"
                    class="btn-primary inline-flex items-center gap-2 group"
                >
                    <span>{{ ctaButton.text }}</span>
                    <ArrowRight class="size-4" />
                </Link>
            </div>
        </div>
    </div>
</template>
