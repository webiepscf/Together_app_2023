<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";
import Nav from "@/Components/Nav.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
    title: String,
});
</script>

<template>
    <div class="bg-gradient-to-b from-teal-600 to-cyan-900 min-h-screen">
        <Head :title="title" />

        <Banner />

        <div class="flex flex-col justify-between h-screen">
            <Nav class="shrink-0" />
            <!-- Page Content -->
            <main class="grow p-6 overflow-y-auto">
                <slot />
            </main>
            <Footer class="shrink-0" />
        </div>
    </div>
</template>
