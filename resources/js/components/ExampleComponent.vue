<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <input @keydown.enter="getRestaurants()" placeholder="Cosa vuoi mangiare oggi?" class="mb-5" v-model="query" type="text">
                
                

                
                <ul>
                    <li v-bind:key="mainCat.id" v-for="mainCat in genres">
                    <input type="checkbox" :value="mainCat.name" id="mainCat.merchantId" v-model="checked" @change="check($event)"> {{mainCat.name}}

                    </li>
                </ul>
                 

                <div  v-for="item in restaurants" v-bind:key="item.id" class="card mb-5">
                    <h5 class="card-title">Nome Ristorante: {{ item.name }}</h5>
                    
                    <div class="card-header">Indirizzo: {{item.address}}</div>
                    
                    
                    <div class="card-body">
                        <h3>Tipi di piatto:</h3>
                        <div v-bind:key="type.id" v-for="type in item.get_types" class="type">{{type.name}}</div>
                    </div>
                    <div class="card-footer">
                        <h3>I nostri piatti:</h3>
                        <ul>
                         <li v-bind:key="dish.id" v-for="dish in item.get_dishes"><a :href="'dishes/' + dish.id" >{{ dish.name }}</a>
                         
                         <form method="PUT" :action="'dishes/' + dish.id + '/edit'">
                            <button type="submit">EDIT</button>
                         </form>
                         </li>
                        </ul>
                        
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="card-footer">
            <h3>I nostri piatti:</h3>
            <ul>
              <li v-bind:key="dish.id" v-for="dish in item.get_dishes">
                <a :href="'dishes/' + dish.id">{{ dish.name }}</a>
                <form method="PUT" :action="'dishes/' + dish.id + '/edit'">
                  <button type="submit">EDIT</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
    
        data(){
            return {
                query: '',
                genres: [],
                restaurants: [],
                checked: [],
            }
        },
        methods: {
            getRestaurants(query = this.query){
                this.restaurants = [];
                
                    axios.get('/api/restaurants', {params: {query}}).then(response => {
                        this.restaurants = response.data;
                    });
            },

            getRestaurants(query = this.query){
                this.restaurants = [];
                
                    axios.get('/api/restaurants', {params: {query}}).then(response => {
                        this.restaurants = response.data;
                    });
            },
            check(e){
                this.restaurants = [];
                
                    axios.get('/api/checked', {params: {query:this.checked}}).then(response => {
                        this.restaurants = response.data;
                    });
            },


            getGenres(){
                this.genres = [];
                    axios.get('/api/genres').then(response => {
                        this.genres = response.data;
                    });
            },


    
        },

        mounted(){
            this.getGenres();
        },
       
    }
</script>
