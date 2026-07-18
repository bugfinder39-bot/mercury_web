<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { ref, computed } from 'vue';
import { 
    Search, 
    Trash2, 
    Mail, 
    MailOpen, 
    Eye, 
    Download, 
    X, 
    Phone, 
    Calendar, 
    User,
    Inbox,
    ExternalLink
} from '@lucide/vue';

interface Message {
    id: number;
    name: string;
    email: string;
    phone: string | null;
    subject: string | null;
    message: string;
    is_read: boolean;
    created_at: string;
}

const props = defineProps<{
    messages: Message[];
}>();

defineOptions({
    layout: AdminLayout,
});

// Search and Filtering State
const searchQuery = ref('');
const statusFilter = ref<'all' | 'unread' | 'read'>('all');
const selectedMessage = ref<Message | null>(null);

// Filtered Messages
const filteredMessages = computed(() => {
    return props.messages.filter(msg => {
        // Status filter check
        if (statusFilter.value === 'unread' && msg.is_read) return false;
        if (statusFilter.value === 'read' && !msg.is_read) return false;

        // Search text check
        if (!searchQuery.value) return true;
        const query = searchQuery.value.toLowerCase();
        return (
            msg.name.toLowerCase().includes(query) ||
            msg.email.toLowerCase().includes(query) ||
            (msg.subject && msg.subject.toLowerCase().includes(query)) ||
            msg.message.toLowerCase().includes(query) ||
            (msg.phone && msg.phone.toLowerCase().includes(query))
        );
    });
});

// Action methods
const toggleReadStatus = (msg: Message) => {
    router.patch(`/admin/messages/${msg.id}/toggle-read`, {}, {
        preserveScroll: true,
        onSuccess: () => {
            // Update the selected message reference if open to reflect new state
            if (selectedMessage.value?.id === msg.id) {
                selectedMessage.value.is_read = !selectedMessage.value.is_read;
            }
        }
    });
};

const deleteMessage = (id: number) => {
    if (confirm('Are you sure you want to delete this message? This action cannot be undone.')) {
        router.delete(`/admin/messages/${id}`, {
            preserveScroll: true,
            onSuccess: () => {
                if (selectedMessage.value?.id === id) {
                    selectedMessage.value = null;
                }
            }
        });
    }
};

const viewMessage = (msg: Message) => {
    selectedMessage.value = msg;
    // Auto-mark as read if viewed and currently unread
    if (!msg.is_read) {
        toggleReadStatus(msg);
    }
};

const closeDetailModal = () => {
    selectedMessage.value = null;
};

