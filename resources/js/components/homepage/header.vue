<template>
    <header>
        <div class="myContainer">
            <div class="myBrand">
                <img src="/img/peso.png" width="50" height="50" alt="no img" style="margin-right: 10px;">
                <div>
                   <p style='position: relative; top: 4px;' id="brand650">Skilled Workers Pool System</p>
                   <p style='font-size: 16px; position: relative; top: -4px;' id="subbrand650">PESO Tarlac City</p>
                </div>
            </div>
            <div class="myMenu">
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#footer">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="myHeader">
            <div class="mainContainer leftContainer">
                <span>Applicant |</span>
                <p>Grad the opportunity</p>
                    <div>
                         <a class="myBtn btnRegister" href="#" @click="toggleSingup()">Sign-up</a>
                         <a class="myBtn btnLogin" href="#" @click="togglelogin()">Login</a>
                    </div>
            </div>
            <div class="mainContainer rightContainer">
                <span>Company |</span>
                <p>Start hiring the best Workers</p>
                <router-link to="/company" class="myBtn btnLogin" style='padding: 4px 10px;'>Login</router-link></div>
            </div>
        </div>

    <div class="login-container" style="z-index: 10;">
        <div class="section-applicant" v-if="toggle==1">
            <h1 class="header-text">Applicant Registration</h1>
            <span class="toggle toggleSignup" @click="toggleSingup()">&times;</span>
            <form @submit.prevent="register()">
                <div class="form-container">
                    <div class="flex-row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="first_name" class="half-40">First Name</label>
                            <input type="text" v-model="applicantRegistrationForm.first_name" v-validate.continues="'required|min:1|max:40|alpha'" class='input-text half' name='first name' placeholder="Enter your First Name" id='first_name'>             
                                <p class='error' v-for="(error,index) in errors.collect('first name')" :key='"first_name"+index'>
                                    {{ error }}
                                </p>  
                                    <p class='error' v-if="applicantRegistrationForm.errors.has('first_name')">
                                    {{ applicantRegistrationForm.errors.get('first_name') }}
                                    </p>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="middle_name" class="half-40">Middle Name (if applicable)</label>
                            <input type="text" v-model="applicantRegistrationForm.middle_name" v-validate.continues="'min:1|max:40|alpha'" class='input-text half' name='middle name' placeholder="Enter your middle Name" id='middle_name'>
                                <p class='error' v-for="(error,index) in errors.collect('middle name')" :key='"middle_name"+index'>
                                    {{ error }}
                                </p>  
                                    <p class='error' v-if="applicantRegistrationForm.errors.has('middle_name')">
                                    {{ applicantRegistrationForm.errors.get('middle_name') }}
                                    </p>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="last_name" class="half-40">Last Name</label>
                            <input type="text" v-model="applicantRegistrationForm.last_name" v-validate.continues="'required|min:1|max:40|alpha'" class='input-text half' name='last name' placeholder="Enter your last name" id='last_name'>  
                                <p class='error' v-for="(error,index) in errors.collect('last name')" :key='"last_name"+index'>
                                    {{ error }}
                                </p>  
                                    <p class='error' v-if="applicantRegistrationForm.errors.has('last_name')">
                                    {{ applicantRegistrationForm.errors.get('last_name') }}
                                    </p>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="email">Email</label>
                            <input type="email" v-model="applicantRegistrationForm.email" v-validate.continues="'required|email|min:8|max:70'" class='input-text' name='email' placeholder="Enter your Email" id='email'>
                                <p class='error' v-for="(error,index) in errors.collect('email')" :key='"email"+index'>
                                    {{ error }}
                                </p>  
                                        <p class='error' v-if="applicantRegistrationForm.errors.has('email')">
                                        {{ applicantRegistrationForm.errors.get('email') }}
                                        </p>
                        </div>
                        <div class="col-lg-3 col-md-4  col-sm-6">
                            <label for="number">Contact Number</label>
                            <input type="number" v-model="applicantRegistrationForm.number" v-validate.continues="'required|digits:11'" class='input-text' name='number' placeholder="Enter your mobile number" id='number'>
                                <p class='error' v-for="(error,index) in errors.collect('number')" :key='"number"+index'>
                                    {{ error }}
                                </p>  
                                        <p class='error' v-if="applicantRegistrationForm.errors.has('number')">
                                        {{ applicantRegistrationForm.errors.get('number') }}
                                        </p>
                        </div>
                        <div class="col-lg-3 col-md-4  col-sm-6">
                            <label for="civil_status">Civil Status</label>
                            <select class='input-text' v-model="applicantRegistrationForm.civil_status" v-validate.continues="'required|included:Married,Widowed,Separated,Divorced,Single'" name="civil_status" id="civil_status">
                                <option value=""> </option>
                                <option value="Married">Married </option>
                                <option value="Widowed">Widowed </option>
                                <option value="Separated">Separated </option>
                                <option value="Divorced">Divorced </option>
                                <option value="Single">Single </option>
                            </select>
                                <p class='error' v-for="(error,index) in errors.collect('civil_status')" :key='"civil_status"+index'>
                                    {{ error }}
                                </p>  
                                        <p class='error' v-if="applicantRegistrationForm.errors.has('civil_status')">
                                        {{ applicantRegistrationForm.errors.get('civil_status') }}
                                    </p>
                        </div>
                        <div class="col-lg-3 col-md-4  col-sm-6">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" v-model="applicantRegistrationForm.date_of_birth"  v-validate.continues="'required|date_between:1950-01-01,2002-01-01'" class='input-text' name='date of birth' placeholder="enter your date of birth" id='date_of_birth'>
                                <p class='error' v-for="(error,index) in errors.collect('date of birth')" :key='"date_of_birth"+index'>
                                    {{ error }}
                                </p>  
                                        <p class='error' v-if="applicantRegistrationForm.errors.has('date_of_birth')">
                                        {{ applicantRegistrationForm.errors.get('date_of_birth') }}
                                        </p>
                        </div>
                        <div class="col-lg-3 col-md-4  col-sm-6">
                            <label for="username">Username</label>
                            <input type="text" v-model="applicantRegistrationForm.username" v-validate.continues="'required'" class='input-text' name='username' placeholder="enter your username" id='username'>
                                <p class='error' v-for="(error,index) in errors.collect('username')" :key='"username"+index'>
                                    {{ error }}
                                </p>  
                                        <p class='error' v-if="applicantRegistrationForm.errors.has('username')">
                                        {{ applicantRegistrationForm.errors.get('username') }}
                                        </p>
                        </div>
                        <div class="col-lg-3 col-md-4  col-sm-6">
                            <label for='password'>Password</label>
                            <input type="password" v-model="applicantRegistrationForm.password" v-validate.continues="'required|min:8|max:30'" class='input-text' name='password' placeholder="enter your password" id='password' ref="password" >
                                <p class='error' v-for="(error,index) in errors.collect('password')" :key='"passwordReg"+index'>
                                    {{ error }}
                                </p>  
                                        <p class='error' v-if="applicantRegistrationForm.errors.has('password')">
                                        {{ applicantRegistrationForm.errors.get('password') }}
                                        </p>
                        </div>
                        <div class="col-lg-3 col-md-4  col-sm-6">
                            <label for='confirm_password'>Confirm Password</label>
                            <input type="password" v-model="applicantRegistrationForm.password_confirmation" v-validate.continues="'required|confirmed:password'" class='input-text' name='confirm password' placeholder="enter your password again" id='confirm_password' data-vv-as="password">
                                <p class='error' v-for="(error,index) in errors.collect('confirm password')" :key='"password_confirmation"+index'>
                                    {{ error }}
                                </p>  
                        </div>
                        <div class="col-lg-3 col-md-4  col-sm-6">
                            <label >Gender</label>
                            <label for="male"><input type="radio" v-model="applicantRegistrationForm.gender"  v-validate.continues="'required|included:0,1'" id='male' name="gender" value="0" checked> Male </label>
                            <label for="female"><input type="radio" v-model="applicantRegistrationForm.gender" id='female' name="gender" value="1" checked> Female </label>
                                <p class='error' v-for="(error,index) in errors.collect('gender')" :key='"gender"+index'>
                                    {{ error }}
                                </p>  
                                        <p class='error' v-if="applicantRegistrationForm.errors.has('gender')">
                                        {{ applicantRegistrationForm.errors.get('gender') }}
                                        </p>
                        </div>
                </div>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Read License and Agreement
                                </button>
                            </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                               It is the policy of the Department of Labor and Employment (DOLE) to respect and uphold the data privacy rights, and to ensure that personal information and sensitive personal information (collectively called personal data) collected from the clients are processed and profiled pursuant to Republic Act No. 10173 (Data Privacy Act of 2012) and its implementing rules and regulations.

