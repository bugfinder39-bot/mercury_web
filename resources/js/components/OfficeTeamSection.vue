<template>
  <section class="relative py-20 px-4 sm:px-6 lg:px-8 bg-white border-b border-slate-200/60 overflow-hidden">
    <!-- Watermark / Background elements -->
    <div class="absolute inset-0 select-none pointer-events-none overflow-hidden">
      <!-- Watermark DIRECTORY / TEAM -->
      <span class="absolute right-[-2%] top-[10%] text-[10vw] font-bold font-display text-slate-100/30 tracking-widest leading-none select-none uppercase">
        TEAM
      </span>
      <div class="absolute -top-40 -left-40 w-[600px] h-[600px] rounded-full bg-[#E8770C]/[0.02] filter blur-[120px]"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
      <!-- Eyebrow & Heading -->
      <div class="text-center max-w-3xl mx-auto mb-16 reveal-fade-up">
        <span class="font-mono text-xs text-primary-orange tracking-widest font-semibold uppercase block mb-3">
          MB · 02 — {{ section.subheading || 'OFFICE DIRECTORY' }}
        </span>
        <h2 class="text-3xl md:text-4xl font-bold font-display tracking-tight text-primary-navy mb-4">
          {{ section.heading || 'Meet Our Office Team' }}
        </h2>
        <div class="h-1 w-12 rounded-full mx-auto bg-primary-orange mb-6"></div>
        <p v-if="section.body" class="text-slate-600 font-body text-base max-w-2xl mx-auto leading-relaxed">
          {{ section.body }}
        </p>
      </div>

      <!-- Directory Grid -->
      <div v-if="section.items && section.items.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
        <!-- Cards -->
        <div 
          v-for="(member, index) in section.items" 
          :key="member.id"
          class="card-premium hover-glow-card rounded-xl p-6 flex flex-col justify-between bg-white border border-slate-200/60 transition-all duration-300 hover:shadow-md transform hover:-translate-y-1 relative overflow-hidden reveal-fade-up"
          :style="{ animationDelay: `${index * 100}ms` }"
        >
          <!-- Accent line on hover -->
          <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#E8770C] to-[#123A5E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

          <div>
            <!-- Department Badge -->
            <div v-if="member.department" class="flex items-center gap-2 mb-4">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-mono font-semibold bg-[#123A5E]/10 text-secondary-navy">
                {{ member.department }}
              </span>
            </div>

            <!-- Name & Designation -->
            <h3 class="text-xl font-bold font-display text-primary-navy mb-1">
              {{ member.title }}
            </h3>
            <p v-if="member.designation" class="text-sm font-body font-medium text-primary-orange mb-4">
              {{ member.designation }}
            </p>

            <!-- Short Description -->
            <p v-if="member.description" class="text-xs font-body text-slate-500 mb-6 leading-relaxed">
              {{ member.description }}
            </p>

            <!-- Detailed Info Items -->
            <div class="space-y-3 mb-6 text-xs text-slate-600 font-body border-t border-slate-100 pt-4">
              <!-- Office Location -->
              <div v-if="member.office_location" class="flex items-start gap-2.5">
                <MapPin class="size-4 text-primary-orange flex-shrink-0 mt-0.5" />
                <div>
                  <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400 block mb-0.5">Location</span>
                  <span class="text-slate-700 font-medium">{{ member.office_location }}</span>
                </div>
              </div>

              <!-- Phone & Ext -->
              <div v-if="member.phone" class="flex items-start gap-2.5">
                <Phone class="size-4 text-primary-orange flex-shrink-0 mt-0.5" />
                <div>
                  <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400 block mb-0.5">Desk Phone</span>
                  <span class="text-slate-700 font-medium flex items-center gap-1.5">
                    {{ member.phone }}
                    <span v-if="member.extension" class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-mono text-[10px]">
                      Ext: {{ member.extension }}
                    </span>
                  </span>
                </div>
              </div>

              <!-- Mobile -->
              <div v-if="member.mobile" class="flex items-start gap-2.5">
                <Smartphone class="size-4 text-primary-orange flex-shrink-0 mt-0.5" />
                <div>
                  <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400 block mb-0.5">Mobile</span>
                  <span class="text-slate-700 font-medium">{{ member.mobile }}</span>
                </div>
              </div>

              <!-- Email -->
              <div v-if="member.email" class="flex items-start gap-2.5">
                <Mail class="size-4 text-primary-orange flex-shrink-0 mt-0.5" />
                <div>
                  <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400 block mb-0.5">Email</span>
                  <a :href="`mailto:${member.email}`" class="text-secondary-navy hover:text-primary-orange font-medium transition-colors duration-200">
                    {{ member.email }}
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Footer Actions / Social Links -->
          <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
            <!-- Action buttons -->
            <div class="flex items-center gap-2">
              <!-- WhatsApp chat link -->
              <a 
                v-if="member.whatsapp" 
                :href="`https://wa.me/${formatWhatsAppNumber(member.whatsapp)}`" 
                target="_blank"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-emerald-200 bg-emerald-50/50 hover:bg-emerald-50 text-xs font-semibold text-emerald-700 transition-all duration-200"
              >
                <svg class="size-3.5 fill-current" viewBox="0 0 24 24">
                  <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.968C16.638 1.971 14.161.947 11.53.947c-5.442 0-9.866 4.372-9.87 9.802 0 1.704.475 3.37 1.373 4.815l-.996 3.637 3.733-.974.004-.002zM17.06 13.82c-.279-.14-1.647-.812-1.9-.905-.252-.092-.436-.139-.62.14-.183.279-.707.905-.867 1.09-.16.186-.32.21-.599.07-.28-.14-1.18-.435-2.247-1.39-.83-.741-1.39-1.657-1.553-1.937-.163-.28-.018-.431.122-.57.125-.127.279-.325.42-.487.14-.162.186-.279.28-.464.092-.185.046-.347-.023-.487-.069-.14-.62-1.493-.85-2.046-.223-.538-.448-.465-.62-.474-.16-.007-.343-.008-.528-.008-.185 0-.486.07-.74.348-.255.278-.973.951-.973 2.32 0 1.369.996 2.69 1.135 2.875.14.185 1.96 2.993 4.747 4.198.663.287 1.18.459 1.583.587.666.21 1.272.18 1.75.109.533-.08 1.648-.673 1.878-1.322.23-.648.23-1.205.16-1.32-.069-.118-.254-.185-.533-.326z"/>
                </svg>
                <span>WhatsApp</span>
              </a>
            </div>

            <!-- Social links -->
            <div class="flex items-center gap-2">
              <a 
                v-if="member.linkedin_url" 
                :href="member.linkedin_url" 
                target="_blank"
                class="p-1.5 rounded-lg border border-slate-200 hover:border-primary-orange hover:bg-orange-50/30 text-slate-400 hover:text-primary-orange transition-all duration-200"
                title="LinkedIn Profile"
              >
                <svg class="size-3.5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                </svg>
              </a>
              <a 
                v-if="member.facebook_url" 
                :href="member.facebook_url" 
                target="_blank"
                class="p-1.5 rounded-lg border border-slate-200 hover:border-primary-orange hover:bg-orange-50/30 text-slate-400 hover:text-primary-orange transition-all duration-200"
                title="Facebook Profile"
              >
                <svg class="size-3.5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Empty state -->
      <div v-else class="text-center py-12 border border-dashed border-slate-200 rounded-xl bg-slate-50/50 max-w-xl mx-auto">
        <p class="text-slate-400 font-body text-sm">No team members directory information available at this moment.</p>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { 
  Phone, 
  Smartphone, 
  Mail, 
  MapPin 
} from '@lucide/vue';

defineProps<{
  section: {
    id: number;
    type: string;
    heading?: string;
    subheading?: string;
    body?: string;
    order: number;
    is_active: boolean;
    items?: Array<{
      id: number;
      title: string;
      designation?: string;
      department?: string;
      office_location?: string;
      phone?: string;
      mobile?: string;
      whatsapp?: string;
      email?: string;
      extension?: string;
      linkedin_url?: string;
      facebook_url?: string;
      description?: string;
      order: number;
      is_active: boolean;
    }>;
  };
}>();

const formatWhatsAppNumber = (num: string) => {
  return num.replace(/\D/g, '');
};
</script>

<style scoped>
.card-premium {
  box-shadow: var(--shadow-card);
}
.card-premium:hover {
  box-shadow: var(--shadow-card-hover);
}
</style>
