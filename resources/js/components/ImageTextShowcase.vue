<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowRight, CheckCircle2 } from '@lucide/vue';
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
            icon?: string;
            link?: string;
        }>;
    };
    isAltBackground?: boolean;
}>();

// Determine layout position: default left, but if subheading or body has '[right]' or a specific item exists, use right.
const imagePosition = computed(() => {
    if (!props.section) return 'left';
    
    // Check if there is an item with title 'Position'
    const positionItem = props.section.items?.find(item => item.title?.toLowerCase() === 'position');
    if (positionItem) {
        return positionItem.value?.toLowerCase() === 'right' ? 'right' : 'left';
    }
    
    // Fallback check in subheading/body
    const textToSearch = `${props.section.subheading} ${props.section.body}`.toLowerCase();
    if (textToSearch.includes('[right]') || textToSearch.includes('position:right')) {
        return 'right';
    }
    
    return 'left';
});

// Extract the main showcase image
const showcaseImage = computed(() => {
    if (props.section?.items) {
        // Find an item with title 'Image' or value containing image extension
        const imageItem = props.section.items.find(
            item => item.title?.toLowerCase() === 'image' || 
            item.image_media ||
            (item.value && (item.value.includes('/images/') || item.value.match(/\.(jpeg|jpg|png|webp|gif)$/i)))
        );
        if (imageItem) return imageItem.image_media?.file_path || imageItem.value;
    }
    return '/images/about-home.jpg';
});

// Extract bullet points (items that are not the image and not position configuration)
const bulletPoints = computed(() => {
    if (!props.section?.items) return [];
    return props.section.items.filter(
        item => item.title?.toLowerCase() !== 'image' && 
        item.title?.toLowerCase() !== 'position' &&
        !(item.value && (item.value.includes('/images/') || item.value.match(/\.(jpeg|jpg|png|webp|gif)$/i)))
    );
});

// Extract CTA button information
const ctaInfo = computed(() => {
    if (props.section?.items) {
        const ctaItem = props.section.items.find(item => item.title?.toLowerCase() === 'cta' || item.link);
        if (ctaItem) {
            return {
                text: ctaItem.description || ctaItem.title || 'Get Started',
                url: ctaItem.link || ctaItem.value || '#'
            };
        }
    }
    return null;
});

// Format body text by stripping formatting helpers
const cleanBody = computed(() => {
    if (!props.section?.body) return '';
    return props.section.body.replace(/\[right\]/gi, '').replace(/position:right/gi, '').trim();
});
</script>

<template>
    <div 
        v-if="section" 
        class="py-16 md:py-24 border-b border-slate-100" 
        :style="{ backgroundColor: isAltBackground ? '#EEF2F7' : '#ffffff' }"
    >
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                
                <!-- Image Column (rendered first on mobile, or based on imagePosition on desktop) -->
                <div 
                    :class="[
                        'relative rounded-xl overflow-hidden aspect-[4/3] lg:aspect-square group/img order-1',
                        imagePosition === 'right' ? 'lg:order-2' : 'lg:order-1'
                    ]"
                    style="box-shadow: var(--shadow-lg); border: 1px solid rgba(11,37,64,0.10);"
                >
                    <img
                        :src="showcaseImage"
                        :alt="section.heading || 'Mercury Showcase'"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105"
                        loading="lazy"
                    />
                    <!-- Orange bottom accent overlay -->
                    <div class="absolute bottom-0 left-0 w-full h-1.5" style="background-color: #E8770C;"></div>
                </div>

                <!-- Text Content Column -->
                <div 
                    :class="[
                        'space-y-6 order-2',
                        imagePosition === 'right' ? 'lg:order-1' : 'lg:order-2'
                    ]"
                >
                    <!-- Eyebrow -->
                    <span class="eyebrow-orange block">
                        {{ section.subheading?.replace(/\[right\]/gi, '').trim() || 'SHOWCASE' }}
                    </span>

                    <!-- Heading -->
                    <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight" style="color: #0B2540;">
                        {{ section.heading }}
                    </h2>

                    <!-- Divider accent -->
                    <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>

                    <!-- Description -->
                    <p class="font-body text-base md:text-lg leading-relaxed text-secondary-txt whitespace-pre-line">
                        {{ cleanBody }}
                    </p>

                    <!-- Bullet Points -->
                    <div v-if="bulletPoints.length > 0" class="space-y-3 pt-2">
                        <div 
                            v-for="point in bulletPoints" 
                            :key="point.id" 
                            class="flex items-start gap-3"
                        >
                            <CheckCircle2 class="size-5 text-primary-orange flex-shrink-0 mt-0.5" />
                            <div>
                                <h4 class="font-semibold font-display text-base text-primary-navy" v-if="point.title && point.title !== 'Bullet'">
                                    {{ point.title }}
                                </h4>
                                <p class="font-body text-sm text-secondary-txt">
                                    {{ point.description }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div v-if="ctaInfo" class="pt-4">
                        <Link
                            :href="ctaInfo.url"
                            class="btn-primary"
                        >
                            <span>{{ ctaInfo.text }}</span>
                            <ArrowRight class="size-4" />
                        </Link>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
