<script setup lang="ts">
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted, computed, ref } from 'vue';

const props = defineProps<{
    section?: {
        id: number;
        heading?: string;
        subheading?: string;
        body?: string;
        form_card_title?: string;
        form_description?: string;
        button_text?: string;
        button_icon?: string;
        success_message?: string;
        error_message?: string;
        required_field_text?: string;
        placeholder_text?: string;
        items?: Array<{
            id: number;
            title: string;
            field_name?: string;
            field_type?: string;
            placeholder?: string;
            is_required?: boolean;
            width?: string;
            help_text?: string;
            default_value?: string;
            options?: string;
            order: number;
            is_active: boolean;
        }>;
    };
}>();

const page = usePage();

// Active fields sorted by order
const activeFields = computed(() => {
    if (!props.section?.items) return [];
    return props.section.items
        .filter(item => item.is_active !== false)
        .sort((a, b) => (a.order || 0) - (b.order || 0));
});

// Helper to get field key
const getFieldKey = (field: any) => {
    if (field.field_name) return field.field_name;
    return field.title.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_+|_+$/g, '');
};

// Initial form state
const initialData: Record<string, any> = {};
const hasFiles = ref(false);

const initForm = () => {
    if (activeFields.value.length > 0) {
        activeFields.value.forEach((field) => {
            const key = getFieldKey(field);
            if (field.field_type === 'checkbox') {
                initialData[key] = field.default_value ? field.default_value.split(',').map(s => s.trim()) : [];
            } else if (field.field_type === 'file') {
                initialData[key] = null;
                hasFiles.value = true;
            } else {
                initialData[key] = field.default_value || '';
            }
        });
    } else {
        // Fallback default fields if no section item configured
        initialData.name = '';
        initialData.email = '';
        initialData.phone = '';
        initialData.subject = '';
        initialData.message = '';
    }
};

initForm();

const form = useForm(initialData);

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const subjectParam = params.get('subject');

    if (subjectParam) {
        if ('subject' in form) {
            form.subject = subjectParam;
        }
    }
});

const handleFileChange = (e: Event, key: string) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        (form as any)[key] = target.files[0];
    }
};

const getOptionsArray = (optionsStr?: string) => {
    if (!optionsStr) return [];
    return optionsStr.split(',').map(opt => opt.trim()).filter(Boolean);
};

