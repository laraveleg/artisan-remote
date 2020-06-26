<template>
    <div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Send artisan</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Select artisan</label>
                    <div class="row row-sm">
                        <div class="col">
                            <select class="form-select" v-model="artisan">
                                <option value="">Select artisan ...</option>
                                <option>key:generate</option>
                                <option>migrate</option>
                                <option>migrate:fresh</option>
                                <option>test</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-white btn-icon" aria-label="Button" @click="sendArtisan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="10" y1="14" x2="21" y2="3"></line><path d="M21 3L14.5 21a.55 .55 0 0 1 -1 0L10 14L3 10.5a.55 .55 0 0 1 0 -1L21 3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       

    </div>
</template>

<script lang="ts">
    import Vue from 'vue';
    import {
        Component,
        Prop
    } from 'vue-property-decorator';
    import axios from 'axios';

    @Component
    export default class ProjetsShowComponent extends Vue
    {
        artisan:string = '';

        @Prop({default: ''}) guid:any;

        mounted()
        {
            // 
        }

        sendArtisan()
        {
            axios.post('/api/'+this.guid+'/artisans/send', {
                artisan: this.artisan,
            })
            .then((response) => {

                console.log(response.data);

            })
            .catch(error => console.error(error));
        }

    }
</script>
