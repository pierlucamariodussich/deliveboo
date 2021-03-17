<template>
  <header>
    <slot name="navbar"></slot>
    <div class="d-flex flex-column justify-content-center align-items-center">
      <img src="img/succes/icon/true.png" alt="" />
      <h1>Prepara la tavola!</h1>
      <h1>Il tuo ordine è avvenuto con</h1>
      <h1 class="m-0">SUCCESSO!</h1>
    </div>
  </header>
</template>

<script>
export default {
  name: "SuccessPage",
};
</script>

<style lang="scss" scoped>
* {
  background-repeat: no-repeat;
  background-size: cover;
  background-position:center;
}
div {
  height: calc(100vh - 100px);
  text-align: center;
}

h1{
  margin: 0 10px;
  color: black;
  font-weight: 700;
  &:last-child{
    color: black;
    font-weight: 900;
  }
}
@media screen and (max-width:800px){
  
}

</style>