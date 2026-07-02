<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3';
import { 
    LayoutGrid, 
    BookOpen, 
    Folder, 
    Layers, 
    Mail, 
    Settings, 
    Users, 
    Globe, 
    Menu, 
    X, 
    ChevronDown, 
    LogOut 
} from '@lucide/vue';
import { ref, computed } from 'vue';

const page = usePage();
const currentUrl = computed(() => page.url);
const authUser = computed(() => page.props.auth?.user as Record<string, any> | null);

const mobileSidebarOpen = ref(false);
const userDropdownOpen = ref(false);

const navigationItems = [
    { name: 'Dashboard', href: '/admin/dashboard', icon: LayoutGrid },
    { name: 'Page Management', href: '/admin/pages', icon: BookOpen },
    { name: 'Services CRUD', href: '/admin/services', icon: Folder },
    { name: 'Partners CRUD', href: '/admin/partners', icon: Layers },
    { name: 'Messages Inbox', href: '/admin/messages', icon: Mail },
    { name: 'Global Settings', href: '/admin/settings', icon: Settings },
    { name: 'Manage Users', href: '/admin/users', icon: Users },
];

const isActive = (href: string) => {
    if (href === '/admin/dashboard') {
        return currentUrl.value === '/admin/dashboard';
    }

    return currentUrl.value.startsWith(href);
};
</script>

