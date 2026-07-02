<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    partners?: Array<{
        id: number;
        name: string;
        logo?: string;
        link?: string;
        order: number;
    }>;
}>();

const activePartners = computed(() => {
    return props.partners || [];
});
</script>

<template>
    <div v-if="activePartners.length > 0" class="max-w-7xl mx-auto px-6 py-16 border-t border-base-300">
        <!-- Eyebrow Title -->
        <span class="font-mono text-[11px] md:text-xs uppercase tracking-[0.2em] text-base-content/60 text-center block mb-12">
            GLOBAL CARRIERS & SHIPPING LINES
        </span>

        <!-- Logo Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 items-center justify-items-center">
            <template v-for="partner in activePartners" :key="partner.id">
                <component 
                    :is="partner.link ? 'a' : 'div'"
                    :href="partner.link"
                    :target="partner.link ? '_blank' : undefined"
                    :rel="partner.link ? 'noopener noreferrer' : undefined"
                    class="h-10 w-full max-w-[140px] flex items-center justify-center transition-all duration-300 filter grayscale hover:grayscale-0 opacity-60 hover:opacity-100"
                    :title="partner.name"
                >
                    <img 
                        v-if="partner.logo"
                        :src="partner.logo" 
                        :alt="partner.name"
                        class="max-h-full max-w-full object-contain"
                        loading="lazy"
                        @error="($event.target as HTMLImageElement).style.display = 'none'"
                    />
                    <!-- Fallback if logo fails to load or is empty -->
                    <span class="font-display font-bold text-sm tracking-widest text-base-content bg-base-200 border border-base-300 py-1.5 px-3 rounded uppercase select-none">
                        {{ partner.name }}
                    </span>
                </component>
            </template>
        </div>
    </div>
</template>
