<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { ArrowLeft, Save, Image as ImageIcon } from '@lucide/vue';

const props = defineProps<{
    partner: any;
}>();

defineOptions({
    layout: AdminLayout,
});

const form = useForm({
    _method: 'PUT',
    name: props.partner.name,
    logo: null as File | null,
    link: props.partner.link || '',
    order: props.partner.order,
    is_active: props.partner.is_active,
});

const previewUrl = ref<string | null>(props.partner.logo || null);

const handleLogoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0];
    if (file) {
        form.logo = file;
        previewUrl.value = URL.createObjectURL(file);
    } else {
        form.logo = null;
        previewUrl.value = props.partner.logo || null;
    }
};

const submit = () => {
    // We send a POST request with _method: 'PUT' so that PHP multipart/form-data parser parses the file correctly
    form.post(`/admin/partners/${props.partner.id}`, {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head :title="`Edit Partner: ${partner.name}`" />

    <div class="space-y-6 max-w-3xl">
        <!-- Header -->
        <div class="flex items-center gap-4">
            <Link 
                href="/admin/partners" 
                class="btn btn-outline border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-600 rounded-lg p-2.5 transition-colors"
                title="Back to list"
            >
                <ArrowLeft class="size-4" />
            </Link>
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-slate">PARTNERS CRUD</span>
                <h1 class="text-3xl font-bold font-display text-base-content mt-0.5" style="color: #0B2540;">Edit Partner</h1>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card-premium border border-slate-200 p-6 md:p-8">
            <form @submit.prevent="submit" class="space-y-6" enctype="multipart/form-data">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- Partner Name -->
                    <div class="form-control md:col-span-2">
                        <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">
                            Partner Name
                        </label>
                        <input
                            v-model="form.name"
                            type="text"
                            class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full rounded-lg"
                            placeholder="e.g. Maersk Line"
                            required
                        />
                        <span v-if="form.errors.name" class="text-xs text-error mt-1">{{ form.errors.name }}</span>
                    </div>

                    <!-- Logo Upload -->
                    <div class="form-control md:col-span-2">
                        <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">
                            Partner Logo Image
                        </label>
                        
                        <div class="flex items-start gap-4">
                            <!-- Preview Box -->
                            <div class="w-24 h-24 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-center overflow-hidden p-2 shrink-0">
                                <img 
                                    v-if="previewUrl" 
                                    :src="previewUrl" 
                                    class="max-w-full max-h-full object-contain"
                                />
                                <ImageIcon v-else class="size-8 text-slate-300" />
                            </div>

                            <!-- Upload Button & Info -->
                            <div class="space-y-1">
                                <input
                                    type="file"
                                    accept="image/*"
                                    @change="handleLogoChange"
                                    class="file-input file-input-bordered w-full max-w-xs file-input-sm focus:border-amber focus:ring-2 focus:ring-amber/20"
                                />
                                <p class="text-[11px] text-slate-400 font-body block">
                                    Supported types: JPEG, PNG, JPG, GIF, SVG, WEBP. Max size: 2MB. Leave blank to keep current logo.
                                </p>
                                <span v-if="form.errors.logo" class="text-xs text-error block mt-1">{{ form.errors.logo }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Website Link -->
                    <div class="form-control md:col-span-2">
                        <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">
                            Website URL (Optional)
                        </label>
                        <input
                            v-model="form.link"
                            type="url"
                            class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full rounded-lg"
                            placeholder="e.g. https://www.maersk.com"
                        />
                        <span v-if="form.errors.link" class="text-xs text-error mt-1">{{ form.errors.link }}</span>
                    </div>

                    <!-- Sort Order -->
                    <div class="form-control">
                        <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">
                            Sort Order
                        </label>
                        <input
                            v-model="form.order"
                            type="number"
                            class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full rounded-lg"
                            placeholder="e.g. 0, 10, 20"
                            required
                        />
                        <span v-if="form.errors.order" class="text-xs text-error mt-1">{{ form.errors.order }}</span>
                    </div>

                    <!-- Is Active -->
                    <div class="form-control md:col-span-2">
                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input
                                v-model="form.is_active"
                                type="checkbox"
                                class="checkbox border-slate-300 rounded checked:bg-amber checked:border-amber"
                            />
                            <span class="font-body text-sm font-semibold text-slate-700">Display this partner logo on the public website (Active)</span>
                        </label>
                        <span v-if="form.errors.is_active" class="text-xs text-error mt-1">{{ form.errors.is_active }}</span>
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-3 pt-5 border-t border-slate-200">
                    <Link
                        href="/admin/partners"
                        class="btn btn-outline border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-600 rounded-lg px-6 font-semibold transition-colors duration-150"
                    >
                        Cancel
                    </Link>
                    <button
                        type="submit"
                        class="btn bg-amber hover:bg-amber-dark text-white border-none rounded-lg px-6 font-semibold flex items-center gap-2 transition-colors duration-150"
                        :disabled="form.processing"
                    >
                        <Save class="size-4" />
                        <span>{{ form.processing ? 'Saving...' : 'Save Changes' }}</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</template>
