<script setup>
import { formatDate } from "@/utils/utils.js";
defineProps({
    data: Array,
    title: String,
});
</script>

<template>
    <section class="py-4">
        <div class="container my-4">
            <h2 class="text-3xl font-bold mb-6">{{ title }}</h2>
            <div class="flex overflow-x-auto">
                <article
                    v-for="activity in data"
                    :key="activity.id"
                    class="shrink-0 w-2/3 md:w-1/5 lg:w-1/5 xl:w-1/5 pr-4"
                >
                    <div
                        class="bg-cyan-950 rounded-lg overflow-hidden shadow-lg"
                    >
                        <div class="relative">
                            <img
                                class="w-full h-48 object-cover"
                                src="https://source.unsplash.com/random/800x600/?activity"
                                alt="Activity Cover"
                            />
                            <span
                                class="absolute top-3 left-3 inline-block py-1 px-2 bg-gray-100 text-gray-700 rounded"
                                >randonnée</span
                            >
                            <span
                                class="absolute bottom-3 right-3 inline-block text-white text-2xl font-bold"
                                >{{ formatDate(activity.start_at) }}</span
                            >
                        </div>

                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">
                                {{ activity.name }}
                            </h3>
                            <div class="flex items-center mb-2">
                                <span class="text-green-500 mr-1"
                                    ><i class="fas fa-map-marker-alt"></i
                                ></span>
                                <span
                                    >{{ activity.localite }} -
                                    {{ activity.distance.toFixed(0) }}Km</span
                                >
                            </div>
                            <div class="flex items-center mb-2">
                                <span class="text-green-500"
                                    ><i class="fas fa-users"></i> 4/10</span
                                >
                            </div>
                            <p class="text-gray-400">
                                Proposé par {{ activity.user.name }}
                            </p>
                            <div class="text-center pb-2">
                                <a
                                    :href="
                                        route('activities.show', {
                                            id: activity.id,
                                        })
                                    "
                                    class="inline-block mt-4 bg-green-700 hover:bg-green-950 rounded-full px-4 py-2 text-white"
                                    >En savoir plus</a
                                >
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>
