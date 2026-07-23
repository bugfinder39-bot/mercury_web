<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
    TrendingUp,
    ArrowUpRight,
    ArrowDownRight,
    Minus,
    RefreshCw,
    Calculator,
    ArrowRightLeft,
    ShieldCheck,
    Globe,
    Zap,
    Lock
} from '@lucide/vue';

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
    section?: {
        heading?: string;
        subheading?: string;
        body?: string;
        is_active?: boolean;
    };
    exchangeRates: CurrencyItem[];
    bgStyle?: string;
}>();

// Converter State
const calcAmount = ref<number>(100);
const calcFromCode = ref<string>('USD');
const calcToCode = ref<string>('BDT');

// Base BDT rate map for fast calculation
const convertedResult = computed(() => {
    if (!calcAmount.value || calcAmount.value <= 0) return '0.00';

    const fromCurr = props.exchangeRates.find(c => c.currency_code === calcFromCode.value);
    const toCurr = props.exchangeRates.find(c => c.currency_code === calcToCode.value);

    // Rate in BDT for 1 unit of fromCurr
    let fromBdtRate = 1.0;
    if (calcFromCode.value !== 'BDT') {
        fromBdtRate = fromCurr ? fromCurr.exchange_rate : 120.50;
    }

    // Rate in BDT for 1 unit of toCurr
    let toBdtRate = 1.0;
    if (calcToCode.value !== 'BDT') {
        toBdtRate = toCurr ? toCurr.exchange_rate : 1.0;
    }

    // Calculate conversion: Amount * (fromBdtRate / toBdtRate)
    const result = calcAmount.value * (fromBdtRate / toBdtRate);
    return result.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 4 });
});

const swapCurrencies = () => {
    const temp = calcFromCode.value;
    calcFromCode.value = calcToCode.value;
    calcToCode.value = temp;
};

// Target symbol for converted amount
const targetSymbol = computed(() => {
    if (calcToCode.value === 'BDT') return '৳';
    const c = props.exchangeRates.find(item => item.currency_code === calcToCode.value);
    return c ? c.symbol : '';
});