This Privacy Policy serves as our guide for collection, processing and profiling of personal data in accordance with the general privacy principles of transparency, legitimate purpose, and proportionality, and such other relevant principles in the collection, processing, and retention of personal data as required by applicable law.
                            </div>
                            </div>
                        </div>
                    </div>
                    <center><label for="remember"><input type="checkbox"  @click="agree()"  name="remember" id="remember" > I confirm that I have read and accept the terms of this User Agreement.</label></center>
                    <button class="btn" type="submit" :disabled="applicantRegistrationForm.busy"><i v-if="spinnerRegister == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Register</button>
                </div>
            </form>
        </div>
        <div class="section-applicant applicantPanel" v-if='toggle == 2'>
            <h1 class="header-text">Login</h1>
            <span class="toggle toggleLogin" @click="togglelogin()">&times;</span>
            <form @submit.prevent="login()" >
                <div class="form-container">
                    <label for="username">Username</label>
                    <input  type="text" v-model="applicantLoginForm.username" class='input-text' name='username' placeholder="Enter your username" id='username' >
                                <p class='error' v-if="applicantLoginForm.errors.has('username')">
                                {{ applicantLoginForm.errors.get('username') }}
                                </p>
                    <label for='password'>Password</label>
                    <input type="password" v-model="applicantLoginForm.password" class='input-text' name='password' placeholder="Enter your password" id='password' >
                                <p class='error' v-if="applicantLoginForm.errors.has('password')">
                                {{ applicantLoginForm.errors.get('password') }}
                                </p>
                    <label for="remember"><input type="checkbox" v-model="applicantLoginForm.remember" name="remember" id="remember" > Remember Me</label>
                    <label for=""><a href="#"  @click="toggleForgot()">Forgot Password</a></label> 
                    <button :disabled='applicantLoginForm.busy' class="btn" type="submit"><i v-if="spinnerLogin == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Login</button>
                </div>
            </form>
        </div>
        <div class="section-applicant applicantPanel" v-if='toggle == 3'>
             <span class="toggle toggleLogin" @click="toggleForgot()">&times;</span>
            <h1 class="header-text">Forgot Password</h1>
                <div class="form-container">
                    <label for="username">Username</label>
                    <input  type="text" v-model="applicantForgotForm.username" class='input-text' name='username' placeholder="enter your username" id='username' >
                                <p class='error' v-if="applicantForgotForm.errors.has('username')">
                                {{ applicantForgotForm.errors.get('username') }}
                                </p>
                    <label for="number">Number</label>
                    <input  type="text" v-model="applicantForgotForm.number" class='input-text' name='number' placeholder="enter your number" id='number' >
                                <p class='error' v-if="applicantForgotForm.errors.has('number')">
                                {{ applicantForgotForm.errors.get('number') }}
                                </p>
                     <button :disabled='applicantForgotForm.busy' class="btn" type="button" @click="sendcode()"><i v-if="spinnerLogin == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Requests Code </button>
                    <label for="code">Code</label>
                    <input  type="text" v-model="applicantForgotForm.code" class='input-text' name='code' placeholder="enter your code" id='code' >
                    <button @click="generateNewPass()" :disabled='applicantForgotForm.busy' class="btn" type="button"><i v-if="spinnerNewPass == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i> Generate New Password </button>
                </div>
        </div>
    </div>

    </header>

