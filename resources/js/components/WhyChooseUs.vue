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

const items = computed(() => {
    return props.section?.items || [];
});

const getIconComponent = (iconName?: string) => {
    if (!iconName) {
return Icons.CheckCircle;
}

    const resolved = (Icons as any)[iconName];

    return resolved || Icons.CheckCircle;
};
</script>

<template>
    <div v-if="section" class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            <!-- Left Side: Main Header and Value Prop Intro -->
            <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-28">
                <!-- Eyebrow -->
                <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-base-content/70 uppercase">
                    {{ section.subheading || 'ROUTE / WHY MERCURY' }}
                </span>
                
                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold font-display text-base-content leading-tight">
                    {{ section.heading }}
                </h2>
                
                <!-- Description -->
                <p class="text-base-content/70 font-body text-base md:text-lg leading-relaxed">
                    {{ section.body }}
                </p>
            </div>

            <!-- Right Side: Repeatable Value Proposition Points -->
            <div class="lg:col-span-7 space-y-8">
                <div 
                    v-for="item in items" 
                    :key="item.id" 
                    class="flex gap-6 p-6 rounded-lg border border-base-300 hover:border-neutral transition-colors bg-base-100"
                >
                    <!-- Icon -->
                    <div class="flex-shrink-0 text-amber mt-1">
                        <component 
                            :is="getIconComponent(item.icon)" 
                            class="size-6 stroke-[1.5]" 
                        />
                    </div>
                    
                    <!-- Content -->
                    <div class="space-y-2">
                        <h3 class="text-lg md:text-xl font-bold font-display text-base-content">
                            {{ item.title }}
                        </h3>
                        <p class="text-base-content/70 font-body text-sm md:text-base leading-relaxed">
                            {{ item.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
