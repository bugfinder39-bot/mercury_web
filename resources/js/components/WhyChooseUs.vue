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
    <div v-if="section" class="py-16 md:py-24" style="background-color: #F8FAFC;">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                <!-- Left Side: Header -->
                <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-28">
                    <!-- Eyebrow -->
                    <span class="eyebrow-orange">
                        {{ section.subheading || 'WHY MERCURY' }}
                    </span>

                    <!-- Heading -->
                    <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight" style="color: #0B2540;">
                        {{ section.heading }}
                    </h2>

                    <!-- Orange divider -->
                    <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>

                    <!-- Description -->
                    <p class="font-body text-base md:text-lg leading-relaxed" style="color: #475569;">
                        {{ section.body }}
                    </p>
                </div>

                <!-- Right Side: Value Proposition Points -->
                <div class="lg:col-span-7 space-y-5">
                    <div
                        v-for="item in items"
                        :key="item.id"
                        class="flex gap-5 p-6 rounded-xl transition-all duration-200 card-premium shadow-card-hover"
                    >
                        <!-- Orange Icon Wrapper -->
                        <div class="icon-orange-wrap flex-shrink-0 mt-0.5">
                            <component
                                :is="getIconComponent(item.icon)"
                                class="size-5 stroke-[1.5]"
                            />
                        </div>

                        <!-- Content -->
                        <div class="space-y-2">
                            <h3 class="text-lg md:text-xl font-bold font-display" style="color: #0B2540;">
                                {{ item.title }}
                            </h3>
                            <p class="font-body text-sm md:text-base leading-relaxed" style="color: #475569;">
                                {{ item.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
