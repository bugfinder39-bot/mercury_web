<script setup lang="ts">
import * as Icons from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
        items?: Array<{
            id: number;
            title: string;
            description?: string;
            icon?: string;
            order: number;
        }>;
    };
}>();

const tiles = computed(() => {
    return props.section?.items || [];
});

const getIconComponent = (iconName?: string) => {
    if (!iconName) {
        return Icons.HelpCircle;
    }

    const resolved = (Icons as any)[iconName];

    return resolved || Icons.HelpCircle;
};
</script>

<template>
    <div v-if="section" class="py-24 relative overflow-hidden bg-light-steel-blue-soft border-y border-light-steel-blue">
        <!-- SVG wave divider top -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] z-10 pointer-events-none select-none">
            <svg class="relative block w-full h-[40px] text-white fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V0H1200V94.3C1122.6,108.37,1051.56,110.07,985.66,92.83Z"></path>
            </svg>
        </div>

        <!-- Background blobs and details -->
        <div class="gradient-blob gradient-blob-navy w-[400px] h-[400px] -top-10 -right-20 opacity-[0.06]"></div>
        <div class="gradient-blob gradient-blob-orange w-[300px] h-[300px] -bottom-20 -left-10 opacity-[0.05]"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-20 space-y-4 reveal-fade-up">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'OUR VALUES' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>
                <div class="flex justify-center">
                    <div class="h-[3px] w-12 bg-[#E8770C] rounded-full"></div>
                </div>
                <p v-if="section.body" class="font-body text-base text-slate-500">
                    {{ section.body }}
                </p>
            </div>

            <!-- Tiles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    v-for="(tile, index) in tiles"
                    :key="tile.id"
                    class="card-premium hover-glow-card p-8 md:p-10 space-y-6 bg-white border border-slate-100/65 relative overflow-hidden rounded-2xl hover:bg-gradient-to-br hover:from-white hover:to-[var(--color-light-steel-blue)]/15 reveal-fade-up"
                    :class="'stagger-' + (index % 6 + 1)"
                >
                    <!-- Tiny Orange left border accent on hover -->
                    <div class="absolute left-0 top-0 bottom-0 w-[3px] bg-gradient-to-b from-[#E8770C] to-[#0B2540] opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-l-2xl"></div>

                    <!-- Orange Icon Wrapper with float-gentle animation -->
                    <div class="icon-orange-wrap flex-shrink-0 mt-0.5 shadow-sm group-hover:scale-110">
                        <component
                            :is="getIconComponent(tile.icon)"
                            class="size-5 stroke-[1.8] float-gentle"
                        />
                    </div>

                    <!-- Content -->
                    <div class="space-y-3 relative z-10">
                        <h3 class="text-xl md:text-2xl font-bold font-display transition-colors duration-200 group-hover:text-[#E8770C]" style="color: #0B2540;">
                            {{ tile.title }}
                        </h3>
                        <p class="font-body text-sm md:text-base leading-relaxed text-slate-500">
                            {{ tile.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SVG wave divider bottom -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] z-10 pointer-events-none select-none">
            <svg class="relative block w-full h-[40px] text-white fill-current rotate-180" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V0H1200V94.3C1122.6,108.37,1051.56,110.07,985.66,92.83Z"></path>
            </svg>
        </div>
    </div>
</template>
