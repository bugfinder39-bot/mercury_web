<script setup lang="ts">
import { ref, watch } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import {
    Search,
    UserPlus,
    Filter,
    Edit3,
    Trash2,
    Key,
    Shield,
    User,
    CheckCircle2,
    XCircle,
    Clock,
    Calendar,
    ChevronLeft,
    ChevronRight,
    X,
    AlertTriangle,
    RefreshCw,
} from '@lucide/vue';

interface UserData {
    id: number;
    name: string;
    email: string;
    role: string;
    status: string;
    avatar?: string | null;
    last_login_at?: string | null;
    created_at?: string | null;
    updated_at?: string | null;
}

interface PaginationLinks {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginatedUsers {
    data: UserData[];
    links: PaginationLinks[];
    current_page: number;
    last_page: number;
    total: number;
    from: number;
    to: number;
}

const props = defineProps<{
    users: PaginatedUsers;
    filters: {
        search?: string;
        role?: string;
        status?: string;
        sort_by?: string;
        sort_order?: string;
    };
    can: {
        create_user: boolean;
        create_super_admin: boolean;
        delete_user: boolean;
    };
}>();

defineOptions({
    layout: AdminLayout,
});

const page = usePage();
const authUser = page.props.auth?.user as UserData | undefined;

// Filter Reactive States
const searchInput = ref(props.filters.search || '');
const roleFilter = ref(props.filters.role || '');
const statusFilter = ref(props.filters.status || '');
const sortBy = ref(props.filters.sort_by || 'created_at');
const sortOrder = ref(props.filters.sort_order || 'desc');

const applyFilters = () => {
    router.get(
        '/admin/users',
        {
            search: searchInput.value || undefined,
            role: roleFilter.value || undefined,
            status: statusFilter.value || undefined,
            sort_by: sortBy.value,
            sort_order: sortOrder.value,
        },
        { preserveState: true, replace: true }
    );
};

let searchTimeout: any = null;
const onSearchInput = () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        applyFilters();
    }, 400);
};

const handleSort = (field: string) => {
    if (sortBy.value === field) {
        sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
    } else {
        sortBy.value = field;
        sortOrder.value = 'asc';
    }
    applyFilters();
};

const clearFilters = () => {
    searchInput.value = '';
    roleFilter.value = '';
    statusFilter.value = '';
    sortBy.value = 'created_at';
    sortOrder.value = 'desc';
    applyFilters();
};

// Modal States
const deleteModalOpen = ref(false);
const userToDelete = ref<UserData | null>(null);

const statusModalOpen = ref(false);
const userToToggleStatus = ref<UserData | null>(null);

const resetPasswordModalOpen = ref(false);
const userToResetPassword = ref<UserData | null>(null);
const newPassword = ref('');
const newPasswordConfirmation = ref('');
const passwordErrors = ref<string[]>([]);
const isSubmittingPassword = ref(false);

const openDeleteModal = (user: UserData) => {
    userToDelete.value = user;
    deleteModalOpen.value = true;
};

const confirmDelete = () => {
    if (!userToDelete.value) return;
    router.delete(`/admin/users/${userToDelete.value.id}`, {
        onSuccess: () => {
            deleteModalOpen.value = false;
            userToDelete.value = null;
        },
    });
};

const openStatusModal = (user: UserData) => {
    userToToggleStatus.value = user;
    statusModalOpen.value = true;
};

const confirmToggleStatus = () => {
    if (!userToToggleStatus.value) return;
    router.patch(
        `/admin/users/${userToToggleStatus.value.id}/toggle-status`,
        {},
        {
            onSuccess: () => {
                statusModalOpen.value = false;
                userToToggleStatus.value = null;
            },
        }
    );
};

const openResetPasswordModal = (user: UserData) => {
    userToResetPassword.value = user;
    newPassword.value = '';
    newPasswordConfirmation.value = '';
    passwordErrors.value = [];
    resetPasswordModalOpen.value = true;
};

