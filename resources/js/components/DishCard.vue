<template>
        <div class="row align-items-center card-body">

        <div class="image col-3">
            <img class="img-fluid" :src="'/storage/' + dish.img_path" :alt="dish.name" v-if="dish.img_path">
            <!-- <img class="img-fluid" :src="'/images/noimg2.jpg'" :alt="dish.name" v-else> -->
        </div>
        <div class="p-3 col-6">
            <h4>{{ dish.name }}</h4>
            <span>{{dish.ingredients}}</span><br>
            <span class="price">{{dish.price}} &#8364;</span>
        </div>
        <!-- Bottoni -->
        <div class="col-3 buttons d-flex flex-column justify-content-center align-items-center">
            <div class="quantity d-flex align-items-baseline">
                <i class="fas fa-minus-circle" @click="minusOne()"></i>
                {{ quantity }}
                <i class="fas fa-plus-circle" @click="plusOne()"></i>
            </div>
            <button
                type="button"
                name="button"
                class="btn btn-add"
                data-dismiss="modal"
                @click="addCart(dish.id)"
            >
                Aggiungi al carrello
            </button>
            <button
                type="button"
                class="btn btn-default"
                data-dismiss="modal"
                @click="resetQuantity(dish.id)"
            >
                Annulla
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DishCard',
    props: ['dish'],
    data() {
        return {
            currentCart: {},
            quantity: 1
    };
  },
    methods: {
        // funzione per resettare la quantitá indicata nella card del cibo sempre a 1
        resetQuantity: function() {
            this.quantity = 1;
        },
        // funzione per aumentare la quantitá
        plusOne: function() {
            this.quantity += 1;
        },
        // funzione per diminuire la quantitá
        minusOne: function() {
            if (this.quantity > 1) this.quantity -= 1;
            },
        // funzione per aggiungere un piatto al carrello
        addCart: function(id) {
            
            if (this.quantity > 0) {
                this.currentCart = {
                    name: this.dish.name,
                    price: (this.dish.price * this.quantity).toFixed(2),
                    quantity: this.quantity,
                    user_id: this.dish.user_id,
                    id: this.dish.id,
                    img: this.dish.img_path
                }
            }
            this.$emit('currentCart', this.currentCart);
            this.quantity = 1;
        },
    }
}
</script>