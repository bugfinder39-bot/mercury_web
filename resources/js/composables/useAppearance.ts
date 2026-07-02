import type { ComputedRef, Ref } from 'vue';
import { computed, onMounted, ref } from 'vue';
import type { Appearance, ResolvedAppearance } from '@/types';

export type { Appearance, ResolvedAppearance };

export type UseAppearanceReturn = {
    appearance: Ref<Appearance>;
    resolvedAppearance: ComputedRef<ResolvedAppearance>;
    updateAppearance: (value: Appearance) => void;
};

// eslint-disable-next-line @typescript-eslint/no-unused-vars
export function updateTheme(_value: Appearance): void {
    if (typeof window === 'undefined') {
        return;
    }

    document.documentElement.classList.remove('dark');
}

export function initializeTheme(): void {
    if (typeof window === 'undefined') {
        return;
    }

    updateTheme('light');
}

const appearance = ref<Appearance>('light');

export function useAppearance(): UseAppearanceReturn {
    onMounted(() => {
        appearance.value = 'light';
    });

    const resolvedAppearance = computed<ResolvedAppearance>(() => {
        return 'light';
    });

    // eslint-disable-next-line @typescript-eslint/no-unused-vars
    function updateAppearance(_value: Appearance) {
        appearance.value = 'light';
        updateTheme('light');
    }

    return {
        appearance,
        resolvedAppearance,
        updateAppearance,
    };
}
