<script setup lang="ts">
import { ref, computed, onMounted, watch, nextTick } from 'vue';
import { Search, MapPin, Phone, Mail, ExternalLink, Globe2, Anchor, Plane, Building2, Warehouse, Users, Compass, ChevronRight } from '@lucide/vue';

interface Location {
    id: number;
    name: string;
    country: string;
    city: string;
    region?: string;
    type: string;
    latitude: number;
    longitude: number;
    address: string;
    google_maps_url?: string;
    phone?: string;
    email?: string;
    website?: string;
    description?: string;
    order: number;
    is_active: boolean;
    is_featured: boolean;
    marker_color?: string;
    marker_icon?: string;
}

const props = defineProps<{
    section: {
        heading?: string;
        subheading?: string;
        body?: string;
    };
    locations: Location[];
}>();

const searchQuery = ref('');
const selectedType = ref('All');
const activeLocationId = ref<number | null>(null);

const mapContainer = ref<HTMLElement | null>(null);
let mapInstance: any = null;
let markersMap = new Map<number, any>();

// Extract all unique location types
const availableTypes = computed(() => {
    const types = new Set(props.locations.map(loc => loc.type));
    return ['All', ...Array.from(types)];
});

// Filtered locations based on search and type
const filteredLocations = computed(() => {
    return props.locations.filter(loc => {
        const matchesType = selectedType.value === 'All' || loc.type === selectedType.value;
        const q = searchQuery.value.toLowerCase().trim();
        const matchesQuery = !q || (
            loc.name.toLowerCase().includes(q) ||
            loc.country.toLowerCase().includes(q) ||
            loc.city.toLowerCase().includes(q) ||
            loc.type.toLowerCase().includes(q) ||
            loc.address.toLowerCase().includes(q)
        );
        return matchesType && matchesQuery;
    });
});

// Computed Stats
const totalLocationsCount = computed(() => props.locations.length);
const totalCountriesCount = computed(() => new Set(props.locations.map(l => l.country)).size);
const totalPortsCount = computed(() => props.locations.filter(l => l.type === 'Sea Port' || l.type === 'Air Port').length);
const totalHubsCount = computed(() => props.locations.filter(l => l.type === 'Warehouse' || l.type === 'Distribution Center' || l.type === 'Corporate Office').length);

// Icon SVG helper
const getIconSvg = (iconType?: string, color: string = '#0284c7') => {
    const defaultSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>`;
    
    switch (iconType) {
        case 'Anchor':
            return `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="5" r="3"/><path d="M12 22V8"/><path d="M5 12H2a10 10 0 0 0 20 0h-3"/></svg>`;
        case 'Plane':
            return `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3.5c-.5-.5-2.5 0-4 1.5L13.5 8.5 5.3 6.7c-.7-.2-1.3.1-1.6.7l-.6 1.3c-.2.5 0 1.1.4 1.4l5.3 4.2-3.4 3.4-2.5-.5c-.4-.1-.8.1-1 .4l-.4.4c-.3.3-.3.8 0 1.1l2.4 2.4c.3.3.8.3 1.1 0l.4-.4c.3-.2.5-.6.4-1l-.5-2.5 3.4-3.4 4.2 5.3c.3.4.9.6 1.4.4l1.3-.6c.6-.3.9-.9.7-1.6z"/></svg>`;
        case 'Warehouse':
            return `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35a2 2 0 0 1 .85-1.64l8-5.71a2 2 0 0 1 2.3 0l8 5.71a2 2 0 0 1 .85 1.64Z"/><path d="M6 18h12v-7H6v7Z"/></svg>`;
        case 'Users':
            return `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>`;
        case 'Building2':
        default:
            return `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>`;
    }
};

const createPopupHtml = (loc: Location) => {
    const mapsLink = loc.google_maps_url || `https://maps.google.com/?q=${loc.latitude},${loc.longitude}`;
    return `
        <div class="p-4 min-w-[260px] max-w-[320px] font-sans text-slate-800">
            <div class="flex items-center justify-between gap-2 mb-2">
                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider text-white" style="background-color: ${loc.marker_color || '#0284c7'};">
                    ${loc.type}
                </span>
                ${loc.is_featured ? '<span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200">★ Featured</span>' : ''}
            </div>
            <h4 class="font-bold text-base text-slate-900 leading-tight mb-1" style="color: #0B2540;">${loc.name}</h4>
            <p class="text-xs text-slate-500 font-mono mb-2">${loc.city}, ${loc.country}</p>
            
            <div class="text-xs text-slate-600 space-y-1.5 my-3 bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                <div class="flex items-start gap-2">
                    <span class="text-slate-400 mt-0.5">📍</span>
                    <span class="leading-tight">${loc.address}</span>
                </div>
                ${loc.phone ? `
                    <div class="flex items-center gap-2">
                        <span class="text-slate-400">📞</span>
                        <a href="tel:${loc.phone}" class="hover:text-amber font-mono text-[11px]">${loc.phone}</a>
                    </div>
                ` : ''}
                ${loc.email ? `
                    <div class="flex items-center gap-2">
                        <span class="text-slate-400">✉️</span>
                        <a href="mailto:${loc.email}" class="hover:text-amber font-mono text-[11px] truncate">${loc.email}</a>
                    </div>
                ` : ''}
            </div>

            ${loc.description ? `<p class="text-xs text-slate-600 italic line-clamp-2 mb-3">${loc.description}</p>` : ''}

            <a href="${mapsLink}" target="_blank" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-semibold font-mono text-white bg-slate-900 hover:bg-amber rounded-lg transition-colors duration-150">
                <span>Open in Google Maps</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>
    `;
};

