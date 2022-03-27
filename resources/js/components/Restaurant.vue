<template>
  <div class="container-lg">
    <div class="card">
      <div class="p-1 back-info row card-body">
          <div class="col-md-7 col-s-12">
            <!-- Info ristorante -->
            <div class="info p-4">
              <h1>{{ restaurantInfo.name }}</h1>
              <div>
                <div><i class="pr-2 fas fa-map-marker-alt"></i> Indirizzo: {{ restaurantInfo.address }} </div>
                <div><i class="pr-2 fas fa-at"></i>Email: {{ restaurantInfo.email }}   </div>
              </div>
            </div>
          </div>
          <!-- Img profilo -->
          <div class="col-md-5 col-s-12">
            <div class="img-user p-4">
              <img :src="'/storage/' + restaurantInfo.img_path" :alt="restaurantInfo.name" v-if="restaurantInfo.img_path">
              <img :src="'/images/noimg.jpg'" :alt="restaurantInfo.name" v-else>
            </div>
          </div>
      </div>
    </div>

    <!-- Sezione Menu -->
    <div class="row py-4">
      <div class="col-lg-8 col-md-12">
        <div class="section">
          <div class="title">
              <h2><i class="fas fa-utensils mr-2"></i>Menu</h2>
              <p>Seleziona i piatti per scegliere la quantità e aggiungerli al carrello</p>
          </div>

              <div class="d-flex flex-column">

                  <div v-for="dish,index in restaurantMenu" :key='index' class="dish card mb-4 p-1">
                    <div class="row align-items-center card-body">

                        <div class="image col-3">
                            <!-- <img class="img-fluid" :src="'/storage/' + dish.img_path" :alt="dish.name" v-if="dish.img_path"> -->
                            <img class="img-fluid" :src="'/images/noimg2.jpg'" :alt="dish.name">
                        </div>
                        <div class="p-3 col-6">
                            <h4>{{ dish.name }}</h4>
                            <span>{{dish.ingredients}}</span><br>
                            <span class="price">{{dish.price}} &#8364;</span>
                        </div>
                        <!-- Bottoni -->
                        <div class="col-3 buttons d-flex flex-column justify-content-center align-items-center">
                          <div class="quantity d-flex align-items-baseline">
                              <i class="fas fa-minus-circle"></i>
                              1
                              <i class="fas fa-plus-circle"></i>
                          </div>
                          <button
                              type="button"
                              name="button"
                              class="btn btn-secondary"
                            >
                              Aggiungi al carrello
                          </button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <!-- Carrello -->
        <div class="col-lg-4 col-md-12">
          <div class="section">
            <div class="title">
              <h2><i class="fas fa-cart-arrow-down mr-2"></i>Carrello</h2>
              <p>Conferma il carrello e vai al checkout</p>
            </div>
                <!-- Carrello vuoto da mostrare solo quando è vuoto-->
                <div class="card cart-headline p-2">
                  <div class="card-body">
                    <button>Vai alla cassa</button>
                    <h5><i class="fas fa-shopping-basket"></i>
                      Il tuo carrello è vuoto
                    </h5>
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
    restaurantInfo: Array,
    restaurantMenu: Array,
  }
}
</script>