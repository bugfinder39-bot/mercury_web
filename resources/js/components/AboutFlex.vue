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
    // If the admin uploaded/configured a specific image in a section item, use it.
    if (props.section?.items && props.section.items.length > 0) {
        const itemWithImage = props.section.items.find(item => item.value);

        if (itemWithImage) {
return itemWithImage.value;
}
    }

    // High-quality default
    return '/images/about-home.jpg';
});
</script>

<template>
    <div v-if="section" class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Text Content -->
            <div class="space-y-6">
                <!-- Eyebrow -->
                <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-base-content/70 uppercase">
                    {{ section.subheading || 'MB · 02 — ABOUT US' }}
                </span>
                
                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold font-display text-base-content leading-tight">
                    {{ section.heading }}
                </h2>
                
                <!-- Body Copy -->
                <p class="text-base-content/80 font-body text-base md:text-lg leading-relaxed whitespace-pre-line">
                    {{ section.body }}
                </p>

                <!-- Optional CTA -->
                <div class="pt-2">
                    <Link 
                        href="/about"
                        class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-wider text-amber hover:text-amber-dark font-medium group transition-colors"
                    >
                        <span>Learn More About Us</span>
                        <ArrowRight class="size-4 transition-transform duration-150 group-hover:translate-x-1" />
                    </Link>
                </div>
            </div>

            <!-- Image side with neutral overlay option -->
            <div class="relative rounded-lg overflow-hidden border border-base-300 aspect-[4/3] lg:aspect-square group/img">
                <!-- Image -->
                <img 
                    :src="aboutImage" 
                    :alt="section.heading || 'About Mercury'"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105"
                    loading="lazy"
                />
                <!-- Subtle brand neutral overlay (10% opacity) -->
                <div class="absolute inset-0 bg-neutral/10 mix-blend-multiply pointer-events-none"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-neutral/20 via-transparent to-transparent pointer-events-none"></div>
            </div>
        </div>
    </div>
</template>
