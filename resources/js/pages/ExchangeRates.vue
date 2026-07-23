<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import {
    TrendingUp,
    ArrowUpRight,
    ArrowDownRight,
    Minus,
    Calculator,
    ArrowRightLeft,
    Globe,
    Zap,
    Lock,
    Search,
    ShieldCheck,
    HelpCircle
} from '@lucide/vue';

defineOptions({
    layout: PublicLayout,
});

interface CurrencyItem {
    id: number;
    currency_code: string;
    currency_name: string;
    symbol: string;
    flag: string;
    exchange_rate: number;
    previous_rate: number | null;
    live_rate: number | null;
    is_manual: boolean;
    trend: 'up' | 'down' | 'same';
    change_percentage: number;
    last_updated_at: string | null;
}

const props = defineProps<{
    exchangeRates: CurrencyItem[];
    section?: any;
}>();

// Search & Filter State
const searchQuery = ref('');

const filteredRates = computed(() => {
    if (!searchQuery.value.trim()) return props.exchangeRates;
    const q = searchQuery.value.toLowerCase();
    return props.exchangeRates.filter(
        c => c.currency_code.toLowerCase().includes(q) ||
             c.currency_name.toLowerCase().includes(q) ||
             c.symbol.toLowerCase().includes(q)
    );
});

// Converter State
const calcAmount = ref<number>(100);
const calcFromCode = ref<string>('USD');
const calcToCode = ref<string>('BDT');

const convertedResult = computed(() => {
    if (!calcAmount.value || calcAmount.value <= 0) return '0.00';

    const fromCurr = props.exchangeRates.find(c => c.currency_code === calcFromCode.value);
    const toCurr = props.exchangeRates.find(c => c.currency_code === calcToCode.value);

    let fromBdtRate = 1.0;
    if (calcFromCode.value !== 'BDT') {
        fromBdtRate = fromCurr ? fromCurr.exchange_rate : 120.50;
    }

    let toBdtRate = 1.0;
    if (calcToCode.value !== 'BDT') {
        toBdtRate = toCurr ? toCurr.exchange_rate : 1.0;
    }

    const result = calcAmount.value * (fromBdtRate / toBdtRate);
    return result.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 4 });
});

const swapCurrencies = () => {
    const temp = calcFromCode.value;
    calcFromCode.value = calcToCode.value;
    calcToCode.value = temp;
};

const targetSymbol = computed(() => {
    if (calcToCode.value === 'BDT') return '৳';
    const c = props.exchangeRates.find(item => item.currency_code === calcToCode.value);
    return c ? c.symbol : '';
});
</script>

