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
    <div v-if="section && milestones.length > 0" class="py-24 relative overflow-hidden bg-light-steel-blue-soft border-y border-light-steel-blue">
        <!-- Background decorative blobs -->
        <div class="gradient-blob gradient-blob-navy w-[400px] h-[400px] -top-20 -left-20 opacity-[0.06]"></div>
        <div class="gradient-blob gradient-blob-orange w-[300px] h-[300px] bottom-10 right-0 opacity-[0.05]"></div>

        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-20 space-y-4 reveal-fade-up">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'MB · TIMELINE' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>
                <div class="flex justify-center">
                    <div class="h-[3px] w-12 bg-[#E8770C]"></div>
                </div>
                <p v-if="section.body" class="font-body text-base max-w-2xl mx-auto text-slate-500">
                    {{ section.body }}
                </p>
            </div>

            <!-- Vertical Timeline -->
            <div class="relative max-w-2xl mx-auto pl-8 md:pl-14 space-y-12">
                <!-- Orange/Navy vertical line -->
                <div class="absolute left-0 top-0 bottom-0 w-[2px] rounded-full" style="background: linear-gradient(to bottom, #E8770C 0%, #0B2540 80%, rgba(11,37,64,0.1) 100%);"></div>

                <div
                    v-for="(milestone, index) in milestones"
                    :key="milestone.id"
                    class="relative group reveal-fade-up"
                    :class="'stagger-' + (index % 6 + 1)"
                >
                    <!-- Milestone dot with animated pulse on hover -->
                    <div
                        class="absolute top-2 h-4 w-4 rounded-full border-2 transition-all duration-300 group-hover:scale-125"
                        style="background-color: #ffffff; border-color: #E8770C; left: -41px; box-shadow: 0 0 0 4px rgba(232, 119, 12, 0.15);"
                        onmouseover="this.style.backgroundColor='#E8770C';"
                        onmouseout="this.style.backgroundColor='#ffffff';"
                    ></div>

                    <!-- Milestone Card -->
                    <div class="card-premium hover-glow-card p-6 space-y-3 bg-white border border-slate-100/65 relative rounded-2xl hover:bg-gradient-to-br hover:from-white hover:to-[var(--color-light-steel-blue)]/15">
                        <!-- Tiny Orange left border accent on hover -->
                        <div class="absolute left-0 top-0 bottom-0 w-[3px] bg-gradient-to-b from-[#E8770C] to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-l-2xl"></div>

                        <!-- Year -->
                        <span
                            class="inline-block font-mono font-bold text-xs md:text-sm tracking-wider"
                            style="color: #E8770C;"
                        >
                            {{ milestone.subtitle }}
                        </span>

                        <!-- Title -->
                        <h3 class="text-xl md:text-2xl font-bold font-display transition-colors duration-200 group-hover:text-[#E8770C]" style="color: #0B2540;">
                            {{ milestone.title }}
                        </h3>

                        <!-- Description -->
                        <p class="font-body text-sm md:text-base leading-relaxed text-slate-500">
                            {{ milestone.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
