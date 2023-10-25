<template>
    <div class="d-flex justify-content-center py-3">
      <p class="btn bg-dark text-white mr-4 " @click="home()" v-if="!tokenStatus">Home</p>
        <p class="btn bg-dark text-white " @click="login()"
        v-if="!tokenStatus"
        >Login</p>
        <p class="btn bg-dark text-white " @click="login()" 
        v-if="tokenStatus"
        >Logout</p>
      </div>
      <div class="container col-6 shadow-sm my-4 p-4">
       
            <legend style="border-bottom:1px solid" class="text-center mb-5 form-label">Login Form</legend>
            <h4 class="text-white bg-danger text-center p-2 my-4" v-if="userStatus">The Credential do not match!</h4>
      <div class="mb-3">
        <label
         for="exampleInputEmail1" 
         class="form-label"
         >Email address</label>
        <input
         type="email"
          class="form-control"
           id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter your email..."
            v-model="userData.email"
            >
        
      </div>
      <div class="mb-3">
        <label
         for="exampleInputPassword1"
          class="form-label"
          >Password</label>
        <input
         type="password"
          class="form-control"
           id="exampleInputPassword1"
           placeholder="Enter your password..."
           v-model="userData.password"
           >
      </div>
      <button type="button" class="btn btn-primary " @click="accountLogin()">Login</button>
      
    
</div>
</template>


<script src="../js/thisLogin.js"></script>

