<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight, Play, Pause, ShieldCheck, Globe2, Award } from '@lucide/vue';
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
        class="relative w-full h-[85vh] md:h-[90vh] overflow-hidden group/carousel"
        style="background-color: #0B2540;"
        @mouseenter="handleMouseEnter"
        @mouseleave="handleMouseLeave"
    >
        <!-- Floating Orange Accent Shapes -->
        <div class="absolute top-20 right-10 w-72 h-72 rounded-full bg-[#E8770C]/8 blur-3xl pointer-events-none z-10 animate-pulse duration-[8000ms]"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 rounded-full bg-[#E8770C]/6 blur-3xl pointer-events-none z-10 animate-pulse duration-[12000ms]"></div>

        <!-- Slides -->
        <div class="relative w-full h-full">
            <div
                v-for="(slide, index) in slides"
                :key="slide.id"
                class="absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out"
                :class="index === currentIndex ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'"
            >
                <!-- Background Image with subtle movement -->
                <div
                    class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-[8000ms] ease-out"
                    :class="index === currentIndex ? 'scale-105' : 'scale-100'"
                    :style="{ backgroundImage: `url(${slide.image_media?.file_path || slide.value})` }"
                ></div>
                <!-- Navy Overlay -->
                <div class="absolute inset-0" style="background-color: rgba(11,37,64,0.78);"></div>

                <!-- Left-fade gradient -->
                <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(11,37,64,0.2) 0%, rgba(11,37,64,0.1) 40%, transparent 100%);"></div>

                <!-- Slide Content -->
                <div class="absolute inset-0 flex items-center pt-16">
                    <div class="max-w-7xl mx-auto px-6 lg:px-10 w-full z-20 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                        
                        <!-- Left text area - wrapped in a premium Glass content card -->
                        <div class="lg:col-span-8 p-6 md:p-8 lg:p-10 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-md shadow-2xl space-y-6 animate-in fade-in-50 slide-in-from-bottom-10 duration-700">
                            <!-- Eyebrow Tag -->
                            <span class="inline-flex items-center gap-2 font-mono text-xs md:text-sm tracking-widest uppercase font-semibold text-[#E8770C]">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E8770C]"></span>
                                {{ section?.subheading || 'MB · GLOBAL LOGISTICS' }}
                            </span>

                            <!-- Heading -->
                            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold font-display text-white leading-[1.1] tracking-tight">
                                {{ slide.title }}
                            </h1>

                            <!-- Description -->
                            <p class="text-sm md:text-base lg:text-lg font-body max-w-xl leading-relaxed text-white/80">
                                {{ slide.description }}
                            </p>

                            <!-- Actions -->
                            <div class="flex flex-wrap gap-4 pt-2">
                                <Link
                                    v-if="slide.link"
                                    :href="slide.link"
                                    class="btn-primary"
                                >
                                    {{ slide.subtitle || 'Explore Services' }}
                                </Link>
                                <Link
                                    href="/contact"
                                    class="inline-flex items-center justify-center px-6 py-3 font-body font-semibold text-sm rounded-full transition-all duration-300"
                                    style="background-color: transparent; border: 2px solid rgba(255,255,255,0.3); color: white;"
                                    onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.7)'; this.style.transform='translateY(-2px)';"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='rgba(255,255,255,0.3)'; this.style.transform='translateY(0)';"
                                >
                                    Get a Quote
                                </Link>
                            </div>
                        </div>

                        <!-- Right area - Floating statistics (Desktop only) -->
                        <div class="hidden lg:flex lg:col-span-4 flex-col gap-4">
                            <!-- Stat 1 -->
                            <div class="p-5 rounded-xl border border-white/10 bg-white/5 backdrop-blur-md flex items-center gap-4 transition-all duration-300 hover:bg-white/10 hover:border-[#E8770C]/30 shadow-lg">
                                <div class="p-3 rounded-lg bg-[#E8770C]/20 text-[#E8770C]">
                                    <Globe2 class="size-6" />
                                </div>
                                <div>
                                    <h4 class="text-white text-xl font-bold font-display">Global Network</h4>
                                    <p class="text-xs text-white/60">Connecting major global trade lanes</p>
                                </div>
                            </div>

                            <!-- Stat 2 -->
                            <div class="p-5 rounded-xl border border-white/10 bg-white/5 backdrop-blur-md flex items-center gap-4 transition-all duration-300 hover:bg-white/10 hover:border-[#E8770C]/30 shadow-lg">
                                <div class="p-3 rounded-lg bg-[#E8770C]/20 text-[#E8770C]">
                                    <ShieldCheck class="size-6" />
                                </div>
                                <div>
                                    <h4 class="text-white text-xl font-bold font-display">100% Reliable</h4>
                                    <p class="text-xs text-white/60">Secure logistics & supply chain integrity</p>
                                </div>
                            </div>

                            <!-- Stat 3 -->
                            <div class="p-5 rounded-xl border border-white/10 bg-white/5 backdrop-blur-md flex items-center gap-4 transition-all duration-300 hover:bg-white/10 hover:border-[#E8770C]/30 shadow-lg">
                                <div class="p-3 rounded-lg bg-[#E8770C]/20 text-[#E8770C]">
                                    <Award class="size-6" />
                                </div>
                                <div>
                                    <h4 class="text-white text-xl font-bold font-display">25+ Years</h4>
                                    <p class="text-xs text-white/60">Industry leading freight expertise</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button
            @click="prevSlide"
            class="absolute left-6 top-1/2 -translate-y-1/2 z-30 p-3 rounded-full transition-all duration-300 opacity-0 group-hover/carousel:opacity-100 focus:opacity-100"
            style="background-color: rgba(11,37,64,0.6); border: 1px solid rgba(255,255,255,0.15); color: white;"
            onmouseover="this.style.backgroundColor='#E8770C'; this.style.borderColor='#E8770C';"
            onmouseout="this.style.backgroundColor='rgba(11,37,64,0.6)'; this.style.borderColor='rgba(255,255,255,0.15)';"
            aria-label="Previous slide"
        >
            <ChevronLeft class="size-5" />
        </button>
        <button
            @click="nextSlide"
            class="absolute right-6 top-1/2 -translate-y-1/2 z-30 p-3 rounded-full transition-all duration-300 opacity-0 group-hover/carousel:opacity-100 focus:opacity-100"
            style="background-color: rgba(11,37,64,0.6); border: 1px solid rgba(255,255,255,0.15); color: white;"
            onmouseover="this.style.backgroundColor='#E8770C'; this.style.borderColor='#E8770C';"
            onmouseout="this.style.backgroundColor='rgba(11,37,64,0.6)'; this.style.borderColor='rgba(255,255,255,0.15)';"
            aria-label="Next slide"
        >
            <ChevronRight class="size-5" />
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
                    class="h-1.5 rounded-full transition-all duration-300"
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

        <!-- Animated Scroll Indicator -->
        <div class="absolute bottom-8 right-6 md:right-12 z-30 flex items-center gap-3 select-none pointer-events-none animate-bounce">
            <span class="font-mono text-[9px] tracking-widest text-white/50 uppercase">SCROLL DOWN</span>
            <div class="w-[14px] h-[24px] rounded-full border border-white/20 flex justify-center p-0.5">
                <div class="w-1 h-1.5 bg-[#E8770C] rounded-full"></div>
            </div>
        </div>

        <!-- Vertical orange accent line on the left -->
        <div class="absolute left-0 top-0 bottom-0 w-1.5 z-20" style="background: linear-gradient(to bottom, transparent, #E8770C 30%, #E8770C 70%, transparent);"></div>
    </div>
</template>
