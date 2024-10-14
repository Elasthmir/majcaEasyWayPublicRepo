<template>
  <div>
    <h1>Users</h1>
    <ul>
      <li v-for="user in users" :key="user.id">{{ user.name }} </li>
    </ul>
  </div>
</template>

<script>
export default {
  async asyncData({ $axios }) {
    try {
      const users = await $axios.$get('/User'); // Fetch from /users endpoint
      return { users };
    } catch (error) {
      console.error('Error fetching users:', error);
      return { users: [] };
    }
  }
}
</script>
