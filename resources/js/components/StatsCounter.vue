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

// Store animated display values
const animatedValues = ref<number[]>([]);
const statsRef = ref<HTMLElement | null>(null);
const hasAnimated = ref(false);

const animateCounters = () => {
    if (hasAnimated.value) {
return;
}

    hasAnimated.value = true;

    const duration = 1200; // ms duration
    const startTime = performance.now();

    // Initialize values to 0
    animatedValues.value = stats.value.map(() => 0);

    const step = (now: number) => {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Easing function: ease-out quad
        const easeProgress = progress * (2 - progress);

        stats.value.forEach((stat, index) => {
            const targetVal = parseFloat(stat.value) || 0;
            animatedValues.value[index] = Math.round(targetVal * easeProgress);
        });

        if (progress < 1) {
            requestAnimationFrame(step);
        } else {
            // Ensure exact target value is set at the end
            stats.value.forEach((stat, index) => {
                animatedValues.value[index] = parseFloat(stat.value) || 0;
            });
        }
    };

    requestAnimationFrame(step);
};

onMounted(() => {
    // Check prefers-reduced-motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        // Skip animation, set directly
        animatedValues.value = stats.value.map(stat => parseFloat(stat.value) || 0);
        hasAnimated.value = true;

        return;
    }

    // Initialize display values to 0
    animatedValues.value = stats.value.map(() => 0);

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.disconnect();
            }
        });
    }, {
        threshold: 0.1
    });

    if (statsRef.value) {
        observer.observe(statsRef.value);
    }
});
</script>

<template>
    <div 
        v-if="section && stats.length > 0" 
        ref="statsRef"
        class="bg-neutral text-neutral-content py-16 md:py-24 relative overflow-hidden"
    >
        <!-- Background subtle graphic / route line divider representation -->
        <div class="absolute top-0 left-0 w-full h-[1px] bg-neutral-content/10"></div>
        <div class="absolute bottom-0 left-0 w-full h-[1px] bg-neutral-content/10"></div>

        <div class="max-w-7xl mx-auto px-6">
            <!-- Optional heading/intro inside stats bar if admin edits it -->
            <div v-if="section.heading" class="text-center max-w-2xl mx-auto mb-12 space-y-3">
                <span class="inline-block font-mono text-xs tracking-widest text-amber uppercase">
                    {{ section.subheading || 'DATA · PERFORMANCE' }}
                </span>
                <h3 class="text-2xl font-bold font-display text-neutral-content">
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
                    <!-- Divider (Desktop only) -->
                    <div 
                        v-if="index > 0" 
                        class="hidden lg:block absolute left-[-4%] top-1/2 -translate-y-1/2 w-[1px] h-12 bg-neutral-content/15"
                    ></div>

                    <!-- Number & Suffix -->
                    <div class="flex items-baseline justify-center font-display">
                        <span class="text-4xl md:text-5xl lg:text-6xl font-bold text-neutral-content tabular-nums">
                            {{ animatedValues[index] !== undefined ? animatedValues[index] : stat.value }}
                        </span>
                        <span class="text-3xl md:text-4xl font-bold text-amber">
                            {{ stat.subtitle }}
                        </span>
                    </div>

                    <!-- Label -->
                    <p class="font-mono text-xs md:text-sm uppercase tracking-wider text-neutral-content/85">
                        {{ stat.title }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
