<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import {
    DollarSign,
    RefreshCw,
    Plus,
    Edit3,
    Trash2,
    CheckCircle,
    XCircle,
    Sliders,
    Search,
    ArrowUpRight,
    ArrowDownRight,
    Minus,
    ArrowUpDown,
    RotateCcw,
    Globe,
    Zap,
    Lock,
    Eye,
    EyeOff,
    Check,
    Layers,
    Activity,
    Server,
    Clock,
    AlertTriangle,
    Shield,
    Database
} from '@lucide/vue';

defineOptions({
    layout: AdminLayout,
});

interface ExchangeRateItem {
    id: number;
    currency_code: string;
    currency_name: string;
    symbol: string;
    flag: string;
    exchange_rate: number;
    previous_rate: number | null;
    live_rate: number | null;
    manual_rate: number | null;
    is_manual: boolean;
    source: string;
    is_active: boolean;
    order: number;
    trend: 'up' | 'down' | 'same';
    change_percentage: number;
    last_updated_at: string | null;
}

interface AvailableProvider {
    key: string;
    name: string;
    url: string;
    is_active: boolean;
}

interface DiagnosticInfo {
    active_provider_key?: string;
    active_provider_name?: string;
    current_provider?: string;
    provider?: string;
    api_url?: string;
    status?: string;
    last_successful_sync?: string | null;
    last_failed_sync?: string | null;
    last_error?: string | null;
    last_response_code?: number | string | null;
    last_response_time?: number | string | null;
    cache_status?: string;
    enable_auto_failover?: boolean;
    api_timeout?: number;
    retry_attempts?: number;
    cache_duration?: number;
    enable_logging?: boolean;
    available_providers?: AvailableProvider[];
}

const props = defineProps<{
    currencies: ExchangeRateItem[];
    filters: {
        search?: string;
        status?: string;
        source?: string;
    };
    section?: any;
    settings?: Record<string, any>;
    diagnostics?: DiagnosticInfo;
    maxOrder: number;
}>();

// Filters State
const searchQuery = ref(props.filters.search || '');
const statusFilter = ref(props.filters.status || '');
const sourceFilter = ref(props.filters.source || '');

const applyFilters = () => {
    router.get(
        '/admin/exchange-rates',
        {
            search: searchQuery.value || undefined,
            status: statusFilter.value || undefined,
            source: sourceFilter.value || undefined,
        },
        { preserveState: true, replace: true }
    );
};

const resetFilters = () => {
    searchQuery.value = '';
    statusFilter.value = '';
    sourceFilter.value = '';
    applyFilters();
};

// Summary Stats
const totalCount = computed(() => props.currencies.length);
const activeCount = computed(() => props.currencies.filter(c => c.is_active).length);
const liveCount = computed(() => props.currencies.filter(c => !c.is_manual).length);
const manualCount = computed(() => props.currencies.filter(c => c.is_manual).length);

// Refresh Live API Rates
const isRefreshing = ref(false);
const refreshRates = () => {
    isRefreshing.value = true;
    router.post('/admin/exchange-rates/refresh-rates', {}, {
        onFinish: () => {
            isRefreshing.value = false;
        }
    });
};

// Test Connection State
const testingProvider = ref<string | null>(null);
const showTestModal = ref(false);
const currentTestResult = ref<any>(null);

const testProviderConnection = async (providerKey: string) => {
    testingProvider.value = providerKey;
    try {
        const response = await fetch('/admin/exchange-rates/test-connection', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement)?.content || '',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ provider_key: providerKey })
        });
        const data = await response.json();
        currentTestResult.value = data;
        showTestModal.value = true;
    } catch (e: any) {
        currentTestResult.value = {
            success: false,
            provider_key: providerKey,
            message: 'Connection test request failed: ' + e.message,
        };
        showTestModal.value = true;
    } finally {
        testingProvider.value = null;
    }
};

// Modals State
const showAddModal = ref(false);
const showEditModal = ref(false);
const showSettingsModal = ref(false);
const showManualModal = ref(false);
const editingCurrency = ref<ExchangeRateItem | null>(null);

// Forms
const currencyForm = useForm({
    currency_code: '',
    currency_name: '',
    symbol: '$',
    flag: '🇺🇸',
    exchange_rate: 1.0000,
    is_manual: false,
    order: props.maxOrder,
    is_active: true,
});

const manualForm = useForm({
    manual_rate: 0,
});

