<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { update } from '@/routes/admin/settings';

const props = defineProps<{
    settings: Record<string, string | null>;
}>();

defineOptions({
    layout: AdminLayout,
});

const activeTab = ref<'general' | 'contact' | 'social' | 'map_seo'>('general');

const form = useForm({
    settings: {
        company_name: props.settings.company_name || '',
        company_tagline: props.settings.company_tagline || '',
        company_logo: props.settings.company_logo || '',
        company_favicon: props.settings.company_favicon || '',
        contact_email: props.settings.contact_email || '',
        contact_phone: props.settings.contact_phone || '',
        contact_address: props.settings.contact_address || '',
        office_hours: props.settings.office_hours || '',
        social_linkedin: props.settings.social_linkedin || '',
        social_facebook: props.settings.social_facebook || '',
        google_maps_embed: props.settings.google_maps_embed || '',
        default_seo_title: props.settings.default_seo_title || '',
        default_seo_description: props.settings.default_seo_description || '',
    },
});

const submit = () => {
    form.put(update.url(), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Global Settings" />

    <div class="space-y-6 max-w-4xl">
        <div>
            <h1 class="text-3xl font-bold font-display text-base-content">Global Settings</h1>
            <p class="text-base-content/70">Manage global website tags, corporate addresses, contact numbers, and SEO metadata configurations.</p>
        </div>

        <!-- Success Toast/Banner -->
        <div v-if="$page.props.flash?.success" class="alert alert-success text-white rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ $page.props.flash.success }}</span>
        </div>

        <div class="bg-base-100 border border-base-300 rounded-lg overflow-hidden">
            <!-- Tabs Header -->
            <div class="flex border-b border-base-300 bg-base-200">
                <button
                    type="button"
                    @click="activeTab = 'general'"
                    class="px-6 py-3.5 text-sm font-semibold border-b-2 transition-colors duration-150"
                    :class="activeTab === 'general' ? 'border-amber text-amber bg-base-100' : 'border-transparent text-base-content/70 hover:text-base-content hover:bg-base-200/50'"
                >
                    General Info
                </button>
                <button
                    type="button"
                    @click="activeTab = 'contact'"
                    class="px-6 py-3.5 text-sm font-semibold border-b-2 transition-colors duration-150"
                    :class="activeTab === 'contact' ? 'border-amber text-amber bg-base-100' : 'border-transparent text-base-content/70 hover:text-base-content hover:bg-base-200/50'"
                >
                    Contact Info
                </button>
                <button
                    type="button"
                    @click="activeTab = 'social'"
                    class="px-6 py-3.5 text-sm font-semibold border-b-2 transition-colors duration-150"
                    :class="activeTab === 'social' ? 'border-amber text-amber bg-base-100' : 'border-transparent text-base-content/70 hover:text-base-content hover:bg-base-200/50'"
                >
                    Social Links
                </button>
                <button
                    type="button"
                    @click="activeTab = 'map_seo'"
                    class="px-6 py-3.5 text-sm font-semibold border-b-2 transition-colors duration-150"
                    :class="activeTab === 'map_seo' ? 'border-amber text-amber bg-base-100' : 'border-transparent text-base-content/70 hover:text-base-content hover:bg-base-200/50'"
                >
                    Map & SEO
                </button>
            </div>

            <!-- Form Content -->
            <form @submit.prevent="submit" class="p-6 space-y-6">
                <!-- General Info Tab -->
                <div v-show="activeTab === 'general'" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Company Name</label>
                            <input
                                v-model="form.settings.company_name"
                                type="text"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="e.g. Mercury Bangladesh"
                            />
                            <span v-if="form.errors['settings.company_name']" class="text-xs text-error mt-1">{{ form.errors['settings.company_name'] }}</span>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Company Tagline</label>
                            <input
                                v-model="form.settings.company_tagline"
                                type="text"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="e.g. Your better choice for any shipping need"
                            />
                            <span v-if="form.errors['settings.company_tagline']" class="text-xs text-error mt-1">{{ form.errors['settings.company_tagline'] }}</span>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Logo URL / Path</label>
                            <input
                                v-model="form.settings.company_logo"
                                type="text"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="e.g. /images/logo.svg"
                            />
                            <span v-if="form.errors['settings.company_logo']" class="text-xs text-error mt-1">{{ form.errors['settings.company_logo'] }}</span>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Favicon URL / Path</label>
                            <input
                                v-model="form.settings.company_favicon"
                                type="text"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="e.g. /favicon.ico"
                            />
                            <span v-if="form.errors['settings.company_favicon']" class="text-xs text-error mt-1">{{ form.errors['settings.company_favicon'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Tab -->
                <div v-show="activeTab === 'contact'" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Contact Email</label>
                            <input
                                v-model="form.settings.contact_email"
                                type="email"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="e.g. ops@mercury-bd.com"
                            />
                            <span v-if="form.errors['settings.contact_email']" class="text-xs text-error mt-1">{{ form.errors['settings.contact_email'] }}</span>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Contact Phone</label>
                            <input
                                v-model="form.settings.contact_phone"
                                type="text"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="e.g. +880 2 9876543"
                            />
                            <span v-if="form.errors['settings.contact_phone']" class="text-xs text-error mt-1">{{ form.errors['settings.contact_phone'] }}</span>
                        </div>

                        <div class="form-control md:col-span-2">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Head Office Address</label>
                            <textarea
                                v-model="form.settings.contact_address"
                                class="textarea textarea-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full h-24"
                                placeholder="House 45, Road 11, Banani, Dhaka-1213, Bangladesh"
                            ></textarea>
                            <span v-if="form.errors['settings.contact_address']" class="text-xs text-error mt-1">{{ form.errors['settings.contact_address'] }}</span>
                        </div>

                        <div class="form-control md:col-span-2">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Office Hours</label>
                            <input
                                v-model="form.settings.office_hours"
                                type="text"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="e.g. Sunday - Thursday: 09:00 AM - 06:00 PM"
                            />
                            <span v-if="form.errors['settings.office_hours']" class="text-xs text-error mt-1">{{ form.errors['settings.office_hours'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Social Links Tab -->
                <div v-show="activeTab === 'social'" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">LinkedIn Page URL</label>
                            <input
                                v-model="form.settings.social_linkedin"
                                type="url"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="https://linkedin.com/..."
                            />
                            <span v-if="form.errors['settings.social_linkedin']" class="text-xs text-error mt-1">{{ form.errors['settings.social_linkedin'] }}</span>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Facebook Page URL</label>
                            <input
                                v-model="form.settings.social_facebook"
                                type="url"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="https://facebook.com/..."
                            />
                            <span v-if="form.errors['settings.social_facebook']" class="text-xs text-error mt-1">{{ form.errors['settings.social_facebook'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Map & SEO Tab -->
                <div v-show="activeTab === 'map_seo'" class="space-y-4">
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Google Maps Embed URL</label>
                            <input
                                v-model="form.settings.google_maps_embed"
                                type="text"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="https://www.google.com/maps/embed?pb=..."
                            />
                            <span v-if="form.errors['settings.google_maps_embed']" class="text-xs text-error mt-1">{{ form.errors['settings.google_maps_embed'] }}</span>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">Default SEO Title</label>
                            <input
                                v-model="form.settings.default_seo_title"
                                type="text"
                                class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full"
                                placeholder="Enter default meta title"
                            />
                            <span v-if="form.errors['settings.default_seo_title']" class="text-xs text-error mt-1">{{ form.errors['settings.default_seo_title'] }}</span>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold text-navy text-xs uppercase tracking-wider">Default SEO Description</label>
                            <textarea
                                v-model="form.settings.default_seo_description"
                                class="textarea textarea-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full h-24"
                                placeholder="Enter default meta description"
                            ></textarea>
                            <span v-if="form.errors['settings.default_seo_description']" class="text-xs text-error mt-1">{{ form.errors['settings.default_seo_description'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-3 pt-4 border-t border-base-300">
                    <button
                        type="submit"
                        class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg px-6 font-semibold"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Saving...' : 'Save Settings' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
