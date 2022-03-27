<template>
    <div class="container-fluid">
        <div class="row justify-content-center mx-sm-5">
            <div class="col-sm-12 d-md-flex page">

                <div class="text-left d-sm-flex flex-sm-wrap flex-md-column align-items-start align-self-start mt-md-5 mx-auto">

                    <!-- stampo le tipologie per permettere all'utente di fare le ricerche -->
                    <label class="check" v-for="category, index in categories" :key='index'>
                      <input  type="checkbox"
                            :value="category.name"
                            v-model="categoriesFilter"
                            @change="searchRestaurants()"
                      >
                      <span class="category-name">{{ category.name }}</span>
                    </label>
                </div>

                <!-- stampo ristoranti random se nessuna caegoria è selezionata-->
                <div 
                    class="col-sm-12 col-md-10 d-flex flex-wrap align-items-start mt-md-5" 
                    v-if="categoriesFilter.length == 0"
                >
            
                    <div
                    v-for="(randRestaurant, i) in randRestaurants"
                    :key="i"
                    class="user"
                    >
                        <a :href="'/restaurants/' + randRestaurant.slug">
                            <div class="image">
                                <img class="img-fluid" :src="'/storage/' + randRestaurant.img_path" :alt="randRestaurant.name" v-if="randRestaurant.img_path">
                                <img class="img-fluid" :src="'/images/noimg.jpg'" :alt="randRestaurants.name" v-else>
                            </div>
                            <div class="p-3 rest-info">
                                <h4>{{ randRestaurant.name }}</h4>
                                <span>
                                    {{randRestaurant.address}} <br>
                                    {{randRestaurant.email}}
                                </span>
                            </div>
                        </a>

                    </div>
                </div>

                <!-- stampo i ristoranti appartenenti alla categoria selezionata dall'utente -->
                 <div 
                    class="col-sm-12 col-md-10 d-flex flex-wrap align-items-start mt-md-5"
                    v-else
                >

                    <div
                        v-for="(restaurant, i) in filteredRestaurants"
                        :key="i"
                        class="user"
                    >

                        <a :href="'/restaurants/' + restaurant.slug">
                            <div class="image">
                                <img class="img-fluid" :src="'/storage/' + restaurant.img_path" :alt="restaurant.name" v-if="restaurant.img_path">
                                <img class="img-fluid" :src="'/images/noimg.jpg'" :alt="restaurant.name" v-else>
                            </div>
                            <div class="p-3 rest-info">
                                <h4>{{ restaurant.name }}</h4>
                                <span>
                                    {{restaurant.address}} <br>
                                    {{restaurant.email}}
                                </span>
                            </div>
                        </a>

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
            randRestaurants: Array,
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