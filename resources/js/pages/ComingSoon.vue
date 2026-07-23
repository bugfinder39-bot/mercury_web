<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    Anchor,
    ShieldCheck,
    Globe,
    Clock,
    Sparkles,
    ArrowRight,
    Ship,
    Compass,
    FileText,
    CheckCircle2,
    Radio,
    Layers,
    Construction,
    PhoneCall,
    Mail,
    ChevronRight
} from '@lucide/vue';
import { computed } from 'vue';
import PublicLayout from '@/layouts/PublicLayout.vue';

interface SectionItem {
    id: number;
    title?: string;
    subtitle?: string;
    description?: string;
    value?: string;
    icon?: string;
    link?: string;
    order: number;
    is_active: boolean;
    image_media?: {
        file_path: string;
    };
}

interface Section {
    id: number;
    type: string;
    heading?: string;
    subheading?: string;
    body?: string;
    order: number;
    is_active: boolean;
    cta_primary_btn_text?: string;
    cta_primary_btn_url?: string;
    cta_secondary_btn_text?: string;
    cta_secondary_btn_url?: string;
    progress_label?: string;
    expected_launch_text?: string;
    items?: SectionItem[];
    hero_media?: {
        file_path: string;
    };
}

const props = defineProps<{
    page: {
        id: number;
        name: string;
        slug: string;
        meta_title?: string;
        meta_description?: string;
        og_image?: string;
    };
    sections: Section[];
}>();

defineOptions({
    layout: PublicLayout,
});

// Section Finders
const heroSection = computed(() => {
    return props.sections.find(s => s.type === 'coming_soon_hero') || props.sections[0] || null;
});

const wipSection = computed(() => {
    return props.sections.find(s => s.type === 'coming_soon_wip') || props.sections[1] || null;
});

const featuresSection = computed(() => {
    return props.sections.find(s => s.type === 'coming_soon_features') || props.sections[2] || null;
});

const ctaSection = computed(() => {
    return props.sections.find(s => s.type === 'coming_soon_cta') || props.sections[3] || null;
});

// Helper for dynamic icon rendering
const getFeatureIcon = (iconName?: string) => {
    switch (iconName?.toLowerCase()) {
        case 'anchor':
        case 'ship':
            return Anchor;
        case 'shieldcheck':
        case 'shield':
            return ShieldCheck;
        case 'globe':
        case 'world':
            return Globe;
        case 'clock':
        case 'timer':
            return Clock;
        case 'filetext':
        case 'document':
            return FileText;
        case 'compass':
            return Compass;
        default:
            return Sparkles;
    }
};

// Progress percentage parsing
const progressPercentage = computed(() => {
    if (!wipSection.value?.progress_label) return 85;
    const match = wipSection.value.progress_label.match(/(\d+)%/);
    return match ? parseInt(match[1], 10) : 85;
});
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const settings = computed(() => (page.props.settings as Record<string, any>) || {});
const hasNavbar = computed(() => {
    const val = settings.value.show_navbar ?? settings.value.coming_soon_show_navbar;
    return String(val) === 'true' || val === true || val === 1;
});
</script>