<template>
    <Head title="Live Exchange Rates - Mercury Bangladesh" />

    <!-- Hero Header -->
    <div class="relative py-16 lg:py-24 font-sans text-white overflow-hidden" style="background-color: #0b2540;">
        <div class="pointer-events-none absolute -top-40 -right-40 size-96 rounded-full bg-amber-500/10 blur-3xl"></div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 rounded-full px-3.5 py-1 text-xs font-semibold tracking-wide uppercase" style="background-color: rgba(232, 119, 12, 0.15); color: #E8770C; border: 1px solid rgba(232, 119, 12, 0.3);">
                <TrendingUp class="size-3.5" />
                <span>Financial Market Rates</span>
            </div>

            <h1 class="mt-4 font-display text-4xl font-extrabold tracking-tight sm:text-5xl">
                Live Exchange Rates & Currency Converter
            </h1>

            <p class="mt-4 text-slate-300 text-base max-w-2xl mx-auto">
                Real-time currency exchange rates updated directly from international financial market APIs for seamless cross-border logistics and trade calculations.
            </p>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="py-12 bg-slate-50 font-sans">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-12">
            
            <!-- Currency Converter Section -->
            <div class="rounded-3xl bg-white p-6 lg:p-8 shadow-sm border border-slate-200">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-3 rounded-2xl bg-amber-50 text-amber-600">
                        <Calculator class="size-6" />
                    </div>
                    <div>
                        <h2 class="font-display text-xl font-bold text-slate-900">Currency Converter Calculator</h2>
                        <p class="text-xs text-slate-500">Calculate live values between any global currency and BDT</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                    <!-- Amount -->
                    <div class="lg:col-span-3">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Amount</label>
                        <input
                            v-model.number="calcAmount"
                            type="number"
                            min="0"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-base font-mono font-bold text-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500"
                        />
                    </div>

                    <!-- From Currency -->
                    <div class="lg:col-span-3">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">From Currency</label>
                        <select
                            v-model="calcFromCode"
                            class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-xs font-semibold text-slate-900 focus:border-amber-500"
                        >
                            <option v-for="c in exchangeRates" :key="'from-' + c.id" :value="c.currency_code">
                                {{ c.flag }} {{ c.currency_code }} - {{ c.currency_name }}
                            </option>
                            <option value="BDT">🇧🇩 BDT - Bangladesh Taka</option>
                        </select>
                    </div>

                    <!-- Swap Button -->
                    <div class="lg:col-span-1 flex justify-center pt-4 lg:pt-5">
                        <button
                            @click="swapCurrencies"
                            class="p-3 rounded-full bg-slate-100 hover:bg-amber-500 text-slate-600 hover:text-white transition-all shadow-xs cursor-pointer"
                            title="Swap Currencies"
                        >
                            <ArrowRightLeft class="size-4" />
                        </button>
                    </div>

                    <!-- To Currency -->
                    <div class="lg:col-span-3">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">To Currency</label>
                        <select
                            v-model="calcToCode"
                            class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-xs font-semibold text-slate-900 focus:border-amber-500"
                        >
                            <option value="BDT">🇧🇩 BDT - Bangladesh Taka</option>
                            <option v-for="c in exchangeRates" :key="'to-' + c.id" :value="c.currency_code">
                                {{ c.flag }} {{ c.currency_code }} - {{ c.currency_name }}
                            </option>
                        </select>
                    </div>

                    <!-- Result Card -->
                    <div class="lg:col-span-2 rounded-2xl bg-amber-50 p-4 border border-amber-200 text-center">
                        <span class="text-[10px] uppercase tracking-wider font-bold text-amber-800">Converted Value</span>
                        <div class="font-mono text-xl font-extrabold text-amber-900 mt-0.5">
                            {{ targetSymbol }} {{ convertedResult }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exchange Rates Table & Search -->
            <div class="rounded-3xl bg-white p-6 lg:p-8 shadow-sm border border-slate-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <h2 class="font-display text-xl font-bold text-slate-900">Exchange Rates Directory</h2>
                        <p class="text-xs text-slate-500">Live exchange values relative to Bangladesh Taka (BDT)</p>
                    </div>

                    <div class="relative w-full sm:w-72">
                        <Search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Search currency..."
                            class="w-full rounded-xl border border-slate-200 pl-9 pr-4 py-2 text-xs focus:border-amber-500"
                        />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="bg-slate-50 text-[11px] uppercase tracking-wider font-semibold text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-4 py-3.5">Currency</th>
                                <th class="px-4 py-3.5">Code & Symbol</th>
                                <th class="px-4 py-3.5">Exchange Rate (BDT)</th>
                                <th class="px-4 py-3.5">Trend & Change</th>
                                <th class="px-4 py-3.5">Source Mode</th>
                                <th class="px-4 py-3.5 text-right">Last Updated</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr v-for="currency in filteredRates" :key="currency.id" class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">{{ currency.flag }}</span>
                                        <span class="font-bold text-slate-900 text-sm">{{ currency.currency_name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 font-mono font-semibold text-slate-800">
                                    {{ currency.currency_code }} ({{ currency.symbol }})
                                </td>
                                <td class="px-4 py-4 font-mono text-base font-extrabold text-slate-900">
                                    {{ currency.symbol }}1.00 = {{ currency.exchange_rate.toFixed(4) }} BDT
                                </td>
                                <td class="px-4 py-4">
                                    <div
                                        class="inline-flex items-center gap-1 font-mono text-xs font-semibold px-2.5 py-0.5 rounded-full"
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
                                <td class="px-4 py-4">
                                    <span v-if="currency.is_manual" class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-0.5 text-[10px] font-semibold text-indigo-700">
                                        <Lock class="size-3" /> Manual Override
                                    </span>
                                    <span v-else class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[10px] font-semibold text-emerald-700">
                                        <Zap class="size-3" /> Live API
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-right text-slate-400 font-mono text-[11px]">
                                    {{ currency.last_updated_at ? new Date(currency.last_updated_at).toLocaleString() : 'Live' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Notes & FAQ -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="rounded-3xl bg-white p-6 border border-slate-200">
                    <div class="flex items-center gap-2 text-slate-900 font-bold text-base mb-2">
                        <ShieldCheck class="size-5 text-amber-500" />
                        <span>Exchange Rate Disclaimer</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Exchange rates displayed on this platform are updated automatically via international market data feeds and are intended for reference and logistics calculation purposes.
                    </p>
                </div>

                <div class="rounded-3xl bg-white p-6 border border-slate-200">
                    <div class="flex items-center gap-2 text-slate-900 font-bold text-base mb-2">
                        <HelpCircle class="size-5 text-amber-500" />
                        <span>Automated Rate Updates</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Rates are automatically synchronized periodically. Administrators maintain manual override controls for specific institutional trade arrangements.
                    </p>
                </div>
            </div>

        </div>
    </div>
</template>
