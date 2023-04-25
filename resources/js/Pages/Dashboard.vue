<script setup>
import { usePage } from "@inertiajs/vue3";
import { onMounted, computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useLocationStore } from "@/stores/locationStore";
import { useActivitiesStore } from "@/stores/activitiesStore";

import Categories from "@/Components/Categories.vue";
import ActivitiesSlider from "@/Components/ActivitiesSlider.vue";

const locationStore = useLocationStore();
const activitiesStore = useActivitiesStore();

async function fetchActivities() {
    await locationStore.fetchPosition();
    await activitiesStore.fetchActivities();
}

onMounted(fetchActivities);

const nearestActivities = computed(
    () => activitiesStore.getActivitiesSortedByDistance
);
const nextActivities = computed(
    () => activitiesStore.getActivitiesSortedByDate
);
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="">
            <div class="">
                <div class="">
                    <Categories />
                </div>
                <div class="">
                    <ActivitiesSlider
                        :data="nearestActivities"
                        :title="'Activités à proximité'"
                    />
                </div>
                <div class="">
                    <ActivitiesSlider
                        :data="nextActivities"
                        :title="'Activités à venir'"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