onMounted(async () => {
    await nextTick();
    if (typeof window !== 'undefined') {
        const L = await import('leaflet');
        import('leaflet/dist/leaflet.css');

        if (mapContainer.value && !mapInstance) {
            // Initial center on world/Bangladesh
            mapInstance = L.map(mapContainer.value, {
                zoomControl: false,
                scrollWheelZoom: false,
            }).setView([20.0, 60.0], 3);

            // Add standard Zoom Control at bottom right
            L.control.zoom({ position: 'bottomright' }).addTo(mapInstance);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(mapInstance);

            renderMarkers(L);
        }
    }
});

const renderMarkers = (L: any) => {
    if (!mapInstance) return;

    // Clear existing markers
    markersMap.forEach(marker => marker.remove());
    markersMap.clear();

    const bounds = L.latLngBounds([]);

    filteredLocations.value.forEach(loc => {
        const color = loc.marker_color || '#0284c7';
        const iconSvg = getIconSvg(loc.marker_icon, color);

        const customIcon = L.divIcon({
            className: 'custom-map-marker-div',
            html: `
                <div class="relative group cursor-pointer transform hover:scale-110 transition-transform duration-200">
                    <div class="w-9 h-9 rounded-full bg-white shadow-lg border-2 flex items-center justify-center p-1" style="border-color: ${color};">
                        ${iconSvg}
                    </div>
                    <div class="w-2 h-2 rounded-full mx-auto -mt-0.5 shadow-sm" style="background-color: ${color};"></div>
                </div>
            `,
            iconSize: [36, 42],
            iconAnchor: [18, 42],
            popupAnchor: [0, -38]
        });

        const marker = L.marker([loc.latitude, loc.longitude], { icon: customIcon })
            .addTo(mapInstance)
            .bindPopup(createPopupHtml(loc));

        marker.on('click', () => {
            activeLocationId.value = loc.id;
            mapInstance.panTo([loc.latitude, loc.longitude]);
        });

        markersMap.set(loc.id, marker);
        bounds.extend([loc.latitude, loc.longitude]);
    });

    if (filteredLocations.value.length > 0 && mapInstance) {
        mapInstance.fitBounds(bounds, { padding: [50, 50], maxZoom: 8 });
    }
};

const selectLocation = (loc: Location) => {
    activeLocationId.value = loc.id;
    if (mapInstance && markersMap.has(loc.id)) {
        const marker = markersMap.get(loc.id);
        mapInstance.setView([loc.latitude, loc.longitude], 10, { animate: true });
        marker.openPopup();
    }
};

watch([filteredLocations, selectedType], async () => {
    await nextTick();
    if (typeof window !== 'undefined') {
        const L = await import('leaflet');
        renderMarkers(L);
    }
});
</script>

