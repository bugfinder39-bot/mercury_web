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
        class="sticky top-0 z-50 w-full bg-base-100 transition-all duration-300"
        :class="isScrolled ? 'border-b border-base-300 py-3' : 'border-b border-transparent py-4'"
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
                    <div v-else class="font-display font-bold text-xl tracking-wide text-base-content flex items-center gap-2">
                        <span>MERCURY</span>
                        <span class="text-xs font-mono text-base-content/70 border-l border-base-300 pl-2 tracking-widest">BANGLADESH</span>
                    </div>
                </Link>
            </div>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-8">
                <ul class="flex items-center gap-8 font-body font-medium text-base-content/70">
                    <li v-for="link in navLinks" :key="link.name">
                        <Link 
                            :href="link.href" 
                            class="relative py-2 text-sm transition-colors duration-150 hover:text-amber tracking-wide"
                            :class="isActive(link.href) ? 'text-base-content font-semibold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[1.5px] after:bg-amber' : 'text-base-content/70 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[1.5px] after:bg-amber hover:after:w-full after:transition-all after:duration-150'"
                        >
                            {{ link.name }}
                        </Link>
                    </li>
                </ul>
            </nav>

            <!-- Desktop CTA Button -->
            <div class="hidden lg:block">
                <Link 
                    href="/contact" 
                    class="btn btn-sm bg-amber hover:bg-amber-dark text-white font-body font-medium text-sm rounded-lg border-none transition-colors duration-150 px-5 py-2.5 h-auto min-h-0"
                >
                    Get a Quote
                </Link>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button 
                @click="mobileMenuOpen = true"
                class="lg:hidden p-2 text-base-content hover:text-amber focus:outline-none transition-colors duration-150"
                aria-label="Open navigation menu"
            >
                <Menu class="size-6" />
            </button>
        </div>

        <!-- Mobile Drawer Menu (Lofi clean background slide-in) -->
        <div v-if="mobileMenuOpen" class="fixed inset-0 z-50 lg:hidden flex">
            <!-- Overlay shadow -->
            <div 
                class="fixed inset-0 bg-neutral-900/30 backdrop-blur-xs transition-opacity duration-300"
                @click="mobileMenuOpen = false"
            ></div>

            <!-- Drawer body -->
            <div class="relative ml-auto w-full max-w-[280px] bg-base-100 border-l border-base-300 h-full shadow-xl flex flex-col p-6 z-10 animate-in slide-in-from-right duration-250">
                <!-- Close Button -->
                <div class="flex items-center justify-between border-b border-base-300 pb-4">
                    <span class="text-base-content font-mono text-xs tracking-widest font-semibold uppercase">NAVIGATION</span>
                    <button 
                        @click="mobileMenuOpen = false"
                        class="p-2 text-base-content/60 hover:text-base-content focus:outline-none"
                        aria-label="Close navigation menu"
                    >
                        <X class="size-6" />
                    </button>
                </div>

                <!-- Links list -->
                <nav class="mt-8 flex-grow">
                    <ul class="flex flex-col gap-6 font-body font-medium text-lg text-base-content/80">
                        <li v-for="link in navLinks" :key="link.name">
                            <Link 
                                :href="link.href" 
                                @click="mobileMenuOpen = false"
                                class="flex items-center justify-between py-2 transition-colors duration-150"
                                :class="isActive(link.href) ? 'text-amber font-semibold border-b border-base-300' : 'hover:text-base-content border-b border-transparent'"
                            >
                                <span>{{ link.name }}</span>
                                <ArrowRight v-if="isActive(link.href)" class="size-4" />
                            </Link>
                        </li>
                    </ul>
                </nav>

                <!-- Mobile CTA Button -->
                <div class="border-t border-base-300 pt-6">
                    <Link 
                        href="/contact" 
                        @click="mobileMenuOpen = false"
                        class="w-full btn bg-amber hover:bg-amber-dark text-white font-body font-medium text-base rounded-lg border-none transition-colors duration-150 py-3 h-auto min-h-0"
                    >
                        Get a Quote
                    </Link>
                </div>
            </div>
        </div>
    </header>
</template>
