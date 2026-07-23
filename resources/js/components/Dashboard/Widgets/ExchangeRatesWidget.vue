<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { DollarSign, ArrowUpRight, ArrowDownRight, RefreshCw, ArrowRight, Minus } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps<{
    data?: any;
}>();

const provider = computed(() => props.data?.provider ?? 'FRANKFURTER');
const rates = computed(() => props.data?.rates ?? [
    { currency_code: 'USD', exchange_rate: 120.5, trend: 'up' },
    { currency_code: 'EUR', exchange_rate: 131.2, trend: 'down' },
    { currency_code: 'GBP', exchange_rate: 155.8, trend: 'up' },
    { currency_code: 'SAR', exchange_rate: 32.1, trend: 'same' },
]);
</script>

<template>
    <div class="space-y-3">
        <div class="flex items-center justify-between text-xs">
            <span class="font-mono text-slate-500 uppercase">Provider: <strong class="text-slate-800 dark:text-slate-200">{{ provider }}</strong></span>
            <Link href="/admin/exchange-rates" class="font-semibold text-amber-600 hover:underline flex items-center gap-1">
                Rates Matrix
                <ArrowRight class="size-3" />
            </Link>
        </div>

        <div class="grid grid-cols-2 gap-2">
            <div
                v-for="r in rates.slice(0, 4)"
                :key="r.currency_code"
                class="flex items-center justify-between p-2 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-xs"
            >
                <span class="font-bold text-slate-900 dark:text-white font-mono">{{ r.currency_code }}</span>
                <div class="flex items-center gap-1 font-mono">
                    <span class="text-slate-700 dark:text-slate-300 font-bold">{{ r.exchange_rate ?? r.rate }}</span>
                    <ArrowUpRight v-if="r.trend === 'up'" class="size-3 text-emerald-500" />
                    <ArrowDownRight v-else-if="r.trend === 'down'" class="size-3 text-rose-500" />
                    <Minus v-else class="size-3 text-slate-400" />
                </div>
            </div>
        </div>
    </div>
</template>
