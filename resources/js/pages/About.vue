<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AboutFlex from '@/components/AboutFlex.vue';
import ClosingCta from '@/components/ClosingCta.vue';
import HeroBanner from '@/components/HeroBanner.vue';
import StatsCounter from '@/components/StatsCounter.vue';
import TileGrid from '@/components/TileGrid.vue';
import TimelineHistory from '@/components/TimelineHistory.vue';
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
    statsSection: any;
}>();

defineOptions({
    layout: PublicLayout,
});
</script>

<template>
    <Head>
        <title>{{ page?.meta_title || 'About Us - Mercury Bangladesh' }}</title>
        <meta name="description" :content="page?.meta_description || 'Learn about Mercury Bangladesh history and values'" />
    </Head>

    <div class="space-y-16 md:space-y-24 pb-24">
        <!-- Loop and dynamically render each section in the order returned by the CMS -->
        <template v-for="section in sections" :key="section.id">
            
            <HeroBanner 
                v-if="section.type === 'hero_banner'" 
                :section="section" 
            />

            <AboutFlex 
                v-else-if="section.type === 'our_story'" 
                :section="section" 
            />

            <TileGrid 
                v-else-if="section.type === 'foundation'" 
                :section="section" 
            />

            <template v-else-if="section.type === 'history'">
                <TimelineHistory :section="section" />
                
                <!-- Shared Stats Counter rendered immediately after history timeline -->
                <StatsCounter 
                    v-if="statsSection" 
                    :section="statsSection" 
                />
            </template>

            <ClosingCta 
                v-else-if="section.type === 'closing_cta'" 
                :section="section" 
            />

        </template>
    </div>
</template>
