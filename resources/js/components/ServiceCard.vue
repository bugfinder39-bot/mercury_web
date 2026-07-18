<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
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
        class="card-premium shadow-card-hover flex flex-col justify-between h-full p-7"
        style="transition: box-shadow 0.2s ease, border-color 0.2s ease, transform 0.2s ease;"
    >
        <div class="space-y-5">
            <!-- Orange Icon Wrapper -->
            <div class="icon-orange-wrap">
                <component
                    :is="getIconComponent(service.icon)"
                    class="size-5 stroke-[1.5]"
                />
            </div>

            <!-- Content -->
            <div class="space-y-3">
                <h3 class="text-xl md:text-2xl font-bold font-display" style="color: #0B2540;">
                    {{ service.name }}
                </h3>
                <p class="font-body text-sm md:text-base leading-relaxed line-clamp-3" style="color: #475569;">
                    {{ service.short_description }}
                </p>
            </div>
        </div>

        <!-- Learn More Link -->
        <div class="pt-6 mt-auto">
            <button
                v-if="customClick"
                @click="$emit('click')"
                type="button"
                class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-wider font-semibold group transition-colors"
                style="color: #E8770C;"
            >
                <span>Learn More</span>
                <ArrowRight class="size-4 transition-transform duration-150 group-hover:translate-x-1" />
            </button>
            <Link
                v-else
                href="/services"
                class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-wider font-semibold group transition-colors"
                style="color: #E8770C;"
            >
                <span>Learn More</span>
                <ArrowRight class="size-4 transition-transform duration-150 group-hover:translate-x-1" />
            </Link>
        </div>
    </div>
</template>
