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
    <div v-if="section" class="relative h-[60vh] md:h-[65vh] flex items-center overflow-hidden" style="background-color: #0B2540;">
        <!-- Floating shapes -->
        <div class="absolute -top-12 -right-12 w-64 h-64 rounded-full bg-[#E8770C]/8 blur-3xl pointer-events-none z-10 animate-pulse duration-[6000ms]"></div>
        <div class="absolute -bottom-20 left-12 w-80 h-80 rounded-full bg-[#E8770C]/6 blur-3xl pointer-events-none z-10 animate-pulse duration-[10000ms]"></div>

        <!-- Background Image with slow transition/hover zoom -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img
                :src="backgroundImage"
                alt="Banner Background"
                class="w-full h-full object-cover transition-transform duration-[12000ms] hover:scale-105"
                style="opacity: 0.22;"
                loading="eager"
            />
            <!-- Navy gradient overlays -->
            <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(11,37,64,0.3) 0%, rgba(11,37,64,0.5) 60%, rgba(11,37,64,0.75) 100%);"></div>
            <!-- Bottom divider line -->
            <div class="absolute bottom-0 left-0 w-full h-[1px]" style="background-color: rgba(232,119,12,0.3);"></div>
        </div>

        <!-- Content - wrapped in a premium Glass card -->
        <div class="relative z-10 w-full max-w-4xl mx-auto px-6 pt-16 text-center">
            <div class="inline-block p-6 md:p-10 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-md shadow-2xl space-y-5 max-w-3xl mx-auto animate-in fade-in-50 slide-in-from-bottom-5 duration-700">
                <!-- Eyebrow -->
                <span class="inline-flex items-center gap-2 font-mono text-xs md:text-sm tracking-widest uppercase font-semibold text-[#E8770C]">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#E8770C]"></span>
                    {{ section.subheading || 'MB · FOUNDATION' }}
                </span>

                <!-- Headline -->
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold font-display tracking-tight leading-tight text-white">
                    {{ section.heading }}
                </h1>

                <!-- Subtext -->
                <p v-if="section.body" class="font-body text-sm md:text-base max-w-xl mx-auto leading-relaxed text-white/70">
                    {{ section.body }}
                </p>

                <!-- Orange underline accent -->
                <div class="flex justify-center pt-2">
                    <div class="h-1 w-16 rounded-full bg-[#E8770C]"></div>
                </div>
            </div>
        </div>

        <!-- Left Accent Indicator Line -->
        <div class="absolute left-0 top-0 bottom-0 w-1 z-20 bg-[#E8770C]"></div>
    </div>
</template>
