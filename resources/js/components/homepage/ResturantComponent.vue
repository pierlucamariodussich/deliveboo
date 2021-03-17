<template>
  <div class="col-lg-6 d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex justify-content-start align-items-center dishinfo">  
        <div class="dishImg m-3">
          <div class="listImage">
            <img :src="'/img/restaurant/' + resturantImg" alt="" />
          </div>
        </div>
      <div class="d-flex flex-column justify-content-center align-items-start dishText">
        <h4 class="m-0 p-0">{{ resturantName }}</h4>
        <p class="m-0 p-0">{{ resturantAddress }}</p>
      </div>
    </div>
    <a :href="link">
      <img id="icon" src="img/homepage/icon/menu.png" alt="" />
    </a>
  </div>
</template>

<script>
export default {
  name: "ResturantComponent",
  props: {
    resturantImg: String,
    resturantName: String,
    resturantAddress: String,
    link:String
  },
};
</script>

<style>
#icon{
  height: 30px;
  margin: 0;
  width: auto;
}
</style>