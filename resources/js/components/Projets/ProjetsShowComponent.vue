<template>
    <div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Send artisan</h3>
            </div>
            <div class="card-body">
                <label class="form-label">Select artisan</label>
                <div class="row">
                    <div class="col">
                        <select class="form-select" v-model="artisan">
                            <option value="">Select artisan ...</option>
                            <option v-for="(item, key) in project.artisan_orders" :key="key" :value="item">{{ item }}</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <a href="javasript:false" class="btn btn-white btn-icon" aria-label="Button" v-bind:class="{ disabled: do_send_artisan }" @click="sendArtisan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="10" y1="14" x2="21" y2="3"></line><path d="M21 3L14.5 21a.55 .55 0 0 1 -1 0L10 14L3 10.5a.55 .55 0 0 1 0 -1L21 3"></path></svg>
                        </a>
                    </div>
                    <div class="cal-12 mt-3">
                        <div class="progress progress-sm" v-if="do_send_artisan">
                            <div class="progress-bar progress-bar-indeterminate"></div>
                        </div>
                        <div class="alert alert-success mb-0" role="alert" v-if="showAlert.type == 'success'">{{ showAlert.message }}</div>
                        <div class="alert alert-info mb-0" role="alert" v-if="showAlert.type == 'info'">{{ showAlert.message }}</div>
                        <div class="alert alert-warning mb-0" role="alert" v-if="showAlert.type == 'warning'">{{ showAlert.message }}</div>
                        <div class="alert alert-danger mb-0" role="alert" v-if="showAlert.type == 'danger'">{{ showAlert.message }}</div>
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
        project:Object = '';
        showAlert:Object = '';

        do_send_artisan:any = false;

        @Prop({default: ''}) guid:any;

        mounted()
        {
            this.getProjet();
        }

        getProjet()
        {
            axios.get('/api/projects/show/'+this.guid)
            .then((response) => {

                if (response.data.status == 'success') {
                    this.project = response.data.data.project;
                }

            })
            .catch(error => console.error(error));
        }

        sendArtisan()
        {
            this.do_send_artisan = true;
            
            this.showAlert = {
                type: 'close'
            }

            axios.post('/api/'+this.guid+'/artisans/send', {
                artisan: this.artisan,
            })
            .then((response) => {
                this.do_send_artisan = false;
                
                this.showAlert = {
                    type: response.data.status,
                    message: response.data.message
                }
            })
            .catch(error => console.error(error));
        }

    }
</script>
