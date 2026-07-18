<template>
  <section class="max-w-7xl mx-auto py-16 px-6 md:px-8">
    <div class="card-premium p-8 md:p-12 flex flex-col md:flex-row items-center gap-10">
      <!-- Image -->
      <div class="flex-shrink-0 w-full md:w-1/3">
        <div class="rounded-xl overflow-hidden" style="box-shadow: var(--shadow-md); border: 1px solid rgba(11,37,64,0.10);">
          <img :src="section.imageUrl" alt="CEO" class="w-full h-auto object-cover" />
        </div>
      </div>
      <!-- Content -->
      <div class="w-full md:w-2/3 space-y-5">
        <span class="eyebrow-orange">{{ section.eyebrow }}</span>
        <h2 class="text-3xl font-bold font-display" style="color: #0B2540;">{{ section.heading }}</h2>
        <div class="h-1 w-12 rounded-full" style="background-color: #E8770C;"></div>
        <div class="prose max-w-none font-body text-base leading-relaxed" style="color: #475569;" v-html="section.messageHtml"></div>
        <p class="font-semibold font-body" style="color: #0B2540;">
          {{ section.name }}
          <span style="color: #64748B;"> – {{ section.position }}</span>
        </p>
        <img v-if="section.signatureUrl" :src="section.signatureUrl" alt="Signature" class="mt-1 h-12" />
        <div v-if="section.ctaText && section.ctaLink" class="pt-2">
          <a :href="section.ctaLink" class="btn-primary inline-flex">{{ section.ctaText }}</a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
defineProps({
  section: { type: Object as () => Record<string, any>, required: true },
});
</script>

<style scoped>
/* Component‑specific styles */
</style>
