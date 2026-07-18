<script setup lang="ts">
import { ref, computed, watch } from 'vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { update as updatePage } from '@/routes/admin/pages';
import { update as updateSectionRoute } from '@/routes/admin/sections';
import { store as storeSectionItemRoute } from '@/routes/admin/sections/items';
import { update as updateSectionItemRoute, destroy as destroySectionItemRoute } from '@/routes/admin/section-items';
import {
    Save, ArrowLeft, Layers, Settings, Eye, EyeOff,
    Plus, Trash2, Edit, ChevronDown, ChevronUp, Image
} from '@lucide/vue';

const props = defineProps<{
    page: any;
    sections: any[];
}>();

defineOptions({
    layout: AdminLayout,
});

// Tab Management
const activeTab = ref('sections'); // 'seo' or 'sections'

// Active section accordion index
const expandedSectionId = ref<number | null>(props.sections[0]?.id || null);

const currentSection = computed(() => {
    if (addingItemToSectionId.value) {
        return props.sections.find(sec => sec.id === addingItemToSectionId.value);
    }
    if (editingItem.value) {
        return props.sections.find(sec => sec.id === editingItem.value.section_id);
    }
    return null;
});

const sectionType = computed(() => currentSection.value?.type || '');

const toggleSection = (id: number) => {
    if (expandedSectionId.value === id) {
        expandedSectionId.value = null;
    } else {
        expandedSectionId.value = id;
    }
};

// SEO Form
const seoForm = useForm({
    name: props.page.name,
    meta_title: props.page.meta_title || '',
    meta_description: props.page.meta_description || '',
    og_image: props.page.og_image || '',
});

const submitSeo = () => {
    seoForm.put(updatePage(props.page.id).url, {
        preserveScroll: true,
    });
};

// Section Forms Map & States
const sectionForms = ref<Record<number, any>>({});
const sectionPreviews = ref<Record<number, { portrait?: string, signature?: string, ctaBg?: string }>>({});
const sectionErrors = ref<Record<number, any>>({});

watch(() => props.sections, (newSections) => {
    newSections.forEach(sec => {
        if (!sectionForms.value[sec.id]) {
            sectionForms.value[sec.id] = {};
        }
        
        const existingForm = sectionForms.value[sec.id] || {};
        
        sectionForms.value[sec.id] = {
            heading: sec.heading || '',
            subheading: sec.subheading || '',
            body: sec.body || '',
            is_active: sec.is_active,
            order: sec.order,
            // CEO fields
            ceo_rich_text: sec.ceo_rich_text || '',
            ceo_name: sec.ceo_name || '',
            ceo_designation: sec.ceo_designation || '',
            signature_media_id: sec.signature_media_id || '',
            portrait_media_id: sec.portrait_media_id || '',
            ceo_cta_button_text: sec.ceo_cta_button_text || '',
            ceo_cta_button_url: sec.ceo_cta_button_url || '',
            // CTA fields
            cta_banner_heading: sec.cta_banner_heading || '',
            cta_banner_subheading: sec.cta_banner_subheading || '',
            cta_background_media_id: sec.cta_background_media_id || '',
            cta_primary_btn_text: sec.cta_primary_btn_text || '',
            cta_primary_btn_url: sec.cta_primary_btn_url || '',
            cta_secondary_btn_text: sec.cta_secondary_btn_text || '',
            cta_secondary_btn_url: sec.cta_secondary_btn_url || '',
            // File Uploads
            portrait_media_file: existingForm.portrait_media_file || null,
            signature_media_file: existingForm.signature_media_file || null,
            cta_background_media_file: existingForm.cta_background_media_file || null,
            delete_portrait_media: existingForm.delete_portrait_media || false,
            delete_signature_media: existingForm.delete_signature_media || false,
            delete_cta_background_media: existingForm.delete_cta_background_media || false,
        };

        if (!sectionPreviews.value[sec.id]) {
            sectionPreviews.value[sec.id] = {};
        }

        if (!existingForm.portrait_media_file) {
            sectionPreviews.value[sec.id].portrait = sec.portrait_media?.file_path || '';
        }
        if (!existingForm.signature_media_file) {
            sectionPreviews.value[sec.id].signature = sec.signature_media?.file_path || '';
        }
        if (!existingForm.cta_background_media_file) {
            sectionPreviews.value[sec.id].ctaBg = sec.cta_background_media?.file_path || '';
        }

        if (!sectionErrors.value[sec.id]) {
            sectionErrors.value[sec.id] = {};
        }
    });
}, { deep: true, immediate: true });

