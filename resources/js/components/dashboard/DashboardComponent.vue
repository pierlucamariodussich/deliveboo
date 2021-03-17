<template>
  <section id="dashboard">
    <div class="container">
      <!-- Sezione ristorante -->
      <div class="row m-3">
        <div class="col-lg-12 d-flex justify-content-start align-items-center media-flex-column">
          <div class="resturantImage m-5">
            <img :src="'/img/restaurant/' + restaurant.image_url" alt="" />
          </div>
          <div>
            <h1>{{ restaurant.name }}</h1>
            <p>{{ restaurant.address }}</p>
          </div>
        </div>
      </div>

      <div class="row  media-font-size">
        <div
          class="col-lg-3 d-flex justify-content-center align-items-center new-dish-button"
        >
          <a :href="createdish">
            <div
              class="d-flex flex-column justify-content-center align-items-center"
            >
              <img src="/img/dashboard/icon/new.png" alt="" />
              <p>Crea un nuovo piatto</p>
            </div>
          </a>
        </div>

        <div
          class="col-lg-3 d-flex flex-column justify-content-center align-items-center orders-button"
        >
          <a :href="orderlist">
            <div
              class="d-flex flex-column justify-content-center align-items-center"
            >
              <img src="/img/dashboard/icon/orders.png" alt="" />
              <p>Visualizza gli ordini</p>
            </div>
          </a>
        </div>

        <div
          class="col-lg-3 d-flex flex-column justify-content-center align-items-center orders-button"
        >
          <a href="/chart">
            <div
              class="d-flex flex-column justify-content-center align-items-center"
            >
              <img src="/img/dashboard/icon/statistic.png" alt="" />
              <p id="stats">Visualizza le statistiche</p>
            </div>
          </a>
        </div>

        <div
          class="col-lg-3 d-flex flex-column justify-content-center align-items-center orders-button"
        >
          <a :href="'/restaurant/' + restaurant.id + '/edit'">
            <div
              class="d-flex flex-column justify-content-center align-items-center"
            >
              <img src="/img/dashboard/icon/edit.png" alt="" />
              <p>Modifica ristorante</p>
            </div>
          </a>
        </div>
      </div>

      <!-- Sezione Menù -->
      <div class="row m-3 mt-5">
        <div class="col-lg-12">
          <h1>Gestione Menù</h1>
          <input
            v-model="search"
            @keyup.enter="filteredList()"
            class="custom-input"
            type="search"
            name=""
            id=""
            placeholder="Cerca un piatto"
          />
        </div>
      </div>
      <div
        class="row"
        v-for="(filteredDish, index) in filteredDishes"
        :key="index"
      >
        <div class="col-lg-2 d-flex justify-content-center align-items-center">
          <div>
            <img
              class="listImage"
              :src="'/img/restaurant/' + filteredDish.image_url"
              alt=""
            />
          </div>
        </div>
        <div  class="col-lg-3 d-flex justify-content-center align-items-center">
          <div
            
            class="d-flex flex-column justify-content-center align-items-start text-box"
          >
            <h4>
              {{ filteredDish.name }}
            </h4>
            <p>
              {{ filteredDish.description }}
            </p>
          </div>
        </div>
        <div class="col-lg-3 d-flex justify-content-center align-items-center">
          <p>{{ filteredDish.price }}€</p>
        </div>
        <div class="col-lg-4 d-flex justify-content-center align-items-center">
          <ul
            class="list-style-none d-flex justify-content-between align-items-center items-buttons"
          >
            <li class="m-2">
              <a :href="'/dishes/' + filteredDish.id"
                ><img src="/img/dashboard/icon/view-order-click.png" alt=""
              /></a>
            </li>
            <li class="m-2">
              <a :href="'/dishes/' + filteredDish.id + '/edit'"
                ><img src="/img/dashboard/icon/edit-little.png" alt=""
              /></a>
            </li>
          </ul>
        </div>
      </div>

      <div class="row m-3">
        <div class="col-lg-12">
          <h1>Tutti i piatti</h1>
        </div>
      </div>

      <div class="row dish mb-5" v-for="dish in dishes" :key="dish.id">
        <div class="col-lg-2 d-flex justify-content-center align-items-center">
          <div>
            <img
              class="listImage"
              :src="'/img/restaurant/' + dish.image_url"
              alt=""
            />
          </div>
        </div>
        <div id="media-flex-center" class="col-lg-3 d-flex justify-content-start align-items-center">
          <div
            
            class="d-flex flex-column justify-content-center align-items-start text-box"
          >
            <h4>
              {{ dish.name }}
            </h4>
            <p id="media-p">
              {{ dish.description }}
            </p>
          </div>
        </div>
        <div class="col-lg-3 d-flex justify-content-center align-items-center">
          <p>{{ dish.price }}€</p>
        </div>
        <div class="col-lg-4 d-flex justify-content-center align-items-center">
          <ul
            class="list-style-none d-flex justify-content-between align-items-center items-buttons"
            id="media-ul"
          >
            <li class="m-2">
              <a :href="'/dishes/' + dish.id"
                ><img src="/img/dashboard/icon/view-order-click.png" alt=""
              /></a>
            </li>
            <li class="m-2">
              <a :href="'/dishes/' + dish.id + '/edit'"
                ><img src="/img/dashboard/icon/edit-little.png" alt=""
              /></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "DashboardComponent",
  props: {
    restaurantdata: String,
    dishesdata: String,
    createdish: String,
    orderlist: String,
  },
  data() {
    return {
      restaurant: {},
      filteredDishes: [],
      search: "",
      dishes: {},
    };
  },

  methods: {
    filteredList() {
      return (this.filteredDishes = this.dishes.filter((dish) => {
        if (this.search == "") {
          return "";
        } else if (
          dish.name.toLowerCase().includes(this.search.toLowerCase())
        ) {
          return dish;
        }
      }));
    },
  },
  mounted() {
    var restaurantData = JSON.parse(this.restaurantdata);
    this.restaurant = restaurantData;
    var dishesData = JSON.parse(this.dishesdata);
    this.dishes = dishesData;
  },
};
</script>

<style lang="scss" scoped>
.items-buttons img {
  height: 30px;
}
.custom-input {
  width: 50%;
}
.new-dish-button img,
.orders-button img {
  height: 30px;
  width: auto;
  margin: 0;
}
.text-box p {
  white-space: nowrap;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
  max-width: 200px;
}

.listImage {
  object-fit: cover !important;
  outline: none !important;
  &:hover{
    outline: none !important;
  }
}

@media (max-width:993px){

  .dish{
    border-bottom:1px solid black;
  }

 
  .media-flex-column{
    flex-direction: column !important;
  }
  .custom-input{
    width: 100% !important;
  }

  .container {
    text-align: center !important;
  }

  .media-font-size {
    align-items: center;
    justify-content: center;
    font-size: 0.6rem;
    flex-wrap: nowrap;
    
}

#media-flex-center {
   
  justify-content:center !important;
  margin-top: 30px;
  .text-box{
    align-items:center !important;
    
  }
    
}

#media-ul {
    width: 100%;
    justify-content: flex-end !important;
}

#media-p {
  text-align: center !important;
  overflow: unset !important;
  white-space: unset !important;
  

}




  }

</style>