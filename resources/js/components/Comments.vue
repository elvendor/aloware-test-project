<template>
  <div>
    <a-comment
      v-for="comment in comments"
      :key="comment.id"
      :author="comment.author"
      :content="comment.content"
      :avatar="`https://i.pravatar.cc/150?u=${comment.author}`"
    >
      <span slot="actions" v-if="comment.depth < 2">
        <a-button
          type="dashed"
          icon="rollback"
          size="small"
          @click="showForm(comment)"
        >
          Reply
        </a-button>
        <comment-form
          v-model="form"
          :saving="saving"
          v-if="showReplyForm === comment.id"
          @save="save"
          @close="closeForm"
        />
      </span>
      <comments
        :postId="postId"
        :comments="comment.children"
        @update="$emit('update', true)"
      />
    </a-comment>

    <a-button
      type="dashed"
      icon="rollback"
      @click="showForm(null)"
      v-if="root"
    > Write comment
    </a-button>
    <comment-form
      v-model="form"
      :saving="saving"
      v-if="showCommentForm && root"
      @save="save"
      @close="closeForm"
      style="width: 300px;max-width: 300px!important"
    />
  </div>
</template>

<script type="text/javascript">
import CommentForm from './CommentForm.vue'

export default {
  name: 'Comments',
  components: { CommentForm },
  props: {
    comments: {
      required: true,
      type: Array
    },
    postId: {
      required: false,
      type: Number,
      default: () => null
    },
    /* This prop needs to deternine of comment tree is root */
    root: {
      required: false,
      type: Boolean,
      default: () => false
    }
  },
  data() {
    return {
      showCommentForm: false,
      showReplyForm: null,
      saving: false,
      form: {
        author: null,
        content: '',
        parent_id: null
      }
    }
  },
  methods: {
    showForm(parent) {
      console.log(parent)
      this.resetForm()
      if (!parent) {
        this.showCommentForm = true
      } else {
        this.form.parent_id = parent.id
        this.showReplyForm = parent.id
      }
    },
    closeForm() {
      this.showCommentForm = false
      this.showReplyForm = null
    },
    resetForm() {
      // No need to reset author's name
      this.form.content = ''
      this.form.parent_id = null
    },
    async save() {
      this.saving = true
      try {
        const data = { ...this.form, post_id: this.postId }
        await window.axios.post('/api/comment', data)
        this.closeForm()
        this.$emit('update', true)
        this.$message.success('Thanks for comment')
        this.saving = false
      } catch (e) {
        this.saving = false
        this.$message.error('Unable to save comment')
      }
    }
  }
}
</script>


