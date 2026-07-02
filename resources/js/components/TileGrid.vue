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
    <div v-if="section" class="max-w-7xl mx-auto px-6 py-16 md:py-24 bg-base-200 rounded-xl">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
            <!-- Eyebrow -->
            <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-base-content/70 uppercase">
                {{ section.subheading || 'MB · 03 — VALUES' }}
            </span>
            <!-- Heading -->
            <h2 class="text-3xl md:text-4xl font-bold font-display text-base-content">
                {{ section.heading }}
            </h2>
            <!-- Optional Subtext -->
            <p v-if="section.body" class="text-base-content/70 font-body text-base">
                {{ section.body }}
            </p>
        </div>

        <!-- Tiles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div 
                v-for="tile in tiles" 
                :key="tile.id"
                class="border border-base-300 p-8 md:p-10 rounded-lg bg-base-100 space-y-6 transition-colors duration-200 hover:border-neutral"
            >
                <!-- Icon (Line-style, 1.5px stroke weight, single color) -->
                <div class="inline-flex p-3 rounded-lg bg-base-200 text-base-content">
                    <component 
                        :is="getIconComponent(tile.icon)" 
                        class="size-6 stroke-[1.5]" 
                    />
                </div>
                
                <!-- Content -->
                <div class="space-y-3">
                    <h3 class="text-xl md:text-2xl font-bold font-display text-base-content">
                        {{ tile.title }}
                    </h3>
                    <p class="text-base-content/70 font-body text-sm md:text-base leading-relaxed">
                        {{ tile.description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
