<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AppMark from "@/Components/ApplicationMark.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome !" />

    <div
        class="bg-gradient-to-b from-teal-600 to-cyan-900 min-h-screen flex flex-col justify-center items-center h-screen"
    >
        <div class="flex">
            <AppMark class="w-12 h-12" />

            <div class="text-4xl font-bold mb-4 ml-2">Together</div>
        </div>

        <div v-if="canLogin" class="">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class=""
                >Dashboard</Link
            >

            <template v-else>
                <Link :href="route('login')" class="">Log in</Link>
                |
                <Link v-if="canRegister" :href="route('register')" class=""
                    >Register</Link
                >
            </template>
        </div>
    </div>
</template>

<style></style>
