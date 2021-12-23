<template>
  <a-comment>
    <a-avatar
      slot="avatar"
      :src="`https://i.pravatar.cc/150?u=${value.author}`"
      v-if="value.author"
    />
    <div slot="content">
      <a-form-item>
        <a-input
          v-model="value.author"
          placeholder="Your name"
        >
          <a-icon slot="prefix" type="user" />
        </a-input>
      </a-form-item>
      <a-form-item>
        <a-textarea
          :rows="4"
          v-model="value.content"
          placeholder="Write your comment"
        />
      </a-form-item>
      <a-form-item>
        <a-button
          @click="$emit('save', true)"
          html-type="submit"
          :loading="saving"
          type="primary"
          size="small"
          icon="check"
        >
          Send
        </a-button>
        <a-divider type="vertical" />
        <a-button
          @click="$emit('close', true)"
          size="small"
          icon="close"
          type="dashed"
        >
          Close
        </a-button>
      </a-form-item>
    </div>
  </a-comment>
</template>
<script type="text/javascript">
export default {
  name: 'CommentForm',
  props: {
    value: {
      required: true,
      default: Object
    },
    saving: {
      required: true,
      default: Boolean
    }
  }
}
</script>