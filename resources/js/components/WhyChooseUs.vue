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
            icon?: string;
            order: number;
        }>;
    };
}>();

const items = computed(() => {
    return props.section?.items || [];
});

const getIconComponent = (iconName?: string) => {
    if (!iconName) {
        return Icons.CheckCircle;
    }

    const resolved = (Icons as any)[iconName];

    return resolved || Icons.CheckCircle;
};
</script>

<template>
    <div v-if="section" class="py-24 relative overflow-hidden bg-light-steel-blue-soft border-b border-light-steel-blue">
        <!-- Background elements -->
        <div class="gradient-blob gradient-blob-navy w-[450px] h-[450px] -top-32 -left-20 opacity-[0.06]"></div>
        <div class="gradient-blob gradient-blob-orange w-[300px] h-[300px] bottom-10 right-0 opacity-[0.05]"></div>

        <!-- Watermark -->
        <div class="text-watermark top-10 right-4 translate-x-12 select-none pointer-events-none opacity-25">
            Trust
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                <!-- Left Side: Header -->
                <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-28 reveal-slide-right">
                    <!-- Eyebrow -->
                    <span class="eyebrow-orange">
                        {{ section.subheading || 'WHY MERCURY' }}
                    </span>

                    <!-- Heading -->
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display leading-tight" style="color: #0B2540;">
                        {{ section.heading }}
                    </h2>

                    <!-- Orange divider -->
                    <div class="h-[3px] w-14 bg-gradient-to-r from-[#E8770C] to-[#0B2540]"></div>

                    <!-- Description -->
                    <p class="font-body text-base md:text-lg leading-relaxed text-slate-600">
                        {{ section.body }}
                    </p>
                </div>

                <!-- Right Side: Value Proposition Points -->
                <div class="lg:col-span-7 space-y-6">
                    <div
                        v-for="(item, idx) in items"
                        :key="item.id"
                        class="flex gap-6 p-7 rounded-2xl transition-all duration-300 card-premium hover-glow-card bg-white border border-slate-100/65 relative overflow-hidden reveal-fade-up"
                        :class="'stagger-' + (idx % 6 + 1)"
                    >
                        <!-- Top Accent line on hover -->
                        <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#E8770C] to-[#0B2540] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                        <!-- Accent corner -->
                        <div class="absolute top-0 right-0 w-8 h-8 bg-gradient-to-bl from-[#E8770C] to-transparent opacity-10 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>

                        <!-- Orange Icon Wrapper with float-gentle micro-animation -->
                        <div class="icon-orange-wrap flex-shrink-0 mt-0.5 shadow-sm group-hover:scale-110">
                            <component
                                :is="getIconComponent(item.icon)"
                                class="size-5 stroke-[1.8] float-gentle"
                            />
                        </div>

                        <!-- Content -->
                        <div class="space-y-2 relative z-10">
                            <h3 class="text-lg md:text-xl font-bold font-display transition-colors duration-200 group-hover:text-[#E8770C]" style="color: #0B2540;">
                                {{ item.title }}
                            </h3>
                            <p class="font-body text-sm md:text-base leading-relaxed text-slate-500">
                                {{ item.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
