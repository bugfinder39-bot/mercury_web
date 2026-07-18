<script setup lang="ts">
import { ZoomIn, X, ChevronLeft, ChevronRight } from '@lucide/vue';
import { ref, computed } from 'vue';

interface GalleryItem {
    id?: number;
    title?: string;
    description?: string;
    value?: string; // used for image URL in database structure
    src?: string; // fallback/legacy structure
    is_active?: boolean;
}

const props = defineProps<{
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
    };
    images?: GalleryItem[];
}>();

// Harmonize list to ensure it supports both database items and raw array objects
const galleryImages = computed(() => {
    const list = props.images || [];
    return list.map(img => ({
        src: img.image_media?.file_path || img.value || img.src || '',
        title: img.title || '',
        description: img.description || '',
    })).filter(img => img.src);
});

// Lightbox state
const isLightboxOpen = ref(false);
const activeIndex = ref(0);

const openLightbox = (index: number) => {
    activeIndex.value = index;
    isLightboxOpen.value = true;
    document.body.style.overflow = 'hidden'; // prevent page scroll
};

const closeLightbox = () => {
    isLightboxOpen.value = false;
    document.body.style.overflow = '';
};

const nextImage = () => {
    if (galleryImages.value.length === 0) return;
    activeIndex.value = (activeIndex.value + 1) % galleryImages.value.length;
};

const prevImage = () => {
    if (galleryImages.value.length === 0) return;
    activeIndex.value = (activeIndex.value - 1 + galleryImages.value.length) % galleryImages.value.length;
};
</script>

<template>
    <div class="py-16 md:py-24" style="background-color: #ffffff; border-bottom: 1px solid rgba(11,37,64,0.08);">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div v-if="section" class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'VISUAL STORYTELLING' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight" style="color: #0B2540;">
                    {{ section.heading || 'Project Gallery' }}
                </h2>
                <div class="h-1 w-12 rounded-full mx-auto" style="background-color: #E8770C;"></div>
                <p class="font-body text-base md:text-lg leading-relaxed text-secondary-txt" v-if="section.body">
                    {{ section.body }}
                </p>
            </div>

            <!-- Responsive Image Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
                <div
                    v-for="(img, idx) in galleryImages"
                    :key="idx"
                    @click="openLightbox(idx)"
                    class="group relative overflow-hidden rounded-xl shadow-sm border border-slate-100 aspect-square cursor-pointer bg-slate-100"
                >
                    <!-- Image with Zoom Hover Effect -->
                    <img
                        :src="img.src"
                        :alt="img.title || 'Gallery image'"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        loading="lazy"
                    />

                    <!-- Dark Navy Overlay on Hover -->
                    <div 
                        class="absolute inset-0 bg-[#0B2540]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center p-4 text-center"
                    >
                        <!-- Orange Indicator Icon -->
                        <div class="size-10 rounded-full bg-white/10 flex items-center justify-center text-primary-orange mb-3 backdrop-blur-sm transform scale-75 group-hover:scale-100 transition-transform duration-300">
                            <ZoomIn class="size-5" />
                        </div>
                        
                        <!-- Title & Description -->
                        <h4 class="text-white font-display font-semibold text-sm truncate w-full" v-if="img.title">
                            {{ img.title }}
                        </h4>
                        <p class="text-slate-300 font-body text-xs line-clamp-2 mt-1 w-full" v-if="img.description">
                            {{ img.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lightbox Portal Modal -->
        <div 
            v-if="isLightboxOpen && galleryImages.length > 0" 
            class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-[#0B2540]/95 backdrop-blur-md animate-in fade-in duration-200"
            @click.self="closeLightbox"
        >
            <!-- Close Button -->
            <button 
                @click="closeLightbox" 
                class="absolute top-6 right-6 text-white hover:text-primary-orange p-2 rounded-full hover:bg-white/10 transition-colors cursor-pointer"
            >
                <X class="size-8" />
            </button>

            <!-- Main Image Wrapper -->
            <div class="relative max-w-5xl max-h-[80vh] w-full px-6 flex items-center justify-center select-none">
                <!-- Nav Prev Button -->
                <button 
                    @click="prevImage"
                    class="absolute left-6 z-10 size-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center hover:text-primary-orange transition-all cursor-pointer"
                >
                    <ChevronLeft class="size-6" />
                </button>

                <!-- Zoomed Image -->
                <img 
                    :src="galleryImages[activeIndex]?.src" 
                    :alt="galleryImages[activeIndex]?.title || 'Lightbox view'" 
                    class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl border border-white/10"
                />

                <!-- Nav Next Button -->
                <button 
                    @click="nextImage"
                    class="absolute right-6 z-10 size-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center hover:text-primary-orange transition-all cursor-pointer"
                >
                    <ChevronRight class="size-6" />
                </button>
            </div>

            <!-- Lightbox Title/Description Bar -->
            <div class="text-center mt-6 px-6 max-w-2xl text-white space-y-2 select-none">
                <h3 class="font-display font-bold text-lg text-white">
                    {{ galleryImages[activeIndex]?.title }}
                </h3>
                <p class="font-body text-sm text-slate-300">
                    {{ galleryImages[activeIndex]?.description }}
                </p>
                <span class="inline-block px-3 py-1 bg-white/10 rounded-full font-mono text-xs text-slate-300 mt-2">
                    {{ activeIndex + 1 }} / {{ galleryImages.length }}
                </span>
            </div>
        </div>
    </div>
</template>
