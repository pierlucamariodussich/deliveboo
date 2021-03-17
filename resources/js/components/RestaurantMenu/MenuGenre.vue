<template>
     <div id="menu">
    <div class="container restaurant">
      <div class="row">
        <div class="col-12">
          <h1>Menù</h1>
        </div>
        <div class="col-12" >
          <ul class="oval-button">
            <li
              v-for="(genre, index) in genreList"
              :key="index"
              @click="selectCategory(genre.name)"
              :class="{
                selected: genre.name === categorySelect,
                notselected: genre.name != categorySelect,
              }"
            >
              <img class="icon" :src="'/'+genre.image_url" alt="" />
              <!-- ondragstart="return false" 
                         onselectstart="return false"
                         evita evidenziazione del testo -->
              <span ondragstart="return false" onselectstart="return false">
                {{ genre.name }}
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container menu">
      <div class="row">
        <div class="col-12" v-if="$data.categoryDishes == true">
          <!-- categoria -->
          <h2>Pizza</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12 p-0">
          <div
            class="dish d-flex justify-content-start align-items-center"
            v-for="(dish, i) in filtered"
            :key="i"
          >
            <div
              class="dishinfo d-flex justify-content-start align-items-center"
            >
              <div class="dishImg">
                <div class="listImage dishImg">
                  <img class="" :src="'/img/restaurant/' + dish.image_url" alt="" />
                </div>
              </div>
              <div class="dishtext">
                <h3>{{ dish.name }}</h3>
                <h5>{{ dish.description }}</h5>
              </div>
            </div>
            <div class="price d-flex justify-content-end align-items-center">
              <h1>{{ dish.price }}€</h1>
            </div>
            <div
              class="counter-box d-flex justify-content-end align-items-center"
            >
              <div class="counter d-flex justify-content-between">
      
                <div class="bt" @click="changeCounter('-', i)">
                  <span ondragstart="return false" onselectstart="return false">
                    -
                  </span>
                </div>
                <div class=" ">
                  <span> {{ dish.counter }} </span>
                </div>
                <div class="bt" @click="changeCounter('+', i)">
                  <span ondragstart="return false" onselectstart="return false">
                    +
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- carrello -->
    <div class="container cart" v-if="cartActive === true">
      <div class="row">
        <div class="col-12 d-flex">
          <div
            class="cartTitle d-flex justify-content-start align-items-center"
          >
            <h1>Carrello</h1>
          </div>
          <div
            class="close d-flex justify-content-end align-items-start"
            @click="openAndClose()"
          >
            <img src="/images/close_white.png" alt="" />
          </div>
        </div>
        <div class="col-12 d-flex flex-row flex-wrap">
          <div class="order d-flex" v-for="(order, ind) in cart" :key="ind">
            <div
              class="quantity d-flex justify-content-start align-items-center"
            >
              <ul class="oval-white-button">
                <li class="notselected">
                  <img src="" alt="" />
                  <span ondragstart="return false" onselectstart="return false">
                    x{{ order.counter }}
                  </span>
                </li>
              </ul>
            </div>
            <div class="dishes d-flex justify-content-start align-items-center">
              <div class="dishImg">
                <div class="cartImage">
                  <img :src="'/img/restaurant/' + order.dishImgUrl" alt="" />
                </div>
              </div>
              <div class="dishtext">
                <h3>{{ order.dishName }}</h3>
                <h6>{{ order.dishPrice }} € x {{ order.counter }} =</h6>
              </div>
            </div>
            <div class="price d-flex justify-content-end align-items-center">
             <!-- nel caso ritorna il filtro sarebbe order.totalPrice -->
              <h1>{{ order.dishPrice}} €</h1>
            </div>
            <div class="delete d-flex justify-content-end align-items-center">
              <button @click.stop="deleteOrder(ind)">X</button>
            </div>
          </div>
        </div>
        <div
          class="col-6 d-flex flex-column justify-content-center align-items-start"
        >
          <h1>Totale ordine</h1>
          <h1>{{ TotalPrice }}</h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
          <!-- @submit="goToPayment" -->
          <button class="btn-light" @click="goToPayment()">
            <span>VAI AL PAGAMENTO </span>
          </button>
        </div>
      </div>
    </div>

    <!-- attiva carrello -->

    <div class="container cartButton" >
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-1 ">
          <div
            class="roundedCart d-flex justify-content-center align-items-center"
            @click="openAndClose()"
          >
            <img src="/images/cart.svg" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>


  