<template>
    <section class="py-16 md:py-24 bg-slate-900 text-white relative overflow-hidden">
        <!-- Subtle Map Background Grid Layer -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="max-w-3xl mb-12">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-mono font-semibold uppercase tracking-widest text-amber bg-amber/10 border border-amber/20 mb-4">
                    <Globe2 class="size-3.5" />
                    <span>{{ section.subheading || 'GLOBAL REACH · STRATEGIC HUBS' }}</span>
                </div>
                <h2 class="text-3xl md:text-5xl font-bold font-display tracking-tight text-white mb-4">
                    {{ section.heading || 'Global Network' }}
                </h2>
                <p class="text-base md:text-lg text-slate-300 font-body leading-relaxed">
                    {{ section.body || 'Showcasing Mercury Bangladesh’s worldwide logistics infrastructure spanning major sea ports, air freight terminals, warehousing facilities, and key commercial hubs across continents.' }}
                </p>
            </div>

            <!-- Global Statistics Bar -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
                <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-sm p-4 md:p-5 rounded-2xl">
                    <div class="text-2xl md:text-3xl font-bold font-mono text-amber mb-1">{{ totalLocationsCount }}+</div>
                    <div class="text-xs md:text-sm text-slate-300 font-medium">Network Locations</div>
                </div>
                <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-sm p-4 md:p-5 rounded-2xl">
                    <div class="text-2xl md:text-3xl font-bold font-mono text-amber mb-1">{{ totalCountriesCount }}</div>
                    <div class="text-xs md:text-sm text-slate-300 font-medium">Countries Covered</div>
                </div>
                <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-sm p-4 md:p-5 rounded-2xl">
                    <div class="text-2xl md:text-3xl font-bold font-mono text-amber mb-1">{{ totalPortsCount }}</div>
                    <div class="text-xs md:text-sm text-slate-300 font-medium">Sea & Air Ports</div>
                </div>
                <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-sm p-4 md:p-5 rounded-2xl">
                    <div class="text-2xl md:text-3xl font-bold font-mono text-amber mb-1">{{ totalHubsCount }}</div>
                    <div class="text-xs md:text-sm text-slate-300 font-medium">HQ & Regional Hubs</div>
                </div>
            </div>

            <!-- Category Filters & Search Controls -->
            <div class="flex flex-col lg:flex-row justify-between items-stretch lg:items-center gap-4 mb-8">
                <!-- Type Filter Pills -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 lg:pb-0 scrollbar-none">
                    <button
                        v-for="type in availableTypes"
                        :key="type"
                        @click="selectedType = type"
                        class="px-4 py-2 rounded-xl text-xs font-mono font-semibold transition-all duration-150 whitespace-nowrap border"
                        :class="selectedType === type
                            ? 'bg-amber text-white border-amber shadow-lg shadow-amber/20'
                            : 'bg-slate-800/80 text-slate-300 border-slate-700 hover:bg-slate-700 hover:text-white'"
                    >
                        {{ type }}
                    </button>
                </div>

                <!-- Search Input -->
                <div class="relative w-full lg:w-72">
                    <Search class="size-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search city, country, port..."
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-800/90 border border-slate-700 rounded-xl text-sm text-white placeholder-slate-400 focus:outline-none focus:border-amber transition-colors"
                    />
                </div>
            </div>

            <!-- Interactive Map & Location Sidebar Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
                <!-- Left 2 Cols: Interactive Map Container -->
                <div class="lg:col-span-2 min-h-[450px] lg:min-h-[550px] rounded-2xl border border-slate-700/80 overflow-hidden shadow-2xl relative bg-slate-950">
                    <div ref="mapContainer" class="w-full h-full min-h-[450px] lg:min-h-[550px] z-10"></div>
                </div>

                <!-- Right 1 Col: Location Cards Scroll Drawer -->
                <div class="bg-slate-800/60 border border-slate-700/80 rounded-2xl p-4 flex flex-col h-[450px] lg:h-[550px]">
                    <div class="flex items-center justify-between border-b border-slate-700/60 pb-3 mb-3">
                        <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-400">
                            Locations ({{ filteredLocations.length }})
                        </span>
                        <span class="text-[11px] font-mono text-amber">Click card to locate</span>
                    </div>

                    <div class="flex-1 overflow-y-auto space-y-3 pr-1 custom-scrollbar">
                        <div
                            v-for="loc in filteredLocations"
                            :key="loc.id"
                            @click="selectLocation(loc)"
                            class="p-4 rounded-xl border transition-all duration-150 cursor-pointer group"
                            :class="activeLocationId === loc.id
                                ? 'bg-slate-700/90 border-amber shadow-md'
                                : 'bg-slate-800/80 border-slate-700/60 hover:bg-slate-700/50 hover:border-slate-500'"
                        >
                            <div class="flex items-start justify-between gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider text-white" :style="{ backgroundColor: loc.marker_color || '#0284c7' }">
                                    {{ loc.type }}
                                </span>
                                <span v-if="loc.is_featured" class="text-[10px] font-mono text-amber bg-amber/10 px-1.5 py-0.5 rounded border border-amber/20">
                                    ★ Featured
                                </span>
                            </div>

                            <h3 class="font-bold text-sm text-white group-hover:text-amber transition-colors flex items-center justify-between">
                                <span>{{ loc.name }}</span>
                                <ChevronRight class="size-4 text-slate-500 group-hover:text-amber group-hover:translate-x-0.5 transition-all" />
                            </h3>

                            <p class="text-xs text-slate-400 font-mono mt-0.5">
                                {{ loc.city }}, {{ loc.country }}
                            </p>

                            <p class="text-xs text-slate-300 line-clamp-1 mt-2">
                                {{ loc.address }}
                            </p>
                        </div>

                        <div v-if="filteredLocations.length === 0" class="text-center py-12 text-slate-400 font-body text-sm">
                            No matching network locations found.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
/* Custom Leaflet Marker Styling */
.custom-map-marker-div {
    background: transparent;
    border: none;
}
.leaflet-popup-content-wrapper {
    background: #ffffff !important;
    border-radius: 1rem !important;
    padding: 0 !important;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3) !important;
    overflow: hidden;
}
.leaflet-popup-content {
    margin: 0 !important;
}
.leaflet-container {
    font-family: inherit !important;
}
</style>
