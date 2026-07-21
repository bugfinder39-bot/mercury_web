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

const aboutImage = computed(() => {
    if (props.section?.items && props.section.items.length > 0) {
        const itemWithImage = props.section.items.find(item => item.value || item.image_media?.file_path);

        if (itemWithImage) {
            return itemWithImage.image_media?.file_path || itemWithImage.value;
        }
    }

    return '/images/about-home.jpg';
});
</script>

<template>
    <div v-if="section" class="relative overflow-hidden py-24 bg-white">
        <!-- Background blobs -->
        <div class="gradient-blob gradient-blob-orange w-80 h-80 top-0 left-[-5%] opacity-10"></div>
        <div class="gradient-blob gradient-blob-navy w-[450px] h-[450px] bottom-0 right-[-10%] opacity-[0.06]"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Text Content -->
                <div class="space-y-6 reveal-slide-right">
                    <!-- Eyebrow -->
                    <span class="eyebrow-orange">
                        {{ section.subheading || 'MB · ABOUT US' }}
                    </span>

                    <!-- Heading -->
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display leading-tight" style="color: #0B2540;">
                        {{ section.heading }}
                    </h2>

                    <!-- Divider accent -->
                    <div class="h-[3px] w-14 bg-gradient-to-r from-[#E8770C] to-[#0B2540] rounded-full"></div>

                    <!-- Body Copy -->
                    <p class="font-body text-base md:text-lg leading-relaxed whitespace-pre-line text-slate-600">
                        {{ section.body }}
                    </p>

                    <!-- CTA -->
                    <div class="pt-2">
                        <Link
                            href="/about"
                            class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-wider font-semibold group transition-colors text-[#E8770C] hover:text-[#CC6608]"
                        >
                            <span>Learn More About Us</span>
                            <ArrowRight class="size-4 transition-transform duration-150 group-hover:translate-x-1" />
                        </Link>
                    </div>
                </div>

                <!-- Image Side with premium offset frame -->
                <div class="relative w-full aspect-[4/3] lg:aspect-square reveal-slide-left">
                    <!-- Decorative back frame -->
                    <div class="absolute -top-3 -right-3 w-full h-full border border-[#E8770C]/25 rounded-2xl pointer-events-none"></div>
                    <div
                        class="w-full h-full relative rounded-2xl overflow-hidden group/img shadow-xl border border-slate-100 bg-slate-50"
                    >
                        <img
                            :src="aboutImage"
                            :alt="section.heading || 'About Mercury'"
                            class="w-full h-full object-cover transition-transform duration-[6000ms] group-hover/img:scale-105"
                            loading="lazy"
                        />
                        <!-- Orange bottom accent overlay -->
                        <div class="absolute bottom-0 left-0 w-full h-[3px] bg-gradient-to-r from-[#E8770C] to-[#0B2540]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
