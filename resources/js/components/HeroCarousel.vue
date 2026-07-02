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
    // Check prefers-reduced-motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        isPlaying.value = false;

        return;
    }
    
    if (isPlaying.value && slides.value.length > 1) {
        autoplayTimer = setInterval(nextSlide, 7000); // 7 seconds interval
    }
};

const stopAutoplay = () => {
    if (autoplayTimer) {
        clearInterval(autoplayTimer);
        autoplayTimer = null;
    }
};

const handleMouseEnter = () => {
    stopAutoplay();
};

const handleMouseLeave = () => {
    if (isPlaying.value) {
        startAutoplay();
    }
};

onMounted(() => {
    startAutoplay();
});

onUnmounted(() => {
    stopAutoplay();
});
</script>

<template>
    <div 
        v-if="slides.length > 0"
        class="relative w-full h-[75vh] md:h-[80vh] bg-neutral overflow-hidden group/carousel"
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
                <!-- Background Image with overlay -->
                <div 
                    class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-[7000ms] ease-out"
                    :class="index === currentIndex ? 'scale-105' : 'scale-100'"
                    :style="{ backgroundImage: `url(${slide.value})` }"
                ></div>
                <div class="absolute inset-0 bg-neutral/80 mix-blend-multiply"></div>
                <!-- Additional brand overlay to achieve the subtle duotone look -->
                <div class="absolute inset-0 bg-gradient-to-r from-neutral via-neutral/90 to-transparent"></div>

                <!-- Slide Content -->
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-6 w-full z-20">
                        <div class="max-w-2xl space-y-6">
                            <!-- Eyebrow Tag -->
                            <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-amber uppercase">
                                {{ section?.subheading || 'MB · 01 — HERO' }}
                            </span>
                            
                            <!-- Archivo Headings -->
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display text-neutral-content leading-[1.1] tracking-tight">
                                {{ slide.title }}
                            </h1>
                            
                            <!-- Description -->
                            <p class="text-base md:text-lg text-neutral-content/80 font-body max-w-xl leading-relaxed">
                                {{ slide.description }}
                            </p>
                            
                            <!-- Actions -->
                            <div class="flex flex-wrap gap-4 pt-4">
                                <Link 
                                    v-if="slide.link"
                                    :href="slide.link"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-amber hover:bg-amber-dark text-white font-body font-medium text-sm rounded-lg transition-colors duration-150"
                                >
                                    {{ slide.subtitle || 'Explore Services' }}
                                </Link>
                                <Link 
                                    href="/contact"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-transparent border-2 border-white text-white hover:bg-white hover:text-neutral font-body font-medium text-sm rounded-lg transition-all duration-150"
                                >
                                    Get a Quote
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Arrows -->
        <button 
            @click="prevSlide"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-30 p-2 rounded-lg bg-neutral-900/40 hover:bg-neutral-900/80 text-white border border-white/10 hover:border-white/20 transition-all duration-150 opacity-0 group-hover/carousel:opacity-100 focus:opacity-100"
            aria-label="Previous slide"
        >
            <ChevronLeft class="size-6" />
        </button>
        <button 
            @click="nextSlide"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-30 p-2 rounded-lg bg-neutral-900/40 hover:bg-neutral-900/80 text-white border border-white/10 hover:border-white/20 transition-all duration-150 opacity-0 group-hover/carousel:opacity-100 focus:opacity-100"
            aria-label="Next slide"
        >
            <ChevronRight class="size-6" />
        </button>

        <!-- Bottom-Left Pagination Controls -->
        <div class="absolute bottom-8 left-6 md:left-12 z-30 flex items-center gap-6">
            <!-- Numeric Indicator -->
            <div class="flex items-center gap-1.5 font-mono text-xs md:text-sm text-white/80 font-medium">
                <span class="text-amber">0{{ currentIndex + 1 }}</span>
                <span class="text-white/40">/</span>
                <span>0{{ slides.length }}</span>
            </div>

            <!-- Dots -->
            <div class="flex items-center gap-2">
                <button 
                    v-for="(slide, index) in slides" 
                    :key="slide.id"
                    @click="setSlide(index)"
                    class="h-1.5 rounded-full transition-all duration-200"
                    :class="index === currentIndex ? 'w-6 bg-amber' : 'w-1.5 bg-white/40 hover:bg-white/70'"
                    :aria-label="`Go to slide ${index + 1}`"
                ></button>
            </div>

            <!-- Play/Pause Control -->
            <button 
                @click="togglePlay"
                class="p-1 rounded-md text-white/60 hover:text-white transition-colors"
                :aria-label="isPlaying ? 'Pause auto-rotation' : 'Play auto-rotation'"
            >
                <Pause v-if="isPlaying" class="size-4" />
                <Play v-else class="size-4" />
            </button>
        </div>
    </div>
</template>
