<template>
    <div class="login-container">
        <div class="section-applicant" v-if="loginForm == 1">
        <div class="message-area">
            <h3 class='message-head'>Admins Only</h3>
            <p class='message-body'> 
                Unauthorized access is prohibited and punishable by Law.
            </p>
        </div>
            <form action="" @submit.prevent="login()">
                <div class="form-container">
                    <label for="username">Username</label>
                    <input type="text" v-model="adminLoginForm.username" v-validate.continues="'required|max:40'" class='input-text' name='username' placeholder="enter your username" id='username' >
                    <transition-group  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error' v-for="(error,index) in errors.collect('username')" :key='"username"+index'>
                            {{ error }}
                        </p>  
                    </transition-group><transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error' v-if="adminLoginForm.errors.has('username')">
                            {{ adminLoginForm.errors.get('username') }}
                        </p>
                    </transition>
                    <label for='password'>Password</label>
                    <input type="password" v-model="adminLoginForm.password" v-validate.continues="'required|max:40'" class='input-text' name='password' placeholder="enter your password" id='password' >
                    <transition-group  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error' v-for="(error,index) in errors.collect('password')" :key='"password"+index'>
                            {{ error }}
                        </p>  
                    </transition-group>
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error' v-if="adminLoginForm.errors.has('password')">
                            {{ adminLoginForm.errors.get('password') }}
                        </p>
                    </transition>
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error'  v-if="message!=''">
                            {{message}}
                        </p>
                    </transition>
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                        <p class='error success'  v-if="messageSuccess!=''">
                            {{messageSuccess}}
                        </p>
                    </transition>
                    <label for="remember"><input v-model="adminLoginForm.remember" type="checkbox" name="remember" id="remember"> Remember Me</label>
                    <a href="#" @click="toggleLoginForgot()">Forgot Password</a>
                    <button :disabled="adminLoginForm.busy" class="btn" type="submit"><i v-if="spinner == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Login</button>
                </div>
            </form>
        </div>
        
        <div class="section-applicant" v-else>
            <h1 class="login-head">Forgot Password</h1>
            <div class="form-container">
                    <label for="username">Username</label>
                    <input  type="text" v-model="adminForgotForm.username" class='input-text' name='username' placeholder="enter your username" id='username' >
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                                <p class='error' v-if="adminForgotForm.errors.has('username')">
                                {{ adminForgotForm.errors.get('username') }}
                                </p>
                    </transition>
                    <label for="number">Number</label>
                    <input  type="text" v-model="adminForgotForm.number" class='input-text' name='number' placeholder="enter your number" id='number' >
                    <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                                <p class='error' v-if="adminForgotForm.errors.has('number')">
                                {{ adminForgotForm.errors.get('number') }}
                                </p>
                    </transition>
                     <button :disabled='adminForgotForm.busy' class="btn" type="button" @click="sendcode()"><i v-if="spinnerLogin == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Requests Code </button>
                    <label for="code">Code</label>
                    <input  type="text" v-model="adminForgotForm.code" class='input-text' name='code' placeholder="enter your code" id='code' >
                    <button @click="generateNewPass()" :disabled='adminForgotForm.busy' class="btn" type="button"><i v-if="spinnerNewPass == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Generate New Password </button>
                    <a href="#" @click="toggleLoginForgot()">Login</a>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data(){
        return {
            spinner:'',
            spinnerLogin:'',
            spinnerNewPass:'',
            message:'',
            messageSuccess:'',
            loginForm:1,
            adminLoginForm:new Form({
                username:'',
                password:'',
                remember:''
            }),
            adminForgotForm:new Form({
                username:'',
                number:'',
                code:''
            }),
        }
    },
    methods:{
        toggleLoginForgot(){
           this.loginForm = this.loginForm == 1?0:1;
        },
        spinLoadingLogin(){
            this.spinnerLogin = this.spinnerLogin != 1 ?1:'';
        },
        spinLoadingPass(){
            this.spinnerNewPass = this.spinnerNewPass != 1 ?1:'';
        },
        generateNewPass(){
            let vm = this;
            vm.spinLoadingPass();
            vm.adminForgotForm.post('/admin/resetPass')
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
            vm.adminForgotForm.post('/admin/resetCode')
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
        login(){
           let vm = this;
            this.$validator.validateAll(['username','password']).then(function(result){
                if(result){
                    vm.spinLoading();
              
                    vm.adminLoginForm.post('/admin/login')
                    .then( ({data}) => {
                         vm.spinLoading();
                         console.log(data);
                         if(data.success == 1){
                             vm.messageSuccess = 'Login successfully';
                             vm.message ='';
                             window.location.href = data.redirect;
                         }else{
                             if(data.success == 2){
                                vm.message ='password is incorrect! or account is disabled'
                             }else if(data.success == 3) {
                                vm.message ='This user does not exist!'
                             }
                         }
                          }).catch(function(error){
                          vm.message ='Failed!'    
                          vm.spinLoading();
                          });
                }else{
                   
                }
            }); 
        }
    }
}
</script>
<style scoped>
.login-container{
    width: 100%;
    margin: 0 auto;
    padding: .5em;
    position: absolute;
    top: 0;
    left: 0;
}

.login-container .message-area {
    background-color: #ff4a4a;
    color: #f1f1f1;
    text-align: center;
    padding: 10px;
    margin-bottom: 5px;
}

.login-container .message-area p,
.login-container .message-area h3 {
    margin: 0;
}

.login-container .applicantPanel {
    width: 400px;
    position: fixed;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.login-container .toggleLogin {
    position: absolute;
    right: 30px;
    top: 7px;
}

.nav-bar{
    background: black;
    flex: 1 1 100%;
    padding: 2em;
    text-align: center;
    border-radius: 4em;
}
.link{
    outline: none;
    display: inline-block;
    color: aquamarine;
    font-weight: 400;
    margin: 0 1em 0 1em;
    font-size: 1.4em;
    text-decoration: none;
}
.link:hover{
    color: rgb(87, 209, 142);
    border-bottom: 2px solid white;
}
.section-applicant{
    flex: 1 1 100%;
    /*background: rgba(0, 0, 0, 0.884);*/
    background-color: #f1f1f1;
    box-shadow: 0px 0px 20px #333;
    margin-top:1em;
    padding: 1em;
    border-radius: .5em;
    display: flex;
    flex-flow: column wrap;
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
    color: #333;
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
.success{
    text-align:center;
    background:rgba(37, 207, 22, 0.507);
    color:rgb(8, 4, 26);
    font-size:1.2em;
    font-weight:900;
    letter-spacing:2px;
}
</style>


