<script>

</script>

<template>
  <div>
    <section id='newBooks'>
        <h2>Recently added books</h2>
        <!-- @foreach($newBooks as $book)
            @include('books._book')
        @endforeach -->
    </section>

    <section id='allBooks'>
        <h2>All books</h2>
        <!-- @foreach($books as $book)
            @include('books._book')
        @endforeach -->
    </section>
  </div>
</template>

<style src="../../css/books/index.css"></style>