// Export to CSV
const exportToCsv = () => {
    const headers = ['ID', 'Sender Name', 'Email', 'Phone', 'Subject', 'Message', 'Status', 'Received Date'];
    const rows = filteredMessages.value.map(msg => [
        msg.id,
        msg.name,
        msg.email,
        msg.phone || '',
        msg.subject || '',
        msg.message.replace(/\r?\n/g, ' '),
        msg.is_read ? 'Read' : 'Unread',
        msg.created_at
    ]);

    const csvContent = "data:text/csv;charset=utf-8," 
        + [headers.join(','), ...rows.map(e => e.map(val => `"${String(val).replace(/"/g, '""')}"`).join(','))].join('\n');
    
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `mercury_messages_export_${new Date().toISOString().slice(0,10)}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>

<template>
    <Head title="Contact Messages Inbox" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-amber">MB · 05 — MESSAGES INBOX</span>
                <h1 class="text-3xl font-bold font-display mt-1" style="color: #0B2540;">Contact Messages</h1>
                <p class="font-body text-sm mt-0.5" style="color: #5B6B79;">Read and manage submissions from the public Contact page form.</p>
            </div>
            <div v-if="filteredMessages.length > 0">
                <button 
                    @click="exportToCsv"
                    class="btn bg-white hover:bg-slate-50 text-navy border border-slate-200 rounded-lg px-4 flex items-center gap-2 font-mono text-xs font-semibold uppercase tracking-wider transition-colors duration-150"
                >
                    <Download class="size-4 text-slate" />
                    <span>Export CSV</span>
                </button>
            </div>
        </div>

        <!-- Success Alert -->
        <div v-if="$page.props.flash?.success" class="alert alert-success text-white rounded-lg flex items-center gap-2 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-body text-sm">{{ $page.props.flash.success }}</span>
        </div>

        <!-- Controls (Search + Filters) -->
        <div class="flex flex-col md:flex-row gap-4 items-stretch md:items-center justify-between">
            <!-- Tabs -->
            <div class="flex border-b border-slate-200 font-mono text-xs">
                <button 
                    @click="statusFilter = 'all'"
                    class="px-4 py-2.5 font-semibold uppercase tracking-wider transition-all duration-150 border-b-2"
                    :style="statusFilter === 'all' 
                        ? 'border-color: #E8770C; color: #E8770C;' 
                        : 'border-color: transparent; color: #5B6B79;'"
                >
                    All ({{ messages.length }})
                </button>
                <button 
                    @click="statusFilter = 'unread'"
                    class="px-4 py-2.5 font-semibold uppercase tracking-wider transition-all duration-150 border-b-2"
                    :style="statusFilter === 'unread' 
                        ? 'border-color: #E8770C; color: #E8770C;' 
                        : 'border-color: transparent; color: #5B6B79;'"
                >
                    Unread ({{ messages.filter(m => !m.is_read).length }})
                </button>
                <button 
                    @click="statusFilter = 'read'"
                    class="px-4 py-2.5 font-semibold uppercase tracking-wider transition-all duration-150 border-b-2"
                    :style="statusFilter === 'read' 
                        ? 'border-color: #E8770C; color: #E8770C;' 
                        : 'border-color: transparent; color: #5B6B79;'"
                >
                    Read ({{ messages.filter(m => m.is_read).length }})
                </button>
            </div>

            <!-- Search -->
            <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <Search class="size-4 text-slate" />
                </div>
                <input 
                    type="text" 
                    v-model="searchQuery"
                    placeholder="Search name, email, subject..."
                    class="w-full pl-9 pr-4 py-2 text-sm rounded-lg border border-slate-200 bg-white font-body focus:ring-2 focus:ring-amber focus:border-amber focus:outline-none transition-all duration-150"
                />
                <button 
                    v-if="searchQuery" 
                    @click="searchQuery = ''"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                >
                    <X class="size-4 text-slate hover:text-navy" />
                </button>
            </div>
        </div>

        <!-- Main Card List -->
        <div class="card-premium overflow-hidden p-0 border border-slate-200 bg-white">
            <div class="overflow-x-auto">
                <table class="w-full table-premium text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200">
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540; width: 40px;"></th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Sender</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Subject</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white" style="background-color: #0B2540;">Date Received</th>
                            <th class="px-6 py-4 font-mono text-xs font-semibold uppercase tracking-wider text-white text-right" style="background-color: #0B2540;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-body">
                        <tr 
                            v-for="msg in filteredMessages" 
                            :key="msg.id" 
                            class="hover:bg-slate-50 transition-colors duration-150 cursor-pointer"
                            :class="!msg.is_read ? 'bg-slate-50/50 font-medium' : ''"
                            @click="viewMessage(msg)"
                        >
                            <!-- Mail status icon -->
                            <td class="px-6 py-4" @click.stop="toggleReadStatus(msg)">
                                <button class="focus:outline-none tooltip" :data-tip="msg.is_read ? 'Mark as Unread' : 'Mark as Read'">
                                    <Mail v-if="!msg.is_read" class="size-4 text-amber" />
                                    <MailOpen v-else class="size-4 text-slate" />
                                </button>
                            </td>
                            
                            <!-- Sender -->
                            <td class="px-6 py-4">
                                <div class="font-semibold" style="color: #0B2540;">{{ msg.name }}</div>
                                <div class="text-xs text-slate mt-0.5 font-mono">{{ msg.email }}</div>
                            </td>

                            <!-- Subject & Snippet -->
                            <td class="px-6 py-4 max-w-md">
                                <div class="truncate text-sm" style="color: #0B2540;">
                                    {{ msg.subject || 'No Subject' }}
                                </div>
                                <div class="truncate text-xs text-slate mt-0.5 font-normal">
                                    {{ msg.message }}
                                </div>
                            </td>

                            <!-- Date -->
                            <td class="px-6 py-4 text-xs font-mono text-slate">
                                {{ new Date(msg.created_at).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }) }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right" @click.stop>
                                <div class="flex justify-end gap-3 items-center">
                                    <button
                                        @click="viewMessage(msg)"
                                        class="font-mono text-xs font-semibold uppercase tracking-wide transition-colors flex items-center gap-1 hover:underline text-navy"
                                    >
                                        <Eye class="size-3.5 text-navy" />
                                        <span>View</span>
                                    </button>
                                    <button
                                        @click="deleteMessage(msg.id)"
                                        class="font-mono text-xs font-semibold uppercase tracking-wide transition-colors flex items-center gap-1 hover:underline text-red-600 hover:text-red-800"
                                    >
                                        <Trash2 class="size-3.5" />
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Empty State -->
                        <tr v-if="filteredMessages.length === 0">
                            <td colspan="5" class="text-center py-16 font-body text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <Inbox class="size-8 text-slate-300" />
                                    <span class="text-sm">No messages found.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ── Message Detail Modal ── -->
        <dialog v-if="selectedMessage" class="modal modal-open backdrop-blur-sm bg-navy/20">
            <div class="modal-box max-w-2xl p-0 border border-slate-200 rounded-xl overflow-hidden bg-white shadow-xl">
                <!-- Modal Header -->
                <div class="px-6 py-4 flex items-center justify-between border-b border-slate-100" style="background-color: #0B2540;">
                    <div class="flex items-center gap-3">
                        <span 
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-mono font-semibold uppercase tracking-wider border"
                            :style="selectedMessage.is_read
                                ? 'background-color: rgba(31,122,92,0.12); color: #1F7A5C; border-color: rgba(31,122,92,0.25);'
                                : 'background-color: rgba(232,119,12,0.12); color: #E8770C; border-color: rgba(232,119,12,0.25);'"
                        >
                            {{ selectedMessage.is_read ? 'Read' : 'Unread' }}
                        </span>
                        <span class="text-xs font-mono uppercase tracking-widest text-slate-300">Message Detail</span>
                    </div>
                    <button 
                        @click="closeDetailModal" 
                        class="p-1 rounded-lg text-slate-300 hover:text-white transition-colors"
                    >
                        <X class="size-5" />
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto">
                    <!-- Sender Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-4 border-b border-slate-100">
                        <div class="space-y-1">
                            <span class="font-mono text-[10px] uppercase tracking-wider text-slate">Sender Name</span>
                            <div class="flex items-center gap-2 font-body text-sm font-semibold text-navy">
                                <User class="size-4 text-amber" />
                                <span>{{ selectedMessage.name }}</span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <span class="font-mono text-[10px] uppercase tracking-wider text-slate">Email Address</span>
                            <div class="flex items-center gap-2 font-body text-sm text-navy">
                                <Mail class="size-4 text-amber" />
                                <a :href="`mailto:${selectedMessage.email}`" class="hover:underline flex items-center gap-1">
                                    <span>{{ selectedMessage.email }}</span>
                                    <ExternalLink class="size-3 text-slate" />
                                </a>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <span class="font-mono text-[10px] uppercase tracking-wider text-slate">Phone Number</span>
                            <div class="flex items-center gap-2 font-body text-sm text-navy">
                                <Phone class="size-4 text-amber" />
                                <a v-if="selectedMessage.phone" :href="`tel:${selectedMessage.phone}`" class="hover:underline">
                                    {{ selectedMessage.phone }}
                                </a>
                                <span v-else class="text-slate-400 font-mono">—</span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <span class="font-mono text-[10px] uppercase tracking-wider text-slate">Received Date</span>
                            <div class="flex items-center gap-2 font-body text-sm text-navy">
                                <Calendar class="size-4 text-amber" />
                                <span class="font-mono text-xs">
                                    {{ new Date(selectedMessage.created_at).toLocaleString() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="space-y-1.5">
                        <span class="font-mono text-[10px] uppercase tracking-wider text-slate">Subject</span>
                        <h3 class="text-lg font-bold font-display text-navy leading-snug">
                            {{ selectedMessage.subject || '(No Subject)' }}
                        </h3>
                    </div>

                    <!-- Message Body -->
                    <div class="space-y-1.5">
                        <span class="font-mono text-[10px] uppercase tracking-wider text-slate">Message</span>
                        <div class="p-4 rounded-lg bg-slate-50 border border-slate-100 font-body text-sm text-slate-800 whitespace-pre-wrap leading-relaxed">
                            {{ selectedMessage.message }}
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 flex flex-wrap justify-between items-center gap-3 border-t border-slate-100 bg-slate-50">
                    <div class="flex gap-2">
                        <button
                            @click="deleteMessage(selectedMessage.id)"
                            class="btn btn-sm btn-error text-white font-mono text-xs font-semibold uppercase tracking-wider"
                        >
                            Delete
                        </button>
                        <button
                            @click="toggleReadStatus(selectedMessage)"
                            class="btn btn-sm bg-white border border-slate-200 text-navy hover:bg-slate-100 font-mono text-xs font-semibold uppercase tracking-wider"
                        >
                            Mark {{ selectedMessage.is_read ? 'Unread' : 'Read' }}
                        </button>
                    </div>
                    <div class="flex gap-2">
                        <button
                            @click="closeDetailModal"
                            class="btn btn-sm bg-slate-200 hover:bg-slate-300 text-slate-700 border-none font-mono text-xs font-semibold uppercase tracking-wider"
                        >
                            Close
                        </button>
                        <a
                            :href="`mailto:${selectedMessage.email}?subject=Re: ${selectedMessage.subject || ''}`"
                            class="btn btn-sm bg-amber hover:bg-amber-dark text-white border-none font-mono text-xs font-semibold uppercase tracking-wider flex items-center gap-1.5"
                        >
                            <span>Reply via Email</span>
                            <ExternalLink class="size-3.5" />
                        </a>
                    </div>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop" @click="closeDetailModal">
                <button>close</button>
            </form>
        </dialog>
    </div>
</template>

