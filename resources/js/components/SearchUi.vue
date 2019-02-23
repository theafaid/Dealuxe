<template>
    <div>
        <ais-instant-search
                :search-client="searchClient"
                index-name="demo_ecommerce"
        >
            <ais-configure
                    :hitsPerPage="5"
                    :restrictSearchableAttributes="['name']"
            />
            <ais-autocomplete>
                <template slot-scope="{ currentRefinement, indices, refine }">
                    <vue-autosuggest
                            :suggestions="indicesToSuggestions(indices)"
                            @selected="onSelect"
                            :input-props="{
              style: 'width: 100%',
              onInputChange: refine,
              placeholder: 'Search here…',
            }"
                    >
                        <template slot-scope="{ suggestion }">
                            <ais-highlight
                                    :hit="suggestion.item"
                                    attribute="name"
                                    v-if="suggestion.item.name"
                            />
                            <strong>$ {{ suggestion.item.price }}</strong>
                            <img :src="suggestion.item.image" />
                        </template>
                    </vue-autosuggest>
                </template>
            </ais-autocomplete>
        </ais-instant-search>
    </div>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';
    import { VueAutosuggest } from 'vue-autosuggest';

    export default {
        components: { VueAutosuggest },
        data() {
            return {
                searchClient: algoliasearch(
                    'B1G2GM9NG0',
                    'aadef574be1f9252bb48d4ea09b5cfe5'
                ),
                query: '',
            };
        },
        methods: {
            onSelect(selected) {
                if (selected) {
                    this.query = selected.item.name;
                }
            },
            indicesToSuggestions(indices) {
                return indices.map(({ hits }) => ({ data: hits }));
            },
        },
    };
</script>
