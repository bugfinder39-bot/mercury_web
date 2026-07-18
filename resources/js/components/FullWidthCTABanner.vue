<template>
  <section class="relative w-full bg-cover bg-center py-20" :style="{ backgroundImage: `url(${bgImage})` }">
    <div class="absolute inset-0 bg-navy-900 opacity-70"></div>
    <div class="relative max-w-4xl mx-auto text-center px-4">
      <h2 class="text-4xl font-extrabold text-white mb-4 animate-fadeIn">{{ headline }}</h2>
      <p class="text-lg text-gray-200 mb-6 animate-fadeIn delay-200">{{ description }}</p>
      <div class="flex justify-center gap-4 animate-fadeIn delay-400">
        <a v-if="primaryBtn && primaryBtn.text && primaryBtn.href" :href="primaryBtn.href"
           class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-6 rounded transition-colors">{{ primaryBtn.text }}</a>
        <a v-if="secondaryBtn && secondaryBtn.text && secondaryBtn.href" :href="secondaryBtn.href"
           class="border border-white text-white hover:bg-white hover:text-navy-900 font-medium py-2 px-6 rounded transition-colors">{{ secondaryBtn.text }}</a>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
interface ButtonLink {
  text: string;
  href: string;
}

defineProps({
  bgImage: { type: String, required: true },
  headline: { type: String, required: true },
  description: { type: String, default: '' },
  primaryBtn: { type: Object as () => ButtonLink, default: null },
  secondaryBtn: { type: Object as () => ButtonLink, default: null },
});
</script>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.8s ease-out forwards;
}
.delay-200 { animation-delay: 0.2s; }
.delay-400 { animation-delay: 0.4s; }
.bg-navy-900 { background-color: #0a0f24; }
</style>