const handleSectionFileChange = (e: Event, sectionId: number, field: string) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0];
    if (file) {
        sectionForms.value[sectionId][field] = file;
        
        if (field === 'portrait_media_file') {
            sectionPreviews.value[sectionId].portrait = URL.createObjectURL(file);
            sectionForms.value[sectionId].delete_portrait_media = false;
        } else if (field === 'signature_media_file') {
            sectionPreviews.value[sectionId].signature = URL.createObjectURL(file);
            sectionForms.value[sectionId].delete_signature_media = false;
        } else if (field === 'cta_background_media_file') {
            sectionPreviews.value[sectionId].ctaBg = URL.createObjectURL(file);
            sectionForms.value[sectionId].delete_cta_background_media = false;
        }
    }
};

const removeSectionImage = (sectionId: number, field: string) => {
    if (field === 'portrait') {
        sectionForms.value[sectionId].portrait_media_file = null;
        sectionForms.value[sectionId].delete_portrait_media = true;
        sectionPreviews.value[sectionId].portrait = '';
    } else if (field === 'signature') {
        sectionForms.value[sectionId].signature_media_file = null;
        sectionForms.value[sectionId].delete_signature_media = true;
        sectionPreviews.value[sectionId].signature = '';
    } else if (field === 'ctaBg') {
        sectionForms.value[sectionId].cta_background_media_file = null;
        sectionForms.value[sectionId].delete_cta_background_media = true;
        sectionPreviews.value[sectionId].ctaBg = '';
    }
};

const submitSection = (section: any) => {
    const rawData = sectionForms.value[section.id];
    const formData = new FormData();
    formData.append('_method', 'PUT');
    
    Object.keys(rawData).forEach(key => {
        const val = rawData[key];
        if (val !== null && val !== undefined) {
            if (typeof val === 'boolean') {
                formData.append(key, val ? '1' : '0');
            } else {
                formData.append(key, val);
            }
        }
    });

    sectionErrors.value[section.id] = {};

    router.post(updateSectionRoute(section.id).url, formData, {
        preserveScroll: true,
        onError: (errors) => {
            sectionErrors.value[section.id] = errors;
        },
        onSuccess: () => {
            sectionErrors.value[section.id] = {};
            // Reset local file selection states
            sectionForms.value[section.id].portrait_media_file = null;
            sectionForms.value[section.id].signature_media_file = null;
            sectionForms.value[section.id].cta_background_media_file = null;
            sectionForms.value[section.id].delete_portrait_media = false;
            sectionForms.value[section.id].delete_signature_media = false;
            sectionForms.value[section.id].delete_cta_background_media = false;
        }
    });
};

// Repeatable item modals / edit state
const editingItem = ref<any | null>(null);
const addingItemToSectionId = ref<number | null>(null);
const itemPreviewUrl = ref<string>('');

const itemForm = useForm({
    title: '',
    subtitle: '',
    description: '',
    value: '',
    icon: '',
    link: '',
    order: 0,
    is_active: true,
    image_media_file: null as File | null,
    delete_image_media: false,
});

const openAddItem = (sectionId: number) => {
    addingItemToSectionId.value = sectionId;
    editingItem.value = null;
    itemForm.reset();
    itemForm.order = 0;
    itemForm.is_active = true;
    itemPreviewUrl.value = '';
};

const openEditItem = (item: any) => {
    editingItem.value = item;
    addingItemToSectionId.value = null;
    itemForm.title = item.title || '';
    itemForm.subtitle = item.subtitle || '';
    itemForm.description = item.description || '';
    itemForm.value = item.value || '';
    itemForm.icon = item.icon || '';
    itemForm.link = item.link || '';
    itemForm.order = item.order;
    itemForm.is_active = item.is_active;
    itemForm.image_media_file = null;
    itemForm.delete_image_media = false;
    itemPreviewUrl.value = item.image_media?.file_path || item.value || '';
};

const handleItemFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0];
    if (file) {
        itemForm.image_media_file = file;
        itemPreviewUrl.value = URL.createObjectURL(file);
        itemForm.delete_image_media = false;
    }
};

const removeItemImage = () => {
    itemForm.image_media_file = null;
    itemForm.delete_image_media = true;
    itemPreviewUrl.value = '';
};

