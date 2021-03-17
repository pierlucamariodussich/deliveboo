<template>
  <section id="becomePartner" class="d-flex flex-column justify-content-end">
    <div class="container mt-5 mb-5 d-flex justify-content-start align-items-center" >
      <div class="row ">
        <div v-if="auth == ''"  class="col-12 p-5 d-flex flex-column">
          <h1>
            Sei un ristoratore? <br />
            Diventa nostro partner
          </h1>
          <div class="mt-5 d-flex media-flex align-items-center">
            
            <a :href="loginlink" class="primary-button text-center">Effettua il login</a>
            <span class="d-none d-lg-block d-xl-block d-md-block"> - o - </span> 
            <a :href="registerlink" class="primary-button text-center">Registrati Subito</a>
            
          </div>
        </div>
        <div v-else class="col-12 media-padded">
          <h1>
            Il tuo ristorante è online. <br />
            Inizia a vendere subito!
          </h1>
          <div class="mt-5">
            
            <a :href="dashboardlink" class="primary-button">La tua dashboard</a>
            
            
          </div>
        
        
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "PartnerSectionHome",
  props:{
    loginlink: String,
    registerlink: String,
    dashboardlink: String,
    auth: String,
  }
};
</script>

<style lang="scss" scoped>
.media-padded {
  padding: 3rem !important;
}
#becomePartner {
  height: 70vh;
  position:relative;
  background-size: cover;
  background-position: center;
  background-color: rgba(0, 0, 0, 0.6);
  background-blend-mode: multiply;
  h1 {
    color: #fff;
  }
  .container{
    height: 100%;
  }
  // #centerMe{
  //   position:absolute;
  //   top: 50%;
  //   transform: translateY(-50%);
  // }
  span {
    color: #fff;
  }
  // div.container{
  //   position:absolute;
  //   bottom: 0;
  // }
}
@media screen and (max-width:700px) {
  .media-flex{
    flex-direction: column !important;
    gap: 30px !important;
  }
  .media-padded {
    padding: 1rem !important;
  }
  
}
</style>