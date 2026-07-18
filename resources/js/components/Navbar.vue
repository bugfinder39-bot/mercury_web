<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { Menu, X, ArrowRight } from '@lucide/vue';
import { ref, computed, onMounted, onUnmounted } from 'vue';

const page = usePage();
const currentUrl = computed(() => page.url);
const settings = computed(() => (page.props.settings as Record<string, any>) || {});

const mobileMenuOpen = ref(false);
const isScrolled = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 20;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

const navLinks = [
    { name: 'Home', href: '/' },
    { name: 'About', href: '/about' },
    { name: 'Services', href: '/services' },
    { name: 'Contact', href: '/contact' },
];

const isActive = (href: string) => {
    if (href === '/') {
        return currentUrl.value === '/';
    }

    return currentUrl.value.startsWith(href);
};
</script>

<template>
    <header
        class="sticky top-0 z-50 w-full transition-all duration-300"
        :class="isScrolled ? 'shadow-navbar py-3' : 'py-4'"
        style="background-color: #ffffff;"
    >
        <div class="max-w-7xl mx-auto px-4 lg:px-6 flex items-center justify-between">
            <!-- Logo Section -->
            <div class="flex-shrink-0">
                <Link href="/" class="flex items-center gap-3">
                    <img
                        v-if="settings.company_logo"
                        :src="settings.company_logo"
                        :alt="settings.company_name || 'Mercury Logo'"
                        class="h-10 w-auto"
                    />
                    <div v-else class="flex items-center gap-2">
                        <span class="font-display font-bold text-xl tracking-wide text-white">MERCURY</span>
                        <span
                            class="text-xs font-mono border-l pl-2 tracking-widest"
                            style="color: #E8770C; border-color: rgba(255,255,255,0.2);"
                        >BANGLADESH</span>
                    </div>
                </Link>
            </div>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-8">
                <ul class="flex items-center gap-8 font-body font-medium">
                    <li v-for="link in navLinks" :key="link.name">
                        <Link
                            :href="link.href"
                            class="relative py-2 text-sm tracking-wide transition-colors duration-150"
                            :class="isActive(link.href)
                                ? 'font-semibold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:rounded-full'
                                : 'hover:text-white after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:rounded-full hover:after:w-full after:transition-all after:duration-200'"
                            :style="isActive(link.href)
                                ? 'color: #E8770C; --tw-after-bg: #E8770C;'
                                : 'color: rgba(0,0,0,0.80);'"
                        >
                            {{ link.name }}
                        </Link>
                    </li>
                </ul>
            </nav>

            <!-- Desktop CTA Button -->
            <div class="hidden lg:block">
                <Link href="/contact" class="btn-primary text-sm">
                    Get a Quote
                </Link>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button
                @click="mobileMenuOpen = true"
                class="lg:hidden p-2 rounded-lg focus:outline-none transition-colors duration-150"
                style="color: rgba(255,255,255,0.85);"
                aria-label="Open navigation menu"
            >
                <Menu class="size-6" />
            </button>
        </div>

        <!-- Mobile Drawer -->
        <div v-if="mobileMenuOpen" class="fixed inset-0 z-50 lg:hidden flex">
            <!-- Overlay -->
            <div
                class="fixed inset-0 backdrop-blur-sm transition-opacity duration-300"
                style="background-color: rgba(11, 37, 64, 0.5);"
                @click="mobileMenuOpen = false"
            ></div>

            <!-- Drawer body -->
            <div
                class="relative ml-auto w-full max-w-[300px] h-full flex flex-col p-6 z-10 animate-in slide-in-from-right duration-250"
                style="background-color: #0B2540; border-left: 1px solid rgba(255,255,255,0.10);"
            >
                <!-- Close Button -->
                <div class="flex items-center justify-between pb-5" style="border-bottom: 1px solid rgba(255,255,255,0.10);">
                    <span class="font-mono text-xs tracking-widest font-semibold uppercase" style="color: rgba(255,255,255,0.50);">NAVIGATION</span>
                    <button
                        @click="mobileMenuOpen = false"
                        class="p-2 rounded-lg focus:outline-none transition-colors"
                        style="color: rgba(255,255,255,0.60);"
                        aria-label="Close navigation menu"
                    >
                        <X class="size-5" />
                    </button>
                </div>

                <!-- Links list -->
                <nav class="mt-8 flex-grow">
                    <ul class="flex flex-col gap-2 font-body font-medium text-base">
                        <li v-for="link in navLinks" :key="link.name">
                            <Link
                                :href="link.href"
                                @click="mobileMenuOpen = false"
                                class="flex items-center justify-between px-4 py-3 rounded-lg transition-colors duration-150"
                                :style="isActive(link.href)
                                    ? 'background-color: rgba(232,119,12,0.15); color: #E8770C;'
                                    : 'color: rgba(255,255,255,0.80);'"
                            >
                                <span>{{ link.name }}</span>
                                <ArrowRight v-if="isActive(link.href)" class="size-4" style="color: #E8770C;" />
                            </Link>
                        </li>
                    </ul>
                </nav>

                <!-- Mobile CTA Button -->
                <div class="pt-6" style="border-top: 1px solid rgba(255,255,255,0.10);">
                    <Link
                        href="/contact"
                        @click="mobileMenuOpen = false"
                        class="btn-primary w-full justify-center"
                    >
                        Get a Quote
                    </Link>
                </div>
            </div>
        </div>
    </header>
</template>
