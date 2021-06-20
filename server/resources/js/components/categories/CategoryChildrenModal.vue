<template>
    <div
        class="modal fade bd-children-modal-lg"
        tabindex="-1"
        role="dialog"
        aria-labelledby="categoryChildrenModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li
                                class="list-group-item"
                                v-for="child in children"
                                :key="child.id"
                                v-text="child.name"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['children'],
    }
</script>
