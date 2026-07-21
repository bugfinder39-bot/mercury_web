<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight, Play, Pause, ShieldCheck, Globe2, Award, Ship, Plane, Truck, Package, ArrowRight } from '@lucide/vue';
import { ref, onMounted, onUnmounted, computed } from 'vue';

const props = defineProps<{
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
        hero_media?: {
            file_path: string;
        };
        items?: Array<{
            id: number;
            title: string;
            subtitle?: string;
            description?: string;
            value?: string; // Image path
            link?: string;
            order: number;
            image_media?: {
                file_path: string;
            };
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
        class="relative w-full h-[85vh] md:h-[90vh] overflow-hidden group/carousel"
        style="background-color: #0B2540;"
        @mouseenter="handleMouseEnter"
        @mouseleave="handleMouseLeave"
    >
        <!-- Floating Orange Accent Shapes -->
        <div class="absolute top-20 right-10 w-72 h-72 rounded-full bg-[#E8770C]/8 blur-3xl pointer-events-none z-10 animate-pulse duration-[8000ms]"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 rounded-full bg-[#E8770C]/6 blur-3xl pointer-events-none z-10 animate-pulse duration-[12000ms]"></div>

        <!-- Slow Moving Gradient Mesh Overlays -->
        <div class="absolute inset-0 pointer-events-none z-10 overflow-hidden select-none">
            <div class="absolute -top-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-gradient-to-br from-[#123a5e]/25 to-transparent blur-[120px] animate-[slowPulse_8s_ease-in-out_infinite]"></div>
            <div class="absolute -bottom-[30%] -right-[10%] w-[70%] h-[70%] rounded-full bg-gradient-to-tl from-[#e8770c]/12 to-transparent blur-[140px] animate-[slowPulse_12s_ease-in-out_infinite]"></div>
        </div>

        <!-- Drifting Cargo Icons in Background -->
        <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden select-none opacity-20">
            <div class="absolute top-[12%] left-[4%] text-[#E8770C] animate-[floatCargo1_16s_ease-in-out_infinite]">
                <Ship class="size-20 md:size-24 stroke-[1.2]" />
            </div>
            <div class="absolute top-[22%] right-[6%] text-white animate-[floatCargo2_20s_ease-in-out_infinite]">
                <Plane class="size-16 md:size-20 stroke-[1]" />
            </div>
            <div class="absolute bottom-[18%] left-[22%] text-white animate-[floatCargo3_22s_ease-in-out_infinite]">
                <Truck class="size-14 md:size-16 stroke-[1]" />
            </div>
            <div class="absolute bottom-[32%] right-[18%] text-[#E8770C] animate-[floatCargo1_24s_ease-in-out_infinite]">
                <Package class="size-12 md:size-16 stroke-[1]" />
            </div>
        </div>

        <!-- Subtle Particles -->
        <div class="absolute inset-0 pointer-events-none z-10 overflow-hidden opacity-30">
            <div class="absolute top-[15%] left-[38%] w-1.5 h-1.5 rounded-full bg-[#E8770C] animate-ping duration-[3000ms]"></div>
            <div class="absolute top-[48%] left-[75%] w-2 h-2 rounded-full bg-white opacity-40 animate-ping duration-[5000ms]"></div>
            <div class="absolute bottom-[28%] left-[18%] w-1 h-1 rounded-full bg-[#E8770C] animate-ping duration-[4000ms]"></div>
            <div class="absolute bottom-[68%] left-[55%] w-2.5 h-2.5 rounded-full bg-white opacity-20 animate-ping duration-[6000ms]"></div>
        </div>

        <!-- Slides -->
        <div class="relative w-full h-full">
            <div
                v-for="(slide, index) in slides"
                :key="slide.id"
                class="absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out"
                :class="index === currentIndex ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'"
            >
                <!-- Background Image with zoom & coordinate drift -->
                <div
                    class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-[7000ms] ease-out"
                    :style="{ 
                        backgroundImage: `url(${slide.image_media?.file_path || slide.value || section?.hero_media?.file_path || '/images/hero-sea.jpg'})`,
                        transform: index === currentIndex ? 'scale(1.08) translate(5px, 2px)' : 'scale(1.0)'
                    }"
                ></div>
                <!-- Navy Overlay -->
                <div class="absolute inset-0" style="background-color: rgba(11,37,64,0.76);"></div>

                <!-- Left-fade gradient overlay -->
                <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(11,37,64,0.2) 0%, rgba(11,37,64,0.1) 40%, transparent 100%);"></div>

                <!-- Slide Content -->
                <div class="absolute inset-0 flex items-center pt-16">
                    <div class="max-w-7xl mx-auto px-6 lg:px-10 w-full z-20 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                        
                        <!-- Left text area - wrapped in a premium Glass content card, re-keyed to restart word animations on change -->
                        <div 
                            :key="currentIndex + '-' + slide.id" 
                            class="lg:col-span-8 p-6 md:p-8 lg:p-10 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-md shadow-2xl space-y-6 animate-in fade-in-50 slide-in-from-bottom-10 duration-700"
                        >
                            <!-- Eyebrow Tag -->
                            <span class="inline-flex items-center gap-2 font-mono text-xs md:text-sm tracking-widest uppercase font-semibold text-[#E8770C]">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E8770C]"></span>
                                {{ section?.subheading || 'MB · GLOBAL LOGISTICS' }}
                            </span>

                            <!-- Heading: Word-by-word reveal animation -->
                            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold font-display text-white leading-[1.1] tracking-tight flex flex-wrap gap-x-3 gap-y-1">
                                <span 
                                    v-for="(word, wordIndex) in slide.title.split(' ')" 
                                    :key="wordIndex" 
                                    class="inline-block animate-[wordReveal_0.6s_ease-out_both]"
                                    :style="{ animationDelay: `${wordIndex * 0.08}s` }"
                                >
                                    {{ word }}
                                </span>
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
                                    class="btn-primary group"
                                >
                                    <span>{{ slide.subtitle || 'Explore Services' }}</span>
                                    <ArrowRight class="size-4" />
                                </Link>
                                <Link
                                    href="/contact"
                                    class="btn-secondary group border-white/30 text-white hover:border-transparent hover:bg-white hover:text-[#0B2540] inline-flex items-center justify-center"
                                    style="border-color: rgba(255,255,255,0.3); color: white;"
                                    onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.7)'; this.style.transform='translateY(-2px)';"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='rgba(255,255,255,0.3)'; this.style.transform='translateY(0)';"
                                >
                                    <span>Get a Quote</span>
                                    <ArrowRight class="size-4" />
                                </Link>
                            </div>
                        </div>

                        <!-- Right area - Floating statistics (Desktop only) -->
                        <div class="hidden lg:flex lg:col-span-4 flex-col gap-4">
                            <!-- Stat 1 -->
                            <div class="p-5 rounded-xl border border-white/10 bg-white/5 backdrop-blur-md flex items-center gap-4 transition-all duration-300 hover:bg-white/10 hover:border-[#E8770C]/30 shadow-lg hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(11,37,64,0.3),0_0_20px_rgba(232,119,12,0.15)]">
                                <div class="p-3 rounded-lg bg-[#E8770C]/20 text-[#E8770C]">
                                    <Globe2 class="size-6" />
                                </div>
                                <div>
                                    <h4 class="text-white text-xl font-bold font-display">Global Network</h4>
                                    <p class="text-xs text-white/60">Connecting major global trade lanes</p>
                                </div>
                            </div>

                            <!-- Stat 2 -->
                            <div class="p-5 rounded-xl border border-white/10 bg-white/5 backdrop-blur-md flex items-center gap-4 transition-all duration-300 hover:bg-white/10 hover:border-[#E8770C]/30 shadow-lg hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(11,37,64,0.3),0_0_20px_rgba(232,119,12,0.15)]">
                                <div class="p-3 rounded-lg bg-[#E8770C]/20 text-[#E8770C]">
                                    <ShieldCheck class="size-6" />
                                </div>
                                <div>
                                    <h4 class="text-white text-xl font-bold font-display">100% Reliable</h4>
                                    <p class="text-xs text-white/60">Secure logistics & supply chain integrity</p>
                                </div>
                            </div>

                            <!-- Stat 3 -->
                            <div class="p-5 rounded-xl border border-white/10 bg-white/5 backdrop-blur-md flex items-center gap-4 transition-all duration-300 hover:bg-white/10 hover:border-[#E8770C]/30 shadow-lg hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(11,37,64,0.3),0_0_20px_rgba(232,119,12,0.15)]">
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
