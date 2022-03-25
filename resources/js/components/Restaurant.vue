<template>
    <div class="container">
         <h1> {{restaurantInfo.name}}</h1>
         <p> Via delle Baleari 1, Alghero</p>

         <h3>Menu</h3>
         <ul>
            <li v-for="dish,index in restaurantMenu" :key='index'> 
              <span>Piatto: {{dish.name}}</span>
              <br>
              <span>Prezzo {{dish.price}}</span>
            </li>
         </ul>
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