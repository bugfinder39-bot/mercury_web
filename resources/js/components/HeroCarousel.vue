<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight, Play, Pause } from '@lucide/vue';
import { ref, onMounted, onUnmounted, computed } from 'vue';

const props = defineProps<{
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
        items?: Array<{
            id: number;
            title: string;
            subtitle?: string;
            description?: string;
            value?: string; // Image path
            link?: string;
            order: number;
        }>;
    };
}>();

const slides = computed(() => {
    return props.section?.items || [];
});

const currentIndex = ref(0);
const isPlaying = ref(true);
let autoplayTimer: any = null;

const nextSlide = () => {
    if (slides.value.length === 0) {
return;
}

    currentIndex.value = (currentIndex.value + 1) % slides.value.length;
};

const prevSlide = () => {
    if (slides.value.length === 0) {
return;
}

    currentIndex.value = (currentIndex.value - 1 + slides.value.length) % slides.value.length;
};

const setSlide = (index: number) => {
    currentIndex.value = index;
};

const togglePlay = () => {
    isPlaying.value = !isPlaying.value;

    if (isPlaying.value) {
        startAutoplay();
    } else {
        stopAutoplay();
    }
};

const startAutoplay = () => {
    stopAutoplay();
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        isPlaying.value = false;

        return;
    }

    if (isPlaying.value && slides.value.length > 1) {
        autoplayTimer = setInterval(nextSlide, 7000);
    }
};

const stopAutoplay = () => {
    if (autoplayTimer) {
        clearInterval(autoplayTimer);
        autoplayTimer = null;
    }
};

const handleMouseEnter = () => { stopAutoplay(); };
const handleMouseLeave = () => { if (isPlaying.value) { startAutoplay(); } };

onMounted(() => { startAutoplay(); });
onUnmounted(() => { stopAutoplay(); });
</script>

<template>
    <div
        v-if="slides.length > 0"
        class="relative w-full h-[75vh] md:h-[85vh] overflow-hidden group/carousel"
        style="background-color: #0B2540;"
        @mouseenter="handleMouseEnter"
        @mouseleave="handleMouseLeave"
    >
        <!-- Slides -->
        <div class="relative w-full h-full">
            <div
                v-for="(slide, index) in slides"
                :key="slide.id"
                class="absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out"
                :class="index === currentIndex ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'"
            >
                <!-- Background Image -->
                <div
                    class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-[7000ms] ease-out"
                    :class="index === currentIndex ? 'scale-105' : 'scale-100'"
                    :style="{ backgroundImage: `url(${slide.image_media?.file_path || slide.value})` }"
                ></div>
                <!-- Navy Overlay -->
                <div class="absolute inset-0" style="background-color: rgba(11,37,64,0.75);"></div>
                <!-- Left-fade gradient -->
                <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(11,37,64,0.08) 0%, rgba(11,37,64,0.02) 25%, rgba(11,37,64,0) 50%);"></div>

                <!-- Slide Content -->
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-6 lg:px-10 w-full z-20">
                        <div class="max-w-2xl space-y-6">
                            <!-- Eyebrow Tag -->
                            <span class="inline-block font-mono text-xs md:text-sm tracking-widest uppercase" style="color: #E8770C;">
                                {{ section?.subheading || 'MB · GLOBAL LOGISTICS' }}
                            </span>

                            <!-- Heading -->
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display text-white leading-[1.1] tracking-tight">
                                {{ slide.title }}
                            </h1>

                            <!-- Description -->
                            <p class="text-base md:text-lg font-body max-w-xl leading-relaxed" style="color: rgba(255,255,255,0.80);">
                                {{ slide.description }}
                            </p>

                            <!-- Actions -->
                            <div class="flex flex-wrap gap-4 pt-4">
                                <Link
                                    v-if="slide.link"
                                    :href="slide.link"
                                    class="btn-primary"
                                >
                                    {{ slide.subtitle || 'Explore Services' }}
                                </Link>
                                <Link
                                    href="/contact"
                                    class="inline-flex items-center justify-center px-6 py-3 font-body font-semibold text-sm rounded-lg transition-all duration-150"
                                    style="background-color: transparent; border: 1.5px solid rgba(255,255,255,0.50); color: white;"
                                    onmouseover="this.style.backgroundColor='rgba(255,255,255,0.12)'; this.style.borderColor='rgba(255,255,255,0.80)';"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='rgba(255,255,255,0.50)';"
                                >
                                    Get a Quote
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button
            @click="prevSlide"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-30 p-2.5 rounded-lg transition-all duration-150 opacity-0 group-hover/carousel:opacity-100 focus:opacity-100"
            style="background-color: rgba(11,37,64,0.60); border: 1px solid rgba(255,255,255,0.15); color: white;"
            aria-label="Previous slide"
        >
            <ChevronLeft class="size-6" />
        </button>
        <button
            @click="nextSlide"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-30 p-2.5 rounded-lg transition-all duration-150 opacity-0 group-hover/carousel:opacity-100 focus:opacity-100"
            style="background-color: rgba(11,37,64,0.60); border: 1px solid rgba(255,255,255,0.15); color: white;"
            aria-label="Next slide"
        >
            <ChevronRight class="size-6" />
        </button>

        <!-- Bottom Pagination Controls -->
        <div class="absolute bottom-8 left-6 md:left-12 z-30 flex items-center gap-6">
            <!-- Numeric Indicator -->
            <div class="flex items-center gap-1.5 font-mono text-xs md:text-sm font-medium">
                <span style="color: #E8770C;">0{{ currentIndex + 1 }}</span>
                <span style="color: rgba(255,255,255,0.35);">/</span>
                <span style="color: rgba(255,255,255,0.70);">0{{ slides.length }}</span>
            </div>

            <!-- Dots -->
            <div class="flex items-center gap-2">
                <button
                    v-for="(slide, index) in slides"
                    :key="slide.id"
                    @click="setSlide(index)"
                    class="h-1.5 rounded-full transition-all duration-200"
                    :style="index === currentIndex
                        ? 'width: 1.5rem; background-color: #E8770C;'
                        : 'width: 0.375rem; background-color: rgba(255,255,255,0.35);'"
                    :aria-label="`Go to slide ${index + 1}`"
                ></button>
            </div>

            <!-- Play/Pause -->
            <button
                @click="togglePlay"
                class="p-1 rounded-md transition-colors"
                style="color: rgba(255,255,255,0.55);"
                :aria-label="isPlaying ? 'Pause auto-rotation' : 'Play auto-rotation'"
            >
                <Pause v-if="isPlaying" class="size-4" />
                <Play v-else class="size-4" />
            </button>
        </div>

        <!-- Vertical orange accent line on the left -->
        <div class="absolute left-0 top-0 bottom-0 w-1 z-20" style="background: linear-gradient(to bottom, transparent, #E8770C 30%, #E8770C 70%, transparent);"></div>
    </div>
</template>
