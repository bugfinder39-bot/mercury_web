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
    LogOut,
    CheckCircle,
    AlertTriangle,
    Palette
} from '@lucide/vue';
import { ref, computed, watch } from 'vue';

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
    { name: 'Layout Management', href: '/admin/layout', icon: Palette },
    { name: 'Global Settings', href: '/admin/settings', icon: Settings },
    { name: 'Manage Users', href: '/admin/users', icon: Users },
];

const isActive = (href: string) => {
    if (href === '/admin/dashboard') {
        return currentUrl.value === '/admin/dashboard';
    }

    return currentUrl.value.startsWith(href);
};

// Toast system
interface Toast {
    id: number;
    type: 'success' | 'error';
    message: string;
}
const toasts = ref<Toast[]>([]);
let toastId = 0;

const addToast = (type: 'success' | 'error', message: string) => {
    const id = toastId++;
    toasts.value.push({ id, type, message });
    setTimeout(() => {
        removeToast(id);
    }, 4000);
};

const removeToast = (id: number) => {
    toasts.value = toasts.value.filter(t => t.id !== id);
};

watch(
    () => page.props.flash,
    (flash: any) => {
        if (flash?.success) {
            addToast('success', flash.success);
        }
        if (flash?.error) {
            addToast('error', flash.error);
        }
    },
    { deep: true, immediate: true }
);
</script>

