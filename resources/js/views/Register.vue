<template>
    <section class="bg0 p-t-100 p-b-140">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="alert alert-danger" role="alert" v-if="error !== null">
                        {{ error }}
                    </div>

                    <div class="card card-default">
                        <div class="card-header">Регистрация</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label text-md-right">Имя</label>
                                    <div class="col-md-6">
                                        <input id="name" type="email" class="form-control" v-model="name" required
                                               autofocus autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" v-model="email" required
                                               autofocus autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" v-model="password"
                                               required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                            Зарегистрироваться
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            error: null
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('api/v1/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        if (response.data.success) {
                            this.$router.go('/')
                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch(function (error) {
                        console.error(error.response.data);
                        this.error = error.response.data.message
                    });
                })
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next('/');
        }
        next();
    }
}
</script>
