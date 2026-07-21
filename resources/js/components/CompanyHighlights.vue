<script setup lang="ts">
import * as Icons from '@lucide/vue';
import { computed, ref, onMounted } from 'vue';

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
            value?: string; // e.g. "15", "120", "99"
            subtitle?: string; // e.g. "+", "%"
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
        return Icons.BarChart3;
    }

    const resolved = (Icons as any)[iconName];

    return resolved || Icons.BarChart3;
};

// Numerical counters state
const counts = ref<Record<number, number>>({});

onMounted(() => {
    // Initialize counting animation for all items
    items.value.forEach(item => {
        const valStr = item.value?.replace(/[^0-9]/g, '');
        const targetValue = parseInt(valStr || '0', 10);
        
        if (!isNaN(targetValue) && targetValue > 0) {
            counts.value[item.id] = 0;
            const duration = 1200; // ms
            const intervalTime = 30; // ms
            const step = targetValue / (duration / intervalTime);
            
            let current = 0;
            const timer = setInterval(() => {
                current += step;

                if (current >= targetValue) {
                    counts.value[item.id] = targetValue;
                    clearInterval(timer);
                } else {
                    counts.value[item.id] = Math.floor(current);
                }
            }, intervalTime);
        } else {
            // Non-numeric fallback
            counts.value[item.id] = 0;
        }
    });
});
</script>

<template>
    <div v-if="section" class="py-24 relative overflow-hidden bg-light-steel-blue-soft border-b border-light-steel-blue">
        <!-- Floating gradient blobs -->
        <div class="gradient-blob gradient-blob-navy w-[400px] h-[400px] -top-20 -right-20 opacity-[0.06]"></div>
        <div class="gradient-blob gradient-blob-orange w-[300px] h-[300px] -bottom-20 -left-10 opacity-[0.04]"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16 reveal-fade-up">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'HIGHLIGHTS & SCALE' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight text-primary-navy">
                    {{ section.heading }}
                </h2>
                <div class="h-1 w-12 rounded-full mx-auto" style="background-color: #E8770C;"></div>
                <p class="font-body text-base md:text-lg leading-relaxed text-secondary-txt" v-if="section.body">
                    {{ section.body }}
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <div
                    v-for="(item, index) in items"
                    :key="item.id"
                    class="card-premium flex flex-col justify-between items-center text-center p-8 rounded-2xl bg-white hover:bg-gradient-to-br hover:from-white hover:to-[var(--color-light-steel-blue)]/15 transition-all duration-300 hover:shadow-card-glow hover:-translate-y-1.5 reveal-fade-up relative overflow-hidden"
                    :class="'stagger-' + (index % 6 + 1)"
                >
                    <!-- Top Accent line on hover -->
                    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#E8770C] to-[#123A5E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                    <!-- Accent corner -->
                    <div class="absolute top-0 right-0 w-8 h-8 bg-gradient-to-bl from-[#E8770C] to-transparent opacity-10 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>

                    <div class="space-y-4 w-full flex flex-col items-center relative z-10">
                        <!-- Icon with bounce animation on hover -->
                        <div class="icon-orange-wrap mb-2 group-hover:scale-110 transition-transform">
                            <component
                                :is="getIconComponent(item.icon)"
                                class="size-6 stroke-[1.8] group-hover:animate-[gentleFloat_3s_ease-in-out_infinite]"
                            />
                        </div>

                        <!-- Numeric Value -->
                        <div class="flex items-baseline justify-center">
                            <span class="text-4xl md:text-5xl font-black font-display tracking-tight text-primary-navy transition-all duration-300 group-hover:scale-105">
                                {{ counts[item.id] !== undefined ? counts[item.id] : (item.value || '0') }}
                            </span>
                            <span class="text-2xl md:text-3xl font-bold text-primary-orange ml-0.5">
                                {{ item.subtitle || '' }}
                            </span>
                        </div>
                        
                        <!-- Title & Description -->
                        <h3 class="text-lg font-bold font-display text-primary-navy group-hover:text-primary-orange transition-colors">
                            {{ item.title }}
                        </h3>
                        <p class="font-body text-xs md:text-sm leading-relaxed text-secondary-txt">
                            {{ item.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