// Format Last Updated
const lastUpdatedTime = computed(() => {
    if (props.exchangeRates.length === 0) return null;
    const latest = props.exchangeRates.find(c => c.last_updated_at);
    if (!latest || !latest.last_updated_at) return 'Just now';
    return new Date(latest.last_updated_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
});
</script>

<template>
    <section
        class="relative overflow-hidden py-20 lg:py-28 font-sans"
        style="background-color: #0b2540;"
    >
        <!-- Subtle Ambient Background Glows -->
        <div class="pointer-events-none absolute -top-40 -left-40 size-96 rounded-full bg-amber-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 -right-40 size-96 rounded-full bg-blue-500/10 blur-3xl"></div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header Section -->
            <div class="flex flex-col items-center text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 rounded-full px-3.5 py-1 text-xs font-semibold tracking-wide uppercase" style="background-color: rgba(232, 119, 12, 0.15); color: #E8770C; border: 1px solid rgba(232, 119, 12, 0.3);">
                    <TrendingUp class="size-3.5" />
                    <span>{{ section?.subheading || 'REAL-TIME CURRENCY MARKET DATA' }}</span>
                </div>

                <h2 class="mt-4 font-display text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    {{ section?.heading || 'Live Global Exchange Rates' }}
                </h2>

                <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed max-w-2xl">
                    {{ section?.body || 'Stay informed with real-time currency exchange rates updated directly from international financial market APIs.' }}
                </p>

                <div v-if="lastUpdatedTime" class="mt-4 flex items-center gap-2 font-mono text-xs text-slate-400">
                    <span class="inline-block size-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Live Market Feed • Updated at {{ lastUpdatedTime }}</span>
                </div>
            </div>

            <!-- Main Interactive Content Grid (Rates Cards + Currency Converter) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Rates Cards Grid (8 Cols on Desktop) -->
                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div
                        v-for="currency in exchangeRates"
                        :key="currency.id"
                        class="group relative rounded-2xl p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                        style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(12px);"
                    >
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl filter drop-shadow-sm">{{ currency.flag }}</span>
                                <div>
                                    <h3 class="font-display font-bold text-lg text-white leading-none">
                                        {{ currency.currency_code }}
                                    </h3>
                                    <p class="text-xs text-slate-400 mt-1 truncate max-w-[110px]">
                                        {{ currency.currency_name }}
                                    </p>
                                </div>
                            </div>

                            <!-- Trend Badge -->
                            <div
                                class="inline-flex items-center gap-1 font-mono text-xs font-semibold px-2 py-0.5 rounded-full"
                                :class="{
                                    'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30': currency.trend === 'up',
                                    'bg-rose-500/20 text-rose-400 border border-rose-500/30': currency.trend === 'down',
                                    'bg-slate-500/20 text-slate-400 border border-slate-500/30': currency.trend === 'same'
                                }"
                            >
                                <ArrowUpRight v-if="currency.trend === 'up'" class="size-3.5" />
                                <ArrowDownRight v-else-if="currency.trend === 'down'" class="size-3.5" />
                                <Minus v-else class="size-3.5" />
                                <span>{{ currency.change_percentage > 0 ? '+' : '' }}{{ currency.change_percentage }}%</span>
                            </div>
                        </div>

                        <!-- Exchange Rate Value -->
                        <div class="pt-2 border-t border-white/10 flex items-baseline justify-between">
                            <div class="font-mono text-xl font-extrabold text-white tracking-tight">
                                {{ currency.symbol }}1 = <span style="color: #E8770C;">{{ currency.exchange_rate.toFixed(2) }}</span> <span class="text-xs text-slate-400 font-sans font-normal">BDT</span>
                            </div>

                            <!-- Live / Manual Tag -->
                            <span v-if="currency.is_manual" class="inline-flex items-center gap-1 text-[10px] font-medium text-indigo-300" title="Custom Override Rate">
                                <Lock class="size-2.5" /> Manual
                            </span>
                            <span v-else class="inline-flex items-center gap-1 text-[10px] font-medium text-emerald-400" title="Live Market Feed">
                                <Zap class="size-2.5" /> Live
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Currency Converter Tool Widget (4 Cols on Desktop) -->
                <div class="lg:col-span-4 rounded-3xl p-6 relative overflow-hidden" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.15); backdrop-filter: blur(16px);">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="p-2 rounded-xl" style="background-color: rgba(232, 119, 12, 0.2); color: #E8770C;">
                            <Calculator class="size-5" />
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-lg text-white">Instant Converter</h3>
                            <p class="text-xs text-slate-400">Calculate live market values instantly</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Amount Input -->
                        <div>
                            <label class="block text-xs font-medium text-slate-300 mb-1.5">Amount</label>
                            <input
                                v-model.number="calcAmount"
                                type="number"
                                min="0"
                                class="w-full rounded-xl border border-white/10 bg-black/20 px-4 py-3 text-base font-mono font-bold text-white placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500"
                            />
                        </div>

                        <!-- From & To Selector -->
                        <div class="grid grid-cols-5 gap-2 items-center">
                            <div class="col-span-2">
                                <label class="block text-xs font-medium text-slate-300 mb-1.5">From</label>
                                <select
                                    v-model="calcFromCode"
                                    class="w-full rounded-xl border border-white/10 bg-slate-900 px-3 py-2.5 text-xs font-semibold text-white focus:border-amber-500 focus:outline-none"
                                >
                                    <option v-for="c in exchangeRates" :key="'from-' + c.id" :value="c.currency_code">
                                        {{ c.flag }} {{ c.currency_code }}
                                    </option>
                                    <option value="BDT">🇧🇩 BDT</option>
                                </select>
                            </div>

                            <!-- Swap Button -->
                            <div class="col-span-1 flex justify-center pt-5">
                                <button
                                    @click="swapCurrencies"
                                    class="p-2.5 rounded-full bg-white/10 hover:bg-amber-500 text-white hover:text-slate-900 transition-all cursor-pointer"
                                    title="Swap Currencies"
                                >
                                    <ArrowRightLeft class="size-4" />
                                </button>
                            </div>

                            <div class="col-span-2">
                                <label class="block text-xs font-medium text-slate-300 mb-1.5">To</label>
                                <select
                                    v-model="calcToCode"
                                    class="w-full rounded-xl border border-white/10 bg-slate-900 px-3 py-2.5 text-xs font-semibold text-white focus:border-amber-500 focus:outline-none"
                                >
                                    <option value="BDT">🇧🇩 BDT</option>
                                    <option v-for="c in exchangeRates" :key="'to-' + c.id" :value="c.currency_code">
                                        {{ c.flag }} {{ c.currency_code }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Conversion Result Display -->
                        <div class="mt-6 rounded-2xl p-4 text-center border border-amber-500/30" style="background: rgba(232, 119, 12, 0.1);">
                            <p class="text-xs text-amber-200 font-medium uppercase tracking-wider">Converted Value</p>
                            <p class="mt-1 font-mono text-2xl font-black text-white">
                                {{ targetSymbol }} {{ convertedResult }}
                                <span class="text-sm font-sans text-amber-400 font-bold ml-1">{{ calcToCode }}</span>
                            </p>
                            <p class="mt-1 text-[10px] text-slate-400">
                                1 {{ calcFromCode }} = {{ (convertedResult ? (parseFloat(convertedResult.replace(/,/g, '')) / calcAmount).toFixed(4) : '0') }} {{ calcToCode }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer CTA Link to Dedicated Rates Page -->
            <div class="mt-12 text-center">
                <Link
                    href="/exchange-rates"
                    class="inline-flex items-center gap-2 rounded-xl px-6 py-3 text-xs font-bold text-white transition-all shadow-lg hover:shadow-amber-500/20 hover:scale-105"
                    style="background-color: #E8770C"
                >
                    <span>View Dedicated Exchange Rates Page</span>
                    <Globe class="size-4" />
                </Link>
            </div>
        </div>
    </section>
</template>
