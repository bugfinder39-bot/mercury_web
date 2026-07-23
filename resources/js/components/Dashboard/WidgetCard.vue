<script setup lang="ts">
import { computed } from 'vue';
import {
    GripVertical,
    RefreshCw,
    Settings,
    EyeOff,
    Maximize2,
    Minimize2,
} from '@lucide/vue';

const props = withDefaults(
    defineProps<{
        id?: number;
        widgetKey: string;
        title: string;
        subtitle?: string | null;
        icon?: string | null;
        bgStyle?: string;
        size?: string;
        refreshInterval?: number;
        isEditing?: boolean;
        isRefreshing?: boolean;
        lastUpdated?: string | null;
        animation?: string;
    }>(),
    {
        bgStyle: 'default',
        size: 'medium',
        refreshInterval: 0,
        isEditing: false,
        isRefreshing: false,
        animation: 'fade',
    }
);

const emit = defineEmits<{
    (e: 'refresh'): void;
    (e: 'edit'): void;
    (e: 'toggleHide'): void;
    (e: 'changeSize', newSize: string): void;
}>();

const gridClasses = computed(() => {
    switch (props.size) {
        case 'small':
            return 'col-span-12 md:col-span-6 xl:col-span-3';
        case 'medium':
            return 'col-span-12 md:col-span-6 xl:col-span-4';
        case 'large':
            return 'col-span-12 xl:col-span-6';
        case 'full':
            return 'col-span-12';
        default:
            return 'col-span-12 md:col-span-6 xl:col-span-4';
    }
});

const containerStyle = computed(() => {
    switch (props.bgStyle) {
        case 'glass':
            return 'background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 8px 32px rgba(11, 37, 64, 0.05);';
        case 'gradient':
            return 'background: linear-gradient(135deg, #0B2540 0%, #163A5E 100%); color: #FFFFFF; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 10px 25px rgba(11, 37, 64, 0.15);';
        case 'dark':
            return 'background-color: #0F172A; color: #F8FAFC; border: 1px solid #1E293B; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);';
        case 'card':
            return 'background-color: #FFFFFF; border: 1px solid rgba(232, 119, 12, 0.25); box-shadow: 0 4px 14px rgba(232, 119, 12, 0.06);';
        case 'default':
        default:
            return 'background-color: #FFFFFF; border: 1px solid rgba(11, 37, 64, 0.08); box-shadow: 0 2px 8px rgba(11, 37, 64, 0.04);';
    }
});

const isDarkTheme = computed(() => ['dark', 'gradient'].includes(props.bgStyle));
</script>

<template>
    <div
        class="group relative flex flex-col justify-between rounded-2xl p-5 transition-all duration-300"
        :class="[
            gridClasses,
            animation === 'pulse' ? 'hover:scale-[1.01]' : '',
            isEditing ? 'ring-2 ring-amber-500/50 border-amber-500/80' : ''
        ]"
        :style="containerStyle"
    >
        <!-- Top Card Header -->
        <div class="flex items-center justify-between gap-3 pb-3 mb-3" :style="{ borderBottom: isDarkTheme ? '1px solid rgba(255, 255, 255, 0.1)' : '1px solid rgba(11, 37, 64, 0.06)' }">
            <div class="flex items-center gap-2.5 min-w-0">
                <!-- Drag Handle in edit mode -->
                <button
                    v-if="isEditing"
                    class="drag-handle cursor-grab active:cursor-grabbing p-1 rounded hover:bg-black/10 transition-colors"
                    title="Drag to reorder"
                >
                    <GripVertical class="size-4 opacity-60" />
                </button>

                <!-- Icon -->
                <div
                    class="flex size-8 shrink-0 items-center justify-center rounded-lg font-bold"
                    :style="isDarkTheme ? 'background-color: rgba(232, 119, 12, 0.2); color: #E8770C;' : 'background-color: rgba(232, 119, 12, 0.1); color: #E8770C;'"
                >
                    <slot name="icon">
                        <span class="text-xs font-mono">W</span>
                    </slot>
                </div>

                <!-- Title & Subtitle -->
                <div class="min-w-0">
                    <h3 class="font-display text-sm font-bold truncate leading-snug" :class="isDarkTheme ? 'text-white' : 'text-slate-900'">
                        {{ title }}
                    </h3>
                    <p v-if="subtitle" class="truncate text-[11px]" :class="isDarkTheme ? 'text-slate-300' : 'text-slate-500'">
                        {{ subtitle }}
                    </p>
                </div>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-1 shrink-0">
                <!-- Refresh Indicator / Action -->
                <button
                    @click="emit('refresh')"
                    class="rounded-lg p-1.5 transition-colors hover:bg-black/5 dark:hover:bg-white/10 text-slate-400 hover:text-slate-700 dark:hover:text-white"
                    :class="{ 'animate-spin text-amber-500': isRefreshing }"
                    title="Refresh data"
                >
                    <RefreshCw class="size-3.5" />
                </button>

                <!-- Customization buttons when editing -->
                <template v-if="isEditing">
                    <!-- Size toggle -->
                    <button
                        @click="emit('changeSize', size === 'small' ? 'medium' : size === 'medium' ? 'large' : size === 'large' ? 'full' : 'small')"
                        class="rounded-lg p-1.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-colors"
                        title="Resize widget"
                    >
                        <Maximize2 v-if="size !== 'full'" class="size-3.5" />
                        <Minimize2 v-else class="size-3.5" />
                    </button>

                    <!-- Settings modal trigger -->
                    <button
                        @click="emit('edit')"
                        class="rounded-lg p-1.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-colors"
                        title="Widget settings"
                    >
                        <Settings class="size-3.5" />
                    </button>

                    <!-- Hide / Disable -->
                    <button
                        @click="emit('toggleHide')"
                        class="rounded-lg p-1.5 text-rose-400 hover:text-rose-600 hover:bg-rose-50 transition-colors"
                        title="Hide widget"
                    >
                        <EyeOff class="size-3.5" />
                    </button>
                </template>
            </div>
        </div>

        <!-- Main Content Slot -->
        <div class="flex-1">
            <slot />
        </div>

        <!-- Footer interval note -->
        <div v-if="refreshInterval > 0 && !isEditing" class="mt-3 pt-2 text-[10px] text-right font-mono opacity-50">
            Auto-refreshes every {{ refreshInterval }}s
        </div>
    </div>
</template>
