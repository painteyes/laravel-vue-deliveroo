<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    
                    <!-- stampo a schermo le tipologie per permettere all'utente di fare le ricerche -->
                    <label class="check" v-for="category, index in categories" :key=index>

                        <input 
                            type="checkbox"
                            :value="category.name"
                            v-model="categoriesFilter"
                            @change="searchRestaurants()"
                        >
                      <span class="nome-search">{{ category.name }}</span>
                    </label>

                    <!-- card ristoranti -->
                    <div
                        v-for="(restaurant, i) in filteredRestaurants"
                        :key="i"
                        class="restaurant-found restaurant-card"
                    >
                        <div class="card-body text-start">
                            <!-- <a @click="showMenu(restaurant.id)"> -->
                            <a href="#">
                                <div class="container-image">
                                    <!-- <img
                                        class="card-img-top"
                                        :src="'/storage/images/' + restaurant.image"
                                        alt=""
                                    /> -->
                                </div>
                                <div class="container-text-card">
                                    <h5 class="card-title my-1">
                                        <strong> {{ restaurant.restaurant_name }}</strong>
                                    </h5>
                                    <!-- <p class="card-text my-1">
                                        {{ restaurant.restaurant_phone }}
                                    </p>
                                    <p class="card-text my-1">{{ restaurant.email }}</p>
                                    <p class="card-text my-1">{{ restaurant.address }}</p> -->
                                </div>
                            </a>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        props: {
            categories: Array,
            randomRestaurants: Array,
        }, 
        data: function() {
            return {
                // Categorie selezionate dall'utente
                categoriesFilter: [],
                // Ristoranti filtrati in base alle categorie selezionate
                filteredRestaurants: [],
            }
        },
        methods: {

            // Filtra i ristoranti in base alle categorie selezionate            
            searchRestaurants: function() {
                axios.post('/api/search', {categories: this.categoriesFilter}).then((response)=>{
                    if (response.data.success) {
                        this.filteredRestaurants = response.data.result        
                    } else {
                        // this.$router.push({name: 'page-not-found'})
                    }
                })
            }
            
        },
        mounted() {
            this.searchRestaurants();
        },
    //     created() {
    //         this.searchRestaurant();
    //     }
    }
</script>