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
    <div v-if="section" class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Text Content -->
            <div class="space-y-6">
                <!-- Eyebrow -->
                <span class="eyebrow-orange">
                    {{ section.subheading || 'MB · ABOUT US' }}
                </span>

                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>

                <!-- Divider accent -->
                <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>

                <!-- Body Copy -->
                <p class="font-body text-base md:text-lg leading-relaxed whitespace-pre-line" style="color: #475569;">
                    {{ section.body }}
                </p>

                <!-- CTA -->
                <div class="pt-2">
                    <Link
                        href="/about"
                        class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-wider font-semibold group transition-colors"
                        style="color: #E8770C;"
                    >
                        <span>Learn More About Us</span>
                        <ArrowRight class="size-4 transition-transform duration-150 group-hover:translate-x-1" />
                    </Link>
                </div>
            </div>

            <!-- Image Side -->
            <div
                class="relative rounded-xl overflow-hidden aspect-[4/3] lg:aspect-square group/img"
                style="box-shadow: var(--shadow-lg); border: 1px solid rgba(11,37,64,0.10);"
            >
                <img
                    :src="aboutImage"
                    :alt="section.heading || 'About Mercury'"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105"
                    loading="lazy"
                />
                <!-- Orange bottom accent overlay -->
                <div class="absolute bottom-0 left-0 w-full h-1" style="background-color: #E8770C;"></div>
            </div>
        </div>
    </div>
</template>
