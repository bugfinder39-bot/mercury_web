<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { Menu, X, ArrowRight, User, LayoutDashboard } from '@lucide/vue';
import { ref, computed, onMounted, onUnmounted } from 'vue';

const page = usePage();
const currentUrl = computed(() => page.url);
const settings = computed(() => (page.props.settings as Record<string, any>) || {});
const user = computed(() => (page.props as any).auth?.user);

const showLoginButton = computed(() => {
    const navLogin = settings.value.navbar_login_button;
    const showLogin = settings.value.show_login_button;

    if (navLogin !== undefined && navLogin !== null) {
        return String(navLogin) !== 'false';
    }
    if (showLogin !== undefined && showLogin !== null) {
        return String(showLogin) !== 'false';
    }
    return true;
});

const loginButtonData = computed(() => {
    if (user.value) {
        return {
            text: 'Dashboard',
            href: '/admin/dashboard',
            icon: LayoutDashboard,
        };
    }
    return {
        text: 'Login',
        href: '/login',
        icon: User,
    };
});

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

const parsedNavbarLinks = computed(() => {
    try {
        const val = settings.value.navbar_links;

        if (!val) {
return [];
}

        const links = typeof val === 'string' ? JSON.parse(val) : val;

        return Array.isArray(links) ? links : [];
    } catch {
        return [];
    }
});

const isActive = (href: string) => {
    if (href === '/') {
        return currentUrl.value === '/';
    }

    return currentUrl.value.startsWith(href);
};

// Colors/Styles Helpers
const hexToRgb = (hex: string) => {
    if (!hex || typeof hex !== 'string') {
return '255, 255, 255';
}

    let cleanHex = hex.replace('#', '');

    if (cleanHex.length === 3) {
        cleanHex = cleanHex.split('').map(char => char + char).join('');
    }

    const num = parseInt(cleanHex, 16);

    if (isNaN(num)) {
return '255, 255, 255';
}

    return `${(num >> 16) & 255}, ${(num >> 8) & 255}, ${num & 255}`;
};

const formatColor = (color: string, fallback: string) => {
    return color || fallback;
};

// Computed style variables
const headerStyle = computed(() => {
    const isSticky = settings.value.navbar_sticky !== 'false';
    const isGlass = settings.value.navbar_style === 'glassmorphism';
    const isSolid = settings.value.navbar_style === 'solid';
    const hasBorder = settings.value.navbar_border_bottom !== 'false';
    const hasBlur = settings.value.navbar_blur !== 'false';
    const hasShadow = settings.value.navbar_shadow !== 'false';

    const bgVal = formatColor(settings.value.navbar_bg, '#FFFFFF');
    const opacityVal = settings.value.navbar_glass_opacity ?? 0.9;
    const blurVal = settings.value.navbar_glass_blur || '12px';
    const shadowVal = settings.value.navbar_shadow_strength || 'rgba(11, 37, 64, 0.05)';
    const borderVal = settings.value.navbar_border_color || 'rgba(226, 232, 240, 0.5)';
    const textVal = formatColor(settings.value.navbar_text, '#0B2540');

    const styles: Record<string, string> = {
        '--navbar-height': settings.value.navbar_height || '72px',
        '--navbar-font-weight': settings.value.navbar_font_weight || '500',
        '--navbar-text-color': textVal,
        '--navbar-hover-color': formatColor(settings.value.navbar_hover, '#E8770C'),
        '--navbar-active-color': formatColor(settings.value.navbar_active, '#E8770C'),
        '--navbar-cta-bg': formatColor(settings.value.navbar_cta_bg, '#E8770C'),
        '--navbar-cta-text-color': formatColor(settings.value.navbar_cta_text_color, '#FFFFFF'),
        '--navbar-cta-hover-bg': formatColor(settings.value.navbar_cta_hover_bg, '#CC6608'),
        '--navbar-cta-hover-text-color': formatColor(settings.value.navbar_cta_hover_text, '#FFFFFF'),
        'position': 'relative',
    };

    if (isScrolled.value) {
        styles['background-color'] = isGlass 
            ? `rgba(${hexToRgb(bgVal)}, ${opacityVal})` 
            : bgVal;
        styles['border-color'] = hasBorder ? borderVal : 'transparent';
        styles['box-shadow'] = hasShadow ? `0 4px 14px ${shadowVal}` : 'none';
        styles['backdrop-filter'] = hasBlur && isGlass ? `blur(${blurVal})` : 'none';
        styles['color'] = textVal;
    } else {
        styles['background-color'] = isSolid ? bgVal : 'transparent';
        styles['border-color'] = hasBorder && isSolid ? borderVal : 'transparent';
        styles['box-shadow'] = 'none';
        styles['backdrop-filter'] = 'none';
        styles['color'] = isSolid ? textVal : '#FFFFFF';
    }

    return styles;
});
</script>

