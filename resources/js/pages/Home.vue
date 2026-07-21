<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AboutFlex from '@/components/AboutFlex.vue';
import CEOMessageSection from '@/components/CEOMessageSection.vue';
import CompanyHighlights from '@/components/CompanyHighlights.vue';
import FeaturedServices from '@/components/FeaturedServices.vue';
import FullWidthCTABanner from '@/components/FullWidthCTABanner.vue';
import HeroCarousel from '@/components/HeroCarousel.vue';
import ImageGallerySection from '@/components/ImageGallerySection.vue';
import ImageTextShowcase from '@/components/ImageTextShowcase.vue';
import LogisticsImageBanner from '@/components/LogisticsImageBanner.vue';
import MapEmbed from '@/components/MapEmbed.vue';
import PartnerLogos from '@/components/PartnerLogos.vue';
import StatsCounter from '@/components/StatsCounter.vue';
import TestimonialsSection from '@/components/TestimonialsSection.vue';
import TileGrid from '@/components/TileGrid.vue';
import WhyBusinessesTrust from '@/components/WhyBusinessesTrust.vue';
import WhyChooseUs from '@/components/WhyChooseUs.vue';
import WorkingProcess from '@/components/WorkingProcess.vue';
import PublicLayout from '@/layouts/PublicLayout.vue';

// New premium sections

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
        // CEO message fields
        ceo_rich_text?: string;
        ceo_name?: string;
        ceo_designation?: string;
        portrait_media_id?: any;
        signature_media_id?: any;
        show_ceo_image?: any;
        ceo_cta_button_text?: string;
        ceo_cta_button_url?: string;
        // CTA fields
        cta_banner_heading?: string;
        cta_banner_subheading?: string;
        cta_background_media_id?: any;
        cta_primary_btn_text?: string;
        cta_primary_btn_url?: string;
        cta_secondary_btn_text?: string;
        cta_secondary_btn_url?: string;
    }>;
    services: Array<any>;
    partners: Array<any>;
}>();

defineOptions({
    layout: PublicLayout,
});

// Map backend DB fields of Section to keys expected by CEOMessageSection.vue component
const mapCeoSection = (section: any) => {
    return {
        ...section,
        imageUrl: section.portrait_media?.file_path || section.portrait_media_id || 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&auto=format&fit=crop&q=80',
        eyebrow: section.subheading || 'CEO MESSAGE',
        heading: section.heading || 'Message from CEO',
        messageHtml: section.ceo_rich_text || section.body || '',
        name: section.ceo_name || 'Mahbubur Rahman',
        position: section.ceo_designation || 'Managing Director & CEO',
        signatureUrl: section.signature_media?.file_path || section.signature_media_id || '',
        ctaText: section.ceo_cta_button_text,
        ctaLink: section.ceo_cta_button_url,
        show_ceo_image: section.show_ceo_image !== null && section.show_ceo_image !== undefined ? !!section.show_ceo_image : true
    };
};

// Map backend DB fields of Section to props expected by FullWidthCTABanner.vue component
const mapCtaBannerSection = (section: any) => {
    return {
        bgImage: section.cta_background_media?.file_path || section.cta_background_media_id || 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=1600&auto=format&fit=crop&q=80',
        headline: section.cta_banner_heading || section.heading || 'Ready to Secure Your Supply Chain?',
        description: section.cta_banner_subheading || section.body || '',
        primaryBtn: section.cta_primary_btn_text ? {
            text: section.cta_primary_btn_text,
            href: section.cta_primary_btn_url || '#'
        } : undefined,
        secondaryBtn: section.cta_secondary_btn_text ? {
            text: section.cta_secondary_btn_text,
            href: section.cta_secondary_btn_url || '#'
        } : undefined
    };
};
</script>

<template>
    <Head>
        <title>{{ page?.meta_title || 'Home - Mercury Bangladesh' }}</title>
        <meta
            name="description"
            :content="page?.meta_description || 'Mercury Bangladesh corporate home page'"
        />
    </Head>

    <div class="space-y-0 pb-0">
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

            <FeaturedServices
                v-else-if="section.type === 'featured_services'"
                :services="services"
                :section="section"
            />

            <StatsCounter
                v-else-if="section.type === 'stats'"
                :section="section"
            />

            <CEOMessageSection
                v-else-if="section.type === 'ceo_message'"
                :section="mapCeoSection(section)"
            />

            <WhyBusinessesTrust
                v-else-if="section.type === 'businesses_trust'"
                :section="section"
            />

            <ImageTextShowcase
                v-else-if="section.type === 'image_text_showcase'"
                :section="section"
            />

            <ImageGallerySection
                v-else-if="section.type === 'image_gallery'"
                :section="section"
                :images="section.items ?? []"
            />

            <ImageTextShowcase
                v-else-if="section.type === 'operational_excellence'"
                :section="section"
                :isAltBackground="true"
            />

            <CompanyHighlights
                v-else-if="section.type === 'company_highlights'"
                :section="section"
            />

            <WorkingProcess
                v-else-if="section.type === 'working_process'"
                :section="section"
            />

            <PartnerLogos
                v-else-if="section.type === 'partners'"
                :partners="partners"
                :section="section"
            />

            <TestimonialsSection
                v-else-if="section.type === 'testimonials'"
                :section="section"
            />

            <MapEmbed
                v-else-if="section.type === 'get_in_touch'"
                :section="section"
            />

            <FullWidthCTABanner
                v-else-if="section.type === 'cta_banner'"
                v-bind="mapCtaBannerSection(section)"
            />

            <LogisticsImageBanner
                v-else-if="section.type === 'logistics_image_banner'"
                :section="section"
            />

        </template>
    </div>
</template>

