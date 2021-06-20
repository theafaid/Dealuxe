<template>
    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Background</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors text-center">
                            <span
                                v-for="(color, index) in colors"
                                class="badge filter"
                                :class="'badge-' + color"
                                :data-color="color"
                                :key="index"
                                @click="setLayoutColor(color)"
                            ></span>

                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="adjustments-line text-center color-change">
                    <span class="color-label" >WHITE MODE</span>
                    <span class="badge light-badge mr-2" @click="setMode('white-content')"></span>
                    <span class="badge dark-badge ml-2" @click="setMode('dark-content')"></span>
                    <span class="color-label">DARK MODE</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                colors: ['primary', 'blue', 'green'],
            }
        },

        methods: {
            setMode(mode) {
                axios.get(`/dashboard/theme/${mode}`);
            },

            setLayoutColor(color) {
                axios.get(`/dashboard/layout/${color}`)
            }
        }
    }
</script>
