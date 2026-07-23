<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';
import AnnouncementTopBar from '@/components/Announcements/AnnouncementTopBar.vue';
import AnnouncementModal from '@/components/Announcements/AnnouncementModal.vue';

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

const isStickyNavbar = computed(() => {
    return settings.value.navbar_sticky !== 'false';
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
        <!-- Global Header Architecture (Announcement Top Bar + Navbar) -->
        <header
            class="top-0 left-0 w-full z-50 transition-all duration-300 flex flex-col"
            :class="[isStickyNavbar ? 'fixed' : 'relative']"
        >
            <!-- Announcement System Top Bar -->
            <AnnouncementTopBar />

            <!-- Navigation Header -->
            <Navbar v-if="showNavbar" />
        </header>

        <!-- Announcement System Popup Modal -->
        <AnnouncementModal />

        <!-- Main Content Area -->
        <main id="main-content" class="flex-grow" role="main">
            <slot />
        </main>

        <!-- Footer -->
        <Footer v-if="showFooter" />
    </div>
</template>

