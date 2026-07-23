<script setup lang="ts">
import { ref, onMounted, nextTick } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ArrowLeft, Save, MapPin, Globe, Building2 } from '@lucide/vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

const props = defineProps<{
    locationTypes: string[];
    nextOrder: number;
}>();

defineOptions({
    layout: AdminLayout,
});

const form = useForm({
    name: '',
    country: 'Bangladesh',
    city: 'Dhaka',
    region: '',
    type: 'Corporate Office',
    latitude: 23.7952445,
    longitude: 90.4026857,
    address: '',
    google_maps_url: '',
    phone: '',
    email: '',
    website: '',
    description: '',
    order: props.nextOrder || 1,
    is_active: true,
    is_featured: false,
    marker_color: '#0284c7',
    marker_icon: 'Building2',
});

const mapContainer = ref<HTMLElement | null>(null);
let mapInstance: any = null;
let pickerMarker: any = null;

onMounted(async () => {
    await nextTick();
    if (typeof window !== 'undefined') {
        const L = await import('leaflet');
        // Fix Leaflet marker icons default assets in Vite
        delete (L.Icon.Default.prototype as any)._getIconUrl;
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        });

        if (mapContainer.value) {
            mapInstance = L.map(mapContainer.value).setView([form.latitude, form.longitude], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(mapInstance);

            pickerMarker = L.marker([form.latitude, form.longitude], { draggable: true }).addTo(mapInstance);

            pickerMarker.on('dragend', (e: any) => {
                const latlng = e.target.getLatLng();
                form.latitude = parseFloat(latlng.lat.toFixed(7));
                form.longitude = parseFloat(latlng.lng.toFixed(7));
            });

            mapInstance.on('click', (e: any) => {
                const lat = parseFloat(e.latlng.lat.toFixed(7));
                const lng = parseFloat(e.latlng.lng.toFixed(7));
                form.latitude = lat;
                form.longitude = lng;
                pickerMarker.setLatLng([lat, lng]);
            });
        }
    }
});

const updateMarkerFromInputs = () => {
    if (mapInstance && pickerMarker && form.latitude && form.longitude) {
        pickerMarker.setLatLng([form.latitude, form.longitude]);
        mapInstance.panTo([form.latitude, form.longitude]);
    }
};

const submit = () => {
    form.post('/admin/global-network');
};
</script>

