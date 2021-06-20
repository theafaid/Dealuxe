<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        data() {
            return {
                editor: ClassicEditor,
                hasImage: false,

                form: new Form({
                    name: null,
                    price: null,
                    main_image: null,
                    description: null,
                    variations: [],
                }),

                variation: {
                    name: null,
                    type: null,
                    price: null,
                    quantity: 1,
                    order: 1
                },
            }
        },

        computed: {
            completeVariation() {
                for (let key in this.variation) {
                    if (this.variation[key] == '' || this.variation[key] == null) return false;
                }

                return true;
            },
        },

        methods: {
            addVariation () {
                if (this.completeVariation) {
                    this.form.variations.push( Object.assign({}, this.variation));
                    this.clearVariation();
                }
            },

            removeVariation (index) {
                this.form.variations.splice(index, 1);
            },

            clearVariation() {
                this.variation.type = null;
                this.variation.price = null;
                this.variation.name = null;
                this.variation.stock = 1;
                this.variation.order = 1;
            },

            setImage: function(output) {
                this.hasImage = true;
                this.image = output;
                console.log(this.image);
            },


            create() {
                this.form.post('/dashboard/products');
            }
        }
    }
</script>
