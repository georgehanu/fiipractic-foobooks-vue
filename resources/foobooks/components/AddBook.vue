<template>
  <div class="container my-24 px-6 mx-auto">

    <section class="mb-32 text-center text-gray-800">
      <div class="max-w-[700px] mx-auto px-3 lg:px-6">
        <h2 class="text-3xl font-bold mb-12">Add a book</h2>
        <form>
          <div class="form-group mb-6">
            <input type="text" class="form-control block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none" id="exampleInput7"
              placeholder="* Title" v-model='book.title'>
            <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
          </div>
          <div class="form-group mb-6">

            <select v-model='book.author_id'>
              <option value=''>Choose one...</option>
              <span v-if="errors.author_id" class="error">{{ errors.author_id[0] }}</span>

            </select>
          </div>
          <div class="form-group mb-6">
            <input type="text" class="form-control block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none" id="exampleInput7"
              v-model='book.published_year' placeholder="* Published Year (YYYY)">
            <span v-if="errors.published_year" class="error">{{ errors.published_year[0] }}</span>
          </div>
          <div class="form-group mb-6">
            <input type="text" class="form-control block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none" id="exampleInput7"
              v-model='book.cover_url' placeholder="* Cover URL">
          </div>
          <div class="form-group mb-6">
            <input type="text" class="form-control block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none" id="exampleInput7"
              v-model='book.purchase_url' placeholder="* Purchase URL">
            <span v-if="errors.purchase_url" class="error">{{ errors.purchase_url[0] }}</span>
          </div>
          <div class="form-group form-check text-center mb-6">
            <input type="checkbox" name='tags[]' value=''
              class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-orange-600 checked:border-orange-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer"
              id="exampleCheck87" checked>
            <label class="form-check-label inline-block text-gray-800" for="exampleCheck87">Tags</label>
          </div>
          <button @click="submitForm" type="button" class="
          w-30
          px-6
          py-2.5
          bg-orange-600
          text-white
          font-medium
          text-xs
          leading-tight
          uppercase
          rounded
          shadow-md
          hover:bg-orange-700 hover:shadow-lg
          focus:bg-orange-700 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-orange-800 active:shadow-lg
          transition
          duration-150
          ease-in-out">Add</button>
        </form>
        <div v-if="formError" class='text-red-700'>{{ formError }}</div>
      </div>

    </section>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  name: 'AddBook',

  data() {
    return {
      book: {
        title: '',
        author_id: '',
        published_year: '',
        cover_url: '',
        purchase_url: ''
      },
      errors: {},
      formError: ''
    }
  },

  methods: {
    submitForm() {
      axios.post('http://127.0.0.1:8000/api/books', {
        "title": "my title",
        "description": "my description",
        "author_id": 1,
        "published_year": 2004,
        "cover_url": "http://google.com",
        "purchase_url": "http://google.com/purchase",
        "tags": [1, 2]
      })
        .then(response => {
          // redirect to home page or book detail page
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors
          } else {
            this.formError = 'Something went wrong. Please try again later.'
          }
        })
    }
  }
}
</script>

<style>
.error {
  color: red;
}
</style>