const saveItem = () => {
    if (editingItem.value) {
        itemForm.transform((data) => ({
            ...data,
            _method: 'PUT',
            is_active: data.is_active ? '1' : '0',
            delete_image_media: data.delete_image_media ? '1' : '0',
        })).post(updateSectionItemRoute(editingItem.value.id).url, {
            preserveScroll: true,
            onSuccess: () => {
                editingItem.value = null;
            }
        });
    } else if (addingItemToSectionId.value) {
        itemForm.transform((data) => ({
            ...data,
            is_active: data.is_active ? '1' : '0',
        })).post(storeSectionItemRoute(addingItemToSectionId.value).url, {
            preserveScroll: true,
            onSuccess: () => {
                addingItemToSectionId.value = null;
            }
        });
    }
};

const deleteItem = (itemId: number) => {
    if (confirm('Are you sure you want to delete this item?')) {
        router.delete(destroySectionItemRoute(itemId).url, {
            preserveScroll: true,
        });
    }
};

const toggleSectionActive = (section: any) => {
    const nextActive = !section.is_active;
    sectionForms.value[section.id].is_active = nextActive;
    
    const rawData = sectionForms.value[section.id];
    const formData = new FormData();
    formData.append('_method', 'PUT');
    Object.keys(rawData).forEach(key => {
        const val = rawData[key];
        if (val !== null && val !== undefined) {
            if (typeof val === 'boolean') {
                formData.append(key, val ? '1' : '0');
            } else {
                formData.append(key, val);
            }
        }
    });
    router.post(updateSectionRoute(section.id).url, formData, {
        preserveScroll: true,
    });
};

// Reordering logic
const draggedSection = ref<any>(null);

const onDragStart = (e: DragEvent, section: any) => {
    draggedSection.value = section;
    if (e.dataTransfer) {
        e.dataTransfer.effectAllowed = 'move';
    }
};

const onDrop = (e: DragEvent, targetSection: any) => {
    if (!draggedSection.value || draggedSection.value.id === targetSection.id) return;
    
    // Swap their order in our forms state
    const tempOrder = sectionForms.value[draggedSection.value.id].order;
    sectionForms.value[draggedSection.value.id].order = sectionForms.value[targetSection.id].order;
    sectionForms.value[targetSection.id].order = tempOrder;

    // Submit both sections
    submitSection(draggedSection.value);
    submitSection(targetSection);
    
    draggedSection.value = null;
};

const moveSectionUp = (section: any) => {
    const idx = props.sections.findIndex(s => s.id === section.id);
    if (idx > 0) {
        const otherSection = props.sections[idx - 1];
        
        const tempOrder = sectionForms.value[section.id].order;
        sectionForms.value[section.id].order = sectionForms.value[otherSection.id].order;
        sectionForms.value[otherSection.id].order = tempOrder;

        submitSection(section);
        submitSection(otherSection);
    }
};

const moveSectionDown = (section: any) => {
    const idx = props.sections.findIndex(s => s.id === section.id);
    if (idx < props.sections.length - 1) {
        const otherSection = props.sections[idx + 1];
        
        const tempOrder = sectionForms.value[section.id].order;
        sectionForms.value[section.id].order = sectionForms.value[otherSection.id].order;
        sectionForms.value[otherSection.id].order = tempOrder;

        submitSection(section);
        submitSection(otherSection);
    }
};
</script>

