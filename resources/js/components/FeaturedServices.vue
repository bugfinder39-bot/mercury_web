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
    <div class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
            <!-- Eyebrow -->
            <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-base-content/70 uppercase">
                {{ section?.subheading || 'MB · 04 — CAPABILITIES' }}
            </span>
            <!-- Heading -->
            <h2 class="text-3xl md:text-4xl font-bold font-display text-base-content">
                {{ section?.heading || 'Our Featured Services' }}
            </h2>
            <!-- Supporting text -->
            <p v-if="section?.body" class="text-base-content/70 font-body text-base">
                {{ section.body }}
            </p>
            <p v-else class="text-base-content/70 font-body text-base">
                Reliable cargo coordination across air, sea, and land networks with licensed custom brokerage.
            </p>
        </div>

        <!-- Services Grid -->
        <div v-if="services.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="service in services" :key="service.id">
                <ServiceCard :service="service" />
            </div>
        </div>
        <div v-else class="text-center text-base-content/50 font-body py-12">
            No services currently featured.
        </div>
    </div>
</template>
