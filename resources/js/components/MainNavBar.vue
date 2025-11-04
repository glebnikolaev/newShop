<template>
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop" :class="{ 'fix-menu-desktop': isFixed }">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">АКЦИЯ: при регистрации 100 приветственных баллов в подарок</div>

                    <div class="right-top-bar flex-w h-full">
                        <a href="#" class="flex-c-m trans-04 p-lr-25">Написать Директору</a>
                        <a href="#" class="flex-c-m trans-04 p-lr-25">Личный кабинет</a>
                        <template v-if="isLoggedIn">
                            <a v-if="isLoggedIn" class="nav-item nav-link"  @click="logout">Выйти</a>
                        </template>
                        <template v-else>
                            <router-link to="/login" class="nav-item nav-link">Войти</router-link>
                            <router-link to="/register" class="nav-item nav-link">Регистрация</router-link>
                        </template>
                    </div>
                </div>
            </div>

            <div class="wrap-menu-desktop" v-bind:style="{ top: windowScrollY + 'px' }">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="#" class="logo">
                        <img src="images/icons/logo-01.png" alt="IMG-LOGO">
                    </a>
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu-removeit" v-for="links in topNavBarLinks">
                                <a :href="links.href">{{ links.label }}</a>
                                <ul class="sub-menu" v-if="links.child.length > 0">
                                    <li v-for="child in links.child"><a :href="child.href">{{ child.label }}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                             :data-notify="cartCount" @click.prevent='openCartModal()'>
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>

                        <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                           data-notify="0">
                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a>
                        <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                           data-notify="0">
                            <i class="zmdi zmdi-account"></i>
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                     data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                   data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                   data-notify="0">
                    <i class="zmdi zmdi-account"></i>
                </a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">АКЦИЯ: при регистрации 100 приветственных баллов в подарок</div>
                </li>
            </ul>

            <ul class="main-menu-m">

                <li>
                    <a href="product.html">Shop</a>
                </li>

                <li>
                    <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
                </li>

                <li>
                    <a href="blog.html">Blog</a>
                </li>

                <li>
                    <a href="about.html">About</a>
                </li>

                <li>
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>
</template>

<script>
    import axios from 'axios';
    export default {
        name: 'mainNavBar',
        data() {
            return {
                links: [],
                isFixed: false,
                windowScrollY: 40,
                cartCount: 0,
                isLoggedIn: false,
            };
        },
        created() {
            window.addEventListener('scroll', this.handleScroll);
            if (window.Laravel.isLoggedin) {
                this.isLoggedIn = true
            }
        },
        destroyed() {
            window.removeEventListener('scroll', this.handleScroll);
        },
        mounted() {
            this.$bus.$on('update-cart-count', () => {
                this.cartCount = this.$store.getters.cart.count;
            });
        },
        computed: {
            topNavBarLinks() {
                return this.$store.getters.topNavBarLinks;
            },
        },
        methods: {
            handleScroll(event) {
                this.isFixed =  window.scrollY >= 40;
                this.windowScrollY = window.scrollY < 40 ? 40 - window.scrollY : 0;
            },
            openCartModal() {
                this.$bus.$emit('toggle-cart-modal');
            },
            logout(e) {
                console.log('ss')
                e.preventDefault()
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/api/v1/logout')
                        .then(response => {
                            if (response.data.success) {
                                this.$router.go('/')
                            } else {
                                console.log(response)
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                })
            }
        }
    }
</script>
