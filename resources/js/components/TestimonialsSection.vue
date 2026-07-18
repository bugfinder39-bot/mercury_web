<script setup lang="ts">
import { ChevronLeft, ChevronRight, Star, Quote } from '@lucide/vue';
import { computed, ref } from 'vue';

const props = defineProps<{
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
        items?: Array<{
            id: number;
            title: string; // Used for customer Name
            subtitle?: string; // Used for Company / Position
            description?: string; // Used for Testimonial Text
            value?: string; // Used for Rating (e.g. "5")
            icon?: string; // Used for customer photo URL (fallback to placeholder if empty)
            link?: string; // Used for Position
            order: number;
        }>;
    };
}>();

const testimonials = computed(() => {
    return props.section?.items || [];
});

const currentIdx = ref(0);

const next = () => {
    if (testimonials.value.length === 0) return;
    currentIdx.value = (currentIdx.value + 1) % testimonials.value.length;
};

const prev = () => {
    if (testimonials.value.length === 0) return;
    currentIdx.value = (currentIdx.value - 1 + testimonials.value.length) % testimonials.value.length;
};
</script>

<template>
    <div v-if="section && testimonials.length > 0" class="py-16 md:py-24" style="background-color: #ffffff; border-bottom: 1px solid rgba(11,37,64,0.08);">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'TESTIMONIALS' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>
                <div class="h-1 w-12 rounded-full mx-auto" style="background-color: #E8770C;"></div>
                <p class="font-body text-base md:text-lg leading-relaxed text-secondary-txt" v-if="section.body">
                    {{ section.body }}
                </p>
            </div>

            <!-- Testimonial Slider/Card (Interactive) -->
            <div class="max-w-4xl mx-auto relative px-4 md:px-12">
                <!-- Outer Wrapper with subtle border & background -->
                <div class="card-premium p-8 md:p-12 relative overflow-hidden bg-slate-50 min-h-[300px] flex flex-col justify-between">
                    
                    <!-- Top Quote Icon Accent -->
                    <div class="absolute right-6 top-6 text-slate-200">
                        <Quote class="size-20 md:size-28 opacity-40 rotate-180" />
                    </div>

                    <!-- Testimonial Body Content -->
                    <div class="space-y-6 relative z-10">
                        <!-- Rating Stars -->
                        <div class="flex gap-1">
                            <Star 
                                v-for="star in 5" 
                                :key="star" 
                                class="size-5 fill-current"
                                :style="{ color: star <= parseInt(testimonials[currentIdx]?.value || '5') ? '#E8770C' : '#CBD5E1' }"
                            />
                        </div>

                        <!-- Quote text -->
                        <blockquote class="font-display italic text-lg md:text-xl font-medium leading-relaxed text-primary-navy">
                            "{{ testimonials[currentIdx]?.description || '' }}"
                        </blockquote>
                    </div>

                    <!-- Client Profile Footer -->
                    <div class="flex items-center gap-4 mt-8 relative z-10 border-t border-slate-200 pt-6">
                        <!-- Client Avatar Photo -->
                        <div class="size-14 rounded-full overflow-hidden flex-shrink-0 border-2 border-white shadow-sm">
                            <img 
                                :src="testimonials[currentIdx]?.image_media?.file_path || testimonials[currentIdx]?.icon || '/images/default-avatar.jpg'" 
                                :alt="testimonials[currentIdx]?.title"
                                class="size-full object-cover"
                                @error="($event.target as HTMLImageElement).src = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80'"
                            />
                        </div>
                        
                        <!-- Client Name & Company Details -->
                        <div>
                            <h4 class="font-display font-bold text-base text-primary-navy">
                                {{ testimonials[currentIdx]?.title }}
                            </h4>
                            <p class="font-body text-xs text-muted">
                                {{ testimonials[currentIdx]?.link }} <span v-if="testimonials[currentIdx]?.subtitle">• {{ testimonials[currentIdx]?.subtitle }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons (rendered beside card on desktop, underneath on mobile) -->
                <div class="flex justify-center md:justify-between items-center gap-6 mt-6 md:absolute md:inset-x-0 md:top-1/2 md:-translate-y-1/2 md:mt-0 md:px-0 pointer-events-none">
                    <button
                        @click="prev"
                        class="size-12 rounded-full border border-slate-200 bg-white shadow-sm flex items-center justify-center text-primary-navy hover:bg-slate-50 transition-colors pointer-events-auto cursor-pointer focus:outline-none"
                    >
                        <ChevronLeft class="size-5" />
                    </button>
                    <button
                        @click="next"
                        class="size-12 rounded-full border border-slate-200 bg-white shadow-sm flex items-center justify-center text-primary-navy hover:bg-slate-50 transition-colors pointer-events-auto cursor-pointer focus:outline-none"
                    >
                        <ChevronRight class="size-5" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
