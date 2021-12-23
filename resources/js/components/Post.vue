<template>
  <a-card hoverable style="width: 100%">
    <img
      slot="cover"
      :src="post.image_url"
      height="350"
    />
    <template slot="actions" class="ant-card-actions">
      <span>
        <a-icon key="message" type="message" /> {{ post.comments_count }}
      </span>
      <span>
        <a-icon key="eye" type="eye" /> {{ viewCount }}
      </span>
    </template>
    <a-card-meta :title="post.title" :description="post.content">
      <a-avatar
        slot="avatar"
        src="https://i.pravatar.cc/150?u=bayram4ik@gmail.com"
      />
    </a-card-meta>
  </a-card>
</template>
<script type="text/javascript">
export default {
  name: 'Post',
  props: {
    post: {
      required: true,
      type: Object
    }
  },
  data() {
    return {
      viewCount: 0,
    }
  },
  created() {
    this.viewCount = Number(window.localStorage.getItem('viewCount')) + 1
    window.localStorage.setItem('viewCount', this.viewCount)
  }
}
</script>