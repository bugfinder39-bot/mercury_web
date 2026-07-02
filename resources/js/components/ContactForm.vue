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
    <div class="space-y-6">
        <!-- Success Banner -->
        <div 
            v-if="page.props.flash?.success" 
            class="alert alert-success border rounded-lg flex items-start gap-3 font-body text-sm"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="font-semibold uppercase tracking-wider font-mono text-xs">Submission Successful</p>
                <p class="mt-0.5">{{ page.props.flash.success }}</p>
            </div>
        </div>

        <form @submit.prevent="submit" class="space-y-5 bg-base-100 border border-base-300 p-6 md:p-8 rounded-lg">
            <!-- Title -->
            <div class="border-b border-base-300 pb-4 mb-2">
                <h3 class="text-xl font-bold font-display text-base-content">Send a Message</h3>
                <p class="text-base-content/70 text-xs md:text-sm font-body mt-1">Our coordinators will review your cargo requirements immediately.</p>
            </div>

            <!-- Full Name -->
            <div class="form-control">
                <label for="name" class="label font-mono text-xs uppercase tracking-wider text-base-content/70 mb-1">Full Name *</label>
                <input 
                    id="name"
                    v-model="form.name"
                    type="text" 
                    placeholder="John Doe"
                    class="input input-bordered bg-base-100 w-full rounded-lg text-sm transition-all focus:border-amber focus:ring-2 focus:ring-amber/20 focus:outline-none"
                    :class="form.errors.name ? 'border-error focus:border-error focus:ring-error/20' : 'border-base-300'"
                />
                <span v-if="form.errors.name" class="text-xs text-error mt-1 font-body">{{ form.errors.name }}</span>
            </div>

            <!-- Email Address -->
            <div class="form-control">
                <label for="email" class="label font-mono text-xs uppercase tracking-wider text-base-content/70 mb-1">Email Address *</label>
                <input 
                    id="email"
                    v-model="form.email"
                    type="email" 
                    placeholder="john@example.com"
                    class="input input-bordered bg-base-100 w-full rounded-lg text-sm transition-all focus:border-amber focus:ring-2 focus:ring-amber/20 focus:outline-none"
                    :class="form.errors.email ? 'border-error focus:border-error focus:ring-error/20' : 'border-base-300'"
                />
                <span v-if="form.errors.email" class="text-xs text-error mt-1 font-body">{{ form.errors.email }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Phone -->
                <div class="form-control">
                    <label for="phone" class="label font-mono text-xs uppercase tracking-wider text-base-content/70 mb-1">Phone Number</label>
                    <input 
                        id="phone"
                        v-model="form.phone"
                        type="text" 
                        placeholder="+880 17..."
                        class="input input-bordered bg-base-100 w-full rounded-lg text-sm transition-all focus:border-amber focus:ring-2 focus:ring-amber/20 focus:outline-none"
                        :class="form.errors.phone ? 'border-error focus:border-error focus:ring-error/20' : 'border-base-300'"
                    />
                    <span v-if="form.errors.phone" class="text-xs text-error mt-1 font-body">{{ form.errors.phone }}</span>
                </div>

                <!-- Subject -->
                <div class="form-control">
                    <label for="subject" class="label font-mono text-xs uppercase tracking-wider text-base-content/70 mb-1">Subject</label>
                    <input 
                        id="subject"
                        v-model="form.subject"
                        type="text" 
                        placeholder="Inquiry or Quote"
                        class="input input-bordered bg-base-100 w-full rounded-lg text-sm transition-all focus:border-amber focus:ring-2 focus:ring-amber/20 focus:outline-none"
                        :class="form.errors.subject ? 'border-error focus:border-error focus:ring-error/20' : 'border-base-300'"
                    />
                    <span v-if="form.errors.subject" class="text-xs text-error mt-1 font-body">{{ form.errors.subject }}</span>
                </div>
            </div>

            <!-- Message -->
            <div class="form-control">
                <label for="message" class="label font-mono text-xs uppercase tracking-wider text-base-content/70 mb-1">Message *</label>
                <textarea 
                    id="message"
                    v-model="form.message"
                    placeholder="Describe shipping requirements..."
                    class="textarea textarea-bordered bg-base-100 w-full rounded-lg text-sm h-32 transition-all focus:border-amber focus:ring-2 focus:ring-amber/20 focus:outline-none"
                    :class="form.errors.message ? 'border-error focus:border-error focus:ring-error/20' : 'border-base-300'"
                ></textarea>
                <span v-if="form.errors.message" class="text-xs text-error mt-1 font-body">{{ form.errors.message }}</span>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    :disabled="form.processing"
                    class="w-full sm:w-auto btn bg-amber hover:bg-amber-dark text-white font-body font-medium text-sm rounded-lg border-none transition-colors duration-150 px-6 py-3 h-auto min-h-0"
                >
                    {{ form.processing ? 'Sending...' : 'Send Message' }}
                </button>
            </div>
        </form>
    </div>
</template>
