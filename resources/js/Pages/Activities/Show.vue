<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
defineProps({
    activity: Object,
});
</script>
<template>
    <AppLayout :title="activity.activityName">
        <h2>{{ activity.activityName }}</h2>
    </AppLayout>
</template>
