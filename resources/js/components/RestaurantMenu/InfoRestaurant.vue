<template>
<section>
  <div class="container">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-sm-12 info d-flex p-0">
        <div
          class="rst-info d-flex flex-column justify-content-start align-items-start"
        >
          <h1>{{ restaurantData.name }}</h1>
          <h5>{{ restaurantData.address }}</h5>
          <div class="dist"></div>
        </div>
      </div>
      <div
        class="col-xl-6  col-lg-6 col-sm-12 circle d-flex justify-content-lg-center  justify-content-md-start justify-content-sm-start align-items-lg-center  align-items-md-center align-items-sm-start p-0"
      >
        <div class="resturantImage">
          <!--  <img class='m-0 p-0' :src="restaurantData.image_url" alt=""> -->
          <img id="restaurant_img" alt="ok" :src="'/img/restaurant/' + restaurantData.image_url" />
        </div>

        
      </div>
    </div>
  </div>
</section>
</template>

<script>
export default {
  name: "inforestaurant",
  props: {
    data: String,
  },
  data() {
    return {
      restaurantData: [],
    };
  },
  mounted: function () {
    var data = JSON.parse(this.data);
    this.restaurantData = data;
  },
};
</script>

<style lang="scss" scoped>
.container {
  margin-bottom: 50px;
  .row {
    .circle {
      margin: 0;
      padding: 0;
      position: absolute;
      top: 140px;
      right: 40px;
      z-index: 2;
      .resturantImage {
        min-width: 350px;
        height: 350px;
        overflow: hidden;
        border-radius: 100%;
        border: 6px solid black;
          #restaurant_img {
          width: 100%;
          height: 100%;
          border-radius: 100%;
          margin: 0;
          object-fit: cover;
        
          
         }
      }
    }
    .info {
      .rst-info {
        margin: 70px 0 0 20px;
        padding-right: 0;

        h1 {
          color: black;
          font-size: 50px;
          font-weight: 900;
          line-height: 50px;
        }
        h5 {
          font-size: 18px;
          font-weight: 400;
        }
        .dist {
          margin: 30px 0;
        }
      }
    }
  }
}

@media (max-width: 576px) {

 .container {
  margin-bottom: 50px;
  .row {
    display: flex;
    flex-direction: column-reverse;
    .circle {
      width: 250px;
     
      margin-left:20px;
      margin-top: 50px;
      padding: 0;
      position: static;
      z-index:0;
      .resturantImage {
      
        margin: 0;
        min-width: 200px;
        height: 200px;
        overflow: hidden;
        border-radius: 100%;
        border: 6px solid black;
          #restaurant_img {
          width: 100%;
          height: 100%;
          border-radius: 100%;
          margin: 0;
          object-fit: cover;
        
          
         }
      }
    }
    .info {
      .rst-info {
        margin: 20px 0 0 20px;
        padding-right: 0;

        h1 {
          font-size: 40px;
          font-weight: 900;
          line-height: 40px;
        }
        h5 {
          font-size: 15px;
          font-weight: 400;
        }
        .dist {
          margin: 0 0;
        }
      }
    }
  }
 }
}


@media (min-width:577px) and (max-width: 768px) {
  .container {
  margin-bottom: 50px;
  .row {
    display: flex;
    flex-direction: column-reverse;
    .circle {
      width: 250px;
      
      margin-left:20px;
      margin-top: 50px;
      padding: 0;
      position: static;
      z-index:0;
      .resturantImage {
       
        margin: 0;
        min-width: 200px;
        height: 200px;
        overflow: hidden;
        border-radius: 100%;
        border: 6px solid black;
          #restaurant_img {
          width: 100%;
          height: 100%;
          border-radius: 100%;
          margin: 0;
          object-fit: cover;
        
          
         }
      }
    }
    .info {
      .rst-info {
        margin: 20px 0 0 20px;
        padding-right: 0;

        h1 {
          
          font-size: 40px;
          font-weight: 900;
          line-height: 40px;
        }
        h5 {
      
          font-size: 15px;
          font-weight: 400;
        }
        .dist {
          margin: 0 0;
        }
      }
    }
  }
 }
}

@media (min-width:769px) and (max-width: 992px){
  .container {
  margin-bottom: 50px;
  .row {
    display: flex;
    flex-direction: column-reverse;
    .circle {
      width: 350px;
      margin-left:20px;
      margin-top: 50px;
      padding: 0;
      position: static;
      z-index:0;
      .resturantImage {
        margin: 0;
        min-width: 300px;
        height: 300px;
        overflow: hidden;
        border-radius: 100%;
        border: 6px solid black;
          #restaurant_img {
          width: 100%;
          height: 100%;
          border-radius: 100%;
          margin: 0;
          object-fit: cover;
         }
      }
    }
    .info {
      .rst-info {
        margin: 20px 0 0 20px;
        padding-right: 0;

        h1 {
          font-size: 40px;
          font-weight: 900;
          line-height: 40px;
        }
        h5 {
          font-size: 15px;
          font-weight: 400;
        }
        .dist {
          margin: 0 0;
        }
      }
    }
  }
 }
}
@media (min-width: 1200px) {
 }
</style>