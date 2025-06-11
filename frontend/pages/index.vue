<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'

const todos = ref([])

onMounted(async () => {
  const res = await axios.get('https://jsonplaceholder.typicode.com/todos')
  todos.value = res.data
})
</script>
<template>
    <div>
        <q-btn color="primary" icon="check" label="OK" />
        <ul>
          <li v-for="todo in todos" :key="todo.id">{{ todo.title }}</li>
        </ul>
    </div>
</template>