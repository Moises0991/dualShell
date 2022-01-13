<template>
	<!-- Registration form -->
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form method="post" @submit.prevent="register()">
				<h1>Crear cuenta</h1>
				<input type="text" name="name" id="registerName" required placeholder="Nombre" class="gap" v-model="registerUser.name"/>
				<input type="email" name="email" required placeholder="Correo" v-model="registerUser.email" />
				<input type="password" name="password" required placeholder="Contraseña" v-model="registerUser.password" />
				<input type="password" name="confirm_password" required placeholder="Confirmar contraseña" v-model="registerUser.confirmPass" />
				<button type="submit" id="register-trigger" class="gap">Registrarse</button>
			</form>
		</div>
		<!-- end of Registration form -->
		
		<!-- login form -->
		<div class="form-container sign-in-container">
			<form method="post" @submit.prevent="login()">
				<h1>Iniciar Sesion</h1>
				<div class="social-container">
					<a href="/api/login-facebook" class="social"><i class="fab fa-facebook-f"></i></a>
					<a href="/api/login-google" class="social"><i class="fab fa-google-plus-g"></i></a>
					<a href="/api/login-linkedin" class="social"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<span>o usa tu cuenta</span>
				<input type="email" required autofocus name="email" id="loginEmail" placeholder="Correo" v-model="loginUser.email"/>
				<input type="password" required name="password" placeholder="Contraseña" v-model="loginUser.password"/>
				<a class="hover" href="#">Olvidaste tu contraseña?</a>
				<!-- <button type="submit">Inciar</button> -->
                <button type="submit" id="login-trigger" class="progress-button">Iniciar</button>
			</form>
		</div>
		<!-- end of login form -->

		<!-- right and left panel -->
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>¡Tengo cuenta!</h1>
					<p>Para mantenerse conectado con nosotros, inicie sesión con su información personal</p>
					<button class="ghost" id="signIn" @click="focus('signIn')">Inciar Sesion</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>¡Bienvenido!</h1>
					<p>Si aun no tiene una cuenta, ingrese sus datos y comienze su historia</p>
					<button class="ghost" id="signUp" @click="focus('signUp')">Registrarse</button>
				</div>
			</div>
		</div>
		<!-- end of right and left panel -->
    </div>
</template>

<script>

    import axios from 'axios'
    const appear_notification = new Audio('/sound/notifications/appear_notification.mp3');

    export default {
    name : "App",
        data() {
                return {
                    isLoggedIn: false,

                    registerUser: {
                        name: '',
                        email: '',
                        password: '',
                        confirmPass: ''
                    },

                    loginUser: {
                        email: '',
                        password: '',
                    },
                }
            },
            created() {
                if(window.Laravel.isLoggedIn) {
                    this.isLoggedIn = true
                }
            },
            methods: {

                // animation on panels, and focus on the fields
                focus(buttonId){

                    if(buttonId == 'signUp') {
                        document.getElementById('container').classList.add("right-panel-active");
                        document.getElementById('registerName').focus();
                    } else if (buttonId == 'signIn') {
                        document.getElementById('container').classList.remove("right-panel-active");
                        document.getElementById('loginEmail').focus();
                    }
                },

                // register a new user in the database
                register() {

                    if (!(this.registerUser.password.trim() === this.registerUser.confirmPass.trim())) {
                        var message = 'Contraseñas no coinciden';
                        this.notify('register', message);
                        return 0;
                    }

                    const credentials = {
                        name: this.registerUser.name,
                        email: this.registerUser.email,
                        password: this.registerUser.password
                    }

                    // communication with the backend
                    axios.get('/sanctum/csrf-cookie')
                        .then(response => {
                            axios.post('/api/register', credentials)
                                .then(response => {
                                    // cleaning fields
                                    this.registerUser.name = '';
                                    this.registerUser.email = '';
                                    this.registerUser.password = '';
                                    this.registerUser.confirmPass = '';
                                    this.notify('register', response.data.message, response.data.success );
                                }).catch(function(error){
                                    console.error(error);
                                })
                        })
                },

                // login with user
                login() {
    
                    const credentials = {
                        email: this.loginUser.email,
                        password: this.loginUser.password
                    }

                    // communication with the backend
                    axios.get('/sanctum/csrf-cookie')
                        .then(response => {
                            axios.post('/api/login', credentials)
                                .then(response => {
                                    // cleaning fields
                                    this.loginUser.email = '';
                                    this.loginUser.password = '';
                                    this.notify('login', response.data.message, response.data.success );
                                }).catch(function(error){
                                    console.error(error);
                                })
                        })
                    // this.$router.push({name: 'register'});
                },

                notify(proceed, message, auth) {

                    // create notification
                    var btn = document.getElementById(`${proceed}-trigger`);
                    // var responseMessage = 'Contraseñas no coinciden';

                    classie.add( btn, 'active' );
                    setTimeout(
                        function() {
                            classie.remove( btn, 'active' );
                            
                            // create the notification
                            var notification = new NotificationFx({
                                message : `<p>${message} </p>`,
                                layout : 'growl',
                                effect : 'genie',
                                type : 'warning', // notice, warning or error
                                ttl :3000,
                                onOpen : () => {
                                    appear_notification.play(); // it's of the audio type; defined at the top of the script
                                    if(auth) {
                                        window.location.href = '/'
                                    }
                                },
                            });
                            notification.show();
                        }, 1000
                    );
                }
            }
        }
</script>