</template>
<script>
export default {
    
}
</script>
<style scoped>

.agreement{
    padding: 1em;
    color: black;
    background-color: white;
    margin: 1em 1em 1em 0;
    text-align: center;
}
.login-container{
    width: 100%;
    margin: 0 auto;
    padding: .5em;
    position: absolute;
    top: 0;
    left: 0;
}

.login-container .toggle {
    font-size: 40px;
    cursor: pointer;
    color: #e63939;
    font-weight: bold;
    transition: .5s;
}

.login-container .toggleSignup {
    position: absolute;
    right: 45px;
    top: 25px;
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
    .myContainer {
        display: flex;
        align-items: center;
        position: relative;
        padding: 0px 40px;
        height: 70px;
        z-index: 1;
    }


    .myContainer ul {
        display: flex;
        margin: 0;
    }

    .myContainer .myBrand {
        font-size: 22px;
        color: #333;
        display: flex;
    }

    .myContainer .myBrand p {
        margin: 0;
        padding: 0;
    }

    .myContainer .myMenu {
        position: absolute;
        right: 30px;
    }

    .myContainer ul li {
        list-style: none;
        margin: 0px 10px;
    }

    .myContainer ul li a {
        color: #333;
    }

    .link-1{
        border-right: 1px solid white;
        flex-shrink: 1;
    }
    .link-2{
        border-left: 1px solid white;
        flex-shrink: 1;
    }
    header{
        width:100%;
    }

    .banner{
        display: flex;
        flex-flow: row wrap;
    }

    .myHeader {
        background-image: url('/img/banner.jpg');
        background-repeat: no-repeat;
        background-position: ;
        background-size: cover;
        height: 250px;
        width: 100%;
        position: absolute;
        display: flex;
        color: #f1f1f1;
        z-index: 0;
    }

    .myHeader .mainContainer {
        width: 100%;
        background-color: rgba(0, 0, 0, .3);
        height: 100%;
        transition: .5s;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .myHeader .mainContainer span {
        font-size: 24px;
        text-shadow: 1px 1px 3px #333;
    }

    .myHeader .mainContainer .myBtn {
        color: white;
        padding: 7px 10px;
        border-radius: 5px;
        transition: .5s;
        text-decoration: none;
    }

    .myHeader .mainContainer .btnLogin {
        background-color: #ad2121;
    }

    .myHeader .mainContainer .btnRegister {
        background-color: #007bff;
    }

    .myHeader .mainContainer .myBtn:hover {
        background-color: #f1f1f1;
        color: #333;
    }

    .myHeader .mainContainer:hover {
        background-color: rgba(0, 0, 0, .6);
    }

    .myHeader .leftContainer {
        border-right: 1px solid #f1f1f1;
    }

    .myHeader .rightContainer {
        border-left: 1px solid #f1f1f1;
    }


    @media screen and (max-width: 650px) {
        .myContainer #brand650 {
            font-size: 15px;
        }

        .myContainer #subbrand650 {
            font-size: 8px;
        }

        .myContainer {
            padding-left: 10px;
        }

        .myContainer .myMenu {
            right: 0px;
        }

        .myContainer .myMenu a {
            font-size: 14px;
        }
    }

     @media screen and (min-width: 651px) {
        .myContainer .myBrand img {
            position: relative;
            top: 5px;
        }
    }

