<template>
    <div class="companyContainer">
        <div class="section-company" v-if="loginForm == 1">
            <router-link to="/" id="tog"><span class="toggle toggleLogin" >&times;</span></router-link>
            <h1 class="header-text">Company Sign-in</h1>  
            <form action="" @submit.prevent="login()">
                <div class="form-container">
                    <label for="username">Username</label>
                    <input type="text" v-model="companyLoginForm.username" v-validate.continues="'required|max:40'" class='input-text' name='username' placeholder="enter your username" id='username' >
                    <transition-group  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error' v-for="(error,index) in errors.collect('username')" :key='"username"+index'>
                            {{ error }}
                        </p>  
                    </transition-group><transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error' v-if="companyLoginForm.errors.has('username')">
                            {{ companyLoginForm.errors.get('username') }}
                        </p>
                    </transition>
                    <label for='password'>Password</label>
                    <input type="password" v-model="companyLoginForm.password" v-validate.continues="'required|max:40'" class='input-text' name='password' placeholder="enter your password" id='password' >
                    <transition-group  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error' v-for="(error,index) in errors.collect('password')" :key='"password"+index'>
                            {{ error }}
                        </p>  
                    </transition-group>
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error' v-if="companyLoginForm.errors.has('password')">
                            {{ companyLoginForm.errors.get('password') }}
                        </p>
                    </transition>
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error' v-if="message!=''">
                            {{message}}
                        </p>
                    </transition>
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p style="background:lightgreen"  v-if="messageSuccess!=''">
                            {{messageSuccess}}
                        </p>
                    </transition>
                    <label for="remember"><input v-model="companyLoginForm.remember" type="checkbox" name="remember" id="remember"> Remember Me</label>
                    <a href="#" @click="toggleLoginForgot()">Forgot Password</a>
                    <button :disabled='disable == 1' class="btn" type="submit"><i v-if="spinner == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Login</button>
                </div>
            </form>
        </div>

        <div class="section-company loginPanel" v-else>
            <h1 class="login-head">Forgot Password</h1>
            <div class="form-container">
                    <label for="username">Username</label>
                    <input  type="text" v-model="companyForgotForm.username" class='input-text' name='username' placeholder="enter your username" id='username' >
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                                <p class='error' v-if="companyForgotForm.errors.has('username')">
                                {{ companyForgotForm.errors.get('username') }}
                                </p>
                    </transition>
                    <label for="number">Number</label>
                    <input  type="text" v-model="companyForgotForm.number" class='input-text' name='number' placeholder="enter your number" id='number' >
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                                <p class='error' v-if="companyForgotForm.errors.has('number')">
                                {{ companyForgotForm.errors.get('number') }}
                                </p>
                    </transition>
                     <button :disabled='companyForgotForm.busy' class="btn" type="button" @click="sendcode()"><i v-if="spinnerLogin == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Requests Code </button>
                    <label for="code">Code</label>
                    <input  type="text" v-model="companyForgotForm.code" class='input-text' name='code' placeholder="enter your code" id='code' >
                    <button @click="generateNewPass()" :disabled='companyForgotForm.busy' class="btn" type="button"><i v-if="spinnerNewPass == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Generate New Password </button>
                    <a href="#" @click="toggleLoginForgot()">Login</a>
            </div>
        </div>
    </div>
</template>
<script>

$('.companyContainer #closeComp').on('click', function(){
    $('.companyContainer').toggle();
});

