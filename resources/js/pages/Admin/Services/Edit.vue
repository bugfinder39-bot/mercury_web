<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { ArrowLeft, Save } from '@lucide/vue';

const props = defineProps<{
    service: any;
}>();

defineOptions({
    layout: AdminLayout,
});

const form = useForm({
    name: props.service?.name || '',
    icon: props.service?.icon || 'ship',
    short_description: props.service?.short_description || '',
    long_description: props.service?.long_description || '',
    order: props.service?.order ?? 0,
    is_active: props.service?.is_active ?? true,
});

const submit = () => {
    form.put(`/admin/services/${props.service.id}`, {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Edit Service" />

    <div class="space-y-6 max-w-3xl">
        <!-- Header -->
        <div class="flex items-center gap-4">
            <Link 
                href="/admin/services" 
                class="btn btn-outline border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-600 rounded-lg p-2.5 transition-colors"
                title="Back to list"
            >
                <ArrowLeft class="size-4" />
            </Link>
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-slate">SERVICES CRUD</span>
                <h1 class="text-3xl font-bold font-display text-base-content mt-0.5" style="color: #0B2540;">Edit Service</h1>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card-premium border border-slate-200 p-6 md:p-8">
            <form @submit.prevent="submit" class="space-y-6">
                
                <!-- General Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- Service Name -->
                    <div class="form-control md:col-span-2">
                        <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">
                            Service Name
                        </label>
                        <input
                            v-model="form.name"
                            type="text"
                            class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full rounded-lg"
                            placeholder="e.g. Ocean Freight forwarding"
                            required
                        />
                        <span v-if="form.errors.name" class="text-xs text-error mt-1">{{ form.errors.name }}</span>
                    </div>

                    <!-- Icon -->
                    <div class="form-control">
                        <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">
                            Icon Name (Lucide Icon slug)
                        </label>
                        <input
                            v-model="form.icon"
                            type="text"
                            class="input input-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full rounded-lg font-mono text-sm"
                            placeholder="e.g. ship, plane, truck, package, warehouse"
                        />
                        <span class="text-[11px] text-slate-400 mt-1 font-body">Use standard Lucide names: <code>ship</code>, <code>plane</code>, <code>truck</code>, <code>package</code>, <code>warehouse</code>, <code>file-text</code>.</span>
                        <span v-if="form.errors.icon" class="text-xs text-error mt-1">{{ form.errors.icon }}</span>
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

                    <!-- Short Description -->
                    <div class="form-control md:col-span-2">
                        <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">
                            Short Description
                        </label>
                        <textarea
                            v-model="form.short_description"
                            class="textarea textarea-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full h-20 rounded-lg"
                            placeholder="A brief summary shown on listing cards..."
                        ></textarea>
                        <span v-if="form.errors.short_description" class="text-xs text-error mt-1">{{ form.errors.short_description }}</span>
                    </div>

                    <!-- Long Description -->
                    <div class="form-control md:col-span-2">
                        <label class="label font-semibold text-base-content text-xs uppercase tracking-wider">
                            Detailed Description / Text content
                        </label>
                        <textarea
                            v-model="form.long_description"
                            class="textarea textarea-bordered focus:border-amber focus:ring-2 focus:ring-amber/20 w-full h-40 rounded-lg"
                            placeholder="Full service overview and technical details..."
                        ></textarea>
                        <span v-if="form.errors.long_description" class="text-xs text-error mt-1">{{ form.errors.long_description }}</span>
                    </div>

                    <!-- Is Active -->
                    <div class="form-control md:col-span-2">
                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input
                                v-model="form.is_active"
                                type="checkbox"
                                class="checkbox border-slate-300 rounded checked:bg-amber checked:border-amber"
                            />
                            <span class="font-body text-sm font-semibold text-slate-700">Display this service on the public website (Active)</span>
                        </label>
                        <span v-if="form.errors.is_active" class="text-xs text-error mt-1">{{ form.errors.is_active }}</span>
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-3 pt-5 border-t border-slate-200">
                    <Link
                        href="/admin/services"
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
                        <span>{{ form.processing ? 'Saving...' : 'Update Service' }}</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</template>
