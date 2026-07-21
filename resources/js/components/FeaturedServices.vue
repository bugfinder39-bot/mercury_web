<script setup lang="ts">
import ServiceCard from '@/components/ServiceCard.vue';

defineProps<{
    services: Array<{
        id: number;
        name: string;
        slug: string;
        icon?: string;
        short_description?: string;
        is_active: boolean;
        order: number;
    }>;
    section?: {
        heading?: string;
        subheading?: string;
        body?: string;
    };
}>();
</script>

<template>
    <div class="py-24 relative overflow-hidden bg-light-steel-blue-soft border-y border-light-steel-blue">
        <!-- Diagonal Section Divider Cut Top -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] z-10 pointer-events-none select-none">
            <svg class="relative block w-full h-[50px] text-white fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <polygon points="0,0 1200,0 1200,80 0,20" />
            </svg>
        </div>

        <!-- Background blobs and watermark -->
        <div class="gradient-blob gradient-blob-orange w-[300px] h-[300px] -top-10 left-[10%] opacity-[0.05]"></div>
        <div class="gradient-blob gradient-blob-navy w-[400px] h-[400px] -bottom-20 right-[5%] opacity-[0.06]"></div>

        <div class="text-watermark bottom-10 left-5 select-none pointer-events-none opacity-25">
            Solutions
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-20 space-y-4 reveal-fade-up">
                <span class="eyebrow-orange">
                    {{ section?.subheading || 'MB · CAPABILITIES' }}
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display" style="color: #0B2540;">
                    {{ section?.heading || 'Our Featured Services' }}
                </h2>
                <div class="flex justify-center">
                    <div class="h-[3px] w-12 bg-[#E8770C] rounded-full"></div>
                </div>
                <p v-if="section?.body" class="font-body text-base text-slate-500">
                    {{ section.body }}
                </p>
                <p v-else class="font-body text-base text-slate-500">
                    Reliable cargo coordination across air, sea, and land networks with licensed custom brokerage.
                </p>
            </div>

            <!-- Services Grid -->
            <div v-if="services.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="(service, idx) in services" :key="service.id" class="reveal-fade-up" :class="'stagger-' + (idx % 6 + 1)">
                    <ServiceCard :service="service" />
                </div>
            </div>
            <div v-else class="text-center py-12 font-body text-slate-400">
                No services currently featured.
            </div>
        </div>

        <!-- Diagonal Section Divider Cut Bottom -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] z-10 pointer-events-none select-none">
            <svg class="relative block w-full h-[50px] text-white fill-current rotate-180" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <polygon points="0,0 1200,0 1200,80 0,20" />
            </svg>
        </div>
    </div>
</template>
