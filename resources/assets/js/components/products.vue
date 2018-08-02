<template>
    <div class="container products">
        <div class="row">
            <div v-for="product in products" class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="images/wallpaper.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{product.title}}</h5>
                        <p class="card-text">{{product.description}}</p>
                        <a  v-on:click="addToCart(product)" style="color: white;"class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="load-more-area">
            <a href="#" class="btn btn-primary center"  >Load More</a>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: []
            }
        },
        methods: {
          addToCart: function(product) {
              console.log("Hey!@");
              axios.put("api/cart/add", {
                  id: product.id
              })
                      .then(response => (this.$parent.cart.count = response.data.count))
                      .catch(error => console.log(error));
          }
        },
        mounted() {
            axios.get("api/products")
                    .then(response => (this.products = response.data.data))
                    .catch(error => console.log(error));
        }
    }
</script>
