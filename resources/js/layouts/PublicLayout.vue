<script setup lang="ts">
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';
</script>

<template>
    <div class="min-h-screen flex flex-col font-sans antialiased" style="background-color: #F8FAFC;">
        <!-- Navigation Header -->
        <Navbar />

        <!-- Main Content Area -->
        <main id="main-content" class="flex-grow" role="main">
            <slot />
        </main>

        <!-- Footer -->
        <Footer />
    </div>
</template>
