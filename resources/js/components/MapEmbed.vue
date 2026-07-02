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
    <div v-if="section" class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-stretch">
            
            <!-- Contact details card -->
            <div class="flex flex-col justify-between space-y-8 bg-base-100 border border-base-300 p-8 md:p-10 rounded-lg">
                <div class="space-y-6">
                    <!-- Eyebrow -->
                    <span class="inline-block font-mono text-xs md:text-sm tracking-widest text-base-content/70 uppercase">
                        {{ section.subheading || 'ROUTE · COMMUNICATE' }}
                    </span>
                    <!-- Heading -->
                    <h2 class="text-3xl font-bold font-display text-base-content leading-tight">
                        {{ section.heading }}
                    </h2>
                    <!-- Body text -->
                    <p class="text-base-content/70 font-body text-base leading-relaxed">
                        {{ section.body }}
                    </p>
                </div>

                <!-- Info list -->
                <div class="space-y-6 pt-4 border-t border-base-300">
                    <!-- Address -->
                    <div v-if="settings.contact_address" class="flex gap-4 items-start">
                        <div class="text-amber mt-1 flex-shrink-0">
                            <MapPin class="size-5 stroke-[1.5]" />
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-mono text-xs uppercase tracking-wider text-base-content/70">Head Office</h4>
                            <p class="text-base-content text-sm md:text-base font-body">{{ settings.contact_address }}</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div v-if="settings.contact_phone" class="flex gap-4 items-start">
                        <div class="text-amber mt-1 flex-shrink-0">
                            <Phone class="size-5 stroke-[1.5]" />
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-mono text-xs uppercase tracking-wider text-base-content/70">Phone Support</h4>
                            <p class="text-base-content text-sm md:text-base font-body">{{ settings.contact_phone }}</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div v-if="settings.contact_email" class="flex gap-4 items-start">
                        <div class="text-amber mt-1 flex-shrink-0">
                            <Mail class="size-5 stroke-[1.5]" />
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-mono text-xs uppercase tracking-wider text-base-content/70">Email Operations</h4>
                            <p class="text-base-content text-sm md:text-base font-body">
                                <a :href="`mailto:${settings.contact_email}`" class="hover:text-amber transition-colors">{{ settings.contact_email }}</a>
                            </p>
                        </div>
                    </div>

                    <!-- Office hours -->
                    <div v-if="settings.office_hours" class="flex gap-4 items-start">
                        <div class="text-amber mt-1 flex-shrink-0">
                            <Clock class="size-5 stroke-[1.5]" />
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-mono text-xs uppercase tracking-wider text-base-content/70">Office Hours</h4>
                            <p class="text-base-content text-sm md:text-base font-body">{{ settings.office_hours }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Iframe Embed -->
            <div class="rounded-lg overflow-hidden border border-base-300 min-h-[350px] lg:min-h-full bg-base-200 relative group/map">
                <iframe 
                    v-if="settings.google_maps_embed"
                    :src="settings.google_maps_embed" 
                    class="absolute inset-0 w-full h-full border-0 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
                    allowfullscreen="false" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
                <div v-else class="absolute inset-0 flex items-center justify-center text-base-content/50 font-body text-sm">
                    No map coordinates configured.
                </div>
            </div>

        </div>
    </div>
</template>
