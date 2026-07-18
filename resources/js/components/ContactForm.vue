<script setup lang="ts">
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const page = usePage();

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
});

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const subjectParam = params.get('subject');

    if (subjectParam) {
        form.subject = subjectParam;
    }
});

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
                <p class="mt-0.5">{{ page.props.flash.success }}</p>
            </div>
        </div>

        <form @submit.prevent="submit" class="card-premium p-7 md:p-9 space-y-6">
            <!-- Form Title -->
            <div class="pb-5" style="border-bottom: 1px solid rgba(11,37,64,0.08);">
                <h3 class="text-xl font-bold font-display" style="color: #0B2540;">Send a Message</h3>
                <p class="font-body text-sm mt-1" style="color: #64748B;">Our coordinators will review your cargo requirements immediately.</p>
            </div>

            <!-- Full Name -->
            <div class="space-y-1.5">
                <label for="name" class="label-premium">Full Name *</label>
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    placeholder="John Doe"
                    class="input-premium"
                    :style="form.errors.name ? 'border-color: #C0392B; box-shadow: 0 0 0 3px rgba(192,57,43,0.12);' : ''"
                />
                <span v-if="form.errors.name" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.name }}</span>
            </div>

            <!-- Email Address -->
            <div class="space-y-1.5">
                <label for="email" class="label-premium">Email Address *</label>
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    placeholder="john@example.com"
                    class="input-premium"
                    :style="form.errors.email ? 'border-color: #C0392B; box-shadow: 0 0 0 3px rgba(192,57,43,0.12);' : ''"
                />
                <span v-if="form.errors.email" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.email }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Phone -->
                <div class="space-y-1.5">
                    <label for="phone" class="label-premium">Phone Number</label>
                    <input
                        id="phone"
                        v-model="form.phone"
                        type="text"
                        placeholder="+880 17..."
                        class="input-premium"
                        :style="form.errors.phone ? 'border-color: #C0392B; box-shadow: 0 0 0 3px rgba(192,57,43,0.12);' : ''"
                    />
                    <span v-if="form.errors.phone" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.phone }}</span>
                </div>

                <!-- Subject -->
                <div class="space-y-1.5">
                    <label for="subject" class="label-premium">Subject</label>
                    <input
                        id="subject"
                        v-model="form.subject"
                        type="text"
                        placeholder="Inquiry or Quote"
                        class="input-premium"
                        :style="form.errors.subject ? 'border-color: #C0392B; box-shadow: 0 0 0 3px rgba(192,57,43,0.12);' : ''"
                    />
                    <span v-if="form.errors.subject" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.subject }}</span>
                </div>
            </div>

            <!-- Message -->
            <div class="space-y-1.5">
                <label for="message" class="label-premium">Message *</label>
                <textarea
                    id="message"
                    v-model="form.message"
                    placeholder="Describe shipping requirements..."
                    rows="5"
                    class="input-premium resize-none"
                    :style="form.errors.message ? 'border-color: #C0392B; box-shadow: 0 0 0 3px rgba(192,57,43,0.12);' : ''"
                ></textarea>
                <span v-if="form.errors.message" class="text-xs font-body" style="color: #C0392B;">{{ form.errors.message }}</span>
            </div>

            <!-- Submit Button -->
            <div class="pt-1">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="btn-primary w-full sm:w-auto"
                    :style="form.processing ? 'opacity: 0.70; cursor: not-allowed;' : ''"
                >
                    {{ form.processing ? 'Sending...' : 'Send Message' }}
                </button>
            </div>
        </form>
    </div>
</template>