const submit = () => {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <div class="space-y-5">
        <!-- Success Banner -->
        <div
            v-if="page.props.flash?.success"
            class="flex items-start gap-3 p-4 rounded-xl font-body text-sm"
            style="background-color: rgba(31,122,92,0.10); border: 1px solid rgba(31,122,92,0.25); color: #1F7A5C;"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="font-semibold uppercase tracking-wider font-mono text-xs">Submission Successful</p>
                <p class="mt-0.5">{{ page.props.flash.success || section?.success_message || 'Thank you! Your message has been received.' }}</p>
            </div>
        </div>

        <form @submit.prevent="submit" class="card-premium hover-glow-card p-7 md:p-9 space-y-6 rounded-2xl bg-white hover:bg-gradient-to-br hover:from-white hover:to-[var(--color-light-steel-blue)]/10 transition-all duration-300 relative overflow-hidden">
            <!-- Top Accent line on hover -->
            <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#E8770C] to-[#123A5E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
            <!-- Accent corner -->
            <div class="absolute top-0 right-0 w-8 h-8 bg-gradient-to-bl from-[#E8770C] to-transparent opacity-10 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>

            <!-- Form Title -->
            <div class="pb-5 relative z-10" style="border-bottom: 1px solid rgba(11,37,64,0.08);">
                <h3 class="text-xl font-bold font-display" style="color: #0B2540;">
                    {{ section?.form_card_title || section?.heading || 'Send a Message' }}
                </h3>
                <p class="font-body text-sm mt-1" style="color: #64748B;">
                    {{ section?.form_description || section?.body || 'Our coordinators will review your cargo requirements immediately.' }}
                </p>
            </div>

            <!-- Dynamic Form Builder Render -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <template v-if="activeFields.length > 0">
                    <div
                        v-for="field in activeFields"
                        :key="field.id"
                        :class="field.width === 'half' ? 'col-span-1' : 'col-span-1 md:col-span-2'"
                        class="space-y-1.5"
                    >
                        <template v-if="field.field_type !== 'hidden'">
                            <label :for="getFieldKey(field)" class="label-premium flex items-center justify-between">
                                <span>
                                    {{ field.title }}
                                    <span v-if="field.is_required" class="text-red-500 font-bold ml-0.5">{{ section?.required_field_text || '*' }}</span>
                                </span>
                            </label>
                        </template>

                        <!-- Single Line Text / Email / Phone / Number / Date / Time -->
                        <template v-if="['text', 'email', 'phone', 'number', 'date', 'time', null, ''].includes(field.field_type || 'text')">
                            <input
                                :id="getFieldKey(field)"
                                v-model="form[getFieldKey(field)]"
                                :type="field.field_type === 'phone' ? 'tel' : (field.field_type || 'text')"
                                :placeholder="field.placeholder || section?.placeholder_text || ''"
                                class="input-premium"
                                :style="form.errors[getFieldKey(field)] ? 'border-color: #C0392B; box-shadow: 0 0 0 3px rgba(192,57,43,0.12);' : ''"
                            />
                        </template>

                        <!-- Textarea -->
                        <template v-else-if="field.field_type === 'textarea'">
                            <textarea
                                :id="getFieldKey(field)"
                                v-model="form[getFieldKey(field)]"
                                :placeholder="field.placeholder || section?.placeholder_text || ''"
                                rows="5"
                                class="input-premium resize-none"
                                :style="form.errors[getFieldKey(field)] ? 'border-color: #C0392B; box-shadow: 0 0 0 3px rgba(192,57,43,0.12);' : ''"
                            ></textarea>
                        </template>

                        <!-- Dropdown -->
                        <template v-else-if="field.field_type === 'dropdown'">
                            <select
                                :id="getFieldKey(field)"
                                v-model="form[getFieldKey(field)]"
                                class="input-premium"
                                :style="form.errors[getFieldKey(field)] ? 'border-color: #C0392B; box-shadow: 0 0 0 3px rgba(192,57,43,0.12);' : ''"
                            >
                                <option value="" disabled>{{ field.placeholder || 'Select an option...' }}</option>
                                <option
                                    v-for="opt in getOptionsArray(field.options)"
                                    :key="opt"
                                    :value="opt"
                                >
                                    {{ opt }}
                                </option>
                            </select>
                        </template>

                        <!-- Radio -->
                        <template v-else-if="field.field_type === 'radio'">
                            <div class="flex flex-wrap gap-4 pt-1">
                                <label
                                    v-for="opt in getOptionsArray(field.options)"
                                    :key="opt"
                                    class="inline-flex items-center gap-2 text-sm font-body cursor-pointer text-slate-700"
                                >
                                    <input
                                        type="radio"
                                        :name="getFieldKey(field)"
                                        :value="opt"
                                        v-model="form[getFieldKey(field)]"
                                        class="text-[#E8770C] focus:ring-[#E8770C]"
                                    />
                                    <span>{{ opt }}</span>
                                </label>
                            </div>
                        </template>

                        <!-- Checkbox -->
                        <template v-else-if="field.field_type === 'checkbox'">
                            <div class="flex flex-wrap gap-4 pt-1">
                                <label
                                    v-for="opt in getOptionsArray(field.options)"
                                    :key="opt"
                                    class="inline-flex items-center gap-2 text-sm font-body cursor-pointer text-slate-700"
                                >
                                    <input
                                        type="checkbox"
                                        :value="opt"
                                        v-model="form[getFieldKey(field)]"
                                        class="rounded text-[#E8770C] focus:ring-[#E8770C]"
                                    />
                                    <span>{{ opt }}</span>
                                </label>
                            </div>
                        </template>

                        <!-- File Upload -->
                        <template v-else-if="field.field_type === 'file'">
                            <input
                                :id="getFieldKey(field)"
                                type="file"
                                @change="handleFileChange($event, getFieldKey(field))"
                                class="file-input file-input-bordered w-full text-xs"
                                :style="form.errors[getFieldKey(field)] ? 'border-color: #C0392B;' : ''"
                            />
                        </template>

                        <!-- Hidden -->
                        <template v-else-if="field.field_type === 'hidden'">
                            <input
                                type="hidden"
                                :id="getFieldKey(field)"
                                :value="field.default_value || ''"
                            />
                        </template>

                        <p v-if="field.help_text" class="text-xs font-body text-slate-400 mt-0.5">{{ field.help_text }}</p>
                        <span v-if="form.errors[getFieldKey(field)]" class="text-xs font-body block" style="color: #C0392B;">
                            {{ form.errors[getFieldKey(field)] }}
                        </span>
                    </div>
                </template>

                <!-- Fallback Hardcoded Structure if no fields array -->
                <template v-else>
                    <div class="col-span-1 md:col-span-2 space-y-1.5">
                        <label for="name" class="label-premium">Full Name *</label>
                        <input id="name" v-model="form.name" type="text" placeholder="John Doe" class="input-premium" />
                        <span v-if="form.errors.name" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.name }}</span>
                    </div>
                    <div class="col-span-1 md:col-span-2 space-y-1.5">
                        <label for="email" class="label-premium">Email Address *</label>
                        <input id="email" v-model="form.email" type="email" placeholder="john@example.com" class="input-premium" />
                        <span v-if="form.errors.email" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.email }}</span>
                    </div>
                    <div class="col-span-1 space-y-1.5">
                        <label for="phone" class="label-premium">Phone Number</label>
                        <input id="phone" v-model="form.phone" type="text" placeholder="+880 17..." class="input-premium" />
                        <span v-if="form.errors.phone" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.phone }}</span>
                    </div>
                    <div class="col-span-1 space-y-1.5">
                        <label for="subject" class="label-premium">Subject</label>
                        <input id="subject" v-model="form.subject" type="text" placeholder="Inquiry or Quote" class="input-premium" />
                        <span v-if="form.errors.subject" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.subject }}</span>
                    </div>
                    <div class="col-span-1 md:col-span-2 space-y-1.5">
                        <label for="message" class="label-premium">Message *</label>
                        <textarea id="message" v-model="form.message" placeholder="Describe shipping requirements..." rows="5" class="input-premium resize-none"></textarea>
                        <span v-if="form.errors.message" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.message }}</span>
                    </div>
                </template>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="btn-primary group w-full sm:w-auto"
                    :style="form.processing ? 'opacity: 0.70; cursor: not-allowed;' : ''"
                >
                    <span v-if="form.processing">Sending...</span>
                    <span v-else class="inline-flex items-center gap-2">
                        <span>{{ section?.button_text || 'Send Message' }}</span>
                        <svg class="size-4 transition-transform duration-250 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </span>
                </button>
            </div>
        </form>
    </div>
</template>
