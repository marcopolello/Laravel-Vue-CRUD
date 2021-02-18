<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-3">
                  <div class="card-header">
                    <strong>{{ title }}</strong>
                  </div>

                    <div class="card-body">
                        {{ shortContent }}
                    </div>

                    <div class="card-footer">
                      <div>
                        {{ heartCount }}
                        <i @click="setLike()" class="fa-heart far" :class="heartIcon"></i>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
      data: function() {
        return {
          liked: false,
        }
      },
      methods: {
        setLike() {
          console.log("cliccato");
          this.liked = !this.liked;
        }
      },
      computed: {
        shortContent: function() {
          let maxLng = 100;
          return(this.content.length > maxLng)
            ? this.content.substring(0, maxLng) + '...'
            : this.content;
        },
        heartCount: function() {
          return this.likes + (this.liked ? 1 : 0);
        },
        heartIcon: function() {
          return this.liked ? 'fas' : 'far';
        }
      },

      props: {
        title: String,
        content: String,
        likes: Number
      },

    }
</script>
