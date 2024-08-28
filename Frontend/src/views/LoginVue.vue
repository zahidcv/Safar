<script setup>
import { reactive } from 'vue';
import axios from 'axios'

const credentials = reactive({
  phone:null,
  password:null
})
const handleLogin = () =>{
  console.log(credentials.phone, credentials.password)

  axios.post('https://localhost:8000/api/login', credentials)
    .then((response) => {
      console.log(response.data)
    })
    .catch((error)=>{
      console.error(error)
      alert(error.response.data.message)
    })
  }

</script>

<template>
  <form action="" method="post" @submit.prevent="handleLogin">
  
    <label for="email">Eamil Address:</label>
    <input type="text" name="email" id="email" v-model="credentials.phone"/>

    <label for="password">Password:</label>
    <input type="text" name="password" id="password" v-model="credentials.password"/>

    <button  type="submit" @submit.prevent="handleLogin">Log In</button>
  </form>
</template>