const settingsForm = useForm({
    heading: props.section?.heading || 'Live Global Exchange Rates',
    subheading: props.section?.subheading || 'REAL-TIME CURRENCY MARKET DATA',
    body: props.section?.body || 'Stay informed with live exchange rates updated directly from international financial market APIs.',
    is_active: props.section?.is_active ?? true,
    exchange_rates_enabled: props.settings?.exchange_rates_enabled ?? 'true',
    exchange_rates_active_provider: props.settings?.exchange_rates_active_provider ?? props.diagnostics?.active_provider_key ?? 'frankfurter',
    exchange_rates_enable_auto_failover: props.settings?.exchange_rates_enable_auto_failover ?? (props.diagnostics?.enable_auto_failover !== false ? 'true' : 'false'),
    exchange_rates_auto_update: props.settings?.exchange_rates_auto_update ?? 'true',
    exchange_rates_base_currency: props.settings?.exchange_rates_base_currency ?? 'BDT',
    exchange_rates_auto_refresh_interval: props.settings?.exchange_rates_auto_refresh_interval ?? '1_hour',
    exchange_rates_api_timeout: props.settings?.exchange_rates_api_timeout ?? props.diagnostics?.api_timeout ?? 10,
    exchange_rates_retry_attempts: props.settings?.exchange_rates_retry_attempts ?? props.diagnostics?.retry_attempts ?? 2,
    exchange_rates_cache_duration: props.settings?.exchange_rates_cache_duration ?? props.diagnostics?.cache_duration ?? 10080,
    exchange_rates_enable_logging: props.settings?.exchange_rates_enable_logging ?? 'true',
    exchange_rates_bg_style: props.settings?.exchange_rates_bg_style ?? 'dark_navy',
    exchange_rates_animation_style: props.settings?.exchange_rates_animation_style ?? 'fade_up',
    exchange_rates_homepage_visibility: props.settings?.exchange_rates_homepage_visibility ?? 'true',
    exchange_rates_footer_visibility: props.settings?.exchange_rates_footer_visibility ?? 'true',
    exchange_rates_sidebar_visibility: props.settings?.exchange_rates_sidebar_visibility ?? 'false',
    exchange_rates_dedicated_page: props.settings?.exchange_rates_dedicated_page ?? 'true',
});

// Modal Handlers
const openAddModal = () => {
    currencyForm.reset();
    currencyForm.order = props.maxOrder;
    currencyForm.is_active = true;
    currencyForm.is_manual = false;
    showAddModal.value = true;
};

const openEditModal = (currency: ExchangeRateItem) => {
    editingCurrency.value = currency;
    currencyForm.currency_code = currency.currency_code;
    currencyForm.currency_name = currency.currency_name;
    currencyForm.symbol = currency.symbol;
    currencyForm.flag = currency.flag;
    currencyForm.exchange_rate = currency.exchange_rate;
    currencyForm.is_manual = currency.is_manual;
    currencyForm.order = currency.order;
    currencyForm.is_active = currency.is_active;
    showEditModal.value = true;
};

const openManualModal = (currency: ExchangeRateItem) => {
    editingCurrency.value = currency;
    manualForm.manual_rate = currency.manual_rate || currency.exchange_rate;
    showManualModal.value = true;
};

const submitAdd = () => {
    currencyForm.post('/admin/exchange-rates', {
        onSuccess: () => {
            showAddModal.value = false;
            currencyForm.reset();
        }
    });
};

const submitEdit = () => {
    if (!editingCurrency.value) return;
    currencyForm.put(`/admin/exchange-rates/${editingCurrency.value.id}`, {
        onSuccess: () => {
            showEditModal.value = false;
            editingCurrency.value = null;
        }
    });
};

const submitManualOverride = () => {
    if (!editingCurrency.value) return;
    router.patch(`/admin/exchange-rates/${editingCurrency.value.id}/toggle-manual`, {
        manual_rate: manualForm.manual_rate
    }, {
        onSuccess: () => {
            showManualModal.value = false;
            editingCurrency.value = null;
        }
    });
};

const restoreLiveRate = (currency: ExchangeRateItem) => {
    if (confirm(`Restore ${currency.currency_code} rate to automatically updated market API value?`)) {
        router.post(`/admin/exchange-rates/${currency.id}/restore-live`);
    }
};

const deleteCurrency = (currency: ExchangeRateItem) => {
    if (confirm(`Are you sure you want to delete ${currency.currency_code} (${currency.currency_name})?`)) {
        router.delete(`/admin/exchange-rates/${currency.id}`);
    }
};

const toggleStatus = (currency: ExchangeRateItem) => {
    router.patch(`/admin/exchange-rates/${currency.id}/toggle-status`);
};

const saveSettings = () => {
    settingsForm.put('/admin/exchange-rates/settings', {
        onSuccess: () => {
            showSettingsModal.value = false;
        }
    });
};

// Reorder Logic
const moveUp = (index: number) => {
    if (index === 0) return;
    const items = [...props.currencies];
    const temp = items[index].order;
    items[index].order = items[index - 1].order;
    items[index - 1].order = temp;

    const payload = items.map(item => ({ id: item.id, order: item.order }));
    router.post('/admin/exchange-rates/reorder', { items: payload });
};