export default {
    data(){
        return {
            resend:0,
            spinner:'',
            toggle:'',
            spinnerLogin:'',
            message:'',
            messageSuccess:'',
            disable:'',
            loginForm:1,
            spinnerNewPass:'',
            companyLoginForm:new Form({
                username:'',
                password:'',
                remember:''
            }),
            companyForgotForm:new Form({
                username:'',
                number:'',
                code:''
            }),
        }
    },
    methods:{
        spinLoadingPass(){
            this.spinnerNewPass = this.spinnerNewPass != 1 ?1:'';
        },
        spinLoadingLogin(){
            this.spinnerLogin = this.spinnerLogin != 1 ?1:'';
        },
        generateNewPass(){
            let vm = this;
            vm.spinLoadingPass();
            vm.companyForgotForm.post('/company/resetPass')
            .then( ({data}) => {
                vm.spinLoadingPass();
                console.log(data);
                swal(data);
                }).catch(function(error){
                swal('Failed');
                vm.spinLoadingPass();
                });
        }
        ,
        sendcode(){
            let vm = this;
            vm.spinLoadingLogin();
            vm.companyForgotForm.post('/company/resetCode')
            .then( ({data}) => {
                vm.spinLoadingLogin();
                console.log(data);
                swal(data);
                }).catch(function(error){
                swal('Failed');
                vm.spinLoadingLogin();
                });
        },
        spinLoading(){
            this.spinner = this.spinner != 1 ?1:'';
        },
        toggleLoginForgot(){
           this.loginForm = this.loginForm == 1?0:1;
        }
        ,
        login(){
           let vm = this;
            this.$validator.validateAll(['username','password']).then(function(result){
                if(result){
                    vm.disable = 1;
                    vm.spinLoading();
                    vm.companyLoginForm.post('/company/login')
                    .then( ({data}) => {
                         vm.spinLoading();
                         vm.disable = '';
                         console.log(data);
                         if(data.success == 1){
                             vm.messageSuccess = 'Login successfully';
                             window.location.href = data.redirect;
                         }else{
                             if(data.success == 2){
                                vm.message ='password is incorrect!, or account is disabled'
                             }else if(data.success == 3) {
                                vm.message ='This user does not exist!'
                             }

                         }
                          }).catch(function(error){
                            vm.message ='Failed!'    
                            vm.spinLoading();
                            vm.disable = '';
                          });
                }else{
                   
                }
            }); 
        },
        togglelogin(){ 
           this.toggle = this.toggle != 2?2:'';
       },
    }
}
</script>

<style scoped>

.companyContainer{
    width: 100%;
    padding: .5em;
    position: absolute;
    border-radius: 5px;
    display: flex;
    justify-content: center;
    z-index: 100;
    top: 0;
    left: 0;
}

.companyContainer .toggle{
    font-size: 40px;
    cursor: pointer;
    color: #e63939;
    font-weight: bold;
    transition: .5s;
    position: relative;
    left: 335px;
    top: -8px;
}

.companyContainer #tog {
    height: 10px;
    position: absolute;
}

.section-company{
    background-color: #f1f1f1;
    box-shadow: 0px 0px 20px #333;
    margin-top:1em;
    padding: 1em;
    border-radius: .5em;
    width: 400px;
}
.header-text{
    color: #333;
    text-align: center;
    font-size: 1.5em;
    padding: .7em;
    font-weight: bold;
    border-bottom: 1px solid #333;
}
.form-container{
    display: flex;
    flex-flow: column wrap;
}
.flex-row{
    display: flex;
    flex-flow: column wrap;
}
label{
    color: #333;
    width: 100%;
    letter-spacing: 1px;
}
.input-text{
    color: black;
    font-weight: 700;
    padding: .2em .2em .2em .2em;
    letter-spacing: 1px;
    border:none;
    margin-bottom: 1em;
    width: 100%;
}

.btn{
    border:none;
    color: white;
    background-color: rgba(1, 7, 8, 0.829);
    letter-spacing: 1px;
    font-weight: 700;
    transition: all 500ms ease-in-out;
    box-sizing: border-box;
    width: 100%;
}
.btn:hover{
    color: rgb(1, 7, 8);
    background-color: rgba(255, 255, 255, 0.616);
}
.btn:active{
    border:lightgreen 1px solid;
}
.half{
  
    flex-shrink: 2;
    flex-grow: 2;
}
.half-40{

    flex-shrink: 2;
    flex-grow: 2;
}
</style>


