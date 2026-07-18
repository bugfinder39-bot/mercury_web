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
    <div v-if="section && milestones.length > 0" class="py-16 md:py-24" style="background-color: #F8FAFC;">
        <div class="max-w-4xl mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16 space-y-4">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'MB · TIMELINE' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>
                <div class="flex justify-center">
                    <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>
                </div>
                <p v-if="section.body" class="font-body text-base max-w-2xl mx-auto" style="color: #475569;">
                    {{ section.body }}
                </p>
            </div>

            <!-- Vertical Timeline -->
            <div class="relative max-w-2xl mx-auto pl-8 md:pl-14 space-y-10">
                <!-- Orange vertical line -->
                <div class="absolute left-0 top-0 bottom-0 w-[2px] rounded-full" style="background: linear-gradient(to bottom, #E8770C, rgba(232,119,12,0.20));"></div>

                <div
                    v-for="milestone in milestones"
                    :key="milestone.id"
                    class="relative group"
                >
                    <!-- Milestone dot -->
                    <div
                        class="absolute -left-[8px] md:-left-[8px] top-1.5 h-4 w-4 rounded-full border-2 transition-all duration-200"
                        style="background-color: #F8FAFC; border-color: #E8770C; left: -37px;"
                    ></div>

                    <!-- Milestone Card -->
                    <div class="card-premium shadow-card-hover p-6 space-y-3 group-hover:border-orange-200">
                        <!-- Year -->
                        <span
                            class="inline-block font-mono font-bold text-xs md:text-sm tracking-wider"
                            style="color: #E8770C;"
                        >
                            {{ milestone.subtitle }}
                        </span>

                        <!-- Title -->
                        <h3 class="text-xl md:text-2xl font-bold font-display" style="color: #0B2540;">
                            {{ milestone.title }}
                        </h3>

                        <!-- Description -->
                        <p class="font-body text-sm md:text-base leading-relaxed" style="color: #475569;">
                            {{ milestone.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
