<template>
    <div class="container mt-4">
        <!--Header-->
        <div class="row mb-3">
            <div class="col">
                <h1>Blog</h1>
            </div>
        </div>

        <!--New post or edit-->
        <button v-on:click="showCreateFormChange" class="btn btn-info text-light">
            {{postMode}} post
        </button>

        <div class="mt-3" v-if="showCreateForm">
            <div class="form-group">
                <input v-model="newOrEditPost.title"
                       class="form-control mb-3"
                       type="text"
                       placeholder="Post Title">
                <textarea v-model="newOrEditPost.body"
                          class="form-control mb-3"
                          placeholder="Post Body"
                          rows="6">

                </textarea>
            </div>

            <div v-if="postMode == 'Create'">
                <button v-on:click="createNewPost"
                        class="btn btn-success mb-3">
                    Save post
                </button>
            </div>

            <div v-if="postMode == 'Edit'">
                <button v-on:click="updatePost"
                        class="btn btn-success mb-3">
                    Save post
                </button>
                <button v-on:click="cancelEdit"
                        class="btn btn-secondary mb-3">
                    Cancel
                </button>
            </div>
        </div>

        <hr>

        <!--Pagination-->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"
                    :class="{ 'disabled': !posts.prev_page_url }"
                    v-on:click="getPosts(posts.prev_page_url)">
                    <a class="page-link" href="#" >
                        Previous
                    </a>
                </li>

                <li class="page-item disabled">
                    <a class="page-link text-dark" href="#">
                        Page {{posts.current_page}} of {{posts.last_page}}
                    </a>
                </li>

                <li class="page-item"
                    :class="{ 'disabled': !posts.next_page_url }"
                    v-on:click="getPosts(posts.next_page_url)">
                    <a class="page-link" href="#">
                        Next
                    </a>
                </li>
            </ul>
        </nav>

        <hr>

        <!--All posts-->
        <div class="row">
            <div class="col">
                <div class="card mb-3"
                     v-for="post in posts.data">
                    <div class="card-header">
                        <h3 class="d-flex mt-3">
                            <a :id="'post-' + post.id"
                               :href="'#post-' + post.id"
                               class="text-dark mr-auto">
                                {{post.title}}
                            </a>
                            <div v-if="checkIfUserHasPost(post.user_id)">
                                <button v-on:click="enterEditMode(post.title, post.body, post.id)"
                                        class="btn btn-secondary">
                                    Edit
                                </button>
                                <button v-on:click="destroyPostAndLoad(post.id)"
                                        class="btn btn-danger">
                                    Delete
                                </button>
                            </div>
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{post.body}}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppComponent",

        data: function () {
            return {
                posts: [],
                newOrEditPost: {
                    title: null,
                    body: null,
                },
                postMode: 'Create',
                editPostId: null,
                showCreateForm: false,
            }
        },

        methods: {
            async getPosts (link) {
                await this.$store.dispatch('posts', link);
                this.posts = this.$store.state.posts.posts;
            },
            async storePostAndLoad () {
                await this.$store.dispatch('storePost', this.newPost);
                this.getPosts('http://localhost/api/blog/all?page=1');
            },
            async destroyPostAndLoad (postId) {
                await this.$store.dispatch('destroyPost', postId);
                this.getPosts('http://localhost/api/blog/all?page=1');
            },
            async updatePostAndLoad () {
                let data = {
                    id: this.editPostId,
                    post: this.newOrEditPost,
                };
                await this.$store.dispatch('updatePost', data);
                this.getPosts('http://localhost/api/blog/all?page=1');
                this.cancelEdit();
            },

            createNewPost: function () {
                this.storePostAndLoad();
            },
            updatePost: function () {
                this.updatePostAndLoad();
            },
            destroyPost: function (postId) {
                this.destroyPostAndLoad(postId);
            },
            enterEditMode: function (title, body, id) {
                this.postMode = 'Edit';
                this.showCreateForm = true;
                this.newOrEditPost.title = title;
                this.newOrEditPost.body = body;
                this.editPostId = id;
            },
            cancelEdit: function () {
                this.postMode = 'Create';
                this.showCreateForm = false;
                this.newOrEditPost.title = null;
                this.newOrEditPost.body = null;
                this.editPostId = null;
            },
            showCreateFormChange: function () {
                this.showCreateForm = !this.showCreateForm;
            },
            checkIfUserHasPost: function (postUserId) {
                if (this.user !== null) {
                    if (postUserId === this.user.id) {
                        return true;
                    }
                }
                return false;
            },

        },

        computed: {
            user: function () {
                return this.$store.state.auth.user;
            }
        },

        mounted() {
            this.getPosts('http://localhost/api/blog/all?page=1');
        }
    }
</script>

<style scoped>

</style>
