<template>
    <div class="container p-5">
      <div class="row"> 
        <div class="col-lg-3 col-sm-6 mb-4">
          <ul>
            <li>
              <h5>LAVORA CON NOI</h5>
            </li>
            <li v-for="(link, index) in work" :key="index">
              <a href="#">{{ link }}</a>
            </li>
          </ul>
        </div>
        <div
          class="col-lg-3 col-sm-6 mb-4"
        >
          <ul>
            <li>
              <h5>NOTE LEGALI</h5>
            </li>
            <li v-for="(link, index) in legal" :key="index">
              <a href="#">{{ link }}</a>
            </li>
          </ul>
        </div>
        <div
          class="col-lg-3 col-sm-6 mb-4"
        >
          <ul>
            <li>
              <h5>AIUTO</h5>
            </li>
            <li v-for="(link, index) in help" :key="index">
              <a href="#">{{ link }}</a>
            </li>
          </ul>
        </div>
        <div
          class="col-lg-3 col-sm-6 mb-4"
        >
          <h5>SEGUICI SUI SOCIAL</h5>
          <div class="d-flex justify-content-between align-items-center social">
            <img src="/img/homepage/icon/twitter.png" alt="" />
            <img src="/img/homepage/icon/Facebook.png" alt="" />
            <img src="/img/homepage/icon/Instagram.png" alt="" />
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: "FooterComponent",
  data() {
    return {
      work: ["Diventa Rider", "Diventa nostro Partner", "Lavora con noi"],
      legal: ["Termini & Condizioni", "Informativa sulla Privacy", "Cookies"],
      help: ["Contatti", "FAQ", "Tipi di cucina", "Mappa del sito"],
    };
  },
};
</script>

<style lang="scss" scoped>
.container{
  height: auto;
}
</style>