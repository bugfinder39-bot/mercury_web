<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import * as Icons from '@lucide/vue';
import { ref } from 'vue';
import HeroBanner from '@/components/HeroBanner.vue';
import ServiceCard from '@/components/ServiceCard.vue';
import TileGrid from '@/components/TileGrid.vue';
import PublicLayout from '@/layouts/PublicLayout.vue';

defineProps<{
    page: {
        id: number;
        name: string;
        slug: string;
        meta_title?: string;
        meta_description?: string;
    };
    sections: Array<{
        id: number;
        type: string;
        heading?: string;
        subheading?: string;
        body?: string;
        order: number;
        is_active: boolean;
        items?: any[];
    }>;
    services: Array<{
        id: number;
        name: string;
        slug: string;
        icon?: string;
        short_description?: string;
        long_description?: string;
    }>;
}>();

defineOptions({
    layout: PublicLayout,
});

const selectedService = ref<any>(null);
const isModalOpen = ref(false);

const openServiceModal = (service: any) => {
    selectedService.value = service;
    isModalOpen.value = true;
};

const closeServiceModal = () => {
    isModalOpen.value = false;
};

const getIconComponent = (iconName?: string) => {
    if (!iconName) {
return Icons.Ship;
}

    const resolved = (Icons as any)[iconName];

    return resolved || Icons.Ship;
};
</script>

<template>
    <Head>
        <title>{{ page?.meta_title || 'Our Services - Mercury Bangladesh' }}</title>
        <meta name="description" :content="page?.meta_description || 'Explore our full portfolio of logistics and freight services.'" />
    </Head>

    <div class="space-y-16 md:space-y-24 pb-24">
        <!-- Loop and dynamically render each section in the order returned by the CMS -->
        <template v-for="section in sections" :key="section.id">
            
            <HeroBanner 
                v-if="section.type === 'hero_banner'" 
                :section="section" 
            />

            <TileGrid 
                v-else-if="section.type === 'freight_moves'" 
                :section="section" 
            />

        </template>

        <!-- All Services Section (Portfolio Grid) -->
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
                <!-- Eyebrow -->
                <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-base-content/70 uppercase">
                    DATA · SERVICE PORTFOLIO
                </span>
                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold font-display text-base-content">
                    Our Freight & Logistics Operations
                </h2>
                <p class="text-base-content/70 font-body text-base">
                    From single shipments to integrated supply chain management, we oversee your cargo with exact precision.
                </p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <ServiceCard 
                    v-for="service in services" 
                    :key="service.id" 
                    :service="service" 
                    :customClick="true"
                    @click="openServiceModal(service)"
                />
            </div>
        </div>

        <!-- Service Detail Modal -->
        <div v-if="isModalOpen && selectedService" class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <!-- Modal Backdrop -->
            <div class="fixed inset-0 bg-neutral-900/40 backdrop-blur-xs transition-opacity duration-300" @click="closeServiceModal"></div>

            <!-- Modal Content -->
            <div class="relative bg-base-100 rounded-lg shadow-xl max-w-2xl w-full max-h-[85vh] flex flex-col z-10 border border-base-300 overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                <!-- Header -->
                <div class="p-6 md:p-8 border-b border-base-300 flex items-start justify-between">
                    <div class="flex items-center gap-4">
                        <div class="inline-flex p-3 rounded-lg bg-base-200 text-base-content">
                            <component 
                                :is="getIconComponent(selectedService.icon)" 
                                class="size-6 stroke-[1.5]" 
                            />
                        </div>
                        <div>
                            <span class="block font-mono text-xs tracking-wider text-base-content/70 uppercase">SERVICE DETAILS</span>
                            <h3 class="text-2xl font-bold font-display text-base-content mt-0.5">
                                {{ selectedService.name }}
                            </h3>
                        </div>
                    </div>
                    <button 
                        @click="closeServiceModal" 
                        class="p-2 text-base-content/70 hover:text-base-content hover:bg-base-200 rounded-lg transition-colors focus:outline-none"
                        aria-label="Close modal"
                    >
                        <component :is="Icons.X" class="size-5" />
                    </button>
                </div>

                <!-- Body (Scrollable) -->
                <div class="p-6 md:p-8 overflow-y-auto space-y-6 flex-grow font-body text-base-content/85 leading-relaxed text-sm md:text-base">
                    <div>
                        <p class="font-medium text-base-content mb-2">Service Overview</p>
                        <p class="text-base-content/75">{{ selectedService.short_description }}</p>
                    </div>

                    <div v-if="selectedService.long_description" class="pt-4 border-t border-base-300">
                        <p class="font-medium text-base-content mb-2">Scope of Operations</p>
                        <p class="text-base-content/75 whitespace-pre-line">{{ selectedService.long_description }}</p>
                    </div>
                </div>

                <!-- Footer / CTA -->
                <div class="p-6 bg-base-200 border-t border-base-300 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <span class="font-mono text-xs text-base-content/50 uppercase tracking-wide">
                        REF: MB-SRV-{{ selectedService.id }}
                    </span>
                    <div class="flex items-center gap-3">
                        <button 
                            @click="closeServiceModal" 
                            class="btn btn-sm btn-outline rounded-lg text-base-content font-body font-medium text-sm transition-colors focus:outline-none px-5 py-2.5 h-auto min-h-0"
                        >
                            Close
                        </button>
                        <Link 
                            :href="`/contact?subject=Inquiry: ${selectedService.name}`"
                            class="btn btn-sm bg-amber hover:bg-amber-dark text-white font-body font-medium text-sm rounded-lg border-none transition-colors inline-flex items-center justify-center px-5 py-2.5 h-auto min-h-0"
                        >
                            Request Quote
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
