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
    Palette,
} from '@lucide/vue';
import { ref, computed, watch } from 'vue';

const page = usePage();
const currentUrl = computed(() => page.url);
const authUser = computed(
    () => page.props.auth?.user as Record<string, any> | null,
);

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
    toasts.value = toasts.value.filter((t) => t.id !== id);
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
    { deep: true, immediate: true },
);
</script>

<template>
    <div class="flex min-h-screen font-sans" style="background-color: #f8fafc">
        <!-- ── Desktop Sidebar ── -->
        <aside
            class="hidden w-64 flex-shrink-0 flex-col justify-between lg:flex"
            style="
                background-color: #0b2540;
                border-right: 1px solid rgba(255, 255, 255, 0.07);
            "
        >
            <div class="flex flex-grow flex-col overflow-hidden">
                <!-- Sidebar Brand Header -->
                <div
                    class="flex h-16 items-center px-6"
                    style="border-bottom: 1px solid rgba(255, 255, 255, 0.08)"
                >
                    <Link
                        href="/admin/dashboard"
                        class="flex flex-col leading-tight"
                    >
                        <span
                            class="font-display text-lg font-bold tracking-wide text-white"
                            >MERCURY CMS</span
                        >
                        <span
                            class="mt-0.5 font-mono text-[10px] leading-none tracking-widest uppercase"
                            style="color: rgba(255, 255, 255, 0.45)"
                            >Control Desk</span
                        >
                    </Link>
                </div>

                <!-- Nav Label -->
                <div class="px-6 pt-6 pb-2">
                    <span
                        class="font-mono text-[10px] tracking-widest uppercase"
                        style="color: rgba(255, 255, 255, 0.3)"
                        >Navigation</span
                    >
                </div>

                <!-- Nav Links -->
                <nav class="flex-1 space-y-1 overflow-y-auto px-3 pb-4">
                    <Link
                        v-for="item in navigationItems"
                        :key="item.name"
                        :href="item.href"
                        class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium transition-all duration-150"
                        :style="
                            isActive(item.href)
                                ? 'background-color: rgba(232,119,12,0.18); color: #E8770C; border: 1px solid rgba(232,119,12,0.25);'
                                : 'color: rgba(255,255,255,0.70); border: 1px solid transparent;'
                        "
                        onmouseover="
                            if (!this.dataset.active) {
                                this.style.backgroundColor =
                                    'rgba(255,255,255,0.06)';
                                this.style.color = 'rgba(255,255,255,0.95)';
                            }
                        "
                        onmouseout="
                            if (!this.dataset.active) {
                                this.style.backgroundColor = 'transparent';
                                this.style.color = 'rgba(255,255,255,0.70)';
                            }
                        "
                    >
                        <component
                            :is="item.icon"
                            class="size-4 shrink-0"
                            :style="
                                isActive(item.href) ? 'color: #E8770C;' : ''
                            "
                        />
                        <span>{{ item.name }}</span>
                    </Link>
                </nav>
            </div>

            <!-- Sidebar Footer (User Info) -->
            <div
                class="flex flex-col gap-3 p-4"
                style="border-top: 1px solid rgba(255, 255, 255, 0.08)"
            >
                <div v-if="authUser" class="flex items-center gap-3 px-2 py-1">
                    <div
                        class="flex size-8 items-center justify-center rounded-full font-display text-xs font-bold text-white uppercase"
                        style="background-color: #e8770c"
                    >
                        {{ authUser.name ? authUser.name.charAt(0) : 'A' }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p
                            class="truncate text-xs leading-tight font-semibold text-white"
                        >
                            {{ authUser.name }}
                        </p>
                        <p
                            class="mt-0.5 truncate text-[10px]"
                            style="color: rgba(255, 255, 255, 0.45)"
                        >
                            {{ authUser.email }}
                        </p>
                    </div>
                </div>

                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-medium transition-all duration-150"
                    style="
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        color: rgba(255, 255, 255, 0.6);
                    "
                    onmouseover="
                        this.style.backgroundColor = 'rgba(192,57,43,0.20)';
                        this.style.color = '#ff6b6b';
                        this.style.borderColor = 'rgba(192,57,43,0.40)';
                    "
                    onmouseout="
                        this.style.backgroundColor = 'transparent';
                        this.style.color = 'rgba(255,255,255,0.60)';
                        this.style.borderColor = 'rgba(255,255,255,0.20)';
                    "
                >
                    <LogOut class="size-3.5" />
                    <span>Log Out</span>
                </Link>
            </div>
        </aside>

        <!-- ── Main Content ── -->
        <div class="flex min-w-0 flex-1 flex-col overflow-hidden">
            <!-- Header Top Bar -->
            <header
                class="z-20 flex h-16 items-center justify-between px-6"
                style="
                    background-color: #ffffff;
                    border-bottom: 1px solid rgba(11, 37, 64, 0.08);
                    box-shadow: 0 1px 4px rgba(11, 37, 64, 0.06);
                "
            >
                <!-- Left -->
                <div class="flex items-center gap-4">
                    <button
                        @click="mobileSidebarOpen = true"
                        class="rounded-lg p-1.5 transition-colors focus:outline-none lg:hidden"
                        style="color: #0b2540"
                        aria-label="Open sidebar"
                    >
                        <Menu class="size-6" />
                    </button>
                    <div
                        class="hidden items-center gap-2 font-mono text-xs tracking-wider uppercase lg:flex"
                        style="color: rgba(11, 37, 64, 0.4)"
                    >
                        <span>Admin</span>
                        <span style="color: rgba(11, 37, 64, 0.25)">/</span>
                        <span class="font-semibold" style="color: #0b2540">{{
                            currentUrl.split('?')[0].replace('/admin/', '')
                        }}</span>
                    </div>
                </div>

                <!-- Right -->
                <div class="flex items-center gap-4">
                    <a
                        href="/"
                        target="_blank"
                        class="hidden items-center gap-2 rounded-lg px-3 py-1.5 text-xs font-medium transition-colors duration-150 sm:inline-flex"
                        style="
                            color: #e8770c;
                            border: 1px solid rgba(232, 119, 12, 0.25);
                            background-color: rgba(232, 119, 12, 0.06);
                        "
                        onmouseover="
                            this.style.backgroundColor = 'rgba(232,119,12,0.12)'
                        "
                        onmouseout="
                            this.style.backgroundColor = 'rgba(232,119,12,0.06)'
                        "
                    >
                        <Globe class="size-3.5" />
                        <span>View Public Site</span>
                    </a>

                    <div
                        class="h-5 w-px"
                        style="background-color: rgba(11, 37, 64, 0.12)"
                    ></div>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button
                            @click="userDropdownOpen = !userDropdownOpen"
                            class="flex items-center gap-2 rounded-full p-1 transition-colors focus:outline-none"
                        >
                            <div
                                class="flex size-8 items-center justify-center rounded-full font-display text-xs font-bold text-white uppercase"
                                style="background-color: #e8770c"
                            >
                                {{
                                    authUser?.name
                                        ? authUser.name.charAt(0)
                                        : 'A'
                                }}
                            </div>
                            <ChevronDown
                                class="hidden size-4 sm:block"
                                style="color: #64748b"
                            />
                        </button>

                        <div
                            v-if="userDropdownOpen"
                            class="absolute right-0 z-30 mt-2 w-52 animate-in rounded-xl py-1 duration-150 fade-in slide-in-from-top-2"
                            style="
                                background-color: #ffffff;
                                border: 1px solid rgba(11, 37, 64, 0.1);
                                box-shadow: var(--shadow-lg);
                            "
                            @click="userDropdownOpen = false"
                        >
                            <div
                                class="px-4 py-3"
                                style="
                                    border-bottom: 1px solid
                                        rgba(11, 37, 64, 0.07);
                                "
                            >
                                <p
                                    class="truncate text-xs font-semibold"
                                    style="color: #0b2540"
                                >
                                    {{ authUser?.name }}
                                </p>
                                <p
                                    class="mt-0.5 truncate text-[10px]"
                                    style="color: #64748b"
                                >
                                    {{ authUser?.email }}
                                </p>
                            </div>
                            <Link
                                href="/admin/settings"
                                class="flex items-center gap-2 px-4 py-2.5 text-xs transition-colors"
                                style="color: #475569"
                                onmouseover="
                                    this.style.backgroundColor = '#F8FAFC';
                                    this.style.color = '#0B2540';
                                "
                                onmouseout="
                                    this.style.backgroundColor = 'transparent';
                                    this.style.color = '#475569';
                                "
                            >
                                <Settings
                                    class="size-3.5"
                                    style="color: #e8770c"
                                />
                                <span>Global Settings</span>
                            </Link>
                            <Link
                                href="/logout"
                                method="post"
                                as="button"
                                class="flex w-full cursor-pointer items-center gap-2 px-4 py-2.5 text-left text-xs transition-colors"
                                style="color: #c0392b"
                                onmouseover="
                                    this.style.backgroundColor =
                                        'rgba(192,57,43,0.06)'
                                "
                                onmouseout="
                                    this.style.backgroundColor = 'transparent'
                                "
                            >
                                <LogOut class="size-3.5" />
                                <span>Log Out</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main
                class="flex-grow overflow-y-auto p-6 lg:p-8"
                style="background-color: #f8fafc"
            >
                <div class="mx-auto max-w-7xl">
                    <slot />
                </div>
            </main>
        </div>

        <!-- Mobile Backdrop -->
        <div
            v-if="mobileSidebarOpen"
            class="fixed inset-0 z-40 backdrop-blur-sm transition-opacity duration-300 lg:hidden"
            style="background-color: rgba(11, 37, 64, 0.5)"
            @click="mobileSidebarOpen = false"
        ></div>

        <!-- Mobile Sidebar Drawer -->
        <aside
            class="fixed inset-y-0 left-0 z-50 flex w-64 transform flex-col justify-between transition-transform duration-250 ease-out lg:hidden"
            :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            style="
                background-color: #0b2540;
                border-right: 1px solid rgba(255, 255, 255, 0.08);
            "
        >
            <div class="flex flex-grow flex-col overflow-hidden">
                <!-- Mobile Sidebar Header -->
                <div
                    class="flex h-16 items-center justify-between px-6"
                    style="border-bottom: 1px solid rgba(255, 255, 255, 0.08)"
                >
                    <div class="flex flex-col leading-tight">
                        <span
                            class="font-display text-lg font-bold tracking-wide text-white"
                            >MERCURY CMS</span
                        >
                        <span
                            class="mt-0.5 font-mono text-[10px] leading-none tracking-widest uppercase"
                            style="color: rgba(255, 255, 255, 0.45)"
                            >Control Desk</span
                        >
                    </div>
                    <button
                        @click="mobileSidebarOpen = false"
                        class="rounded-lg p-1 focus:outline-none"
                        style="color: rgba(255, 255, 255, 0.5)"
                        aria-label="Close sidebar"
                    >
                        <X class="size-5" />
                    </button>
                </div>

                <!-- Mobile Nav Label -->
                <div class="px-6 pt-6 pb-2">
                    <span
                        class="font-mono text-[10px] tracking-widest uppercase"
                        style="color: rgba(255, 255, 255, 0.3)"
                        >Navigation</span
                    >
                </div>

                <!-- Mobile Nav Links -->
                <nav class="flex-grow space-y-1 overflow-y-auto px-3 pb-4">
                    <Link
                        v-for="item in navigationItems"
                        :key="item.name"
                        :href="item.href"
                        @click="mobileSidebarOpen = false"
                        class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium transition-all duration-150"
                        :style="
                            isActive(item.href)
                                ? 'background-color: rgba(232,119,12,0.18); color: #E8770C; border: 1px solid rgba(232,119,12,0.25);'
                                : 'color: rgba(255,255,255,0.70); border: 1px solid transparent;'
                        "
                    >
                        <component
                            :is="item.icon"
                            class="size-4 shrink-0"
                            :style="
                                isActive(item.href) ? 'color: #E8770C;' : ''
                            "
                        />
                        <span>{{ item.name }}</span>
                    </Link>
                </nav>
            </div>

            <!-- Mobile Sidebar Footer -->
            <div
                class="flex flex-col gap-3 p-4"
                style="border-top: 1px solid rgba(255, 255, 255, 0.08)"
            >
                <div v-if="authUser" class="flex items-center gap-3 px-2 py-1">
                    <div
                        class="flex size-8 items-center justify-center rounded-full font-display text-xs font-bold text-white uppercase"
                        style="background-color: #e8770c"
                    >
                        {{ authUser.name ? authUser.name.charAt(0) : 'A' }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p
                            class="truncate text-xs leading-tight font-semibold text-white"
                        >
                            {{ authUser.name }}
                        </p>
                        <p
                            class="mt-0.5 truncate text-[10px]"
                            style="color: rgba(255, 255, 255, 0.45)"
                        >
                            {{ authUser.email }}
                        </p>
                    </div>
                </div>
                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    @click="mobileSidebarOpen = false"
                    class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-medium transition-all duration-150"
                    style="
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        color: rgba(255, 255, 255, 0.6);
                    "
                >
                    <LogOut class="size-3.5" />
                    <span>Log Out</span>
                </Link>
            </div>
        </aside>

        <!-- Floating Toast Notifications -->
        <div
            class="pointer-events-none fixed top-4 right-4 z-50 flex w-full max-w-sm flex-col gap-2"
        >
            <div
                v-for="toast in toasts"
                :key="toast.id"
                class="pointer-events-auto flex translate-y-0 transform items-center gap-3 rounded-xl border p-4 text-sm font-semibold shadow-lg transition-all duration-300"
                :class="
                    toast.type === 'success'
                        ? 'border-emerald-200 bg-emerald-50 text-emerald-800'
                        : 'border-rose-200 bg-rose-50 text-rose-800'
                "
            >
                <CheckCircle
                    v-if="toast.type === 'success'"
                    class="size-5 shrink-0 text-emerald-600"
                />
                <AlertTriangle v-else class="size-5 shrink-0 text-rose-600" />

                <span class="flex-grow">{{ toast.message }}</span>

                <button
                    @click="removeToast(toast.id)"
                    class="rounded-md p-1 transition-colors hover:bg-black/5"
                >
                    <X class="size-4 opacity-70" />
                </button>
            </div>
        </div>
    </div>
</template>
