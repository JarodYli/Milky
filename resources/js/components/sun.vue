    <template>
  <div>

    <v-text ref="text" :config="{
          x: 400,
          y: 400,
          fontFamily: 'Calibri',
          fontSize: 40,
          text: info,
          fill: 'white'
        }" />
   
    <v-circle
    @click="log"
      @mouseover="getInfo"
      @mouseleave="getLess"
      ref="orb"
      :config="{
                    x:xC,
                    y:yC,
                    amplitude: ampC,
                    start: degreeC,
                    radius: 20,
                    fill: '#F8E4A2',
                    SunID: SunID,
                }"
    />

    <!-- Planets added on load from database-->
    <planet
      v-for="item in planets"
      ref="satelite"
      :key="item.id"
      :kX="item.trackX"
      :kY="item.trackY"
      :ampC="item.amp"
      :degreeC="item.degree"
      :sati="item.moons"
    ></planet>
  </div>
</template>

    <script>
export default {
  props: {
    xC: Number,
    yC: Number,
    ord: Object,
    ampC: Number,
    degreeC: Number,
    SunID: String,
    planetObj : String,
    sunObj : Object,
  },

  data() {
    return {
      info: "",
      planets: [],
    };
  },

   mounted() {

    this.planets = JSON.parse(this.planetObj);

    const vm = this;
    const sun = this.$refs.orb.getStage();
    const centerX = sun.attrs.x;
    const centerY = sun.attrs.y;

    vm.amp = sun.attrs.amplitude;

    const period = (2000 * vm.amp) / 1.5;

    // Translates degrees -> radians and is the where the sun first starts its orbit
    var radians = sun.attrs.start * (Math.PI / 180);
    // console.log('radians of beggining:', radians);
    // console.log("attrs",sun.attrs);

    // nuX and nuY are temporary attributes that pass out of the
    // animation frame into the addPlanet() and move()
    var obj = { nuX: 0, nuY: 0 };

    // Animation of Sun starts here
    const anim = new Konva.Animation(function(frame) {
      
      sun.setX(vm.amp * Math.sin(radians) + centerX);
      sun.setY(vm.amp * Math.cos(radians) + centerY);

      // object object that keeps track of x and y positons to pass to the Sun's planets
      obj.nuX = vm.amp * Math.sin(radians) + centerX;
      obj.nuY = vm.amp * Math.cos(radians) + centerY;

      // radians = (frame.time * 2 * Math.PI) / period;
      radians = radians + (60 * 2 * Math.PI) / period;
   
        vm.move(obj);

    }, sun.getLayer());
    anim.start();
  },

  methods: {

    // Updates each object in the list of planets a Sun has
    move(obj) {
      for (let planet in this.planets) {
        this.planets[planet].trackX = obj.nuX;
        this.planets[planet].trackY = obj.nuY;

      }
    },

    getInfo(){
      this.info = "";
      this.info = this.sunObj.name + ": " + this.sunObj.Description;
    },

    getLess(){
      this.info = "";
    },

    log() {
      // this.planets = JSON.parse(this.planets[0].Satelites);
      console.log("Planets:", this.planets);
      console.log("V:", this.v);
      console.log("SunID:", this.SunID);
    }
  }
};
</script>

    <style>
</style>