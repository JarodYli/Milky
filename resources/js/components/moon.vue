<template>
  <div>

    <v-circle
      ref="orb"
      @click="satelites = true"
      :config="{
            x:xC,
            y:yC,
            radius: 1,
            fill: '#BEC5AD',
            trackX: kX,
            trackY: kY,
        }"/>

  </div>
</template>

<script>
export default {
  props: {
    xC: Number,
    yC: Number,
    ord: Object,
    kX: Number,
    kY: Number
  },

  data() {
    return {
      degree: 180,
      amp: 13,
      satelites: false,
      list: []
    };
  },

  methods: {
    
  },

  mounted() {
    // console.log("Mounting Moon");
    const vm = this;
    const amplitude = 400;
    const period = 2000;
    var radians = 1;

    const sun = this.$refs.orb.getStage();
    const centerX = sun.attrs.x;

    const centerY = sun.attrs.y;

    // console.log("ord:", this.$refs.orb.getStage().attrs.x);

    const anim = new Konva.Animation(function(frame) {

      var centerX = sun.attrs.trackX;
      var centerY = sun.attrs.trackY;

      radians = (frame.time * 2 * Math.PI) / period;

      sun.setX(vm.amp * Math.sin(radians) + parseInt(centerX));
      sun.setY(vm.amp * Math.cos(radians) + parseInt(centerY));

    }, sun.getLayer());

    anim.start();
  }
};
</script>

<style>
</style>