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
    <div v-if="section" class="py-16 md:py-24" style="background-color: #EEF2F7;">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
                <span class="eyebrow-orange">
                    {{ section.subheading || 'OUR VALUES' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display" style="color: #0B2540;">
                    {{ section.heading }}
                </h2>
                <div class="flex justify-center">
                    <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>
                </div>
                <p v-if="section.body" class="font-body text-base" style="color: #475569;">
                    {{ section.body }}
                </p>
            </div>

            <!-- Tiles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    v-for="tile in tiles"
                    :key="tile.id"
                    class="card-premium shadow-card-hover p-8 md:p-10 space-y-5"
                >
                    <!-- Orange Icon Wrapper -->
                    <div class="icon-orange-wrap">
                        <component
                            :is="getIconComponent(tile.icon)"
                            class="size-5 stroke-[1.5]"
                        />
                    </div>

                    <!-- Content -->
                    <div class="space-y-3">
                        <h3 class="text-xl md:text-2xl font-bold font-display" style="color: #0B2540;">
                            {{ tile.title }}
                        </h3>
                        <p class="font-body text-sm md:text-base leading-relaxed" style="color: #475569;">
                            {{ tile.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
