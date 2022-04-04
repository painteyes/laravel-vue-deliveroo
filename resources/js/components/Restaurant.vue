<template>
  <div class="container-lg">
    <div class="pt-4">
      <div class="p-1 back-info row">
          <div class="col-md-7 col-s-12">
            <!-- Info ristorante -->
            <div class="info p-4">
              <h1>{{ restaurantInfo.restaurant_name }}</h1>
              <div>
                <div><i class="pr-2 fas fa-map-marker-alt"></i> Indirizzo: {{ restaurantInfo.address }}</div>
                <div><i class="pr-2 fas fa-at"></i>Email: {{ restaurantInfo.email }}</div>
                <div><i class="pr-2 fa-solid fa-circle-info"></i>{{ restaurantInfo.description }}</div>
              </div>
            </div>
          </div>
          <!-- Img profilo -->
          <div class="col-md-5 col-s-12">
            <div class="img-user p-4">
              <img :src="'/storage/' + restaurantInfo.img_path" :alt="restaurantInfo.restaurant_name" v-if="restaurantInfo.img_path">
              <img :src="'/images/noimg.jpg'" :alt="restaurantInfo.restaurant_name" v-else>
            </div>
          </div>
      </div>
    </div>

    <!-- Sezione Menu -->
    <div class="row py-4">
      <div class="col-lg-7 col-md-12">
        <div class="title mt-3">
            <h2><i class="fas fa-utensils mr-2"></i>Menu</h2>
            <p>Seleziona i piatti per scegliere la quantità e aggiungerli al carrello</p>
        </div>
        <div class="section">
          <div class="d-flex flex-column px-md-5 px-lg-0">
            <div v-for="dish in restaurantMenu" :key='dish.id' class="dish card mb-4 p-1">
                <DishCard :dish='dish' @currentCart='checkCart'/>
            </div>
          </div>
        </div>
      </div>

      <!-- Carrello -->
      <div class="col-lg-5 col-md-12">
          <div class="title mt-3">
            <h2><i class="fas fa-cart-arrow-down mr-2"></i>Carrello</h2>
            <p>Conferma il carrello e vai al checkout</p>
          </div>
          <div class="section sticky-top px-md-5 px-lg-0">
                <!-- Carrello pieno -->
                <div class="card cart-headline p-2" v-if="cart.length">
                  <div class="card-body">
                    <div class="item-test" v-for="(item, i) in cart" :key="i">
                      <div class="quantity d-flex flex-no-wrap align-items-baseline">
                        <div>
                            <i class="fas fa-minus-circle" @click="minusOneCart(i)"></i>
                            <span>{{ item.quantity }}</span>
                            <i class="fas fa-plus-circle" @click="plusOneCart(i)"></i>
                        </div>
                        <!-- stampo il nome -->
                        <div class="name">
                            {{ restaurantMenu.find(x => x.id === item.id).name }}
                        </div>
                        <!-- trash -->
                        <div @click="deleteSingleDish(i)">
                          <i class="fa-solid fa-trash-can"></i>
                        </div>
                      </div>
                      <!-- stampo il totale -->
                      <div class="total">
                          {{ (restaurantMenu.find(x => x.id === item.id).price * item.quantity).toFixed(2) }} &#8364;
                      </div>
                    </div>
                    <div class="d-flex justify-content-between px-2 py-4 border-top">
                      <span><strong>TOTALE</strong></span>
                      <span><strong>{{ total() }} &#8364;</strong></span>
                    </div>

                    
                  </div>
                  <a :href="'/checkout/' + restaurantInfo.id" class="text-center py-2">
                        <button class="checkout btn btn-check">Vai alla cassa</button>
                    </a>
                  <div class="text-center">
                      <button class="btn btn-default" @click="modalEmptyCart()">Svuota il carrello</button>
                  </div>
                
                </div>

                <!-- Carrello vuoto -->
                <div class="card cart-headline p-2" v-else>
                  <div class="card-body">
                    <button class="checkout-not">Vai alla cassa</button>
                    <h5><i class="fas fa-shopping-basket"></i>
                      Il tuo carrello è vuoto
                    </h5>
                  </div>
                </div>
          </div>
      </div>
    </div>

    <!-- Modal Svuota Carrello-->
    <div class="modal fade" 
          id="removeItems"
          data-backdrop="static"
          data-keyboard="false"
          tabindex="-1"
          role="dialog" 
          aria-labelledby="staticBackdropLabel" 
          aria-hidden="true">
        
        <div class="modal-dialog" 
              role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" 
                        id="exampleModalLabel">
                      Attenzione!
                    </h4>
                    <button type="button" 
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        
                        <span aria-hidden="true">
                          ×
                      </span>
                    </button>
                </div>
                <div class="modal-body modal-text">
                    Sei sicuro di voler svuotare il carrello?
                </div>
                <div class="modal-footer">
                    <button type="button" 
                            id="closeid"
                            class="btn btn-secondary" 
                            data-dismiss="modal">
                      Annulla
                  </button>
                    <button type="button" 
                            id="saveid" 
                            class="btn btn-success"
                            @click="removeCart()">
                      Svuota
                  </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Svuota Carrello altro ristorante-->
    <div class="modal fade" 
          id="removeOtherCart"
          data-backdrop="static"
          data-keyboard="false"
          tabindex="-1"
          role="dialog" 
          aria-labelledby="staticBackdropLabel" 
          aria-hidden="true">
        
        <div class="modal-dialog" 
              role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" 
                        id="exampleModalLabel">
                      Attenzione!
                    </h4>
                    <button type="button" 
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        
                        <span aria-hidden="true">
                          ×
                      </span>
                    </button>
                </div>
                <div class="modal-body modal-text">
                    Non è possibile aggiungere al carrello piatti di ristoranti diversi. Vuoi svuotate il carrello precedente?
                </div>
                <div class="modal-footer">
                    <button type="button" 
                            id="closeid-2"
                            class="btn btn-secondary" 
                            data-dismiss="modal">
                      Annulla
                  </button>
                    <button type="button" 
                            id="saveid-2" 
                            class="btn btn-success"
                            @click="removeOtherCart()">
                      Svuota
                  </button>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import DishCard from './DishCard.vue'

