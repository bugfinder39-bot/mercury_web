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

    <div class="pb-24">
        <!-- CMS Sections -->
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

        <!-- All Services Section -->
        <div class="py-16 md:py-24" style="background-color: #F8FAFC;">
            <div class="max-w-7xl mx-auto px-6">
                <!-- Section Header -->
                <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
                    <span class="eyebrow-orange">DATA · SERVICE PORTFOLIO</span>
                    <h2 class="text-3xl md:text-4xl font-bold font-display" style="color: #0B2540;">
                        Our Freight &amp; Logistics Operations
                    </h2>
                    <div class="flex justify-center">
                        <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>
                    </div>
                    <p class="font-body text-base" style="color: #475569;">
                        From single shipments to integrated supply chain management, we oversee your cargo with exact precision.
                    </p>
                </div>

                <!-- Services Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <ServiceCard
                        v-for="service in services"
                        :key="service.id"
                        :service="service"
                        :customClick="true"
                        @click="openServiceModal(service)"
                    />
                </div>
            </div>
        </div>

        <!-- Service Detail Modal -->
        <div v-if="isModalOpen && selectedService" class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <!-- Backdrop -->
            <div
                class="fixed inset-0 backdrop-blur-sm transition-opacity duration-300"
                style="background-color: rgba(11,37,64,0.50);"
                @click="closeServiceModal"
            ></div>

            <!-- Modal Content -->
            <div
                class="relative rounded-xl shadow-xl max-w-2xl w-full max-h-[85vh] flex flex-col z-10 overflow-hidden animate-in fade-in zoom-in-95 duration-200"
                style="background-color: #ffffff; border: 1px solid rgba(11,37,64,0.10);"
            >
                <!-- Header -->
                <div class="p-6 md:p-8 flex items-start justify-between" style="border-bottom: 1px solid rgba(11,37,64,0.08);">
                    <div class="flex items-center gap-4">
                        <div class="icon-orange-wrap">
                            <component
                                :is="getIconComponent(selectedService.icon)"
                                class="size-5 stroke-[1.5]"
                            />
                        </div>
                        <div>
                            <span class="block font-mono text-xs tracking-wider uppercase" style="color: #64748B;">SERVICE DETAILS</span>
                            <h3 class="text-2xl font-bold font-display mt-0.5" style="color: #0B2540;">
                                {{ selectedService.name }}
                            </h3>
                        </div>
                    </div>
                    <button
                        @click="closeServiceModal"
                        class="p-2 rounded-lg transition-colors focus:outline-none"
                        style="color: #64748B;"
                        onmouseover="this.style.backgroundColor='#EEF2F7'; this.style.color='#0B2540';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#64748B';"
                        aria-label="Close modal"
                    >
                        <component :is="Icons.X" class="size-5" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 md:p-8 overflow-y-auto space-y-5 flex-grow font-body leading-relaxed text-sm md:text-base" style="color: #475569;">
                    <div>
                        <p class="font-semibold mb-2" style="color: #1E293B;">Service Overview</p>
                        <p>{{ selectedService.short_description }}</p>
                    </div>

                    <div v-if="selectedService.long_description" class="pt-4" style="border-top: 1px solid rgba(11,37,64,0.08);">
                        <p class="font-semibold mb-2" style="color: #1E293B;">Scope of Operations</p>
                        <p class="whitespace-pre-line">{{ selectedService.long_description }}</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4" style="border-top: 1px solid rgba(11,37,64,0.08); background-color: #F8FAFC;">
                    <span class="font-mono text-xs uppercase tracking-wide" style="color: #64748B;">
                        REF: MB-SRV-{{ selectedService.id }}
                    </span>
                    <div class="flex items-center gap-3">
                        <button
                            @click="closeServiceModal"
                            class="btn-secondary text-sm px-5 py-2.5"
                        >
                            Close
                        </button>
                        <Link
                            :href="`/contact?subject=Inquiry: ${selectedService.name}`"
                            class="btn-primary text-sm px-5 py-2.5"
                        >
                            Request Quote
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
