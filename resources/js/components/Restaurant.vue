<template>
  <div class="container-lg">
    <div>
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
      <div class="col-lg-8 col-md-12">
        <div class="title mt-3">
            <h2><i class="fas fa-utensils mr-2"></i>Menu</h2>
            <p>Seleziona i piatti per scegliere la quantità e aggiungerli al carrello</p>
        </div>
        <div class="section">
          <div class="d-flex flex-column">
            <div v-for="dish in restaurantMenu" :key='dish.id' class="dish card mb-4 p-1">
                <DishCard :dish='dish' @currentCart='getCart'/>
            </div>
          </div>
        </div>
      </div>

      <!-- Carrello -->
      <div class="col-lg-4 col-md-12">
          <div class="title mt-3">
            <h2><i class="fas fa-cart-arrow-down mr-2"></i>Carrello</h2>
            <p>Conferma il carrello e vai al checkout</p>
          </div>
          <div class="section sticky-top">
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
                      </div>
                      <!-- stampo il totale -->
                      <div class="total">
                          {{ (restaurantMenu.find(x => x.id === item.id).price * item.quantity) }} &#8364;
                      </div>
                    </div>
                    <div class="d-flex justify-content-between px-2 py-4 border-top">
                      <span><strong>TOTALE:</strong></span>
                      <span>{{ total().toFixed(2) }} &#8364;</span>
                    </div>

                    
                  </div>
                  <a :href="'/checkout/' + restaurantInfo.id" class="text-center py-2">
                        <button class="checkout btn btn-secondary">Vai alla cassa</button>
                    </a>
                  <div class="text-center">
                      <button class="btn btn-default" @click="removeCart()">Rimuovi piatti</button>
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
    <!-- <Modal
      :class="modal ? 'd-block' : ''"
      :warning="'Non è possibile aggiungere prodotti da altri ristoranti. Per favore, svuota prima il carrello'"
      @close="modal = false"
    /> -->
  </div>
</template>

<script>
import DishCard from './DishCard.vue'
import Modal from './Modal.vue'

export default {
  components: {
    DishCard,
    Modal
  },
  props: {
    restaurantInfo: Object,
    restaurantMenu: Array,
  },
  data() {
    return {
        cart: [],
        oldCartFound: false,
        // modal: false,
    };
  },
  methods: {
    // funzione per aggiungere un piatto al carrello
    getCart: function(data) {

      let slug = localStorage.getItem('slug');
      let currentRestaurant = window.location.href;

    
      if (this.cart.length) {
        if (currentRestaurant !== 'http://127.0.0.1:8000/restaurants/' + slug) {
          if (this.cart[0].user_id !== data.user_id) {
            if (confirm('Non è possibile aggiungere al carrello piatti di ristoranti diversi. Vuoi cancellare il carrello precedente ?')) {
              localStorage.clear();
              this.cart = [];
              this.oldCartFound = false;
            } else {
              this.oldCartFound = true;
            }
          }
        }
      }
  
      // se il cibo é giá presente nel carrello, aggiungo la nuova quantitá senza creare un nuovo oggetto
      if (this.oldCartFound == false) {
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
          this.saveCart();
          // this.cart = JSON.parse(localStorage.getItem('cart'));
        }   
      }       
    },
    saveCart: function() {
      const parsed = JSON.stringify(this.cart);
      localStorage.setItem('cart', parsed);
      localStorage.setItem('user_id', this.restaurantInfo.id);
      localStorage.setItem('slug', this.restaurantInfo.slug);
    
    },
    // funzione per rimuovere tutti i piatti dal carrello
    removeCart: function() {
      if (confirm('Attenzione, sei sicuro di voler svuotare il carrello?')) {
        this.cart = [];
        localStorage.removeItem('cart');
        this.saveCart();
      }
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
      else {
        if (confirm('Attenzione, sei sicuro di eliminare questo piatto dal carrello?')) {
          
          for (let x = 0; x < this.cart.length; x++) {
            const cart = this.cart[x];
            if (cart.id == this.cart[i].id) {
            
              this.cart.splice(x, 1);
              this.saveCart();
            }
          } 
          return -1;
        }
      }
    },
    // funzione per calcolare il totale del carrello
    total: function() {
        let total = 0;
        for (let i = 0; i < this.cart.length; i++) {
          let foodPrice = this.restaurantMenu.find(x => x.id === this.cart[i].id).price;
          total += foodPrice * this.cart[i].quantity;
        }
        return total;
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