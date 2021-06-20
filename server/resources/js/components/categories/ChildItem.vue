<template>
    <button type="button" class="list-group-item" v-text="child.name"></button>
</template>

<script>
    export default {
        props: {
            child: {
                required: true,
            }
        },

        data() {
            return {
                localChild: this.child,
            }
        }
   }
</script>

<style scoped>

</style>
