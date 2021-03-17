<template>
  <section id="resturant-type">
    <div class="container mt-5 mb-5">
      <div class="row m-4 media-text-center">
        <div class="col-lg-12">
          <h1>Seleziona una tipologia di ristorante</h1>
        </div>
      </div>
      <div class="row m-4" id="resturants-buttons">
            <slot name="buttons"></slot>
        </div>
      </div>
      <div class="row m-4">
        <slot name="resturant"></slot>
      </div>
    
  </section>
</template>

<script>
export default {
  name: "ResturantSectionHome",
};
</script>

<style lang="scss" scoped>
ul {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin: 0;
  padding: 0;
  width: 100%;
}
.icon {
  height: 30px;
}

@media screen and (max-width:800px){
  #resturants-buttons {
    justify-content: center !important;
  }

  .media-text-center {
    text-align: center;
  }
}
</style>