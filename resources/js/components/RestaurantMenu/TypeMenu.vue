<template>
     <div id="menu">
    <div class="container restaurant">
      <div class="row">
        <div class="col-12 menuContainer">
          <h1>Menù</h1>
        </div>
        <div class="col-12 dishContainer" >
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
        <div class="dishContainer  p-0">
          <div
            class="dish d-flex justify-content-start align-items-center"
            v-for="(dish, i) in filtered"
            :key="i"
          >
            <div
              class="dishinfo  col-xl-6  col-md-12 col-sm-12 d-flex justify-content-xl-start align-items-xl-center"
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
            <div class="price col-xl-3  col-md-6 col-sm-6 d-flex justify-content-xl-center align-items-xl-center">
              <h1>{{ dish.price }}€</h1>
            </div>
            <div class=" orderButton col-xl-3  col-md-5 col-sm-5">
              <button class="black-button" @click="putInCart(i)"> 
                Ordina +
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- carrello -->
    <div class="container cart " v-if="cartActive === true">
      <div class="row">
        <div class="col-12 cartContainer d-flex">
          <div
            class="cartTitle  d-flex  justify-content-sm-start align-items-sm-start justify-content-xl-start align-items-xl-center"
          >
            <h1>Carrello</h1>
          </div>
          <div
            class="close d-flex  justify-content-end align-items-start"
            @click="openAndClose()"
          >
            <img src="/images/close_white.png" alt="" />
          </div>
        </div>
        <div class=" col-12 cartContainer  d-flex flex-xl-row flex-xl-wrap ">
          <div class="order d-flex" v-for="(order, ind) in cart" :key="ind">
            <div class="dishes d-flex  justify-content-start align-items-center">
              <div class="dishImg">
                <div class="cartImage">
                  <img :src="'/img/restaurant/' + order.dishImgUrl" alt="" />
                </div>
              </div>
              <div class="dishtext">
                <h3>{{ order.dishName }}</h3>
              </div>
            </div>
            <div class="price d-flex justify-content-sm-end align-items-sm-center justify-content-xl-end align-items-xl-center">
             <!-- nel caso ritorna il filtro sarebbe order.totalPrice -->
              <h1>{{ order.dishPrice}} €</h1>
            </div>
            <div class="delete d-flex  justify-content-sm-end align-items-sm-center justify-content-xl-end align-items-xl-center">
              <button @click.stop="deleteOrder(ind)">X</button>
            </div>
          </div>
        </div>
        <div
          class="col-xl-6  col-sm-12 col-md-12 orderContainer d-flex flex-column justify-content-center align-items-start"
        >
          <h1>Totale ordine</h1>
          <h1>{{ TotalPrice }}</h1>
        </div>
        <div class="col-xl-6 col-sm-12 col-md-12  orderContainer d-flex justify-content-xl-end align-items-xl-center">
          <!-- @submit="goToPayment" -->
          <button class="btn-light" @click="goToPayment()">
            <span>VAI AL PAGAMENTO </span>
          </button>
        </div>
      </div>
    </div>

    <!-- attiva carrello -->

    <div class="container cartButton" >
      <div class="row d-flex justify-content-xl-center align-items-xl-center">
        <div class="col-1 pull ">
          <div
            class="roundedCart d-flex justify-content-xl-center align-items-xl-center"
            @click="openAndClose()"
          >
            <img src="/images/cart.svg" alt="" />
          </div>
        </div>
      </div>
    </div>
  

  <!-- carrello mobile -->
    <div class="container cartMobileButton" >
      <div class="row">
        <div class="buttonContainer col-1">
          <div
            class="roundedCart"
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
      quantity:[],
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

    filteredCart(){
      return this.cart.filter((order,index,self)=>
               index === self.findIndex((o,i) => (
                     o.dishId === order.dishId
                 )));
            

    },


    
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
          this.putInCart(i); //attiva funzione di creazione ordine e carrello
          this.cartActive = true; //attiva la sezione carrello
        } else if (direction == "-" && i === index) {
            if (dish.counter === 0) { //blocca il counter a 0
              this.cartActive = false; // chiude sezione carrello
          } else {
            this.deleteOrder(index);
          }
        }
      });
    },

    //AGGIUNGE ELEMENTO AD UN CARRELLO NON FILTRATO

    putInCart(index) {
      this.filtered.forEach((dish, i) => {
        if (index === i && dish.counter >= 0) {
          this.cart.push({ //se attivo filtro this.cart diventa this.cartElement
            dishId: dish.id,
            dishName: dish.name,
            dishImgUrl: dish.image_url,
            dishPrice: dish.price,
          });
          this.cartActive=true;
          this.orders.push({
            dishId: dish.id,
          });

          //quantità piatti nel carrello
          // this.quantity = this.cart.map(e=>{
          //   this.quantity = e.quantity;
          //   return this.quantity
          // })
          // console.log('quantità');console.log(this.quantity);

          //ID piatti nel carrello
          this.dishInCart = this.orders.map(e=>{
            this.order = e.dishId;
            return this.order
          })
          console.log('ordine nel carrello');console.log(this.dishInCart);
          
          //TOTALE ORDINE
          this.total = this.cart.reduce(
          (total, order) => total + parseFloat(order.dishPrice),
           0  );

          //

          this.saveCart();
          this.saveDish();
          this.saveRestaurant();
          this.saveTotal();

         
          console.log('quantity');console.log(this.quantity);
          console.log('CART FILTRO');console.log(this.filteredCart);
          console.log('CART FINALE');console.log(this.cart);
          console.log('Dish');console.log(this.dishInCart);
          console.log('Total');console.log(this.total);
          } else {
           
        }
      });
    },

    //ELIMINA UN ORDINE QUANDO VIENE CLICCATO - SUL CONTATORE

    deleteOrder: function (delIndex) {
        this.cart.splice(delIndex,1)
        this.orders.splice(delIndex,1);
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
    margin-top: 30px;
    margin-bottom: 15px;
    .row {
      .menuContainer {
        h1 {
          color: black;
          margin: 30px 0;
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
      .dishContainer {
        width: 100%;
        margin: 20px 0px;
        .dish {
          padding: 20px 0;
          margin-bottom: 15px;
          .dishinfo {
            .dishImg {
              width: 80px;
              height: 80px;
            }
            .dishtext {
              margin: 0 15px 15px 15px;
              width: 100%;
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
            margin: 0 15px;
            h1 {
              font-size: 30px;
              font-weight: 700;
              color: #2dccbc;
            }
          }
        }
      }
    }
  }
  .cart {
    box-sizing: border-box;
    min-width: 100vw;
    height: 40vh;
    background-color: black;
    position: fixed;
    bottom: 0;
    overflow-y: scroll;
    z-index: 3;
    .row {
      padding: 50px 200px;
      .cartContainer{
        margin-bottom: 15px;
        .cartTitle {
          width: 50%;
          h1 {
            color: white;
            font-size: 40px;
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
          margin-bottom: 10px;
          padding: 15px 30px;
          border: 1px solid white;
          border-radius: 50px;
          flex-basis: 47%;
          &:hover{
            border:none;
            background:#b3f5fd;
            .dishes {
            .dishtext {

              h3 {
                color: black;
              }
              h6 {
                color: black;
              }
            }
          }
          .price {
          h1 {
            color: black;
            font-weight: 700;
          }
        }
        .delete {
          button {
            color: black;
            font-weight: 700;
          }
        }
        }
          &:nth-child(n) {
            margin-right: 20px;
          }

          .dishes {
            width: 50%;
            .dishtext {
              margin-left: 30px;
              h3 {
                color: white;
                font-size: 18px;
                font-weight: 600;
              }
              h6 {
                color: white;
                font-size: 15px;
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
            font-size: 30px;
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
            font-size: 22px;
            font-weight: 400;
          }
        }
      }
    }

    .orderContainer  {
      margin: 30px 0;
      h1 {
        color: white;
        font-size: 30px;
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
      .pull {
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
  .cartMobileButton{
    visibility: hidden;
    .row {
      width:100%;
      .buttonContainer {
        .roundedCart {
          height: 60px;
          width: 60px;
          border: 4px solid black;
          border-radius: 50%;
          background-color: white;
          img {
            height: 0px;
            width: 0px;
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

@media (max-width: 576px) {
  #menu {
  .restaurant {
    margin-top: 15px;
    margin-bottom: 15px;
    .row {
      .menuContainer {
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
    margin-top: 15px;
    margin-bottom: 25px;
    .row {
      .dishContainer {
        margin: 20px 0px;
        .dish {
          flex-wrap: wrap;
          flex-basis: 100%;
          padding: 20px 0;
          border-bottom: 1px solid black;
          .dishinfo {
            margin-bottom: 15px;
            width: 100%;
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
            justify-content:center;
            align-items: center;
            width: 40%;
            background-color: #b3f5fd;
            border-top-right-radius: 30px ;
            border-bottom-right-radius: 30px ;
            h1 {
              font-size: 30px;
              font-weight: 700;
              color: black;
            }
          }
          .orderButton{
            display: flex;
            justify-content: center;
            width: 50%;
            
          }
        }
          
        
      }
    }
  }
  .cart {
    width: 100vw;
    height: 50vh;
    position: fixed;
    bottom:0;
    background-color: black;
    overflow-y: scroll;
    z-index: 3;
    .row {
      padding:0;
     
      .cartContainer{
        margin: 0;
        padding: 30px;
        width: 100%;
        flex-wrap: wrap;
        flex-basis: 100%;
        .cartTitle {
          
          h1 {
            color: white;
            font-size: 40px;
            font-weight: 900;
          }
        }
        .close {
          

          img {
            height: 30px;
          }
        }
        .order {
          
          margin-bottom: 10px;
          padding: 15px 30px;
          border: 1px solid white;
          border-radius: 50px;
          flex-basis: 100%;
          &:hover{
            border:none;
            background:#b3f5fd;

          
            .dishes {
              .dishImg{
              width: 60px;
            }
            .dishtext {
              h3 {
                color: black;
              }
              h6 {
                color: black;
              }
            }
          }
          .price {
            h1 {
            color: black;
            font-weight: 700;
            }
          }
        .delete {
          button {
            color: black;
            font-weight: 700;
          }
         }
        }
        &:nth-child(n) {
            margin-right: 20px;
        }

          .dishes {
            width: 100%;
            .dishImg{
              width: 60px;
            }
            .dishtext {
              width: 30%;
              margin-left: 5px;
              h3 {
                color: white;
                font-size: 12px;
                font-weight: 600;
              }
              h6 {
                color: white;
                font-size: 15px;
                font-weight: 300;
              }
            }
          }
        

        .price {
          margin: 0 2px;
          h1 {
            color: #2fbcae;
            font-size: 15px;
            font-weight: 200;
            line-height: 50px;
          }
        }
        .delete {
          button {
            margin-left: 15px;
            background: none;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: 400;
          }
        }
      }
    }
    

    .orderContainer  {
      margin: 30px 0;
      padding:0 30px;
      h1 {
        color: white;
        font-size: 30px;
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
          font-size: 10px;
          line-height: 30px;
          &:hover {
            text-decoration: none;
          }
        }
      }
     }
    }
  }
  .cartButton {
    visibility: hidden;
    box-sizing: border-box;
    width: 80px;
    position: fixed;
    top: 20px;
    right: 25px;
    z-index: 2;
    .row {
      width:100%;
      .pull {
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
  .cartMobileButton{
    visibility: visible;
    box-sizing: border-box;
    position: fixed;
    bottom:0;
    right:0;
    width:120px;
    height: 120px;
    z-index: 2;
    .row {
      .buttonContainer {
          
        .roundedCart {
          box-sizing: border-box;
          height: 100px;
          width: 100px;
          border:5px solid black;
          border-radius: 50%;
          background-color:  white;
          display: flex;
          align-items: center;
          justify-content: center;
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
}

@media (min-width:577px) and (max-width: 768px) {
   #menu {
  .restaurant {
    margin-top: 15px;
    margin-bottom: 15px;
    .row {
      .menuContainer {
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
    margin-top: 15px;
    margin-bottom: 25px;
    .row {
      .dishContainer {
        margin: 20px 0px;
        .dish {
          flex-wrap: wrap;
          flex-basis: 768px;
          padding: 20px 0;
          border-bottom: 1px solid black;

          .dishinfo {
            margin-bottom: 15px;
           
            width: 100%;
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
        
            width: 30%;
            justify-content:center;
            align-items: center;
            background-color: #b3f5fd;
            border-top-right-radius: 30px ;
            border-bottom-right-radius: 30px ;
            h1 {
              font-size: 30px;
              font-weight: 700;
              color: black;
            }
          }
          .orderButton{
           
            width: 50%;
            
          }
        }
          
        
      }
    }
  }
  .cart {
    width: 100vw;
    height: 50vh;
    position: fixed;
    bottom:0;
    background-color: black;
    overflow-y: scroll;
    z-index: 3;
    .row {
      padding:0;
     
      .cartContainer{
        margin: 0;
        padding: 30px;
        width: 100%;
        flex-wrap: wrap;
        flex-basis: 100%;
        .cartTitle {
          
          h1 {
            color: white;
            font-size: 40px;
            font-weight: 900;
          }
        }
        .close {
          

          img {
            height: 30px;
          }
        }
        .order {
          
          margin-bottom: 10px;
          padding: 15px 30px;
          border: 1px solid white;
          border-radius: 50px;
          flex-basis: 100%;
          &:hover{
            border:none;
            background:#b3f5fd;
            .dishes {
            .dishtext {
              h3 {
                color: black;
              }
              h6 {
                color: black;
              }
            }
          }
          .price {
            h1 {
            color: black;
            font-weight: 700;
            }
          }
        .delete {
          button {
            color: black;
            font-weight: 700;
          }
         }
        }
        &:nth-child(n) {
            margin-right: 20px;
        }
          .dishes {
            width: 100%;
            .dishtext {
              margin-left: 30px;
              h3 {
                color: white;
                font-size: 15px;
                font-weight: 600;
              }
              h6 {
                color: white;
                font-size: 15px;
                font-weight: 300;
              }
            }
          }
        

        .price {
          margin: 0 5px;
          h1 {
            color: #2fbcae;
            font-size: 20px;
            font-weight: 200;
            line-height: 50px;
          }
        }
        .delete {
          button {
            margin-left: 15px;
            background: none;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: 400;
          }
        }
      }
    }
    

    .orderContainer  {
      margin: 30px 0;
      padding:0 30px;
      h1 {
        color: white;
        font-size: 30px;
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
  }
  .cartButton {
    visibility: hidden;
    box-sizing: border-box;
    width: 80px;
    position: fixed;
    top: 20px;
    right: 25px;
    z-index: 2;
    .row {
      width:100%;
      .pull {
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
  .cartMobileButton{
    visibility: visible;
    box-sizing: border-box;
    position: fixed;
    bottom:0;
    right:0;
    width:120px;
    height: 120px;
    z-index: 2;
    .row {
      .buttonContainer {
          
        .roundedCart {
          box-sizing: border-box;
          height: 100px;
          width: 100px;
          border:5px solid black;
          border-radius: 50%;
          background-color:  white;
          display: flex;
          align-items: center;
          justify-content: center;
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
}
 
@media (min-width:769px) and (max-width: 992px){
   #menu {
  .restaurant {
    margin-top: 15px;
    margin-bottom: 15px;
    .row {
      .menuContainer {
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
    margin-top: 15px;
    margin-bottom: 25px;
    .row {
      .dishContainer {
        margin: 20px 0px;
        .dish {
          flex-wrap: wrap;
          flex-basis: 100%;
          padding: 20px 0;
          border-bottom: 1px solid black;
          .dishinfo {
            margin-bottom: 15px;
            width: 100%;
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
            justify-content:center;
            align-items: center;
            width: 40%;
            background-color: #b3f5fd;
            h1 {
              font-size: 30px;
              font-weight: 700;
              color: black;
            }
          }
          .orderButton{
            display: flex;
            justify-content: flex-end;
            width: 50%;
            
          }
        }
          
        
      }
    }
  }
  .cart {
    width: 100vw;
    height: 50vh;
    position: fixed;
    bottom:0;
    background-color: black;
    overflow-y: scroll;
    z-index: 3;
    .row {
      padding:0;
     
      .cartContainer{
        margin: 0;
        padding: 30px;
        width: 100%;
        flex-wrap: wrap;
        flex-basis: 100%;
        .cartTitle {
          
          h1 {
            color: white;
            font-size: 40px;
            font-weight: 900;
          }
        }
        .close {
          

          img {
            height: 30px;
          }
        }
        .order {
          
          margin-bottom: 10px;
          padding: 15px 30px;
          border: 1px solid white;
          border-radius: 50px;
          flex-basis: 100%;
          &:hover{
            border:none;
            background:#b3f5fd;

          
            .dishes {
            .dishtext {
              h3 {
                color: black;
              }
              h6 {
                color: black;
              }
            }
          }
          .price {
            h1 {
            color: black;
            font-weight: 700;
            }
          }
        .delete {
          button {
            color: black;
            font-weight: 700;
          }
         }
        }
        &:nth-child(n) {
            margin-right: 20px;
        }

          .dishes {
            width: 100%;
            .dishtext {
              margin-left: 30px;
              h3 {
                color: white;
                font-size: 15px;
                font-weight: 600;
              }
              h6 {
                color: white;
                font-size: 15px;
                font-weight: 300;
              }
            }
          }
        

        .price {
          margin: 0 10px;
          h1 {
            color: #2fbcae;
            font-size: 20px;
            font-weight: 200;
            line-height: 50px;
          }
        }
        .delete {
          button {
            margin-left: 15px;
            background: none;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: 400;
          }
        }
      }
    }
    

    .orderContainer  {
      margin: 30px 0;
      padding:0 30px;
      h1 {
        color: white;
        font-size: 30px;
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
  }
  .cartButton {
    visibility: hidden;
    box-sizing: border-box;
    width: 80px;
    position: fixed;
    top: 20px;
    right: 25px;
    z-index: 2;
    .row {
      width:100%;
      .pull {
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
  .cartMobileButton{
    visibility: visible;
    box-sizing: border-box;
    position: fixed;
    bottom:0;
    right:0;
    width:120px;
    height: 120px;
    z-index: 2;
    .row {
      .buttonContainer {
          
        .roundedCart {
          box-sizing: border-box;
          height: 100px;
          width: 100px;
          border:5px solid black;
          border-radius: 50%;
          background-color:  white;
          display: flex;
          align-items: center;
          justify-content: center;
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
} 
@media (min-width:992px) and (max-width: 1199px){
    #menu {
  .restaurant {
    margin-top: 15px;
    margin-bottom: 15px;
    .row {
      .menuContainer {
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
    margin-top: 15px;
    margin-bottom: 25px;
    .row {
      .dishContainer {
        margin: 20px 0px;
        .dish {
          flex-wrap: wrap;
          flex-basis: 100%; 
          padding: 20px 0;
          border-bottom: 1px solid black;
          .dishinfo {
            margin-bottom: 15px;
            width: 100%;
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
            justify-content:center;
            align-items: center;
            width: 40%;
            background-color: #b3f5fd;
            border-top-right-radius: 30px ;
            border-bottom-right-radius: 30px ;
            h1 {
              font-size: 30px;
              font-weight: 700;
              color: black;
            }
          }
          .orderButton{
            
            width: 50%;
            
          }
        }
          
        
      }
    }
  }
  .cart {
    width: 100vw;
    height: 50vh;
    position: fixed;
    bottom:0;
    background-color: black;
    overflow-y: scroll;
    z-index: 3;
    .row {
      padding:0;
     
      .cartContainer{
        margin: 0;
        padding: 30px;
        width: 100%;
        flex-wrap: wrap;
        flex-basis: 100%; 
        .cartTitle {
          
          h1 {
            color: white;
            font-size: 40px;
            font-weight: 900;
          }
        }
        .close {
          

          img {
            height: 30px;
          }
        }
        .order {
          
          margin-bottom: 10px;
          padding: 15px 30px;
          border: 1px solid white;
          border-radius: 50px;
          flex-basis: 100%; 
          &:hover{
            border:none;
            background:#b3f5fd;

          
            .dishes {
            .dishtext {
              h3 {
                color: black;
              }
              h6 {
                color: black;
              }
            }
          }
          .price {
            h1 {
            color: black;
            font-weight: 700;
            }
          }
        .delete {
          button {
            color: black;
            font-weight: 700;
          }
         }
        }
        &:nth-child(n) {
            margin-right: 20px;
        }

          .dishes {
            width: 100%;
            .dishtext {
              margin-left: 30px;
              h3 {
                color: white;
                font-size: 15px;
                font-weight: 600;
              }
              h6 {
                color: white;
                font-size: 15px;
                font-weight: 300;
              }
            }
          }
        

        .price {
          margin: 0 10px;
          h1 {
            color: #2fbcae;
            font-size: 20px;
            font-weight: 200;
            line-height: 50px;
          }
        }
        .delete {
          button {
            margin-left: 15px;
            background: none;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: 400;
          }
        }
      }
    }
    

    .orderContainer  {
      margin: 30px 0;
      padding:0 30px;
      h1 {
        color: white;
        font-size: 30px;
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
  }
  .cartButton {
    visibility: hidden;
    box-sizing: border-box;
    width: 80px;
    position: fixed;
    top: 20px;
    right: 25px;
    z-index: 2;
    .row {
      width:100%;
      .pull {
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
  .cartMobileButton{
    visibility: visible;
    box-sizing: border-box;
    position: fixed;
    bottom:0;
    right:0;
    width:120px;
    height: 120px;
    z-index: 2;
    .row {
      .buttonContainer {
          
        .roundedCart {
          box-sizing: border-box;
          height: 100px;
          width: 100px;
          border:5px solid black;
          border-radius: 50%;
          background-color:  white;
          display: flex;
          align-items: center;
          justify-content: center;
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
 
 }

@media (min-width:1200px){

}







</style>