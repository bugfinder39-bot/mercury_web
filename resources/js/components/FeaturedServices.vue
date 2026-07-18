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
    <div class="py-16 md:py-24" style="background-color: #F8FAFC;">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
                <span class="eyebrow-orange">
                    {{ section?.subheading || 'MB · CAPABILITIES' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-display" style="color: #0B2540;">
                    {{ section?.heading || 'Our Featured Services' }}
                </h2>
                <div class="flex justify-center">
                    <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>
                </div>
                <p v-if="section?.body" class="font-body text-base" style="color: #475569;">
                    {{ section.body }}
                </p>
                <p v-else class="font-body text-base" style="color: #475569;">
                    Reliable cargo coordination across air, sea, and land networks with licensed custom brokerage.
                </p>
            </div>

            <!-- Services Grid -->
            <div v-if="services.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="service in services" :key="service.id">
                    <ServiceCard :service="service" />
                </div>
            </div>
            <div v-else class="text-center py-12 font-body" style="color: #64748B;">
                No services currently featured.
            </div>
        </div>
    </div>
</template>
