<template>
  <div id="join-component">
    <header>
      <div id="bg">
        <div class="d-flex justify-content-center align-items-end">
          <input
            v-model="query"
            @keyup.enter="search()"
            class="custom-input"
            type="text"
            name=""
            id=""
            placeholder="Cosa vuoi mangiare?"
          />
        </div>
      </div>
    </header>
    <ResturantSectionHome>
      <ButtonsComponent
        slot="buttons"
        @click.stop.native="addCategory(category.name,$event)"
        v-for="(category, index) in categories"
        :key="index"
        :categoryName="category.name"
        :categoryImg="category.image_url"
        :value="category.name"
        :id="category.id"
      />
      <ResturantComponent
        slot="resturant"
        v-for="(restaurant, index) in restaurants"
        :key="index"
        :resturantName="restaurant.name"
        :resturantImg="restaurant.image_url"
        :resturantAddress="restaurant.address"
        :link="'/restaurant/' + restaurant.id"
      />
    </ResturantSectionHome>
  </div>
</template>
<script>
import ResturantSectionHome from "./ResturantSectionHome.vue";
import ButtonsComponent from "./ButtonsComponent.vue";
import ResturantComponent from "./ResturantComponent.vue";
export default {
  name: "JoinComponent",
  components: {
    ResturantSectionHome,
    ButtonsComponent,
    ResturantComponent,
  },
  data() {
    return {
      query: "",
      checked: [],
      categories: [],
      restaurants: [],
    };
  },
  methods: {
    search() {
      this.restaurants = [];
      let el = document.getElementById("resturant-type");
      el.scrollIntoView({behavior: 'smooth'});
      console.log(this.query);
      axios
        .get("/api/restaurants", {
          params: {
            query: this.query,
          },
        })
        .then((response) => {
          const array = response.data;
          this.restaurants = array;
        });
      console.log(this.restaurants);
    },
    
    getCategories() {
      this.categories = [];
      axios.get("/api/genres").then((response) => {
        this.categories = response.data;
      });
    },

    addCategory(name, e){
      if(!this.checked.includes(name)){
        this.checked.push(name)
      }else{
        this.checked.splice(this.checked.indexOf(name),1)
      }

      if(this.checked.length >0){
        this.check();
      }
      
       if(e.target.parentNode.classList.contains("buttonCategory")){
        e.target.parentNode.classList.toggle("buttonCategorySelected")
       }
      console.log(e.target)
      
      
    },
    check(e) {
      this.restaurants = [];
      axios
        .get("/api/checked", { params: { query: this.checked } })
        .then((response) => {
          this.restaurants = response.data;
        });
    },
  },
  mounted() {
    this.getCategories();
    document.querySelector(".custom-input").focus();
  },
};
</script>

<style lang="scss" scoped>
div {
  height: calc(100% - 100px);
}
.custom-input {
  width: 50%;
  font-weight: 900;
  font-style: italic;
}


@media screen and (max-width:700px) {
  .custom-input {
  width: 80%;
}
  
}
</style>