const submitResetPassword = () => {
    if (!userToResetPassword.value) return;
    passwordErrors.value = [];

    if (!newPassword.value) {
        passwordErrors.value.push('Password is required.');
    } else if (newPassword.value.length < 8) {
        passwordErrors.value.push('Password must be at least 8 characters.');
    }
    if (newPassword.value !== newPasswordConfirmation.value) {
        passwordErrors.value.push('Password confirmation does not match.');
    }

    if (passwordErrors.value.length > 0) return;

    isSubmittingPassword.value = true;
    router.post(
        `/admin/users/${userToResetPassword.value.id}/reset-password`,
        {
            password: newPassword.value,
            password_confirmation: newPasswordConfirmation.value,
        },
        {
            onSuccess: () => {
                resetPasswordModalOpen.value = false;
                userToResetPassword.value = null;
                isSubmittingPassword.value = false;
            },
            onError: (errs) => {
                isSubmittingPassword.value = false;
                passwordErrors.value = Object.values(errs).flat() as string[];
            },
        }
    );
};

// Date Formatting Helper
const formatDate = (dateStr?: string | null) => {
    if (!dateStr) return 'Never';
    try {
        const date = new Date(dateStr);
        return new Intl.DateTimeFormat('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        }).format(date);
    } catch (e) {
        return dateStr;
    }
};

// Initial Avatar Letter Helper
const getInitials = (name: string) => {
    if (!name) return 'U';
    return name
        .split(' ')
        .map((n) => n.charAt(0))
        .join('')
        .substring(0, 2)
        .toUpperCase();
};
</script>

<template>
    <Head title="Manage Users - Mercury CMS" />

    <div class="space-y-6">
        <!-- Top Header & Action -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-display text-3xl font-bold tracking-tight" style="color: #0B2540">
                    User Management
                </h1>
                <p class="mt-1 font-body text-sm" style="color: #64748B">
                    Manage system administrators, editors, roles, security, and account access.
                </p>
            </div>
            <div>
                <Link
                    href="/admin/users/create"
                    class="inline-flex items-center gap-2 rounded-lg px-4 py-2.5 font-display text-sm font-semibold text-white shadow-sm transition-all duration-150"
                    style="background-color: #E8770C"
                    onmouseover="this.style.backgroundColor='#d06807'"
                    onmouseout="this.style.backgroundColor='#E8770C'"
                >
                    <UserPlus class="size-4" />
                    <span>Create User</span>
                </Link>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div
            class="rounded-xl border p-4 shadow-sm transition-all"
            style="background-color: #ffffff; border-color: rgba(11, 37, 64, 0.1)"
        >
            <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                <!-- Search Input -->
                <div class="relative md:col-span-5">
                    <Search
                        class="absolute left-3.5 top-1/2 size-4 -translate-y-1/2"
                        style="color: #64748B"
                    />
                    <input
                        v-model="searchInput"
                        @input="onSearchInput"
                        type="text"
                        placeholder="Search by name, email, or role..."
                        class="w-full rounded-lg py-2 pl-10 pr-4 font-body text-sm transition-colors focus:outline-none"
                        style="
                            background-color: #F8FAFC;
                            border: 1px solid rgba(11, 37, 64, 0.15);
                            color: #0B2540;
                        "
                    />
                </div>

                <!-- Role Filter -->
                <div class="md:col-span-3">
                    <select
                        v-model="roleFilter"
                        @change="applyFilters"
                        class="w-full rounded-lg px-3 py-2 font-body text-sm transition-colors focus:outline-none"
                        style="
                            background-color: #F8FAFC;
                            border: 1px solid rgba(11, 37, 64, 0.15);
                            color: #0B2540;
                        "
                    >
                        <option value="">All Roles</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="content_editor">Content Editor</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="md:col-span-3">
                    <select
                        v-model="statusFilter"
                        @change="applyFilters"
                        class="w-full rounded-lg px-3 py-2 font-body text-sm transition-colors focus:outline-none"
                        style="
                            background-color: #F8FAFC;
                            border: 1px solid rgba(11, 37, 64, 0.15);
                            color: #0B2540;
                        "
                    >
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Reset Filters Button -->
                <div class="flex items-center justify-end md:col-span-1">
                    <button
                        @click="clearFilters"
                        title="Clear filters"
                        class="inline-flex size-9 items-center justify-center rounded-lg border transition-colors focus:outline-none"
                        style="
                            border-color: rgba(11, 37, 64, 0.15);
                            color: #64748B;
                            background-color: #F8FAFC;
                        "
                        onmouseover="this.style.backgroundColor='#E2E8F0'"
                        onmouseout="this.style.backgroundColor='#F8FAFC'"
                    >
                        <RefreshCw class="size-4" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Users Table Card -->
        <div
            class="overflow-hidden rounded-xl border shadow-sm"
            style="background-color: #ffffff; border-color: rgba(11, 37, 64, 0.1)"
        >
            <div class="overflow-x-auto">
                <table class="w-full text-left font-body text-sm">
                    <thead style="background-color: #F8FAFC; border-bottom: 1px solid rgba(11, 37, 64, 0.08)">
                        <tr>
                            <th class="px-6 py-4 font-display text-xs font-bold uppercase tracking-wider" style="color: #0B2540">
                                User Profile
                            </th>
                            <th
                                class="cursor-pointer px-6 py-4 font-display text-xs font-bold uppercase tracking-wider transition-colors hover:bg-slate-100"
                                style="color: #0B2540"
                                @click="handleSort('role')"
                            >
                                <div class="flex items-center gap-1">
                                    <span>Role</span>
                                    <span v-if="sortBy === 'role'">{{ sortOrder === 'asc' ? '↑' : '↓' }}</span>
                                </div>
                            </th>
                            <th
                                class="cursor-pointer px-6 py-4 font-display text-xs font-bold uppercase tracking-wider transition-colors hover:bg-slate-100"
                                style="color: #0B2540"
                                @click="handleSort('status')"
                            >
                                <div class="flex items-center gap-1">
                                    <span>Status</span>
                                    <span v-if="sortBy === 'status'">{{ sortOrder === 'asc' ? '↑' : '↓' }}</span>
                                </div>
                            </th>
                            <th
                                class="cursor-pointer px-6 py-4 font-display text-xs font-bold uppercase tracking-wider transition-colors hover:bg-slate-100"
                                style="color: #0B2540"
                                @click="handleSort('last_login_at')"
                            >
                                <div class="flex items-center gap-1">
                                    <span>Last Login</span>
                                    <span v-if="sortBy === 'last_login_at'">{{ sortOrder === 'asc' ? '↑' : '↓' }}</span>
                                </div>
                            </th>
                            <th
                                class="cursor-pointer px-6 py-4 font-display text-xs font-bold uppercase tracking-wider transition-colors hover:bg-slate-100"
                                style="color: #0B2540"
                                @click="handleSort('created_at')"
                            >
                                <div class="flex items-center gap-1">
                                    <span>Created</span>
                                    <span v-if="sortBy === 'created_at'">{{ sortOrder === 'asc' ? '↑' : '↓' }}</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-right font-display text-xs font-bold uppercase tracking-wider" style="color: #0B2540">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr
                            v-for="user in users.data"
                            :key="user.id"
                            class="transition-colors hover:bg-slate-50/80"
                        >
                            <!-- User Avatar & Info -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div v-if="user.avatar" class="size-10 shrink-0 overflow-hidden rounded-full border border-slate-200 shadow-sm">
                                        <img :src="user.avatar" :alt="user.name" class="size-full object-cover" />
                                    </div>
                                    <div
                                        v-else
                                        class="flex size-10 shrink-0 items-center justify-center rounded-full font-display text-sm font-bold text-white uppercase shadow-sm"
                                        style="background-color: #0B2540"
                                    >
                                        {{ getInitials(user.name) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="truncate font-semibold" style="color: #0B2540">
                                                {{ user.name }}
                                            </span>
                                            <span
                                                v-if="user.id === authUser?.id"
                                                class="rounded px-1.5 py-0.5 font-mono text-[10px] font-bold uppercase tracking-wider text-orange-700 bg-orange-50 border border-orange-200"
                                            >
                                                You
                                            </span>
                                        </div>
                                        <p class="truncate text-xs text-slate-500">
                                            {{ user.email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <!-- Role Badge -->
                            <td class="px-6 py-4">
                                <span
                                    v-if="user.role === 'super_admin'"
                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 font-mono text-xs font-semibold uppercase tracking-wider"
                                    style="background-color: rgba(11, 37, 64, 0.08); color: #0B2540; border: 1px solid rgba(11, 37, 64, 0.15);"
                                >
                                    <Shield class="size-3 text-orange-600" />
                                    Super Admin
                                </span>
                                <span
                                    v-else
                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 font-mono text-xs font-semibold uppercase tracking-wider"
                                    style="background-color: rgba(100, 116, 139, 0.08); color: #475569; border: 1px solid rgba(100, 116, 139, 0.18);"
                                >
                                    <User class="size-3 text-slate-500" />
                                    Content Editor
                                </span>
                            </td>

                            <!-- Status Badge -->
                            <td class="px-6 py-4">
                                <button
                                    @click="openStatusModal(user)"
                                    title="Click to toggle status"
                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 font-mono text-xs font-semibold uppercase tracking-wider transition-opacity hover:opacity-80 focus:outline-none"
                                    :class="
                                        user.status === 'active'
                                            ? 'bg-emerald-50 text-emerald-700 border border-emerald-200'
                                            : 'bg-rose-50 text-rose-700 border border-rose-200'
                                    "
                                >
                                    <CheckCircle2 v-if="user.status === 'active'" class="size-3 text-emerald-600" />
                                    <XCircle v-else class="size-3 text-rose-600" />
                                    {{ user.status }}
                                </button>
                            </td>

                            <!-- Last Login -->
                            <td class="px-6 py-4 text-xs text-slate-600 whitespace-nowrap">
                                <div class="flex items-center gap-1.5">
                                    <Clock class="size-3.5 text-slate-400 shrink-0" />
                                    <span>{{ formatDate(user.last_login_at) }}</span>
                                </div>
                            </td>

                            <!-- Created Date -->
                            <td class="px-6 py-4 text-xs text-slate-600 whitespace-nowrap">
                                <div class="flex items-center gap-1.5">
                                    <Calendar class="size-3.5 text-slate-400 shrink-0" />
                                    <span>{{ formatDate(user.created_at) }}</span>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- Edit -->
                                    <Link
                                        :href="`/admin/users/${user.id}/edit`"
                                        title="Edit User"
                                        class="rounded-lg p-1.5 transition-colors focus:outline-none"
                                        style="color: #E8770C; background-color: rgba(232, 119, 12, 0.08);"
                                        onmouseover="this.style.backgroundColor='rgba(232, 119, 12, 0.18)'"
                                        onmouseout="this.style.backgroundColor='rgba(232, 119, 12, 0.08)'"
                                    >
                                        <Edit3 class="size-4" />
                                    </Link>

                                    <!-- Reset Password -->
                                    <button
                                        @click="openResetPasswordModal(user)"
                                        title="Reset Password"
                                        class="rounded-lg p-1.5 transition-colors focus:outline-none"
                                        style="color: #0B2540; background-color: rgba(11, 37, 64, 0.08);"
                                        onmouseover="this.style.backgroundColor='rgba(11, 37, 64, 0.18)'"
                                        onmouseout="this.style.backgroundColor='rgba(11, 37, 64, 0.08)'"
                                    >
                                        <Key class="size-4" />
                                    </button>

                                    <!-- Delete -->
                                    <button
                                        v-if="can.delete_user"
                                        @click="openDeleteModal(user)"
                                        title="Delete User"
                                        class="rounded-lg p-1.5 transition-colors focus:outline-none"
                                        style="color: #DC2626; background-color: rgba(220, 38, 38, 0.08);"
                                        onmouseover="this.style.backgroundColor='rgba(220, 38, 38, 0.18)'"
                                        onmouseout="this.style.backgroundColor='rgba(220, 38, 38, 0.08)'"
                                    >
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Empty State -->
                        <tr v-if="!users.data || users.data.length === 0">
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="mx-auto flex max-w-xs flex-col items-center justify-center text-center">
                                    <div class="flex size-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        <User class="size-6" />
                                    </div>
                                    <h3 class="mt-3 font-display text-base font-semibold" style="color: #0B2540">No users found</h3>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Try adjusting your search criteria or role filters to find matching accounts.
                                    </p>
                                    <button
                                        @click="clearFilters"
                                        class="mt-4 text-xs font-semibold text-orange-600 hover:underline"
                                    >
                                        Clear all filters
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div
                v-if="users.total > 0"
                class="flex flex-col items-center justify-between gap-4 border-t px-6 py-4 sm:flex-row"
                style="background-color: #FFFFFF; border-color: rgba(11, 37, 64, 0.08)"
            >
                <div class="text-xs text-slate-500">
                    Showing <span class="font-semibold text-slate-800">{{ users.from || 0 }}</span> to
                    <span class="font-semibold text-slate-800">{{ users.to || 0 }}</span> of
                    <span class="font-semibold text-slate-800">{{ users.total }}</span> users
                </div>

                <div class="flex items-center gap-1">
                    <Link
                        v-for="(link, idx) in users.links"
                        :key="idx"
                        :href="link.url || '#'"
                        class="flex h-8 min-w-[32px] items-center justify-center rounded-lg px-2 text-xs font-semibold transition-all"
                        :class="[
                            link.active
                                ? 'bg-orange-600 text-white shadow-sm'
                                : link.url
                                ? 'text-slate-700 hover:bg-slate-100'
                                : 'cursor-not-allowed text-slate-300',
                        ]"
                        v-html="link.label"
                    />
                </div>
            </div>
        </div>
    </div>

    <!-- ── Delete Confirmation Modal ── -->
    <div
        v-if="deleteModalOpen"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 backdrop-blur-xs"
        style="background-color: rgba(11, 37, 64, 0.5)"
    >
        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl transition-all">
            <div class="flex items-center gap-3">
                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                    <AlertTriangle class="size-5" />
                </div>
                <div>
                    <h3 class="font-display text-lg font-bold" style="color: #0B2540">Delete User Account</h3>
                    <p class="text-xs text-slate-500">This will soft delete the account safely.</p>
                </div>
            </div>

            <div class="mt-4 rounded-xl border border-rose-100 bg-rose-50/50 p-4 text-xs text-rose-800">
                Are you sure you want to delete <span class="font-bold">{{ userToDelete?.name }}</span> ({{ userToDelete?.email }})?
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    @click="deleteModalOpen = false"
                    class="rounded-lg px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100"
                >
                    Cancel
                </button>
                <button
                    @click="confirmDelete"
                    class="rounded-lg bg-rose-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-rose-700"
                >
                    Confirm Delete
                </button>
            </div>
        </div>
    </div>

    <!-- ── Toggle Status Modal ── -->
    <div
        v-if="statusModalOpen"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 backdrop-blur-xs"
        style="background-color: rgba(11, 37, 64, 0.5)"
    >
        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl transition-all">
            <div class="flex items-center gap-3">
                <div
                    class="flex size-10 shrink-0 items-center justify-center rounded-full"
                    :class="userToToggleStatus?.status === 'active' ? 'bg-amber-100 text-amber-600' : 'bg-emerald-100 text-emerald-600'"
                >
                    <AlertTriangle class="size-5" />
                </div>
                <div>
                    <h3 class="font-display text-lg font-bold" style="color: #0B2540">
                        {{ userToToggleStatus?.status === 'active' ? 'Deactivate Account' : 'Activate Account' }}
                    </h3>
                    <p class="text-xs text-slate-500">Change login status for user account.</p>
                </div>
            </div>

            <div class="mt-4 rounded-xl border p-4 text-xs" :class="userToToggleStatus?.status === 'active' ? 'border-amber-100 bg-amber-50/50 text-amber-800' : 'border-emerald-100 bg-emerald-50/50 text-emerald-800'">
                <template v-if="userToToggleStatus?.status === 'active'">
                    Deactivating <span class="font-bold">{{ userToToggleStatus?.name }}</span> will immediately prevent them from logging into the CMS.
                </template>
                <template v-else>
                    Activating <span class="font-bold">{{ userToToggleStatus?.name }}</span> will restore their ability to log into the CMS.
                </template>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    @click="statusModalOpen = false"
                    class="rounded-lg px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100"
                >
                    Cancel
                </button>
                <button
                    @click="confirmToggleStatus"
                    class="rounded-lg px-4 py-2 text-xs font-semibold text-white shadow-sm"
                    :class="userToToggleStatus?.status === 'active' ? 'bg-amber-600 hover:bg-amber-700' : 'bg-emerald-600 hover:bg-emerald-700'"
                >
                    Confirm Change
                </button>
            </div>
        </div>
    </div>

    <!-- ── Reset Password Modal ── -->
    <div
        v-if="resetPasswordModalOpen"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 backdrop-blur-xs"
        style="background-color: rgba(11, 37, 64, 0.5)"
    >
        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl transition-all">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                        <Key class="size-5" />
                    </div>
                    <div>
                        <h3 class="font-display text-lg font-bold" style="color: #0B2540">Reset Password</h3>
                        <p class="text-xs text-slate-500">For {{ userToResetPassword?.name }}</p>
                    </div>
                </div>
                <button @click="resetPasswordModalOpen = false" class="text-slate-400 hover:text-slate-600">
                    <X class="size-5" />
                </button>
            </div>

            <div v-if="passwordErrors.length > 0" class="mt-4 rounded-xl border border-rose-200 bg-rose-50 p-3 text-xs text-rose-700">
                <ul class="list-disc pl-4 space-y-0.5">
                    <li v-for="(err, idx) in passwordErrors" :key="idx">{{ err }}</li>
                </ul>
            </div>

            <div class="mt-4 space-y-4 font-body text-sm">
                <div>
                    <label class="block text-xs font-semibold text-slate-700">New Password</label>
                    <input
                        v-model="newPassword"
                        type="password"
                        placeholder="At least 8 characters"
                        class="mt-1 w-full rounded-lg border px-3 py-2 text-sm focus:outline-none"
                        style="border-color: rgba(11, 37, 64, 0.15);"
                    />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700">Confirm New Password</label>
                    <input
                        v-model="newPasswordConfirmation"
                        type="password"
                        placeholder="Re-type new password"
                        class="mt-1 w-full rounded-lg border px-3 py-2 text-sm focus:outline-none"
                        style="border-color: rgba(11, 37, 64, 0.15);"
                    />
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    @click="resetPasswordModalOpen = false"
                    class="rounded-lg px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100"
                >
                    Cancel
                </button>
                <button
                    @click="submitResetPassword"
                    :disabled="isSubmittingPassword"
                    class="inline-flex items-center gap-1.5 rounded-lg px-4 py-2 text-xs font-semibold text-white shadow-sm"
                    style="background-color: #0B2540;"
                >
                    <span v-if="isSubmittingPassword">Saving...</span>
                    <span v-else>Update Password</span>
                </button>
            </div>
        </div>
    </div>
</template>
