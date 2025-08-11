export const Callout = {
  props: {
    type: {
      type: String,
      default: 'note',
      validator: (value) => ['danger', 'info', 'note', 'warning'].includes(value)
    },
    title: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      isContentVisible: false
    }
  },
  computed: {
    iconClass() {
      const icons = {
        danger: 'fa-exclamation-circle',
        info: 'fa-info-circle',
        note: 'fa-sticky-note',
        warning: 'fa-exclamation-triangle'
      }
      return `fa ${icons[this.type]} fa-fw`
    },
    titleClass() {
      return `w3-${this.type }`
    },
    headerClass() {
      return `w3-header-${this.type}`
    }
  },
  methods: {
    toggleContent() {
      this.isContentVisible = !this.isContentVisible
    }
  },
  template: `
    <div style="display:block;" class="callout">
      
      <div :class="[headerClass]" style="text-align: center;" @click="toggleContent">
        
        <div class="w3-quarter">
          <i :class="[iconClass, titleClass ]" style="font-size: 36pt;"></i>
        </div>

        <div class="w3-threequarter" style="text-align: left;">
          <h3 :class="[titleClass]">{{ title || type.toUpperCase() }}</h3>
          <span  :class="[titleClass]" v-if="isContentVisible">- Replier</span>
          <span  :class="[titleClass]" v-if="!isContentVisible">+ Déplier</span>
        </div>

      </div>
    
      <div>
        <div class="content" v-show="isContentVisible">
            <slot></slot>
        </div>
      </div>
    </div>
  `
}
