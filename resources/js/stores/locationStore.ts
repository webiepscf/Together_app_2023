// stores/geoLocationStore.js
import { defineStore } from 'pinia';

export const useLocationStore = defineStore({
  id: 'location',
  state: () => ({
    position: null,
  }),
  actions: {
    async fetchPosition() {
      try {
        const position = await new Promise((resolve, reject) => {
          navigator.geolocation.getCurrentPosition(resolve, reject);
        });
        this.setPosition(position);
      } catch (error) {
        console.error('Error fetching user position:', error);
      }
    },
    setPosition(position) {
      this.position = position;
    },
  },
});
