<script>
const API_URL = `http://localhost:8000/api/books`
//const API_URL = `http://localhost:8000/api/tags`
//const API_URL = `http://localhost:8000/api/authors`



export default {
  props: ['name'],
  data: () => ({
    branches: ['main', 'v2-compat'],
    currentBranch: 'main',
    commits: null,
    userInput: "test"
  }),

  created() {
    // fetch on init
    this.fetchData()
  },
  mounted(){

  },

  watch: {
    // re-fetch whenever currentBranch changes
    currentBranch: 'fetchData'
  },

  methods: {
    async fetchData() {
      const url = `${API_URL}?flag=${this.currentBranch}`
      this.commits = await (await fetch(url)).json()
    }
  }
}
</script>

<template>
  {{ commits }}
</template>