export default {
  components: {
    DishCard,
  },
  props: {
    restaurantInfo: Object,
    restaurantMenu: Array,
  },
  data() {
    return {
        cart: [],
        oldCartFound: false,
    };
  },
  methods: {
    checkCart: function(data) {
          if (!(this.cart.length) || (this.cart[0].user_id == data.user_id)) {
            this.getCart(data);
          } else {
              $("#removeOtherCart").modal("show");
          }
        },
    // funzione per aggiungere un piatto al carrello
    getCart: function(data) {

      let id = data.id;
      if (this.cart.find(x => x.id === id)) {
          this.cart.find(x => x.id === id).quantity += data.quantity;
      } else {
        let item = {
          id: id,
          quantity: data.quantity,
          user_id: data.user_id
        };
        this.cart.push(item);
      }    
      this.saveCart();   
    },
    saveCart: function() {
      const parsed = JSON.stringify(this.cart);
      localStorage.setItem('cart', parsed);
      localStorage.setItem('user_id', this.restaurantInfo.id);
      localStorage.setItem('slug', this.restaurantInfo.slug);
    },
    // funzione per rimuovere tutti i piatti dal carrello
    removeCart: function() {
        this.cart = [];
        localStorage.removeItem('cart');
        this.saveCart();
        $("#removeItems").modal("hide");
    },
    // funzione per svuotare il carrello di un altro ristorante
    removeOtherCart: function() {
      localStorage.clear();
      this.cart = [];
      this.oldCartFound = false;
      $("#removeOtherCart").modal("hide");
    },
    // funzione per aumentare la quantitá nel carrello
    plusOneCart: function(i) {
        this.cart[i].quantity += 1;
        this.saveCart();
    },
    // funzione per diminuire la quantitá nel carrello (senza andare in negativo)
    minusOneCart: function(i) {
      if (this.cart[i].quantity > 1) { 
        this.cart[i].quantity -= 1; 
        this.saveCart();
      }
    },
    // funzione elimina singolo piatto dal carrello
    deleteSingleDish: function(i) {
        for (let x = 0; x < this.cart.length; x++) {
          const cart = this.cart[x];
          if (cart.id == this.cart[i].id) {
          
            this.cart.splice(x, 1);
            this.saveCart();
          }
        } 
        return -1; 
    },
    // funzione per calcolare il totale del carrello
    total: function() {
        let total = 0;
        for (let i = 0; i < this.cart.length; i++) {
          let foodPrice = this.restaurantMenu.find(x => x.id === this.cart[i].id).price;
          total += foodPrice * this.cart[i].quantity;
        }
        return total.toFixed(2);
    },
    // funzione mostra modal svuota carrello
    modalEmptyCart: function() {
      $("#removeItems").modal("show");
    },
  },
  mounted: function() {
    // console.log(localStorage.getItem('cart'));
    if (localStorage.getItem('cart')) {
      this.cart = JSON.parse(localStorage.getItem('cart'));
    } else {
      this.cart = [];
    }
  },
  created() {
    // localStorage.clear()
  }
}
</script>