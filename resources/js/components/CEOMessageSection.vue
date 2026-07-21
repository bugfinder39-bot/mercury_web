<template>
  <section class="ceo-executive-section relative overflow-hidden py-28 px-4 sm:px-6 lg:px-8 bg-[#0B2540] reveal-fade-up">
    <!-- Background Design System -->
    <div class="absolute inset-0 select-none pointer-events-none overflow-hidden">
      <!-- Watermark CEO/LEADERSHIP -->
      <span class="absolute right-[-2%] top-[8%] text-[11vw] font-bold font-display text-white/[0.015] tracking-widest leading-none select-none uppercase">
        LEADERSHIP
      </span>
      <span class="absolute left-[-2%] bottom-[5%] text-[13vw] font-bold font-display text-[#E8770C]/[0.012] tracking-wider leading-none select-none uppercase">
        CEO
      </span>
      
      <!-- Gradient blobs -->
      <div class="absolute -top-40 -left-40 w-[600px] h-[600px] rounded-full bg-[#E8770C]/[0.05] filter blur-[120px] animate-pulse-slow"></div>
      <div class="absolute -bottom-40 -right-40 w-[800px] h-[800px] rounded-full bg-[#123A5E]/[0.25] filter blur-[150px]"></div>
      
      <!-- Modern dot pattern grid -->
      <div class="absolute inset-0 opacity-[0.03] mix-blend-overlay bg-dot-grid"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
      <!-- Top header line/numbering -->
      <div class="flex items-center justify-between mb-16 border-b border-white/10 pb-6">
        <div class="flex items-center gap-3">
          <span class="font-mono text-xs text-[#E8770C] tracking-widest font-semibold uppercase">02 // EXECUTIVE STATEMENT</span>
          <div class="h-[1px] w-12 bg-white/20"></div>
          <span class="text-xs text-slate-400 font-mono tracking-wider">MERCURY BANGLADESH</span>
        </div>
        <div class="hidden sm:block">
          <span class="text-xs text-white/40 font-mono tracking-wider">EST. 2026</span>
        </div>
      </div>

      <!-- Container: Switches layout based on show_ceo_image -->
      <div :class="[
        'relative gap-12 lg:gap-16 items-center',
        section.show_ceo_image 
          ? 'grid grid-cols-1 lg:grid-cols-12' 
          : 'max-w-4xl mx-auto'
      ]">
        
        <!-- MODE 1: CEO IMAGE PORTRAIT (only rendered if show_ceo_image is true) -->
        <div v-if="section.show_ceo_image" class="lg:col-span-5 relative flex justify-center reveal-slide-right">
          <!-- Multi-layered decorative frame -->
          <div class="absolute -inset-4 border border-[#E8770C]/20 rounded-2xl scale-[1.02] translate-x-2 translate-y-2 pointer-events-none"></div>
          <div class="absolute -inset-4 border border-white/5 rounded-2xl pointer-events-none"></div>
          
          <!-- Orange accent line floating -->
          <div class="absolute top-8 -left-8 w-2.5 h-28 bg-gradient-to-b from-[#E8770C] to-transparent rounded-full hidden md:block"></div>
          
          <!-- Image container -->
          <div class="relative w-full aspect-[4/5] sm:max-w-md lg:max-w-none rounded-2xl overflow-hidden shadow-2xl border border-white/10 group">
            <!-- Overlay layer -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0B2540]/80 via-transparent to-transparent opacity-65 group-hover:opacity-45 transition-opacity duration-500 z-10"></div>
            
            <!-- CEO Portrait image -->
            <img 
              :src="section.imageUrl" 
              alt="CEO Portrait" 
              class="w-full h-full object-cover transition-transform duration-[8000ms] ease-out group-hover:scale-105" 
            />
            
            <!-- Elegant badge on image -->
            <div class="absolute bottom-6 left-6 right-6 z-20 bg-[#0B2540]/75 backdrop-blur-md border border-white/10 rounded-xl p-4 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
              <p class="text-xs text-[#E8770C] font-mono tracking-widest font-semibold uppercase mb-0.5">{{ section.position }}</p>
              <h4 class="text-white font-display font-bold text-lg leading-tight">{{ section.name }}</h4>
            </div>
          </div>
          
          <!-- Decorative dotted square -->
          <div class="absolute -bottom-8 -right-8 w-24 h-24 opacity-25 pointer-events-none hidden lg:block bg-dot-square"></div>
        </div>

        <!-- CONTENT BLOCK (adjusts width according to show_ceo_image) -->
        <div :class="[
          section.show_ceo_image ? 'lg:col-span-7' : 'w-full text-center space-y-10'
        ]">
          
          <!-- Header and opening quote -->
          <div :class="[
            'space-y-6',
            section.show_ceo_image ? 'text-left' : 'text-center'
          ]">
            <!-- Section Title -->
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display text-white tracking-tight leading-tight">
              {{ section.heading }}
            </h2>
            
            <!-- Gold/orange accent line -->
            <div :class="['h-[3px] w-20 bg-gradient-to-r from-[#E8770C] to-transparent rounded-full', !section.show_ceo_image && 'mx-auto']"></div>

            <!-- Blockquote overlay container -->
            <div class="relative py-4">
              <!-- Giant Quote Marks -->
              <span :class="[
                'absolute text-[10rem] font-serif text-[#E8770C]/10 leading-none select-none pointer-events-none',
                section.show_ceo_image ? '-top-10 -left-6' : '-top-10 left-[10%]'
              ]">“</span>
              
              <!-- Quote highlighting important vision -->
              <p :class="[
                'text-lg md:text-xl font-display font-medium text-slate-200 italic relative z-10 leading-relaxed max-w-3xl',
                !section.show_ceo_image && 'mx-auto'
              ]">
                Mercury Bangladesh represents the benchmark of trust, capability, and performance in corporate freight forwarding. We oversee and execute end-to-end logistics with absolute compliance, ensuring client peace of mind.
              </p>
            </div>
          </div>

          <!-- Message Body with customized styled paragraphs -->
          <div :class="[
            'prose prose-invert max-w-none text-slate-300 font-body text-base md:text-lg leading-relaxed mt-6 mb-10',
            section.show_ceo_image ? 'text-left' : 'text-center max-w-4xl mx-auto'
          ]" v-html="section.messageHtml"></div>

          <!-- Signature and metadata block -->
          <div :class="[
            'flex flex-wrap items-center gap-8 pt-8 border-t border-white/10',
            section.show_ceo_image ? 'justify-between' : 'justify-center text-center flex-col sm:flex-row'
          ]">
            <div class="space-y-2">
              <p class="text-xl font-bold font-display text-white">{{ section.name }}</p>
              <div class="flex items-center gap-2" :class="[!section.show_ceo_image && 'justify-center']">
                <span class="h-1.5 w-1.5 rounded-full bg-[#E8770C]"></span>
                <p class="text-xs font-mono uppercase tracking-widest text-[#E8770C]">{{ section.position }}</p>
              </div>
            </div>
            
            <!-- Signature upload visualization -->
            <div v-if="section.signatureUrl" class="relative group bg-white/5 hover:bg-white/10 border border-white/10 p-3 px-6 rounded-xl backdrop-blur-sm transition-all duration-300 transform hover:scale-[1.03]">
              <!-- Glass-reflective overlay light effect -->
              <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-shine pointer-events-none overflow-hidden rounded-xl"></div>
              <img 
                :src="section.signatureUrl" 
                alt="Executive Signature" 
                class="h-12 w-auto object-contain filter invert brightness-200 opacity-90 transition-all duration-300" 
              />
            </div>
          </div>

          <!-- Optional CTA button -->
          <div v-if="section.ctaText && section.ctaLink" class="pt-8 flex" :class="[section.show_ceo_image ? 'justify-start' : 'justify-center']">
            <a :href="section.ctaLink" class="btn-primary group">
              <span>{{ section.ctaText }}</span>
              <ArrowRight class="size-4 group-hover:translate-x-1 transition-transform" />
            </a>
          </div>

        </div>

      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ArrowRight } from '@lucide/vue';

