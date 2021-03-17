<template>
  <section>
     <div class="container cart mt-120">
         <div class="row">
             <div class="col-12 cartTitle" >
                 <h1>Hai Ordinato:</h1>
             </div>
             <div class="col-12 d-flex flex-row flex-wrap">
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
                        <div class="price d-flex justify-content-end align-items-center">
                         <!-- nel caso ritorna il filtro sarebbe order.totalPrice -->
                          <h1>{{ order.dishPrice}} €</h1>
                        </div>

                      </div>
        
                </div>        
             </div>
        </div>
   </section>
</template>

<script>
export default {

data(){
return{
    cart: [],
    total:0,

 }
},
 mounted: function(){

     if (localStorage.getItem('cart')) {
      try {
        this.cart = JSON.parse(localStorage.getItem('cart'));
      } catch(e) {
        localStorage.removeItem('cart');
      }
    }

    if (localStorage.getItem('total')) {
      try {
        this.total = JSON.parse(localStorage.getItem('total'));
      } catch(e) {
        localStorage.removeItem('total');
      }
    }
     console.log(this.cart)

 },
 computed:{

     totalPrice() {
      return new Intl.NumberFormat("it-IT", {
        style: "currency",
        currency: "EUR",
      }).format(this.total);
    },
 },

 methods:{


    saveCart(){
      const parsed = JSON.stringify(this.cart);
      localStorage.setItem('cart', parsed);
    },


 },

}
</script>

<style lang='scss'>
     
.cart{
    min-width: 100vw;
    background-color: black;
    .row {
      padding: 50px 200px;
        .cartTitle {
          width: 50%;
          h1 {
            color: white;
            font-size: 40px;
            font-weight: 900;
          }
        }
    .col-12 {
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
      }
    }

    .col-6 {
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

@media (max-width: 576px) {
  .cart{
    width: 100vw;
    background-color: black;
    .row {
       padding: 30px 0;
        .cartTitle {
          width: 50%;
          padding: 0 30px;
          h1 {
            color: white;
            font-size: 30px;
            font-weight: 900;
          }
        }
    .col-12 {
        .order {
          margin: 20px;
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
        }
          &:nth-child(n) {
            margin-right: 20px;
          }

          .dishes {
            .dishtext {
              margin-left: 10px;
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
          margin: 0 10px;
          h1 {
            color: #2fbcae;
            font-size: 18px;
            font-weight: 200;
            line-height: 30px;
          }
        }
      }
    }

    .col-6 {
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
  
}
@media (min-width:577px) and (max-width: 768px) {
  .cart{
    width: 100vw;
    background-color: black;
    .row {
       padding: 30px 0;
        .cartTitle {
          width: 50%;
          padding: 0 30px;
          h1 {
            color: white;
            font-size: 30px;
            font-weight: 900;
          }
        }
    .col-12 {
        .order {
          margin: 20px;
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
        }
          &:nth-child(n) {
            margin-right: 20px;
          }

          .dishes {
            .dishtext {
              margin-left: 10px;
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
          margin: 0 10px;
          h1 {
            color: #2fbcae;
            font-size: 30px;
            font-weight: 200;
            line-height: 30px;
          }
        }
      }
    }

    .col-6 {
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
  
}
@media (min-width:769px) and (max-width: 992px){
  .cart{
    width: 100vw;
    background-color: black;
    .row {
       padding: 30px 0;
        .cartTitle {
          width: 50%;
          padding: 0 30px;
          h1 {
            color: white;
            font-size: 30px;
            font-weight: 900;
          }
        }
    .col-12 {
        .order {
          margin: 20px;
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
        }
          &:nth-child(n) {
            margin-right: 20px;
          }

          .dishes {
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
          margin: 0 10px;
          h1 {
            color: #2fbcae;
            font-size: 30px;
            font-weight: 200;
            line-height: 30px;
          }
        }
      }
    }

    .col-6 {
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
  
}

@media (min-width:992px) and (max-width: 1199px){
  .cart{
    width: 100vw;
    background-color: black;
    .row {
       padding: 30px 0;
        .cartTitle {
          width: 50%;
          padding: 0 30px;
          h1 {
            color: white;
            font-size: 30px;
            font-weight: 900;
          }
        }
    .col-12 {
        .order {
          margin: 20px;
          padding: 15px 30px;
          border: 1px solid white;
          border-radius: 50px;
          flex-basis: 45%;
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
        }
          &:nth-child(n) {
            margin-right: 20px;
          }

          .dishes {
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
          margin: 0 10px;
          h1 {
            color: #2fbcae;
            font-size: 30px;
            font-weight: 200;
            line-height: 30px;
          }
        }
      }
    }

    .col-6 {
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
  
}
@media (min-width: 1200px) {
  
 }

</style>