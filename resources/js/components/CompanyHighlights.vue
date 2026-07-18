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
const countAnimationTimeouts = ref<number[]>([]);

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
    <div v-if="section" class="py-16 md:py-24" style="background-color: #ffffff; border-bottom: 1px solid rgba(11,37,64,0.08);">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'HIGHLIGHTS & SCALE' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight" style="color: #0B2540;">
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
                    v-for="item in items"
                    :key="item.id"
                    class="card-premium flex flex-col justify-between items-center text-center p-8 hover:translate-y-[-4px] transition-transform duration-300"
                >
                    <div class="space-y-4 w-full flex flex-col items-center">
                        <!-- Icon -->
                        <div class="icon-orange-wrap mb-2">
                            <component
                                :is="getIconComponent(item.icon)"
                                class="size-6 stroke-[1.5]"
                            />
                        </div>

                        <!-- Numeric Value -->
                        <div class="flex items-baseline justify-center">
                            <span class="text-4xl md:text-5xl font-black font-display tracking-tight text-primary-navy">
                                {{ counts[item.id] !== undefined ? counts[item.id] : (item.value || '0') }}
                            </span>
                            <span class="text-2xl md:text-3xl font-bold text-primary-orange ml-0.5">
                                {{ item.subtitle || '' }}
                            </span>
                        </div>
                        
                        <!-- Title & Description -->
                        <h3 class="text-lg font-bold font-display text-primary-navy">
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