<template>
    <nav
        class="w-full transition-all duration-300 border-b flex items-center relative"
        :style="headerStyle"
    >
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-6 flex items-center justify-between" :style="{ height: settings.navbar_height || '72px' }">
            <!-- Logo Section -->
            <div class="flex-shrink-0">
                <Link href="/" class="flex items-center gap-3">
                    <img
                        v-if="settings.navbar_logo"
                        :src="settings.navbar_logo"
                        :alt="settings.navbar_website_name || 'Mercury Logo'"
                        class="h-10 w-auto"
                    />
                    <div v-else class="flex items-center gap-2">
                        <span
                            class="font-display font-bold text-xl tracking-wide transition-colors duration-300"
                            :style="{ color: isScrolled ? headerStyle['--navbar-text-color'] : (settings.navbar_style === 'solid' ? headerStyle['--navbar-text-color'] : '#FFFFFF') }"
                        >{{ settings.navbar_website_name || 'MERCURY' }}</span>
                        <span
                            class="text-[10px] font-mono border-l pl-2 tracking-widest transition-colors duration-300"
                            :style="{
                                color: '#E8770C',
                                borderColor: isScrolled ? 'rgba(11,37,64,0.2)' : 'rgba(255,255,255,0.2)'
                            }"
                        >{{ settings.navbar_website_tagline || 'BANGLADESH' }}</span>
                    </div>
                </Link>
            </div>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-8">
                <ul class="flex items-center gap-8 font-body" :style="{ fontWeight: headerStyle['--navbar-font-weight'] }">
                    <li v-for="link in parsedNavbarLinks.filter((l: any) => l.is_active)" :key="link.name">
                        <Link
                            :href="link.href"
                            :target="link.target_blank ? '_blank' : undefined"
                            class="relative py-2 text-sm tracking-wide transition-colors duration-250 after:absolute after:bottom-0 after:left-0 after:h-[2px] after:rounded-full after:transition-all after:duration-300 after:bg-[var(--navbar-active-color,#E8770C)]"
                            :style="{
                                color: isActive(link.href) 
                                    ? headerStyle['--navbar-active-color'] 
                                    : (isScrolled ? headerStyle['--navbar-text-color'] : (settings.navbar_style === 'solid' ? headerStyle['--navbar-text-color'] : 'rgba(255,255,255,0.90)')),
                            }"
                            :class="[
                                isActive(link.href)
                                    ? 'font-semibold after:w-full'
                                    : 'after:w-0 hover:after:w-full',
                            ]"
                            @mouseover="(e: any) => { if(!isActive(link.href)) (e.target as any).style.color = headerStyle['--navbar-hover-color']; }"
                            @mouseleave="(e: any) => { if(!isActive(link.href)) (e.target as any).style.color = isScrolled ? headerStyle['--navbar-text-color'] : (settings.navbar_style === 'solid' ? headerStyle['--navbar-text-color'] : 'rgba(255,255,255,0.90)'); }"
                        >
                            {{ link.name }}
                        </Link>
                    </li>
                </ul>
            </nav>

            <!-- Desktop Right CTA & Login Buttons -->
            <div class="hidden lg:flex items-center gap-3">
                <!-- Login / Dashboard Button -->
                <Link
                    v-if="showLoginButton"
                    :href="loginButtonData.href"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-full border transition-all duration-300 group shadow-sm"
                    :style="{
                        backgroundColor: isScrolled
                            ? 'rgba(232, 119, 12, 0.08)'
                            : (settings.navbar_style === 'solid' ? 'rgba(232, 119, 12, 0.08)' : 'rgba(255, 255, 255, 0.15)'),
                        borderColor: isScrolled
                            ? 'rgba(232, 119, 12, 0.3)'
                            : (settings.navbar_style === 'solid' ? 'rgba(232, 119, 12, 0.3)' : 'rgba(255, 255, 255, 0.3)'),
                        color: isScrolled
                            ? headerStyle['--navbar-text-color']
                            : (settings.navbar_style === 'solid' ? headerStyle['--navbar-text-color'] : '#FFFFFF'),
                        backdropFilter: settings.navbar_style === 'glassmorphism' ? 'blur(8px)' : 'none',
                    }"
                    @mouseover="(e: any) => {
                        (e.currentTarget as any).style.transform = 'translateY(-2px)';
                        (e.currentTarget as any).style.borderColor = '#E8770C';
                        (e.currentTarget as any).style.boxShadow = '0 4px 14px rgba(232, 119, 12, 0.25)';
                        (e.currentTarget as any).style.color = '#E8770C';
                    }"
                    @mouseleave="(e: any) => {
                        (e.currentTarget as any).style.transform = 'translateY(0)';
                        (e.currentTarget as any).style.borderColor = isScrolled
                            ? 'rgba(232, 119, 12, 0.3)'
                            : (settings.navbar_style === 'solid' ? 'rgba(232, 119, 12, 0.3)' : 'rgba(255, 255, 255, 0.3)');
                        (e.currentTarget as any).style.boxShadow = 'none';
                        (e.currentTarget as any).style.color = isScrolled
                            ? headerStyle['--navbar-text-color']
                            : (settings.navbar_style === 'solid' ? headerStyle['--navbar-text-color'] : '#FFFFFF');
                    }"
                >
                    <component :is="loginButtonData.icon" class="size-4 text-[#E8770C] transition-transform duration-250 group-hover:scale-110" />
                    <span>{{ loginButtonData.text }}</span>
                </Link>

                <!-- Desktop CTA Button -->
                <div v-if="settings.navbar_cta_active === 'true'">
                    <Link
                        :href="settings.navbar_cta_url || '/contact'"
                        class="btn-primary group text-sm px-5 py-2.5"
                        :style="{ 
                            background: `linear-gradient(135deg, ${headerStyle['--navbar-cta-bg']} 0%, ${headerStyle['--navbar-cta-hover-bg']} 100%)`, 
                            color: headerStyle['--navbar-cta-text-color'],
                            'box-shadow': !isScrolled ? `0 4px 20px rgba(232, 119, 12, 0.4)` : 'none'
                        }"
                        @mouseover="(e: any) => { (e.currentTarget as any).style.transform = 'translateY(-2px) scale(1.02)'; }"
                        @mouseleave="(e: any) => { (e.currentTarget as any).style.transform = 'translateY(0) scale(1)'; }"
                    >
                        <span>{{ settings.navbar_cta_text || 'Get a Quote' }}</span>
                        <ArrowRight class="size-4 ml-1.5 transition-transform duration-250 group-hover:translate-x-1" />
                    </Link>
                </div>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button
                @click="mobileMenuOpen = true"
                class="lg:hidden p-2 rounded-lg focus:outline-none transition-colors duration-150"
                :style="{ color: isScrolled ? headerStyle['--navbar-text-color'] : (settings.navbar_style === 'solid' ? headerStyle['--navbar-text-color'] : '#FFFFFF') }"
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
                        <li v-for="link in parsedNavbarLinks.filter((l: any) => l.is_active)" :key="link.name">
                            <Link
                                :href="link.href"
                                :target="link.target_blank ? '_blank' : undefined"
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

                <!-- Mobile CTA & Login Section -->
                <div class="pt-6 space-y-3" style="border-top: 1px solid rgba(255,255,255,0.10);">
                    <div v-if="showLoginButton">
                        <Link
                            :href="loginButtonData.href"
                            @click="mobileMenuOpen = false"
                            class="w-full px-5 py-3 rounded-lg text-sm font-semibold transition-all duration-300 shadow-sm inline-flex items-center justify-center gap-2 border border-[#E8770C]/30 text-white bg-[#E8770C]/10 hover:bg-[#E8770C]/20 hover:border-[#E8770C]"
                        >
                            <component :is="loginButtonData.icon" class="size-4 text-[#E8770C]" />
                            <span>{{ loginButtonData.text }}</span>
                        </Link>
                    </div>

                    <div v-if="settings.navbar_cta_active === 'true'">
                        <Link
                            :href="settings.navbar_cta_url || '/contact'"
                            @click="mobileMenuOpen = false"
                            class="w-full justify-center px-5 py-3 rounded-lg text-sm font-semibold transition-all duration-300 shadow-sm inline-flex items-center justify-center"
                            :style="{ backgroundColor: headerStyle['--navbar-cta-bg'], color: headerStyle['--navbar-cta-text-color'] }"
                        >
                            {{ settings.navbar_cta_text || 'Get a Quote' }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
