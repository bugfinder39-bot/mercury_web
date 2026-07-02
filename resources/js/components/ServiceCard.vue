<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import * as Icons from '@lucide/vue';

defineProps<{
    service?: {
        id: number;
        name: string;
        slug: string;
        icon?: string;
        short_description?: string;
    };
    customClick?: boolean;
}>();

defineEmits<{
    (e: 'click'): void;
}>();

const getIconComponent = (iconName?: string) => {
    if (!iconName) {
return Icons.Ship;
}

    const resolved = (Icons as any)[iconName];

    return resolved || Icons.Ship;
};
</script>

<template>
    <div 
        v-if="service"
        class="border border-base-300 p-8 rounded-lg bg-base-100 flex flex-col justify-between h-full transition-colors duration-200 hover:border-neutral"
    >
        <div class="space-y-6">
            <!-- Icon -->
            <div class="inline-flex p-3 rounded-lg bg-base-200 text-base-content">
                <component 
                    :is="getIconComponent(service.icon)" 
                    class="size-6 stroke-[1.5]" 
                />
            </div>
            
            <!-- Content -->
            <div class="space-y-3">
                <h3 class="text-xl md:text-2xl font-bold font-display text-base-content">
                    {{ service.name }}
                </h3>
                <p class="text-base-content/70 font-body text-sm md:text-base leading-relaxed line-clamp-3">
                    {{ service.short_description }}
                </p>
            </div>
        </div>

        <!-- Learn More Link -->
        <div class="pt-6">
            <button 
                v-if="customClick"
                @click="$emit('click')"
                type="button"
                class="inline-flex items-center gap-1.5 font-mono text-xs uppercase tracking-wider text-amber hover:text-amber-dark font-medium group transition-colors focus:outline-none"
            >
                <span>Learn More</span>
                <span class="transition-transform duration-150 group-hover:translate-x-1">→</span>
            </button>
            <Link 
                v-else
                href="/services" 
                class="inline-flex items-center gap-1.5 font-mono text-xs uppercase tracking-wider text-amber hover:text-amber-dark font-medium group transition-colors"
            >
                <span>Learn More</span>
                <span class="transition-transform duration-150 group-hover:translate-x-1">→</span>
            </Link>
        </div>
    </div>
</template>