<template>
    <Head :title="page.meta_title || 'Coming Soon | Mercury Bangladesh'">
        <meta v-if="page.meta_description" name="description" :content="page.meta_description" />
    </Head>

    <div class="relative overflow-hidden bg-[#0B2540] text-white min-h-screen">
        <!-- Background Ambient Glow & Shipping Overlay Graphic -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#E8770C]/15 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 -right-20 w-[500px] h-[500px] bg-[#123A5E]/40 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-1/4 w-80 h-80 bg-[#E8770C]/10 rounded-full blur-3xl"></div>
            
            <!-- Grid Lines Pattern -->
            <svg class="absolute inset-0 w-full h-full opacity-[0.04]" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-pattern" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="#FFFFFF" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-pattern)" />
            </svg>
        </div>

        <!-- 1. HERO SECTION -->
        <section v-if="heroSection" :class="[hasNavbar ? 'pt-24 md:pt-32' : 'pt-12 md:pt-20', 'relative pb-20 md:pb-28 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto']">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Left Content -->
                <div class="lg:col-span-7 space-y-8 text-left z-10">
                    <!-- Eyebrow Badge -->
                    <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-[#123A5E]/80 border border-[#E8770C]/30 backdrop-blur-md">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#E8770C] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#E8770C]"></span>
                        </span>
                        <span class="font-mono text-xs font-semibold uppercase tracking-widest text-[#DCEAF7]">
                            {{ heroSection.subheading || 'COMING SOON · MERCURY BANGLADESH' }}
                        </span>
                    </div>

                    <!-- Main Title -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold font-display tracking-tight leading-[1.15] text-white">
                        <span class="block text-[#DCEAF7]">
                            {{ heroSection.heading || 'SOMETHING EXTRAORDINARY' }}
                        </span>
                        <span class="bg-gradient-to-r from-[#E8770C] via-amber-400 to-[#E8770C] bg-clip-text text-transparent">
                            IS ON THE WAY
                        </span>
                    </h1>

                    <!-- Hero Subtitle Body -->
                    <p class="text-base sm:text-lg text-slate-300 font-body leading-relaxed max-w-2xl">
                        {{ heroSection.body || 'Our next-generation maritime logistics portal and global tracking suite are currently under active development. We are engineering a faster, more transparent supply chain experience.' }}
                    </p>

                    <!-- CTAs & Action Buttons -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <Link
                            :href="heroSection.cta_primary_btn_url || '/contact'"
                            class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-xl bg-gradient-to-r from-[#E8770C] to-[#cc6608] text-white font-semibold text-sm shadow-[0_4px_20px_rgba(232,119,12,0.4)] hover:shadow-[0_6px_28px_rgba(232,119,12,0.6)] hover:-translate-y-0.5 transition-all duration-200"
                        >
                            <span>{{ heroSection.cta_primary_btn_text || 'Contact Operations' }}</span>
                            <ArrowRight class="size-4" />
                        </Link>

                        <Link
                            :href="heroSection.cta_secondary_btn_url || '/'"
                            class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-xl bg-[#123A5E]/60 hover:bg-[#123A5E] text-[#DCEAF7] font-semibold text-sm border border-slate-700 hover:border-slate-500 backdrop-blur-md hover:-translate-y-0.5 transition-all duration-200"
                        >
                            <Compass class="size-4 text-[#E8770C]" />
                            <span>{{ heroSection.cta_secondary_btn_text || 'Return to Main Site' }}</span>
                        </Link>
                    </div>

                    <!-- Quick Metrics Chips -->
                    <div class="pt-6 border-t border-slate-800/80 flex flex-wrap gap-8 text-xs font-mono text-slate-400">
                        <div class="flex items-center gap-2">
                            <Ship class="size-4 text-[#E8770C]" />
                            <span>Sea & Air Dispatch Ready</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <ShieldCheck class="size-4 text-[#E8770C]" />
                            <span>Customs Clearance Active</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Right Decorative Graphical Card -->
                <div class="lg:col-span-5 relative z-10">
                    <div class="relative mx-auto max-w-md p-1 rounded-2xl bg-gradient-to-b from-[#E8770C]/30 via-slate-800/50 to-slate-900/80 shadow-2xl backdrop-blur-xl">
                        <div class="bg-[#0B2540]/90 rounded-[14px] p-6 sm:p-8 space-y-6 border border-white/10">
                            <!-- Header of Card -->
                            <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                                <div class="flex items-center gap-3">
                                    <div class="p-2.5 rounded-lg bg-[#E8770C]/20 border border-[#E8770C]/30 text-[#E8770C]">
                                        <Construction class="size-6 animate-bounce" />
                                    </div>
                                    <div>
                                        <span class="font-mono text-[10px] text-[#E8770C] uppercase tracking-widest block">STATUS REPORT</span>
                                        <h3 class="font-display font-bold text-white text-base">Under Active Construction</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Image or Vector Feature Graphic -->
                            <div class="relative h-48 rounded-xl overflow-hidden bg-slate-900 border border-slate-800 flex items-center justify-center group">
                                <img
                                    v-if="heroSection.hero_media?.file_path"
                                    :src="heroSection.hero_media.file_path"
                                    alt="Coming Soon Graphic"
                                    class="w-full h-full object-cover rounded-xl"
                                />
                                <div v-else class="absolute inset-0 bg-gradient-to-br from-[#123A5E] to-[#0B2540] p-6 flex flex-col justify-between">
                                    <div class="flex justify-between items-start">
                                        <Radio class="size-6 text-[#E8770C] animate-pulse" />
                                        <span class="px-2.5 py-1 rounded bg-[#0B2540]/80 border border-slate-700 text-[10px] font-mono text-emerald-400 font-semibold">99.9% UPTIME PIPELINE</span>
                                    </div>
                                    <div>
                                        <div class="text-xs font-mono text-slate-400">NEXT GENERATION</div>
                                        <div class="text-lg font-bold font-display text-white mt-0.5">Maritime Cargo Portal 2.0</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Live System Indicator -->
                            <div class="space-y-3 pt-2">
                                <div class="flex justify-between text-xs font-mono">
                                    <span class="text-slate-400">Core Engine Integration</span>
                                    <span class="text-[#E8770C] font-bold">OPTIMIZING</span>
                                </div>
                                <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                                    <div class="bg-gradient-to-r from-[#E8770C] to-amber-400 h-full rounded-full w-[88%] animate-pulse"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. WORK IN PROGRESS SECTION -->
        <section v-if="wipSection" class="relative py-16 bg-[#091E33] border-y border-slate-800/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mx-auto text-center space-y-4">
                    <span class="font-mono text-xs font-semibold uppercase tracking-widest text-[#E8770C] block">
                        {{ wipSection.subheading || 'MB · 02 — WORK IN PROGRESS' }}
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-bold font-display text-white">
                        {{ wipSection.heading || 'Engineering Modern Maritime Logistics' }}
                    </h2>
                    <p class="text-slate-300 font-body text-sm sm:text-base leading-relaxed">
                        {{ wipSection.body || 'We are fine-tuning our carrier integrations, document verification engines, and real-time container tracking to provide an uncompromised corporate logistics standard.' }}
                    </p>
                </div>

                <!-- Progress Dashboard Card -->
                <div class="mt-12 max-w-4xl mx-auto p-6 sm:p-8 rounded-2xl bg-[#0B2540] border border-slate-800 shadow-xl space-y-8">
                    <!-- Progress Bar & Target -->
                    <div class="space-y-3">
                        <div class="flex flex-wrap justify-between items-end gap-2">
                            <div>
                                <span class="text-xs font-mono text-slate-400 uppercase tracking-wider block">Development Milestones</span>
                                <span class="text-base sm:text-lg font-bold font-display text-white">
                                    {{ wipSection.progress_label || '85% Completed — Live Verification' }}
                                </span>
                            </div>
                            <div class="px-3 py-1 rounded.lg bg-[#123A5E] border border-slate-700 text-xs font-mono text-[#DCEAF7] font-semibold flex items-center gap-2">
                                <Clock class="size-3.5 text-[#E8770C]" />
                                <span>{{ wipSection.expected_launch_text || 'Expected Launch: Q4 2026' }}</span>
                            </div>
                        </div>

                        <!-- Main Bar -->
                        <div class="w-full bg-slate-900 h-4 rounded-full p-0.5 border border-slate-800">
                            <div
                                class="bg-gradient-to-r from-[#E8770C] via-amber-500 to-[#E8770C] h-full rounded-full transition-all duration-1000 relative"
                                :style="{ width: `${progressPercentage}%` }"
                            >
                                <div class="absolute right-0 top-0 bottom-0 w-3 bg-white/50 rounded-full animate-ping"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Development Timeline Steps Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-slate-800">
                        <div class="p-4 rounded-xl bg-[#123A5E]/40 border border-slate-800 flex items-start gap-3">
                            <CheckCircle2 class="size-5 text-emerald-400 shrink-0 mt-0.5" />
                            <div>
                                <h4 class="text-xs font-bold font-display text-white">Phase 1: Architecture</h4>
                                <p class="text-[11px] text-slate-400 mt-0.5">Database schema & CMS integration completed.</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-[#123A5E]/40 border border-[#E8770C]/30 flex items-start gap-3">
                            <Radio class="size-5 text-[#E8770C] shrink-0 mt-0.5 animate-pulse" />
                            <div>
                                <h4 class="text-xs font-bold font-display text-white">Phase 2: Carrier Sync</h4>
                                <p class="text-[11px] text-slate-400 mt-0.5">Live shipping line telemetry integration active.</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-[#123A5E]/20 border border-slate-800/60 flex items-start gap-3 opacity-60">
                            <Layers class="size-5 text-slate-500 shrink-0 mt-0.5" />
                            <div>
                                <h4 class="text-xs font-bold font-display text-slate-300">Phase 3: Public Launch</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">Final security audit & client rollout.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. WHAT TO EXPECT SECTION (Repeatable Cards) -->
        <section v-if="featuresSection && featuresSection.items && featuresSection.items.length > 0" class="relative py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                <span class="font-mono text-xs font-semibold uppercase tracking-widest text-[#E8770C] block">
                    {{ featuresSection.subheading || 'MB · 03 — UPCOMING FEATURES' }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold font-display text-white">
                    {{ featuresSection.heading || 'What To Expect' }}
                </h2>
                <p class="text-slate-300 font-body text-sm sm:text-base leading-relaxed">
                    {{ featuresSection.body || 'Here is a preview of the advanced corporate shipping tools currently being integrated into our digital platform.' }}
                </p>
            </div>

            <!-- Features Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    v-for="item in featuresSection.items"
                    :key="item.id"
                    class="group relative p-6 rounded-2xl bg-[#091E33] border border-slate-800 hover:border-[#E8770C]/50 transition-all duration-300 hover:-translate-y-1.5 shadow-lg hover:shadow-[0_12px_30px_rgba(232,119,12,0.15)] flex flex-col justify-between"
                >
                    <div class="space-y-4">
                        <div class="inline-flex p-3 rounded-xl bg-[#123A5E] border border-slate-700 text-[#E8770C] group-hover:scale-110 transition-transform duration-200">
                            <component :is="getFeatureIcon(item.icon)" class="size-6" />
                        </div>

                        <div>
                            <span v-if="item.subtitle" class="font-mono text-[10px] text-[#E8770C] uppercase tracking-wider block mb-1">
                                {{ item.subtitle }}
                            </span>
                            <h3 class="font-display font-bold text-lg text-white group-hover:text-[#DCEAF7] transition-colors">
                                {{ item.title || 'Upcoming Feature' }}
                            </h3>
                        </div>

                        <p class="text-xs text-slate-400 font-body leading-relaxed">
                            {{ item.description }}
                        </p>
                    </div>

                    <div class="pt-6 mt-4 border-t border-slate-800/80 flex items-center justify-between text-[11px] font-mono text-slate-500">
                        <span>COMING SOON</span>
                        <ChevronRight class="size-3.5 text-[#E8770C] group-hover:translate-x-1 transition-transform" />
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. STAY CONNECTED / FOOTER CTA SECTION -->
        <section v-if="ctaSection" class="relative py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="relative rounded-3xl bg-gradient-to-r from-[#123A5E] via-[#0B2540] to-[#123A5E] border border-[#E8770C]/30 p-8 sm:p-12 overflow-hidden shadow-2xl">
                <!-- Background Accent Circles -->
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-[#E8770C]/10 rounded-full blur-2xl"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="font-mono text-xs font-semibold uppercase tracking-widest text-[#E8770C] block">
                            {{ ctaSection.subheading || 'MB · 04 — STAY CONNECTED' }}
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-bold font-display text-white">
                            {{ ctaSection.heading || 'Need Immediate Shipping Support?' }}
                        </h2>
                        <p class="text-slate-300 font-body text-sm sm:text-base leading-relaxed max-w-2xl">
                            {{ ctaSection.body || 'Our physical offices, sea freight desks, and customs clearing teams remain fully operational. Reach out directly for immediate shipment assistance.' }}
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-4">
                        <Link
                            :href="ctaSection.cta_primary_btn_url || '/contact'"
                            class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl bg-[#E8770C] hover:bg-[#cc6608] text-white font-semibold text-sm shadow-[0_4px_20px_rgba(232,119,12,0.4)] transition-all duration-200"
                        >
                            <PhoneCall class="size-4" />
                            <span>{{ ctaSection.cta_primary_btn_text || 'Contact Operations Desk' }}</span>
                        </Link>

                        <Link
                            :href="ctaSection.cta_secondary_btn_url || '/'"
                            class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl bg-slate-900/80 hover:bg-slate-800 text-[#DCEAF7] font-semibold text-sm border border-slate-700 transition-all duration-200"
                        >
                            <span>{{ ctaSection.cta_secondary_btn_text || 'Return to Main Site' }}</span>
                            <ArrowRight class="size-4 text-[#E8770C]" />
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}
</style>
