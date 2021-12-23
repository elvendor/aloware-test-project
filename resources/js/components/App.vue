<template>
<a-layout id="components-layout-demo-fixed" style="min-height: 100vh">
    <a-layout-header :style="{ textAlign: 'center', backgroundColor: '#e5e5e5', position: 'fixed', zIndex: 1, width: '100%' }">
      <img src="/img/logo.png" height="33">
    </a-layout-header>
    <a-layout-content :style="{ padding: 0, marginTop: '64px' }">
      <div :style="{ background: '#fff', padding: '24px', minHeight: '75vh' }">
        <post :post="post" />
        <a-skeleton avatar :paragraph="{ rows: 5 }" v-if="fetching && post.comments.length === 0" />
        <comments
          :root="true"
          :postId="post.id"
          :comments="post.comments"
          @update="fetch"
          style="margin: 10px 20px"
        />

      </div>
    </a-layout-content>
    <a-layout-footer :style="{ textAlign: 'center' }">
      Aloware &copy; 2021
    </a-layout-footer>
  </a-layout>
</template>
<script type="text/javascript">
import Post from './Post.vue'
import Comments from './Comments.vue'

export default {
  name: 'App',
  components: { Post, Comments },
  async created() {
    this.$message.success('Hi, Angela!')
    await this.fetch()
  },
  data() {
    return {
      fetching: false,
      post: {
        comments: []
      }
    }
  },
  methods: {
    async fetch() {
      this.fetching = true
      const { data } = await window.axios.get('/api/post')
      this.post = data
      this.fetching = false
    }
  }
}
</script>