<template>
    <div id="header" v-bind:class="{hasScroll: scrolled}">
        <div class="container">
            <div id="navigation">
                <ul>
                    <li>Home</li>
                    <li>About</li>
                </ul>
            </div>
            <div id="cart-short">
                <span class="fa fa-shopping-cart"></span> {{this.$parent.cartItems}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                scrolled: false
            }
        },
        methods: {
            scrollEvent(ev) {
                if (!this.scrolled && window.scrollY > 0) {
                    this.scrolled = true;
                }
                else if (window.scrollY == 0) {
                    this.scrolled = false;
                    console.log("heyyy");
                }
            }
        },
        created() {
            window.addEventListener('scroll', this.scrollEvent);
        },
        destroyed() {
            window.removeEventListener('scroll', this.scroll);
        }
    }
</script>
