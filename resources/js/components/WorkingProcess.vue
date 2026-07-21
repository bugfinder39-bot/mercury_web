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
    <div v-if="section" class="py-24 relative overflow-hidden bg-light-steel-blue-soft border-y border-light-steel-blue">
        <!-- SVG wave divider top -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] z-10 pointer-events-none select-none">
            <svg class="relative block w-full h-[40px] text-white fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V0H1200V94.3C1122.6,108.37,1051.56,110.07,985.66,92.83Z"></path>
            </svg>
        </div>

        <!-- Background blobs and watermark -->
        <div class="gradient-blob gradient-blob-navy w-[450px] h-[450px] -top-12 -right-12 opacity-[0.06]"></div>
        <div class="gradient-blob gradient-blob-orange w-[300px] h-[300px] -bottom-10 left-[5%] opacity-[0.05]"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-20 reveal-fade-up">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'WORKFLOW' }}
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display leading-tight" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>
                <div class="h-[3px] w-12 bg-[#E8770C] rounded-full mx-auto"></div>
                <p class="font-body text-base text-slate-500 max-w-xl mx-auto" v-if="section.body">
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
                        class="flex flex-col items-center text-center group reveal-fade-up"
                        :class="'stagger-' + (idx % 6 + 1)"
                    >
                        <!-- Icon Circle & Step Badge -->
                        <div class="relative mb-6">
                            <!-- Orange Icon Circle -->
                            <div 
                                class="size-20 rounded-full flex items-center justify-center transition-all duration-300 group-hover:scale-110 shadow-md border-2 border-white group-hover:shadow-[0_0_25px_rgba(232,119,12,0.35)]"
                                style="background-color: #0B2540; color: #E8770C;"
                            >
                                <component
                                    :is="getIconComponent(step.icon)"
                                    class="size-8 stroke-[1.25] transition-transform duration-300 group-hover:rotate-12"
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
                        <div class="space-y-2 px-2 relative z-10">
                            <h3 class="text-lg font-bold font-display text-[#0B2540] group-hover:text-[#E8770C] transition-colors">
                                {{ step.title }}
                            </h3>
                            <p class="font-body text-sm leading-relaxed text-slate-500">
                                {{ step.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SVG wave divider bottom -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] z-10 pointer-events-none select-none">
            <svg class="relative block w-full h-[40px] text-white fill-current rotate-180" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V0H1200V94.3C1122.6,108.37,1051.56,110.07,985.66,92.83Z"></path>
            </svg>
        </div>
    </div>
</template>
