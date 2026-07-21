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
        class="card-premium group relative flex flex-col justify-between h-full p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(11,37,64,0.12),0_0_25px_rgba(232,119,12,0.12)] border border-slate-100 hover:border-[#E8770C]/35 bg-white rounded-2xl overflow-hidden hover:bg-gradient-to-br hover:from-white hover:to-[var(--color-light-steel-blue)]/15"
    >
        <!-- Card top line glow (Orange highlight) -->
        <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#E8770C] to-[#123A5E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

        <!-- Orange accent corner -->
        <div class="absolute top-0 right-0 w-8 h-8 bg-gradient-to-bl from-[#E8770C] to-transparent opacity-10 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>

        <!-- Glass highlight top gloss -->
        <div class="absolute inset-0 pointer-events-none bg-gradient-to-b from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        <div class="space-y-6">
            <!-- Orange Icon Wrapper inside rounded square with floating effect -->
            <div class="icon-orange-wrap transition-transform duration-300 group-hover:scale-110 group-hover:bg-[#E8770C]/20 shadow-sm relative">
                <component
                    :is="getIconComponent(service.icon)"
                    class="size-5 stroke-[1.8] transition-all duration-300 group-hover:animate-[gentleFloat_3s_ease-in-out_infinite]"
                />
            </div>

            <!-- Content -->
            <div class="space-y-3">
                <h3 class="text-xl font-bold font-display text-[#0B2540] group-hover:text-[#E8770C] transition-colors duration-250">
                    {{ service.name }}
                </h3>
                <p class="font-body text-sm leading-relaxed text-slate-500 line-clamp-3">
                    {{ service.short_description }}
                </p>
            </div>
        </div>

        <!-- Learn More Link with arrow animation -->
        <div class="pt-6 mt-auto">
            <button
                v-if="customClick"
                @click="$emit('click')"
                type="button"
                class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-wider font-semibold group/btn transition-colors text-[#E8770C] hover:text-[#CC6608]"
            >
                <span>Learn More</span>
                <ArrowRight class="size-3.5 transition-transform duration-200 group-hover/btn:translate-x-1.5" />
            </button>
            <Link
                v-else
                href="/services"
                class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-wider font-semibold group/btn transition-colors text-[#E8770C] hover:text-[#CC6608]"
            >
                <span>Learn More</span>
                <ArrowRight class="size-3.5 transition-transform duration-200 group-hover/btn:translate-x-1.5" />
            </Link>
        </div>
    </div>
</template>
