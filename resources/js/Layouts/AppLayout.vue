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
    <div class="min-h-screen">
        <Head :title="title" />

        <Banner />

        <div class="bg-gray-100">
            <Nav />

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
        <Footer />
    </div>
</template>
