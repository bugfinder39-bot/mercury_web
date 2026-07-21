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
        return Icons.ShieldCheck;
    }

    const resolved = (Icons as any)[iconName];

    return resolved || Icons.ShieldCheck;
};
</script>

<template>
    <div v-if="section" class="py-24 relative overflow-hidden bg-light-steel-blue-soft border-b border-light-steel-blue">
        <!-- Floating gradient blobs -->
        <div class="gradient-blob gradient-blob-navy w-[400px] h-[400px] -top-20 -right-20 opacity-[0.06]"></div>
        <div class="gradient-blob gradient-blob-orange w-[300px] h-[300px] -bottom-20 -left-10 opacity-[0.04]"></div>

        <!-- Watermark -->
        <div class="text-watermark top-10 right-4 translate-x-12 select-none pointer-events-none opacity-25">
            Reliable
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16 reveal-fade-up">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'TRUST & CREDIBILITY' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>
                <div class="h-1 w-12 rounded-full mx-auto" style="background-color: #E8770C;"></div>
                <p class="font-body text-base md:text-lg leading-relaxed text-secondary-txt" v-if="section.body">
                    {{ section.body }}
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <div
                    v-for="(item, index) in items"
                    :key="item.id"
                    class="card-premium hover-glow-card flex flex-col justify-between rounded-2xl bg-white hover:bg-gradient-to-br hover:from-white hover:to-[var(--color-light-steel-blue)]/10 reveal-fade-up"
                    :class="'stagger-' + (index % 6 + 1)"
                >
                    <!-- Accent Line top (Orange highlight) -->
                    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#E8770C] to-[#123A5E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                    <!-- Orange accent corner -->
                    <div class="absolute top-0 right-0 w-6 h-6 bg-gradient-to-bl from-[#E8770C] to-transparent opacity-5 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>

                    <div class="space-y-4">
                        <!-- Icon with bounce animation on hover -->
                        <div class="icon-orange-wrap group-hover:scale-110 shadow-sm transition-transform">
                            <component
                                :is="getIconComponent(item.icon)"
                                class="size-5 stroke-[1.8] group-hover:animate-[gentleFloat_3s_ease-in-out_infinite]"
                            />
                        </div>
                        
                        <!-- Title & Description -->
                        <h3 class="text-lg md:text-xl font-bold font-display text-primary-navy transition-colors duration-200 group-hover:text-[#E8770C]">
                            {{ item.title }}
                        </h3>
                        <p class="font-body text-sm md:text-base leading-relaxed text-secondary-txt">
                            {{ item.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
