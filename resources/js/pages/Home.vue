<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AboutFlex from '@/components/AboutFlex.vue';
import FeaturedServices from '@/components/FeaturedServices.vue';
import HeroCarousel from '@/components/HeroCarousel.vue';
import MapEmbed from '@/components/MapEmbed.vue';
import PartnerLogos from '@/components/PartnerLogos.vue';
import StatsCounter from '@/components/StatsCounter.vue';
import TileGrid from '@/components/TileGrid.vue';
import WhyChooseUs from '@/components/WhyChooseUs.vue';
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
    services: Array<any>;
    partners: Array<any>;
}>();

defineOptions({
    layout: PublicLayout,
});
</script>

<template>
    <Head>
        <title>{{ page?.meta_title || 'Home - Mercury Bangladesh' }}</title>
        <meta name="description" :content="page?.meta_description || 'Mercury Bangladesh corporate home page'" />
    </Head>
    
    <div class="space-y-16 md:space-y-24 pb-24">
        <!-- Loop and dynamically render each section in the order returned by the CMS -->
        <template v-for="section in sections" :key="section.id">
            
            <HeroCarousel 
                v-if="section.type === 'hero_carousel'" 
                :section="section" 
            />

            <AboutFlex 
                v-else-if="section.type === 'about_us'" 
                :section="section" 
            />

            <TileGrid 
                v-else-if="section.type === 'vision_mission'" 
                :section="section" 
            />

            <WhyChooseUs 
                v-else-if="section.type === 'why_choose_us'" 
                :section="section" 
            />

            <!-- Stats counter (Numbers block) -->
            <StatsCounter 
                v-else-if="section.type === 'stats'" 
                :section="section" 
            />

            <!-- Get in Touch / map block -->
            <MapEmbed 
                v-else-if="section.type === 'get_in_touch'" 
                :section="section" 
            />

        </template>

        <!-- Our Featured Services (Render teaser cards between Why Choose Us and Stats if sections didn't contain it) -->
        <FeaturedServices 
            :services="services" 
        />

        <!-- Partners logo slider / grid -->
        <PartnerLogos 
            :partners="partners" 
        />
    </div>
</template>
