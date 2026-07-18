<script setup lang="ts">
import * as Icons from '@lucide/vue';
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
            value?: string; // used for custom step number if needed, else we use index
            icon?: string;
            order: number;
        }>;
    };
}>();

const steps = computed(() => {
    return props.section?.items || [];
});

const getIconComponent = (iconName?: string) => {
    if (!iconName) {
        return Icons.Settings;
    }
    const resolved = (Icons as any)[iconName];
    return resolved || Icons.Settings;
};
</script>

<template>
    <div v-if="section" class="py-16 md:py-24" style="background-color: #EEF2F7; border-bottom: 1px solid rgba(11,37,64,0.08);">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-20">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'WORKFLOW' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>
                <div class="h-1 w-12 rounded-full mx-auto" style="background-color: #E8770C;"></div>
                <p class="font-body text-base md:text-lg leading-relaxed text-secondary-txt" v-if="section.body">
                    {{ section.body }}
                </p>
            </div>

            <!-- Steps Roadmap Container -->
            <div class="relative">
                <!-- Visual Connection Line on Desktop -->
                <div 
                    class="hidden lg:block absolute left-4 right-4 top-1/2 -translate-y-12 h-[2px]" 
                    style="background-image: linear-gradient(to right, transparent, rgba(232, 119, 12, 0.4) 10%, rgba(232, 119, 12, 0.4) 90%, transparent); z-index: 0;"
                ></div>

                <!-- Steps Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 lg:gap-8 relative z-10">
                    <div
                        v-for="(step, idx) in steps"
                        :key="step.id"
                        class="flex flex-col items-center text-center group"
                    >
                        <!-- Icon Circle & Step Badge -->
                        <div class="relative mb-6">
                            <!-- Orange Icon Circle -->
                            <div 
                                class="size-20 rounded-full flex items-center justify-center transition-all duration-300 group-hover:scale-110 shadow-md border-2 border-white"
                                style="background-color: #0B2540; color: #E8770C;"
                            >
                                <component
                                    :is="getIconComponent(step.icon)"
                                    class="size-8 stroke-[1.25]"
                                />
                            </div>

                            <!-- Step Number Badge -->
                            <div 
                                class="absolute -top-1 -right-1 size-7 rounded-full flex items-center justify-center font-mono text-xs font-bold text-white shadow-sm"
                                style="background-color: #E8770C;"
                            >
                                {{ step.value || `0${idx + 1}` }}
                            </div>
                        </div>

                        <!-- Step Info -->
                        <div class="space-y-2 px-2">
                            <h3 class="text-lg font-bold font-display text-primary-navy group-hover:text-primary-orange transition-colors">
                                {{ step.title }}
                            </h3>
                            <p class="font-body text-sm leading-relaxed text-secondary-txt">
                                {{ step.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
