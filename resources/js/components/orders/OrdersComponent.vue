<template>
  <section id="orders-section">
    <div class="container p-5">
      <div class="row mb-4">
        <h1>Riepilogo ordini</h1>
      </div>
      <div class="row mb-3 p-3">
        <div class="col-3   d-flex justify-content-start align-items-center">
          <h3 class="media-text">ID</h3>
        </div>
        <div class="col-3  d-flex justify-content-start align-items-center">
          <h3 class="media-text">Data</h3>
        </div>
        <div class="col-3  d-flex justify-content-start align-items-center">
          <h3 class="media-text">Totale</h3>
        </div>
        <div class="col-3  d-flex justify-content-center align-items-center">
          <h3 class="media-text">Dettagli</h3>
        </div>
      </div>
      <div
        class="row mb-5 p-3 orders-box"
        
        v-for="order in orders"
        :key="order.id"
      >
        <div class="col-3 d-flex justify-content-start align-items-center">
          <span>{{ order.id }}</span>
        </div>
        <div class="col-3 d-flex justify-content-start align-items-center">
          <span class="media-text-small">{{ order.created_at }}</span>
        </div>
        <div class="col-3 d-flex justify-content-start align-items-center text-center">
          <span>{{ order.total }} €</span>
        </div>
        <div class=" col-3 d-flex justify-content-center align-items-center">
          <div @click="display(order)">
            <img src="/img/dashboard/icon/watch.png" alt="" class="icon" />
          </div>
        </div>

        <!-- DROPDOWN -->
        <div
          
          class="col media-margin"
          :id="order.id"
          :class="{
            invisible: selectedOrder != order.id,
            visible: selectedOrder == order.id,
          }"
        >
          <!-- Dati del cliente -->
          <div class="row media-padding">
            <div
              class="col-lg-12 d-flex justify-content-end align-items-center"
            >
              <a class="d-none d-md-block d-lg-block" href="#" @click="selectedOrder = null">CHIUDI</a>
            </div>
            <div
              class="col-lg-12 d-flex justify-content-start align-items-start mb-4"
            >
              <img src="/img/dashboard/icon/cel.png" alt="" class="icon1X" />
              <h6 class="ml-3">{{ order.client_phone }}</h6>
            </div>
            <div
              class="col-lg-6 d-flex justify-content-start align-items-center mb-4"
            >
              <img src="/img/dashboard/icon/id.png" alt="" class="icon1X" />
              <h6 class="ml-3">
                {{ order.client_name }} {{ order.client_surname }}
              </h6>
            </div>
            <div
              class="col-lg-6 d-flex justify-content-start align-items-center mb-4"
            >
              <img
                src="/img/dashboard/icon/address.png"
                alt=""
                class="icon1X"
              />
              <h6 class="ml-3">{{ order.client_address }}</h6>
            </div>
            <div
              class="col-lg-6 d-flex justify-content-start align-items-center mb-4"
            >
              <img src="/img/dashboard/icon/email.png" alt="" class="icon1X" />
              <h6 class="ml-3 word-break">{{ order.client_email }}</h6>
            </div>
            <div
              class="col-lg-12 d-flex justify-content-start align-items-center mb-4"
            >
              <h5>Prodotti Acquistati</h5>
            </div>

            <!-- Prodotti acquistati dal cliente -->
            <div class="col-lg-12">
              <div class="row media-flex" v-for="dish in order.get_dishes" :key="dish.id">
                <div
                  class=" col-lg-6 d-flex justify-content-start align-items-center media-margin-bottom"
                >
                  <p>{{ dish.name }}</p>
                </div>
                <div
                  class="col-lg-6 d-flex justify-content-start align-items-center media-margin-bottom"
                >
                  <p>  {{ dish.price }} €</p>
                </div>
              </div>
              <hr />
              <div class="col-lg-6 offset-lg-6">
                <span>{{ order.total }} €</span>
              </div>
            </div>
            <div
              class="col-lg-12 d-flex justify-content-end align-items-center"
            >
              <a class="d-block d-md-none d-lg-none" href="#" @click="selectedOrder = null">CHIUDI</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "OrdersComponent",
  props: {
    ordersarr: String,
  },
  data() {
    return {
      orders: [],
      selectedOrder: null,
    };
  },
  mounted() {
    const ordersData = JSON.parse(this.ordersarr);

    ordersData.forEach((order) => {
      let time = new Date(order.created_at);
      return (order.created_at =
        time.getDate() +
        "/" +
        (time.getMonth() + 1) +
        "/" +
        time.getFullYear() +
        " " +
        "-" +
        " " +
        time.getHours() +
        ":" +
        time.getMinutes() +
        ":" +
        time.getSeconds());
    });
    this.orders = ordersData;
    console.log(ordersData);
  },

  methods: {
    display(order) {
      this.selectedOrder = order.id;
      let el = document.getElementById(this.selectedOrder);
      // el.scrollIntoView({ behavior: "smooth" });
      // console.log(this.selectedOrder);
    },
  },
};
</script>

<style lang="scss" scoped>
.orders-box {
  border-radius: 20px;
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.icon {
  height: 20px;
  cursor: pointer;
}
.icon1X {
  height: 30px;
}
h5 {
  margin: 0;
}
.visible {
  opacity: 1;
  height: auto;
}
.invisible {
  transition: opacity 1s ease-out;
  opacity: 0;
  height: 0;
  overflow: hidden;
}
.media-padding{
  padding: 3rem !important;
}

.media-margin-bottom{
  margin-bottom: 1.5rem !important;
}

@media screen and (max-width:700px){
  .media-text {
    font-size: 0.9rem;
  }
  .media-text-small {
    font-size: 0.5rem;
  }
  .word-break{
    word-break: break-all;
  }
  .media-padding{
  padding: 0.5rem !important;
}
.media-margin{
  margin-top: 2rem !important;
}
.media-margin-bottom {
  margin-bottom: 0.5rem !important;
}
.media-flex {
  flex-wrap: nowrap;
}
}
</style>