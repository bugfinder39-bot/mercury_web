<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';

const page = usePage();
const currentUrl = computed(() => page.url || '');
const settings = computed(() => (page.props.settings as Record<string, any>) || {});

const isComingSoonPage = computed(() => {
    return currentUrl.value.startsWith('/coming-soon') || page.component === 'ComingSoon';
});

const showNavbar = computed(() => {
    if (!isComingSoonPage.value) {
        return true;
    }
    const settingVal = settings.value.show_navbar ?? settings.value.coming_soon_show_navbar;
    return String(settingVal) === 'true' || settingVal === true || settingVal === 1;
});

const showFooter = computed(() => {
    if (!isComingSoonPage.value) {
        return true;
    }
    const settingVal = settings.value.show_footer ?? settings.value.coming_soon_show_footer;
    return String(settingVal) === 'true' || settingVal === true || settingVal === 1;
});
</script>

<template>
    <div
        class="flex min-h-screen flex-col font-sans antialiased"
        style="background-color: #f8fafc"
    >
        <!-- Navigation Header -->
        <Navbar v-if="showNavbar" />

        <!-- Main Content Area -->
        <main id="main-content" class="flex-grow" role="main">
            <slot />
        </main>

        <!-- Footer -->
        <Footer v-if="showFooter" />
    </div>
</template>