</template>

<script>
export default {
  name:'MenuGenre',
  props: {
    data: String,
  },
  data(){
    return{
      dishesImport: [],
      dishes: [],
      genreList:[],
      restaurantId:0,
      categorySelect:'',
      count: [],
      orders: [],
      cartActive: false,
      // cartElements:[],
      // cartFiltered:[],
      cart:[],
      total:0,
      dishInCart:[],
            
    }
  },
  mounted:function(){

    //DATI
    //importo ARRAY dei dati del ristorante
    var data = JSON.parse(this.data);

    
    this.dishesImport = data.get_dishes;

    //aggiungi oggetto counter per la quantità 
    this.dishes = this.dishesImport.map((element) => {
      this.elementUpgrade = { ...element, counter: 0 };
      return this.elementUpgrade;
    });
    //controllo ARRAY piatti
    console.log('piatti');console.log(this.dishes);

    //estraggo ARRAY GENERI
    this.genreList = this.dishes.map((element) => {
            this.genre = element.get_genre;
            return this.genre;
          });

    //filtro per eliminare doppioni nell'ARRAY GENERI mi restituisce nomi e immagini
    this.genreList = this.genreList.filter((genre,index,self)=>
                 index === self.findIndex((g)=>(
                 g.name === genre.name && g.image_url === genre.image_url
                 )));
    //controllo ARRAY generi
    console.log('generi');console.log(this.genreList);

    //estraggo ARRAY RISTORANTE
    this.restaurantId = this.dishes.map(e => {
                 this.id = e.restaurant_id;
                 return this.id });
                 this.restaurant_id = this.restaurantId.splice(1); 
    //controllo ID ristorante
    console.log('ARRAY ID RISTORANTE');console.log(this.restaurantId)
  
  },
  computed:{

    //FUNZIONE filtered crea virtualmente un ARRAY filtrato
    //dei piatti  che hanno il genere uguale a quello selezionato 

    filtered(){
      return this.dishes.filter((e)=>{
        return e.get_genre.name.includes(this.categorySelect);
      })},
    
    //calcola il totale del carrello e lo trasforma in formato prezzo

    TotalPrice(){

      return new Intl.NumberFormat("it-IT", {
        style: "currency",
        currency: "EUR",
      }).format(this.total);
    },
    

  },
  methods:{


    //AL CLICK FILTRA PER CATEGORIA
    selectCategory(category) {
      return (
        (this.categorySelect = category),
        console.log(
          "Cosa ci fa qui? Hai voglia di " +
            this.categorySelect +
            " ? Scegli Deliveboo ;)"
        )
      );
    },

    //CARRELLO

    //CONTATORE
    changeCounter(direction, index){
       this.filtered.forEach((dish, i) => {
        if (direction == "+" && i === index) {
          dish.counter++; //aumenta il contatore di 1
          this.putInCart(i); //attiva funzione di creazione ordine e carrello
          this.cartActive = true; //attiva la sezione carrello
        } else if (direction == "-" && i === index) {
            if (dish.counter === 0) { //blocca il counter a 0
              this.cartActive = false; // chiude sezione carrello
          } else {
            dish.counter--; //decrementa il contatore
            this.deleteOrder(i); //attiva funzione di cancellazione degli elementi
          }
        }
      });
    },

    //AGGIUNGE ELEMENTO AD UN CARRELLO NON FILTRATO

    putInCart(index) {
      this.filtered.forEach((dish, i) => {
        if (index === i && dish.counter != 0 && dish.name) {
          this.cart.push({ //se attivo filtro this.cart diventa this.cartElement
            dishId:dish.id,
            quantity: dish.counter,
            dishName: dish.name,
            dishImgUrl: dish.image_url,
            dishPrice: dish.price,
            // totalPrice: parseFloat(dish.price) * dish.counter,
          });
          this.orders.push({
            dishId: dish.id,
          });

          //ID piatti nel carrello
          this.dishInCart = this.orders.map(e=>{
            this.order = e.dishId;
            return this.order
          })
          console.log('ordine nel carrello');console.log(this.dishInCart);
          
          // DA RIVEDERE
          //filtro carrello
          this.cartFiltered = this.cart.filter((order,index,self)=>
                 index === self.findIndex((o,) => (
                 o.dishId === order.dishId
                 )));
          
          



          //TOTALE ORDINE
          this.total = this.cart.reduce(
          (total, order) => total + parseFloat(order.dishPrice),
           0  );

          //

          this.saveCart();
          this.saveDish();
          this.saveRestaurant();
          this.saveTotal();

         
          console.log('CART ELEMENTI'); console.log(this.cartElements);
          console.log('CART FILTRO');console.log(this.cartFiltered);
          console.log('CART FINALE');console.log(this.cart);
          console.log('Dish');console.log(this.dishInCart);
          console.log('Total');console.log(this.total);
          } else {
           
        }
      });
    },

    //ELIMINA UN ORDINE QUANDO VIENE CLICCATO - SUL CONTATORE

    deleteOrder: function (delIndex) {
      this.cart.splice(delIndex, 1);
      this.orders.splice(delIndex, 1);
      this.total = this.cart.reduce(
          (total, order) => total + parseFloat(order.dishPrice),
           0  );
      
          this.saveCart();
          this.saveDish();
          this.saveRestaurant();
          this.saveTotal();
      if (this.cart.length != 0) {
        this.cartActive = true;
      } else  {
        this.cartActive = false;
      }
      console.log('ORDER-DELETE');console.log(this.orders);
      console.log('ORDER-DELETE');console.log(this.cart);
      console.log('Total');console.log(this.total);
    },

    //ATTIVA CARRELLO{}
    //PER RIEMPIMENTO CARRELLO

    activeCart() {
      if (this.cart.length != 0) {
        this.cartActive = true;
      } else {
        this.cartActive = false;
      }
    },

    //PER CLICK
    openAndClose() {
      if (this.cartActive === false) {
        this.cartActive = true;
      } else if (this.cartActive === true) {
        this.cartActive = false;
      }
    },


    //INVIO DATI

    saveCart() {
      const parsed = JSON.stringify(this.cart);
      localStorage.setItem("cart", parsed);
    },
    saveDish() {
      const parsed = JSON.stringify(this.dishInCart);
      localStorage.setItem("orders", parsed);
    },
    saveRestaurant() {
      const parsed = JSON.stringify(this.restaurantId);
      localStorage.setItem("restaurantId", parsed);
    },
    saveTotal() {
      const parsed = JSON.stringify(this.total);
      localStorage.setItem("total", parsed);
    },


    // Vai al pagamento
    goToPayment() {
      this.saveCart();
      this.saveDish();
      this.saveRestaurant();
      this.saveTotal();
      location.replace("/infoClienti");
    }


  },


}

