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
    <div v-if="section && testimonials.length > 0" class="py-20 md:py-28" style="background-color: #F8FAFC; border-bottom: 1px solid rgba(11,37,64,0.05);">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-20">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'TESTIMONIALS' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight text-[#0B2540]">
                    {{ section.heading }}
                </h2>
                <div class="h-1 w-12 rounded-full mx-auto bg-[#E8770C]"></div>
                <p class="font-body text-base md:text-lg leading-relaxed text-[#123A5E]" v-if="section.body">
                    {{ section.body }}
                </p>
            </div>

            <!-- Testimonial Slider/Card (Interactive) -->
            <div class="max-w-4xl mx-auto relative px-4 md:px-12">
                <!-- Outer Wrapper with subtle border & background -->
                <div class="card-premium p-8 md:p-14 relative overflow-hidden bg-white shadow-xl min-h-[340px] flex flex-col justify-between rounded-2xl border border-slate-100/50">
                    
                    <!-- Top Quote Icon Accent -->
                    <div class="absolute right-8 top-8 text-slate-100/60 pointer-events-none">
                        <Quote class="size-24 md:size-32 rotate-180" />
                    </div>

                    <Transition name="fade" mode="out-in">
                        <div :key="currentIdx" class="flex flex-col justify-between h-full flex-grow">
                            <!-- Testimonial Body Content -->
                            <div class="space-y-6 relative z-10">
                                <!-- Rating Stars -->
                                <div class="flex gap-1.5">
                                    <Star 
                                        v-for="star in 5" 
                                        :key="star" 
                                        class="size-4.5 fill-current"
                                        :style="{ color: star <= parseInt(testimonials[currentIdx]?.value || '5') ? '#E8770C' : '#E2E8F0' }"
                                    />
                                </div>

                                <!-- Quote text -->
                                <blockquote class="font-display italic text-lg md:text-xl font-medium leading-relaxed text-[#0B2540]">
                                    "{{ testimonials[currentIdx]?.description || '' }}"
                                </blockquote>
                            </div>

                            <!-- Client Profile Footer -->
                            <div class="flex items-center gap-4 mt-8 relative z-10 border-t border-slate-100 pt-6">
                                <!-- Client Avatar Photo -->
                                <div class="size-14 rounded-full overflow-hidden flex-shrink-0 border-2 border-[#E8770C]/35 shadow-md">
                                    <img 
                                        :src="testimonials[currentIdx]?.image_media?.file_path || testimonials[currentIdx]?.icon || '/images/default-avatar.jpg'" 
                                        :alt="testimonials[currentIdx]?.title"
                                        class="size-full object-cover transition-transform duration-500 hover:scale-110"
                                        @error="($event.target as HTMLImageElement).src = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80'"
                                    />
                                </div>
                                
                                <!-- Client Name & Company Details -->
                                <div>
                                    <h4 class="font-display font-bold text-base text-[#0B2540]">
                                        {{ testimonials[currentIdx]?.title }}
                                    </h4>
                                    <p class="font-body text-xs text-slate-500">
                                        {{ testimonials[currentIdx]?.link }} <span v-if="testimonials[currentIdx]?.subtitle">• {{ testimonials[currentIdx]?.subtitle }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </Transition>
                </div>

                <!-- Navigation Buttons (rendered beside card on desktop, underneath on mobile) -->
                <div class="flex justify-center md:justify-between items-center gap-6 mt-8 md:absolute md:inset-x-0 md:top-1/2 md:-translate-y-1/2 md:mt-0 md:px-0 pointer-events-none">
                    <button
                        @click="prev"
                        class="size-12 rounded-full border border-slate-100 bg-white shadow-md flex items-center justify-center text-[#0B2540] hover:bg-slate-50 hover:text-[#E8770C] transition-all duration-300 pointer-events-auto cursor-pointer focus:outline-none hover:-translate-x-1"
                    >
                        <ChevronLeft class="size-5" />
                    </button>
                    <button
                        @click="next"
                        class="size-12 rounded-full border border-slate-100 bg-white shadow-md flex items-center justify-center text-[#0B2540] hover:bg-slate-50 hover:text-[#E8770C] transition-all duration-300 pointer-events-auto cursor-pointer focus:outline-none hover:translate-x-1"
                    >
                        <ChevronRight class="size-5" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}
.fade-enter-from {
  opacity: 0;
  transform: translateY(10px);
}
.fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>
