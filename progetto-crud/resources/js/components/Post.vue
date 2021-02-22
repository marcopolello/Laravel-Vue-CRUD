<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div v-show="!deleted" class="card my-3">

                  <!-- READ -->
                  <div class="card-header" v-show="!sCreator">
                    <h1
                      v-show="!isEditFocus('title')">
                      <strong>
                        <span @click="setEditFocus('title')">
                          {{ postTitle }}  [id={{id}}]
                        </span>
                      </strong>
                    </h1>
                    <i @click="destroy()" class="fas fa-trash-alt fa-2x"></i>
                    <input
                      type="text"
                      v-show="isEditFocus('title')"
                      v-model="postTitle"
                    >
                  </div>

                  <!-- WRITE, CREATE -->
                  <div class="card-header" v-show="sCreator">
                    <H3>NEW POST</H3>
                      <input type="text" v-model="postTitle">
                  </div>

                  <!-- READ CARD BODY -->
                    <div class="card-body" v-show="!sCreator">
                        <p
                          @click="setEditFocus('content')"
                          v-show="!isEditFocus('content')"
                        >
                          <strong>
                          {{ shortContent }}
                          </strong>
                        </p>
                        <textarea
                          v-model="postContent"
                          v-show="isEditFocus('content')"
                          rows="4" cols="50">
                        </textarea>
                        <button
                          @click="update()"
                          v-show="!isEditFocus('')"
                          class="btn btn-primary"
                          type="button" name="button">
                          SAVE
                        </button>
                        <button
                          @click="cancel()"
                          v-show="!isEditFocus('')"
                          class="btn btn-danger"
                          type="button" name="button">
                          CANCEL
                        </button>
                    </div>

                    <!-- WRITE NEW POST -->
                    <div class="card-body"
                      v-show="sCreator"
                    >
                      <textarea cols="45" rows="4" v-model="postContent">
                      </textarea> <br>
                      <button
                          @click="create"
                          class="btn btn-primary">
                          SAVE
                      </button>
                    </div>

                    <!-- READ -->
                    <div class="card-footer" v-show="!sCreator">
                      <div>
                        {{ heartCount }}
                        <i @click="setLike()" class="fa-heart far" :class="heartIcon"></i>
                      </div>
                    </div>

                    <!-- WRITE -->
                    <div class="card-footer" v-show="sCreator">
                      <div>
                        <strong>1</strong>
                        <i class="fa-heart fas"></i>
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
          editFocus: '',

          liked: false,
          // variabili di supporto x non modificare le props
          postTitle: this.title,
          postContent: this.content,
          // altre variabili di supp dopo l'axios post x aggiornare il front-end dopo la modifica back-end senza ricaricare pagina
          sPostTitle: this.title,
          sPostContent: this.content,
          sPostLikes: this.likes,


          uPostTitle: this.title,
          uPostContent: this.content,
          uPostLikes: this.likes,

          // distruggere una carta(parto dal front-end)
          deleted: false,
          // flag create
          sCreator: this.creator,

          postId: this.id,
          postTitle: this.title,
          postContent: this.content,
          postLikes: this.likes
        }
      },
      methods: {
        setLike() {
          console.log("cliccato");
          this.liked = !this.liked;
        },
        // title
        setEditFocus(elem) {
          this.editFocus = elem;
        },
        isEditFocus(elem) {
          return this.editFocus === elem;
        },
        create() {
          const post = {
            title: this.postTitle,
            content: this.postContent
          };
          axios.post('/post/create', post)
             .then(r => {
                this.postId = r.id;
                this.uPostTitle = this.sPostTitle = r.title;
                this.uPostContent = this.sPostContent = r.content;
                this.uPostLikes = this.sPostLikes = 1;
                this.sCreator = false;
             })
             .catch(e => console.log('error', e));
             // ricarica pagina dopo il click tasto save;
             location.reload();
             return false;
        },

        update(){
          const post = {
            title: this.postTitle,
            content: this.postContent
          };
          // passo al post axios la rotta + id corrispondente e altro parametro che include tutti i dati inseriti dall'utente
          axios.post('/post/update/' + this.id, post)
              .then(r => {
                console.log('response', r);
                this.uPostTitle = this.sPostTitle = this.postTitle;
                this.uPostContent = this.sPostContent = this.postContent;
              })
              .catch(e => console.log('error', e));
          this.setEditFocus('');
        },
        // cancella testo inserito negli input
        cancel(){
          this.postTitle = this.uPostTitle;
          this.postContent = this.uPostContent;
          this.setEditFocus('');
        },
        // cancella dal database
        destroy() {
          // cancella lato front ma non back
          // this.deleted = true;
          axios.get('/post/destroy/' + this.id)
              .then(r => {
                this.deleted = true;
              })
              .catch(e => console.log('error', e));
        },

      },
      computed: {
        shortContent: function() {
          let maxLng = 100;
          return(this.postContent != undefined
            && this.postContent.length > maxLng)
            ? this.postContent.substring(0, maxLng) + '...'
            : this.postContent;
        },
        heartCount: function() {
          return this.likes + (this.liked ? 1 : 0);
        },
        heartIcon: function() {
          return this.liked ? 'fas' : 'far';
        }
      },

      props: {
        id: Number,
        title: String,
        content: String,
        likes: Number,

        creator: Boolean,
      },

    }
</script>