<template>
    <div class="min-h-screen flex font-sans" style="background-color: #F8FAFC;">

        <!-- ── Desktop Sidebar ── -->
        <aside
            class="hidden lg:flex w-64 flex-col justify-between flex-shrink-0"
            style="background-color: #0B2540; border-right: 1px solid rgba(255,255,255,0.07);"
        >
            <div class="flex flex-col flex-grow overflow-hidden">
                <!-- Sidebar Brand Header -->
                <div
                    class="h-16 px-6 flex items-center"
                    style="border-bottom: 1px solid rgba(255,255,255,0.08);"
                >
                    <Link href="/admin/dashboard" class="flex flex-col leading-tight">
                        <span class="font-display font-bold text-white text-lg tracking-wide">MERCURY CMS</span>
                        <span class="font-mono text-[10px] uppercase tracking-widest leading-none mt-0.5" style="color: rgba(255,255,255,0.45);">Control Desk</span>
                    </Link>
                </div>

                <!-- Nav Label -->
                <div class="px-6 pt-6 pb-2">
                    <span class="font-mono text-[10px] uppercase tracking-widest" style="color: rgba(255,255,255,0.30);">Navigation</span>
                </div>

                <!-- Nav Links -->
                <nav class="flex-1 px-3 pb-4 space-y-1 overflow-y-auto">
                    <Link
                        v-for="item in navigationItems"
                        :key="item.name"
                        :href="item.href"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-150"
                        :style="isActive(item.href)
                            ? 'background-color: rgba(232,119,12,0.18); color: #E8770C; border: 1px solid rgba(232,119,12,0.25);'
                            : 'color: rgba(255,255,255,0.70); border: 1px solid transparent;'"
                        onmouseover="if (!this.dataset.active) { this.style.backgroundColor='rgba(255,255,255,0.06)'; this.style.color='rgba(255,255,255,0.95)'; }"
                        onmouseout="if (!this.dataset.active) { this.style.backgroundColor='transparent'; this.style.color='rgba(255,255,255,0.70)'; }"
                    >
                        <component
                            :is="item.icon"
                            class="size-4 shrink-0"
                            :style="isActive(item.href) ? 'color: #E8770C;' : ''"
                        />
                        <span>{{ item.name }}</span>
                    </Link>
                </nav>
            </div>

            <!-- Sidebar Footer (User Info) -->
            <div class="p-4 flex flex-col gap-3" style="border-top: 1px solid rgba(255,255,255,0.08);">
                <div v-if="authUser" class="flex items-center gap-3 px-2 py-1">
                    <div
                        class="size-8 rounded-full flex items-center justify-center font-display font-bold uppercase text-xs text-white"
                        style="background-color: #E8770C;"
                    >
                        {{ authUser.name ? authUser.name.charAt(0) : 'A' }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-semibold text-white truncate leading-tight">{{ authUser.name }}</p>
                        <p class="text-[10px] truncate mt-0.5" style="color: rgba(255,255,255,0.45);">{{ authUser.email }}</p>
                    </div>
                </div>

                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-150 cursor-pointer"
                    style="border: 1px solid rgba(255,255,255,0.20); color: rgba(255,255,255,0.60);"
                    onmouseover="this.style.backgroundColor='rgba(192,57,43,0.20)'; this.style.color='#ff6b6b'; this.style.borderColor='rgba(192,57,43,0.40)';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255,255,255,0.60)'; this.style.borderColor='rgba(255,255,255,0.20)';"
                >
                    <LogOut class="size-3.5" />
                    <span>Log Out</span>
                </Link>
            </div>
        </aside>

        <!-- ── Main Content ── -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- Header Top Bar -->
            <header
                class="h-16 flex items-center justify-between px-6 z-20"
                style="background-color: #ffffff; border-bottom: 1px solid rgba(11,37,64,0.08); box-shadow: 0 1px 4px rgba(11,37,64,0.06);"
            >
                <!-- Left -->
                <div class="flex items-center gap-4">
                    <button
                        @click="mobileSidebarOpen = true"
                        class="lg:hidden p-1.5 rounded-lg focus:outline-none transition-colors"
                        style="color: #0B2540;"
                        aria-label="Open sidebar"
                    >
                        <Menu class="size-6" />
                    </button>
                    <div class="hidden lg:flex items-center gap-2 text-xs font-mono uppercase tracking-wider" style="color: rgba(11,37,64,0.40);">
                        <span>Admin</span>
                        <span style="color: rgba(11,37,64,0.25);">/</span>
                        <span class="font-semibold" style="color: #0B2540;">{{ currentUrl.split('?')[0].replace('/admin/', '') }}</span>
                    </div>
                </div>

                <!-- Right -->
                <div class="flex items-center gap-4">
                    <a
                        href="/"
                        target="_blank"
                        class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors duration-150"
                        style="color: #E8770C; border: 1px solid rgba(232,119,12,0.25); background-color: rgba(232,119,12,0.06);"
                        onmouseover="this.style.backgroundColor='rgba(232,119,12,0.12)';"
                        onmouseout="this.style.backgroundColor='rgba(232,119,12,0.06)';"
                    >
                        <Globe class="size-3.5" />
                        <span>View Public Site</span>
                    </a>

                    <div class="w-px h-5" style="background-color: rgba(11,37,64,0.12);"></div>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button
                            @click="userDropdownOpen = !userDropdownOpen"
                            class="flex items-center gap-2 p-1 rounded-full focus:outline-none transition-colors"
                        >
                            <div
                                class="size-8 rounded-full flex items-center justify-center font-display font-bold uppercase text-xs text-white"
                                style="background-color: #E8770C;"
                            >
                                {{ authUser?.name ? authUser.name.charAt(0) : 'A' }}
                            </div>
                            <ChevronDown class="size-4 hidden sm:block" style="color: #64748B;" />
                        </button>

                        <div
                            v-if="userDropdownOpen"
                            class="absolute right-0 mt-2 w-52 rounded-xl py-1 z-30 animate-in fade-in slide-in-from-top-2 duration-150"
                            style="background-color: #ffffff; border: 1px solid rgba(11,37,64,0.10); box-shadow: var(--shadow-lg);"
                            @click="userDropdownOpen = false"
                        >
                            <div class="px-4 py-3" style="border-bottom: 1px solid rgba(11,37,64,0.07);">
                                <p class="text-xs font-semibold truncate" style="color: #0B2540;">{{ authUser?.name }}</p>
                                <p class="text-[10px] truncate mt-0.5" style="color: #64748B;">{{ authUser?.email }}</p>
                            </div>
                            <Link
                                href="/admin/settings"
                                class="flex items-center gap-2 px-4 py-2.5 text-xs transition-colors"
                                style="color: #475569;"
                                onmouseover="this.style.backgroundColor='#F8FAFC'; this.style.color='#0B2540';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#475569';"
                            >
                                <Settings class="size-3.5" style="color: #E8770C;" />
                                <span>Global Settings</span>
                            </Link>
                            <Link
                                href="/logout"
                                method="post"
                                as="button"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-left transition-colors cursor-pointer"
                                style="color: #C0392B;"
                                onmouseover="this.style.backgroundColor='rgba(192,57,43,0.06)';"
                                onmouseout="this.style.backgroundColor='transparent';"
                            >
                                <LogOut class="size-3.5" />
                                <span>Log Out</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-grow overflow-y-auto p-6 lg:p-8" style="background-color: #F8FAFC;">
                <div class="max-w-7xl mx-auto">
                    <slot />
                </div>
            </main>
        </div>

        <!-- Mobile Backdrop -->
        <div
            v-if="mobileSidebarOpen"
            class="fixed inset-0 z-40 lg:hidden transition-opacity duration-300 backdrop-blur-sm"
            style="background-color: rgba(11,37,64,0.50);"
            @click="mobileSidebarOpen = false"
        ></div>

        <!-- Mobile Sidebar Drawer -->
        <aside
            class="fixed inset-y-0 left-0 w-64 z-50 lg:hidden flex flex-col justify-between transition-transform duration-250 ease-out transform"
            :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            style="background-color: #0B2540; border-right: 1px solid rgba(255,255,255,0.08);"
        >
            <div class="flex flex-col flex-grow overflow-hidden">
                <!-- Mobile Sidebar Header -->
                <div class="h-16 px-6 flex items-center justify-between" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <div class="flex flex-col leading-tight">
                        <span class="font-display font-bold text-white text-lg tracking-wide">MERCURY CMS</span>
                        <span class="font-mono text-[10px] uppercase tracking-widest leading-none mt-0.5" style="color: rgba(255,255,255,0.45);">Control Desk</span>
                    </div>
                    <button
                        @click="mobileSidebarOpen = false"
                        class="p-1 rounded-lg focus:outline-none"
                        style="color: rgba(255,255,255,0.50);"
                        aria-label="Close sidebar"
                    >
                        <X class="size-5" />
                    </button>
                </div>

                <!-- Mobile Nav Label -->
                <div class="px-6 pt-6 pb-2">
                    <span class="font-mono text-[10px] uppercase tracking-widest" style="color: rgba(255,255,255,0.30);">Navigation</span>
                </div>

                <!-- Mobile Nav Links -->
                <nav class="flex-grow px-3 pb-4 space-y-1 overflow-y-auto">
                    <Link
                        v-for="item in navigationItems"
                        :key="item.name"
                        :href="item.href"
                        @click="mobileSidebarOpen = false"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-150"
                        :style="isActive(item.href)
                            ? 'background-color: rgba(232,119,12,0.18); color: #E8770C; border: 1px solid rgba(232,119,12,0.25);'
                            : 'color: rgba(255,255,255,0.70); border: 1px solid transparent;'"
                    >
                        <component
                            :is="item.icon"
                            class="size-4 shrink-0"
                            :style="isActive(item.href) ? 'color: #E8770C;' : ''"
                        />
                        <span>{{ item.name }}</span>
                    </Link>
                </nav>
            </div>

            <!-- Mobile Sidebar Footer -->
            <div class="p-4 flex flex-col gap-3" style="border-top: 1px solid rgba(255,255,255,0.08);">
                <div v-if="authUser" class="flex items-center gap-3 px-2 py-1">
                    <div
                        class="size-8 rounded-full flex items-center justify-center font-display font-bold uppercase text-xs text-white"
                        style="background-color: #E8770C;"
                    >
                        {{ authUser.name ? authUser.name.charAt(0) : 'A' }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-semibold text-white truncate leading-tight">{{ authUser.name }}</p>
                        <p class="text-[10px] truncate mt-0.5" style="color: rgba(255,255,255,0.45);">{{ authUser.email }}</p>
                    </div>
                </div>
                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    @click="mobileSidebarOpen = false"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-150 cursor-pointer"
                    style="border: 1px solid rgba(255,255,255,0.20); color: rgba(255,255,255,0.60);"
                >
                    <LogOut class="size-3.5" />
                    <span>Log Out</span>
                </Link>
            </div>
        </aside>

        <!-- Floating Toast Notifications -->
        <div class="fixed top-4 right-4 z-50 flex flex-col gap-2 max-w-sm w-full pointer-events-none">
            <div
                v-for="toast in toasts"
                :key="toast.id"
                class="flex items-center gap-3 p-4 rounded-xl shadow-lg border text-sm font-semibold transition-all duration-300 transform translate-y-0 pointer-events-auto"
                :class="toast.type === 'success' 
                    ? 'bg-emerald-50 border-emerald-200 text-emerald-800' 
                    : 'bg-rose-50 border-rose-200 text-rose-800'"
            >
                <CheckCircle v-if="toast.type === 'success'" class="size-5 shrink-0 text-emerald-600" />
                <AlertTriangle v-else class="size-5 shrink-0 text-rose-600" />
                
                <span class="flex-grow">{{ toast.message }}</span>
                
                <button @click="removeToast(toast.id)" class="p-1 rounded-md hover:bg-black/5 transition-colors">
                    <X class="size-4 opacity-70" />
                </button>
            </div>
        </div>
    </div>
</template>
