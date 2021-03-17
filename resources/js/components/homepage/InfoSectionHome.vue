<template>
  <section id="infoSectionHome">
    <div class="container mt-5 mb-50">
      <div class="row d-flex justify-content-center align-items-center ">
        <div
          class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center"
        >
          <img src="img/homepage/logo_dev_2.png" alt="" />
        </div>
        <div
          class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex flex-column  justify-content-center  align-items-xs-center align-items-sm-center align-items-md-center align-items-lg-start align-items-xl-start "
        >
          <h1>E' ora di mangiare. <br> Prenota con Deliveboo.</h1>
          <p>
            La fame ti ha preso alla sprovvista? Ordina con Deliverboo e ricevi ciò che vuoi da ristoranti, pasticcerie e panetterie
            nella tua città. Ordina Ora. Tutti i tuoi piatti preferiti in un unico portale.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "InfoSectionHome",
};
</script>

<style lang="scss" scoped>
#infoSectionHome {
  
}
img {
  outline: none !important;
  &:hover {
    outline: none !important;
  }
}

p{
  text-align: center;
}


@media (max-width: 576px) {
  img {
    height: 200px;
  }
  h1{
  text-align: center;
}
p{
  text-align: center;
}
}
@media (min-width:577px) and (max-width: 768px) {
  img {
    height: 250px;
  }
  h1{
  text-align: center;
}
p{
  text-align: center;
}
}
@media (min-width:769px) and (max-width: 992px){
  img{
    height: 250px;
  }
  h1{
  text-align: center;
}
p{
  text-align: center;
}
}
@media (min-width:993px) and (max-width: 1199px){
  img{
    height: 300px;
  }
  h1{
  text-align: left;
}
p{
  text-align: left;
}
}
@media (min-width: 1200px) {
  img{
    height: 350px;
  }
  h1{
  text-align: left;
}
p{
  text-align: left;
}
 }
</style>