defineProps({
  section: { type: Object as () => Record<string, any>, required: true },
});
</script>

<style scoped>
.ceo-executive-section {
  position: relative;
}

.bg-dot-grid {
  background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
  background-size: 30px 30px;
}

.bg-dot-square {
  background-image: radial-gradient(rgba(232, 119, 12, 0.4) 1.5px, transparent 1.5px);
  background-size: 8px 8px;
}

@keyframes pulse-slow {
  0%, 100% {
    opacity: 0.04;
    transform: scale(1) translate(0px, 0px);
  }
  50% {
    opacity: 0.08;
    transform: scale(1.15) translate(20px, -20px);
  }
}

.animate-pulse-slow {
  animation: pulse-slow 12s infinite ease-in-out;
}

@keyframes shine {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(100%);
  }
}

.group:hover .absolute {
  /* Trigger layout shines */
}

.relative.group:hover .bg-gradient-to-r {
  animation: shine 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
}

/* Elegant text formatting within v-html */
:deep(.prose) p {
  margin-bottom: 1.5rem;
  line-height: 1.8;
}

:deep(.prose) p:last-child {
  margin-bottom: 0;
}

:deep(.prose) strong {
  color: #ffffff;
  font-weight: 600;
  border-bottom: 1px dashed rgba(232, 119, 12, 0.4);
  padding-bottom: 2px;
}
</style>