</script>

<style lang="scss" scoped>
#menu {
  .restaurant {
    margin-top: 15px;
    margin-bottom: 15px;
    .row {
      .col-12 {
        h1 {
          margin-bottom: 30px;
          font-size: 50px;
          font-weight: 900;
          line-height: 50px;
        }
      }
    }
  }
  .menu {
    margin-top: 25px;
    margin-bottom: 25px;
    .row {
      .col-12 {
        margin: 20px 0px;
        width: 100vw;
        .dish {
          padding: 20px 0;
          .dishinfo {
            width: 60%;
            .dishImg {
              width: 100px;
              height: 100px;
            }
            .dishtext {
              margin: 0 15px;
              h3 {
                font-size: 25px;
                font-weight: 700;
                margin-bottom: 10px;
              }
              h5 {
                font-size: 12px;
                font-weight: 400;
                color: #5f5c5c;
              }
            }
          }
          .price {
            width: 20%;
            margin: 0 15px;
            h1 {
              font-size: 30px;
              font-weight: 700;
              color: #2dccbc;
            }
          }
          .counter-box {
            margin: 0 50px;
            height: 40px;
            width: 20%;
            background-color: black;
            border-radius: 30px;
            &:hover {
              border: none;
            }

            .counter {
              width: 100%;

              div {
                width: 70px;
                text-align: center;
                span {
                  color:white;
                  height: 30px;
                  font-size: 30px;
                  font-weight: 500;
                  line-height: 40px;
                }
              }
              .bt {
                height: 40px;
                border: none;
                line-height: 40px;
                text-align: center;
                &:hover {
                  background-color: #b3f5fd;
                  line-height: 40px;
                  span{
                  color: black;
                  }
                    
                }
                &:hover:first-child {
                  border-top-left-radius: 30px;
                  border-bottom-left-radius: 30px;
                }

                &:hover:last-child {
                  border-top-right-radius: 30px;
                  border-bottom-right-radius: 30px;
                }
                span {
                  height: 30px;
                  font-size: 20px;
                  font-weight: 400;
                }
              }
            }
          }
        }
      }
    }
  }
  .cart {
    box-sizing: border-box;
    min-width: 100vw;
    height: 4z0vh;
    background-color: black;
    position: fixed;
    bottom: 0;
    overflow-y: scroll;
    z-index: 3;
    .row {
      padding: 50px 200px;
      .col-12 {
        .cartTitle {
          width: 50%;
          h1 {
            color: white;
            font-size: 30px;
            font-weight: 900;
          }
        }
        .close {
          width: 50%;
          img {
            height: 30px;
          }
        }
        .order {
          padding: 30px 0px;
          border-bottom: 1px solid white;
          flex-basis: 47%;
          &:nth-child(n) {
            margin-right: 20px;
          }

          .dishes {
            width: 50%;
            .dishtext {
              margin-left: 30px;
              h3 {
                color: white;
                font-size: 15px;
                font-weight: 600;
              }
              h6 {
                color: white;
                font-size: 12px;
                font-weight: 300;
              }
            }
          }
        }

        .price {
          width: 30%;
          margin: 0 10px;
          h1 {
            color: #2fbcae;
            font-size: 18px;
            font-weight: 200;
            line-height: 30px;
          }
        }
        .delete {
          button {
            margin-left: 15px;
            background: none;
            color: white;
            border: none;
            font-size: 15px;
            font-weight: 400;
          }
        }
      }
    }

    .col-6 {
      margin: 30px 0;
      h1 {
        color: white;
        font-size: 20px;
        font-weight: 900;
        &:last-child{
          color: #2fbcae;
        }
      }
      .btn-light {
        background-color: #b3f5fd;
        border: none;
        height: 40px;
        border-radius: 30px;
        padding: 0 85px;
        &:hover {
          background-color: white;
        }
        span {
          color: black;
          font-weight: 600;
          font-size: 15px;
          line-height: 30px;
          &:hover {
            text-decoration: none;
          }
        }
      }
    }
  }
  .cartButton {
    box-sizing: border-box;
    width: 80px;
    position: fixed;
    top: 20px;
    right: 25px;
    z-index: 2;
    .row {
      width:100%;
      .col-1 {
        .roundedCart {
          height: 60px;
          width: 60px;
          border: 4px solid black;
          border-radius: 50%;
          background-color: white;
          img {
            height: 30px;
            width: 30px;
          }
          &:hover {
            background-color: #b3f5fd;
            border: none;
          }
        }
      }
    }
  }
}
</style>