</style>

<script>
export default {
    
    name:"admin-login-component",
    data(){
        return {
           agreement:0,
           toggle:'',
           spinnerRegister:'',
           spinnerLogin:'',
           spinnerNewPass:'',
           applicantRegistrationForm:new Form({
                first_name:'',
                middle_name:'',
                last_name:'',
                email:'',
                number:'',
                civil_status:'',
                date_of_birth:'',
                username:'',
                password:'',
                password_confirmation:'',
                gender:''
            }),
            applicantLoginForm:new Form({
                username:'',
                password:'',
                remember:''
            }),
            applicantForgotForm:new Form({
                username:'',
                number:'',
                code:''
            }),
        }
    },
    methods:{
        agree(){
           this.agreement = this.agreement != 1 ?1:0;
        },
        spinLoadingPass(){
            this.spinnerNewPass = this.spinnerNewPass != 1 ?1:'';
        },
        generateNewPass(){
            let vm = this;
            vm.spinLoadingPass();
            vm.applicantForgotForm.post('/applicant/resetPass')
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
            vm.applicantForgotForm.post('/applicant/resetCode')
            .then( ({data}) => {
                vm.spinLoadingLogin();
                console.log(data);
                swal(data);
                }).catch(function(error){
                swal('Failed');
                vm.spinLoadingLogin();
                });
        }
        ,
        spinLoadingRegister(){
            this.spinnerRegister = this.spinnerRegister != 1 ?1:'';
        },
        spinLoadingLogin(){
            this.spinnerLogin = this.spinnerLogin != 1 ?1:'';
        },
       register(){
           let vm = this;
            if(this.agreement == 1){
                this.$validator.validateAll(['first name','last name','email','number','civil_status','date of birth','username','password','confirm password','gender']).then(function(result){
                    if(result){
                        vm.spinLoadingRegister();
                        
                        vm.applicantRegistrationForm.post('/applicant/register')
                        .then( ({data}) => {
                            vm.spinLoadingRegister();
                            console.log(data);
                            swal('Created',data,'success');
                            if(data =='Registered Successfully'){
                                vm.togglelogin();
                            }
                            }).catch(function(error){
                            vm.spinLoadingRegister();
                            });
                    }else{
                        swal('Aborted! ',"Errors detected","error");
                    }
                }); 
            }else{
                swal('Aborted! ',"Please Agree to the User Agreement!","error");
            }
            

       },
       login(){
           let vm = this;
            vm.spinLoadingLogin();
            vm.applicantLoginForm.post('/applicant/login')
            .then( ({data}) => {
                vm.spinLoadingLogin();   
                console.log(data);
                if(data.success == 1){
                    swal('Login successfully');
                    window.location.href = data.redirect;
                }else{
                    if(data.success == 2){
                        swal('Password is incorrect or Account is disabled');
                    }else if(data.success == 3) {
                        swal('This user does not exist!');
                    }
                }
            }).catch(function(error){
                swal('Failed!');   
                vm.spinLoadingLogin();
            });    
        },
       toggleSingup(){
           this.toggle = this.toggle != 1?1:'';
       }
       ,
       togglelogin(){
           this.toggle = this.toggle != 2?2:'';
       },
       toggleForgot(){
           this.toggle = this.toggle != 3?3:'';
       }
    }
}
</script>

