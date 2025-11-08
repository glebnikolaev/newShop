<template>
    <section class="bg0 p-t-100 p-b-140">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="alert alert-danger" role="alert" v-if="error !== null">
                        {{ error }}
                    </div>

                    <div class="card card-default">
                        <div class="card-header">Вход</div>
                        <div class="card-body">
                            <form>
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
                                            Войти
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
import { login } from '../services/authService';

export default {
    data() {
        return {
            email: '',
            password: '',
            error: null,
        };
    },
    methods: {
        async handleSubmit(event) {
            event.preventDefault();
            if (!this.password.length) {
                return;
            }
            try {
                const response = await login({
                    email: this.email,
                    password: this.password,
                });
                if (response?.success) {
                    this.error = null;
                    this.$router.push('/');
                } else {
                    this.error = response?.message || 'Не удалось выполнить вход';
                }
            } catch (error) {
                if (process.env.NODE_ENV !== 'production') {
                    console.error(error);
                }
                this.error = error?.response?.data?.message || 'Ошибка при выполнении входа';
            }
        },
    },
    beforeRouteEnter(to, from, next) {
        if (typeof window !== 'undefined' && window.Laravel && window.Laravel.isLoggedin) {
            return next('/');
        }
        next();
    },
};
</script>
