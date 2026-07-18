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
        cta_background_media_id?: number;
        cta_primary_btn_text?: string;
        cta_primary_btn_url?: string;
        items?: Array<{
            id: number;
            title: string;
            description?: string;
            value?: string;
            link?: string;
            order: number;
        }>;
    };
}>();

// Extract background image URL
const backgroundImage = computed(() => {
    if (props.section?.items) {
        const bgItem = props.section.items.find(
            item => item.title?.toLowerCase() === 'background' || 
            (item.value && (item.value.includes('/images/') || item.value.match(/\.(jpeg|jpg|png|webp|gif)$/i)))
        );
        if (bgItem) return bgItem.image_media?.file_path || bgItem.value;
    }
    return 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=1600&auto=format&fit=crop&q=80';
});

// Extract CTA button
const ctaBtn = computed(() => {
    if (props.section?.cta_primary_btn_text) {
        return {
            text: props.section.cta_primary_btn_text,
            url: props.section.cta_primary_btn_url || '#'
        };
    }
    if (props.section?.items) {
        const ctaItem = props.section.items.find(
            item => item.title?.toLowerCase() === 'cta' || item.link
        );
        if (ctaItem) {
            return {
                text: ctaItem.description || ctaItem.title || 'Discover More',
                url: ctaItem.link || ctaItem.value || '#'
            };
        }
    }
    return {
        text: 'Contact Our Team',
        url: '/contact'
    };
});
</script>

<template>
    <div 
        v-if="section" 
        class="relative py-24 md:py-32 overflow-hidden flex items-center justify-center text-center"
        style="min-height: 400px;"
    >
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img 
                :src="backgroundImage" 
                :alt="section.heading" 
                class="w-full h-full object-cover"
                loading="lazy"
            />
            <!-- Dark Navy Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#0B2540]/90 to-[#0B2540]/75 mix-blend-multiply"></div>
        </div>

        <!-- Content Area -->
        <div class="relative z-10 max-w-4xl mx-auto px-6 space-y-6">
            <span class="eyebrow-orange block">
                {{ section.subheading || 'LOGISTICS SOLUTIONS' }}
            </span>
            
            <h2 class="text-3xl md:text-5xl font-black font-display tracking-tight text-white leading-tight">
                {{ section.heading }}
            </h2>

            <div class="h-1 w-16 rounded-full mx-auto" style="background-color: #E8770C;"></div>

            <p class="font-body text-base md:text-xl text-slate-200 max-w-2xl mx-auto leading-relaxed">
                {{ section.body }}
            </p>

            <div class="pt-4">
                <Link 
                    :href="ctaBtn.url" 
                    class="btn-primary inline-flex items-center gap-2"
                >
                    <span>{{ ctaBtn.text }}</span>
                    <ArrowRight class="size-4" />
                </Link>
            </div>
        </div>
    </div>
</template>
