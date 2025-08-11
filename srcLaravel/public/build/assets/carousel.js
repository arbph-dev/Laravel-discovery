// Import Vue essentials
import { ref, onMounted, onUnmounted } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';

export const ImageCarousel = {
  props: {
    period: {
      type: Number,
      default: 5000, // Temps entre chaque image (en ms)
    },
  },
  template: `
    <div class="cp_carousel">
      <div class="cp_carousel-images">
        <div v-for="(node, index) in slotsContent" :key="index" 
             v-show="index === currentIndex" class="cp_carousel-image-wrapper">
          <component :is="node" />
        </div>
      </div>
      <div class="cp_carousel-controls">
        <button @click="prevImage" aria-label="Previous Image">‹</button><label class="cp_carousel-image-counter" >{{ currentIndex + 1 }} / {{ totalImages }} </label><button @click="nextImage" aria-label="Next Image">›</button>
        <br/>
        
      </div>
        <label class="cp_carousel-image-caption" >{{ currentCaption }} </label>
    </div>
  `,
  setup(props, { slots }) {
    const currentIndex = ref(0); // Image actuellement affichée
    const intervalId = ref(null); // ID de l'intervalle pour le changement automatique
    const slotsContent = slots.default ? slots.default() : []; // Récupère les contenus des slots
    const totalImages = ref(slotsContent.length); // Nombre total d'images
    const currentCaption = ref('');
    
    const getAltText = (node) => {
      if (node.type === 'a' && node.children && node.children[0].props && node.children[0].props.alt) {
        return node.children[0].props.alt;
      }
      return '';
    };

    const updateCaption = () => {
      currentCaption.value = getAltText(slotsContent[currentIndex.value]);
    };

    const startInterval = () => {
      stopInterval(); // Arrête l'intervalle précédent
      intervalId.value = setInterval(() => {
        nextImage();
      }, props.period);
    };

    const stopInterval = () => {
      if (intervalId.value) {
        clearInterval(intervalId.value);
        intervalId.value = null;
      }
    };

    const nextImage = () => {
      currentIndex.value = (currentIndex.value + 1) % totalImages.value;
      updateCaption();
    };

    const prevImage = () => {
      currentIndex.value =
        (currentIndex.value - 1 + totalImages.value) % totalImages.value;
        updateCaption();
    };

    onMounted(() => {
      startInterval();
      updateCaption();
    });

    onUnmounted(() => {
      stopInterval();
    });

    return {
      currentIndex,
      totalImages,
      slotsContent,
      nextImage,
      prevImage,
      currentCaption,
    };
  },
};
