<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { ArrowLeft, Save, Upload, User, Shield, Lock, Mail, CheckCircle2, X } from '@lucide/vue';

const props = defineProps<{
    canCreateSuperAdmin: boolean;
}>();

defineOptions({
    layout: AdminLayout,
});

const avatarPreview = ref<string | null>(null);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'content_editor',
    status: 'active',
    avatar_file: null as File | null,
});

const handleAvatarChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.avatar_file = file;
        avatarPreview.value = URL.createObjectURL(file);
    }
};

const removeAvatar = () => {
    form.avatar_file = null;
    avatarPreview.value = null;
};

const submitForm = () => {
    form.post('/admin/users', {
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Create Admin User - Mercury CMS" />

    <div class="max-w-4xl space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <Link
                    href="/admin/users"
                    class="inline-flex size-9 items-center justify-center rounded-lg border transition-colors hover:bg-slate-100"
                    style="border-color: rgba(11, 37, 64, 0.15); color: #0B2540"
                >
                    <ArrowLeft class="size-4" />
                </Link>
                <div>
                    <h1 class="font-display text-2xl font-bold tracking-tight" style="color: #0B2540">
                        Create New User
                    </h1>
                    <p class="font-body text-xs text-slate-500">
                        Add a new administrator or content editor account to Mercury CMS.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="rounded-xl border p-6 shadow-sm"
            style="background-color: #ffffff; border-color: rgba(11, 37, 64, 0.1)"
        >
            <form @submit.prevent="submitForm" class="space-y-6">
                <!-- Avatar Upload Section -->
                <div class="flex items-center gap-6 border-b pb-6" style="border-color: rgba(11, 37, 64, 0.08)">
                    <div class="relative">
                        <div
                            v-if="avatarPreview"
                            class="size-20 overflow-hidden rounded-full border-2 shadow-sm"
                            style="border-color: #E8770C"
                        >
                            <img :src="avatarPreview" alt="Avatar preview" class="size-full object-cover" />
                        </div>
                        <div
                            v-else
                            class="flex size-20 items-center justify-center rounded-full font-display text-xl font-bold text-white uppercase shadow-sm"
                            style="background-color: #0B2540"
                        >
                            <User class="size-8" />
                        </div>

                        <button
                            v-if="avatarPreview"
                            @click="removeAvatar"
                            type="button"
                            class="absolute -right-1 -top-1 rounded-full bg-rose-600 p-1 text-white shadow-sm hover:bg-rose-700"
                            title="Remove image"
                        >
                            <X class="size-3.5" />
                        </button>
                    </div>

                    <div>
                        <h3 class="font-display text-sm font-semibold" style="color: #0B2540">Profile Photo (Optional)</h3>
                        <p class="text-xs text-slate-500 mt-0.5">JPG, PNG, GIF, or WebP. Max file size 2MB.</p>
                        <label
                            class="mt-2 inline-flex cursor-pointer items-center gap-2 rounded-lg border px-3 py-1.5 font-body text-xs font-semibold transition-colors"
                            style="border-color: rgba(11, 37, 64, 0.2); color: #0B2540; background-color: #F8FAFC"
                            onmouseover="this.style.backgroundColor='#E2E8F0'"
                            onmouseout="this.style.backgroundColor='#F8FAFC'"
                        >
                            <Upload class="size-3.5 text-orange-600" />
                            <span>Upload Avatar</span>
                            <input type="file" accept="image/*" class="hidden" @change="handleAvatarChange" />
                        </label>
                        <p v-if="form.errors.avatar_file" class="mt-1 text-xs text-rose-600">
                            {{ form.errors.avatar_file }}
                        </p>
                    </div>
                </div>

                <!-- Main Credentials Grid -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Full Name -->
                    <div>
                        <label class="block font-body text-xs font-semibold" style="color: #0B2540">
                            Full Name <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative mt-1">
                            <User class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                            <input
                                v-model="form.name"
                                type="text"
                                required
                                placeholder="e.g. John Doe"
                                class="w-full rounded-lg py-2.5 pl-10 pr-4 font-body text-sm transition-colors focus:outline-none"
                                style="background-color: #F8FAFC; border: 1px solid rgba(11, 37, 64, 0.15); color: #0B2540"
                            />
                        </div>
                        <p v-if="form.errors.name" class="mt-1 text-xs text-rose-600">{{ form.errors.name }}</p>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label class="block font-body text-xs font-semibold" style="color: #0B2540">
                            Email Address <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative mt-1">
                            <Mail class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                            <input
                                v-model="form.email"
                                type="email"
                                required
                                placeholder="e.g. john@mercury.com"
                                class="w-full rounded-lg py-2.5 pl-10 pr-4 font-body text-sm transition-colors focus:outline-none"
                                style="background-color: #F8FAFC; border: 1px solid rgba(11, 37, 64, 0.15); color: #0B2540"
                            />
                        </div>
                        <p v-if="form.errors.email" class="mt-1 text-xs text-rose-600">{{ form.errors.email }}</p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block font-body text-xs font-semibold" style="color: #0B2540">
                            Password <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative mt-1">
                            <Lock class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                            <input
                                v-model="form.password"
                                type="password"
                                required
                                placeholder="Minimum 8 characters"
                                class="w-full rounded-lg py-2.5 pl-10 pr-4 font-body text-sm transition-colors focus:outline-none"
                                style="background-color: #F8FAFC; border: 1px solid rgba(11, 37, 64, 0.15); color: #0B2540"
                            />
                        </div>
                        <p v-if="form.errors.password" class="mt-1 text-xs text-rose-600">{{ form.errors.password }}</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block font-body text-xs font-semibold" style="color: #0B2540">
                            Confirm Password <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative mt-1">
                            <Lock class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                            <input
                                v-model="form.password_confirmation"
                                type="password"
                                required
                                placeholder="Re-enter password"
                                class="w-full rounded-lg py-2.5 pl-10 pr-4 font-body text-sm transition-colors focus:outline-none"
                                style="background-color: #F8FAFC; border: 1px solid rgba(11, 37, 64, 0.15); color: #0B2540"
                            />
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label class="block font-body text-xs font-semibold" style="color: #0B2540">
                            User Role <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative mt-1">
                            <Shield class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                            <select
                                v-model="form.role"
                                class="w-full rounded-lg py-2.5 pl-10 pr-4 font-body text-sm transition-colors focus:outline-none"
                                style="background-color: #F8FAFC; border: 1px solid rgba(11, 37, 64, 0.15); color: #0B2540"
                            >
                                <option value="content_editor">Content Editor</option>
                                <option v-if="canCreateSuperAdmin" value="super_admin">Super Admin</option>
                            </select>
                        </div>
                        <p v-if="form.errors.role" class="mt-1 text-xs text-rose-600">{{ form.errors.role }}</p>
                    </div>

                    <!-- Status Selection -->
                    <div>
                        <label class="block font-body text-xs font-semibold" style="color: #0B2540">
                            Account Status <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative mt-1">
                            <CheckCircle2 class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                            <select
                                v-model="form.status"
                                class="w-full rounded-lg py-2.5 pl-10 pr-4 font-body text-sm transition-colors focus:outline-none"
                                style="background-color: #F8FAFC; border: 1px solid rgba(11, 37, 64, 0.15); color: #0B2540"
                            >
                                <option value="active">Active (Can log in)</option>
                                <option value="inactive">Inactive (Blocked from logging in)</option>
                            </select>
                        </div>
                        <p v-if="form.errors.status" class="mt-1 text-xs text-rose-600">{{ form.errors.status }}</p>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end gap-3 border-t pt-6" style="border-color: rgba(11, 37, 64, 0.08)">
                    <Link
                        href="/admin/users"
                        class="rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-100"
                    >
                        Cancel
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="inline-flex items-center gap-2 rounded-lg px-5 py-2.5 font-display text-xs font-semibold text-white shadow-sm transition-all"
                        style="background-color: #E8770C"
                        onmouseover="this.style.backgroundColor='#d06807'"
                        onmouseout="this.style.backgroundColor='#E8770C'"
                    >
                        <Save class="size-4" />
                        <span>{{ form.processing ? 'Creating...' : 'Create Account' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