const moveDown = (index: number) => {
    if (index === props.currencies.length - 1) return;
    const items = [...props.currencies];
    const temp = items[index].order;
    items[index].order = items[index + 1].order;
    items[index + 1].order = temp;

    const payload = items.map(item => ({ id: item.id, order: item.order }));
    router.post('/admin/exchange-rates/reorder', { items: payload });
};
</script>

<template>
    <Head title="Exchange Rates CMS - Admin Desk" />

    <div class="space-y-6">
        <!-- Header & Action Toolbar -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-display text-2xl font-bold tracking-tight text-slate-900">
                        Exchange Rates CMS
                    </h1>
                    <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-700 border border-amber-200">
                        Live API Driven
                    </span>
                </div>
                <p class="mt-1 text-xs text-slate-500">
                    Manage global currency exchange rates, live API updates, custom manual overrides, and section display settings.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button
                    @click="refreshRates"
                    :disabled="isRefreshing"
                    class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-slate-800 disabled:opacity-50 transition-all cursor-pointer"
                >
                    <RefreshCw class="size-4" :class="{ 'animate-spin': isRefreshing }" />
                    <span>{{ isRefreshing ? 'Refreshing API...' : 'Refresh Rates' }}</span>
                </button>

                <button
                    @click="showSettingsModal = true"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition-all cursor-pointer"
                >
                    <Sliders class="size-4 text-slate-500" />
                    <span>Section Settings</span>
                </button>

                <button
                    @click="openAddModal"
                    class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-xs font-semibold text-white shadow-md transition-all cursor-pointer"
                    style="background-color: #E8770C"
                >
                    <Plus class="size-4" />
                    <span>Add Currency</span>
                </button>
            </div>
        </div>

        <!-- Metrics Overview Grid -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Managed</p>
                    <p class="mt-1 text-2xl font-bold text-slate-900">{{ totalCount }}</p>
                </div>
                <div class="flex size-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <Globe class="size-6" />
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Active Published</p>
                    <p class="mt-1 text-2xl font-bold text-emerald-600">{{ activeCount }}</p>
                </div>
                <div class="flex size-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <CheckCircle class="size-6" />
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Live API Sync</p>
                    <p class="mt-1 text-2xl font-bold text-amber-600">{{ liveCount }}</p>
                </div>
                <div class="flex size-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                    <Zap class="size-6" />
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Manual Overrides</p>
                    <p class="mt-1 text-2xl font-bold text-indigo-600">{{ manualCount }}</p>
                </div>
                <div class="flex size-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                    <Lock class="size-6" />
                </div>
            </div>
        </div>

        <!-- System & API Health Diagnostics (Administrator Exclusive) -->
        <div v-if="diagnostics" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-xs space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <Activity class="size-5 text-amber-600" />
                    <h3 class="text-sm font-bold text-slate-900">Exchange Rates Multi-Provider Diagnostics</h3>
                    <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Admin Console</span>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs text-slate-500 font-medium">Active Provider:</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-bold text-blue-700 border border-blue-200">
                        <Server class="size-3" />
                        {{ diagnostics.active_provider_name || diagnostics.provider || 'Frankfurter API' }}
                    </span>
                    <span
                        v-if="diagnostics.enable_auto_failover !== false"
                        class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-700 border border-emerald-200"
                    >
                        <Shield class="size-3" />
                        Auto Failover On
                    </span>
                </div>
            </div>

            <!-- Failure Error Alert if Any -->
            <div v-if="diagnostics.status === 'failed' && diagnostics.last_error" class="rounded-xl border border-rose-200 bg-rose-50/70 p-3.5 flex items-start gap-3">
                <AlertTriangle class="size-5 text-rose-600 shrink-0 mt-0.5" />
                <div class="space-y-1 text-xs">
                    <p class="font-bold text-rose-900">Live API Refresh Exception Detected</p>
                    <p class="text-rose-700 font-mono">{{ diagnostics.last_error }}</p>
                    <p class="text-slate-500 text-[11px]">System is automatically serving cached market rates to ensure 100% public uptime.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6 text-xs">
                <!-- API Status -->
                <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                    <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">API Status</span>
                    <div class="mt-1 flex items-center gap-1.5">
                        <span class="size-2 rounded-full" :class="diagnostics.status === 'success' ? 'bg-emerald-500' : 'bg-rose-500'"></span>
                        <span class="font-bold capitalize" :class="diagnostics.status === 'success' ? 'text-emerald-700' : 'text-rose-700'">
                            {{ diagnostics.status === 'success' ? 'Operational' : 'Sync Error' }}
                        </span>
                    </div>
                </div>

                <!-- Last Sync Provider -->
                <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                    <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">Last Sync Provider</span>
                    <div class="mt-1 font-semibold text-slate-800 truncate">
                        {{ diagnostics.current_provider || 'Frankfurter API' }}
                    </div>
                </div>

                <!-- Last Successful Sync -->
                <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                    <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">Last Successful Sync</span>
                    <div class="mt-1 font-mono font-medium text-slate-800">
                        {{ diagnostics.last_successful_sync ? new Date(diagnostics.last_successful_sync).toLocaleTimeString() : 'Never' }}
                    </div>
                </div>

                <!-- Response Time -->
                <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                    <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">Response Latency</span>
                    <div class="mt-1 font-mono font-bold text-slate-800">
                        {{ diagnostics.last_response_time ? diagnostics.last_response_time + ' ms' : 'N/A' }}
                    </div>
                </div>

                <!-- HTTP Response Code -->
                <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                    <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">HTTP Status Code</span>
                    <div class="mt-1 font-mono font-bold" :class="diagnostics.last_response_code === 200 || diagnostics.last_response_code === '200' ? 'text-emerald-600' : 'text-rose-600'">
                        {{ diagnostics.last_response_code ? diagnostics.last_response_code : 'N/A' }}
                    </div>
                </div>

                <!-- Cache State -->
                <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                    <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">Cache Strategy</span>
                    <div class="mt-1 font-semibold text-slate-700 capitalize">
                        {{ diagnostics.cache_status === 'fresh' ? 'Fresh Data' : 'Cached Fallback' }}
                    </div>
                </div>
            </div>

            <!-- Provider Connection Test Toolbar -->
            <div class="pt-2 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                <div class="text-xs text-slate-500 font-medium">
                    Test Provider Connections Independently:
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <button
                        @click="testProviderConnection('frankfurter')"
                        :disabled="testingProvider === 'frankfurter'"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100 transition-colors disabled:opacity-50 cursor-pointer"
                    >
                        <RefreshCw v-if="testingProvider === 'frankfurter'" class="size-3.5 animate-spin" />
                        <Server v-else class="size-3.5 text-blue-600" />
                        <span>Test Frankfurter API</span>
                    </button>

                    <button
                        @click="testProviderConnection('fawaz_ahmed')"
                        :disabled="testingProvider === 'fawaz_ahmed'"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100 transition-colors disabled:opacity-50 cursor-pointer"
                    >
                        <RefreshCw v-if="testingProvider === 'fawaz_ahmed'" class="size-3.5 animate-spin" />
                        <Globe v-else class="size-3.5 text-emerald-600" />
                        <span>Test Fawaz Ahmed API</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-xs">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div class="relative flex-1">
                    <Search class="absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                    <input
                        v-model="searchQuery"
                        @keyup.enter="applyFilters"
                        type="text"
                        placeholder="Search currency by code (USD, EUR) or name..."
                        class="w-full rounded-xl border border-slate-200 pl-10 pr-4 py-2 text-xs text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:ring-1 focus:ring-amber-500"
                    />
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <select
                        v-model="statusFilter"
                        @change="applyFilters"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-700 focus:border-amber-500 focus:ring-1 focus:ring-amber-500"
                    >
                        <option value="">All Statuses</option>
                        <option value="active">Active Only</option>
                        <option value="inactive">Inactive Only</option>
                    </select>

                    <select
                        v-model="sourceFilter"
                        @change="applyFilters"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-700 focus:border-amber-500 focus:ring-1 focus:ring-amber-500"
                    >
                        <option value="">All Sources</option>
                        <option value="live">Live API</option>
                        <option value="manual">Manual Override</option>
                    </select>

                    <button
                        v-if="searchQuery || statusFilter || sourceFilter"
                        @click="resetFilters"
                        class="text-xs text-rose-600 hover:text-rose-700 font-medium px-2 py-1"
                    >
                        Clear Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Currencies Data Table -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-[11px] uppercase tracking-wider font-semibold text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3.5 text-center w-12">Order</th>
                            <th class="px-4 py-3.5">Currency</th>
                            <th class="px-4 py-3.5">Current Rate (BDT)</th>
                            <th class="px-4 py-3.5">Live API Rate</th>
                            <th class="px-4 py-3.5">Trend / Change</th>
                            <th class="px-4 py-3.5">Source Mode</th>
                            <th class="px-4 py-3.5">Status</th>
                            <th class="px-4 py-3.5">Last Updated</th>
                            <th class="px-4 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-if="currencies.length === 0">
                            <td colspan="9" class="px-6 py-12 text-center text-slate-400">
                                <DollarSign class="mx-auto size-8 opacity-30 mb-2" />
                                <p class="text-sm font-medium">No exchange rates found matching your criteria.</p>
                            </td>
                        </tr>

                        <tr
                            v-for="(currency, index) in currencies"
                            :key="currency.id"
                            class="hover:bg-slate-50/80 transition-colors"
                        >
                            <!-- Reorder buttons -->
                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-col items-center justify-center gap-0.5">
                                    <button
                                        @click="moveUp(index)"
                                        :disabled="index === 0"
                                        class="p-0.5 text-slate-400 hover:text-amber-600 disabled:opacity-20 cursor-pointer"
                                    >
                                        ▲
                                    </button>
                                    <span class="font-mono text-[10px] font-bold text-slate-500">{{ currency.order }}</span>
                                    <button
                                        @click="moveDown(index)"
                                        :disabled="index === currencies.length - 1"
                                        class="p-0.5 text-slate-400 hover:text-amber-600 disabled:opacity-20 cursor-pointer"
                                    >
                                        ▼
                                    </button>
                                </div>
                            </td>

                            <!-- Currency info -->
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">{{ currency.flag }}</span>
                                    <div>
                                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                            <span>{{ currency.currency_code }}</span>
                                            <span class="text-xs font-normal text-slate-400">({{ currency.symbol }})</span>
                                        </div>
                                        <div class="text-[11px] text-slate-500">{{ currency.currency_name }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Current Active Rate -->
                            <td class="px-4 py-3 font-mono font-bold text-slate-900 text-sm">
                                {{ currency.symbol }}1 = {{ currency.exchange_rate.toFixed(4) }} BDT
                            </td>

                            <!-- Live Rate -->
                            <td class="px-4 py-3 font-mono text-slate-500">
                                {{ currency.live_rate ? currency.live_rate.toFixed(4) + ' BDT' : 'N/A' }}
                            </td>

                            <!-- Trend & Change -->
                            <td class="px-4 py-3">
                                <div
                                    class="inline-flex items-center gap-1 font-mono text-[11px] font-semibold px-2 py-0.5 rounded-md"
                                    :class="{
                                        'bg-emerald-50 text-emerald-700': currency.trend === 'up',
                                        'bg-rose-50 text-rose-700': currency.trend === 'down',
                                        'bg-slate-100 text-slate-600': currency.trend === 'same'
                                    }"
                                >
                                    <ArrowUpRight v-if="currency.trend === 'up'" class="size-3.5" />
                                    <ArrowDownRight v-else-if="currency.trend === 'down'" class="size-3.5" />
                                    <Minus v-else class="size-3.5" />
                                    <span>{{ currency.change_percentage > 0 ? '+' : '' }}{{ currency.change_percentage }}%</span>
                                </div>
                            </td>

                            <!-- Source Tag -->
                            <td class="px-4 py-3">
                                <span
                                    v-if="currency.is_manual"
                                    class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-0.5 text-[10px] font-semibold text-indigo-700 border border-indigo-200"
                                >
                                    <Lock class="size-3" />
                                    Manual
                                </span>
                                <span
                                    v-else
                                    class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[10px] font-semibold text-emerald-700 border border-emerald-200"
                                >
                                    <Zap class="size-3" />
                                    Live API
                                </span>
                            </td>

                            <!-- Status Toggle -->
                            <td class="px-4 py-3">
                                <button
                                    @click="toggleStatus(currency)"
                                    class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-[11px] font-medium transition-colors cursor-pointer"
                                    :class="currency.is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-500 border border-slate-200'"
                                >
                                    <span class="size-1.5 rounded-full" :class="currency.is_active ? 'bg-emerald-500' : 'bg-slate-400'"></span>
                                    <span>{{ currency.is_active ? 'Active' : 'Inactive' }}</span>
                                </button>
                            </td>

                            <!-- Last Updated -->
                            <td class="px-4 py-3 text-slate-400 text-[11px]">
                                {{ currency.last_updated_at ? new Date(currency.last_updated_at).toLocaleString() : 'N/A' }}
                            </td>

                            <!-- Action Buttons -->
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        @click="openManualModal(currency)"
                                        title="Override Exchange Rate Manually"
                                        class="rounded-lg p-1.5 text-slate-500 hover:bg-slate-100 hover:text-indigo-600 transition-colors cursor-pointer"
                                    >
                                        <Lock class="size-4" />
                                    </button>

                                    <button
                                        v-if="currency.is_manual"
                                        @click="restoreLiveRate(currency)"
                                        title="Restore Live API Rate"
                                        class="rounded-lg p-1.5 text-slate-500 hover:bg-slate-100 hover:text-emerald-600 transition-colors cursor-pointer"
                                    >
                                        <RotateCcw class="size-4" />
                                    </button>

                                    <button
                                        @click="openEditModal(currency)"
                                        title="Edit Details"
                                        class="rounded-lg p-1.5 text-slate-500 hover:bg-slate-100 hover:text-amber-600 transition-colors cursor-pointer"
                                    >
                                        <Edit3 class="size-4" />
                                    </button>

                                    <button
                                        @click="deleteCurrency(currency)"
                                        title="Delete Currency"
                                        class="rounded-lg p-1.5 text-slate-500 hover:bg-rose-50 hover:text-rose-600 transition-colors cursor-pointer"
                                    >
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Currency Modal -->
        <div v-if="showAddModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl border border-slate-100">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <h3 class="font-display text-lg font-bold text-slate-900">Add New Currency</h3>
                    <button @click="showAddModal = false" class="text-slate-400 hover:text-slate-600"><XCircle class="size-5" /></button>
                </div>

                <form @submit.prevent="submitAdd" class="mt-4 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700">Currency Code</label>
                            <input v-model="currencyForm.currency_code" type="text" placeholder="USD" uppercase class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500" required />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700">Symbol</label>
                            <input v-model="currencyForm.symbol" type="text" placeholder="$" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500" required />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700">Currency Name</label>
                        <input v-model="currencyForm.currency_name" type="text" placeholder="US Dollar" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500" required />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700">Flag Emoji / Icon</label>
                        <input v-model="currencyForm.flag" type="text" placeholder="🇺🇸" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500" required />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700">Exchange Rate (in BDT)</label>
                        <input v-model="currencyForm.exchange_rate" type="number" step="0.0001" min="0" placeholder="120.50" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500 font-mono" required />
                    </div>

                    <div class="flex items-center gap-2">
                        <input v-model="currencyForm.is_manual" type="checkbox" id="add_is_manual" class="rounded text-amber-600 focus:ring-amber-500" />
                        <label for="add_is_manual" class="text-xs text-slate-700">Set as Manual Rate Override</label>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="showAddModal = false" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-800">Cancel</button>
                        <button type="submit" :disabled="currencyForm.processing" class="px-4 py-2 text-xs font-semibold text-white rounded-xl shadow-sm" style="background-color: #E8770C">Save Currency</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Currency Modal -->
        <div v-if="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl border border-slate-100">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <h3 class="font-display text-lg font-bold text-slate-900">Edit Currency: {{ editingCurrency?.currency_code }}</h3>
                    <button @click="showEditModal = false" class="text-slate-400 hover:text-slate-600"><XCircle class="size-5" /></button>
                </div>

                <form @submit.prevent="submitEdit" class="mt-4 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700">Currency Code</label>
                            <input v-model="currencyForm.currency_code" type="text" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500" required />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700">Symbol</label>
                            <input v-model="currencyForm.symbol" type="text" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500" required />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700">Currency Name</label>
                        <input v-model="currencyForm.currency_name" type="text" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500" required />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700">Flag Emoji / Icon</label>
                        <input v-model="currencyForm.flag" type="text" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500" required />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700">Active Rate (in BDT)</label>
                        <input v-model="currencyForm.exchange_rate" type="number" step="0.0001" min="0" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-amber-500 font-mono" required />
                    </div>

                    <div class="flex items-center gap-2">
                        <input v-model="currencyForm.is_manual" type="checkbox" id="edit_is_manual" class="rounded text-amber-600 focus:ring-amber-500" />
                        <label for="edit_is_manual" class="text-xs text-slate-700">Manual Override Mode</label>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="showEditModal = false" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-800">Cancel</button>
                        <button type="submit" :disabled="currencyForm.processing" class="px-4 py-2 text-xs font-semibold text-white rounded-xl shadow-sm" style="background-color: #E8770C">Update Currency</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Manual Override Rate Modal -->
        <div v-if="showManualModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-xl border border-slate-100">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <h3 class="font-display text-lg font-bold text-slate-900">Override {{ editingCurrency?.currency_code }} Rate</h3>
                    <button @click="showManualModal = false" class="text-slate-400 hover:text-slate-600"><XCircle class="size-5" /></button>
                </div>

                <form @submit.prevent="submitManualOverride" class="mt-4 space-y-4">
                    <div>
                        <p class="text-xs text-slate-500 mb-2">
                            Enter a custom exchange rate value to override live market API data for {{ editingCurrency?.currency_name }}.
                        </p>
                        <label class="block text-xs font-semibold text-slate-700">Custom Exchange Rate (BDT)</label>
                        <input v-model="manualForm.manual_rate" type="number" step="0.0001" min="0" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm font-mono font-bold focus:border-indigo-500" required />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="showManualModal = false" class="px-4 py-2 text-xs font-semibold text-slate-600">Cancel</button>
                        <button type="submit" class="px-4 py-2 text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm">Apply Manual Rate</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Section Settings Drawer/Modal -->
        <div v-if="showSettingsModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="w-full max-w-xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white p-6 shadow-xl border border-slate-100">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <h3 class="font-display text-lg font-bold text-slate-900">Exchange Rates Section Settings</h3>
                    <button @click="showSettingsModal = false" class="text-slate-400 hover:text-slate-600"><XCircle class="size-5" /></button>
                </div>

                <form @submit.prevent="saveSettings" class="mt-4 space-y-5">
                    <!-- Basic Section Info -->
                    <div class="space-y-3 border-b border-slate-100 pb-4">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Homepage Content</h4>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700">Section Subtitle</label>
                            <input v-model="settingsForm.subheading" type="text" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700">Section Title</label>
                            <input v-model="settingsForm.heading" type="text" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs" required />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700">Description</label>
                            <textarea v-model="settingsForm.body" rows="2" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs"></textarea>
                        </div>
                    </div>

                    <!-- Visibility Controls -->
                    <div class="space-y-3 border-b border-slate-100 pb-4">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Display Locations</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 cursor-pointer">
                                <input v-model="settingsForm.exchange_rates_homepage_visibility" type="checkbox" true-value="true" false-value="false" class="rounded text-amber-600" />
                                <span class="text-xs font-medium text-slate-700">Homepage Section</span>
                            </label>

                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 cursor-pointer">
                                <input v-model="settingsForm.exchange_rates_footer_visibility" type="checkbox" true-value="true" false-value="false" class="rounded text-amber-600" />
                                <span class="text-xs font-medium text-slate-700">Footer Ticker</span>
                            </label>

                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 cursor-pointer">
                                <input v-model="settingsForm.exchange_rates_sidebar_visibility" type="checkbox" true-value="true" false-value="false" class="rounded text-amber-600" />
                                <span class="text-xs font-medium text-slate-700">Sidebar Widget</span>
                            </label>

                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 cursor-pointer">
                                <input v-model="settingsForm.exchange_rates_dedicated_page" type="checkbox" true-value="true" false-value="false" class="rounded text-amber-600" />
                                <span class="text-xs font-medium text-slate-700">Dedicated Page</span>
                            </label>
                        </div>
                    </div>

                    <!-- Exchange Rate Provider Selection & Failover Architecture -->
                    <div class="space-y-3 border-b border-slate-100 pb-4">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Exchange Rate Provider Architecture</h4>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Active Primary Provider</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <label
                                    class="flex items-start gap-3 p-3 rounded-xl border cursor-pointer transition-all"
                                    :class="settingsForm.exchange_rates_active_provider === 'frankfurter' ? 'border-amber-500 bg-amber-50/40 ring-1 ring-amber-500' : 'border-slate-200 hover:bg-slate-50'"
                                >
                                    <input type="radio" v-model="settingsForm.exchange_rates_active_provider" value="frankfurter" class="mt-0.5 text-amber-600 focus:ring-amber-500" />
                                    <div>
                                        <div class="font-bold text-xs text-slate-900 flex items-center gap-1.5">
                                            <span>Frankfurter API</span>
                                            <span class="rounded bg-blue-100 px-1.5 py-0.5 text-[9px] font-semibold text-blue-700">Official</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">European Central Bank reference rates (api.frankfurter.dev)</p>
                                    </div>
                                </label>

                                <label
                                    class="flex items-start gap-3 p-3 rounded-xl border cursor-pointer transition-all"
                                    :class="settingsForm.exchange_rates_active_provider === 'fawaz_ahmed' ? 'border-amber-500 bg-amber-50/40 ring-1 ring-amber-500' : 'border-slate-200 hover:bg-slate-50'"
                                >
                                    <input type="radio" v-model="settingsForm.exchange_rates_active_provider" value="fawaz_ahmed" class="mt-0.5 text-amber-600 focus:ring-amber-500" />
                                    <div>
                                        <div class="font-bold text-xs text-slate-900 flex items-center gap-1.5">
                                            <span>Fawaz Ahmed API</span>
                                            <span class="rounded bg-emerald-100 px-1.5 py-0.5 text-[9px] font-semibold text-emerald-700">Global CDN</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Global multi-currency financial JSON API</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Automatic Failover Toggle -->
                        <div class="rounded-xl border border-slate-200 p-3 bg-slate-50/70 flex items-center justify-between">
                            <div>
                                <label for="auto_failover_toggle" class="text-xs font-bold text-slate-900 cursor-pointer">Enable Automatic Failover</label>
                                <p class="text-[11px] text-slate-500">Automatically switch to secondary provider if primary API is unavailable.</p>
                            </div>
                            <input
                                id="auto_failover_toggle"
                                v-model="settingsForm.exchange_rates_enable_auto_failover"
                                type="checkbox"
                                true-value="true"
                                false-value="false"
                                class="rounded text-amber-600 focus:ring-amber-500 size-4"
                            />
                        </div>
                    </div>

                    <!-- API & Automation Options -->
                    <div class="space-y-3 border-b border-slate-100 pb-4">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">API Connection & Sync Rules</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700">Auto Update Status</label>
                                <select v-model="settingsForm.exchange_rates_auto_update" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs">
                                    <option value="true">Enabled (Automatic API Sync)</option>
                                    <option value="false">Disabled (Manual Only)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700">Refresh Interval</label>
                                <select v-model="settingsForm.exchange_rates_auto_refresh_interval" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs">
                                    <option value="1_hour">Every 1 Hour</option>
                                    <option value="6_hours">Every 6 Hours</option>
                                    <option value="12_hours">Every 12 Hours</option>
                                    <option value="24_hours">Daily</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700">API Timeout (Seconds)</label>
                                <input v-model="settingsForm.exchange_rates_api_timeout" type="number" min="1" max="60" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-mono" />
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700">Retry Attempts</label>
                                <input v-model="settingsForm.exchange_rates_retry_attempts" type="number" min="1" max="5" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-mono" />
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700">Base Target Currency</label>
                                <input v-model="settingsForm.exchange_rates_base_currency" type="text" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-mono" />
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700">Detailed Error Logging</label>
                                <select v-model="settingsForm.exchange_rates_enable_logging" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs">
                                    <option value="true">Enabled</option>
                                    <option value="false">Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Visual Styles -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Aesthetics & Styling</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700">Background Theme</label>
                                <select v-model="settingsForm.exchange_rates_bg_style" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs">
                                    <option value="dark_navy">Dark Navy (#0B2540)</option>
                                    <option value="gradient_slate">Gradient Slate</option>
                                    <option value="light_glass">Light Glassmorphic</option>
                                    <option value="pure_white">Pure White</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700">Animation Style</label>
                                <select v-model="settingsForm.exchange_rates_animation_style" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-xs">
                                    <option value="fade_up">Fade Up Reveal</option>
                                    <option value="pulse_rate">Pulse Rate Badge</option>
                                    <option value="slide_in">Slide In</option>
                                    <option value="none">None</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="showSettingsModal = false" class="px-4 py-2 text-xs font-semibold text-slate-600">Cancel</button>
                        <button type="submit" :disabled="settingsForm.processing" class="px-4 py-2 text-xs font-semibold text-white rounded-xl shadow-sm" style="background-color: #E8770C">Save All Settings</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Connection Test Result Modal -->
        <div v-if="showTestModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
            <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl border border-slate-100">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <Server class="size-5 text-amber-600" />
                        <h3 class="font-display text-base font-bold text-slate-900">Provider Connection Test</h3>
                    </div>
                    <button @click="showTestModal = false" class="text-slate-400 hover:text-slate-600"><XCircle class="size-5" /></button>
                </div>

                <div class="mt-4 space-y-4 text-xs">
                    <div
                        class="rounded-xl p-4 border flex items-start gap-3"
                        :class="currentTestResult?.success ? 'bg-emerald-50/70 border-emerald-200' : 'bg-rose-50/70 border-rose-200'"
                    >
                        <CheckCircle v-if="currentTestResult?.success" class="size-5 text-emerald-600 shrink-0 mt-0.5" />
                        <AlertTriangle v-else class="size-5 text-rose-600 shrink-0 mt-0.5" />

                        <div class="space-y-1">
                            <p class="font-bold text-sm" :class="currentTestResult?.success ? 'text-emerald-900' : 'text-rose-900'">
                                {{ currentTestResult?.success ? 'Connection Successful' : 'Connection Failed' }}
                            </p>
                            <p :class="currentTestResult?.success ? 'text-emerald-700' : 'text-rose-700'">
                                {{ currentTestResult?.message }}
                            </p>
                        </div>
                    </div>

                    <div v-if="currentTestResult" class="space-y-2 rounded-xl bg-slate-50 p-3.5 border border-slate-200 font-mono text-[11px]">
                        <div class="flex justify-between border-b border-slate-200/60 pb-1.5">
                            <span class="text-slate-500 font-sans">Provider Name:</span>
                            <span class="font-bold text-slate-900">{{ currentTestResult.provider || currentTestResult.provider_key }}</span>
                        </div>

                        <div class="flex justify-between border-b border-slate-200/60 pb-1.5">
                            <span class="text-slate-500 font-sans">Endpoint URL:</span>
                            <span class="text-slate-700 truncate max-w-[200px]" :title="currentTestResult.url">{{ currentTestResult.url || 'N/A' }}</span>
                        </div>

                        <div class="flex justify-between border-b border-slate-200/60 pb-1.5">
                            <span class="text-slate-500 font-sans">Response Latency:</span>
                            <span class="font-bold text-slate-900">{{ currentTestResult.response_time_ms ? currentTestResult.response_time_ms + ' ms' : 'N/A' }}</span>
                        </div>

                        <div v-if="currentTestResult.sample_rate" class="flex justify-between border-b border-slate-200/60 pb-1.5">
                            <span class="text-slate-500 font-sans">Sample Live Rate:</span>
                            <span class="font-bold text-emerald-700">{{ currentTestResult.sample_rate }}</span>
                        </div>

                        <div v-if="currentTestResult.error_detail" class="pt-1 text-rose-700 font-sans">
                            <span class="font-bold block text-rose-900">Error Detail:</span>
                            <span>{{ currentTestResult.error_detail }}</span>
                        </div>
                    </div>

                    <p class="text-[11px] text-slate-400 text-center">
                        Note: Independent connection testing does not update production rate tables.
                    </p>
                </div>

                <div class="flex items-center justify-end pt-4 border-t border-slate-100 mt-4">
                    <button @click="showTestModal = false" class="px-4 py-2 text-xs font-semibold text-white bg-slate-900 rounded-xl shadow-sm hover:bg-slate-800">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
