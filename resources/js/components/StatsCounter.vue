<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';

const props = defineProps<{
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
        items?: Array<{
            id: number;
            title: string; // "Years of Experience"
            value: string; // "15"
            subtitle?: string; // "+"
            order: number;
        }>;
    };
}>();

const stats = computed(() => {
    return props.section?.items || [];
});

const animatedValues = ref<number[]>([]);
const statsRef = ref<HTMLElement | null>(null);
const hasAnimated = ref(false);

const animateCounters = () => {
    if (hasAnimated.value) {
return;
}

    hasAnimated.value = true;

    const duration = 1200;
    const startTime = performance.now();

    animatedValues.value = stats.value.map(() => 0);

    const step = (now: number) => {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easeProgress = progress * (2 - progress);

        stats.value.forEach((stat, index) => {
            const targetVal = parseFloat(stat.value) || 0;
            animatedValues.value[index] = Math.round(targetVal * easeProgress);
        });

        if (progress < 1) {
            requestAnimationFrame(step);
        } else {
            stats.value.forEach((stat, index) => {
                animatedValues.value[index] = parseFloat(stat.value) || 0;
            });
        }
    };

    requestAnimationFrame(step);
};

onMounted(() => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        animatedValues.value = stats.value.map(stat => parseFloat(stat.value) || 0);
        hasAnimated.value = true;

        return;
    }

    animatedValues.value = stats.value.map(() => 0);

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.disconnect();
            }
        });
    }, { threshold: 0.1 });

    if (statsRef.value) {
        observer.observe(statsRef.value);
    }
});
</script>

<template>
    <div
        v-if="section && stats.length > 0"
        ref="statsRef"
        class="relative overflow-hidden py-16 md:py-24"
        style="background-color: #0B2540;"
    >
        <!-- Subtle background decoration -->
        <div class="absolute inset-0 pointer-events-none opacity-[0.04]">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <line x1="0" y1="50%" x2="100%" y2="50%" stroke="white" stroke-width="1" stroke-dasharray="10,10" />
            </svg>
        </div>
        <!-- Top / Bottom orange accent lines -->
        <div class="absolute top-0 left-0 w-full h-0.5" style="background: linear-gradient(to right, transparent, #E8770C 30%, #E8770C 70%, transparent);"></div>
        <div class="absolute bottom-0 left-0 w-full h-0.5" style="background: linear-gradient(to right, transparent, #E8770C 30%, #E8770C 70%, transparent);"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Optional heading -->
            <div v-if="section.heading" class="text-center max-w-2xl mx-auto mb-14 space-y-3">
                <span class="inline-block font-mono text-xs tracking-widest uppercase" style="color: #E8770C;">
                    {{ section.subheading || 'DATA · PERFORMANCE' }}
                </span>
                <h3 class="text-2xl font-bold font-display text-white">
                    {{ section.heading }}
                </h3>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 text-center relative">
                <div
                    v-for="(stat, index) in stats"
                    :key="stat.id"
                    class="space-y-3 relative group"
                >
                    <!-- Vertical divider (desktop) -->
                    <div
                        v-if="index > 0"
                        class="hidden lg:block absolute left-[-4%] top-1/2 -translate-y-1/2 w-[1px] h-12"
                        style="background-color: rgba(255,255,255,0.12);"
                    ></div>

                    <!-- Number & Suffix -->
                    <div class="flex items-baseline justify-center font-display">
                        <span class="text-4xl md:text-5xl lg:text-6xl font-bold text-white tabular-nums">
                            {{ animatedValues[index] !== undefined ? animatedValues[index] : stat.value }}
                        </span>
                        <span class="text-3xl md:text-4xl font-bold" style="color: #E8770C;">
                            {{ stat.subtitle }}
                        </span>
                    </div>

                    <!-- Label -->
                    <p class="font-mono text-xs md:text-sm uppercase tracking-wider" style="color: rgba(255,255,255,0.70);">
                        {{ stat.title }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