<template>
    <Head title="Create Global Network Location" />

    <div class="space-y-6 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <Link 
                    href="/admin/global-network" 
                    class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors"
                >
                    <ArrowLeft class="size-5" />
                </Link>
                <div>
                    <span class="font-mono text-xs uppercase tracking-widest text-amber">GLOBAL NETWORK CRUD</span>
                    <h1 class="text-2xl font-bold font-display text-slate-900">Add New Location</h1>
                </div>
            </div>
            <button 
                @click="submit" 
                :disabled="form.processing"
                class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg px-6 flex items-center gap-2 font-semibold shadow-sm transition-colors duration-150"
            >
                <Save class="size-4" />
                <span>Save Location</span>
            </button>
        </div>

        <form @submit.prevent="submit" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left 2 Columns: Basic & Map Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Location Info Card -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2 border-b pb-3">
                        <Building2 class="size-5 text-amber" />
                        Location Details
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Location Name *</label>
                            <input 
                                v-model="form.name" 
                                type="text" 
                                required
                                placeholder="e.g. Rotterdam European Hub"
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none"
                            />
                            <div v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</div>
                        </div>

                        <div>
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Country *</label>
                            <input 
                                v-model="form.country" 
                                type="text" 
                                required
                                placeholder="e.g. Netherlands"
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none"
                            />
                            <div v-if="form.errors.country" class="text-xs text-red-500 mt-1">{{ form.errors.country }}</div>
                        </div>

                        <div>
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">City *</label>
                            <input 
                                v-model="form.city" 
                                type="text" 
                                required
                                placeholder="e.g. Rotterdam"
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none"
                            />
                            <div v-if="form.errors.city" class="text-xs text-red-500 mt-1">{{ form.errors.city }}</div>
                        </div>

                        <div>
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Region / State (Optional)</label>
                            <input 
                                v-model="form.region" 
                                type="text" 
                                placeholder="e.g. South Holland"
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Location Type *</label>
                            <select 
                                v-model="form.type" 
                                required
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none bg-white"
                            >
                                <option v-for="type in locationTypes" :key="type" :value="type">{{ type }}</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Full Address *</label>
                            <textarea 
                                v-model="form.address" 
                                required
                                rows="2"
                                placeholder="Complete street address, port terminal, or building details"
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none"
                            ></textarea>
                            <div v-if="form.errors.address" class="text-xs text-red-500 mt-1">{{ form.errors.address }}</div>
                        </div>
                    </div>
                </div>

                <!-- Interactive Map Coordinates Picker Card -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <div class="flex justify-between items-center border-b pb-3">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <MapPin class="size-5 text-amber" />
                            Map Coordinate Picker
                        </h2>
                        <span class="text-xs text-slate-500 font-mono">Click or drag marker on map</span>
                    </div>

                    <!-- Map container -->
                    <div ref="mapContainer" class="w-full h-64 rounded-lg border border-slate-200 overflow-hidden z-10"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Latitude *</label>
                            <input 
                                v-model.number="form.latitude" 
                                @change="updateMarkerFromInputs"
                                type="number" 
                                step="any"
                                required
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none font-mono"
                            />
                            <div v-if="form.errors.latitude" class="text-xs text-red-500 mt-1">{{ form.errors.latitude }}</div>
                        </div>

                        <div>
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Longitude *</label>
                            <input 
                                v-model.number="form.longitude" 
                                @change="updateMarkerFromInputs"
                                type="number" 
                                step="any"
                                required
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none font-mono"
                            />
                            <div v-if="form.errors.longitude" class="text-xs text-red-500 mt-1">{{ form.errors.longitude }}</div>
                        </div>
                    </div>
                </div>

                <!-- Contact & Description Card -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2 border-b pb-3">
                        <Globe class="size-5 text-amber" />
                        Contact & Description
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Phone Number (Optional)</label>
                            <input 
                                v-model="form.phone" 
                                type="text" 
                                placeholder="+880 2 9876543"
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Email Address (Optional)</label>
                            <input 
                                v-model="form.email" 
                                type="email" 
                                placeholder="office@mercurybd.com"
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none"
                            />
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Google Maps URL (Optional)</label>
                            <input 
                                v-model="form.google_maps_url" 
                                type="url" 
                                placeholder="https://maps.google.com/?q=lat,lng"
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none font-mono text-xs"
                            />
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Short Description</label>
                            <textarea 
                                v-model="form.description" 
                                rows="3"
                                placeholder="Brief overview of operational capabilities, warehouse capacity, or services handled."
                                class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none"
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right 1 Column: Display & Status Settings -->
            <div class="space-y-6">
                <!-- Status & Order -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-sm font-mono font-bold uppercase tracking-wider text-slate-700 border-b pb-2">Status & Order</h3>

                    <div>
                        <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Display Order *</label>
                        <input 
                            v-model.number="form.order" 
                            type="number" 
                            required
                            class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none font-mono"
                        />
                    </div>

                    <div class="space-y-3 pt-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input 
                                v-model="form.is_active" 
                                type="checkbox" 
                                class="toggle toggle-primary toggle-sm"
                            />
                            <span class="text-sm font-medium text-slate-700">Active (Visible on Map)</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input 
                                v-model="form.is_featured" 
                                type="checkbox" 
                                class="toggle toggle-warning toggle-sm"
                            />
                            <span class="text-sm font-medium text-slate-700">Featured Location Pin</span>
                        </label>
                    </div>
                </div>

                <!-- Custom Marker Styling -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-sm font-mono font-bold uppercase tracking-wider text-slate-700 border-b pb-2">Marker Styling</h3>

                    <div>
                        <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Marker Accent Color</label>
                        <div class="flex items-center gap-2">
                            <input 
                                v-model="form.marker_color" 
                                type="color" 
                                class="w-10 h-10 rounded border border-slate-300 cursor-pointer"
                            />
                            <input 
                                v-model="form.marker_color" 
                                type="text" 
                                class="flex-1 px-3 py-2 border rounded-lg text-sm border-slate-300 font-mono text-xs"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-mono font-semibold uppercase text-slate-600 mb-1">Marker Icon Symbol</label>
                        <select 
                            v-model="form.marker_icon" 
                            class="w-full px-3 py-2 border rounded-lg text-sm border-slate-300 focus:border-amber focus:outline-none bg-white"
                        >
                            <option value="Building2">Building / Corporate</option>
                            <option value="Anchor">Anchor / Sea Port</option>
                            <option value="Plane">Plane / Airport</option>
                            <option value="Warehouse">Warehouse / Hub</option>
                            <option value="Users">Users / Partner</option>
                            <option value="MapPin">Standard Map Pin</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