<template>
    <div class="min-h-screen flex bg-base-200 font-sans selection:bg-amber selection:text-white">
        <!-- Sidebar Navigation (Desktop) -->
        <aside class="hidden lg:flex w-64 bg-base-200 text-base-content flex-col justify-between flex-shrink-0 border-r border-base-300">
            <div class="flex flex-col flex-grow">
                <!-- Sidebar Header -->
                <div class="h-16 px-6 border-b border-base-300 flex items-center bg-base-200">
                    <Link href="/admin/dashboard" class="flex flex-col">
                        <span class="font-display font-bold text-base-content text-lg tracking-wide">MERCURY CMS</span>
                        <span class="font-mono text-[10px] text-base-content/60 uppercase tracking-widest leading-none mt-0.5">Control Desk</span>
                    </Link>
                </div>

                <!-- Nav Links -->
                <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                    <Link 
                        v-for="item in navigationItems" 
                        :key="item.name" 
                        :href="item.href" 
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-150"
                        :class="isActive(item.href) 
                            ? 'bg-amber text-white font-semibold shadow-sm' 
                            : 'text-base-content/85 hover:bg-base-300 hover:text-base-content'"
                    >
                        <component :is="item.icon" class="size-4 shrink-0" />
                        <span>{{ item.name }}</span>
                    </Link>
                </nav>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-base-300 bg-base-300/30 flex flex-col gap-2">
                <div v-if="authUser" class="flex items-center gap-3 px-2 py-1">
                    <div class="size-8 rounded-full bg-neutral text-neutral-content flex items-center justify-center font-display font-semibold uppercase text-xs">
                        {{ authUser.name ? authUser.name.charAt(0) : 'A' }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-semibold text-base-content truncate leading-tight">{{ authUser.name }}</p>
                        <p class="text-[10px] text-base-content/60 truncate mt-0.5">{{ authUser.email }}</p>
                    </div>
                </div>

                <Link 
                    href="/logout" 
                    method="post" 
                    as="button" 
                    class="w-full btn btn-xs btn-outline btn-error flex items-center justify-center gap-2 h-auto py-2 transition-colors duration-150 cursor-pointer"
                >
                    <LogOut class="size-3.5" />
                    <span>Log Out</span>
                </Link>
            </div>
        </aside>

        <!-- Main Workspace Container -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header Top Bar -->
            <header class="h-16 bg-base-100 border-b border-base-300 flex items-center justify-between px-6 z-20">
                <!-- Left: Sidebar Toggle (Mobile) -->
                <div class="flex items-center gap-4">
                    <button 
                        @click="mobileSidebarOpen = true"
                        class="lg:hidden p-1.5 rounded-lg text-base-content hover:bg-base-200 focus:outline-none"
                        aria-label="Open sidebar"
                    >
                        <Menu class="size-6" />
                    </button>
                    <div class="hidden lg:flex items-center gap-2 text-xs font-mono text-base-content/40 uppercase tracking-wider">
                        <span>Terminal</span>
                        <span>/</span>
                        <span class="text-base-content/75 font-semibold">{{ currentUrl.split('?')[0].replace('/admin/', '') }}</span>
                    </div>
                </div>

                <!-- Right: Nav actions / profile -->
                <div class="flex items-center gap-4">
                    <a 
                        href="/" 
                        target="_blank" 
                        class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-base-content/75 hover:text-base-content hover:bg-base-200 rounded-lg transition-colors duration-150"
                    >
                        <Globe class="size-3.5" />
                        <span>View Public Site</span>
                    </a>

                    <!-- Divider -->
                    <div class="w-px h-5 bg-base-300"></div>

                    <!-- User drop menu -->
                    <div class="relative">
                        <button 
                            @click="userDropdownOpen = !userDropdownOpen"
                            class="flex items-center gap-2 p-1 rounded-full hover:bg-base-200 transition-colors focus:outline-none"
                        >
                            <div class="size-8 rounded-full bg-neutral text-neutral-content flex items-center justify-center font-display font-semibold uppercase text-xs">
                                {{ authUser?.name ? authUser.name.charAt(0) : 'A' }}
                            </div>
                            <ChevronDown class="size-4 text-base-content/60 hidden sm:block" />
                        </button>

                        <div 
                            v-if="userDropdownOpen" 
                            class="absolute right-0 mt-2 w-48 bg-base-100 border border-base-300 rounded-lg shadow-lg py-1 z-30 animate-in fade-in slide-in-from-top-2 duration-150"
                            @click="userDropdownOpen = false"
                        >
                            <div class="px-4 py-2 border-b border-base-300">
                                <p class="text-xs font-semibold text-base-content truncate">{{ authUser?.name }}</p>
                                <p class="text-[10px] text-base-content/50 truncate mt-0.5">{{ authUser?.email }}</p>
                            </div>
                            <Link 
                                href="/admin/settings" 
                                class="flex items-center gap-2 px-4 py-2 text-xs text-base-content/80 hover:bg-base-200 transition-colors"
                            >
                                <Settings class="size-3.5" />
                                <span>Global Settings</span>
                            </Link>
                            <Link 
                                href="/logout" 
                                method="post" 
                                as="button" 
                                class="w-full flex items-center gap-2 px-4 py-2 text-xs text-left text-error hover:bg-error/10 transition-colors cursor-pointer"
                            >
                                <LogOut class="size-3.5" />
                                <span>Log Out</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-grow overflow-y-auto p-6 lg:p-8 bg-base-200">
                <div class="max-w-7xl mx-auto">
                    <slot />
                </div>
            </main>
        </div>

        <!-- Mobile Drawer Backdrop -->
        <div 
            v-if="mobileSidebarOpen" 
            class="fixed inset-0 bg-neutral-900/30 backdrop-blur-xs z-40 lg:hidden transition-opacity duration-300"
            @click="mobileSidebarOpen = false"
        ></div>

        <!-- Mobile Sidebar Drawer -->
        <aside 
            class="fixed inset-y-0 left-0 w-64 bg-base-200 border-r border-base-300 z-50 lg:hidden flex flex-col justify-between transition-transform duration-250 ease-out transform"
            :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex flex-col flex-grow">
                <!-- Mobile Sidebar Header -->
                <div class="h-16 px-6 border-b border-base-300 flex items-center justify-between bg-base-200">
                    <div class="flex flex-col">
                        <span class="font-display font-bold text-base-content text-lg tracking-wide">MERCURY CMS</span>
                        <span class="font-mono text-[10px] text-base-content/60 uppercase tracking-widest leading-none mt-0.5">Control Desk</span>
                    </div>
                    <button 
                        @click="mobileSidebarOpen = false"
                        class="p-1 rounded-lg text-base-content/60 hover:text-base-content"
                        aria-label="Close sidebar"
                    >
                        <X class="size-6" />
                    </button>
                </div>

                <!-- Mobile Nav Links -->
                <nav class="flex-grow px-4 py-6 space-y-1.5 overflow-y-auto">
                    <Link 
                        v-for="item in navigationItems" 
                        :key="item.name" 
                        :href="item.href" 
                        @click="mobileSidebarOpen = false"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-150"
                        :class="isActive(item.href) 
                            ? 'bg-amber text-white font-semibold' 
                            : 'text-base-content/85 hover:bg-base-300 hover:text-base-content'"
                    >
                        <component :is="item.icon" class="size-4 shrink-0" />
                        <span>{{ item.name }}</span>
                    </Link>
                </nav>
            </div>

            <!-- Mobile Sidebar Footer -->
            <div class="p-4 border-t border-base-300 bg-base-300/30 flex flex-col gap-2">
                <div v-if="authUser" class="flex items-center gap-3 px-2 py-1">
                    <div class="size-8 rounded-full bg-neutral text-neutral-content flex items-center justify-center font-display font-semibold uppercase text-xs">
                        {{ authUser.name ? authUser.name.charAt(0) : 'A' }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-semibold text-base-content truncate leading-tight">{{ authUser.name }}</p>
                        <p class="text-[10px] text-base-content/60 truncate mt-0.5">{{ authUser.email }}</p>
                    </div>
                </div>

                <Link 
                    href="/logout" 
                    method="post" 
                    as="button" 
                    @click="mobileSidebarOpen = false"
                    class="w-full btn btn-xs btn-outline btn-error flex items-center justify-center gap-2 h-auto py-2 transition-colors duration-150 cursor-pointer"
                >
                    <LogOut class="size-3.5" />
                    <span>Log Out</span>
                </Link>
            </div>
        </aside>
    </div>
</template>