<template>
    <Head :title="`Edit Page: ${page.name}`" />

    <div class="space-y-6">
        <!-- Breadcrumbs & Actions Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <Link href="/admin/pages" class="inline-flex items-center gap-1.5 text-xs font-mono uppercase tracking-wider mb-2" style="color: #E8770C;">
                    <ArrowLeft class="size-3.5" />
                    <span>Back to Page list</span>
                </Link>
                <h1 class="text-3xl font-bold font-display" style="color: #0B2540;">Edit Page: {{ page.name }}</h1>
                <p class="text-sm font-body" style="color: #64748B;">Manage content sections, layouts, and page settings.</p>
            </div>
            <a :href="`/${page.slug === 'home' ? '' : page.slug}`" target="_blank" class="btn-secondary self-start">
                <Eye class="size-4" style="color: #E8770C;" />
                <span>Preview Page</span>
            </a>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex border-b border-base-300">
            <button
                @click="activeTab = 'sections'"
                class="px-6 py-3 font-display font-semibold text-sm flex items-center gap-2 border-b-2 transition-colors duration-150"
                :class="activeTab === 'sections' ? 'border-[#E8770C] text-[#0B2540]' : 'border-transparent text-slate-500 hover:text-slate-800'"
            >
                <Layers class="size-4" />
                <span>Page Sections</span>
            </button>
            <button
                @click="activeTab = 'seo'"
                class="px-6 py-3 font-display font-semibold text-sm flex items-center gap-2 border-b-2 transition-colors duration-150"
                :class="activeTab === 'seo' ? 'border-[#E8770C] text-[#0B2540]' : 'border-transparent text-slate-500 hover:text-slate-800'"
            >
                <Settings class="size-4" />
                <span>SEO & Meta Settings</span>
            </button>
        </div>

        <!-- SEO TAB CONTENT -->
        <div v-if="activeTab === 'seo'" class="card-premium max-w-3xl">
            <h2 class="text-xl font-bold font-display mb-4" style="color: #0B2540;">Page Details & Metadata</h2>
            <form @submit.prevent="submitSeo" class="space-y-4">
                <div>
                    <label class="label-premium">Page Name</label>
                    <input v-model="seoForm.name" type="text" class="input-premium" required />
                </div>
                <div>
                    <label class="label-premium">Meta Title</label>
                    <input v-model="seoForm.meta_title" type="text" class="input-premium" placeholder="Recommended: 50-60 characters" />
                </div>
                <div>
                    <label class="label-premium">Meta Description</label>
                    <textarea v-model="seoForm.meta_description" class="input-premium h-24" placeholder="Recommended: 150-160 characters"></textarea>
                </div>
                <div>
                    <label class="label-premium">OG Image Path</label>
                    <input v-model="seoForm.og_image" type="text" class="input-premium" placeholder="e.g. /images/share-banner.jpg" />
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn-primary" :disabled="seoForm.processing">
                        <Save class="size-4" />
                        <span>Save SEO Settings</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- SECTIONS TAB CONTENT -->
        <div v-if="activeTab === 'sections'" class="space-y-4">
            <div
                v-for="section in sections"
                :key="section.id"
                class="card-premium p-0 overflow-hidden"
                draggable="true"
                @dragstart="onDragStart($event, section)"
                @dragover.prevent
                @drop="onDrop($event, section)"
            >
                <!-- Section Accordion Header -->
                <div
                    class="p-4 flex items-center justify-between cursor-pointer transition-colors"
                    :style="expandedSectionId === section.id ? 'background-color: #F8FAFC; border-bottom: 1px solid rgba(11,37,64,0.07);' : ''"
                    @click="toggleSection(section.id)"
                >
                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            @click.stop="toggleSectionActive(section)"
                            class="p-1 rounded hover:bg-base-200"
                            :title="section.is_active ? 'Deactivate Section' : 'Activate Section'"
                        >
                            <Eye v-if="section.is_active" class="size-4" style="color: #1F7A5C;" />
                            <EyeOff v-else class="size-4" style="color: #64748B;" />
                        </button>
                        <div class="cursor-grab active:cursor-grabbing flex items-center gap-2">
                            <span class="text-slate-300 font-bold select-none text-lg">⋮⋮</span>
                            <div>
                                <span class="eyebrow-orange block mb-0.5">{{ section.subheading || section.type.replace('_', ' ') }}</span>
                                <h3 class="font-display font-bold text-base md:text-lg" style="color: #0B2540;">
                                    {{ section.heading || 'Untitled Section' }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3" @click.stop>
                        <button
                            type="button"
                            @click="moveSectionUp(section)"
                            class="p-1 hover:bg-base-200 rounded"
                            title="Move Up"
                        >
                            <ChevronUp class="size-4 text-slate-600" />
                        </button>
                        <button
                            type="button"
                            @click="moveSectionDown(section)"
                            class="p-1 hover:bg-base-200 rounded"
                            title="Move Down"
                        >
                            <ChevronDown class="size-4 text-slate-600" />
                        </button>
                        <span class="font-mono text-xs text-muted uppercase tracking-wider">Order: {{ section.order }}</span>
                        <button type="button" @click="toggleSection(section.id)" class="p-1 rounded hover:bg-base-200">
                            <ChevronDown v-if="expandedSectionId !== section.id" class="size-5 text-slate-500" />
                            <ChevronUp v-else class="size-5 text-slate-500" />
                        </button>
                    </div>
                </div>

                <!-- Section Edit Fields Form -->
                <div v-show="expandedSectionId === section.id" class="p-6 space-y-6">
                    <form @submit.prevent="submitSection(section)" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Standard inputs -->
                        <div class="md:col-span-2">
                            <label class="label-premium">Heading</label>
                            <input v-model="sectionForms[section.id].heading" type="text" class="input-premium" />
                            <span v-if="sectionErrors[section.id]?.heading" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].heading }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <label class="label-premium">Subheading</label>
                            <input v-model="sectionForms[section.id].subheading" type="text" class="input-premium" />
                            <span v-if="sectionErrors[section.id]?.subheading" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].subheading }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <label class="label-premium">Body Text</label>
                            <textarea v-model="sectionForms[section.id].body" class="input-premium h-28"></textarea>
                            <span v-if="sectionErrors[section.id]?.body" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].body }}</span>
                        </div>
                        <div>
                            <label class="label-premium">Order</label>
                            <input v-model="sectionForms[section.id].order" type="number" class="input-premium" required />
                            <span v-if="sectionErrors[section.id]?.order" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].order }}</span>
                        </div>
                        <div>
                            <label class="label-premium">Status</label>
                            <select v-model="sectionForms[section.id].is_active" class="input-premium">
                                <option :value="true">Active</option>
                                <option :value="false">Inactive</option>
                            </select>
                            <span v-if="sectionErrors[section.id]?.is_active" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].is_active }}</span>
                        </div>

                        <!-- Dynamic Specific Section fields: CEO Message -->
                        <template v-if="section.type === 'ceo_message'">
                            <div class="md:col-span-2 border-t border-base-200 pt-4 mt-2">
                                <h4 class="font-display font-semibold text-sm mb-3" style="color: #0B2540;">CEO Message Details</h4>
                            </div>
                            <div class="md:col-span-2">
                                <label class="label-premium">CEO Rich Text Message</label>
                                <textarea v-model="sectionForms[section.id].ceo_rich_text" class="input-premium h-24" placeholder="Message from the CEO..."></textarea>
                                <span v-if="sectionErrors[section.id]?.ceo_rich_text" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].ceo_rich_text }}</span>
                            </div>
                            <div>
                                <label class="label-premium">CEO Name</label>
                                <input v-model="sectionForms[section.id].ceo_name" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.ceo_name" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].ceo_name }}</span>
                            </div>
                            <div>
                                <label class="label-premium">CEO Designation</label>
                                <input v-model="sectionForms[section.id].ceo_designation" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.ceo_designation" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].ceo_designation }}</span>
                            </div>
                            <div>
                                <label class="label-premium">CEO CTA Button Text</label>
                                <input v-model="sectionForms[section.id].ceo_cta_button_text" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.ceo_cta_button_text" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].ceo_cta_button_text }}</span>
                            </div>
                            <div>
                                <label class="label-premium">CEO CTA Button URL</label>
                                <input v-model="sectionForms[section.id].ceo_cta_button_url" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.ceo_cta_button_url" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].ceo_cta_button_url }}</span>
                            </div>
                            
                            <!-- Portrait Upload -->
                            <div class="space-y-2">
                                <label class="label-premium">CEO Portrait Image</label>
                                <div class="flex items-center gap-4">
                                    <div v-if="sectionPreviews[section.id].portrait" class="size-16 rounded overflow-hidden border border-base-200 bg-base-50">
                                        <img :src="sectionPreviews[section.id].portrait" alt="CEO Portrait Preview" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" @change="handleSectionFileChange($event, section.id, 'portrait_media_file')" class="file-input file-input-bordered w-full max-w-xs text-xs" accept="image/*" />
                                        <button v-if="sectionPreviews[section.id].portrait" type="button" @click="removeSectionImage(section.id, 'portrait')" class="text-xs text-red-600 block mt-1 hover:underline">Remove Image</button>
                                    </div>
                                </div>
                                <span v-if="sectionErrors[section.id]?.portrait_media_file" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].portrait_media_file }}</span>
                            </div>

                            <!-- Signature Upload -->
                            <div class="space-y-2">
                                <label class="label-premium">CEO Signature Image</label>
                                <div class="flex items-center gap-4">
                                    <div v-if="sectionPreviews[section.id].signature" class="h-10 w-24 rounded border border-base-200 bg-base-50 flex items-center justify-center p-1">
                                        <img :src="sectionPreviews[section.id].signature" alt="CEO Signature Preview" class="max-h-full max-w-full object-contain" />
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" @change="handleSectionFileChange($event, section.id, 'signature_media_file')" class="file-input file-input-bordered w-full max-w-xs text-xs" accept="image/*" />
                                        <button v-if="sectionPreviews[section.id].signature" type="button" @click="removeSectionImage(section.id, 'signature')" class="text-xs text-red-600 block mt-1 hover:underline">Remove Image</button>
                                    </div>
                                </div>
                                <span v-if="sectionErrors[section.id]?.signature_media_file" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].signature_media_file }}</span>
                            </div>
                        </template>

                        <!-- Dynamic Specific Section fields: CTA Banner -->
                        <template v-if="section.type === 'cta_banner'">
                            <div class="md:col-span-2 border-t border-base-200 pt-4 mt-2">
                                <h4 class="font-display font-semibold text-sm mb-3" style="color: #0B2540;">CTA Banner Details</h4>
                            </div>
                            <div>
                                <label class="label-premium">CTA Banner Heading</label>
                                <input v-model="sectionForms[section.id].cta_banner_heading" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.cta_banner_heading" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].cta_banner_heading }}</span>
                            </div>
                            <div>
                                <label class="label-premium">CTA Banner Subheading</label>
                                <input v-model="sectionForms[section.id].cta_banner_subheading" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.cta_banner_subheading" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].cta_banner_subheading }}</span>
                            </div>
                            <div>
                                <label class="label-premium">CTA Primary Button Text</label>
                                <input v-model="sectionForms[section.id].cta_primary_btn_text" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.cta_primary_btn_text" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].cta_primary_btn_text }}</span>
                            </div>
                            <div>
                                <label class="label-premium">CTA Primary Button URL</label>
                                <input v-model="sectionForms[section.id].cta_primary_btn_url" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.cta_primary_btn_url" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].cta_primary_btn_url }}</span>
                            </div>
                            <div>
                                <label class="label-premium">CTA Secondary Button Text</label>
                                <input v-model="sectionForms[section.id].cta_secondary_btn_text" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.cta_secondary_btn_text" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].cta_secondary_btn_text }}</span>
                            </div>
                            <div>
                                <label class="label-premium">CTA Secondary Button URL</label>
                                <input v-model="sectionForms[section.id].cta_secondary_btn_url" type="text" class="input-premium" />
                                <span v-if="sectionErrors[section.id]?.cta_secondary_btn_url" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].cta_secondary_btn_url }}</span>
                            </div>
                            
                            <!-- Background Image Upload -->
                            <div class="md:col-span-2 space-y-2">
                                <label class="label-premium">CTA Banner Background Image</label>
                                <div class="flex items-center gap-4">
                                    <div v-if="sectionPreviews[section.id].ctaBg" class="h-20 w-40 rounded overflow-hidden border border-base-200 bg-base-50">
                                        <img :src="sectionPreviews[section.id].ctaBg" alt="CTA Background Preview" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" @change="handleSectionFileChange($event, section.id, 'cta_background_media_file')" class="file-input file-input-bordered w-full max-w-xs text-xs" accept="image/*" />
                                        <button v-if="sectionPreviews[section.id].ctaBg" type="button" @click="removeSectionImage(section.id, 'ctaBg')" class="text-xs text-red-600 block mt-1 hover:underline">Remove Image</button>
                                    </div>
                                </div>
                                <span v-if="sectionErrors[section.id]?.cta_background_media_file" class="text-xs text-red-500 mt-1 block">{{ sectionErrors[section.id].cta_background_media_file }}</span>
                            </div>
                        </template>

                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="btn-primary">
                                <Save class="size-4" />
                                <span>Save Section Details</span>
                            </button>
                        </div>
                    </form>

                    <!-- Repeatable Items (Section items) -->
                    <div class="border-t border-base-200 pt-6 mt-4">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h4 class="font-display font-bold text-sm" style="color: #0B2540;">Repeatable Section Items / Blocks</h4>
                                <p class="text-xs text-muted font-body">Add and configure tiles, slides, statistics, or timeline milestones.</p>
                                <p v-if="section.type === 'image_text_showcase' || section.type === 'operational_excellence'" class="text-xs text-amber-700 font-body mt-1">
                                    💡 <strong>Setup Guide:</strong> Add an item with Title: <code>Image</code> &amp; Value: image path. Add an item with Title: <code>Position</code> &amp; Value: <code>left</code> or <code>right</code>. Add other items for bullet points.
                                </p>
                                <p v-if="section.type === 'logistics_image_banner'" class="text-xs text-amber-700 font-body mt-1">
                                    💡 <strong>Setup Guide:</strong> Add an item with Title: <code>Background</code> &amp; Value: image path. Add an item with Title: <code>CTA</code>, Description: button text, Link: button URL.
                                </p>
                            </div>
                            <button
                                type="button"
                                @click="openAddItem(section.id)"
                                class="btn-primary py-1.5 px-3 text-xs"
                            >
                                <Plus class="size-3.5" />
                                <span>Add New Item</span>
                            </button>
                        </div>

                        <!-- Items List Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div
                                v-for="item in section.items"
                                :key="item.id"
                                class="border border-base-200 rounded-lg p-4 bg-base-50 flex flex-col justify-between"
                            >
                                <div>
                                    <div class="flex justify-between items-start gap-2 mb-2">
                                        <h5 class="font-display font-bold text-sm truncate text-[#0B2540]">{{ item.title || 'No Title' }}</h5>
                                        <span
                                            class="px-2 py-0.5 rounded-full text-[10px] font-mono font-semibold uppercase"
                                            :style="item.is_active ? 'background-color: rgba(31,122,92,0.1); color: #1F7A5C;' : 'background-color: rgba(100,116,139,0.1); color: #64748B;'"
                                        >
                                            {{ item.is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-muted font-body line-clamp-2 mb-3">{{ item.description || 'No Description' }}</p>
                                    <div class="text-[11px] font-mono space-y-1 text-secondary-txt">
                                        <div v-if="item.subtitle"><span class="text-muted">Sub:</span> {{ item.subtitle }}</div>
                                        <div v-if="item.value"><span class="text-muted">Val:</span> {{ item.value }}</div>
                                        <div v-if="item.icon"><span class="text-muted">Icon:</span> {{ item.icon }}</div>
                                        <div v-if="item.link"><span class="text-muted">Link:</span> {{ item.link }}</div>
                                        <div><span class="text-muted">Order:</span> {{ item.order }}</div>
                                    </div>
                                </div>

                                <div class="flex justify-end gap-2 mt-4 pt-3 border-t border-base-100">
                                    <button
                                        type="button"
                                        @click="openEditItem(item)"
                                        class="btn-ghost py-1 px-2.5 text-xs inline-flex items-center gap-1 text-[#E8770C]"
                                    >
                                        <Edit class="size-3" />
                                        <span>Edit</span>
                                    </button>
                                    <button
                                        type="button"
                                        @click="deleteItem(item.id)"
                                        class="btn-ghost py-1 px-2.5 text-xs inline-flex items-center gap-1 text-red-600 hover:bg-red-50"
                                    >
                                        <Trash2 class="size-3" />
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </div>

                            <div
                                v-if="!section.items || section.items.length === 0"
                                class="col-span-full py-8 text-center border border-dashed border-base-300 rounded-lg text-sm text-muted font-body"
                            >
                                No repeatable items configured for this section.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add/Edit Section Item Dialog / Form Overlay -->
        <div v-if="editingItem || addingItemToSectionId" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-in fade-in duration-200">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto space-y-4 border border-base-200">
                <h3 class="font-display font-bold text-lg" style="color: #0B2540;">
                    {{ editingItem ? 'Edit Repeatable Item' : 'Add New Repeatable Item' }}
                </h3>

                <form @submit.prevent="saveItem" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="label-premium">
                                {{ 
                                    sectionType === 'image_gallery' ? 'Image Caption / Title' : 
                                    sectionType === 'testimonials' ? 'Customer Name' : 
                                    sectionType === 'company_highlights' ? 'Metric Name' : 
                                    sectionType === 'working_process' ? 'Step Title' : 'Title' 
                                }}
                            </label>
                            <input v-model="itemForm.title" type="text" class="input-premium" />
                            <span v-if="itemForm.errors.title" class="text-xs text-red-500 mt-1 block">{{ itemForm.errors.title }}</span>
                        </div>
                        <div v-if="sectionType !== 'image_gallery' && sectionType !== 'working_process' && sectionType !== 'businesses_trust'">
                            <label class="label-premium">
                                {{ 
                                    sectionType === 'testimonials' ? 'Company Name' : 'Subtitle' 
                                }}
                            </label>
                            <input v-model="itemForm.subtitle" type="text" class="input-premium" />
                            <span v-if="itemForm.errors.subtitle" class="text-xs text-red-500 mt-1 block">{{ itemForm.errors.subtitle }}</span>
                        </div>
                        <div v-if="sectionType !== 'businesses_trust'">
                            <label class="label-premium">
                                {{ 
                                    sectionType === 'image_gallery' ? 'Image URL / Path' : 
                                    sectionType === 'testimonials' ? 'Rating (1-5)' : 
                                    sectionType === 'company_highlights' ? 'Metric Value' : 
                                    sectionType === 'working_process' ? 'Step Number (optional)' : 'Value' 
                                }}
                            </label>
                            <input v-model="itemForm.value" type="text" class="input-premium" :placeholder="sectionType === 'image_gallery' ? 'e.g. /images/gallery/pic.jpg' : 'e.g. 15, 99%'" />
                            <span v-if="itemForm.errors.value" class="text-xs text-red-500 mt-1 block">{{ itemForm.errors.value }}</span>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="label-premium">
                                {{ 
                                    sectionType === 'testimonials' ? 'Testimonial Quote' : 'Description' 
                                }}
                            </label>
                            <textarea v-model="itemForm.description" class="input-premium h-20"></textarea>
                            <span v-if="itemForm.errors.description" class="text-xs text-red-500 mt-1 block">{{ itemForm.errors.description }}</span>
                        </div>
                        <div v-if="sectionType !== 'image_gallery'">
                            <label class="label-premium">
                                {{ 
                                    sectionType === 'testimonials' ? 'Customer Photo URL' : 'Icon Name (Lucide)' 
                                }}
                            </label>
                            <input v-model="itemForm.icon" type="text" class="input-premium" :placeholder="sectionType === 'testimonials' ? 'e.g. /images/avatar1.jpg' : 'Lucide icon name (e.g. Eye, Compass)'" />
                            <span v-if="itemForm.errors.icon" class="text-xs text-red-500 mt-1 block">{{ itemForm.errors.icon }}</span>
                        </div>
                        <div v-if="sectionType === 'hero_carousel' || sectionType === 'about_us' || sectionType === 'testimonials' || sectionType === 'image_text_showcase' || sectionType === 'operational_excellence' || sectionType === 'logistics_image_banner'">
                            <label class="label-premium">
                                {{ 
                                    sectionType === 'testimonials' ? 'Customer Designation' : 'Link URL' 
                                }}
                            </label>
                            <input v-model="itemForm.link" type="text" class="input-premium" :placeholder="sectionType === 'testimonials' ? 'e.g. Logistics Director' : 'e.g. /services'" />
                            <span v-if="itemForm.errors.link" class="text-xs text-red-500 mt-1 block">{{ itemForm.errors.link }}</span>
                        </div>
                        <!-- File upload for item image (e.g. Gallery, Testimonials photo, Showcase image, etc.) -->
                        <div class="sm:col-span-2 border-t border-base-100 pt-3 mt-1">
                            <label class="label-premium">Upload Item Image (Overrides URL/Path if uploaded)</label>
                            <div class="flex items-center gap-4">
                                <div v-if="itemPreviewUrl" class="size-16 rounded overflow-hidden border border-base-200 bg-base-50 flex items-center justify-center p-1">
                                    <img :src="itemPreviewUrl" alt="Item Image Preview" class="max-h-full max-w-full object-cover" />
                                </div>
                                <div class="flex-1">
                                    <input type="file" @change="handleItemFileChange" class="file-input file-input-bordered w-full max-w-xs text-xs" accept="image/*" />
                                    <button v-if="itemPreviewUrl" type="button" @click="removeItemImage" class="text-xs text-red-600 block mt-1 hover:underline">Remove Image</button>
                                </div>
                            </div>
                            <span v-if="itemForm.errors.image_media_file" class="text-xs text-red-500 mt-1 block">{{ itemForm.errors.image_media_file }}</span>
                        </div>

                        <div>
                            <label class="label-premium">Order</label>
                            <input v-model="itemForm.order" type="number" class="input-premium" required />
                            <span v-if="itemForm.errors.order" class="text-xs text-red-500 mt-1 block">{{ itemForm.errors.order }}</span>
                        </div>
                        <div>
                            <label class="label-premium">Status</label>
                            <select v-model="itemForm.is_active" class="input-premium">
                                <option :value="true">Active</option>
                                <option :value="false">Inactive</option>
                            </select>
                            <span v-if="itemForm.errors.is_active" class="text-xs text-red-500 mt-1 block">{{ itemForm.errors.is_active }}</span>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-base-200">
                        <button
                            type="button"
                            @click="editingItem = null; addingItemToSectionId = null"
                            class="btn-secondary py-1.5 px-4 text-xs"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="btn-primary py-1.5 px-4 text-xs"
                            :disabled="itemForm.processing"
                        >
                            {{ editingItem ? 'Save Changes' : 'Add Item' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
