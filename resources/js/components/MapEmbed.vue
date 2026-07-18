<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { MapPin, Phone, Mail, Clock } from '@lucide/vue';
import { computed } from 'vue';

defineProps<{
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
    };
}>();

const page = usePage();
const settings = computed(() => (page.props.settings as Record<string, any>) || {});
</script>

<template>
    <div v-if="section" class="py-16 md:py-24" style="background-color: #F8FAFC;">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-stretch">

                <!-- Contact Details Card -->
                <div class="card-premium p-8 md:p-10 flex flex-col justify-between space-y-8">
                    <div class="space-y-5">
                        <span class="eyebrow-orange">
                            {{ section.subheading || 'ROUTE · COMMUNICATE' }}
                        </span>
                        <h2 class="text-3xl font-bold font-display leading-tight" style="color: #0B2540;">
                            {{ section.heading }}
                        </h2>
                        <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>
                        <p class="font-body text-base leading-relaxed" style="color: #475569;">
                            {{ section.body }}
                        </p>
                    </div>

                    <!-- Contact Info List -->
                    <div class="space-y-5 pt-4" style="border-top: 1px solid rgba(11,37,64,0.08);">
                        <!-- Address -->
                        <div v-if="settings.contact_address" class="flex gap-4 items-start">
                            <div class="icon-orange-wrap flex-shrink-0">
                                <MapPin class="size-4 stroke-[1.5]" />
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider font-semibold" style="color: #64748B;">Head Office</h4>
                                <p class="font-body text-sm md:text-base" style="color: #1E293B;">{{ settings.contact_address }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div v-if="settings.contact_phone" class="flex gap-4 items-start">
                            <div class="icon-orange-wrap flex-shrink-0">
                                <Phone class="size-4 stroke-[1.5]" />
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider font-semibold" style="color: #64748B;">Phone Support</h4>
                                <p class="font-body text-sm md:text-base" style="color: #1E293B;">{{ settings.contact_phone }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div v-if="settings.contact_email" class="flex gap-4 items-start">
                            <div class="icon-orange-wrap flex-shrink-0">
                                <Mail class="size-4 stroke-[1.5]" />
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider font-semibold" style="color: #64748B;">Email Operations</h4>
                                <p class="font-body text-sm md:text-base" style="color: #1E293B;">
                                    <a :href="`mailto:${settings.contact_email}`" class="transition-colors" style="color: #1E293B;"
                                        onmouseover="this.style.color='#E8770C';"
                                        onmouseout="this.style.color='#1E293B';"
                                    >{{ settings.contact_email }}</a>
                                </p>
                            </div>
                        </div>

                        <!-- Office Hours -->
                        <div v-if="settings.office_hours" class="flex gap-4 items-start">
                            <div class="icon-orange-wrap flex-shrink-0">
                                <Clock class="size-4 stroke-[1.5]" />
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-mono text-[10px] uppercase tracking-wider font-semibold" style="color: #64748B;">Office Hours</h4>
                                <p class="font-body text-sm md:text-base" style="color: #1E293B;">{{ settings.office_hours }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Embed -->
                <div
                    class="rounded-xl overflow-hidden min-h-[350px] lg:min-h-full relative group/map"
                    style="border: 1px solid rgba(11,37,64,0.10); box-shadow: var(--shadow-card);"
                >
                    <iframe
                        v-if="settings.google_maps_embed"
                        :src="settings.google_maps_embed"
                        class="absolute inset-0 w-full h-full border-0 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
                        allowfullscreen="false"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                    <div v-else class="absolute inset-0 flex items-center justify-center font-body text-sm" style="background-color: #EEF2F7; color: #64748B;">
                        No map coordinates configured.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
