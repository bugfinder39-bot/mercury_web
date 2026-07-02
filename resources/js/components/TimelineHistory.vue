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
            subtitle?: string; // Year
            description?: string;
            order: number;
        }>;
    };
}>();

const milestones = computed(() => {
    return props.section?.items || [];
});
</script>

<template>
    <div v-if="section && milestones.length > 0" class="max-w-4xl mx-auto px-6 py-16 md:py-24">
        <!-- Section Header -->
        <div class="text-center mb-16 space-y-4">
            <!-- Eyebrow -->
            <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-base-content/70 uppercase">
                {{ section.subheading || 'MB · 04 — TIMELINE' }}
            </span>
            <!-- Heading -->
            <h2 class="text-3xl md:text-4xl font-bold font-display text-base-content">
                {{ section.heading }}
            </h2>
            <!-- Optional Intro text -->
            <p v-if="section.body" class="text-base-content/70 font-body text-base max-w-2xl mx-auto">
                {{ section.body }}
            </p>
        </div>

        <!-- Vertical Timeline -->
        <div class="relative max-w-2xl mx-auto pl-8 md:pl-12 border-l border-base-300 space-y-12">
            <!-- Route-line connector decoration is implied by the left border -->
            <div 
                v-for="milestone in milestones" 
                :key="milestone.id"
                class="relative group"
            >
                <!-- Dot / Port Marker -->
                <!-- The first dot is Amber, the rest are base-300 matching design restraint -->
                <div 
                    class="absolute -left-[41px] md:-left-[57px] top-1.5 h-5 w-5 rounded-full border-2 bg-base-100 transition-colors duration-200 group-hover:border-neutral"
                    :class="milestone.order === 1 ? 'border-amber bg-base-100' : 'border-base-300 bg-base-100'"
                ></div>

                <!-- Milestone Content -->
                <div class="space-y-2">
                    <!-- Year / Subtitle (Mono Eyebrow Style) -->
                    <span 
                        class="inline-block font-mono font-bold text-xs md:text-sm tracking-wider"
                        :class="milestone.order === 1 ? 'text-amber' : 'text-base-content/70'"
                    >
                        {{ milestone.subtitle }}
                    </span>
                    
                    <!-- Title (H3 Archivo) -->
                    <h3 class="text-xl md:text-2xl font-bold font-display text-base-content">
                        {{ milestone.title }}
                    </h3>
                    
                    <!-- Description (Plex Sans) -->
                    <p class="text-base-content/85 font-body text-sm md:text-base leading-relaxed">
                        {{ milestone.description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
