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
        return Icons.ShieldCheck;
    }
    const resolved = (Icons as any)[iconName];
    return resolved || Icons.ShieldCheck;
};
</script>

<template>
    <div v-if="section" class="py-16 md:py-24" style="background-color: #EEF2F7; border-bottom: 1px solid rgba(11,37,64,0.08);">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'TRUST & CREDIBILITY' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>
                <div class="h-1 w-12 rounded-full mx-auto" style="background-color: #E8770C;"></div>
                <p class="font-body text-base md:text-lg leading-relaxed text-secondary-txt" v-if="section.body">
                    {{ section.body }}
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <div
                    v-for="item in items"
                    :key="item.id"
                    class="card-premium flex flex-col justify-between"
                >
                    <div class="space-y-4">
                        <!-- Icon -->
                        <div class="icon-orange-wrap">
                            <component
                                :is="getIconComponent(item.icon)"
                                class="size-5 stroke-[1.5]"
                            />
                        </div>
                        
                        <!-- Title & Description -->
                        <h3 class="text-lg md:text-xl font-bold font-display text-primary-navy">
                            {{ item.title }}
                        </h3>
                        <p class="font-body text-sm md:text-base leading-relaxed text-secondary-txt">
                            {{ item.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
