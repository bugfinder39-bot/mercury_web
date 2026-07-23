<script setup lang="ts">
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Edit, Trash2, Plus, Globe, ExternalLink, Search, Star, MapPin, Eye, EyeOff } from '@lucide/vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

const props = defineProps<{
    locations: any[];
    filters: {
        search?: string;
        type?: string;
        status?: string;
    };
    locationTypes: string[];
}>();

defineOptions({
    layout: AdminLayout,
});

const search = ref(props.filters.search || '');
const selectedType = ref(props.filters.type || '');
const selectedStatus = ref(props.filters.status || '');

const applyFilters = () => {
    router.get('/admin/global-network', {
        search: search.value || undefined,
        type: selectedType.value || undefined,
        status: selectedStatus.value || undefined,
    }, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
};

const resetFilters = () => {
    search.value = '';
    selectedType.value = '';
    selectedStatus.value = '';
    applyFilters();
};

const deleteLocation = (id: number, name: string) => {
    if (confirm(`Are you sure you want to delete "${name}" from the global network?`)) {
        router.delete(`/admin/global-network/${id}`, {
            preserveScroll: true,
        });
    }
};

const toggleStatus = (id: number) => {
    router.patch(`/admin/global-network/${id}/toggle-status`, {}, {
        preserveScroll: true,
    });
};

const getTypeColorClass = (type: string) => {
    switch (type) {
        case 'Corporate Office':
            return 'bg-blue-100 text-blue-800 border-blue-200';
        case 'Sea Port':
            return 'bg-teal-100 text-teal-800 border-teal-200';
        case 'Air Port':
            return 'bg-amber-100 text-amber-800 border-amber-200';
        case 'Warehouse':
        case 'Distribution Center':
            return 'bg-indigo-100 text-indigo-800 border-indigo-200';
        case 'Partner Office':
        case 'Agent':
            return 'bg-purple-100 text-purple-800 border-purple-200';
        default:
            return 'bg-slate-100 text-slate-800 border-slate-200';
    }
};
</script>

<template>
    <Head title="Manage Global Network Locations" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-amber">MB · GLOBAL NETWORK MODULE</span>
                <h1 class="text-3xl font-bold font-display mt-1" style="color: #0B2540;">Global Network Locations</h1>
                <p class="font-body text-sm mt-0.5" style="color: #5B6B79;">Manage worldwide ports, offices, hubs, warehouses, and partners displayed on the interactive map.</p>
            </div>
            <div>
                <Link 
                    href="/admin/global-network/create" 
                    class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg px-5 flex items-center gap-2 font-semibold shadow-sm transition-colors duration-150"
                >
                    <Plus class="size-4" />
                    <span>Add Location</span>
                </Link>
            </div>
        </div>

        <!-- Success Flash Alert -->
        <div v-if="$page.props.flash?.success" class="alert alert-success text-white rounded-lg flex items-center gap-2 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ $page.props.flash.success }}</span>
        </div>

        <!-- Filter and Search Bar -->
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col md:flex-row gap-4 justify-between items-center">
            <div class="flex flex-1 flex-col sm:flex-row gap-3 w-full">
                <!-- Search Input -->
                <div class="relative flex-1">
                    <Search class="size-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" />
                    <input 
                        v-model="search"
                        @keyup.enter="applyFilters"
                        type="text" 
                        placeholder="Search location name, country, city..." 
                        class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-amber focus:bg-white"
                    />
                </div>

                <!-- Type Filter -->
                <select 
                    v-model="selectedType" 
                    @change="applyFilters"
                    class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-3 py-2 focus:outline-none focus:border-amber"
                >
                    <option value="">All Location Types</option>
                    <option v-for="type in locationTypes" :key="type" :value="type">{{ type }}</option>
                </select>

                <!-- Status Filter -->
                <select 
                    v-model="selectedStatus" 
                    @change="applyFilters"
                    class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-3 py-2 focus:outline-none focus:border-amber"
                >
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="flex gap-2 w-full md:w-auto justify-end">
                <button 
                    @click="applyFilters" 
                    class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-lg text-sm font-medium transition-colors"
                >
                    Filter
                </button>
                <button 
                    v-if="search || selectedType || selectedStatus"
                    @click="resetFilters" 
                    class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-medium transition-colors"
                >
                    Reset
                </button>
            </div>
        </div>

        <!-- Locations Table -->
        <div class="card-premium overflow-hidden p-0 border border-slate-200 shadow-sm rounded-xl bg-white">
            <div class="overflow-x-auto">
                <table class="w-full table-premium text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200">
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Order</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Location</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Type</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Coordinates (Lat/Lng)</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Featured</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Status</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white text-right" style="background-color: #0B2540;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-body">
                        <tr 
                            v-for="location in locations" 
                            :key="location.id" 
                            class="hover:bg-slate-50 transition-colors duration-150"
                        >
                            <td class="px-6 py-4 font-mono text-xs font-medium text-slate-500">
                                #{{ location.order }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-sm text-slate-900 flex items-center gap-1.5">
                                    <MapPin class="size-4 text-amber shrink-0" />
                                    <span>{{ location.name }}</span>
                                </div>
                                <div class="text-xs text-slate-500 font-mono mt-0.5">
                                    {{ location.city }}, {{ location.country }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span 
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-mono font-medium border"
                                    :class="getTypeColorClass(location.type)"
                                >
                                    {{ location.type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-xs text-slate-600">
                                <div>{{ location.latitude }}, {{ location.longitude }}</div>
                                <a 
                                    v-if="location.google_maps_url" 
                                    :href="location.google_maps_url" 
                                    target="_blank" 
                                    class="text-amber hover:underline inline-flex items-center gap-1 text-[11px] mt-0.5"
                                >
                                    <span>Maps Link</span>
                                    <ExternalLink class="size-3" />
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <span v-if="location.is_featured" class="inline-flex items-center gap-1 text-xs font-semibold text-amber bg-amber/10 px-2 py-0.5 rounded-md border border-amber/20">
                                    <Star class="size-3 fill-amber text-amber" />
                                    Featured
                                </span>
                                <span v-else class="text-xs text-slate-400 font-mono">—</span>
                            </td>
                            <td class="px-6 py-4">
                                <button
                                    @click="toggleStatus(location.id)"
                                    class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-mono font-semibold uppercase tracking-wide border cursor-pointer hover:opacity-80 transition-opacity"
                                    :style="location.is_active
                                        ? 'background-color: rgba(31,122,92,0.12); color: #1F7A5C; border-color: rgba(31,122,92,0.25);'
                                        : 'background-color: rgba(11,37,64,0.06); color: #5B6B79; border-color: rgba(11,37,64,0.12);'"
                                >
                                    <Eye v-if="location.is_active" class="size-3" />
                                    <EyeOff v-else class="size-3" />
                                    {{ location.is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3 items-center">
                                    <Link
                                        :href="`/admin/global-network/${location.id}/edit`"
                                        class="font-mono text-xs font-semibold uppercase tracking-wide transition-colors flex items-center gap-1 text-amber hover:underline"
                                    >
                                        <Edit class="size-3.5" />
                                        <span>Edit</span>
                                    </Link>
                                    <button
                                        @click="deleteLocation(location.id, location.name)"
                                        class="font-mono text-xs font-semibold uppercase tracking-wide transition-colors flex items-center gap-1 hover:underline text-red-600 hover:text-red-800"
                                    >
                                        <Trash2 class="size-3.5" />
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!locations || locations.length === 0">
                            <td colspan="7" class="text-center py-16 font-body text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <Globe class="size-10 text-slate-300" />
                                    <span class="text-slate-600 font-medium">No network locations found.</span>
                                    <span class="text-xs text-slate-400">Click "Add Location" to place your first location pin on the map.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
